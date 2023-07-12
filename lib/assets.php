<?php

/**
* Styles
**/

add_action(
	'wp_enqueue_scripts',
	function () {
		wp_dequeue_style( 'wp-block-library' );
		wp_dequeue_style( 'elementor-custom' );

		wp_enqueue_style( 'header', get_template_directory_uri() . '/assets/dist/layouts/Header' . isrtl() . wpenv() . '.css', false, THEME_VERSION );

		if ( is_page_template( 'elementor.php' ) || is_page_template( 'front-page.php' ) || is_page_template( 'page.php' ) ) {
			wp_enqueue_style( 'elementor-layout', get_template_directory_uri() . '/assets/dist/Elementor' . isrtl() . wpenv() . '.css', false, THEME_VERSION );
		}

		if ( ! is_page_template( 'elementor.php' ) ) {
			wp_enqueue_style( 'app', get_template_directory_uri() . '/assets/dist/app' . isrtl() . wpenv() . '.css', false, THEME_VERSION );
		}
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
