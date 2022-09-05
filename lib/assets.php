<?php

/**
* Styles
**/

add_action(
	'wp_enqueue_scripts',
	function () {
		wp_enqueue_style( 'font-poppins', 'https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap', false, '1' );
		wp_enqueue_style( 'font-opensans', 'https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap', false, '1' );
		wp_enqueue_style( 'app', get_template_directory_uri() . '/assets/dist/app' . wpenv() . '.css', false, '1.0.2' );
		wp_enqueue_style( 'urlslab', get_template_directory_uri() . '/assets/dist/wordpress' . wpenv() . '.css', false, '1.0.5' );

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
