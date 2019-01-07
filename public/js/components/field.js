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

    });


    $('#shcedule-field').on('click','.add-schedule',(event) => {
        let currentTarget = $(event.currentTarget);
        let idRow = currentTarget.parents('tr').attr('id');
        if(!idRow) return false;

        let lastChild = $('#'+idRow +' td:last-child div.row:last-child').clone(true);
        //remove plus for minus icon and add clase remove-schedule 
        lastChild.find('button').removeClass('add-schedule').addClass('remove-schedule').find('i').removeClass('fa-plus').addClass('fa-close')
        
        /*
            //add index to start and end hour
        */ 
        let startHour = lastChild.find('input.start-hour').attr('name');
        let endHour = lastChild.find('input.end-hour').attr('name');
        startHour = startHour.replace(/\d+/g, parseInt(startHour.match(/\d+/g)) + 1);
        endHour = endHour.replace(/\d+/g,parseInt(endHour.match(/\d+/g))+ 1);
        
        //set index hours on last child
        lastChild.find('input.start-hour').attr('name',startHour);
        lastChild.find('input.end-hour').attr('name',endHour);
        
        $('#'+idRow +' td:last-child').append(lastChild);

    });

    $('#shcedule-field').on('click','.remove-schedule',(event) => {
        let btn = $(event.currentTarget);
        btn.parent('.form-group').parent('.row').remove();
    });


})