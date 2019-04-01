$(document).ready(function() {
    var loadAssistances = (monthSelected, fieldId) => {

        var deferred = jQuery.Deferred();

        $.ajax({
                url: '/coachs-assistances/schedule?month=' + monthSelected + '&field=' + fieldId,
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


    var generateAssistanceCoachTable = (data, numcoachs, fieldId, idCoachs) => {

        var html = "";
        for (var i = 0; i < data.length; i++) {
            html += "<tr>";
            html += "<td>" + data[i].day + "</td>";
            html += "<td>" + data[i].date + "</td>";
            for (var x = 0; x < numcoachs; x++) {
                html += "<td></td>";
            }
            html += "</tr>";
        }

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
        loadAssistances(monthSelected, fieldId)
            .done((data) => {
                loader.css('visibility', 'hidden');
                var html = generateAssistanceCoachTable(data, numCoachs, fieldId, idCoachs);
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
        loadAssistances(monthSelected, fieldId)
            .done((data) => {
                var html = generateAssistanceCoachTable(data, numCoachs , fieldId, idCoachs);
                $tableCoachBody.find('tr').remove();
                $tableCoachBody.append(html)
            })
            .fail((error) => {
                console.log(error)
            });
    });



});