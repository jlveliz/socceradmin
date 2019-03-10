$(document).ready(function() {
	
	$("#assistance-modal").on('show.bs.modal', function(event){

		var btn = $(event.relatedTarget);
		var modal = $(event.currentTarget);
		let idField = btn.data('field');

		if (idField && parseInt(idField) != NaN) {

			//reset 
			modal.find('.modal-title').text('');

			$.ajax({
				url: 'fields/'+idField,				
				dataType: 'json',
			})
			.done(function(result) {
				var title = result.name;
				if (title) {
					modal.find('.modal-title').text(title);
					
				}
			})
			.fail(function(error) {
					
			})
		} else {
			$(event.currentTarget).modal('hide')
			return false;
		}


		

	});

});