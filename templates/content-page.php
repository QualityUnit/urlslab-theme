<?php
the_content();

if ( ! is_page( 'sitemap' ) && ! is_front_page() ) {

	$related_resources = do_shortcode( '[urlslab-related-resources url="' . get_the_permalink() . '" related-count="4" show-image="true" show-summary="true"]' );

	if ( ! empty( $related_resources ) ) {
		?>
	<div class="SimilarSources SimilarSources--blog">
		<div class="wrapper">
			<div class="SimilarSources__title h4"><?php _e( 'Related Articles', 'ms' ); ?></div>
			<?= wp_kses_post( $related_resources ); ?>
		</div>
	</div>
	<?php } ?>
<?php } ?>
