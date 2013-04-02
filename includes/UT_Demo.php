<?php
/**
 * Core functionality for the Unit Test Demo Plugin
 */
class UT_Demo {
	/**
	 * Grab a post from the database at random.
	 *
	 * @uses get_posts()
	 *
	 * @return object
	 */
	public function get_post_of_the_day() {
		// Attempt to fetch the post of the day from a transient.
		$post = get_transient( 'utdemo_post_of_the_day' );

		if ( false === $post ) {
			$args = array(
				'numberposts' => 1,      // Select only one post
				'orderby'     => 'rand', // Select the post at random
				'post_type'   => 'post'  // Only request regular posts
			);

			$posts = get_posts( $args );

			// Return the first post in the array
			$post = $posts[0];

			// Store the result in a transient for 24 hours so that we don't keep querying
			set_transient( 'utdemo_post_of_the_day', $post, 60 * 60 * 24 );
		}

		return $post;
	}
	
	/**
	 * Trim an excerpt down to size.
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
		$excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
		$text = wp_trim_words( $text, $excerpt_length, $excerpt_more );

		return $text;
	}
}
