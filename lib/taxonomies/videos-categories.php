<?php

add_action(
	'init',
	function () {
		$labels = array(
			'name'          => _x( 'Videos Categories', 'Taxonomy General Name', 'urlslab' ),
			'singular_name' => _x( 'Videos Category', 'Taxonomy Singular Name', 'urlslab' ),
			'menu_name'     => __( 'Categories', 'urlslab' ),
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
			'graphql_single_name' => 'videoCategory',
			'graphql_plural_name' => 'videoCategories',
		);
		register_taxonomy( 'videos_categories', array( 'videos' ), $args );
	},
	0
);
