jQuery(document).ready(function($) {

	$('[data-toggle="tooltip"]').tooltip()
	
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


	$('.check-assistance').on('click', function(event) {
		debugger;
		$check = $(event.currentTarget);
		if (!$check.is(':checked')) {
			var message = confirm('Está sguro?');
			if (!message) {
				$check.prop('checked','checked')
			} else {
				$check.closest('.form-check-inline').find('.show-message').removeClass('visible').addClass('invisible')
				$check.closest('.form-check-inline').find('.comment-hidden').val('');
			}
		} else {
			$("#insertCommentModal").modal('show');
			$("#insertCommentModal").trigger('pass-check',$check.attr('id'));
		}
	});

	$("#insertCommentModal").on('show.bs.modal',function(event){
		var $modal = $(event.currentTarget);
		var showMessageIcon = $(event.relatedTarget);
		var comment = showMessageIcon.closest('.form-check-inline').find('.comment-hidden').val()
		if (comment) {
			$modal.find('input[type=text]').val(comment).attr('autofocus');
		} else {
			$modal.find('input[type=text]').val('').attr('autofocus');
		}
	});

	$("#insertCommentModal").on('pass-check',function(event, param){
		var $modal = $(event.currentTarget);
		$modal.find('#button-target').val(param)
	})


	$("#insertCommentModal").on('hide.bs.modal',function(event){
		var $modal = $(event.currentTarget);
		var idTargetChecked = $modal.find('#button-target').val();
		var comment = $modal.find('#comment').val();
		if (comment) {
			$('#'+idTargetChecked).closest('.form-check-inline').find('.comment-hidden').val(comment);
			$('#'+idTargetChecked).closest('.form-check-inline').find('.show-message').removeClass('invisible').addClass('visible')
		}

	});



});