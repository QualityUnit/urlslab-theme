<?php

add_action(
	'init',
	function () {
		$labels = array(
			'name'          => _x( 'About Categories', 'Taxonomy General Name', 'urlslab' ),
			'singular_name' => _x( 'About Category', 'Taxonomy Singular Name', 'urlslab' ),
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
		);
		register_taxonomy( 'about_categories', array( 'about' ), $args );
	},
	0
);
