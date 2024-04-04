<?php
	wp_enqueue_style( 'footer', get_template_directory_uri() . '/assets/dist/layouts/Footer' . isrtl() . wpenv() . '.css', false, THEME_VERSION );

if ( empty( preg_grep( '/^(login|trial|free-account|demo|request-for-proposal)$/', get_body_class() ) ) ) {
	?>

<footer class="Footer urlslab-skip-all">
  <div class="wrapper">
	<div class="Footer__newsletter">
	  <div class="Footer__newsletter--text">
		<h4>Join our newsletter</h4>
		<p class="small no-margin">Get exclusive access to the latest tips, trends and deals for free.</p>
	  </div>
	  <?php require_once get_template_directory() . '/templates/newsletter-form.php'; ?>
	</div>
	<div class="Footer__main">
	  <div class="Footer__main--intro">
		<div class="Logo">
		  <a href="<?= esc_url( home_url( '/' ) ); ?>">
			<img alt="URLsLab" loading="lazy" width="139" height="34" src="<?= esc_url( get_template_directory_uri() . '/assets/images/urlslab-logo.svg' ); ?>" />
		  </a>
		</div>
		<p class="small Footer__motto">Start improving all important aspects of your website</p>
		<a class="Button Button--full noIcon" href="https://wordpress.org/plugins/urlslab/" target="_blank"><span>Get the WordPress plugin</span></a>
		<!-- <div class="Footer__social">
		  <a href="" class="Footer__social--item">
			<FacebookIcon />
		  </a>
		  <a href="" class="Footer__social--item">
			<YouTubeIcon />
		  </a>
		</div> -->
	  </div>
	  <div class="Footer__main--links">
		<?php
		if ( has_nav_menu( 'footer_navigation' ) ) :
			wp_nav_menu(
				array(
					'theme_location' => 'footer_navigation',
					'menu_class'     => 'Footer__navigation',
				)
			);
	endif;
		?>
	  </div>
	</div>
	<div class="Footer__bottom">
	  <p class="Footer__bottom--copyright"><?php _e( '© 2004-', 'ms' ); ?><?= esc_html( gmdate( 'Y' ) ); ?> <?php _e( 'Quality Unit, LLC. All rights reserved.', 'ms' ); ?></p>
	  <ul class="Footer__bottom--menu">
		<?php
		if ( has_nav_menu( 'footer_bottom_navigation' ) ) :
			wp_nav_menu(
				array(
					'theme_location' => 'footer_bottom_navigation',
					'menu_class'     => 'nav',
				)
			);
			endif;
		?>
	  </ul>
	</div>
  </div>
</footer>

<?php } ?>

<div class="Medovnicky urlslab-skip-all">
	<div class="wrapper">
		<p><?php _e( 'Our website uses cookies. By continuing we assume your permission to deploy cookies as detailed in our', 'urlslab' ); ?> <a href="<?php _e( '/privacy-policy/', 'urlslab' ); ?>"><?php _e( 'privacy and cookies policy', 'ms' ); ?></a><?php _e( '.', 'urlslab' ); ?></p>

		<div class="Medovnicky__buttons">
			<a href="#" class="Medovnicky__button Medovnicky__button--no Medovnicky__button--more Button Button--outline">
				<span><?php _e( 'Decline', 'urlslab' ); ?></span>
			</a>
			<a href="#" class="Medovnicky__button Medovnicky__button--yes Button Button--full">
				<span><?php _e( 'Accept', 'urlslab' ); ?></span>
			</a>
		</div>
	</div>
</div>
