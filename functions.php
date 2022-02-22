<?php
/**
	* Sage includes
	*/

	require_once get_template_directory() . '/lib/extras.php';
	require_once get_template_directory() . '/lib/setup.php';
	require_once get_template_directory() . '/lib/wrapper.php';
	require_once get_template_directory() . '/lib/cleaner.php';


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


/**
	* Import Custom Post Types
	*/

	// require_once get_template_directory() . '/lib/post-types/xxx.php';


/**
	* Import Custom Taxonomies
	*/

	// require_once get_template_directory() . '/lib/taxonomies/xxx.php';


/**
	* Import Metaboxes
	*/

	// require_once get_template_directory() . '/lib/metaboxes/xxx.php';


/**
	* Import ShortCodes
	*/

	// require_once get_template_directory() . '/lib/shortcodes/xxx.php';
