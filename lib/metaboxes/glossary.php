<?php
add_filter( 'simple_register_metaboxes', 'glossary_metaboxes' );

function glossary_metaboxes( $metaboxes ) {

	$metaboxes[] = array(
		'id'        => 'glossary',
		'name'      => 'Attributes',
		'post_type' => array( 'glossary' ),
		'fields'    => array(
			array(
				'id'                => 'chatbot',
				'label'             => 'ChatBot article',
				'type'              => 'checkbox',
				'short_description' => 'Yes',
			),
		),
	);
 
	return $metaboxes;
}
