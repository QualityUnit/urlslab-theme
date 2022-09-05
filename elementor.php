<?php
	/**
	 * Template Name: Elementor
	 */
while ( have_posts() ) :
	the_post();
	?>
	<?php the_content(); ?>

	<?php 
endwhile;
