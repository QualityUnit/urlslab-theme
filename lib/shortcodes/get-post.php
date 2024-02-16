<?php

function getpost( $atts ) {
	$atts = shortcode_atts(
		array(
			'id'             => '',
			'bannerTitle'    => '',
			'bannerSubtitle' => '',
		),
		$atts,
		'getPost'
	);

	ob_start();
	$title   = preg_replace( '/\^(.+?)\^/i', '<span class="highlight">$1</span>', get_the_title( $atts['id'] ) );
	$url     = get_permalink( $atts['id'] );
	$content = apply_filters( 'the_content', get_post( $atts['id'], OBJECT, 'display' )->post_content );
	?>
  <div class="Post Guide" itemScope itemType="http://schema.org/TechArticle">
	<meta itemProp="url" content="<?= esc_url( $url ); ?>" />
	<div class="Guide__header">
	  <div class="Guide__header--inn">
		<h2>
		  <?= $title; // @codingStandardsIgnoreLine ?>
		</h2>
	  </div>
	</div>
	<div class="wrapper__wide Post__container Guide__container">
	  <?php if ( sidebar_toc( get_post( $atts['id'], OBJECT, 'display' )->post_content ) !== false ) { ?>
		<div class="SidebarTOC Post__SidebarTOC">
			<div class="SidebarTOC-wrapper">
						<strong class="SidebarTOC__title"><?php _e( 'Contents', 'ms' ); ?></strong>
						<div class="SidebarTOC__slider slider splide">
							<div class="splide__track">
								<ul class="SidebarTOC__content splide__list">
									<?= sidebar_toc( get_post( $atts['id'], OBJECT, 'display' )->post_content ); // @codingStandardsIgnoreLine ?>
								</ul>
							</div>
						</div>
					</div>
		</div>
			<?php } ?>
	  <div class="Content Post__content" itemProp="articleBody">
		<?= $content; // @codingStandardsIgnoreLine ?> 
	  </div>
	  <?php echo do_shortcode( '[sidebarBanner bannerTitle="' . $atts['bannerTitle'] . '" bannerSubtitle="' . $atts['bannerSubtitle'] . '"]' ); ?>
	</div>
  </div>

	<?php
	set_custom_source( 'layouts/Post' );
	set_custom_source( 'layouts/Guide' );

	set_custom_source( 'common/splide', 'css' );
	set_custom_source( 'components/SidebarTOC' );
	set_custom_source( 'splide', 'js' );
	set_custom_source( 'sidebar_toc', 'js' );

	return ob_get_clean();
}

add_shortcode( 'getPost', 'getpost' );
