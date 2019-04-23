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
        localStorage.removeItem('days');
        if (parseInt(id)) {
           
            loadDaysByField(id).then(function(days) {
                localStorage.setItem('days', JSON.stringify(days));
                $day.removeAttr('disabled')
                var html = "";
                for (var day in days) {
                    html += "<option value='" + day + "'>" + days_of_week(day) + "</option>";
                }
                $day.append(html);
            })
        }
    });


    $("#form-field-dia").on('change', function(event) {
        var dayId = $(event.currentTarget).val();
        var $hour = $("#form-field-hora");
        var htmlFirstOption = "<option value='null'>Selecciona la hora</option>";
        $hour.prop('disabled', 'disabled');
        if (dayId != 'null' || dayId != 'NULL') {
            $hour.find('option').remove();
            $hour.removeAttr('disabled')
            var daysLocalStorage = JSON.parse(localStorage.getItem('days'));
            $hour.append(htmlFirstOption);
            for (var keyDayLocalStorage in daysLocalStorage) {
                if (keyDayLocalStorage == dayId) {
                    var open = daysLocalStorage[keyDayLocalStorage].schedule.schedule_0.start;
                    var htmlOpen = "<option value='" + open + "'>" + open + "</option>";
                    $("#form-field-hora").append(htmlOpen)
                }
            }
        }
    });



    function loadDaysByField(idField) {
        var deferred = jQuery.Deferred();
        $.ajax({
                url: "../fields/" + idField + "/schedule",
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