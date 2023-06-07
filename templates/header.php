<header class="Header">
	<div class="wrapper">
		<div class="Logo">
			<a href="<?= esc_url( home_url( '/' ) ); ?>">
				<img alt="URLsLab" loading="lazy" width="139" height="34" src="<?= get_template_directory_uri() . '/assets/images/urlslab-logo.svg'; ?>" />	
			</a>
		</div>
		<div class="Header__items">
			<nav class="Header__navigation">
				<?php
				if ( has_nav_menu( 'header_navigation' ) ) :
					wp_nav_menu(
						array(
							'theme_location' => 'header_navigation',
							'menu_class' => 'nav',
						)
					);
				endif;
				?>
				<a class="Button Button--secondary" href="/download/"><span>Get plugin</span></a>
				<div className="pos-relative flex flex-align-center">
					<button type="button" class="Button Button--login "><span>Login</span></button>
					<!-- {loginActive
						&& (
						<div className="Form Form__socialIcons__wrap pos-absolute" style={{ top: '100%', right: 0 }}>
							<div className="mb-s fs-m"><strong>Login to URLsLab </strong></div>
							<FormSocialIcons className="fullsize" />
						</div>
						)} -->
				</div>
			</nav>
		</div>
	</div>
</header>
