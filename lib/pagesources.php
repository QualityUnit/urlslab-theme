<?php
  // Pricing page
  set_source( 'pricing', 'pages/Pricing', 'css' );

  // Get plugin – Download page
  set_source( 'download', 'pages/Download', 'css' );


  // Post type page
set_source( 'post', 'layouts/Post', 'css' );
set_source( 'post', 'components/SidebarTOC', 'css' );
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
