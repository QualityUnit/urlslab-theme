<?php

function sidebar_banner( $atts ) {
	$atts = shortcode_atts(
		array(
			'bannerTitle'    => '',
			'bannerSubtitle' => '',
			'chatbotType'    => '',
		),
		$atts,
		'sidebarBanner'
	);

	ob_start();
	?>
   <div class="SidebarBanner">
	<div class="SidebarBanner__inn">
	  <h4>
			<?php
			if ( isset( $atts['chatbotType'] ) ) {
				echo esc_html( ! empty( $atts['bannerTitle'] ) ? $atts['bannerTitle'] : __( 'Craft an AI Chatbot in minutes', 'urlslab' ) );
			} else {
				echo esc_html( ! empty( $atts['bannerTitle'] ) ? $atts['bannerTitle'] : __( 'Unleash the power of AI for your website', 'urlslab' ) );
			}
			?>
		</h4>
	  <p>
			<?php
			if ( isset( $atts['chatbotType'] ) ) {
				echo esc_html( ! empty( $atts['bannerSubtitle'] ) ? $atts['bannerSubtitle'] : __( 'URLsLab chatbot provides instant answers from multiple sources, and collects data automatically', 'urlslab' ) );
			} else {
				echo esc_html( ! empty( $atts['bannerSubtitle'] ) ? $atts['bannerSubtitle'] : __( 'Get started today and download the URLsLab WordPress plugin', 'urlslab' ) );
			}
			?>
		</p>
	  <a class="Button Button--full pt-s pb-s" href="<?= esc_url( isset( $atts['chatbotType'] ) ? 'https://api.urlslab.com/v1/auth/signin/google' : '/demo' ); ?>" target="_blank"><?= esc_html( isset( $atts['chatbotType'] ) ? __( 'Try Chatbot now', 'urlslab' ) : __( 'Schedule a demo', 'urlslab' ) ); ?></a>
	</div>
	<img
	  class="SidebarBanner__image"
	  src="<?= esc_url( get_template_directory_uri() . ( isset( $atts['chatbotType'] ) ? '/assets/images/urlslab-chatbot.png' : '/assets/images/urlslab-modules.png' ) ); ?>"
	  alt="Experience next-level SEO plugin"
	/>
  </div>

	<?php
	set_custom_source( 'components/SidebarBanner' );
	set_custom_source( 'layouts/Guide' );

	return ob_get_clean();
}

add_shortcode( 'sidebarBanner', 'sidebar_banner' );
