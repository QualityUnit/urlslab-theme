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

// Check if RTL (arabic, hebrew, etc.)
function isrtl() {
	$rtl = '';

	if ( is_rtl() ) {
		// We only have .min RTL CSS, so adding .min if not in production, not adding (as we have this covered) in prd
		$rtl = '-rtl' . ( WP_ENV === 'production' ? '' : '.min' );
	}

	return $rtl;
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
	* add arrow icon class into link inside of learn-more
	*/

function elementor_learnmore( $content ) {
	if ( ! $content ) {
		return $content;
	}

	$dom = new DOMDocument();
	libxml_use_internal_errors( true );
	$dom->loadHTML( mb_convert_encoding( $content, 'HTML-ENTITIES', 'UTF-8' ) );
	libxml_clear_errors();
	$xpath    = new DOMXPath( $dom );
	$elements = get_nodes( $xpath, 'learn-more' );
	foreach ( $elements as $element ) {
		foreach ( $element->getElementsByTagName( 'a' ) as $link ) {
			add_class_to_node( $link, array( 'icn-after-arrow-right' ) );
		}
	}
	$dom->removeChild( $dom->doctype );
	$content = $dom->saveHtml();
	$content = str_replace( '<html><body>', '', $content );
	$content = str_replace( '</body></html>', '', $content );
	return $content;
}
add_filter( 'the_content', 'elementor_learnmore' );

/**
	* add Play button to Module with data-ytid and data-lightbox=youtube attributes
	*/

function elementor_playbtn( $content ) { 
	if ( ! $content ) {
		return $content;
	}

	$dom = new DOMDocument();
	libxml_use_internal_errors( true );
	$dom->loadHTML( mb_convert_encoding( $content, 'HTML-ENTITIES', 'UTF-8' ) );
	libxml_clear_errors();
	$xpath    = new DOMXPath( $dom );
	$elements = get_nodes( $xpath, 'Module' );
	foreach ( $elements as $element ) {
		$titles_parents = $element->getElementsByTagName( 'div' );
		foreach ( $titles_parents as $parent ) {
			$hasvideo = $parent->getAttribute( 'data-ytid' );
			if ( ! empty( $hasvideo ) ) {
				$title = $element->getElementsByTagName( 'h2' )[0];
				$play_btn = $dom->createElement( 'span', htmlspecialchars( __( 'Play video', 'urslab' ) ) );
				$play_btn->setAttribute( 'class', 'play' );
				$title->appendChild( $play_btn );
			}
		}
	}
	$dom->removeChild( $dom->doctype );
	$content = $dom->saveHtml();
	$content = str_replace( '<html><body>', '', $content );
	$content = str_replace( '</body></html>', '', $content );
	return $content;
}
add_filter( 'the_content', 'elementor_playbtn' );

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

add_filter( 'the_content', 'insert_svg_icons' );


/**
	* Show description and icons in navigation
	*/

function show_description_header_nav( $item_output, $item, $depth, $args ) {
	$item_classes = $item->classes;
	if ( ! empty( $item->description ) ) {
		$item_output = str_replace( $args->link_after . '</a>', '<div class="menu-item-description">' . $item->description . '</div>' . $args->link_after . '</a>', $item_output );
	}

	if ( in_array( 'label-overview', $item->classes ) ) {
		$item_output .= '
		<div data-ytid="aZG9H8suCcg" data-lightbox="youtube" style="margin-top:1em;padding-right:3em;cursor:pointer" class="Header__navigation__promo">
			<img src="' . get_template_directory_uri() . '/assets/images/tour_video_icon.png" alt="LiveAgent Tour Video" />' . '
		</div>
		<script>
			(
				() => {
					const tourVideo = document.querySelector("li > .Header__navigation__promo");
					if(tourVideo) {
						const parent = tourVideo.closest("li").querySelector("a");
						parent.insertAdjacentElement("beforeend", tourVideo);
					}
				}
			)();
		</script>';
	}

	// Adds SVG icons to the menu instead of :before
	foreach ( $item_classes as $class ) {
		if ( str_contains( $class, 'icn-' ) ) {
			$fragment    = preg_replace( '/^icn-(.+?)/', '$1', $class );
			$item_output = '<svg class="icon icon-' . $fragment . '"><use xlink:href="' . get_template_directory_uri() . '/assets/images/icons.svg?ver=' . THEME_VERSION . '#' . $fragment . '"></use></svg>' . $item_output;
		}
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'show_description_header_nav', 10, 4 );


/**
 * Include Documentation search template
 */

function documentation_search( $template ) {
	global $wp_query;
	$post_type = get_query_var( 'post_type' );
	if ( ! empty( $wp_query->is_search ) && 'documentation' === $post_type ) {
		return locate_template( 'documentation-search.php' );  //  redirect to custom-post-type-search.php
	}

	return $template;
}
add_filter( 'template_include', 'documentation_search' );
