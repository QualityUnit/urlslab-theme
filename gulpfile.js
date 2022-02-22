const autoprefixer = require( 'gulp-autoprefixer' );
const browserSync = require( 'browser-sync' ).create();
const clean = require( 'del' );
const concat = require( 'gulp-concat' );
const eslint = require( 'gulp-eslint' );
const filter = require( 'gulp-filter' );
const gcmq = require( 'gulp-group-css-media-queries' );
const gulp = require( 'gulp' );
const plumber = require( 'gulp-plumber' );
const rename = require( 'gulp-rename' );
const sass = require( 'gulp-sass' )( require( 'node-sass' ) );
const stylelint = require( 'gulp-stylelint' );
const terser = require( 'gulp-terser' );
const uglifycss = require( 'gulp-uglifycss' );
const revertPath = require( 'gulp-revert-path' );
const rtlcss = require( 'gulp-rtlcss' );
const svgSprites = require( 'gulp-svg-sprite' );

gulp.task( 'browser-reload', ( done ) => {
	browserSync.reload();
	done();
} );

gulp.task( 'clean-dist', () =>
	clean(
		[
			'./assets/dist/**/*',
			'../../../wp/wp-includes/css/dist/block-library/**/*.min.css',
			'../../../wp/wp-includes/css/dist/block-library/**/*-rtl.css',
		],
		{ force: true }
	)
);

gulp.task( 'browser-sync', () => {
	browserSync.init(
		[ '**/*.html', '**/*.php', '**/*.{png,jpg,jpeg,gif,svg}' ],
		{
			proxy: 'http://liveagent.local',
			port: 3000,
			open: false,
			notify: false,
			injectChanges: true,
		}
	);

	gulp.watch( './assets/styles/**/*.scss', gulp.series( 'styles' ) );
	gulp.watch( './assets/scripts/app/**/*.js', gulp.series( 'app-js' ) );
	gulp.watch(
		'./assets/scripts/vendor/splide.js',
		gulp.series( 'splide-js' )
	);
	gulp.watch( './assets/scripts/custom/**/*.js', gulp.series( 'custom-js' ) );
	gulp.watch(
		'../../plugins/sitepress-multilingual-cms/templates/language-switchers/**/*.js',
		gulp.series( 'sourcemaps-js-remove' )
	);
	gulp.watch(
		'../../plugins/sitepress-multilingual-cms/templates/language-switchers/**/*.css',
		gulp.series( 'sourcemaps-css-remove' )
	);
	gulp.watch(
		'../../../wp/wp-includes/css/dist/block-library/**/*.css',
		gulp.series( 'block-library-style-RTL-css' )
	);
	gulp.watch(
		'./assets/images/flags/*.svg',
		gulp.series( 'langFlagsSprite' )
	);
} );

gulp.task( 'styles', () =>
	gulp
		.src( './assets/styles/**/*.scss' )
		.pipe( plumber() )
		.pipe(
			sass( {
				errLogToConsole: true,
				outputStyle: 'nested',
				precision: 10,
			} )
		)
		.pipe( autoprefixer( 'last 3 version', 'android 4', 'ie 11' ) )
		.pipe( plumber.stop() )
		.pipe( gulp.dest( './assets/dist/' ) )
		.pipe( filter( '**/*.css' ) )
		.pipe( gcmq() )
		.pipe( browserSync.reload( { stream: true } ) )
		.pipe( rename( { suffix: '.min' } ) )
		.pipe( uglifycss() )
		.pipe( gulp.dest( './assets/dist/' ) )
		.pipe( rtlcss() )
		.pipe( revertPath() )
		.pipe( rename( { suffix: '-rtl.min' } ) )
		.pipe( gulp.dest( './assets/dist' ) )
		.pipe( browserSync.reload( { stream: true } ) )
);

// We uglify original CSS thus removing RTL ignore directives before RTL the mainly style.css
gulp.task( 'block-library-style-RTL-css', () =>
	gulp
		.src( [ '../../../wp/wp-includes/css/dist/block-library/**/*.css' ], {
			base: './',
		} )
		.pipe( rename( { suffix: '.min' } ) )
		.pipe( uglifycss() )
		.pipe( gulp.dest( './' ) )
		.pipe( rtlcss() )
		.pipe( revertPath( 2 ) )
		.pipe( rename( { suffix: '-rtl' } ) )
		.pipe( gulp.dest( './' ) )
		.pipe( revertPath( 2 ) )
		.pipe( rename( { suffix: '-rtl.min' } ) )
		.pipe( gulp.dest( './' ) )
);

const langFlagsConfig = {
	shape: {
		id: {
			generator: 'flag-%s',
		},
	},
	mode: {
		symbol: {
			dest: '.',
			sprite: 'flags.svg',
			prefix: '%s',
			dimensions: '',
			inline: true,
		},
	},
};

gulp.task( 'langFlagsSprite', () =>
	gulp
		.src( [ './assets/images/flags/*.svg' ] )
		.pipe( svgSprites( langFlagsConfig ) )
		.pipe( gulp.dest( './assets/images' ) )
		.pipe( browserSync.reload( { stream: true } ) )
);

gulp.task( 'splide-js', () =>
	gulp
		.src( [ './assets/scripts/vendor/splide.js' ] )
		.pipe( gulp.dest( './assets/dist' ) )
		.pipe(
			rename( {
				basename: 'splide',
				suffix: '.min',
			} )
		)
		.pipe( terser() )
		.pipe( gulp.dest( './assets/dist/' ) )
		.pipe( browserSync.reload( { stream: true } ) )
);

gulp.task( 'app-js', () =>
	gulp
		.src( './assets/scripts/app/**/*.js' )
		.pipe( concat( 'app.js' ) )
		.pipe( gulp.dest( './assets/dist' ) )
		.pipe(
			rename( {
				basename: 'app',
				suffix: '.min',
			} )
		)
		.pipe( terser() )
		.pipe( gulp.dest( './assets/dist/' ) )
		.pipe( browserSync.reload( { stream: true } ) )
);

gulp.task( 'custom-js', () =>
	gulp
		.src( './assets/scripts/custom/**/*.js' )
		.pipe( gulp.dest( './assets/dist' ) )
		.pipe(
			rename( ( path ) => {
				// eslint-disable-next-line no-param-reassign
				path.basename += '.min';
			} )
		)
		.pipe( terser() )
		.pipe( gulp.dest( './assets/dist/' ) )
		.pipe( browserSync.reload( { stream: true } ) )
);

gulp.task( 'sourcemaps-js-remove', () =>
	gulp
		.src(
			[
				'../../plugins/sitepress-multilingual-cms/templates/language-switchers/**/*.js',
			],
			{ base: './' }
		)
		.pipe( terser() )
		.pipe( gulp.dest( './' ) )
);

gulp.task( 'sourcemaps-css-remove', () =>
	gulp
		.src(
			[
				'../../plugins/sitepress-multilingual-cms/templates/language-switchers/**/*.css',
			],
			{ base: './' }
		)
		.pipe( uglifycss() )
		.pipe( gulp.dest( './' ) )
);

gulp.task( 'stylelint', () =>
	gulp.src( 'assets/styles/**/*.scss' ).pipe(
		stylelint( {
			reporters: [
				{
					formatter: 'string',
					console: true,
				},
			],
		} )
	)
);

gulp.task( 'eslint', () =>
	gulp
		.src( 'assets/scripts/**/*.js' )
		.pipe( eslint() )
		.pipe( eslint.format() )
		.pipe( eslint.failAfterError() )
);

gulp.task(
	'build',
	gulp.series(
		'clean-dist',
		'styles',
		'splide-js',
		'app-js',
		'custom-js',
		'sourcemaps-js-remove',
		'sourcemaps-css-remove',
		'block-library-style-RTL-css',
		'langFlagsSprite'
	)
);

gulp.task(
	'default',
	gulp.series(
		'clean-dist',
		'styles',
		'splide-js',
		'app-js',
		'custom-js',
		'sourcemaps-js-remove',
		'sourcemaps-css-remove',
		'block-library-style-RTL-css',
		'langFlagsSprite',
		'browser-sync'
	)
);
