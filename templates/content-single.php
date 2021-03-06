<?php while ( have_posts() ) :
	the_post(); ?>
	<article <?php post_class(); ?>>
		<header>
			<h1><?php the_title(); ?></h1>
			<time datetime="<?= esc_attr( get_post_time( 'c', true ) ); ?>"><?= get_the_date(); ?></time>
			<p><?= esc_html( __( 'By', 'urlslab' ) ); ?> <a href="<?= esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?= get_the_author(); ?></a></p>
		</header>
		<div>
			<?php the_content(); ?>
		</div>
		<footer>
			<?php
			wp_link_pages(
				array(
					'before' => '<nav><p>' . __( 'Pages:', 'urlslab' ),
					'after' => '</p></nav>',
				)
			);
			?>
		</footer>
	</article>
<?php endwhile; ?>
