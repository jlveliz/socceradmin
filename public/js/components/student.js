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
        $classType = $("#class-type");
        let fieldId = $(event.currentTarget).find('option:selected').val();
        $groupSelect.find('option').remove();
        $groupSelect.prop('disabled','disabled');
        if(parseInt(fieldId) == 0) {
            //reset format
            $groupSelect.find('option').remove();
            $groupSelect.prop('disabled','disabled');
            return false;
        }

        loadGroups(fieldId).then( 
            (data) => {
                formatDomSelect(data).then((formatted) => {
                    $groupSelect.append(formatted)
                    //if class is selected
                    if($classType.find('option:selected').val() != '') {
                        $groupSelect.removeAttr('disabled');
                    }
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
        let htmlReturn = "<option value=''>Seleccione</option>";
        data.forEach(element => {
            htmlReturn+="<option value='"+element.id+"'>"; 
            htmlReturn+= element.name+' - <span class="text-secondary"><i>'+element.day  + ' - (' + element.schedule.start +  ' - ' + element.schedule.end + ') </i></span> '
            htmlReturn+="</option>";
        });

        dfd.resolve(htmlReturn); 
        return dfd.promise();
    }


    $("#class-type").on('change',(event) => {
        let classSelected = $(event.currentTarget).find('option:selected').val();
        if(classSelected > 0) {
            $("#grupo-class").prop('multiple','multiple')
        } else if(classSelected <= 0 || !classSelected ) {
            $("#grupo-class").removeAttr('multiple')
        }
        
        let fieldId = $("#select-field").find('option:selected').val();
        if( !classSelected) {
            $("#grupo-class").prop('disabled','disabled')
        } else if(fieldId <= 0) {
            $("#grupo-class").prop('disabled','disabled')
        } else {
            $("#grupo-class").removeAttr('disabled')
        }

    });

})