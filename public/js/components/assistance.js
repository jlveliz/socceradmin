jQuery(document).ready(function($) {
	
	$('#field-id').on('change',function(event) {
		$('#filter-assistance').submit();
	});

	$('#key-day').on('change',function(event) {
		$('#filter-assistance').submit();
	});

	$('#group_id').on('change',function(event) {
		$('#filter-assistance').submit();
	});

	$('#group-key').on('change',function(event) {
		$('#filter-assistance').submit();
	});

});