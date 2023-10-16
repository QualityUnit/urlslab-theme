<?php // @codingStandardsIgnoreLine
	set_source( 'kb', 'layouts/Documentation', 'css' );
?>

<div class="Post Post--sidebar-right documentation" itemscope itemtype="http://schema.org/TechArticle">
	<meta itemprop="url" content="<?= esc_url( get_permalink() ); ?>">
	<span itemprop="publisher" itemscope itemtype="http://schema.org/Organization"><meta itemprop="name" content="Quality Unit"></span>

	<div class="wrapper Post__container">
		<div class="Post__content">
			<div class="Content" itemprop="text" >
				<h2 itemprop="name"><?php the_title(); ?></h2>
				<?php the_content(); ?>
			</div>
		</div>
	</div>
</div>
