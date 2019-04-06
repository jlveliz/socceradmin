$(document).ready(function() {
    var loadAssistances = (monthSelected, fieldId, idCoachs) => {

        var deferred = jQuery.Deferred();

        $.ajax({
                url: '/coachs-assistances/schedule?month=' + monthSelected + '&field=' + fieldId + '&coachs=' + idCoachs,
                type: 'GET',
            })
            .done(function(data) {
                deferred.resolve(data);
            })
            .fail(function(e) {
                deferred.reject(e);
            })


        return deferred.promise();

    }


    var generateHtmlFormAssistance = (data,date) => {
        var html = "";
        if (!data.state && !data.profit) {
            html = "- <button type='button' class='btn btn-link btn-sm add-coach-assistance' data-date='"+date+"' data-coach='"+data.coach_id+"' data-field='"+data.field_id+"' data-id='"+data.id+"' data-toggle='modal' data-target='#assistanceCoachModal' data-action='insert'><i class='i-Add'></i></button>";
        } else if (data.profit && data.state) {
            html = "$" + parseFloat(Math.round(data.profit * 100) / 100).toFixed(2) + " <button data-profit='"+data.profit+"' data-date='"+date+"' data-coach='"+data.coach_id+"' type='button' data-field='"+data.field_id+"' data-id='"+data.id+"' data-toggle='modal' data-target='#assistanceCoachModal' class='btn btn-link btn-sm edit-coach-assistance' data-action='edit'><i class='i-Pen-2'></i></button>";
        } else if(data.state == 1 && data.profit == 0) {
            html = "No Asistirá  <button type='button' data-state='1' data-field='"+data.field_id+"' data-date='"+date+"' data-coach='"+data.coach_id+"' data-toggle='modal' data-target='#assistanceCoachModal' data-id='"+data.id+"' class='btn btn-link btn-sm edit-coach-assistance' data-action='edit'><i class='i-Pen-2'></i></button>";
        }

        return html;


    }


    var generateAssistanceCoachTable = (data, idCoachs) => {

        var html = "";
        var totals = {};
        for (var i = 0; i < data.length; i++) {
            html += "<tr>";
            html += "<td>" + data[i].day + "</td>";
            html += "<td>" + data[i].date + "</td>";
            for (var x = 0; x < data[i].coachs.length; x++) {
                html += "<td>" + generateHtmlFormAssistance(data[i].coachs[x], data[i].fulldate) + "</td>";
                
                if (!totals.hasOwnProperty('coach_'+x)) {
                    totals['coach_'+x] = 0;    
                }
                totals['coach_'+x]+= data[i].coachs[x].profit ? data[i].coachs[x].profit :  0 ; 
            }
            html += "</tr>";
        }
        html+="<tr class='table-light'><td colspan='2' class='text-center'><b>Total </b></td>";
        for(var coachTotal in totals) {
            html+="<td> $ " + parseFloat(Math.round(totals[coachTotal] * 100) / 100).toFixed(2) + "</td>";
        }
        html+="</tr>";
        return html;

    }






    $('.assistance-coach').each(function(index, el) {
        var $tableCoachBody = $(el).find('.table-coach-body');
        var loader = $tableCoachBody.find('.loader-modal-container');
        var monthSelected = $(el).find('.select-coach-month').val();
        var fieldId = $tableCoachBody.data('field');
        var numCoachs = $tableCoachBody.data('coachs');
        var idCoachs = $tableCoachBody.data('idcoachs');
        //loader
        loader.css('visibility', 'visible');
        loadAssistances(monthSelected, fieldId, idCoachs)
            .done((data) => {
                loader.css('visibility', 'hidden');
                var html = generateAssistanceCoachTable(data, idCoachs);
                $tableCoachBody.find('tr').remove();
                $tableCoachBody.append(html)
            })
            .fail((error) => {
                console.log(error)
            });
    });



    $('.select-coach-month').on('change', function(event) {
        var el = event.currentTarget;
        var monthSelected = $(el).val();
        var $tableCoachBody = $(el).closest('.assistance-coach').find('.table-coach-body');

        var fieldId = $tableCoachBody.data('field');
        var numCoachs = $tableCoachBody.data('coachs');
        var idCoachs = $tableCoachBody.data('idcoachs');
        $tableCoachBody.find('tr').remove();
        var loaderString = "<tr><td colspan='" + (numCoachs + 2) + "'><div class='col-12 text-center loader-modal-container'><div class='loader-bubble loader-bubble-primary'></div></div></td></tr>";
        //loader
        $tableCoachBody.append(loaderString);
        loadAssistances(monthSelected, fieldId, idCoachs)
            .done((data) => {
                var html = generateAssistanceCoachTable(data, idCoachs);
                $tableCoachBody.find('tr').remove();
                $tableCoachBody.append(html)
            })
            .fail((error) => {
                console.log(error)
            });
    });




    $('#assistanceCoachModal').on('show.bs.modal', function(event) {
        
        var $el = event.relatedTarget;
        var btn = $($el);
        var action = btn.data('action');
        var idAssistance = btn.data('id');
        var idCoach = btn.data('coach');
        var idField = btn.data('field');
        var profit = btn.data('profit');
        var date = btn.data('date');
        var modal = $(event.currentTarget);
        var routeAction = '/coachs-assistances';

        if (action == 'insert') {
            modal.find('.modal-title').text('Insertar Asistencia');
            modal.find('form #put').remove();
        } else {
            modal.find('.modal-title').text('Editar Asistencia');
            routeAction += '/'+idAssistance;
            modal.find('form').append('<input id="put" type="hidden" name="_method" value="PUT">');
        }
        
        modal.find('form').attr('action',routeAction);
        modal.find('form #field-id').val(idField);
        modal.find('form #coach-id').val(idCoach);
        modal.find('form #profit').val(profit);
        modal.find('form #date').val(date);
        
        modal.find('form #state').val(!profit ? 2 : 1);
        if (!profit) modal.find('form #profit').prop('readonly','readonly')
        
    });


    $('.select-assistance-coach').on('change', function(event) {
        var $el = $(event.currentTarget);
        
        var $proffit = $('form #profit')
        
        $proffit.val('')
        if(parseInt($el.val()) == 2) {
            $proffit.prop('readonly','readonly')
        } else {
            $proffit.removeAttr('readonly')
        }
    });



});