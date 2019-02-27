$(document).ready(function() {

    if ($("#list-users").length > 0) {
        $("#list-users").DataTable({
            language: {
                url: 'js/data-table/spanish.json'
            },
            orderable: false,
            columnDefs: [{
                orderable: false,
                targets: 4
            }],
            order: [
                [0, 'asc'],
                [1, 'asc'],
                [2, 'asc'],
                [3, 'asc'],
            ]
        })
    }

});