( () => {
	const query = document.querySelector.bind( document );
	const queryAll = document.querySelectorAll.bind( document );

	document.addEventListener( 'DOMContentLoaded', function() {
		const mobileMediaQuery = window.matchMedia( '(max-width: 1024px)' );

		const mobileNav = document.querySelector( '#hamburger-button' );
		const mainNav = document.querySelector( '.Header__navigation' );
		const htmlElement = document.querySelector( 'html' );
		const mobileMenuOverlay = document.querySelector( '.Header__mobile__menu__overlay' );
		const menuItemsWithChildren = document.querySelectorAll( '.Header__navigation ul > .menu-item-has-children' );

		function toggleMobileNav() {
			if ( mobileMediaQuery.matches ) {
				mobileNav.classList.toggle( 'open' );
				mainNav.classList.toggle( 'Header__navigation--mobile' );
				htmlElement.classList.toggle( 'mobile-menu-opened' );
			}
		}

		function handleSubMenu( element ) {
			const link = element.querySelector( "a[href='#']" );
			const subMenu = element.querySelector( 'ul' );

			if ( link ) {
				link.addEventListener( 'touchstart', function( event ) {
					event.preventDefault();

					const allActiveSubMenus = document.querySelectorAll( '.Header__navigation ul > .menu-item-has-children ul.active' );
					allActiveSubMenus.forEach( function( openSubMenu ) {
						if ( openSubMenu !== subMenu ) {
							openSubMenu.classList.remove( 'active' );
							openSubMenu.parentNode.classList.remove( 'active' );
							if ( mobileMediaQuery.matches ) {
								openSubMenu.style.maxHeight = null;
							}
						}
					} );

					element.classList.toggle( 'active' );
					subMenu.classList.toggle( 'active' );
					if ( mobileMediaQuery.matches ) {
						if ( subMenu.classList.contains( 'active' ) ) {
							subMenu.style.maxHeight = subMenu.scrollHeight + 'px';
						} else {
							subMenu.style.maxHeight = '0';
						}
					}
				} );
			}
		}

		function handleWindowSizeChange( e ) {
			if ( ! e.matches ) {
				document.querySelectorAll( '.Header__navigation--mobile, .Header__navigation ul > .menu-item-has-children.active' ).forEach( function( element ) {
					element.classList.remove( 'Header__navigation--mobile', 'active' );
					if ( mobileMediaQuery.matches ) {
						element.style.maxHeight = null;
					}
				} );
				document.querySelectorAll( '#hamburger-button.open' ).forEach( function( element ) {
					element.classList.remove( 'open' );
				} );
				document.querySelectorAll( 'html.mobile-menu-opened' ).forEach( function( element ) {
					element.classList.remove( 'mobile-menu-opened' );
				} );
			}
		}

		if ( mobileNav ) {
			mobileNav.addEventListener( 'click', toggleMobileNav );
		}

		if ( mobileMenuOverlay ) {
			mobileMenuOverlay.addEventListener( 'click', toggleMobileNav );
		}

		menuItemsWithChildren.forEach( handleSubMenu );

		mobileMediaQuery.addEventListener( 'change', handleWindowSizeChange );
	} );

	/* Data Href */
	if ( queryAll( '[data-href]' ).length > 0 ) {
		queryAll( '[data-href]' ).forEach( ( element ) => {
			element.addEventListener( 'click', () => {
				const link = element.getAttribute( 'data-href' );

				if ( link !== null ) {
					window.location.href = link;
				}
			} );
		} );
	}

	/* Article Sidebar */
	if ( query( '.Article__container__sidebar' ) !== null ) {
		const container = query( '.Article__container__sidebar' );
		const urlPath = window.location.pathname;
		const li = container.querySelectorAll( 'li' );

		li.forEach( ( menuItem ) => {
			const a = menuItem.querySelector( 'a' );
			const href = a.getAttribute( 'href' );

			if ( href.includes( urlPath ) ) {
				const parent = a.parentElement;
				parent.classList.add( 'active' );
			}
		} );
	}

	/* Glossary */
	if ( query( '.Archive__container--glossary' ) !== null ) {
		queryAll( '.Archive__filter ul li a' ).forEach( ( element ) => {
			const link = element.getAttribute( 'href' );

			element.addEventListener( 'click', ( event ) => {
				const scrollToPos =
					query( link ).getBoundingClientRect().top +
					window.pageYOffset;
				event.preventDefault();
				if ( window.matchMedia( '(min-width: 1180px)' ).matches ) {
					window.scroll( {
						top: scrollToPos - 215,
						behavior: 'smooth',
					} );
				} else {
					window.scroll( {
						top: scrollToPos - 115,
						behavior: 'smooth',
					} );
				}
			} );
		} );
	}

	// Custom tabs and accordion, replacing Elementor one
	if ( queryAll( '.elementor-tab-title' ).length > 0 ) {
		const tabItems = queryAll( '.elementor-tab-title' );
		let firstItemRef = tabItems.item( 0 ).getAttribute( 'aria-controls' );

		tabItems.forEach( ( tabItem ) => {
			const tabText = tabItem.innerText;
			if ( tabText.includes( 'ACTIVE' ) ) {
				tabItem.innerText = tabText.replace( 'ACTIVE', '' );
				firstItemRef = tabItem.getAttribute( 'aria-controls' );
			}
		} );

		const parent = tabItems
			.item( 0 )
			.closest( '.elementor-widget-container' );

		tabItems.forEach( ( element ) => {
			const elemReference = element.getAttribute( 'aria-controls' );
			const elemContent = document.querySelector( `#${ elemReference }` );

			if (
				parent.querySelectorAll( '.elementor-accordion-item' ).length >
				0
			) {
				elemContent.dataset.height = `${ elemContent.clientHeight }px`;
				elemContent.style.height = '0px';
				elemContent.style.paddingBottom = '0px';
			}
			element.addEventListener( 'click', ( event ) => {
				const nonActive = queryAll(
					`[aria-controls=${ elemReference }], #${ elemReference }`
				);

				event.preventDefault();

				if (
					parent.querySelector(
						'[data-active="elementor-active"].elementor-tab-content'
					) !== null
				) {
					const activeElem = parent.querySelectorAll(
						'[data-active="elementor-active"]'
					);

					if (
						parent.querySelectorAll( '.elementor-accordion-item' )
							.length > 0
					) {
						parent.querySelector(
							'[data-active="elementor-active"].elementor-tab-content'
						).style.height = '0px';
					}
					activeElem.forEach( ( elementorItem ) => {
						elementorItem.dataset.active = '';
					} );
				}

				nonActive.forEach( ( elementorItem ) => {
					elementorItem.dataset.active = 'elementor-active';
				} );

				if (
					parent.querySelectorAll( '.elementor-accordion-item' )
						.length > 0
				) {
					elemContent.style.height = elemContent.dataset.height;
				}
			} );
		} );

		queryAll(
			`[aria-controls=${ firstItemRef }], #${ firstItemRef }`
		).forEach( ( item ) => {
			item.dataset.active = 'elementor-active';
			// eslint-disable-next-line no-param-reassign
			item.style.height = 'auto';
		} );
	}

	const form = query( '.Signup__form' );

	function scroll( element ) {
		const scrollToPos =
			form.getBoundingClientRect().top + window.pageYOffset;
		element.addEventListener( 'click', ( event ) => {
			event.preventDefault();
			window.scroll( {
				top: scrollToPos - 175,
				behavior: 'smooth',
			} );
		} );
	}

	/* Scroll Buttons to Signup Form */
	if ( query( '.Signup__form' ) !== null ) {
		if ( queryAll( ".Reviews a[href*='trial']" ).length > 0 ) {
			queryAll( ".Reviews a[href*='trial']" ).forEach( ( element ) => {
				scroll( element );
			} );
		}

		if ( queryAll( ".Reviews a[href*='free-account']" ).length > 0 ) {
			queryAll( ".Reviews a[href*='free-account']" ).forEach(
				( element ) => {
					scroll( element );
				}
			);
		}

		if ( queryAll( ".Portals a[href*='trial']" ).length > 0 ) {
			queryAll( ".Portals a[href*='trial']" ).forEach( ( element ) => {
				scroll( element );
			} );
		}

		if ( queryAll( ".Block a[href*='trial']" ).length > 0 ) {
			queryAll( ".Block a[href*='trial']" ).forEach( ( element ) => {
				scroll( element );
			} );
		}

		if ( queryAll( ".Block a[href*='free-account']" ).length > 0 ) {
			queryAll( ".Block a[href*='free-account']" ).forEach(
				( element ) => {
					scroll( element );
				}
			);
		}

		if ( queryAll( ".BlockPricing a[href*='trial']" ).length > 0 ) {
			queryAll( ".BlockPricing a[href*='trial']" ).forEach(
				( element ) => {
					scroll( element );
				}
			);
		}
	}

	/* Copy to clipboard */
	if ( queryAll( '.Copy ' ).length > 0 ) {
		queryAll( '.Copy ' ).forEach( ( item ) => {
			item.querySelector( '.Button--copy' ).addEventListener(
				'click',
				() => {
					const thisCopy = item;
					const copyText = thisCopy.querySelector(
						'.textarea-pseudo'
					).innerText;
					const defaultText = thisCopy.querySelector(
						'.Button--copy span'
					).textContent;

					const textArea = document.createElement( 'textarea' );
					textArea.value = copyText;
					document.body.appendChild( textArea );
					textArea.select();

					document.execCommand( 'copy' );
					document.body.removeChild( textArea );

					thisCopy.querySelector( '.Button--copy span' ).textContent =
						'Copied!';

					setTimeout( () => {
						thisCopy.querySelector(
							'.Button--copy span'
						).textContent = defaultText;
					}, 5000 );
				}
			);
		} );
	}

	/* Login */
	if ( query( '.Login__overlay' ) !== null ) {
		query( '.Login__overlay' ).addEventListener( 'click', () => {
			query( '.Login__overlay' ).classList.remove( 'active' );
			query( '.Login__popup' ).classList.remove( 'active' );
		} );

		query( '.Login__popup__close' ).addEventListener( 'click', () => {
			query( '.Login__overlay' ).classList.remove( 'active' );
			query( '.Login__popup' ).classList.remove( 'active' );
		} );
	}

	/* Awards switching */
	const awardsYears = document.querySelectorAll( '.Awards__switcher--year' );

	if ( awardsYears.length > 0 ) {
		awardsYears.forEach( ( year ) => {
			year.addEventListener( 'click', () => {
				const yearActive = document.querySelector(
					'.Awards__switcher--year.active'
				);
				const yearContainerActive = document.querySelector(
					'.Awards__container.active'
				);

				const thisYear = year;
				const thisYearRef = year.dataset.year;

				yearActive.classList.remove( 'active' );
				thisYear.classList.add( 'active' );
				yearContainerActive.classList.remove( 'active' );
				document
					.querySelector(
						`.Awards__container[data-year='${ thisYearRef }']`
					)
					.classList.add( 'active' );
			} );
		} );
	}
} )();
