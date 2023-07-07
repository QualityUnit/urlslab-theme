<?php

add_action(
	'init',
	function () {
		$labels  = array(
			'name'           => _x( 'Videos', 'Post Type General Name', 'urlslab' ),
			'singular_name'  => _x( 'Video', 'Post Type Singular Name', 'urlslab' ),
			'menu_name'      => __( 'Videos', 'urlslab' ),
			'name_admin_bar' => __( 'Videos', 'urlslab' ),
		);
		$rewrite = array(
			'slug'       => 'videos',
			'with_front' => true,
			'pages'      => true,
			'feeds'      => false,
		);
		$args    = array(
			'label'               => __( 'Videos', 'urlslab' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
			'hierarchical'        => true,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 52,
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
			'graphql_single_name' => 'video',
			'graphql_plural_name' => 'videos',
		);
		register_post_type( 'videos', $args );
	},
	0
);
