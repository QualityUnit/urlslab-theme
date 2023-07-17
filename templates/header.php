<?php
//set_custom_source( 'urlslab_auth', 'js' );
?>

<header class="Header">
	<div class="wrapper">
		<div class="Logo">
			<a href="<?= esc_url( home_url( '/' ) ); ?>">
				<img alt="URLsLab" loading="lazy" width="139" height="34" src="<?= esc_url( get_template_directory_uri() . '/assets/images/urlslab-logo.svg' ); ?>" />
			</a>
		</div>
		<div class="Header__items">
			<nav class="Header__navigation">
				<?php
				if ( has_nav_menu( 'header_navigation' ) ) :
					wp_nav_menu(
						array(
							'theme_location' => 'header_navigation',
							'menu_class' => 'nav',
						)
					);
				endif;
				?>
				<a class="Button Button--secondary" href="<?php esc_url( '/download/', 'urlslab' ); ?>"><span><?php _e( 'Get plugin', 'urlslab' ); ?></span></a>
				<div class="pos-relative flex flex-align-center">
					<button type="button" id="loginBtn" class="Button Button--login"><span><?php _e( 'Login', 'urlslab' ); ?></span></button>
						<div class="Form Form__socialIcons__wrap pos-absolute fadeInto" id="loginForm" style="display: none; top: 100%; right: 0; min-width: auto">
							<div class="mb-s fs-m"><strong><?php _e( 'Login to URLsLab', 'urlslab' ); ?></strong></div>
							<?php echo do_shortcode( '[signup-buttons class="fullsize"]' ); ?>
						</div>
				</div>
			</nav>
		</div>
	</div>
</header>

<script>
	const loginBtn = document.querySelector( '#loginBtn' );
	const loginForm = document.querySelector( '#loginForm' );

	loginBtn.addEventListener( 'click', ( event ) => {
		const loginShown = loginForm.style.display;

		if ( loginShown === 'none' ) {
			loginForm.style.display = 'block';
			return false;
		}
		loginForm.style.display = 'none';
	} );

	const URLSLAB_API_HOST = 'https://api.urlslab.com';

	// login function for URLsLab Auth
	const login = async ( provider ) => {
		try {
			const response = await fetch(`${URLSLAB_API_HOST}/signin/${provider}`, {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json',
				},
				credentials: 'include',
			});
			if ( ! response.ok ) {
				throw new Error( `HTTP error! status: ${ response.status }` );
			}
			return await response.json();
		} catch ( error ) {}
	};

	document.querySelector( 'body' ).addEventListener( 'click', ( event ) => {
		event.stopPropagation();
		if ( event.target.id !== ( 'loginForm' ) && event.target.id !== ( 'loginBtn' ) ) {
			loginForm.style.display = 'none';
		}

		if ( event.target.hasAttribute( 'data-provider' ) ) {
			// Display Loading...
			const loadingEl = document.createElement( 'span' );
			loadingEl.textContent = 'Loading...';
			event.target.parentNode.appendChild( loadingEl );

			// call Login
			const provider = event.target.getAttribute( 'data-provider' );
			console.log( 'logging in with provider: ', provider );
			login( provider )
				.then( ( response ) => {
					// Check if there should be a redirect
					if ( response && response.redirectUrl ) {
						window.location.href = response.redirectUrl;
					}
				} )
				.finally( () => {
					// remove loading message
					event.target.parentNode.removeChild( loadingEl );
				} );
		}

	} );
</script>
