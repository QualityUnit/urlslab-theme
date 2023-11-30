<?php
the_content();

if ( ! is_page( 'sitemap' ) && ! is_front_page() ) {
	?>
	<div class="SimilarSources SimilarSources--blog">
		<div class="wrapper">
			<div class="SimilarSources__title h4"><?php _e( 'Related Articles', 'ms' ); ?></div>

			<?php echo do_shortcode( '[urlslab-related-resources related-count="4" show-image="true" show-summary="true"]' ); ?>
		</div>
	</div>
<?php } ?>
