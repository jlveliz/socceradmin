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

mix.autoload({
    jquery: ['$', 'window.jQuery', 'jQuery']
})

//VENDORS
mix.styles([
    'resources/assets/css/bootstrap/bootstrap.min.css',
    'node_modules/pc-bootstrap4-datetimepicker/build/css/bootstrap-datetimepicker.css',
    'resources/assets/css/style.css',
], 'public/css/vendors.css');




mix.js([
    'resources/assets/js/jquery/jquery.min.js',
    'resources/assets/js/bootstrap/js/bootstrap.min.js',
    'resources/assets/js/bootstrap/js/popper.min.js',
    // 'resources/assets/js/gijgo/js/gijgo.js',
    // 'resources/assets/js/gijgo/js/messages/messages.es-es.js',
], 'public/js/vendors.js');


/*  
	=================
	COMPONENTS
 	=================
 */

//auth
mix.js([
    'resources/assets/js/components/register.js'
], 'public/js/register.js')


// mix.autoload({
//     jQuery: 'jquery',
//     $: 'jquery',
//     jquery: jquery
// })