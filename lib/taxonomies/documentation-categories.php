<?php

add_action(
	'init',
	function () {
		$labels = array(
			'name'          => _x( 'Documentation Categories', 'Taxonomy General Name', 'ms' ),
			'singular_name' => _x( 'Doc Category', 'Taxonomy Singular Name', 'ms' ),
			'menu_name'     => __( 'Categories', 'ms' ),
		);
		$args   = array(
			'labels'            => $labels,
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => false,
			'show_in_rest'      => true,
			'show_in_graphql'     => true,
			'graphql_single_name' => 'documentationCategory',
			'graphql_plural_name' => 'documentationCategories',
		);
		register_taxonomy( 'documentation_categories', array( 'documentation' ), $args );
	},
	0
);
