<?php

function sidebarBanner( $atts ) {
	$atts = shortcode_atts(
    array(
      'bannerTitle' => '',
      'bannerSubtitle' => '',
    ),
		$atts,
		'sidebarBanner'
  );

  ob_start();
	?>
   <div class="SidebarBanner">
    <div class="SidebarBanner__inn">
      <h4><?= ! empty ( $atts[ 'bannerTitle'] ) ? $atts[ 'bannerTitle'] : __( 'Experience next-level SEO plugin', 'urlslab' ); ?></h4>
      <p><?= ! empty( $atts[ 'bannerSubtitle'] ) ? $atts[ 'bannerSubtitle'] : __( 'Get started today and download the URLsLab Wordpress plugin', 'urlslab' ); ?></p>
      <a class="Button Button--full Button--secondary" href="/download"><?php _e( 'Download the plugin', 'urlslab' ); ?></a>
    </div>
    <img
      class="SidebarBanner__image"
      src="<?= esc_url( get_template_directory_uri(  ) . '/assets/images/urlslab-modules.png' ); ?>"
      alt="Experience next-level SEO plugin"
    />
  </div>

	<?php
  set_custom_source( 'components/SidebarBanner' );
  set_custom_source( 'layouts/Guide' );

	return ob_get_clean();
}

add_shortcode( 'sidebarBanner', 'sidebarBanner' );
