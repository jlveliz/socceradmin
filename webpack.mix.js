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

//VENDORS
mix.styles([
	'resources/assets/css/bootstrap/bootstrap.min.css',
	'resources/assets/css/style.css',
	],'public/css/vendors.css');




mix.js([
	'resources/assets/js/jquery/jquery.min.js',
	'resources/assets/js/bootstrap/js/bootstrap.min.js',
	'resources/assets/js/bootstrap/js/popper.min.js'
	],'public/js/vendors.js');


/*  
	=================
	COMPONENTS
 	=================
 */

 //auth
 mix.js([
 	'resources/assets/js/components/register.js'
 ],'public/js/register.js')