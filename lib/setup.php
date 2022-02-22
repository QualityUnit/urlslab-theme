<?php

/**
	* Theme setup
	*/

add_action(
	'after_setup_theme',
	function () {
		// Enable features from Soil when plugin is activated
		// https://roots.io/plugins/soil/
		add_theme_support(
			'soil',
			array(
				'clean-up',
				'disable-trackbacks',
				'js-to-footer',
				'nice-search',
			)
		);

		// Make theme available for translation
		load_theme_textdomain( 'urlslab', get_template_directory() . '/lang' );

		// Enable plugins to manage the document title
		// http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
		add_theme_support( 'title-tag' );

		// Register wp_nav_menu() menus
		// http://codex.wordpress.org/Function_Reference/register_nav_menus
		register_nav_menus(
			array(
				'header_navigation'        => __( 'Header Navigation', 'urlslab' ),
			)
		);

		// Enable post thumbnails
		// http://codex.wordpress.org/Post_Thumbnails
		// http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
		// http://codex.wordpress.org/Function_Reference/add_image_size
		add_theme_support( 'post-thumbnails' );

		add_image_size( 'blog', 250, 250 );

		// Enable post formats
		// http://codex.wordpress.org/Post_Formats
		add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio' ) );

		// Enable HTML5 markup support
		// http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
		add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form', 'script' ) );
	}
);


/**
	* Register sidebars
	*/

add_action(
	'widgets_init',
	function () {
		register_sidebar(
			array(
				'name'          => __( 'Footer Area', 'urlslab' ),
				'id'            => 'footer_area',
				'before_widget' => '<div class="%1$s %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div>',
				'after_title'   => '</div>',
			)
		);
	}
);
