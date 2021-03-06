$(document).ready( () => {

    if ($("#list-fields").length > 0) {
        $("#list-fields").DataTable({
            language: {
                url: 'js/data-table/spanish.json'
            },
            orderable: false,
            columnDefs: [{
                orderable: false,
                targets: 3
            }],
            order: [
                [0, 'asc'],
                [1, 'asc'],
                [2, 'asc'],               
            ]
        })
    }

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

    $('#shcedule-field').on('click','.remove-live-schedule',(event) => {
        let btn = $(event.currentTarget);
        let keyField = $('#key-field').val();
        if(!keyField) return false;
        // btn.parent('.form-group').parent('.row').remove();
        let rowDay = btn.parent().parent('.row').find('input.start-hour').attr('name');
        rowDay = rowDay.match(/\[(.*?)\]/g);
        let paramsGrupsToDelete = {};
        let keys = ['day','schedule'];
        for (let index = 0; index < (rowDay.length - 1) ; index++) {
            rowDay[index] = rowDay[index].replace('[','');
            rowDay[index] = rowDay[index].replace(']','');
            paramsGrupsToDelete[keys[index]] = rowDay[index];
        }
        paramsGrupsToDelete['field_id'] = keyField;
        $.ajax({
            url:'/groupclass/remove-all',
            data:paramsGrupsToDelete,
            type: 'POST'
        })
        .done( (success) => {
            btn.parent('.form-group').parent('.row').remove();
            $('#validate-form').val(false);
            $('form.crud-futbol').submit();
        })
        .fail( (err) => {

        })
        .always( () => {
            
        })
    });



     /*  
        Group Field Schedule Controller
    */

   $('#accordionExample').on('click','.add-group-schedule',(event) => {
        let currentTarget = $(event.currentTarget);
        
        let idRow = currentTarget.parents('tbody').find('tr:last').attr('id');
        if(!idRow) return false;
        let lastChild = $('tr#'+idRow).clone(true);
        //remove plus for minus icon and add clase remove-schedule  //remove class 'remove-group-live-schedule'
        lastChild.find('button').removeClass('add-group-schedule remove-group-live-schedule').addClass('remove-group-schedule').find('i').removeClass('i-Add').addClass('i-Close')
        /*
            add index to group row
        */
        let groupId = lastChild.find('input.group-id').attr('name');
        let coachId = lastChild.find('select.group-coach-id').attr('name');
        let fieldName = lastChild.find('input.field-name').attr('name');
        let fielScheduleKey = lastChild.find('input.schedule-key-name').attr('name');
        let dayName = lastChild.find('input.day-name').attr('name');
        let rangeAge = lastChild.find('select.range-name').attr('name');
        let capacity = lastChild.find('input.capacity').attr('name');
        let startHour = lastChild.find('input.start-hour').attr('name');
        let endHour = lastChild.find('input.end-hour').attr('name');
        let state = lastChild.find('select.group-state').attr('name');
        //get new Names
        // let newIdRow = idRow.replace(/.$/,parseInt(idRow.slice(0,idRow.length-1) || 0)) + 1;

       

        let letNumRow = idRow[idRow.length -1];
        let newIdRow = idRow.replace(/.$/,parseInt( letNumRow  ) + 1 );
        
        //let match = coachId.match(/\[[0-9]+\]/);
        
        // remove object
        if(groupId) {
            lastChild.find('input.group-id').remove();
        }
        fieldName = fieldName.replace(/\[[0-9]+\]/,"["+ (parseInt(letNumRow) + 1) +"]");
        coachId = coachId.replace(/\[[0-9]+\]/,"["+ (parseInt(letNumRow) + 1) +"]");
        fielScheduleKey = fielScheduleKey.replace(/\[[0-9]+\]/,"["+ (parseInt(letNumRow) + 1) +"]");
        dayName = dayName.replace(/\[[0-9]+\]/,"["+ (parseInt(letNumRow) + 1) +"]");
        rangeAge = rangeAge.replace(/\[[0-9]+\]/,"["+ (parseInt(letNumRow) + 1) +"]");
        capacity = capacity.replace(/\[[0-9]+\]/,"["+ (parseInt(letNumRow) + 1) +"]");
        startHour = startHour.replace(/\[[0-9]+\]/,"["+ (parseInt(letNumRow) + 1) +"]");
        endHour = endHour.replace(/\[[0-9]+\]/,"["+ (parseInt(letNumRow) + 1) +"]");
        state = state.replace(/\[[0-9]+\]/,"["+ (parseInt(letNumRow) + 1) +"]");
        
        lastChild.find('select.group-coach-id').attr('name',coachId).attr('id',coachId);
        lastChild.find('input.field-name').attr('name',fieldName).attr('id',fieldName);
        lastChild.find('input.schedule-key-name').attr('name',fielScheduleKey).attr('id',fielScheduleKey);
        lastChild.find('input.day-name').attr('name',dayName).attr('id',dayName);
        lastChild.find('select.range-name').attr('name',rangeAge).attr('id',rangeAge);
        lastChild.find('input.capacity').attr('name',capacity).attr('id',capacity);
        lastChild.find('input.start-hour').attr('name',startHour).attr('id',startHour);
        lastChild.find('input.end-hour').attr('name',endHour).attr('id',endHour);
        lastChild.find('select.group-state').attr('name',state).attr('id',state);
        lastChild.attr('id',newIdRow);
        
        currentTarget.parents('tbody').append(lastChild);
   });


   $('#accordionExample').on('click','.remove-group-schedule',(event) => {
        let btn = $(event.currentTarget);
        let hasClassLiveRemove = btn.hasClass('remove-group-live-schedule');
        if (hasClassLiveRemove)  return false;
        btn.parents('tr').remove();
   });



   //remove live shedule
    $('#accordionExample').on('click','.remove-group-live-schedule',(event)=> {
        let currentTarget = $(event.currentTarget);
        let groupId = currentTarget.parents('tr').find('.group-id').val();
        currentTarget.find('i').removeClass('i-Close i-Add').addClass('fa-spinner fa-spin')
        if(!groupId) {
            return false;
        }

        $.ajax({
            url:'/groupclass/'+groupId,
            type: 'DELETE'
        })
        .done( (success) => {
            $("#message-alert-field").append(success.content)
            $("#message-alert-field").removeClass('d-none').addClass('alert-'+success.type);
            currentTarget.parents('tr').remove()
        })
        .fail( (err) => {
            $("#message-alert-field").append(success.content)
            $("#message-alert-field").removeClass('d-none').addClass('alert-'+success.type);
        })
        .always( () => {
            
        })

    });


})