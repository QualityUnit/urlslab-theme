const URLSLAB_API_HOST = 'https://api.urlslab.com';

// login function for URLsLab Auth
const login = async ( provider ) => {
	try {
		const response = await fetch( `${ URLSLAB_API_HOST }/signin/${ provider }` );
		if ( ! response.ok ) {
			throw new Error( `HTTP error! status: ${ response.status }` );
		}
		return await response.json();
	} catch ( error ) {}
};

window.addEventListener( 'load', function() {
	const signupButtonsDiv = document.querySelector( '.SignupButtons' );

	if ( signupButtonsDiv ) {
		const buttons = signupButtonsDiv.querySelectorAll( 'button' );
		document.addEventListener( 'click', ( e ) => {
			console.log( 'button clicked' );
			if ( e.target.hasAttribute( 'data-provider' ) ) {
				// Display Loading...
				const loadingEl = document.createElement( 'span' );
				loadingEl.textContent = 'Loading...';
				e.target.parentNode.appendChild( loadingEl );

				// call Login
				const provider = e.target.getAttribute( 'data-provider' );
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
						e.target.parentNode.removeChild( loadingEl );
					} );
			}
		} );
	}
} );
