<?php

add_action(
	'init',
	function () {
		$labels  = array(
			'name'           => _x( 'Features', 'Post Type General Name', 'urlslab' ),
			'singular_name'  => _x( 'Feature', 'Post Type Singular Name', 'urlslab' ),
			'menu_name'      => __( 'Features', 'urlslab' ),
			'name_admin_bar' => __( 'Feature', 'urlslab' ),
		);
		$rewrite = array(
			'slug'       => 'features',
			'with_front' => true,
			'pages'      => true,
			'feeds'      => false,
		);
		$args    = array(
			'label'               => __( 'Feature', 'urlslab' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 30,
			'menu_icon'           => 'dashicons-book',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'capability_type'     => 'post',
			'show_in_rest'        => true,
			'show_in_graphql'     => true,
			'graphql_single_name' => 'feature',
			'graphql_plural_name' => 'features',
		);
		register_post_type( 'features', $args );
	},
	0
);
