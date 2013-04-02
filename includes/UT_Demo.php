<?php
/**
 * Core functionality for the Unit Test Demo Plugin
 */
class UT_Demo {
	/**
	 * Grab a post from the database at random. Caches the post so that it
	 * only refreshes once per day.
	 *
	 * @uses get_posts()
	 *
	 * @return object
	 */
	public function get_post_of_the_day() {
		$args = array(
			'numberposts' => 1,      // Select only one post
			'orderby'     => 'rand', // Select the post at random
			'post_type'   => 'post'  // Only request regular posts
		);

		$posts = get_posts( $args );

		// Return the first post in the array
		return $posts[0];
	}
	
	/**
	 * Trim an excerpt down to size.
	 *
	 * @uses strip_shortcodes()
	 * @uses apply_filters()       Calls 'the_content'
	 * @uses apply_filters()       Calls 'excerpt_length'
	 * @uses apply_filters()       Calls 'excerpt_more'
	 * @uses UT_Demo::trim_words() 
	 *
	 * @param string $content
	 *
	 * @return string
	 */
	public function trim_excerpt( $content ) {
		$text = strip_shortcodes( $content );

		$text = apply_filters( 'the_content', $text );
		$text = str_replace( ']]>', ']]&gt;', $text );
		$excerpt_length = apply_filters( 'excerpt_length', 55 );
		$excerpt_more = apply_filters( 'excerpt_more', ' [...]' );
		$text = $this->trim_words( $text, $excerpt_length, $excerpt_more );

		return $text;
	}
	
	/**
	 * Trim a string to a specific number of words. If the string is longer than the limit
	 * applied by $num_words, it will be cut down and autoappended with &hellip;.
	 *
	 * @param string $text
	 * @param int    $num_words
	 * @param string $null
	 */
	public function trim_words( $text, $num_words = 55, $more = null ) {
		$words_array = preg_split( "/[\n\r\t ]+/", $text, $num_words + 1, PREG_SPLIT_NO_EMPTY );
		$sep = ' ';
		
		if ( count( $words_array ) > $num_words ) {
			array_pop( $words_array );
			$text = implode( $sep, $words_array );
			$text .= $more;
		} else {
			$text = implode( $sep, $words_array );
		}
		
		return $text;
	}
}
