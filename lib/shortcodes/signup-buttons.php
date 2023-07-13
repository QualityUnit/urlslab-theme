<?php

function signupbuttons( $atts ) {
	$atts = shortcode_atts(
    array(),
		$atts,
		'signup-buttons'
  );

  ob_start();
	?>

  <div class="SignupButtons inline">
    <a
      class="Button Button--outline Button--medium"
      href=''
      role="button"
    >
      <span
        class="SignupButtons--icon"
      >
        <?php include_once( get_template_directory() . '/assets/images/FormSocialIcons/google.svg' ); ?>
      </span>
      <?php _e( 'Sign in with Google', 'urlslab' ); ?>
    </a>
    <a class="Button Button--outline Button--medium" href='' role="button">
      <span class="SignupButtons--icon">
        <?php include_once( get_template_directory() . '/assets/images/FormSocialIcons/facebook.svg' ); ?>
      </span>
      <?php _e( 'Sign in with Facebook', 'urlslab' ); ?>
    </a>
  </div>

	<?php
  set_custom_source( 'shortcodes/SignupButtons' );

	return ob_get_clean();
}

add_shortcode( 'signup-buttons', 'signupbuttons' );
