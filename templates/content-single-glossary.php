<?php // @codingStandardsIgnoreLine
$page_header_logo = array(
	'src' => get_template_directory_uri() . '/assets/images/icon-book.svg?ver=' . THEME_VERSION,
	'alt' => __( 'Glossary', 'urlslab' ),
);
if ( has_post_thumbnail() ) {
	$page_header_logo['src'] = get_the_post_thumbnail_url( $post, 'logo_thumbnail' );
}
$page_header_args = array(
	'image' => array(
		'src' => get_template_directory_uri() . '/assets/images/compact_header_glossary.png?ver=' . THEME_VERSION,
		'alt' => get_the_title(),
	),
	'logo'  => $page_header_logo,
	'title' => get_the_title(),
	'text'  => do_shortcode( '[urlslab-generator id="6"]' ),
	'toc'   => true,
);
?>
<div class="Post Post--sidebar-right" itemscope itemtype="http://schema.org/TechArticle">
	<meta itemprop="url" content="<?= esc_url( get_permalink() ); ?>">
	<span itemprop="publisher" itemscope itemtype="http://schema.org/Organization"><meta itemprop="name" content="URLsLab"></span>
	<?php get_template_part( 'lib/custom-blocks/compact-header', null, $page_header_args ); ?>

	<div class="wrapper Post__container">

		<div class="Post__content">

			<div class="Content" itemprop="articleBody">
				<?php the_content(); ?>

				<div class="Post__buttons">
					<a href="<?php _e( '/glossary/', 'urlslab' ); ?>" class="Button Button--outline Button--back"><span><?php _e( 'Back to Glossary', 'urlslab' ); ?></span></a>

					<a href="<?php _e( '/trial/', 'urlslab' ); ?>" class="Button Button--full">
						<span><?php _e( 'Create account for FREE', 'urlslab' ); ?></span>
					</a>
				</div>

				<div class="Post__content__resources">
					<div class="Post__sidebar__title h4"><?php _e( 'Related Articles', 'ms' ); ?></div>

					<div class="SimilarSources">
						<?php echo do_shortcode( '[urlslab-related-resources related-count="4" show-image="true" show-summary="true"]' ); ?>
					</div>
				</div>

			</div>
		</div>
		<?php echo do_shortcode( '[sidebarBanner chatbotType="' . get_post_meta( get_the_ID(), 'chatbot', true ) . '"]' ); ?>
	</div>
</div>
