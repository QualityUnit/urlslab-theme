<?php

add_action(
	'init',
	function () {
		$labels  = array(
			'name'           => _x( 'Guide LP', 'Post Type General Name', 'urlslab' ),
			'singular_name'  => _x( 'Guide LP', 'Post Type Singular Name', 'urlslab' ),
			'menu_name'      => __( 'Guide LPs', 'urlslab' ),
			'name_admin_bar' => __( 'Guide LP', 'urlslab' ),
		);
		$rewrite = array(
			'slug'       => 'guide',
			'with_front' => false,
			'pages'      => false,
			'feeds'      => false,
		);
		$args    = array(
			'label'               => __( 'Guide', 'urlslab' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'revisions' ),
			'hierarchical'        => true,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 50,
			'menu_icon'           => 'dashicons-book',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => false,
			'publicly_queryable'  => false,
			'rewrite'             => $rewrite,
			'capability_type'     => 'post',
			'show_in_rest'        => true,
			'show_in_graphql'     => true,
			'graphql_single_name' => 'guide',
			'graphql_plural_name' => 'guides',
		);
		register_post_type( 'guide', $args );
	},
	0
);
