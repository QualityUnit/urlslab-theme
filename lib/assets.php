<?php

/**
* Styles
**/

add_action(
	'wp_enqueue_scripts',
	function () {
		wp_enqueue_style( 'app', get_template_directory_uri() . '/assets/dist/app' . wpenv() . '.css', false, THEME_VERSION );
		wp_enqueue_style( 'urlslab', get_template_directory_uri() . '/assets/dist/wordpress' . wpenv() . '.css', false, THEME_VERSION );

		wp_deregister_script( 'wp-embed' );
	},
	100
);


/**
 * Scripts
 */

add_action(
	'wp_footer',
	function () {
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'app_js', get_template_directory_uri() . '/assets/dist/app' . wpenv() . '.js', false, '1.0.2', true );
	}
);
