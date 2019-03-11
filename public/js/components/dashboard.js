$(document).ready(function() {
	
	$("#assistance-modal").on('show.bs.modal', function(event){

		var btn = $(event.relatedTarget);
		var modal = $(event.currentTarget);
		let idField = btn.data('field');
		
		//reset
		$(".loader-modal-container").removeClass('d-none')
		$(".container-result ul li").remove()

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
					$(".container-result").removeClass('d-none');
					var tabs = generateTabsDay(result.available_days)
					
					$(".container-result ul").append(tabs.headers)
					
				}
			})
			.fail(function(error) {
				
			})
			.always(function() {
				$(".loader-modal-container").addClass('d-none');
			})
		} else {
			$(event.currentTarget).modal('hide')
			return false;
		}


		

	});


	var generateTabsDay = function(availableDays) {
		var html = {
			headers: "",
			content: ""
		};
		var counter = 1;
		for(var avaylable in availableDays) {
			var active = counter == 1 ?  'active' : false;
			html.headers+="<li class='nav-item'>";
				html.headers+="<a class='nav-link "+active+"' id='"+avaylable+"-tab' aria-selected='"+active+"' data-toggle='tab' href='#"+avaylable+"' role='tab' aria-controls='"+avaylable+"'>"+days_of_week(avaylable)+"</a>";
			html.headers+="<li>" ;
			counter++;
		}

		return html;
	}


	


});