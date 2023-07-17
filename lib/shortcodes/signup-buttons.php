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
    <button
      class="Button Button--outline Button--medium"
      role="button"
			data-provider="google"
    >
      <span
        class="SignupButtons--icon"
      >
        <?php include( get_template_directory() . '/assets/images/FormSocialIcons/google.svg' ); ?>
      </span>
      <?php _e( 'Sign in with Google', 'urlslab' ); ?>
    </button>
    <button class="Button Button--outline Button--medium" data-provider="facebook" role="button" id="facebook-signup-button">
      <span class="SignupButtons--icon">
        <?php include( get_template_directory() . '/assets/images/FormSocialIcons/facebook.svg' ); ?>
      </span>
      <?php _e( 'Sign in with Facebook', 'urlslab' ); ?>
    </button>
  </div>

	<?php
  set_custom_source( 'shortcodes/SignupButtons' );

	return ob_get_clean();
}

add_shortcode( 'signup-buttons', 'signupbuttons' );
