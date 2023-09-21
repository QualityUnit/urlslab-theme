<?php
get_header();
global $wp_query;

?>
<div class="contentarea">
	<div id="content" class="content_right">  
		<h3>Search Result for: <?= esc_html( "$s" ); ?> </h3>
		<?php 
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post(); 
				?>
					
		<div id="post-<?php the_ID(); ?>" class="posts">
			<article>
				<h4><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a><h4>        
				<p><?php the_exerpt(); ?></p>
				<p align="right"><a href="<?php the_permalink(); ?>">Read More</a></p>
			</article>
		</div>
					<?php endwhile; ?>
		<?php endif; ?>
	</div><!-- content -->
</div><!-- contentarea -->   
<?php get_footer(); ?>
