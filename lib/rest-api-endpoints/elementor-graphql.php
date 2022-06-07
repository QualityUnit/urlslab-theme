<?php

add_action(
	'graphql_register_types',
	function () {
		register_graphql_field(
			'Page',
			'elementorData',
			array(
				'type'        => 'String',
				'description' => __( 'Elementor Data JSON', 'wp-graphql' ),
				'resolve'     => function ( $post ) {
					$data = get_post_meta( $post->ID, '_elementor_data', true );
					return ! empty( $data ) ? $data : null;
				},
			)
		);
	}
);
