$(document).ready(function(){
    //coming data
    $("#table-results-search").on('resource-selected',(event, data) => {
        //fill data
        $("#representant_user_id").val(data.user_id);
        $("#representant_num_identification").val(data.num_identification);
        $("#representant_name").val(data.name);
        $("#representant_last_name").val(data.last_name);
        $("#representant_address").val(data.address);
        $("#representant_phone").val(data.phone);
        $("#representant_mobile").val(data.mobile);
        $("#representant_genre").val(data.genre);
        $("#representant_date_birth").val(data.date_birth);


    })

})