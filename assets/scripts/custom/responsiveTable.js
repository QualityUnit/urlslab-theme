const tables = document.querySelectorAll( 'figure.wp-block-table table' );
const pricingTableHeaderTitle = document.querySelector( '.Pricing__table--title' );
const pricingTableHeader = document.querySelector( '.Pricing__table--header' );

// Setting tables header class when sticky to hide icons
if ( pricingTableHeader ) {
	const headerObserver = new IntersectionObserver(
		( [ entry ] ) => {
			if ( entry.isIntersecting ) {
				pricingTableHeader.classList.remove( 'is-sticky' );
				return;
			}
			if ( entry.boundingClientRect.top < 0 ) {
				pricingTableHeader.classList.add( 'is-sticky' );
			}
		},
		{ rootMargin: '-92px 0px 0px 0px' }
	);

	headerObserver.observe( pricingTableHeaderTitle );
}

if ( tables.length ) {
	const hasTooltip = new RegExp( /(.+?)<i>(.+?)<\/i>/gi );

	tables.forEach( ( table ) => {
		const tr = table.querySelectorAll( 'tr' );
		const colspanRows = table.querySelectorAll( 'tbody tr td[colspan]:first-child' );

		if ( colspanRows?.length ) {
			table.classList.add( 'hasColspanGroups' );
		}

		//Sets check or crossover for Y or N vals
		for ( let i = 0; i <= tr.length; i++ ) {
			let headers = tr[ 0 ].querySelectorAll( 'th' );
			if ( ! headers?.length ) {
				headers = tr[ 0 ].querySelectorAll( 'td' );
			}
			const vals = tr[ i ] && tr[ i ].querySelectorAll( 'td' );
			const allCells = tr[ i ] && tr[ i ].querySelectorAll( 'td, th' );

			if ( allCells?.length ) {
				allCells.forEach( ( cell ) => {
					const text = cell.innerHTML;

					if ( hasTooltip.test( text ) ) {
						const infoIcon = `<svg class="icon icon-info-circle">
							<use xlink:href="/app/themes/urlslab/assets/images/icons.svg#info-circle"></use>
							</svg>`;
						cell.classList.add( 'hasTooltip' );
						cell.innerHTML = text.replaceAll( hasTooltip, `$1<div class="ComparePlans__tooltip">${ infoIcon }<span class="ComparePlans__tooltip__text">$2</span></div>` );
					}
				} );
			}

			if ( vals?.length > 1 ) {
				vals.forEach( ( val, index ) => {
					if ( val.textContent.toLowerCase() === 'y' || val.textContent.toLowerCase() === 'yes' || val.outerText.toLowerCase() === 'y' || val.outerText.toLowerCase() === 'yes' ) {
						val.textContent = null;
						val.classList.add( 'icn-after-check' );
						val.insertAdjacentHTML( 'afterbegin', `
							<svg class="icon icon-check">
								<use xlink:href="/app/themes/urlslab/assets/images/icons.svg#check"></use>
							</svg>`
						);
					}
					if ( val.textContent.toLowerCase() === 'n' || val.textContent.toLowerCase() === 'no' || val.outerText.toLowerCase() === 'n' || val.outerText.toLowerCase() === 'no' ) {
						val.textContent = null;
						val.classList.add( 'icn-after-close' );
						val.insertAdjacentHTML( 'afterbegin', `
							<svg class="icon icon-close">
								<use xlink:href="/app/themes/urlslab/assets/images/icons.svg#close"></use>
							</svg>`
						);
					}
					if ( headers[ index ]?.innerHTML && ! table.classList.contains( 'no-header' ) ) {
						val.insertAdjacentHTML( 'afterbegin', `<div class="tablet--only MobileHeader">${ headers[ index ].innerHTML }</div>` );
					}

					if ( ! headers[ index ]?.innerHTML && ! table.classList.contains( 'no-header' ) ) {
						val.classList.add( 'MobileHeader__top' );
					}
				} );
			}
		}

		// Adds Class to odd tr with td[colspan] + tr for background
		for ( let i = 0; i <= colspanRows.length; i++ ) {
			if ( i % 2 === 1 ) {
				const isOddGroup = colspanRows[ i ]?.closest( 'tr' );
				if ( isOddGroup ) {
					isOddGroup.classList.add( 'oddGroup' );
					isOddGroup.nextElementSibling.classList.add( 'oddGroup' );
				}
			}
		}
	} );
}
