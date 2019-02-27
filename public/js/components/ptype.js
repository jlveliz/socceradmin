$(document).ready(function() {

    if ($("#list-ptypes").length > 0) {
        $("#list-ptypes").DataTable({
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

});