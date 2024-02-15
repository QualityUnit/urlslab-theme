document.addEventListener( 'DOMContentLoaded', () => {
	const tables = document.querySelectorAll( 'figure.wp-block-table table' );

	if ( tables.length ) {
		tables.forEach( ( table ) => {
			const headers = table.querySelectorAll( 'thead th' );
			const rows = table.querySelectorAll( 'tbody tr' );

			rows.forEach( ( row ) => {
				const cells = row.querySelectorAll( 'td:not(:first-child)' ); // Selects all cells except the first cell in the row

				cells.forEach( ( cell, index ) => {
					const headerText = headers[ index + 1 ].textContent; // Gets the header text corresponding to the current cell
					const mobileHeader = document.createElement( 'span' ); // Creates a new span element that will serve as a mobile header

					mobileHeader.classList.add( 'mobile-header' );
					mobileHeader.textContent = headerText; // Sets the text of the span element to the text of the corresponding header

					cell.prepend( mobileHeader ); // Inserts a span element before the content of the current cell
				} );
			} );
		} );
	}
} );
