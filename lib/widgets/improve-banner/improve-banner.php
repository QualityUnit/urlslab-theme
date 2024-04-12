<?php
/**
 * Plugin Name:       Statistics
 * Description:       Statisticks block for Gutenberg.
 * Requires at least: 5.8
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       improvebanner
*/

function improvebanner_block_init() {
	$path = get_template_directory() . '/lib/widgets/improve-banner/';
	require_once $path . 'layouts/banner.php';

	function improvebanner_editor_assets() {
		$path_uri = get_template_directory_uri() . '/lib/widgets/improve-banner/';
		$js_data  = array(
			'url' => $path_uri . 'images',
		);

		$version = THEME_VERSION;

		wp_enqueue_script(
			'qu_improvebanner_block_editor_script',
			$path_uri . 'build/index.js',
			array( 'wp-element', 'wp-data' ),
			$version,
			true
		);

		wp_add_inline_script(
			'qu_improvebanner_block_editor_script',
			'const images = ' . wp_json_encode( $js_data ),
			'before'
		);

		wp_enqueue_style(
			'qu_improvebanner_block_editor_style',
			$path_uri . 'build/index.css',
			array( 'wp-edit-blocks' ),
			$version,
			false
		);

		wp_enqueue_style(
			'qu_improvebanner_block_frontend_style',
			$path_uri . 'build/index.css',
			array(),
			$version,
			false
		);
	}

	add_action( 'enqueue_block_editor_assets', 'improvebanner_editor_assets' );

	function improvebanner_assets() {
		$path_uri = get_template_directory_uri() . '/lib/widgets/improve-banner/';
		$version  = THEME_VERSION;

		if ( is_singular() ) {
			$id = get_the_ID();
			if ( has_block( 'qu/improvebanner', $id ) ) {

				wp_enqueue_style(
					'qu_improvebanner_block_frontend_style',
					$path_uri . 'build/index.css',
					array(),
					$version,
					false
				);
			}
		}
	}

	add_action( 'enqueue_block_assets', 'improvebanner_assets' );

	function render_improvebanner( $attr ) {
			return banner( $attr );
	}

	register_block_type(
		'qu/improvebanner',
		array(
			'qu_improvebanner_editor_script' => 'qu_improvebanner_block_editor_script',
			'qu_improvebanner_editor_style'  => 'qu_improvebanner_block_editor_style',
			'qu_improvebanner_style'         => 'qu_improvebanner_block_frontend_style',
			'render_callback'                => 'render_improvebanner',
			'attributes'                     => array(
				'title'   => array(
					'type'    => 'string',
					'default' => 'Improve your website',
				),
				'content' => array(
					'type'    => 'string',
					'default' => 'Get started today and download the URLsLab WordPress plugin',
				),
				'button'  => array(
					'type'    => 'string',
					'default' => 'Get the WordPress plugin',
				),
			),
		)
	);
}

add_action( 'init', 'improvebanner_block_init' );
