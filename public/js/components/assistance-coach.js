$(document).ready(function() {

	var monthSelected = $('.assistance-coach .select-coach-month').val();
	var fieldTable = $('.assistance-coach .table-coach-body').data('field');
	var numCoachsTable = $('.assistance-coach .table-coach-body').data('coachs');

	$.ajax({
		url: '',
		type: 'default GET (Other values: POST)',
		dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
		data: {param1: 'value1'},
	})
	.done(function() {
		console.log("success");
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
	


});