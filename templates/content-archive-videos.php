<?php // @codingStandardsIgnoreLine
set_custom_source( 'layouts/Archive' );
set_custom_source( 'pages/Category' );
set_custom_source( 'filter', 'js' );
$categories = array_unique( get_categories( array( 'taxonomy' => 'videos_categories' ) ), SORT_REGULAR );
if ( is_tax( 'videos_categories' ) ) :
	$page_header_title = single_cat_title();
	$page_header_description = the_archive_description();
else :
	$page_header_title = __( 'Videos', 'urlslab' );
endif;
if ( is_tax( 'videos_categories' ) ) :
	$page_header_title = single_term_title( '', false );
	$page_header_text = term_description();
endif;
$filter_itecategories = array(
	array(
		'checked' => true,
		'value' => '',
		'title' => __( 'Any', 'urlslab' ),
	),
);
foreach ( $categories as $category ) :
	$filter_itecategories[] = array(
		'value' => $category->slug,
		'title' => $category->name,
	);
endforeach;
$filter_items = array(
	array(
		'type' => 'radio',
		'name' => 'category',
		'title' => __( 'Category', 'urlslab' ),
		'items' => $filter_itecategories,
	),
);
$page_header_args = array(
	'type' => 'lvl-1',
	'image' => array(
		'src' => get_template_directory_uri() . '/assets/images/compact_header_webinars.png?ver=' . THEME_VERSION,
		'alt' => $page_header_title,
	),
	'title' => $page_header_title,
	'text' => do_shortcode( '[urlslab-generator id="6"]' ),
	'search' => array(
		'type' => 'academy',
	),
	'filter' => $filter_items,
);
?>

<div class="Archive" >
	<?php get_template_part( 'lib/custom-blocks/compact-header', null, $page_header_args ); ?>

	<div class="wrapper Category__container">
		<div class="Category__content">
			<ul class="Category__content__items list">
				<?php
				while ( have_posts() ) :
					the_post();

					$category = '';

					$categories = get_the_terms( 0, 'videos_categories' );

					if ( ! empty( $categories ) ) {
						foreach ( $categories as $category_item ) {
							$category_item = array_shift( $categories );
							$category     .= $categories->slug;
							$category     .= ' ';
						}
					}

					$category = substr( $category, 0, -1 );
					?>

					<li class="Category__item Category__item--videos" data-category="<?= esc_attr( $category ); ?>" data-href="<?php the_permalink(); ?>">
						<a href="<?php the_permalink(); ?>" class="Category__item__thumbnail">
							<img src="https://i.ytimg.com/vi/<?php echo esc_attr( get_post_meta( get_the_ID(), 'mb_videos_mb_videos_video_id', true ) ); ?>/hqdefault.jpg" alt="<?php _e( 'Videos', 'urlslab' ); ?>">
						</a>
							<h3 class="Category__item__title item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<div class="Category__item__excerpt item-excerpt">
								<a href="<?php the_permalink(); ?>">
									<?= esc_html( wp_trim_words( get_the_excerpt(), 10 ) ); ?>
								</a>
							</div>
					</li>

					<?php
						$category = '';
					?>

				<?php endwhile; ?>
			</ul>
		</div>
	</div>

</div>
