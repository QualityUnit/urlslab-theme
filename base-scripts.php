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

		consentGranted();
		grafana();
		postAffiliate();
	});

	if ( trialButton !== null ) {
		trialButton.addEventListener( "click", () => {
			if ( ! getCookieFrontend( "cookieLaw" ) ) {
				setCookie( 'cookieLaw', 'yes', 14 );
				document.querySelector( '.Medovnicky' ).classList.add( 'hide' );

				consentGranted();
				grafana();
				postAffiliate();
			}
		});
	}

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

<!-- Grafana -->
<script>
	function grafana(cookie = true) {
		var _paq = window._paq || [];
		window._paq = _paq;

		if (cookie === false) {
			_paq.push(["disableCookies"]);
		}

		// _paq.push(['enableLinkTracking']);
		_paq.push(['trackPageView']);
		_paq.push(['enableCrossDomainLinking']);
		(function() {
			_paq.push(['setSiteId', 'URLsLab-web']);
			var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
			g.type='text/javascript'; g.async=true; g.defer=true; g.src='//analytics.qualityunit.com/i.js'; s.parentNode.insertBefore(g,s);
		})();
	}

	if ( ! mobile.matches ) {
		if ( getCookieFrontend( "cookieLaw" ) ) {
			grafana()
		} else {
			grafana(false)
		}
	}

	if ( mobile.matches && getCookieFrontend( "cookieLaw" ) ) {
		grafana()
	}
</script>

<!-- Google Tag Manager -->
<script>
	function loadGoogle() {
		const body  = document.body;
		const gtag1 = document.createElement('script');
		gtag1.async = true;
		gtag1.src = "https://www.googletagmanager.com/gtag/js?id=G-9YVRYTEN5H";

		body.insertAdjacentElement('beforeend', gtag1);
	}

	if ( ! mobile.matches ) {
		loadGoogle()
	}

	if ( mobile.matches && getCookieFrontend( "cookieLaw" ) ) {
		loadGoogle()
	}
</script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

	gtag('consent', 'default', {
		'ad_user_data': 'granted',
		'analytics_storage': 'granted'
	})

	gtag('consent', 'default', {
		'ad_user_data': 'denied',
		'analytics_storage': 'denied',
		'region': ['AT', 'BE', 'BG', 'HR', 'CY', 'CZ', 'DK', 'EE', 'FI', 'FR', 'DE', 'GR', 'HU', 'IE', 'IT', 'LV', 'LT', 'LU', 'MT', 'NL', 'PL', 'PT', 'RO', 'SK', 'SI', 'ES', 'SE', 'IS', 'LI', 'NO']
	})

  gtag('config', 'G-9YVRYTEN5H'{
		'allow_enhanced_conversions': true,
		'linker': {
			'domains': [
				'urlslab.com',
				'support.liveagent.com',
				'ladesk.com'
			]
		}
	});

	function consentGranted() {
		gtag('consent', 'update', {
			'ad_user_data': 'granted',
			'analytics_storage': 'granted'
		})
	}
</script>
<!-- End Google Tag Manager -->

<!-- Chat Button Loader -->
<script>
	function loadChatBot( { chatbotId, workspaceId, btnTarget } ) {
		const chatBotButton = document.querySelector( btnTarget );
		chatBotButton.classList.remove('hidden');

		(function(d, src, c) { var t=d.scripts[d.scripts.length - 1],s=d.createElement('script');s.async=true;s.src=src;s.onload=s.onreadystatechange=function(){var rs=this.readyState;if(rs&&(rs!='complete')&&(rs!='loaded')){return;}c(this);};t.parentElement.insertBefore(s,t.nextSibling);})(document, 'https://app.flowhunt.io/fh-chat-widget.js?v=1.0.20',
		function(e){
			const chatbotManager = FHChatbot.initChatbot({
				showChatButton: false, // important to not show chat button on page load
				chatbotId: chatbotId,
				workspaceId: workspaceId,
				welcomeMessage: 'Hi, I\'m URLsLab Bot. How can I help you?',
				inputPlaceholder: 'Ask me any question...',
				urlSuffix: '#utm_source=flowhunt',
				maxWindowWidth: '700px',
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

	<script type="text/javascript" id="fh-chatbot-script">
	const chatBtnOptions = {btnTarget: '#chatBotOnly', chatbotId: 'd47cb0c6-0e5c-4908-9060-f52a02de130b', workspaceId: '4c00539b-075e-48d7-b4e0-3c4450e146a4'};
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
