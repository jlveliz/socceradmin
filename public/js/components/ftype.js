$(document).ready(function() {

    if ($("#list-ftypes").length > 0) {
        $("#list-ftypes").DataTable({
            language: {
                url: 'js/data-table/spanish.json'
            },
            orderable: false,
            columnDefs: [{
                orderable: false,
                targets: 1
            }],
            order: [
                [0, 'asc'],
            ]
        })
    }

});