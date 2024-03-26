<?php
add_filter( 'simple_register_metaboxes', 'features_metaboxes' );

function features_metaboxes( $metaboxes ) {

	$metaboxes[] = array(
		'id'        => 'features',
		'name'      => 'Attributes',
		'post_type' => array( 'features' ),
		'fields'    => array(
			array(
				'id'                => 'main',
				'label'             => 'Main article',
				'type'              => 'checkbox',
				'short_description' => 'Yes',
			),
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

add_action(
	'graphql_register_types',
	function () {
		$checkbox_config = array(
			'type'        => 'Boolean',
			'description' => 'Is Main article',
			'resolve'     => function ( $post ) {
				$checkbox = get_post_meta( $post->ID, 'main', true );
				return ! empty( $checkbox ) ? $checkbox : '';
			},
		);

		register_graphql_field( 'feature', 'main', $checkbox_config );
	}
);
