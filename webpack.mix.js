const { mix } = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

	mix.sass(
		'resources/assets/sass/app.scss',
		'public/css'
	);

	mix.scripts([
		'resources/assets/js/vendor/jquery.min.js',
		'resources/assets/js/vendor/bootstrap.js',
      'node_modules/highcharts/highcharts.js'
	], 'public/js/all.js')
   ;
   //.version();

	mix.styles([
		'resources/assets/css/vendor/bootstrap.css',
	    'public/css/app.css'
	], 'public/css/all.css')
   ;
   //.version();
