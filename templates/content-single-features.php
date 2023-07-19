<?php // @codingStandardsIgnoreLine
$current_lang    = apply_filters( 'wpml_current_language', null );
$header_category = get_en_category( 'features', $post->ID );
do_action( 'wpml_switch_language', $current_lang );
$la_pricing_url = __( '/pricing/', 'urlslab' );
$page_header_logo = array(
	'src' => get_template_directory_uri() . '/assets/images/icon-custom-post_type.svg' . THEME_VERSION,
	'alt' => __( 'Integration', 'urlslab' ),
);
if ( has_post_thumbnail() ) {
	$page_header_logo['src'] = get_the_post_thumbnail_url( $post, 'logo_thumbnail' );
}
$page_header_args = array(
	'image' => array(
		'src' => get_template_directory_uri() . '/assets/images/compact_header_features.png?ver=' . THEME_VERSION,
		'alt' => get_the_title(),
	),
	'logo' => $page_header_logo,
	'title' => get_the_title(),
	'text' => do_shortcode( '[urlslab-generator id="6"]' ),
	'toc' => true,
);
$current_id = apply_filters( 'wpml_object_id', $post->ID, 'features' );
$categories = get_the_terms( $current_id, 'features_categories' );
$categories_url = get_post_type_archive_link( 'features' );
if ( $categories && $categories_url ) {
	$new_tags = array(
		'title' => __( 'Categories', 'urlslab' ),
	);
	foreach ( $categories as $category ) {
		$new_tags['list'][] = array(
			'href' => $categories_url . '#' . $category->slug,
			'title' => $category->name,
		);
	}
	if ( isset( $new_tags['list'] ) ) {
		$page_header_args['tags'][] = $new_tags;
	}
}
if ( get_post_meta( get_the_ID(), 'mb_features_mb_features_plan', true ) ) {
	$new_tags = array(
		'title' => __( 'Available in', 'urlslab' ),
	);
	foreach ( get_post_meta( get_the_ID(), 'mb_features_mb_features_plan', true ) as $item ) {
		if ( 'ticket' === $item ) {
			$new_tags['list'][] = array(
				'href' => $la_pricing_url,
				'title' => __( 'Small', 'urlslab' ),
			);
		}
		if ( 'ticket-chat' === $item ) {
			$new_tags['list'][] = array(
				'href' => $la_pricing_url,
				'title' => __( 'Medium', 'urlslab' ),
			);
		}
		if ( 'all-inclusive' === $item ) {
			$new_tags['list'][] = array(
				'href' => $la_pricing_url,
				'title' => __( 'Large', 'urlslab' ),
			);
		}
		if ( 'self-hosted' === $item ) {
			$new_tags['list'][] = array(
				'href' => $la_pricing_url,
				'title' => __( 'Self-Hosted', 'urlslab' ),
			);
		}
	}
	if ( isset( $new_tags['list'] ) ) {
		$page_header_args['tags'][] = $new_tags;
	}
}
?>

<div class="Post Post--sidebar-right" itemscope itemtype="http://schema.org/TechArticle">
	<meta itemprop="url" content="<?= esc_url( get_permalink() ); ?>">
	<span itemprop="publisher" itemscope itemtype="http://schema.org/Organization"><meta itemprop="name" content="LiveAgent"></span>
	
	<?php get_template_part( 'lib/custom-blocks/compact-header', null, $page_header_args ); ?>
	
	<div class="wrapper Post__container">
		<div class="Post__content">
			<div class="Content" itemprop="articleBody">
				<?php the_content(); ?>

				<div class="Post__content__resources">
					<div class="Post__sidebar__title h4"><?php _e( 'Related Articles', 'urlslab' ); ?></div>

					<div class="SimilarSources">
						<?php echo do_shortcode( '[urlslab-related-resources related-count="4" show-image="true" show-summary="true"]' ); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>