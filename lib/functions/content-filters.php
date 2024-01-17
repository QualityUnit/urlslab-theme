<?php

// Function to remove ^ in title for highlight gradient
function start_wp_head_buffer() {
	ob_start();
}
add_action( 'wp_head', 'start_wp_head_buffer', 0 );

function end_wp_head_buffer() {
	$head = ob_get_clean();

	// @codingStandardsIgnoreLine
	echo preg_replace( '/(\<title.+)\^(.+)\^(.+)/', '$1$2$3', $head );
}
add_action( 'wp_head', 'end_wp_head_buffer', PHP_INT_MAX );

/*
 * Add Trailing Slash at the end of a link
 */

function add_trailing_slash( $html ) {
	$output = preg_replace_callback(
		'/(href=\")([^"]{3,255}live[^"]{3,255}[^0-9|png|jpg|jpeg|gif|svg|pdf|docx|][^\/])(\")/i',
		function ( $matches ) {
			return $matches[1] . $matches[2] . '/' . $matches[3];
		},
		$html
	);

	return $output;
}
add_filter( 'the_content', 'add_trailing_slash', 1 );

/**
	* Lightbox Rel
	*/

function add_lightbox_rel( $content ) {
	if ( ! $content ) {
					return $content;
	}

	$dom = new DOMDocument();
	libxml_use_internal_errors( true );
	$dom->loadHTML( mb_convert_encoding( $content, 'HTML-ENTITIES', 'UTF-8' ) );
	libxml_clear_errors();
	$xpath = new DOMXPath( $dom );

	foreach ( $xpath->query( '//a' )    as  $link ) {
		$link_href = $link->getAttribute( 'href' );
		if ( $link_href && verify_image_link( $link_href ) ) {
						$link->setAttribute( 'data-lightbox', 'gallery' );
		}
	}

	$dom->removeChild( $dom->doctype );
	$content = $dom->saveHtml();
	$content = str_replace( '<html><body>', '', $content );
	$content = str_replace( '</body></html>', '', $content );
	return $content;
}

add_filter( 'the_content', 'add_lightbox_rel' );
