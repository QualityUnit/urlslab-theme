<?php require_once( 'footer-logos.php' ); ?>

<footer class="Footer">
	<div class="wrapper__wide">
		<div class="Footer__main">
			<div class="Header__logo">
				<a href="<?= esc_url( home_url( '/' ) ); ?>">
					<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/urlslab-logo.svg" alt="<?php bloginfo( 'name' ); ?>">
				</a>
			</div>
			<div class="Footer__main--links">
				<?php
					if ( has_nav_menu( 'header_navigation' ) ) :
						wp_nav_menu(
							array(
								'theme_location' => 'header_navigation',
								'menu_class' => 'Footer__navigation',
							)
						);
					endif;
				?>
				<div class="Footer__social">
					<a href="" class="Footer__social--item">
						<svg width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path
								d="M20 10c0-5.523-4.477-10-10-10S0 4.477 0 10c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V10h2.54V7.797c0-2.506 1.492-3.89 3.777-3.89 1.093 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.563V10h2.773l-.443 2.89h-2.33v6.988C16.343 19.128 20 14.991 20 10Z">
							</path>
						</svg>Facebook</a>
					<a href="" class="Footer__social--item">
						<svg width="22" height="16" xmlns="http://www.w3.org/2000/svg" xml:space="preserve"
							style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2">
							<path
								d="M20.83 1.172c.34.341.586.766.712 1.232C21.995 4.12 22 7.7 22 7.7s0 3.58-.458 5.295a2.76 2.76 0 0 1-1.945 1.945c-1.715.46-8.597.46-8.597.46s-6.88 0-8.595-.46A2.757 2.757 0 0 1 .46 12.995C0 11.28 0 7.7 0 7.7s0-3.58.46-5.296A2.76 2.76 0 0 1 2.405.452C4.118-.008 11-.008 11-.008s6.88 0 8.597.467c.466.126.89.372 1.232.713h.001ZM14.516 7.7 8.8 11V4.4l5.717 3.3h-.001Z">
							</path>
						</svg>YouTube</a>
				</div>
			</div>
		</div>
		<div class="Footer__bottom">
			<p class="Footer__bottom--copyright">
				<?php _e( '© 2004-2022 QualityUnit.com. All rights reserved.', 'footer' ); ?></p>
			<ul class="Footer__bottom--menu">
				<li>
					<a href=""><?php _e( 'Privacy Policy', 'footer' ); ?></a>
				</li>
				<li>
					<a href=""><?php _e( 'Terms & Conditions', 'footer' ); ?></a>
				</li>
			</ul>
		</div>
	</div>
</footer>
