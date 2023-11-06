<?php
function banner( $attr ) {
		return '
			<div class="ImproveBanner">
				<div class="ImproveBanner__text">
					<h4>' . esc_html( $attr['title'] ) . '</h4>
					<p>' . esc_html( $attr['content'] ) . '</p>
					<a href="https://wordpress.org/plugins/urlslab/" target="_blank" class="Button Button--full pt-s pb-s">' . esc_html( $attr['button'] ) . '</a>
				</div>
					<img src="' . get_template_directory_uri() . '/assets/images/modules_stack.png" class="ImproveBanner__image" alt="' . esc_attr( $attr['title'] ) . '" />
			</div>
		';
}
