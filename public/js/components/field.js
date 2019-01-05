$(document).ready( () => {


    $('.select-day').on('click', (event) => {
        let currentTarget = $(event.currentTarget);
        let idRow = currentTarget.parents('tr').attr('id');
        if(!idRow) return false;

        if(currentTarget.is(':checked')) {
            $('#'+idRow + ' input[type=time],#'+idRow+' button').removeAttr('disabled')
        } else {
            $('#'+idRow + ' input[type=time],#'+idRow+' button').prop('disabled','disabled');
        }

    })


})