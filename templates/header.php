<header class="Header urlslab-skip-all">
	<div class="wrapper">
		<div class="Logo">
			<a href="<?= esc_url( home_url( '/' ) ); ?>">
				<img alt="URLsLab" loading="lazy" width="139" height="34" src="<?= esc_url( get_template_directory_uri() . '/assets/images/urlslab-logo.svg' ); ?>" />
			</a>
		</div>
		<div class="Header__items">
			<div class="hamburger" id="hamburger-button">
				<span class="line"></span>
				<span class="line"></span>
				<span class="line"></span>
			</div>

			<nav class="Header__navigation">
				<?php
				if ( has_nav_menu( 'header_navigation' ) ) :
					wp_nav_menu(
						array(
							'theme_location' => 'header_navigation',
							'menu_class'     => 'nav',
						)
					);
				endif;
				?>
				<div class="Header__buttons">
					<a class="Button Button--secondary" href="/demo" target="_blank"><span><?php _e( 'Demo', 'urlslab' ); ?></span></a>
					<a href="https://api.urlslab.com/v1/auth/signin/google" id="loginBtn" class="Button Button--login Button--outline"><span><?php _e( 'Login', 'urlslab' ); ?></span></a>
				</div>
			</nav>
		</div>
		<div class="Header__mobile__menu__overlay"></div>
	</div>
</header>

<script>
	const loginBtn = document.querySelector( '#loginBtn' );
	const loginForm = document.querySelector( '#loginForm' );

	loginBtn.addEventListener( 'click', ( event ) => {
		const loginShown = loginForm.style.display;

		if ( loginShown === 'none' ) {
			loginForm.style.display = 'block';
			return false;
		}
		loginForm.style.display = 'none';
	} );

	document.querySelector( 'body' ).addEventListener( 'click', ( event ) => {
		event.stopPropagation();
		if ( event.target.id !== ( 'loginForm' ) && event.target.id !== ( 'loginBtn' ) ) {
			loginForm.style.display = 'none';
		}
	} );
</script>
