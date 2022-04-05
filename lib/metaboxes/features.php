<?php
add_filter( 'simple_register_metaboxes', 'features_metaboxes' );

function features_metaboxes( $metaboxes ) {

	$metaboxes[] = array(
		'id'        => 'my_metabox',
		'name'      => 'Meta Box',
		'post_type' => array( 'features' ),
		'fields'    => array(
			array(
				'id'    => 'feature_custom_text',
				'label' => 'Label',
				'type'  => 'text',
			),
			array(
				'id'                => 'feature_custom_checkbox',
				'label'             => 'Label',
				'type'              => 'checkbox',
				'short_description' => 'Yes',
			),
		),
	);
 
	return $metaboxes;
}

add_action(
	'graphql_register_types',
	function() {

		$textfield_config = array(
			'type'        => 'String',
			'description' => 'Custom Feature text field',
			'resolve'     => function( $post ) {
				$textfield = get_post_meta( $post->ID, 'feature_custom_text', true );
				return ! empty( $textfield ) ? $textfield : '';
			},
		);
		$checkbox_config  = array(
			'type'        => 'Boolean',
			'description' => 'Custom Feature checkbox',
			'resolve'     => function( $post ) {
				$checkbox = get_post_meta( $post->ID, 'feature_custom_checkbox', true );
				return ! empty( $checkbox ) ? $checkbox : '';
			},
		);

		register_graphql_field( 'feature', 'feature_custom_text', $textfield_config );
		register_graphql_field( 'feature', 'feature_custom_checkbox', $checkbox_config );
	}
);
