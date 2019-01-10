$(document).ready( () => {

    /*  
        Field Schedule Controller
    */

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



     /*  
        Group Field Schedule Controller
    */

   $('#accordionExample').on('click','.add-group-schedule',(event) => {
        let currentTarget = $(event.currentTarget);
        debugger
        let idRow = currentTarget.parents('tbody').find('tr:last').attr('id');
        if(!idRow) return false;
        let lastChild = $('tr#'+idRow).clone(true);
        //remove plus for minus icon and add clase remove-schedule 
        lastChild.find('button').removeClass('add-group-schedule').addClass('remove-group-schedule').find('i').removeClass('fa-plus').addClass('fa-close')
        /*
            add index to group row
        */
        let groupName = lastChild.find('select.group-name').attr('name');
        let rangeAge = lastChild.find('select.range-name').attr('name');
        let capacity = lastChild.find('input.capacity').attr('name');
        let startHour = lastChild.find('input.start-hour').attr('name');
        let endHour = lastChild.find('input.end-hour').attr('name');
        //get new Names
        // let newIdRow = idRow.replace(/.$/,parseInt(idRow.slice(0,idRow.length-1) || 0)) + 1;

        function replaceId(string) {
            let reverse = string.split("").reverse().join();
            reverse.replace(/\d+/, parseInt(reverse.match(/\d+/)) + 1);
            return reverse;
        }

        let letNumRow = idRow[idRow.length -1];
        let newIdRow = idRow.replace(/.$/,parseInt( letNumRow  ) + 1 );
        groupName = groupName.replace(/\d+/g, parseInt(groupName.match(/\d+/g)) + 1);
        rangeAge = rangeAge.replace(/\d+/g, parseInt(rangeAge.match(/\d+/g)) + 1);
        capacity = capacity.replace(/\d+/g, parseInt(capacity.match(/\d+/g)) + 1);
        startHour = startHour.replace(/\d+/g, parseInt(startHour.match(/\d+/g)) + 1);
        endHour = endHour.replace(/\d+/g,parseInt(endHour.match(/\d+/g))+ 1);
        
        //set new names
        lastChild.find('select.group-name').attr('name',groupName).attr('id',groupName);
        lastChild.find('select.range-name').attr('name',rangeAge).attr('id',rangeAge);
        lastChild.find('input.capacity').attr('name',capacity).attr('id',capacity);
        lastChild.find('input.start-hour').attr('name',startHour).attr('id',startHour);
        lastChild.find('input.end-hour').attr('name',endHour).attr('id',endHour);
        lastChild.attr('id',newIdRow);
        
        currentTarget.parents('tbody').append(lastChild);
   });


   $('#accordionExample').on('click','.remove-group-schedule',(event) => {
        let btn = $(event.currentTarget);
        btn.parents('tr').remove();
   })


})