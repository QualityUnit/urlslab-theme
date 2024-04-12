<?php

// * Setup variables
// */
define( 'THEME_VERSION', '2.5.46' );

/**
	* Includes
	*/

	$theme_includes = array(
		'lib/functions.php',          // Various helping functions
		'lib/helpers.php',            // Helper classes
		'lib/assets.php',             // Scripts and stylesheets
		'lib/extras.php',             // Custom functions
		'lib/setup.php',              // Theme setup
		'lib/wrapper.php',            // Theme wrapper class
		'lib/wrapper.php',            // Theme wrapper class
		'lib/cleaner/assets.php',     // Clean assets
		'lib/cleaner/comments.php',   // Disable comments
		'lib/cleaner/emojis.php',     // Disable emojis
		'lib/cleaner/oembed.php',     // Disable oembed
		'lib/cleaner/rest-api.php',   // Disable REST API for visitors
		'lib/cleaner/wordpress.php',  // Clean WordPress things
		'lib/cleaner/yoast.php',      // Clean Yoast things
		'lib/post-types.php',         // Theme Post Types
		'lib/taxonomies.php',         // Theme Taxonomies
		'lib/metaboxes.php',          // Theme Metaboxes
		'lib/shortcodes.php',          // Theme Shortcodes
		'lib/rest-api-endpoints.php',  // Rest API custom endpoints
	);

	foreach ( $theme_includes as $file ) {
		$filepath = locate_template( $file );

		if ( ! $filepath ) {
			trigger_error( sprintf( esc_html( __( 'Error locating %s for inclusion', 'urlslab' ) ), esc_url( $file ) ), E_USER_ERROR );
		}

		require_once $filepath;
	}
	unset( $file, $filepath );
