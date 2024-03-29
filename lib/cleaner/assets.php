<?php

/**
	* Clean Elementor
	*/

add_action(
	'wp_print_styles',
	function () {
		if ( ! is_user_logged_in() ) {
				wp_dequeue_style( 'font-awesome' );
				wp_dequeue_style( 'font-awesome-5-all' );
				wp_dequeue_style( 'font-awesome-4-shim' );
				wp_deregister_style( 'elementor-icons-shared-0' );
				wp_deregister_style( 'elementor-icons' );
				wp_deregister_style( 'elementor-icons-fa-brands' );
				wp_deregister_style( 'elementor-animations' );
				wp_deregister_style( 'elementor-lazyload' );
				wp_deregister_style( 'wp-nux' );
				wp_deregister_style( 'wpml-legacy-horizontal-list-0' );

				// Call for Roboto font internal Elementor
				wp_dequeue_style( 'google-fonts-1' );

				// Scripts
				wp_dequeue_script( 'font-awesome-4-shim' );
				wp_deregister_script( 'elementor-sticky' );
				wp_deregister_script( 'wpml-xdomain-data' );
				wp_deregister_script( 'wpml-xdomain-data-js-extra' );
		}
	},
	999
);

add_action(
	'elementor/frontend/after_enqueue_styles',
	function () {
		if ( ! is_user_logged_in() ) {
			wp_deregister_style( 'elementor' );
			wp_deregister_style( 'elementor-frontend' );
			wp_deregister_style( 'elementor-pro' );
			wp_deregister_style( 'elementor-pro-frontend' );

			wp_register_style( 'elementor-frontend', get_template_directory_uri() . '/assets/dist/common/elementor-custom' . isrtl() . wpenv() . '.css', false, THEME_VERSION );
			wp_enqueue_style( 'elementor-frontend' );

			wp_deregister_script( 'wp-embed' );
		}
	},
	1000
);

// Removes unwanted CSS and JS files which are loaded without hook
function callback( $buffer ) {
	// Adding unique character to allow non greedy regex
	$buffer = str_replace( '<script', '≤<script', $buffer );
	$buffer = str_replace( '<link', '≤<link', $buffer );

	// Elementor plugin JS
	$buffer = preg_replace( '/<script[^\≤]+preloaded-modules[^\≤]+<\/script>/', '', $buffer );
	$buffer = preg_replace( '/<script[^\≤]+preloaded-elements[^\≤]+<\/script>/', '', $buffer );
	$buffer = preg_replace( '/<script[^\≤]+elementor-pro\/[^\≤]+frontend[^\≤]+<\/script>/', '', $buffer );
	$buffer = preg_replace( '/<script[^\≤]+elementor\/[^\≤]+frontend[^\≤]+<\/script>/', '', $buffer );

	// WP Scripts
	$buffer = preg_replace( '/<script[^\≤]+dist\/vendor\/wp-polyfill[^\≤]+>/', '', $buffer );

	// JS for Babel async transpiling for old browsers like IE
	$buffer = preg_replace( '/<script[^\≤]+dist\/vendor\/regenerator-runtime[^\≤]+>/', '', $buffer );

	// Removing unique character for final output
	$buffer = str_replace( '≤<script', '<script', $buffer );
	$buffer = str_replace( '≤<link', '<link', $buffer );
	$buffer = str_replace( '≤', '', $buffer );
	return $buffer;
}

function buffer_start() {
	ob_start( 'callback' ); }

function buffer_end() {
	ob_get_clean();
}

if ( ! is_user_logged_in() ) {
	add_action( 'after_setup_theme', 'buffer_start' );
	add_action( 'shutdown', 'buffer_end' );
}

/**
  * Remove jQuery Migrate
  */

function remove_jquery_migrate( $scripts ) {
	if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
		$script = $scripts->registered['jquery'];

		if ( $script->deps ) {
			$script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
		}
	}
}
add_action( 'wp_default_scripts', 'remove_jquery_migrate' );


/**
  * Remove global styles
  */

function wps_deregister_styles() {
	wp_dequeue_style( 'global-styles' );
}
add_action( 'wp_enqueue_scripts', 'wps_deregister_styles', 100 );

/**
 * Add Missing Style to Gutenberg
 */

function add_style_to_gutenberg() {
	echo '<style>@import "/wp/wp-includes/css/dist/edit-post/classic.min.css";</style>';
}
add_action( 'admin_head', 'add_style_to_gutenberg' );
