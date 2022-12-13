<header class="Header">
	<div class="wrapper">
		<div class="Header__logo">
			<a href="<?= esc_url( home_url( '/' ) ); ?>">
				<img src="<?= esc_url( get_template_directory_uri() . '/assets/images/urlslab-logo.svg?' . THEME_VERSION ); ?>" alt="<?php bloginfo( 'name' ); ?>">
			</a>
		</div>
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
		</nav>
	</div>
</header>
