<?php
	/**
	 * Template Name: Elementor
	 */
?>
<?php
while ( have_posts() ) :
	the_post();
	?>
	<?php the_content(); ?>

<?php endwhile; ?>
