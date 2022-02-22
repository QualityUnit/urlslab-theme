<?php
the_content();
wp_link_pages(
	array(
		'before' => '<nav><p>' . __( 'Pages:', 'urlslab' ),
		'after' => '</p></nav>',
	)
);
