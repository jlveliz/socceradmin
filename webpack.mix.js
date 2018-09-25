let mix = require('laravel-mix');

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


mix.css([
	'resources/css/bootstrap/bootstrap.min.css',
	'resources/css/style.css'
	],'public/css/app.css');



mix.js([
	'resources/js/jquery/jquery.min.js',
	'resources/js/bootstrap/bootstrap.min.js',
	'resources/js/bootstrap/popper.min.js'
	],'public/js/app.js');