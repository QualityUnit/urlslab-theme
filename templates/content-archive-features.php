<?php // @codingStandardsIgnoreLine
set_custom_source( 'layouts/Archive' );
set_custom_source( 'filter', 'js' );
$categories = array_unique( get_categories( array( 'taxonomy' => 'features_categories' ) ), SORT_REGULAR );
if ( is_tax( 'features_categories' ) ) :
	$page_header_title       = single_cat_title();
	$page_header_description = the_archive_description();
else :
	$page_header_title       = __( 'Features', 'urlslab' );
	$page_header_description = __( 'Discover all the features the UrlsLab plugin has to offer and start optimizing your website.', 'urlslab' );
endif;
$filter_items_categories = array(
	array(
		'checked' => true,
		'value'   => '',
		'title'   => __( 'Any', 'urlslab' ),
	),
);
foreach ( $categories as $category ) :
	$filter_items_categories[] = array(
		'value' => $category->slug,
		'title' => $category->name,
	);
endforeach;
$filter_items     = array(
	array(
		'type'  => 'radio',
		'name'  => 'category',
		'title' => __( 'Category', 'urlslab' ),
		'items' => $filter_items_categories,
	),
);
$page_header_args = array(
	'type'   => 'lvl-1',
	'image'  => array(
		'src' => get_template_directory_uri() . '/assets/images/features_img.png?ver=' . THEME_VERSION,
		'alt' => $page_header_title,
	),
	'title'  => $page_header_title,
	'text'   => $page_header_description,
	'filter' => $filter_items,
	'search' => array(
		'type' => 'academy',
	),
);
?>

<div class="Posts Features" itemScope itemType="http://schema.org/Collection">
	<?php get_template_part( 'lib/custom-blocks/compact-header', null, $page_header_args ); ?>

	<div class="wrapper">
			<ul class="Posts__items Archive__columns list">
				<?php
				while ( have_posts() ) :
					the_post();

						$category = '';


						$categories = get_the_terms( 0, 'features_categories' );

					if ( ! empty( $categories ) ) {
						foreach ( $categories as $category_item ) {
								$category .= $category_item->slug;
								$category .= ' ';
						}
					}
					?>

					<li class="Posts__item 
					<?php
					if ( get_post_meta( get_the_ID(), 'main', true ) ) {
						echo 'main pillar full';
					} else {
						echo 'col-3';
					}
					?>
					<?= esc_attr( $category ); ?> " data-category="<?= esc_attr( $category ); ?>" data-href="<?php the_permalink(); ?>">
						<a href="<?php the_permalink(); ?>" class="Posts__item--inn flex-tablet-landscape flex-align-center">
							<div class="Posts__item--header">
									<div class="Posts__item--image">
										<?php
												the_post_thumbnail( 'person_thumbnail' );
										?>
									</div>

									<?php 
									if ( ! get_post_meta( get_the_ID(), 'main', true ) ) {
										?>
									<ul class="Posts__item--categories">
										<?php
										if ( ! empty( $categories ) ) {
											foreach ( $categories as $category_item ) {
													$category_name = $category_item->name;
												?>
										<li class="Posts__item--category category"><?= esc_html( $category_name ); ?></li>
												<?php
											}
										}
										?>
									</ul>
									<?php } ?>
							</div>
							<div class="Posts__item--content">
								<h4 data-title><?php the_title(); ?></h4>
								<div class="Posts__item--excerpt" data-excerpt>
									<?= esc_html( wp_trim_words( get_the_excerpt(), 16 ) ); ?>
								</div>
								<?php
								if ( get_post_meta( get_the_ID(), 'main', true ) ) {
									?>
								<p class="learn-more icn-arrow-right">
									<?php _e( 'Learn more', 'urlslab' ); ?>
								</p>
								<?php } ?>
							</div>
						</a>
					</li>

					<?php
						$category = '';
					?>

				<?php endwhile; ?>
			</ul>
	</div>

</div>
