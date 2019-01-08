$(document).ready( (event) => {

    /*
        Select a field, load schedule
    */
    
    $(".btn-query-field").on('click',(event) => {
        let fieldId = $("#field-id").val();
        let tableSchedule = $('#table-schedule');
        if(!fieldId) return false;

        $.ajax({
            method: 'GET',
            url:'/fields/'+fieldId+'/schedule'
        })
        .done((data) => {
            tableSchedule.find('tbody tr').remove();
            debugger;
            let htmlData= "";
            for(let item in data) {
                htmlData+="<tr>";
                htmlData+='<td rowspan="">'+data[item].label+"</td>";
                for(let sched in data[item].schedule) {
                    htmlData+="<td>"+data[item].schedule[sched].start+"</td>";
                    htmlData+="<td>"+data[item].schedule[sched].end+"</td>";
                }
                htmlData+= "</tr>";
            }
            tableSchedule.removeClass('d-none');
            tableSchedule.find('tbody').append(htmlData);
        })
        .fail( (event) => {

        })
    })


})