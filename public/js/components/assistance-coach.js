$(document).ready(function() {

    var loadAssistances = () => {
        
        $('.select-coach-month').each(function(index, el) {
        	debugger
        	$(el).trigger('change');
        });
    }

    loadAssistances();




    $('.assistance-coach').on('change', '.select-coach-month', function(event) {
        debugger;
        var $select = $(event.currentTarget);
        var monthSelected = $select.val();
        var fieldTable = $select.closest('.assistance-coach').find('.table-coach-body').data('field');
        var numCoachsTable = $select.closest('.assistance-coach').find('.table-coach-body').data('coachs');

        console.log(monthSelected, fieldTable, numCoachsTable)

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