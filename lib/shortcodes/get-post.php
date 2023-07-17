<?php

function getpost( $atts ) {
	$atts = shortcode_atts(
    array(
      'id' => '',
      'bannerTitle' => '',
      'bannerSubtitle' => '',
    ),
		$atts,
		'getPost'
  );

  ob_start();
  $title = preg_replace( '/\^(.+?)\^/i', '<span class="highlight">$1</span>', get_the_title( $atts[ 'id'] ) );
  $content = get_post_field( 'post_content', $atts[ 'id' ] );
	?>
  <div class="Post Guide" itemScope itemType="http://schema.org/TechArticle">
    <meta itemProp="url" content="<?= esc_html( get_post( $atts['id'] )->url ); ?>" />
    <div class="Guide__header">
      <div class="Guide__header--inn">
        <h2>
          <?= $title; ?>
        </h2>
      </div>
    </div>
    <div class="wrapper__wide Post__container Guide__container">
      <!-- <SidebarToc content={content} /> -->
      <div class="Content Post__content" itemProp="articleBody">
        <?= $content; ?>
      </div>
      <?php echo do_shortcode( '[sidebarBanner bannerTitle="' . $atts['bannerTitle'] . '" bannerSubtitle="' . $atts['bannerSubtitle'] .'"]' ) ?>
    </div>
  </div>

	<?php
  set_custom_source( 'layouts/Post' );
  set_custom_source( 'layouts/Guide' );

	return ob_get_clean();
}

add_shortcode( 'getPost', 'getpost' );
