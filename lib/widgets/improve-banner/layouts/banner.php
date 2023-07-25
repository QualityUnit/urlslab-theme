<?php 
function banner( $attr ) {
		return '
			<div class="ImproveBanner">
				<div class="ImproveBanner__text">
					<h4>Improve your website</h4>
					<p>Get started today and download the URLsLab WordPress plugin</p>
					<a href="/download" class="Button Button--full pt-s pb-s">Get the WordPress plugin</a>
				</div>
					<img src="' . get_template_directory_uri() . '/assets/images/modules_stack.png" class="ImproveBanner__image" alt="' . __( 'Improve your website', 'urlslab' ) . '" />
			</div>
		';
}
