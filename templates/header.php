<header>
	<div>
		<a href="<?= esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
		<nav>
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
		

			<div class="LanguageSwitcher">
				<?php
				if ( is_active_sidebar( 'languageswitcher' ) ) :
					dynamic_sidebar( 'languageswitcher' );
				endif;
				?>
			</div>
	</div>
</header>
