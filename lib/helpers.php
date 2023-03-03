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


/**
	* Inserts SVG icons before first child or at the end (icn-after-fragment selector) of the selector (icn-)
	*/
function insert_svg_icons( $content ) {

	if ( ! $content ) {
		return $content;
	}

	$dom = new DOMDocument();
	libxml_use_internal_errors( true );
	$dom->loadHTML( mb_convert_encoding( $content, 'HTML-ENTITIES', 'UTF-8' ) );
	libxml_clear_errors();
	$xpath      = new DOMXPath( $dom );
	$iconblocks = $xpath->query( ".//*[contains(@class, 'icn-')]" );

	// @codingStandardsIgnoreStart
	foreach ( $iconblocks as $icon ) {
		$class = $icon->getAttribute('class');
		preg_match( '/icn-(after-)?([^ ]+)/i', $class, $class_fragment );
		if ( isset ( $class_fragment[2] ) ) {
			$fragment = $class_fragment[2];
			$svg = $dom->createDocumentFragment();
			$svg->appendXML( '<svg class="icon icon-' . $fragment . '"><use xlink:href="' . get_template_directory_uri() . '/assets/images/icons.svg?ver=' . THEME_VERSION . '#' . $fragment . '"></use></svg>' );
			if ( ! str_contains( $class, 'icn-after' ) and $icon !== $svg ) {
				$icon->insertBefore( $svg, $icon->firstChild );
			}
			if ( str_contains( $class, 'icn-after' ) and $icon !== $svg ) {
				$icon->appendChild( $svg );
			}
		}
	}
	// @codingStandardsIgnoreEnd

	$dom->removeChild( $dom->doctype );
	$content = $dom->saveHtml();
	$content = str_replace( '<html><body>', '', $content );
	$content = str_replace( '</body></html>', '', $content );
	return $content;
}
