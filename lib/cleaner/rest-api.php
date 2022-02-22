<?php


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
