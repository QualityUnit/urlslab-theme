<?php

function ms_languages( $atts ) {
	$regions = array(
		'europe'  => __( 'Europe', 'ms' ),
		'asia'    => __( 'Asia', 'ms' ),
		'mideast' => __( 'Middle East', 'ms' ),
		'america' => __( 'America', 'ms' ),
	);

	$atts = shortcode_atts(
		array(
			'europe_from'  => '0',
			'europe_to'    => '8',
			'asia_from'    => '0',
			'asia_to'      => '0',
			'mideast_from' => '0',
			'mideast_to'   => '0',
			'america_from' => '8',
			'america_to'   => '10',
		),
		$atts,
		'languages'
	);


	$languages = icl_get_languages();
	foreach ( $languages as $lang ) {
			$lang_codes[]      = $lang['language_code'];
			$lang_flags[]      = strtolower( preg_replace( '/.+?_/', '', $lang['default_locale'] ) );
			$lang_flags_src[]  =
			get_template_directory_uri() . '/assets/images/flags/' . strtolower(
				preg_replace( '/.+?_/', '', $lang['default_locale'] ) . '.svg'
			);
				$lang_urls[]   = $lang['url'];
				$lang_names[]  = $lang['native_name'];
				$lang_active[] = $lang['active'];
	}
	function create_menu( $region, $atts, $lang_urls, $lang_flags, $lang_flags_src, $lang_codes, $lang_names, $lang_active ) {
		?>
		<ul>
			<?php
			for ( $i = $atts[ $region . '_from' ]; $i < $atts[ $region . '_to' ]; $i++ ) {
				?>
			<li class="LanguageSwitcher__item LanguageSwitcher__item--<?= esc_html( $lang_codes[ $i ] ) ?>" data-region="<?= esc_attr( $region ) ?>" lang="<?= esc_attr( $lang_codes[ $i ] ) ?>">
				<?php
				if ( ! $lang_active[ $i ] ) {
					?>
				<a class="LanguageSwitcher__item--link" href="<?= esc_url( $lang_urls[ $i ] ); ?>">
					<img class="LanguageSwitcher__item--flag flag-<?= esc_attr( $lang_flags[ $i ] ) ?>" src="<?= esc_url( $lang_flags_src[ $i ] ) ?>" alt="<?= esc_attr( $lang_codes[ $i ] ) ?>" />
					<?= esc_html( $lang_names[ $i ] ) ?>
				</a>
					<?php
				} else {
					?>
				<span class="LanguageSwitcher__item--link active">
					<img class="LanguageSwitcher__item--flag flag-<?= esc_attr( $lang_flags[ $i ] ) ?>" src="<?= esc_url( $lang_flags_src[ $i ] ) ?>" alt="<?= esc_attr( $lang_codes[ $i ] ) ?>" />
					<?= esc_html( $lang_names[ $i ] ) ?>
				</span>
					<?php
				}
				?>
			</li>
				<?php
			}
			?>
		</ul>
		<?php
	}
	ob_start();
	?>
<div class="LanguageSwitcher__main">
	<ul>
		<?php
		foreach ( $languages as $lang ) {
			if ( $lang['active'] ) {
				$lang_flag = strtolower( preg_replace( '/.+?_/', '', $lang['default_locale'] ) );
				echo '<li class="LanguageSwitcher__item LanguageSwitcher__item--active LanguageSwitcher__item--' . esc_html( $lang['language_code'] ) . '" lang="' . esc_attr( $lang['language_code'] ) . '"><span id="languageSwitcher-toggle" class="LanguageSwitcher__item--toggle"><img class="LanguageSwitcher__item--flag flag-' . esc_attr( $lang_flag ) . '" src="' . esc_url( get_template_directory_uri() . '/assets/images/flags/' . $lang_flag . '.svg' ) . '" alt="' . esc_attr( $lang['language_code'] ) . '" /></span>';
			}
		}
		?>

		<div class="LanguageSwitcher__mainmenu">
		<?php
		foreach ( $regions as $region => $name ) {
			if ( ! empty( $atts[ $region . '_from' ] || $atts[ $region . '_to' ] ) ) {
				?>
					<input class="input--region hidden" name="regions" type="radio" id="<?= esc_attr( $region ) ?>" />
					<?php
			}
		}
		?>
			<div class="LanguageSwitcher__region--switchers">
				<?php
				foreach ( $regions as $region => $name ) {
					if ( ! empty( $atts[ $region . '_from' ] || $atts[ $region . '_to' ] ) ) {
						?>
				<label class="LanguageSwitcher__region--switcher" for="<?= esc_attr( $region ) ?>"><?= esc_html( $name ) ?></label>
						<?php
					}
				}
				?>
			</div>
			<div class="LanguageSwitcher__regions">
				<?php

				foreach ( $regions as $region => $name ) {
					if ( ! empty( $atts[ $region . '_from' ] || $atts[ $region . '_to' ] ) ) {
						?>
					<div class="LanguageSwitcher__region LanguageSwitcher__region--<?= esc_html( $region ) ?>">
						<h4 class="LanguageSwitcher__region--title"><?= esc_html( $name ) ?></h4>
							<?php
								create_menu( $region, $atts, $lang_urls, $lang_flags, $lang_flags_src, $lang_codes, $lang_names, $lang_active );
							?>
					</div>
						<?php
					}
				}
				?>
			</div>
		</div>
		</li>
		<!-- END OF LANGUAGE MENU -->
	</ul>
</div>
	<?php
		return ob_get_clean();
}
add_shortcode( 'languages', 'ms_languages' );
