$(document).ready(function() {


    if ($("#list-students").length > 0) {
        $("#list-students").DataTable({
            language: {
                url: 'js/data-table/spanish.json'
            },
            orderable: false,
            columnDefs: [{
                orderable: false,
                targets: 5
            }],
            order: [
                [0, 'asc'],
                [1, 'asc'],
                [2, 'asc'],
                [3, 'asc'],
                [4, 'asc'],
            ]
        })
    }


    loadGroups = (fieldId) => {
        var dfd = jQuery.Deferred();
        $.ajax({
                url: '/fields/' + fieldId + '/groupclass',
                type: 'GET'
            })
            .done((data) => {
                dfd.resolve(data);
            })
            .fail((fail) => {
                dfd.reject(fail);
            })

        return dfd.promise();
    };

    formatDomSelect = (data) => {
        var dfd = jQuery.Deferred();
        // let htmlReturn = "<option value=''>Seleccione</option>";
        let htmlReturn = "";
        data.forEach(element => {
            htmlReturn += "<option value='" + element.id + "'>";
            htmlReturn +=  element.range.name + ' - ' +element.coach.username + ' - ' + element.disponibility + ' Cupos Disponibles<span class="text-secondary"><i> - ' + element.day + ' - (' + element.schedule.start + ' - ' + element.schedule.end + ') </i></span> '
            htmlReturn += "</option>";
        });

        dfd.resolve(htmlReturn);
        return dfd.promise();
    }


    //coming data
    $("#table-results-search").on('resource-selected', (event, data) => {
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


    $("#select-field").on('change', (evet) => {
        $groupSelect = $("#grupo-class");
        $classType = $("#class-type");
        let fieldId = $(evet.currentTarget).find('option:selected').val();
        $groupSelect.find('option').remove();
        $groupSelect.prop('disabled', 'disabled');
        if (!fieldId) {
            $("#class-type").val('');
            $("#grupo-class").val('');
            $("#grupo-class").removeAttr('multiple')
            //reset format
            $groupSelect.find('option').remove();
            $groupSelect.prop('disabled', 'disabled');
            return false;
            return false;
        }

        loadGroups(fieldId).then(
            (data) => {
                formatDomSelect(data).then((formatted) => {
                    $groupSelect.append(formatted)
                    //if class is selected
                    if ($classType.find('option:selected').val() != '') {
                        $groupSelect.removeAttr('disabled');
                    }
                })
            },
            (reject) => {
                $groupSelect.prop('disabled', 'disabled');
            }
        )

    });

    //when if create but return for validations
    if ($(".grupo-class-create").length > 0) {
        $('#select-field').trigger('change')
    }




    $("#class-type").on('change', (event) => {
        let classSelected = $(event.currentTarget).find('option:selected').val();
        if (classSelected > 1) {
            $("#grupo-class").prop('multiple', 'multiple')
        } else if (classSelected <= 1 || !classSelected) {
            $("#grupo-class").removeAttr('multiple')
        }

        let fieldId = $("#select-field").find('option:selected').val();
        if (!classSelected) {
            $("#grupo-class").prop('disabled', 'disabled')
        } else if (fieldId <= 1) {
            $("#grupo-class").prop('disabled', 'disabled')
        } else {
            $("#grupo-class").removeAttr('disabled')
        }

    });


    //when change of group
    $('.grupo-class-edit').on('change', (e) => {
        $target = $(e.currentTarget);
        $("#is-changing-group").val(1);
    });


    $('#date_birth').on('change', function(event) {

        var currentElDate = moment($(event.currentTarget).val());
        var currentDate = moment(getFullCurrentDate());
        var difYear = currentDate.diff(currentElDate,'year')
        $('#age').val(difYear);
        
    });


    //MULTISELECT
    // $(".grupo-class-create").bsMultiSelect();
    $(".grupo-class-edit").bsMultiSelect();
    

})