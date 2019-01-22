$(document).ready(function(){
    //coming data
    $("#table-results-search").on('resource-selected',(event, data) => {
        //fill data
        $("#representant_user_id").val(data.user_id);
        $("#representant_person_id").val(data.id);
        $("#representant_num_identification").val(data.num_identification);
        $("#representant_name").val(data.name);
        $("#representant_last_name").val(data.last_name);
        $("#representant_address").val(data.address);
        $("#representant_email").val(data.email);
        $("#representant_phone").val(data.phone);
        $("#representant_mobile").val(data.mobile);
        $("#representant_genre").val(data.genre);
        $("#representant_date_birth").val(data.date_birth);


    });


    $("#select-field").on('change',(evet) => {
        $groupSelect = $("#grupo-class");
        let fieldId = $(event.currentTarget).find('option:selected').val();
        if(parseInt(fieldId) == 0) {
            //reset format
            $groupSelect.prop('disabled','disabled');
            $groupSelect.find('option').remove();
            return false;
        }

        loadGroups(fieldId).then( 
            (data) => {
                formatDomSelect(data).then((formatted) => {
                    $groupSelect.append(formatted)
                    $groupSelect.removeAttr('disabled');
                })
            },
            (reject) => {
                $groupSelect.prop('disabled','disabled');
            }
            )
            
        });
        
    loadGroups = (fieldId) => {
        var dfd = jQuery.Deferred();
        $.ajax({
            url: '/fields/'+fieldId+'/groupclass',
            type:'GET'
        })
        .done((data) => {
            dfd.resolve(data);
        })
        .fail( (fail) => {
            dfd.reject(fail);
        })

        return dfd.promise();
    };

    formatDomSelect = (data) => {
        var dfd = jQuery.Deferred();
        let htmlReturn = "";
        data.forEach(element => {
            htmlReturn+="<option value='"+element.id+"'>"; 
            htmlReturn+= element.name+' - <span class="text-secondary"><i>'+element.day  + ' - (' + element.schedule.start +  ' - ' + element.schedule.end + ') </i></span> '
            htmlReturn+="</option>";
        });

        dfd.resolve(htmlReturn); 
        return dfd.promise();
    }

})