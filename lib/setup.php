<?php

//Retrieves back old Widgets editor in WP 5.8 and newer

function enable_old_widget_editor() {
	remove_theme_support( 'widgets-block-editor' );
}

add_action( 'after_setup_theme', 'enable_old_widget_editor' );

/**
	* Theme setup
	*/

add_action(
	'after_setup_theme',
	function () {
		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'editor-style.css' );

		// Make theme available for translation
		load_theme_textdomain( 'urlslab', get_template_directory() . '/lang' );

		// Enable plugins to manage the document title
		// http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
		add_theme_support( 'title-tag' );

		// Register wp_nav_menu() menus
		// http://codex.wordpress.org/Function_Reference/register_nav_menus
		register_nav_menus(
			array(
				'header_navigation' => __( 'Header Navigation', 'urlslab' ),
				'header_buttons'    => __( 'Header Buttons', 'urlslab' ),
				'footer_navigation' => __( 'Footer Navigation', 'urlslab' ),
				'footer_bottom_navigation' => __( 'Footer Bottom Navigation', 'urlslab' ),
			)
		);

		// Enable post thumbnails
		// http://codex.wordpress.org/Post_Thumbnails
		// http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
		// http://codex.wordpress.org/Function_Reference/add_image_size
		add_theme_support( 'post-thumbnails' );

		add_image_size( 'blog', 250, 250 );
		add_image_size( 'archive_thumbnail', 185, 50 );
		add_image_size( 'archive_small_thumbnail', 175, 25 );
		add_image_size( 'blog_thumbnail', 380, 380, array( 'center', 'center' ) );
		add_image_size( 'blog_post_thumbnail', 960, 335 );
		add_image_size( 'box_archive_thumbnail', 700, 400 );
		add_image_size( 'logo_thumbnail', 185, 185 );
		add_image_size( 'logo_small_thumbnail', 110, 110 );
		add_image_size( 'person_thumbnail', 485, 485 );

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
