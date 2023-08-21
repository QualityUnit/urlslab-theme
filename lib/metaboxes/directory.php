<?php

$metabox = array(
	'id'         => 'mb_directory',
	'capability' => 'edit_posts',
	'name'       => 'Directory',
	'post_type'  => array( 'directory' ),
	'priority'   => 'high',
	'args'       => array(
		array(
			'id'          => 'mb_directory_website',
			'label'       => 'Website URL',
			'description' => '',
			'type'        => 'text',
		),
		array(
			'id'          => 'mb_directory_company-name',
			'label'       => 'Company Name',
			'description' => '',
			'type'        => 'text',
		),
		array(
			'id'          => 'mb_directory_terms-conditions',
			'label'       => 'Terms & Conditions',
			'description' => '',
			'type'        => 'text',
		),
		array(
			'id'          => 'mb_directory_privacy-policy',
			'label'       => 'Privacy Policy',
			'description' => '',
			'type'        => 'text',
		),
		array(
			'id'          => 'mb_directory_security-policy',
			'label'       => 'Security Policy',
			'description' => '',
			'type'        => 'text',
		),
		array(
			'id'          => 'mb_directory_gdpr',
			'label'       => 'GDPR',
			'description' => '',
			'type'        => 'text',
		),
		array(
			'id'          => 'mb_directory_affiliate-program',
			'label'       => 'Affiliate Program',
			'description' => '',
			'type'        => 'text',
		),
		array(
			'id'          => 'mb_directory_faq-text',
			'label'       => 'FAQ - Subheadline',
			'description' => '',
			'type'        => 'text',
		),
	),
);

new trueMetaBox( $metabox );
