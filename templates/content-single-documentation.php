<?php // @codingStandardsIgnoreLine
	set_source( 'documentation', 'pages/Directory', 'css' );
	set_source( 'documentation', 'pages/Documentation', 'css' );
	$header_category = get_the_terms( $post->ID, 'documentation_categories' );
if ( ! empty( $header_category ) ) {
	$header_category = array_shift( $header_category );
	$header_category = $header_category->slug;
}
$post_permalink   = get_the_permalink();
$categories       = get_categories( array( 'taxonomy' => 'documentation_categories' ) );
$page_header_args = array(
	'image' => array(
		'type' => 'main',
		'src'  => get_template_directory_uri() . '/assets/images/compact_header_about_us.png?ver=' . THEME_VERSION,
		'alt'  => get_the_title(),
	),
	'logo'  => array(
		'src' => get_template_directory_uri() . '/assets/images/icon-book.svg?ver=' . THEME_VERSION,
		'alt' => __( 'Documentation', 'urlslab' ),
	),
	'title'  => __( 'Documentation', 'urlslab' ),
	'search' => array(
		'type' => 'documentation',
	),
	'menu' => array(
		//'title' => 'Nejaky nazov',
	),
	'toc'   => true,
	);
	$menu_items = array();
	$category_items = array();
	if ( ! empty( $categories ) ) :
		foreach ( $categories as $category ) :
			$query_glossary_posts = new WP_Query(
				array(
					'documentation_categories' => $category->slug,
					// @codingStandardsIgnoreLine
					'posts_per_page' => 500,
					'orderby'             => 'date',
					'order'               => 'ASC',
				)
			);
			if ( 0 == $category->category_parent ) {
				$category_items[] = array(
					'cat_id' => $category->term_id,
					'href'   => $category->slug,
					'title'  => $category->name,
					'active' => false,
				);
			}
			while ( $query_glossary_posts->have_posts() ) :
				$query_glossary_posts->the_post();
				$menu_item_active = false;
				if ( get_the_permalink() == $post_permalink ) :
					$menu_item_active = true;
				endif;
				$menu_items[] = array(
					'cat_id'        => $category->term_id,
					'title' => get_the_title(),
					'href'          => get_the_permalink(),
					'active'        => $menu_item_active,
				);
				
				endwhile;
			wp_reset_postdata();
		endforeach;
		wp_reset_postdata();
endif;
	$page_header_args['menu']['items'] = $category_items;
	?>

<div class="Post Post--sidebar-right documentation" itemscope itemtype="http://schema.org/TechArticle">
	<meta itemprop="url" content="<?= esc_url( get_permalink() ); ?>">
	<span itemprop="publisher" itemscope itemtype="http://schema.org/Organization"><meta itemprop="name" content="Quality Unit"></span>
	
	<?php get_template_part( 'lib/custom-blocks/compact-header', null, $page_header_args ); ?>
	
	<div class="wrapper Post__container">
		<ul class="sidebar">
			<?php
			foreach ( $categories as $category ) {
				if ( $category->category_parent > 0 ) {
					?>
			<li>
				<a href="<?= esc_url( $category->slug ); ?>">
					<?= esc_html( $category->name ); ?>
				</a>
				<ul>
					<?php
					foreach ( $menu_items as $article ) {

						if ( $category->term_id == $article['cat_id'] ) {
							?>
					<li class="<?= ( $article['active'] ? 'active' : '' ) ?>"><a href="<?= esc_url( $article['href'] ); ?>"><?= esc_html( $article['title'] ); ?></a></li>
							<?php
						}
					}
					?>
				</ul>
			</li>
						<?php 
				}
			} 
			?>
		</ul>
		<div class="Post__content">
			<div class="Content" itemprop="text" >
				<h2 itemprop="name"><?php the_title(); ?></h2>
				<?php the_content(); ?>
			</div>
		</div>
	</div>
</div>
