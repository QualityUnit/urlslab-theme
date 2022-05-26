<?php

/**
	* Includes
	*/

	$theme_includes = array(
		'lib/helpers.php',            // Helper classes
		'lib/assets.php',             // Scripts and stylesheets
		'lib/extras.php',             // Custom functions
		'lib/setup.php',              // Theme setup
		'lib/wrapper.php',            // Theme wrapper class
		'lib/cleaner/assets.php',     // Clean assets
		'lib/cleaner/comments.php',   // Disable comments
		'lib/cleaner/emojis.php',     // Disable emojis
		'lib/cleaner/oembed.php',     // Disable oembed
		'lib/cleaner/rest-api.php',   // Disable REST API for visitors
		'lib/cleaner/wordpress.php',  // Clean WordPress things
		'lib/cleaner/wpml.php',       // Clean WPML things
		'lib/cleaner/yoast.php',      // Clean Yoast things
		'lib/post-types.php',         // Theme Post Types
		'lib/taxonomies.php',         // Theme Taxonomies
		'lib/metaboxes.php',          // Theme Metaboxes
		'lib/shortcodes.php',          // Theme Shortcodes
	);

	foreach ( $theme_includes as $file ) {
		$filepath = locate_template( $file );

		if ( ! $filepath ) {
			trigger_error( sprintf( esc_html( __( 'Error locating %s for inclusion', 'urlslab' ) ), esc_url( $file ) ), E_USER_ERROR );
		}

		require_once $filepath;
	}
	unset( $file, $filepath );

	function yt_videodetails( $video_id ) {
	$api_key    = $_ENV['YOUTUBE_API_KEY'];
	$ytid       = $video_id;
	$video_info = json_decode(
		wp_remote_get(//@codingStandardsIgnoreLine
			'https://www.googleapis.com/youtube/v3/videos?part=id%2C+snippet%2CcontentDetails&contentDetails.duration&id=' . $ytid . '&key=' . $api_key,
			array(
				'sslverify' => false,
			)
		)['body'],
		false 
	)->items[0];
	return $video_info;
}
function yt_microdata( $video_id ) {
	$channel = yt_videodetails( $video_id )->snippet->channelTitle;

	if ( 'Post Affiliate Pro' === $channel ) {
		$name        = yt_videodetails( $video_id )->snippet->title;
		$description = yt_videodetails( $video_id )->snippet->description;
		$uploaded    = yt_videodetails( $video_id )->snippet->publishedAt;
		$duration    = yt_videodetails( $video_id )->contentDetails->duration;
		$thumbnail   = yt_videodetails( $video_id )->snippet->thumbnails->maxres->url;
		return '
			<div itemprop="video" itemscope itemtype="https://schema.org/VideoObject">
				<meta itemprop="name" content="' . $name . '" />
				<meta itemprop="description" content="' . $description . '" />
				<link itemprop="thumbnailUrl" content="' . $thumbnail . '" />
				<link itemprop="contentUrl" content="https://www.youtube.com/watch?v=' . $video_id . '" />
				<link itemprop="embedUrl" content="https://www.youtube.com/embed/' . $video_id . '" />
				<meta itemprop="duration" content="' . $duration . '" />
				<meta itemprop="uploadDate" content="' . $uploaded . '" />
			</div>
		';
	}
	return false;
}

function add_yt_microdata( $html ) {
	$html = preg_replace_callback(
		'/(\<.+data-ytid="(.+?)".+\>)/',
		function ( $m ) {
				return yt_microdata( $m[2] ) . $m[1];
		},
		$html
	);

	return $html;
}
add_filter( 'the_content', 'add_yt_microdata', 10 );

/**
 * Youtube iframe replacemenets with image, loading YT on click
 */

function youtube_loader( $html ) {
	$html = preg_replace_callback(
		'/\<iframe.+?title="(.+).+?src=".+?(youtube\.com|youtu\.be)(\/embed)?\/?(.+?)(\?.+?)?"(.+\>)/',
		function ( $m ) {
				return yt_microdata( $m[4] ) . '
				<div class="youtube__loader" title="' . $m[1] . '" data-ytid="' . $m[4] . '">
				<img class="youtube__loader--img" data-lasrc="https://i.ytimg.com/vi/' . $m[4] . '/hqdefault.jpg" style="opacity: 0; transition: opacity .5s" alt="' . $m[1] . '">
				</div>';
		},
		$html
	);

	return $html;
}

add_filter( 'the_content', 'youtube_loader', 10 );

function youtube_loader2( $html ) {
	$html = preg_replace_callback(
		'/\<iframe.+?src=".+?(youtube\.com|youtu\.be)(\/embed)?\/?(.+?)(\?.+?)?".+?title="(.+?)"(.+?\>)/',
		function ( $m ) {
				return yt_microdata( $m[3] ) . '
				<div class="youtube__loader" title="' . $m[5] . '" data-ytid="' . $m[3] . '">
				<img class="youtube__loader--img" data-lasrc="https://i.ytimg.com/vi/' . $m[3] . '/hqdefault.jpg" style="opacity: 0; transition: opacity .5s" alt="' . $m[5] . '">
				</div>';
		},
		$html
	);

	return $html;
}
add_filter( 'the_content', 'youtube_loader2', 10 );

function elementor_youtube_loader( $html ) {
	$html = preg_replace_callback(
		'/\<div(.+)elementor-widget-video.+data-settings=.+(youtube\.com|youtu\.be)\\\\\/(watch\?v=)?(.+?)(&amp;|&quot;|\?)(.+?\>)((\n.+?)+)?(.+elementor-video.+?\>)/',
		function ( $m ) {
				return yt_microdata( $m[4] ) . '<div' . $m[1] . ' elementor-widget-video">' . $m[7] . $m[9] . '<div class="youtube__loader youtube__loader--elementor" title="" data-ytid="' . $m[4] . '" data-width="" data-height=""><img class="youtube__loader--img" data-src="https://i.ytimg.com/vi/' . $m[4] . '/hqdefault.jpg" style="opacity: 0; transition: opacity .5s" alt=""></div>';
		},
		$html
	);

	return $html;
}
add_filter( 'the_content', 'elementor_youtube_loader', 10 );
