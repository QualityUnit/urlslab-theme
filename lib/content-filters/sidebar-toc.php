<?php


//Add ID to every H2 element in post/page that has no ID. Generated from sanitized text content of element
function add_id_to_h2( $html ) {
	$html = preg_replace_callback(
		'/\<h2( id=".+?")?\>(.+?)\<\/h2\>/',
		function ( $m ) {
			return '<h2 id="h-' . preg_replace( '/[%\/\:]/i', '', sanitize_title( $m[2] ) ) . '">' . $m[2] . '</h2>';
		},
		$html
	);

	$html = preg_replace_callback(
		'/\<h2(((?!id).).+?)\>(.+?)\<\/h2\>/',
		function ( $m ) {
			return '<h2 ' . $m[1] . ' id="h-' . preg_replace( '/[%\/]/i', '', sanitize_title( $m[3] ) ) . '">' . $m[3] . '</h2>';
		},
		$html
	);

	$html = preg_replace_callback(
		'/\<h3( id=".+?")?\>(.+)\<\/h3\>/',
		function ( $m ) {
			return '<h3 id="h-' . preg_replace( '/[%\/\:]/i', '', sanitize_title( $m[2] ) ) . '">' . $m[2] . '</h3>';
		},
		$html
	);

	return $html;
}
add_filter( 'the_content', 'add_id_to_h2', 99 );
