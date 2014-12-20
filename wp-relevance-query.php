<?php
/**
 * Plugin Name:       WP Relevance Query
 * Plugin URI:        http://mannieschumpert.com/plugins/wp-relevance-query/
 * Description:       Extends WP_Query to allow for post queries sorted by relevance.
 * Version:           0.0.1
 * Author:            Mannie Schumpert
 * Author URI:        http://mannieschumpert.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Initiate class
 */
class WP_Relevance_Query extends WP_Query {
  
	function __construct( $args = array() ) {

		parent::__construct( $args );
		$this->posts = $this->get_ordered_posts( $this->posts, $args );
	}

	/************************************************
	 * Query Methods
	 ************************************************/

	private function get_ordered_posts( $posts, $args ) {
	/**
	 * Primary Query modification method
	 *
	 * @return void
	 */

		// Add data to post objects
		$posts = $this->add_posts_terms( $posts, $args );
		$posts = $this->add_posts_relevance( $posts, $args );

		// Order the posts
		$posts = $this->order_posts( $posts, $args );

		return $posts;
	}
	
	private function order_posts( $posts, $args ) {

		return $posts;
	}

	/************************************************
	 * Post Data Methods
	 ************************************************/

	private function add_posts_terms( $posts, $args ) {
	/**
	 * Add terms as array to each post
	 *
	 * The whole term object is added for use in templates
	 * (We're querying the post terms now, might as well avoid doing it again later)
	 *
	 * @return void
	 */

		foreach ( $posts as $post ) {
			// get terms
			$post->terms = $this->get_post_terms();
		}

		return $posts;
	}

	/**
	 * Get post terms
	 *
	 * @return array
	 */
	private function get_post_terms() {

	}

	private function add_posts_relevance( $posts, $args ) {
	/**
	 * Add relevance to post object
	 *
	 * @return void
	 */

		foreach ( $posts as $post ) {
			$post->relevance = $this->calculate_post_relevance( $post, $args );
		}

		return $posts;
	}

	private function calculate_post_relevance( $post, $args ) {
	/**
	 * Calculate post relevance
	 *
	 * @return integer
	 */
	/**
	 * Order posts
	 *
	 * @return void
	 */

	}
}
