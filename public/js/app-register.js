	$(document).ready(function() {
			$("#form-field-class-type").on('change', function(event) {
				
				var valClassType = $(this).val();
				
				switch (parseInt(valClassType)) {
					case 1:
						$('.elementor-field-group-day-free').removeClass('display').addClass('no-display');
						$('.elementor-field-group-day-payed').removeClass('no-display').addClass('display');
						break;
					case 2:
						$('.elementor-field-group-day-free').removeClass('no-display').addClass('display');
						$('.elementor-field-group-day-payed').removeClass('display').addClass('no-display');
						break;
					default:
						$('.elementor-field-group-day-free').addClass('no-display');
						$('.elementor-field-group-day-payed').addClass('no-display');
						break;
				}
			});


		})