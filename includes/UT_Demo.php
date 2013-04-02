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
	 * @uses apply_filters()    Calls 'the_content'
	 * @uses apply_filters()    Calls 'excerpt_length'
	 * @uses apply_filters()    Calls 'excerpt_more'
	 * @uses wp_trim_words()
	 *
	 * @param string $content
	 *
	 * @return string
	 */
	public function trim_excerpt( $content ) {
		$text = strip_shortcodes( $content );

		$text = apply_filters( 'the_content', $text );
		$text = str_replace(']]>', ']]&gt;', $text);
		$excerpt_length = apply_filters('excerpt_length', 55);
		$excerpt_more = apply_filters('excerpt_more', ' [...]');
		$text = wp_trim_words( $text, $excerpt_length, $excerpt_more );

		return $text;
	}
}
