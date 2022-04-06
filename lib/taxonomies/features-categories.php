<?php

add_action(
	'init',
	function () {
		$labels = array(
			'name'          => _x( 'Features Categories', 'Taxonomy General Name', 'ms' ),
			'singular_name' => _x( 'Features Category', 'Taxonomy Singular Name', 'ms' ),
			'menu_name'     => __( 'Categories', 'ms' ),
		);
		$args   = array(
			'labels'            => $labels,
			'hierarchical'      => true,
			'hierarchical'        => true,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => false,
			'show_in_rest'      => true,
			'show_in_graphql'     => true,
			'graphql_single_name' => 'category',
			'graphql_plural_name' => 'categories',
		);
		register_taxonomy( 'features_categories', array( 'features' ), $args );
	},
	0
);
