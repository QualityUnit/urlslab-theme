<?php
	namespace Roots\Sage\Setup;

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

		// add_image_size( 'archive_thumbnail', 250, 250 );

		// Enable post formats
		// http://codex.wordpress.org/Post_Formats
		add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio' ) );

		// Enable HTML5 markup support
		// http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
		add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form', 'script' ) );

		// Use main stylesheet for visual editor
		// add_editor_style( get_template_directory_uri() . '/assets/dist/app.css' );
	}
);


/**
	* Register sidebars
	*/

// add_action(
// 	'widgets_init',
// 	function () {
// 		register_sidebar(
// 			array(
// 				'name'          => __( 'Footer Column #1', 'urlslab' ),
// 				'id'            => 'footer_column_1',
// 				'before_widget' => '<div class="%1$s %2$s">',
// 				'after_widget'  => '</div>',
// 				'before_title'  => '<div class="Footer__top__column__title Footer__top__column__title--image h4">',
// 				'after_title'   => '</div>',
// 			)
// 		);
// 	}
// );


/**
	* Theme assets
	*/

add_action(
	'wp_enqueue_scripts',
	function () {
		$css_ver = gmdate( 'ymdGis', filemtime( get_template_directory() . '/assets/dist/app.min.css' ) );

		wp_enqueue_style( 'la-font-poppins', 'https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap', false, '1' );
		wp_enqueue_style( 'la-font-opensans', 'https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap', false, '1' );
		wp_enqueue_style( 'app', get_template_directory_uri() . '/assets/dist/app' . isrtl() . wpenv() . '.css', false, $css_ver );

		wp_deregister_script( 'wp-embed' );
	},
	100
);

add_action(
	'wp_footer',
	function () {
		$js_ver_app = gmdate( 'ymdGis', filemtime( get_template_directory() . '/assets/dist/app' . wpenv() . '.js' ) );

		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'app_js', get_template_directory_uri() . '/assets/dist/app' . wpenv() . '.js', false, $js_ver_app, true );
	}
);
