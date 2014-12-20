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

	private function get_ordered_posts( $posts ) {

		return $posts;
	}
}
