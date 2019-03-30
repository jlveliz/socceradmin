$(document).ready(function() {
    var loadAssistances = (monthSelected, fieldId, numCoachs) => {

        var deferred = jQuery.Deferred();

        $.ajax({
                url: '/coachs-assistances/schedule?month='+monthSelected,
                type: 'GET',
            })
            .done(function(data) {
                console.log(data);
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });


        return deferred.promise();

    }






    $('.assistance-coach').each(function(index, el) {
        var $tableCoachBody = $(el).find('.table-coach-body');
        var monthSelected = $(el).find('.select-coach-month').val();
        var fieldId = $tableCoachBody.data('field');
        var numCoachs = $tableCoachBody.data('coachs');
        loadAssistances(monthSelected, fieldId, numCoachs);
    });


    // $.ajax({
    //         url: '',
    //         type: 'default GET (Other values: POST)',
    //         dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
    //         data: { param1: 'value1' },
    //     })
    //     .done(function() {
    //         console.log("success");
    //     })
    //     .fail(function() {
    //         console.log("error");
    //     })
    //     .always(function() {
    //         console.log("complete");
    //     });



});