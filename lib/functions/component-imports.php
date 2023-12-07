<?php

function components_imports( $content ) {
	$blocks = array(
		'FormIcons' => 'components/FormIcons',
		'urlslab-block-tableofcontents' => 'components/UrlslabTOC',
	);

	if ( ! $content ) {
		return $content;
	}

	$dom = new DOMDocument();
	libxml_use_internal_errors( true );
	$dom->loadHTML( mb_convert_encoding( $content, 'HTML-ENTITIES', 'UTF-8' ) );
	libxml_clear_errors();
	$xpath       = new DOMXPath( $dom );
	
	foreach ( $blocks as $class => $csspath ) {
		$id = strtolower( $class );
		$found_blocks = $xpath->query( './/*[contains(@class, "' . $class . '")]' );
	
		if ( isset( $found_blocks[0] ) || is_user_logged_in() ) {
			wp_enqueue_style( $id, get_template_directory_uri() . '/assets/dist/' . $csspath . isrtl() . wpenv() . '.css', false, THEME_VERSION );
		}
	}

	$dom->removeChild( $dom->doctype );
	$content = $dom->saveHtml();
	$content = str_replace( '<html><body>', '', $content );
	$content = str_replace( '</body></html>', '', $content );
	return $content;
}

add_filter( 'the_content', 'components_imports' );
add_action( 'admin_enqueue_scripts', 'components_imports' );
