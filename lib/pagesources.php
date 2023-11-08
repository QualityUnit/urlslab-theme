<?php

// Blog page
set_source( 'single-post', 'common/splide', 'css' );
set_source( 'single-post', 'splide', 'js' );
set_source( 'single-post', 'sidebar_toc', 'js' );
set_source( 'single-post', 'custom_lightbox', 'js' );

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
set_source( 'post', 'components/SidebarTOC', 'css' );
set_source( 'post', 'components/SignupSidebar', 'css' );
set_source( 'post', 'splide', 'js' );
set_source( 'post', 'custom_lightbox', 'js' );

// Article (success stories)
set_source( 'single-success-stories', 'pages/SuccessStoriesArticle', 'css' );

// Features, Academy, Integrations, Templates
$category_pages = array( 'features', 'glossary', 'academy', 'integrations', 'reviews', 'templates' );

foreach ( $category_pages as $pagename ) {
	set_source( 'single-' . $pagename, 'common/splide', 'css' );
	set_source( 'single-' . $pagename, 'splide', 'js' );
	//set_source( 'single-ms_' . $pagename, 'sidebar_toc', 'js' );
}
