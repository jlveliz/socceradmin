$(document).ready(function() {

    if ($("#list-pertypes").length > 0) {
        $("#list-pertypes").DataTable({
            language: {
                url: 'js/data-table/spanish.json'
            },
            orderable: false,
            columnDefs: [{
                orderable: false,
                targets: 2
            }],
            order: [
                [0, 'asc'],
                [1, 'asc'],
               
            ]
        })
    }

});