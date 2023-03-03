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
			?>

			<?php require Wrapper\template_path(); ?>

			<?php
				do_action( 'get_footer' );
			?>
		</div>

		<?php wp_footer(); ?>
	</body>
</html>
