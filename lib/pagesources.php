<?php

// Blog page
set_source( 'single-post', 'pages/blog', 'css' );

// Archive type pages
$archive_type = array( 'archive', 'awards', 'testimonials', 'customers' );

foreach ( $archive_type as $specific_page ) {
	set_source( $specific_page, 'layouts/Archive', 'css' );
}

// Pricing page
set_source( 'pricing', 'pages/Pricing', 'css' );

// Get plugin – Download page
set_source( 'download', 'pages/Download', 'css' );

// Post type page
set_source( 'post', 'pages/post', 'css' );


// Article (success stories)
set_source( 'single-success-stories', 'pages/SuccessStoriesArticle', 'css' );
