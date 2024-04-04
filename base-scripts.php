<script>

	const getCookieFrontend = ( name ) => {
		const nameEq = `${name}=`
		const ca = document.cookie.split( ";" )
		for ( let i = 0; i < ca.length; i += 1 ) {
			let c = ca[ i ]
			while ( c.charAt( 0 ) === " " ) {
				c = c.substring( 1, c.length )
			}
			if ( c.indexOf( nameEq ) === 0 ) {
				return c.substring( nameEq.length, c.length )
			}
		}
		return null
	}

	const mobile = window.matchMedia('(max-width: 768px)');

	const acceptButton = document.querySelector( ".Medovnicky__button--yes" );

	acceptButton.addEventListener( "click", () => {

		const demobarNow = document.querySelector('#demobar');

		if( demobar ) {
			demobarNow.classList.add( 'visible' );

			setTimeout( () => {
				demobarNow.classList.add( 'show' );
			}, 5000 );
		}

		gtmWithCookie();
		postAffiliate();
	});

</script>


<!-- Post Affiliate Pro -->
<script type="text/javascript">
	function postAffiliate() {
		(function(d,t) {
			var script = d.createElement(t); script.id= 'pap_x2s6df8d'; script.async = true;
			script.src = '//pap.qualityunit.com/scripts/m3j58hy8fd';
			script.onload = script.onreadystatechange = function() {
				var rs = this.readyState; if (rs && (rs != 'complete') && (rs != 'loaded')) return;
				PostAffTracker.setAccountId('default1');
				if ( !getCookieFrontend( "cookieLaw" ) ) {
					try {
						PostAffTracker.disableTrackingMethod('C');
						PostAffTracker.track();
					} catch (e) {}
				}
				if ( getCookieFrontend( "cookieLaw" ) ) {
					try {
						PostAffTracker.enableTrackingMethods();
						PostAffTracker.track();
					} catch (e) {}
				}
			}
			var placeholder = document.getElementById('papPlaceholder');
			placeholder.parentNode.insertBefore(script, placeholder);
		})(document, 'script');
	}

	if ( ! mobile.matches ) {
		postAffiliate()
	}

	if ( mobile.matches && getCookieFrontend( "cookieLaw" ) ) {
		postAffiliate()
	}
</script>

<!-- Google Tag Manager -->
<script>
	function gtmWithCookie() {
		(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
				new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
			j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
			'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-T2XN5C2');
	}
	if ( getCookieFrontend( "cookieLaw" ) ) {
		gtmWithCookie()
	}
</script>
<!-- End Google Tag Manager -->

<!-- Chat Button Loader -->
<script>
	function loadChatBot( { chatbotId, chatbotUserId, btnTarget } ) {
		const chatBotButton = document.querySelector( btnTarget );
		chatBotButton.classList.remove('hidden');
			
		(function(d, src, c) { var t=d.scripts[d.scripts.length - 1],s=d.createElement('script');s.async=true;s.src=src;s.onload=s.onreadystatechange=function(){var rs=this.readyState;if(rs&&(rs!='complete')&&(rs!='loaded')){return;}c(this);};t.parentElement.insertBefore(s,t.nextSibling);})(document,
		'https://www.urlslab.com/public/w/v1/urlslab-chat-widget.js',
		function(e){
			const chatbotManager = UrlslabChatbot.initChatbot({
				showChatButton: false, // important to not show chat button on page load
				chatbotId: chatbotId,
				chatbotUserId: chatbotUserId,
				welcomeMessage: 'Hi, I\'m URLsLab Bot. How can I help you?',
				inputPlaceholder: 'Ask me any question...',
				suggestedUserMessages: [],
				urlSuffix: '?utm_medium=chatbot&utm_source=urlslab',
				maxWindowWidth: '500px',
			});
			chatBotButton.addEventListener('click', () => {
				chatbotManager.openChat();
			});
		});
	}
</script>

<?php
if (
		! is_page( array( 'request-demo', 'demo', 'trial', 'thank-you', 'free-account' ) )
	) {
	?>

	<button class="ContactUs__chatBotOnly hidden" id="chatBotOnly" rel="nofollow noopener external">
		<img class="ContactUs__icon" src="<?= esc_url( get_template_directory_uri() . '/assets/images/contact/chatbot.svg' ); ?>" />
	</button>

	<script type="text/javascript" id="urlslab-chatbot-script">
	const chatBtnOptions = {btnTarget: '#chatBotOnly', chatbotId: '3ebb1d2f-a75c-4df5-9a51-83cc1551557d', chatbotUserId: 'b3JnLnBhYzRqLm9pZGMucHJvZmlsZS5PaWRjUHJvZmlsZToxMTEzNzg1MDQzOTkwMjg3MjAwMTVAQEAzZWJiMWQyZi1hNzVjLTRkZjUtOWE1MS04M2NjMTU1MTU1N2Q='};
		acceptButton.addEventListener( "click", () => {
			loadChatBot(chatBtnOptions);
		});

		if ( getCookieFrontend( "cookieLaw" ) ) {
			loadChatBot(chatBtnOptions);
		}
	</script>
	<?php
}
?>
