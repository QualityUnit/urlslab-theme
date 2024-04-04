<?php
set_source( false, 'pages/post', 'css' );
set_source( false, 'components/SidebarTOC', 'css' );
set_source( false, 'splide', 'js' );
global $post;
$page_header_args = array(
	'title' => get_the_title(),
	'text'  => do_shortcode( '[urlslab-generator id="4"]' ),
	'toc'   => true,
);
while ( have_posts() ) :
	the_post();
	?>
	<div class="Post" itemscope itemtype="http://schema.org/BlogPosting">
	<meta itemprop="url" content="<?= esc_url( get_permalink() ); ?>">
	<span itemprop="publisher" itemscope itemtype="http://schema.org/Organization"><meta itemprop="name" content="LiveAgent"></span>
	<?php get_template_part( 'lib/custom-blocks/compact-header', null, $page_header_args ); ?>

	<div class="wrapper Post__container">
		<div class="Post__content Post__content--page">
			<div class="Content" itemprop="articleBody">
	<?php
	get_template_part( 'templates/content', 'page' );
endwhile;
?>
			</div>
		</div>
	</div>
</div>
