<?php

add_action(
	'init',
	function () {
		$labels  = array(
			'name'           => _x( 'Glossary', 'Post Type General Name', 'urlslab' ),
			'singular_name'  => _x( 'Glossary', 'Post Type Singular Name', 'urlslab' ),
			'menu_name'      => __( 'Glossary', 'urlslab' ),
			'name_admin_bar' => __( 'Glossary', 'urlslab' ),
		);
		$rewrite = array(
			'slug'       => 'glossary',
			'with_front' => true,
			'pages'      => true,
			'feeds'      => false,
		);
		$args    = array(
			'label'               => __( 'Glossary', 'urlslab' ),
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
			'graphql_single_name' => 'glossary',
			'graphql_plural_name' => 'glossaries',
		);
		register_post_type( 'glossary', $args );
	},
	0
);
