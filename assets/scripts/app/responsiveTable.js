const tables = document.querySelectorAll( 'figure.wp-block-table table' );

if ( tables.length ) {
	const hasTooltip = new RegExp( /(.+?)<i>(.+?)<\/i>/gi );

	tables.forEach( ( table ) => {
		const tr = table.querySelectorAll( 'tr' );

		//Sets check or crossover for Y or N vals
		for ( let i = 0; i <= tr.length; i++ ) {
			const headers = tr[ 0 ].querySelectorAll( 'th' );
			const vals = tr[ i ] && tr[ i ].querySelectorAll( 'td' );
			const allCells = tr[ i ] && tr[ i ].querySelectorAll( 'td, th' );

			if ( allCells?.length ) {
				allCells.forEach( ( cell ) => {
					const text = cell.textContent;

					if ( hasTooltip.test( text ) ) {
						const infoIcon = `<svg class="icon icon-info-circle">
							<use xlink:href="/app/themes/liveagent/assets/images/icons.svg#info-circle"></use>
							</svg>`;
						cell.classList.add( 'hasTooltip' );
						cell.innerHTML = text.replaceAll( hasTooltip, `$1<div class="ComparePlans__tooltip">${ infoIcon }<span class="ComparePlans__tooltip__text">$2</span></div>` );
					}
				} );
			}

			if ( vals?.length > 1 ) {
				vals.forEach( ( val, index ) => {
					if ( val.textContent === 'y' || val.textContent === 'Yes' ) {
						val.textContent = null;
						val.classList.add( 'icn-after-check' );
						val.insertAdjacentHTML( 'afterbegin', `
							<svg class="icon icon-check">
								<use xlink:href="/app/themes/urlslab-theme/assets/images/icons.svg#check"></use>
							</svg>`
						);
					}
					if ( val.textContent === 'n' || val.textContent === 'No' ) {
						val.textContent = null;
						val.classList.add( 'icn-after-close' );
						val.insertAdjacentHTML( 'afterbegin', `
							<svg class="icon icon-close">
								<use xlink:href="/app/themes/urlslab-theme/assets/images/icons.svg#close"></use>
							</svg>`
						);
					}
					if ( headers[ index ].innerHTML ) {
						val.insertAdjacentHTML( 'afterbegin', `<div class="tablet--only MobileHeader">${ headers[ index ].innerHTML }</div>` );
					}

					if ( ! headers[ index ].innerHTML ) {
						val.classList.add( 'MobileHeader__top' );
					}
				} );
			}
		}
	} );
}
