<?php

function components_imports( $content ) {
	$blocks = array(
		'Block__red'                    => 'components/BlockRed',
		'Block__meet'                   => 'components/BlockMeet',
		'Block__improve'                => 'components/BlockImprove',
		'Block__illustration'           => 'components/BlockIllustration',
		'table'                         => 'components/Table',
		'Modules'                       => 'components/BlockModules',
		'FormIcons'                     => 'components/FormIcons',
		'urlslab-block-tableofcontents' => 'components/UrlslabTOC',
	);

	if ( ! $content ) {
		return $content;
	}

	$dom = new DOMDocument();
	libxml_use_internal_errors( true );
	$dom->loadHTML( mb_convert_encoding( $content, 'HTML-ENTITIES', 'UTF-8' ) );
	libxml_clear_errors();
	$xpath = new DOMXPath( $dom );
	
	foreach ( $blocks as $class => $csspath ) {
		$id           = strtolower( $class );
		$found_blocks = $xpath->query( './/*[contains(@class, "' . $class . '")]' );
	
		if ( isset( $found_blocks[0] ) || ( isset( $_GET['action'] ) && ( 'edit' === $_GET['action'] || 'elementor' === $_GET['action'] ) ) ) {
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
