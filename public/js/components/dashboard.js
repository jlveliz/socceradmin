$(document).ready(function() {
	
	$("#assistance-modal").on('show.bs.modal', function(event){

		var btn = $(event.relatedTarget);
		var modal = $(event.currentTarget);
		let idField = btn.data('field');
		
		//reset
		$(".loader-modal-container").removeClass('d-none')
		$(".container-result ul li").remove();
		$(".modal-message h4").addClass('d-none');

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
					generateTabsDay(result.available_days).then(function(html) {
						var tabs = html;	
						$(".container-result ul").append(tabs);
						generateGroupsByDay(result.groups).then(function(html) {
							$("#mytabassistance").append(html);
						})
					})

				}
			})
			.fail(function(error) {
				$(".modal-message h4").text(error.responseText).parent().removeClass('d-none')
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
		var deferred = jQuery.Deferred();
		var html = "";
		var counter = 1;
		for(var avaylable in availableDays) {
			var active = counter == 1 ?  'active' : false;
			html+="<li class='nav-item'>";
				html+="<a class='nav-link "+active+"' id='"+avaylable+"-tab' aria-selected='"+active+"' data-toggle='tab' href='#"+avaylable+"' role='tab' aria-controls='"+avaylable+"'>"+days_of_week(avaylable)+"</a>";
			html+="<li>" ;
			counter++;
		}

		if (html.length > 1) {
			deferred.resolve(html);
		} else {
			deferred.reject();
		}


		return deferred.promise();
		
	}

	var generateGroupsByDay = function(groups) {
		var deferred = jQuery.Deferred();
		var html = "";
		var days = [];

		groups.forEach(function(element, index) {

			if (!days.length) {
				days.push({day:element.day, groups:[element]});
			} else {
				var idx = days.findIndex( ele => ele.day == element.day );
			 	if (idx == -1) {
			 		days.push({day:element.day, groups:[element]});
			 	} else {
			 		days[idx].groups.push(element);
			 	}
			}
		});

		if (days.length) {

			for (var i = 0; i < days.length; i++) {
				var active = null;
				if (i == 0) active = "active";
				html+="<div class='tab-pane fade "+active+"' id='"+days[i].day+"' role='tabpanel' aria-labelledby='"+days[i].day+"-tab'>";
					html+="<ul class='nav nav-tabs customtab mb-2'>";
						for (var x = 0; x < days[i].groups.length; x++) {
							var activeLi = x == 1 ? "active" : null;
							html+="<li class='nav-item'>";
								html+="<a class='nav-link  "+activeLi+"'>"+days[i].groups[x].name+"</a>"
							html+="</li>";
						}
					html+="</ul>";
				html+="</div>";
			}

			console.log(html)
			deferred.resolve(html);
		}


		return deferred.promise()
		
	}


	


});