<?php

add_action(
	'init',
	function () {
		$labels  = array(
			'name'           => _x( 'Documentation', 'Post Type General Name', 'urlslab' ),
			'singular_name'  => _x( 'Doc', 'Post Type Singular Name', 'urlslab' ),
			'menu_name'      => __( 'Documentation', 'urlslab' ),
			'name_admin_bar' => __( 'Doc', 'urlslab' ),
		);
		$rewrite = array(
			'slug'       => 'documentation',
			'with_front' => true,
			'pages'      => true,
			'feeds'      => false,
		);
		$args    = array(
			'label'               => __( 'Doc', 'urlslab' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
			'hierarchical'        => true,
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
			'graphql_single_name' => 'document',
			'graphql_plural_name' => 'documentation',
		);
		register_post_type( 'documentation', $args );
	},
	0
);
