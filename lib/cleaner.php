<?php

/**
	* Remove info about WPML in head
	*/

if ( ! empty( $GLOBALS['sitepress'] ) ) {
	function remove_wpml_version_info() {
			remove_action(
				current_filter(),
				array( $GLOBALS['sitepress'], 'meta_generator_tag' )
			);
	}
	add_action( 'wp_head', 'remove_wpml_version_info', 0 );
}


/**
	* Disable powered by text of Yoast SEO
	*/

add_action(
	'template_redirect',
	function () {
		if ( ! class_exists( 'WPSEO_Frontend' ) ) {
			return;
		}

		$instance = WPSEO_Frontend::get_instance();

		if ( ! method_exists( $instance, 'debug_mark' ) ) {
			return;
		}

		remove_action( 'wpseo_head', array( $instance, 'debug_mark' ), 2 );
	},
	9999
);

/**
	* Remove info about WordPress in head
	*/

	remove_action( 'wp_head', 'wp_generator' );


/**
	* Remove links to the extra feeds (e.g. category feeds)
	*/

	remove_action( 'wp_head', 'feed_links_extra', 3 );


/**
	* Remove links to the general feeds (e.g. posts and comments)
	*/

	remove_action( 'wp_head', 'feed_links', 2 );


/**
	* Remove link to the RSD service endpoint, EditURI link
	*/

	remove_action( 'wp_head', 'rsd_link' );


/**
	* Remove link to the Windows Live Writer manifest file
	*/

	remove_action( 'wp_head', 'wlwmanifest_link' );


/**
	* Disable the emojis
	*/

function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
	add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'disable_emojis' );

function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
	if ( 'dns-prefetch' === $relation_type ) {
		$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
		$urls          = array_diff( $urls, array( $emoji_svg_url ) );
	}

	return $urls;
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
	* Disable XML-RPC
	*/

add_filter( 'xmlrpc_enabled', '__return_false' );


/**
	* Disable REST API
	*/

if ( ! is_user_logged_in() ) {
	add_filter( 'rest_authentication_errors', 'wp_snippet_disable_rest_api' );
	function wp_snippet_disable_rest_api( $access ) {
			return new WP_Error( 'rest_disabled', __( 'The WordPress REST API has been disabled.' ), array( 'status' => rest_authorization_required_code() ) );
	}
}


/**
	* Fix showing of users in REST API
	*/

if ( ! is_user_logged_in() ) {
	add_filter(
		'rest_endpoints',
		function ( $endpoints ) {
			if ( isset( $endpoints['/wp/v2/users'] ) ) {
				unset( $endpoints['/wp/v2/users'] );
			}
			if ( isset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] ) ) {
				unset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] );
			}
			return $endpoints;
		}
	);
}


/**
	* Disable oEmbed
	*/

function disable_embeds_code_init() {
	// Remove the REST API endpoint.
	remove_action( 'rest_api_init', 'wp_oembed_register_route' );

	// Turn off oEmbed auto discovery.
	add_filter( 'embed_oembed_discover', '__return_false' );

	// Don't filter oEmbed results.
	remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );

	// Remove oEmbed discovery links.
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

	// Remove oEmbed-specific JavaScript from the front-end and back-end.
	remove_action( 'wp_head', 'wp_oembed_add_host_js' );
	add_filter( 'tiny_mce_plugins', 'disable_embeds_tiny_mce_plugin' );

	// Remove all embeds rewrite rules.
	add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );

	// Remove filter of the oEmbed result before any HTTP requests are made.
	remove_filter( 'pre_oembed_result', 'wp_filter_pre_oembed_result', 10 );
}

add_action( 'init', 'disable_embeds_code_init', 9999 );

function disable_embeds_tiny_mce_plugin( $plugins ) {
	return array_diff( $plugins, array( 'wpembed' ) );
}

function disable_embeds_rewrites( $rules ) {
	foreach ( $rules as $rule => $rewrite ) {
		if ( false !== strpos( $rewrite, 'embed=true' ) ) {
			unset( $rules[ $rule ] );
		}
	}

	return $rules;
}


/**
	* Completely Disable Comments
	*/

// Disable support for comments and trackbacks in post types
function disable_comments_post_types_support() {
	$post_types = get_post_types();

	foreach ( $post_types as $post_type ) {
		if ( post_type_supports( $post_type, 'comments' ) ) {
			remove_post_type_support( $post_type, 'comments' );
			remove_post_type_support( $post_type, 'trackbacks' );
		}
	}
}
add_action( 'admin_init', 'disable_comments_post_types_support' );

// Close comments on the front-end
function disable_comments_status() {
	return false;
}
add_filter( 'comments_open', 'disable_comments_status', 20, 2 );
add_filter( 'pings_open', 'disable_comments_status', 20, 2 );

// Hide existing comments
function disable_comments_hide_existing_comments( $comments ) {
	$comments = array();
	return $comments;
}
add_filter( 'comments_array', 'disable_comments_hide_existing_comments', 10, 2 );

// Remove comments page in menu
function disable_comments_admin_menu() {
	remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'disable_comments_admin_menu' );

// Redirect any user trying to access comments page
function disable_comments_admin_menu_redirect() {
	global $pagenow;

	if ( 'edit-comments.php' === $pagenow ) {
		wp_safe_redirect( admin_url() );
		exit;
	}
}
add_action( 'admin_init', 'disable_comments_admin_menu_redirect' );

// Remove comments metabox from dashboard
function disable_comments_dashboard() {
	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
}
add_action( 'admin_init', 'disable_comments_dashboard' );

// Remove comments links from admin bar
function remove_comments_item_admin_bar() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu( 'comments' );
}
add_action( 'wp_before_admin_bar_render', 'remove_comments_item_admin_bar' );
