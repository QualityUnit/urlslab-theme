<?php

	add_action(
		'init',
		function () {
			$labels  = array(
				'name'           => _x( 'About us', 'Post Type General Name', 'urlslab' ),
				'singular_name'  => _x( 'About us', 'Post Type Singular Name', 'urlslab' ),
				'menu_name'      => __( 'About us', 'urlslab' ),
				'name_admin_bar' => __( 'About us', 'urlslab' ),
			);
			$rewrite = array(
				'slug'       => 'about',
				'with_front' => true,
				'pages'      => true,
				'feeds'      => false,
			);
			$args    = array(
				'label'               => __( 'About us', 'urlslab' ),
				'labels'              => $labels,
				'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
				'hierarchical'        => true,
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'menu_position'       => 45,
				'menu_icon'           => 'dashicons-book',
				'show_in_admin_bar'   => true,
				'show_in_nav_menus'   => true,
				'can_export'          => true,
				'has_archive'         => false,
				'exclude_from_search' => false,
				'publicly_queryable'  => true,
				'rewrite'             => $rewrite,
				'capability_type'     => 'post',
				'show_in_rest'        => true,
			);
			register_post_type( 'about', $args );
		},
		0
	);
