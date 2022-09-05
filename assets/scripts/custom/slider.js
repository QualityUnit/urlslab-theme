/* global Splide */
const direction = () => {
	return document.documentElement.dir;
};

const archiveTopSlider = document.querySelectorAll( '.ArchiveTopSlider' );

if ( archiveTopSlider.length > 0 ) {
	archiveTopSlider.forEach( ( slider ) => {
		new Splide( slider, {
			type: 'slide',
			rewind: true,
			autoplay: true,
			direction: direction(),
			speed: 500,
			interval: 10000,
			perPage: 1,
			perMove: 1,
			pagination: true,
			arrows: true,
		} ).mount();
	} );
}
