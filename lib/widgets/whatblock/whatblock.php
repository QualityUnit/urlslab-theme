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
 * Text Domain:       whatblock
*/

function whatblock_block_init() {
	$path = get_template_directory() . '/lib/widgets/whatblock/';
	require_once $path . 'layouts/whatcontent.php';

	function whatblock_editor_assets() {
		$path_uri = get_template_directory_uri() . '/lib/widgets/whatblock/';
		$js_data  = array(
			'url' => $path_uri . 'images',
		);

		$version  = THEME_VERSION;

		wp_enqueue_script(
			'qu_whatblock_block_editor_script',
			$path_uri . 'build/index.js',
			array( 'wp-components', 'wp-element', 'wp-data' ),
			$version,
			true
		);

		wp_add_inline_script(
			'qu_whatblock_block_editor_script',
			'const images = ' . wp_json_encode( $js_data ),
			'before'
		);

		wp_enqueue_style(
			'qu_whatblock_block_editor_style',
			$path_uri . 'build/index.css',
			array( 'wp-edit-blocks' ),
			$version,
			false
		);

		wp_enqueue_style(
			'qu_whatblock_block_frontend_style',
			$path_uri . 'build/index.css',
			array(),
			$version,
			false
		);
	}

	add_action( 'enqueue_block_editor_assets', 'whatblock_editor_assets' );

	function whatblock_assets() {
		$path_uri = get_template_directory_uri() . '/lib/widgets/whatblock/';
		$version  = THEME_VERSION;

		if ( is_singular() ) {
			$id = get_the_ID();
			if ( has_block( 'qu/whatblock', $id ) ) {

				wp_enqueue_style(
					'qu_whatblock_block_frontend_style',
					$path_uri . 'build/index.css',
					array(),
					$version,
					false
				);
			}
		}
	}

	add_action( 'enqueue_block_assets', 'whatblock_assets' );

	function render_whatblock( $attr ) {
			return whatcontent( $attr );
	}

	register_block_type(
		'qu/whatblock',
		array(
			'qu_whatblock_editor_script' => 'qu_whatblock_block_editor_script',
			'qu_whatblock_editor_style'  => 'qu_whatblock_block_editor_style',
			'qu_whatblock_style'         => 'qu_whatblock_block_frontend_style',
			'render_callback'             => 'render_whatblock',
			'attributes'                  => array(
				'header'         => array(
					'type'    => 'string',
					'default' => 'What can',
				),
				'content'        => array(
					'type'    => 'string',
					'default' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Soluta laboriosam neque accusantium modi, quae maxime illo accusamus error quasi esse debitis nostrum exercitationem tempore expedita sunt autem, voluptates porro? Odit, culpa atque.',
				),
			),
		)
	);
}

add_action( 'init', 'whatblock_block_init' );
