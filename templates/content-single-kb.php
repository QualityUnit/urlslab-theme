<?php // @codingStandardsIgnoreLine
	set_source( 'kb', 'layouts/Documentation', 'css' );
	$header_category = get_the_terms( $post->ID, 'kb_categories' );
if ( ! empty( $header_category ) ) {
	$header_category = array_shift( $header_category );
	$header_category = $header_category->slug;
}

function folder_icon( $status = 'active' ) {
	$icon = file_get_contents( get_template_directory() . '/assets/images/icon-folder-' . $status . '.svg' );
	$dom  = new DOMDocument();
	libxml_use_internal_errors( true );
	$dom->loadHTML( mb_convert_encoding( $icon, 'HTML-ENTITIES', 'UTF-8' ) );
	libxml_clear_errors();
	foreach ( $dom->getElementsByTagName( 'svg' ) as $element ) {
		$element->setAttribute( 'class', 'Navigation__item--icon' );
	}
	$dom->removeChild( $dom->doctype );
	$icon = $dom->saveHtml();
	$icon = str_replace( '<html><body>', '', $icon );
	$icon = str_replace( '</body></html>', '', $icon );

	return $icon;
}

function file_icon() {
	$icon = file_get_contents( get_template_directory() . '/assets/images/icon-file.svg' );
	$dom  = new DOMDocument();
	libxml_use_internal_errors( true );
	$dom->loadHTML( mb_convert_encoding( $icon, 'HTML-ENTITIES', 'UTF-8' ) );
	libxml_clear_errors();
	foreach ( $dom->getElementsByTagName( 'svg' ) as $element ) {
		$element->setAttribute( 'class', 'Navigation__item--icon fileIcon' );
	}
	$dom->removeChild( $dom->doctype );
	$icon = $dom->saveHtml();
	$icon = str_replace( '<html><body>', '', $icon );
	$icon = str_replace( '</body></html>', '', $icon );

	return $icon;
}

$post_categories  = get_the_terms( get_the_ID(), 'kb_categories' );
$post_permalink   = get_the_permalink();
$categories       = get_categories( array( 'taxonomy' => 'kb_categories' ) );
$page_header_args = array(
	'title' => __( 'Knowledge Base', 'urlslab' ),
	// 'search' => array(
	// 	'type' => 'kb',
	// ),
	'menu'  => array(
		//'title' => 'Nejaky nazov',
	),
	'toc'   => true,
);
	$menu_items     = array();
	$category_items = array();
	$exclude_posts = array();
	$post_cat = 0;

if ( ! empty( $categories ) ) :
	foreach ( $categories as $category ) :
		$query_posts = new WP_Query(
			array(
				'kb_categories' => $category->slug,
				// @codingStandardsIgnoreLine
				'posts_per_page' => 500,
				'orderby'                  => 'date',
				'order'                    => 'ASC',
			)
		);
		if ( 0 == $category->category_parent ) {
			$main_cat_post = '';

			$query_category_posts = array(
				'kb_categories' => $category->slug,
			// @codingStandardsIgnoreLine
				// 'posts_per_page' => 1,
				'post_type'                => 'kb',
				'orderby'                  => 'date',
				'order'                    => 'ASC',
			);

			// exclude post that already have been fetched
			// this would be useful if multiple category is assigned for same post
			if ( ! empty( $exclude_posts ) ) {
					$query_category_posts['post__not_in'] = $exclude_posts;
			}

			$query = new WP_Query( $query_category_posts );

			// check if query have any post
			if ( $query->have_posts() ) {
				// start loop
				while ( $query->have_posts() ) {
					// set post global
					$query->the_post();

					// add current post id to exclusion array
					$exclude_posts[] = get_the_ID();

					// Checking if post category has parent, if not, get top article url as top category url
					$post_cat = get_the_terms( get_the_ID(), 'kb_categories' )[0]->parent;
					if ( 0 == $post_cat ) {
						$main_cat_post = get_the_permalink();
					}
				}
			}
			wp_reset_postdata();

			$category_items[] = array(
				'cat_id' => $category->term_id,
				'href'   => $main_cat_post,
				'title'  => $category->name,
				'active' => ( $post_categories[0]->parent == $category->term_id ) || ( ( get_the_permalink() === $main_cat_post ) ),
			);
		}
		while ( $query_posts->have_posts() ) :
			$query_posts->the_post();
			$menu_item_active = false;
			if ( get_the_permalink() == $post_permalink ) :
				$menu_item_active = true;
			endif;
			$menu_items[] = array(
				'cat_id' => $category->term_id,
				'title'  => get_the_title(),
				'href'   => get_the_permalink(),
				'active' => $menu_item_active,
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
		<aside class="Documentation__Sidebar">
			<ul class="Navigation">

			<?php
			foreach ( $categories as $category ) {
				if ( $category->category_parent >= 0 && $category->category_parent == $post_categories[0]->parent ) {
					?>
			<li class="Navigation__item <?= ( $post_categories[0]->term_id || $post_categories[0]->parent ) == $category->term_id ? 'active' : '' ?>">
				<a href="<?= esc_url( $category->slug ); ?>">
					<?= folder_icon(); // @codingStandardsIgnoreLine ?>
					<?= esc_html( $category->name ); ?>
				</a>
				<ul class="Navigation__sub">
					<?php
					foreach ( $menu_items as $article ) {

						if ( $category->term_id == $article['cat_id'] ) {
							?>
					<li class="Navigation__item Navigation__item--document <?= ( $article['active'] ? 'active' : '' ) ?>">
						<a href="<?= esc_url( $article['href'] ); ?>">
							<?= file_icon(); // @codingStandardsIgnoreLine ?>
							<?= esc_html( $article['title'] ); ?>
						</a>
					</li>
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
		</aside>
		<div class="Post__content">
			<div class="Content" itemprop="text" >
				<h2 itemprop="name"><?php the_title(); ?></h2>
				<?php the_content(); ?>
			</div>
		</div>
	</div>
</div>
