$(document).ready( (event) => {

    /*
        Select a field, load schedule
    */
    
    $(".btn-query-field").on('click',(event) => {
        let fieldId = $("#field-id").val();
        let tableSchedule = $('#table-schedule');
        let groupDetail = $('#groups-detail');
        $('.accordion').addClass('d-none');
        //effect
        $('.loading').removeClass('d-none');

        if(!fieldId) return false;

        $.ajax({
            method: 'GET',
            url:'/fields/'+fieldId+'/schedule'
        })
        .done((data) => {
            tableSchedule.find('tbody tr').remove();
            //schedule refference
            let htmlData = generateHtmlFieldSchedule(data);
            tableSchedule.find('tbody').append(htmlData);

            //group details
            // let htmlData = generateHtmlGroupDetail(data);
            // groupDetail.append(htmlData);

        })
        .fail( (event) => {

        })
    })


})

function generateHtmlFieldSchedule (data) {
    let htmlData= "";
    
    for(let item in data) {
        
        let lengthSchedule =  Object.keys(data[item].schedule).length;

        htmlData+="<tr>";
        htmlData+='<td rowspan="'+lengthSchedule+'" class="align-middle">'+data[item].label+"</td>";
        let scheduleDetailcount = 1;
        for(let sched in data[item].schedule) {
            if(scheduleDetailcount > 1) {
                htmlData+="<tr>";
            }
            htmlData+="<td>"+data[item].schedule[sched].start+"</td>";
            htmlData+="<td>"+data[item].schedule[sched].end+"</td>";
            //close item
            if(scheduleDetailcount < lengthSchedule) {
                htmlData+="</tr>";
                scheduleDetailcount++;
            }
        }
        htmlData+= "</tr>";
    }
    $('.d-none').removeClass('d-none');
    $('.loading').addClass('d-none');
    return htmlData;
}


function generateHtmlGroupDetail(data) {
    let html = "";

    return html;
}