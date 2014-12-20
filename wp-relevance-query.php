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
		$this->modify_posts_array();
	}

	/************************************************
	 * Query Methods
	 ************************************************/

	/**
	 * Primary Query modification method
	 *
	 * @return void
	 */
	private function modify_posts_array() {

		// Add data to post objects
		$this->add_posts_terms();
		$this->add_posts_relevance();

		// Order the posts
		$this->order_posts();

	}

	/************************************************
	 * Post Data Methods
	 ************************************************/

	/**
	 * Add terms as array to each post
	 *
	 * The whole term object is added for use in templates
	 * (We're querying the post terms now, might as well avoid doing it again later)
	 *
	 * @return void
	 */
	private function add_posts_terms() {

		foreach ( $this->posts as $post ) {
			$post->terms = $this->get_post_terms();
		}

	}

	/**
	 * Get post terms
	 *
	 * @return array
	 * 
	 * @todo Needs to be modified to add multiple taxonomies
	 */
	private function get_post_terms() {

			$taxonomy = ''; // TODO
			$terms = array();
			$terms = get_the_terms( $post->ID, $taxonomy );
			
			return $terms;

	}

	/**
	 * Add relevance to post object
	 *
	 * @return void
	 */
	private function add_posts_relevance() {

		foreach ( $this->posts as $post ) {
			$post->relevance = $this->calculate_post_relevance();
		}

	}

	/**
	 * Calculate post relevance
	 *
	 * @return integer
	 *
	 * @todo: Needs to be modified to add multiple taxonomies
	 */
	private function calculate_post_relevance() {

		$relevance = 0;
		$terms = wp_list_pluck( $post->terms, 'term_id' );

		foreach ( $interests as $interest ){

			if ( in_array( $interest, $terms ) ){
				$relevance ++;
			}
		}

		return $relevance;
	}

	/************************************************
	 * Sorting Methods
	 ************************************************/

	/**
	 * Order posts
	 *
	 * @return void
	 *
	 * @todo Needs modification for secondary sorting options
	 */
	private function order_posts() {

		$posts = $this->posts;

		// Loop through posts and add sorting flags
		foreach( $posts as $post => $object ){
			$relevance[$post] = $object->relevance;
			$post_date[$post] = $object->post_date;
		}

		// holy cow, this is magic
		array_multisort( $relevance, SORT_NUMERIC, SORT_DESC, $post_date, SORT_STRING, SORT_DESC, $posts );

		$this->posts = $posts;
	}

}
