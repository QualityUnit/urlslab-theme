<?php

/**
  * Redirect Features Categories
  */
function features_category_redirect() {
	if ( is_tax( 'features_categories' ) ) {
		wp_safe_redirect( '/features/', 301 );
		exit;
	}
}
add_action( 'template_redirect', 'features_category_redirect' );

/**
  * Redirect About us Categories
  */
function about_category_redirect() {
	if ( is_tax( 'about_categories' ) ) {
		wp_safe_redirect( '/about/contact', 301 );
		exit;
	}
}
add_action( 'template_redirect', 'about_category_redirect' );

/**
 * Redirect Videos Categories
 */
function videos_category_redirect() {
	if ( is_tax( 'videos_categories' ) ) {
		wp_safe_redirect( '/videos/', 301 );
		exit;
	}
}
add_action( 'template_redirect', 'videos_category_redirect' );

/**
 * Redirect Glossary Categories
 */
function glossary_category_redirect() {
	if ( is_tax( 'glossary_categories' ) ) {
		wp_safe_redirect( '/glossary/', 301 );
		exit;
	}
}
add_action( 'template_redirect', 'glossary_category_redirect' );
