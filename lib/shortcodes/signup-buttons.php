<?php

function signupbuttons( $atts ) {
	$atts = shortcode_atts(
		array(
			'class' => 'inline',
		),
		$atts,
		'signup-buttons'
	);

	ob_start();
	?>

  <div class="SignupButtons <?= esc_attr( $atts['class'] ); ?>" >
	<a
	  class="Button Button--outline Button--medium"
	  role="button"
			href="https://api.urlslab.com/v1/auth/signin/google"
	>
	  <span
		class="SignupButtons--icon"
	  >
		<?php include( get_template_directory() . '/assets/images/FormSocialIcons/google.svg' ); // @codingStandardsIgnoreLine ?>
	  </span>
	  <?php _e( 'Sign in with Google', 'urlslab' ); ?>
	</a>
  </div>

	<?php
	set_custom_source( 'shortcodes/SignupButtons' );

	return ob_get_clean();
}

add_shortcode( 'signup-buttons', 'signupbuttons' );
