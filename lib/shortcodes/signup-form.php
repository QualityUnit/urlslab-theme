<?php

function signup_form() {
	ob_start();
	?>

<div class="SignupForm Form">
	<h2 class="Form__title">Sign Up</h2>
	<div class="Form__socialIcons"><span class="Form__socialIcons--icon"><svg width="46" height="46" fill="none"
				xmlns="http://www.w3.org/2000/svg">
				<circle cx="23" cy="23" r="22.5" stroke="#CED0D4"></circle>
				<path
					d="M21.02 34.88C15.32 33.86 11 28.94 11 23c0-6.6 5.4-12 12-12s12 5.4 12 12c0 5.94-4.32 10.86-10.02 11.88l-.66-.54h-2.64l-.66.54Z"
					fill="url(#facebook_svg__a)"></path>
				<path
					d="m27.68 26.36.54-3.36h-3.18v-2.34c0-.96.36-1.68 1.8-1.68h1.56v-3.06c-.84-.12-1.8-.24-2.64-.24-2.76 0-4.68 1.68-4.68 4.68V23h-3v3.36h3v8.46a11.048 11.048 0 0 0 3.96 0v-8.46h2.64Z"
					fill="#fff"></path>
				<defs>
					<linearGradient id="facebook_svg__a" x1="23.001" y1="34.165" x2="23.001" y2="10.996"
						gradientUnits="userSpaceOnUse">
						<stop stop-color="#0062E0"></stop>
						<stop offset="1" stop-color="#19AFFF"></stop>
					</linearGradient>
				</defs>
			</svg></span><span class="Form__socialIcons--icon"><svg width="46" height="46" fill="none"
				xmlns="http://www.w3.org/2000/svg">
				<circle cx="23" cy="23" r="22.5" stroke="#CED0D4"></circle>
				<g clip-path="url(#google_svg__a)">
					<path
						d="M34.988 23.584c0-.931-.078-1.611-.248-2.316H23.73v4.205h6.462c-.13 1.045-.834 2.62-2.397 3.677l-.022.14 3.481 2.607.242.023c2.215-1.977 3.492-4.886 3.492-8.336Z"
						fill="#4285F4"></path>
					<path
						d="M23.729 34.665c3.166 0 5.825-1.007 7.767-2.745l-3.701-2.77c-.99.668-2.32 1.133-4.066 1.133-3.101 0-5.734-1.976-6.672-4.709l-.137.011-3.62 2.708-.048.127c1.929 3.702 5.89 6.245 10.477 6.245Z"
						fill="#34A853"></path>
					<path
						d="M17.057 25.573a6.764 6.764 0 0 1-.39-2.241c0-.781.143-1.537.377-2.242l-.006-.15-3.666-2.75-.12.055a11.032 11.032 0 0 0-1.25 5.087c0 1.825.455 3.55 1.25 5.087l3.805-2.846Z"
						fill="#FBBC05"></path>
					<path
						d="M23.729 16.382c2.202 0 3.688.919 4.535 1.687l3.31-3.123C29.54 13.121 26.895 12 23.729 12c-4.587 0-8.548 2.543-10.477 6.245l3.792 2.846c.951-2.732 3.584-4.71 6.685-4.71Z"
						fill="#EB4335"></path>
				</g>
				<defs>
					<clipPath id="google_svg__a">
						<path fill="#fff" transform="translate(12 12)" d="M0 0h23v22.743H0z"></path>
					</clipPath>
				</defs>
			</svg></span><span class="Form__socialIcons--icon"><svg width="46" height="46" fill="none"
				xmlns="http://www.w3.org/2000/svg">
				<circle cx="23" cy="23" r="22.5" stroke="#CED0D4"></circle>
				<g clip-path="url(#twitter_svg__a)">
					<path
						d="M35 16.21a10.19 10.19 0 0 1-2.828.742 4.769 4.769 0 0 0 2.165-2.608c-.951.54-2.005.933-3.127 1.144A5.022 5.022 0 0 0 27.616 14c-2.719 0-4.924 2.11-4.924 4.712 0 .37.044.73.128 1.074-4.092-.196-7.72-2.072-10.149-4.924a4.537 4.537 0 0 0-.667 2.37c0 1.634.87 3.077 2.19 3.922a5.071 5.071 0 0 1-2.23-.59v.06c0 2.283 1.697 4.188 3.95 4.62a5.139 5.139 0 0 1-2.224.081c.627 1.873 2.445 3.235 4.6 3.273a10.164 10.164 0 0 1-6.115 2.017c-.398 0-.79-.022-1.175-.066a14.395 14.395 0 0 0 7.548 2.118c9.057 0 14.01-7.18 14.01-13.408 0-.205-.005-.408-.015-.61A9.778 9.778 0 0 0 35 16.209Z"
						fill="#2AA9E0"></path>
				</g>
				<defs>
					<clipPath id="twitter_svg__a">
						<path fill="#fff" transform="translate(11 14)" d="M0 0h24v18.667H0z"></path>
					</clipPath>
				</defs>
			</svg></span><span class="Form__socialIcons--icon"><svg width="46" height="46" fill="none"
				xmlns="http://www.w3.org/2000/svg">
				<circle cx="23" cy="23" r="22.5" stroke="#CED0D4"></circle>
				<g clip-path="url(#github_svg__a)">
					<path fill-rule="evenodd" clip-rule="evenodd"
						d="M23 11a12 12 0 0 0-3.794 23.388c.597.11.818-.265.818-.582v-2.04c-3.337.736-4.044-1.606-4.044-1.606a3.212 3.212 0 0 0-1.334-1.761c-1.082-.737.089-.737.089-.737a2.527 2.527 0 0 1 1.834 1.238 2.563 2.563 0 0 0 3.492 1.002 2.549 2.549 0 0 1 .736-1.606c-2.666-.302-5.466-1.334-5.466-5.93a4.641 4.641 0 0 1 1.23-3.22 4.368 4.368 0 0 1 .119-3.174s1.009-.324 3.3 1.23a11.35 11.35 0 0 1 6.01 0c2.292-1.555 3.294-1.23 3.294-1.23a4.346 4.346 0 0 1 .125 3.175 4.641 4.641 0 0 1 1.23 3.219c0 4.611-2.807 5.62-5.48 5.893a2.838 2.838 0 0 1 .817 2.21v3.293c0 .39.214.692.825.582A12.007 12.007 0 0 0 23 10.955V11Z"
						fill="#191717"></path>
				</g>
				<defs>
					<clipPath id="github_svg__a">
						<path fill="#fff" transform="translate(11 11)" d="M0 0h24v23.403H0z"></path>
					</clipPath>
				</defs>
			</svg></span><span class="Form__socialIcons--icon"><svg width="46" height="46" fill="none"
				xmlns="http://www.w3.org/2000/svg">
				<circle cx="23" cy="23" r="22.5" stroke="#CED0D4"></circle>
				<g clip-path="url(#linkedin_svg__a)">
					<path
						d="M30.29 30.29h-3.005v-4.71c0-1.122-.02-2.568-1.565-2.568-1.565 0-1.805 1.224-1.805 2.487v4.79h-3.007v-9.683h2.887v1.324h.037a3.165 3.165 0 0 1 2.852-1.564c3.047 0 3.607 2.004 3.607 4.612v5.312ZM17.517 19.283a1.746 1.746 0 1 1 1.745-1.746 1.754 1.754 0 0 1-1.745 1.746Zm1.502 11.007h-3.01v-9.684h3.01v9.684ZM31.79 13H14.498A1.489 1.489 0 0 0 13 14.463v17.36a1.49 1.49 0 0 0 1.498 1.465H31.79a1.49 1.49 0 0 0 1.503-1.461V14.462A1.49 1.49 0 0 0 31.79 13Z"
						fill="#0A66C2"></path>
				</g>
				<defs>
					<clipPath id="linkedin_svg__a">
						<path fill="#fff" transform="translate(11 13)" d="M0 0h24v20.436H0z"></path>
					</clipPath>
				</defs>
			</svg></span><span class="Form__socialIcons--icon"><svg width="46" height="46" fill="none"
				xmlns="http://www.w3.org/2000/svg">
				<circle cx="23" cy="23" r="22.5" stroke="#CED0D4"></circle>
				<g clip-path="url(#paypal_svg__a)">
					<path
						d="m18.54 33.215.397-2.53H13.808l2.95-18.702a.267.267 0 0 1 .053-.145.244.244 0 0 1 .182-.076h7.149c2.378 0 4.009.51 4.862 1.524.37.417.633.92.762 1.463a5.335 5.335 0 0 1 0 2.012v.579l.404.221c.307.159.583.37.815.625.356.417.584.928.656 1.471a6.38 6.38 0 0 1-.092 2.15 7.453 7.453 0 0 1-.884 2.423c-.35.6-.822 1.119-1.387 1.524a5.71 5.71 0 0 1-1.874.846 9.547 9.547 0 0 1-2.34.266h-.556c-.4.002-.786.145-1.09.404a1.66 1.66 0 0 0-.51.968l-.047.229-.716 4.466v.16a.14.14 0 0 1-.046.099.13.13 0 0 1-.076 0l-3.482.023Z"
						fill="#253B80"></path>
					<path
						d="M30.566 16.846c0 .137-.046.274-.076.419-.937 4.84-4.169 6.508-8.284 6.508H20.11a1.014 1.014 0 0 0-1.013.861l-1.067 6.813-.305 1.929a.534.534 0 0 0 .526.624h3.719a.89.89 0 0 0 .884-.762l.038-.19.701-4.443.046-.244a.891.891 0 0 1 .884-.762h.556c3.605 0 6.425-1.463 7.248-5.693.343-1.768.167-3.246-.762-4.283a3.606 3.606 0 0 0-.999-.777Z"
						fill="#179BD7"></path>
					<path
						d="m29.576 16.45-.442-.115-.473-.092a11.642 11.642 0 0 0-1.852-.13h-5.601a.9.9 0 0 0-.381.085.929.929 0 0 0-.503.67l-1.19 7.545v.221a1.013 1.013 0 0 1 1.007-.861h2.096c4.115 0 7.346-1.67 8.284-6.508 0-.145.053-.282.076-.42a4.494 4.494 0 0 0-.762-.327l-.26-.069Z"
						fill="#222D65"></path>
					<path
						d="M20.324 16.868a.921.921 0 0 1 .503-.67.899.899 0 0 1 .38-.084h5.602c.62-.004 1.24.042 1.852.137l.473.084.442.114.213.069c.264.085.519.195.762.327.282-1.79 0-3.01-.968-4.107-1.051-1.22-2.98-1.738-5.441-1.738h-7.149a1.014 1.014 0 0 0-1.005.861L13 30.738a.61.61 0 0 0 .61.709h4.42l1.105-7.034 1.189-7.545Z"
						fill="#253B80"></path>
				</g>
				<defs>
					<clipPath id="paypal_svg__a">
						<path fill="#fff" transform="translate(13 11)" d="M0 0h19.494v23H0z"></path>
					</clipPath>
				</defs>
			</svg></span><span class="Form__socialIcons--icon"><svg width="46" height="46" fill="none"
				xmlns="http://www.w3.org/2000/svg">
				<circle cx="23" cy="23" r="22.5" stroke="#CED0D4"></circle>
				<path d="M33 30a3 3 0 0 1-3 3H16a3 3 0 0 1-3-3V16a3 3 0 0 1 3-3h14a3 3 0 0 1 3 3v14Z" fill="#2DC100"></path>
				<path
					d="M26.387 20.458c-1.614.084-3.018.573-4.157 1.679-1.152 1.117-1.678 2.485-1.534 4.182-.631-.078-1.206-.164-1.783-.212-.2-.017-.437.007-.606.102-.56.317-1.099.674-1.737 1.073.117-.53.193-.993.328-1.439.098-.328.052-.51-.25-.723-1.937-1.368-2.754-3.415-2.142-5.523.564-1.95 1.953-3.133 3.84-3.749 2.576-.841 5.47.017 7.037 2.062a4.83 4.83 0 0 1 1.004 2.548Zm-7.43-.657c.016-.386-.319-.733-.715-.745a.723.723 0 0 0-.752.7.715.715 0 0 0 .707.74c.405.011.745-.3.76-.695Zm3.877-.745c-.399.007-.735.346-.729.734.008.4.338.715.748.71a.714.714 0 0 0 .718-.732.718.718 0 0 0-.738-.712Z"
					fill="#fff"></path>
				<path
					d="M30.014 30.522c-.511-.227-.98-.569-1.48-.62-.497-.053-1.02.234-1.54.287-1.584.163-3.004-.279-4.175-1.362-2.226-2.06-1.908-5.217.667-6.905 2.29-1.5 5.648-1 7.261 1.081 1.41 1.817 1.244 4.227-.477 5.753-.497.441-.676.804-.357 1.387.06.108.066.244.1.379Zm-5.819-5.633a.603.603 0 0 0 .566-.813.605.605 0 0 0-1.17.233c.011.32.281.58.604.58Zm3.75-1.201a.601.601 0 0 0-.596.575.592.592 0 0 0 .589.622.586.586 0 0 0 .596-.57.597.597 0 0 0-.588-.628Z"
					fill="#fff"></path>
			</svg></span><span class="Form__socialIcons--icon"><svg width="46" height="46" fill="none"
				xmlns="http://www.w3.org/2000/svg">
				<circle cx="23" cy="23" r="22.5" stroke="#CED0D4"></circle>
				<g clip-path="url(#yahoo_svg__a)" fill="#5F01D1">
					<path
						d="M9 20.89h1.666l.97 2.482.982-2.481h1.622l-2.442 5.874h-1.632l.668-1.556L9 20.89ZM15.93 20.793c-1.252 0-2.044 1.123-2.044 2.24 0 1.258.868 2.255 2.02 2.255.858 0 1.182-.523 1.182-.523v.407h1.453v-4.28h-1.452v.388s-.361-.487-1.159-.487Zm.308 1.376c.577 0 .875.457.875.868 0 .444-.319.88-.875.88-.461 0-.878-.377-.878-.861.001-.49.337-.888.88-.888h-.002ZM19.043 25.171V19h1.519v2.294s.36-.502 1.117-.502c.924 0 1.467.69 1.467 1.674v2.705h-1.51v-2.335c0-.333-.158-.655-.517-.655-.366 0-.557.327-.557.655v2.335h-1.52ZM25.736 20.793c-1.433 0-2.286 1.09-2.286 2.258 0 1.329 1.033 2.237 2.292 2.237 1.22 0 2.288-.868 2.288-2.215 0-1.475-1.118-2.28-2.294-2.28Zm.014 1.388c.506 0 .857.422.857.871 0 .384-.326.857-.857.857a.848.848 0 0 1-.85-.86c0-.455.303-.868.85-.868ZM30.561 20.793c-1.433 0-2.286 1.09-2.286 2.258 0 1.329 1.033 2.237 2.292 2.237 1.22 0 2.288-.868 2.288-2.215.001-1.475-1.119-2.28-2.294-2.28Zm.014 1.388c.506 0 .857.422.857.871 0 .384-.327.857-.857.857a.848.848 0 0 1-.85-.86c0-.455.303-.868.85-.868ZM34.054 25.262a1.01 1.01 0 1 0 0-2.018 1.01 1.01 0 0 0 0 2.018ZM35.395 22.873h-1.817L35.19 19H37l-1.605 3.873Z">
					</path>
				</g>
				<defs>
					<clipPath id="yahoo_svg__a">
						<path fill="#fff" transform="translate(9 19)" d="M0 0h28v7.765H0z"></path>
					</clipPath>
				</defs>
			</svg></span></div>
	<p class="Form__sub">or use your email account:</p>
	<div class="inputField has-svg"><svg viewBox="0 0 18 20" xmlns="http://www.w3.org/2000/svg">
			<path
				d="M18 19v-2c0-2.743-2.257-5-5-5H5c-2.743 0-5 2.257-5 5v2a1 1 0 0 0 2 0v-2c0-1.646 1.354-3 3-3h8c1.646 0 3 1.354 3 3v2a1 1 0 0 0 2 0Zm-9-9c2.743 0 5-2.257 5-5s-2.257-5-5-5-5 2.257-5 5 2.257 5 5 5Zm0-2C7.354 8 6 6.646 6 5s1.354-3 3-3 3 1.354 3 3-1.354 3-3 3Z">
			</path>
		</svg><input class="input__text" type="text" placeholder="Full Name" value=""></div>
	<div class="inputField has-svg"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
			<path
				d="M4 3C2.35 3 1 4.35 1 6v12c0 1.65 1.35 3 3 3h16c1.65 0 3-1.35 3-3V6c0-1.65-1.35-3-3-3H4Zm0 2h16c.55 0 1 .45 1 1v12c0 .55-.45 1-1 1H4c-.55 0-1-.45-1-1V6c0-.55.45-1 1-1Z">
			</path>
			<path
				d="M21.427 5.181 12 11.779 2.573 5.181a.998.998 0 1 0-1.146 1.638l10 7a.999.999 0 0 0 1.146 0l10-7a.998.998 0 1 0-1.146-1.638Z">
			</path>
		</svg><input class="input__text" type="email" placeholder="Your email" value=""></div>
	<div class="inputField has-svg"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
			<path
				d="M19 10H5a3 3 0 0 0-3 3v7a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3v-7a3 3 0 0 0-3-3Zm0 2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7a1 1 0 0 1 1-1h14Z">
			</path>
			<path
				d="M8 11V7c0-1.061.421-2.078 1.172-2.828a3.995 3.995 0 0 1 5.656 0A3.995 3.995 0 0 1 16 7v4a1 1 0 0 0 2 0V7a6.003 6.003 0 0 0-1.757-4.243 6.003 6.003 0 0 0-8.486 0A6.003 6.003 0 0 0 6 7v4a1 1 0 0 0 2 0Z">
			</path>
		</svg><input class="input__text" type="password" placeholder="Password" value=""></div>
	<div class="checkbox"><input type="checkbox" id="productUpdates"><label for="productUpdates">Send me product updates
			and other promotional offers</label></div><button type="submit"
		class="Button Button--full Button--medium"><span>Sign up for free</span></button>
	<p><small>By signing up, I accept <a href="">T&amp;C</a> and <a href="">Privacy Policy</a>.</small></p>
	<p>Already have account? <a href="">Log in</a></p>
</div>

<?php // @codingStandardsIgnoreStart ?>

<?php 
	return ob_get_clean();
}
add_shortcode( 'signupform', 'signup_form' );
