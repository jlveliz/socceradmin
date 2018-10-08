try {
	window.$ = window.jQuery = require('jquery');
	require('bootstrap');
	require('gijgo');
} catch(e) {
	// statements
	console.log(e);
}