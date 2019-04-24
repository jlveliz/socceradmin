$(document).ready(function() {
    $("#form-field-cancha").on('change', function(event) {
        var $day = $("#form-field-dia");
        var $hour = $("#form-field-hora");
        $hour.prop('disabled', 'disabled');
        $day.prop('disabled', 'disabled');
        var id = $(event.currentTarget).val();
        $day.find('option').remove();
        $hour.find('option').remove();
        var htmlFirstOption = "<option value='null'>Selecciona el día</option>";
        var htmlFirstOptionHour = "<option value='null'>Selecciona la hora</option>";
        $day.append(htmlFirstOption);
        $hour.append(htmlFirstOptionHour);
        if (parseInt(id)) {
            loadDaysByField(id).then(function(days) {
                $day.removeAttr('disabled')
                var html = "";
                for (var day in days) {
                    html += "<option value='" + days[day].day + "'>" + days_of_week(days[day].day) + "</option>";
                }
                $day.append(html);
            })
        }
    });


    $("#form-field-dia").on('change', function(event) {
        var dayId = $(event.currentTarget).val();
        var fieldId = $("#form-field-cancha").val();
        var $hour = $("#form-field-hora");
        var htmlFirstOption = "<option value='null'>Selecciona la hora</option>";
        $hour.prop('disabled', 'disabled');
        if (dayId != 'null' || dayId != 'NULL') {
            $hour.find('option').remove();
            $hour.removeAttr('disabled')
            $hour.append(htmlFirstOption);
            loadScheduleByDayField(dayId, fieldId).then(function(hours) {
                for (var hourOpen in hours) {
                    // if (keyDayLocalStorage == dayId) {
                    var htmlOpen = "<option value='" + hourOpen + "'>" + hourOpen + "</option>";
                    $("#form-field-hora").append(htmlOpen)
                    // }
                }

            })
        }
    });


    $("#registro-form").on('submit', function(event) {
        
        event.preventDefault();
        event.stopPropagation();
        var form = $(this).serialize();

        $.ajax({
            url: 'register',
            type: 'POST',
            dataType: 'json',
            data: form,
        })
        .done(function() {
            console.log("success");
        })
        .fail(function(error) {
            console.log(error);
        })
        .always(function() {
            console.log("complete");
        });
        

    });



    function loadDaysByField(idField) {
        var deferred = jQuery.Deferred();
        $.ajax({
                url: "groups/" + idField + "/available-schedule",
                type: 'GET',
            })
            .done(function(data) {
                deferred.resolve(data);
            })
            .fail(function(err) {
                console.log(err)
                alert("hubo un error el horario de la cancha");
            })
            .always(function() {
                console.log("complete");
            });

        return deferred.promise()
    }


    function loadScheduleByDayField(keyDay, fieldId) {
        var deferred = jQuery.Deferred();
        $.ajax({
                url: "groups/" + fieldId + "/available-hour?day=" + keyDay,
                type: 'GET',
            })
            .done(function(data) {
                deferred.resolve(data);
            })
            .fail(function(err) {
                console.log(err)
                alert("hubo un error el horario de la cancha");
            })
            .always(function() {
                console.log("complete");
            });

        return deferred.promise()

    }


});