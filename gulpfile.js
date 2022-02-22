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

gulp.task( 'browser-reload', ( done ) => {
	browserSync.reload();
	done();
} );

gulp.task( 'clean-dist', () =>
	clean(
		[
			'./assets/dist/**/*',
		],
		{ force: true }
	)
);

gulp.task( 'browser-sync', () => {
	browserSync.init(
		[ '**/*.html', '**/*.php', '**/*.{png,jpg,jpeg,gif,svg}' ],
		{
			proxy: 'http://urlslab.local',
			port: 3000,
			open: true,
			notify: false,
			injectChanges: true,
		}
	);

	gulp.watch( './assets/styles/**/*.scss', gulp.series( 'styles' ) );
	gulp.watch( './assets/scripts/app/**/*.js', gulp.series( 'app-js' ) );
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
		.pipe( gulp.dest( './assets/dist' ) )
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
		.src( [ 'gulpfile.js', 'assets/scripts/**/*.js' ] )
		.pipe( eslint() )
		.pipe( eslint.format() )
		.pipe( eslint.failAfterError() )
);

gulp.task(
	'build',
	gulp.series(
		'clean-dist',
		'styles',
		'app-js'
	)
);

gulp.task(
	'default',
	gulp.series(
		'clean-dist',
		'styles',
		'app-js',
		'browser-sync'
	)
);
