$(document).ready( () => {

	if ($("#list-seasons").length > 0) {
        $("#list-seasons").DataTable({
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
            ]
        })
    }

})