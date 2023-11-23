<?php
	use QualityUnit\Wrapper;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
	<?php get_template_part( 'templates/head' ); ?>
	<body <?php body_class(); ?>>
		<div id="app">
			<?php
				do_action( 'get_header' );
				get_template_part( 'templates/header' );
			?>

			<?php require Wrapper\template_path(); ?>

			<?php
				do_action( 'get_footer' );
				get_template_part( 'templates/footer' );
			?>
		</div>

		<?php wp_footer(); ?>

		<!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
					new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
				j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
				'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
			})(window,document,'script','dataLayer','GTM-T2XN5C2');</script>
		<!-- End Google Tag Manager -->
	</body>
</html>
