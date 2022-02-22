<?php

/**
  * Get WP_ENV
  */

function wpenv() {
	$min = '';

	if ( WP_ENV === 'production' ) {
		$min = '.min';
	}

	return $min;
}


/**
 * Removes Search and related direct queries
 */

function remove_search( $query, $error = true ) {

	if ( is_search() && ! is_user_logged_in() ) {
		$query->is_search = false;

		if ( true === $error ) {
			wp_safe_redirect( '/', 301 );
			exit;
		}

		exit;
	}
}

add_action( 'parse_query', 'remove_search' );
