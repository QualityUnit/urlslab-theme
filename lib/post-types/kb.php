<?php

add_action(
	'init',
	function () {
		$labels  = array(
			'name'           => _x( 'Knowledge Base', 'Post Type General Name', 'urlslab' ),
			'singular_name'  => _x( 'Knowledge Base', 'Post Type Singular Name', 'urlslab' ),
			'menu_name'      => __( 'Knowledge Base', 'urlslab' ),
			'name_admin_bar' => __( 'Knowledge Base', 'urlslab' ),
		);
		$rewrite = array(
			'slug'       => 'kb',
			'with_front' => true,
			'pages'      => true,
			'feeds'      => false,
		);
		$args    = array(
			'label'               => __( 'Knowledge Base', 'urlslab' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'page-attributes' ),
			'hierarchical'        => true,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 30,
			'menu_icon'           => 'dashicons-book',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'capability_type'     => 'page',
			'show_in_rest'        => true,
			'show_in_graphql'     => true,
			'graphql_single_name' => 'kb',
			'graphql_plural_name' => 'kbs',
		);
		register_post_type( 'kb', $args );
	},
	0
);
