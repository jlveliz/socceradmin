$(document).ready(function() {

    $("#assistance-modal").on('show.bs.modal', function(event) {

        var btn = $(event.relatedTarget);
        var modal = $(event.currentTarget);
        let idField = btn.data('field');

        //reset
        $(".loader-modal-container").removeClass('d-none')
        $(".container-result ul li").remove();
        $(".modal-message h4").addClass('d-none');
        $("#mytabassistance").html('');

        if (idField && parseInt(idField) != NaN) {

            //reset 
            modal.find('.modal-title').text('');

            $.ajax({
                    url: 'fields/' + idField,
                    dataType: 'json',
                })
                .done(function(result) {
                    var title = result.name;
                    if (title) {
                        modal.find('.modal-title').text(title);
                        generateTabsDay(result.available_days).then(function(html) {
                            var tabs = html;
                            $(".container-result ul").append(tabs);
                            $(".container-result ul").addClass('d-none');
                            generateGroupsByDay(result.groups).then(function(html) {
                                //loadtabs
                                $("#mytabassistance").append(html);
                                getTimeSeason().done(function(data) {
                                    var currentMonth = (new Date()).getMonth();
                                    currentMonth++;
                                    for (var option in data) {
                                        var selected = parseInt(option) != NaN && parseInt(option) == currentMonth ? "selected" : '';
                                        var option = "<option value='" + option + "' " + selected + ">" + data[option] + "</option>";
                                        $('.month').append(option);
                                    }
                                    $('.month').trigger('change');
                                });
                            })
                        })

                    }
                })
                .fail(function(error) {
                    $(".modal-message h4").text(error.responseText).parent().removeClass('d-none')
                })
                .always(function() {
                    // $(".loader-modal-container").addClass('d-none');
                })
        } else {
            $(event.currentTarget).modal('hide')
            return false;
        }

    });


    $('#assistance-modal').on('change', '.month', function(e) {
        var currentTarget = $(e.currentTarget);
        var monthSelected = currentTarget.val();
        var group = currentTarget.parents('.tab-pane-group');
        group.find('.show-table table').remove();
        var dataGroup = group.data('group')
        dataGroup['month'] = monthSelected;
        if ($(".container-result ul").hasClass('d-none')) {
            $(".loader-modal-container").removeClass('d-none')
        } else {
            group.find('.show-table').append("<div class='col-12 text-center loader-table'><div class='loader-bubble loader-bubble-primary m-5'></div></div>");
        }
        getTableInfoAssistance(dataGroup).done(function(html) {
            $(".container-result").removeClass('d-none');
            $(".container-result ul").removeClass('d-none');
            $(".loader-modal-container").addClass('d-none');
            group.find('.show-table').append(html);
            // debugger
            group.find('.loader-table').remove()
        });
    });


    var generateTabsDay = function(availableDays) {
        var deferred = jQuery.Deferred();
        var html = "";
        var counter = 1;
        for (var avaylable in availableDays) {
            var active = counter == 1 ? 'active' : false;
            var selected = active ? true : false;
            html += "<li class='nav-item'>";
            html += "<a class='nav-link " + active + "' id='" + avaylable + "-tab' aria-selected='" + selected + "' data-toggle='tab' href='#" + avaylable + "' role='tab' aria-controls='" + avaylable + "'>" + days_of_week(avaylable) + "</a>";
            html += "<li>";
            counter++;
        }

        if (html.length > 1) {
            deferred.resolve(html);
        } else {
            deferred.reject();
        }


        return deferred.promise();

    }

    var generateGroupsByDay = function(groups) {
        var deferred = jQuery.Deferred();
        var html = "";
        var days = [];

        groups.forEach(function(element, index) {

            if (!days.length) {
                days.push({ day: element.day, groups: [element] });
            } else {
                var idx = days.findIndex(ele => ele.day == element.day);
                if (idx == -1) {
                    days.push({ day: element.day, groups: [element] });
                } else {
                    days[idx].groups.push(element);
                }
            }
        });

        if (days.length) {

            for (var i = 0; i < days.length; i++) {
                var active = null;
                if (i == 0) active = "show active";
                html += "<div class='tab-pane fade " + active + "' id='" + days[i].day + "' role='tabpanel' aria-labelledby='" + days[i].day + "-tab'>";
                html += "<ul class='nav nav-tabs customtab mb-2'>";
                for (var x = 0; x < days[i].groups.length; x++) {
                    var activeLi = x == 0 ? "active" : null;
                    var selected = activeLi ? true : false
                    html += "<li class='nav-item'>";
                    html += "<a class='nav-link p-2 " + activeLi + "' id='" + days[i].groups[x].name + "-" + days[i].day + "-" + x + "-tab' aria-selected='" + selected + "' data-toggle='tab' href='#" + days[i].groups[x].name + "-" + days[i].day + "-" + x + "' role='tab' aria-controls='" + days[i].groups[x].name + "-" + days[i].day + "-" + x + "'>" + get_group_names(days[i].groups[x].name) + '(' + days[i].groups[x].schedule.start + '-' + days[i].groups[x].schedule.end + ")</a>";
                    html += "</li>";
                }
                html += "</ul>";

                //tabs content
                html += "<div class='tab-content pt-0'>";
                for (var x = 0; x < days[i].groups.length; x++) {
                    var activeTab = x == 0 ? "show active" : "false";
                    html += "<div class='tab-pane fade " + activeTab + " tab-pane-group' id='" + days[i].groups[x].name + "-" + days[i].day + "-" + x + "' role='tabpanel' aria-labelledby='" + days[i].groups[x].name + "-" + days[i].day + "-" + x + "-tab' data-group='" + JSON.stringify({ field: days[i].groups[x].field_id, group_id: days[i].groups[x].id, key_day: days[i].groups[x].day }) + "'>";
                    html += "<div class='row'>";
                    html += "<div class='col-lg-2 col-12 px-0'>";
                    html += "<div class='form-group'>";
                    html += "<label for='month'>Mes</label>";
                    html += "<select class='month form-control'>";
                    html += "</select>";
                    html += "</div>";
                    html += "</div>";
                    html += "</div>";
                    html += "<div class='show-table'></div>";
                    html += "</div>";
                }
                html += "</div>";

                html += "</div>";
            }
            deferred.resolve(html);
        }


        return deferred.promise()

    }

    var getTimeSeason = function() {
        var deferred = jQuery.Deferred();
        $.ajax({
                url: 'seasons/get-current-duration-season',
                type: 'GET',
            })
            .done(function(data) {

                deferred.resolve(data);
            })
            .fail(function() {
                alert("hubo un error al cargar los meses de temporada");
            })
            .always(function() {
                console.log("complete");
            });

        return deferred.promise()
    }
    var getTableInfoAssistance = function(group) {
        var deferred = jQuery.Deferred();
        $.ajax({
                url: '/dashboard/get-schedules',
                type: 'GET',
                data: group,
            })
            .done(function(data) {
                var html = "<div class='row'><div class='col-12 px-0'><div class='table-responsive'>";
                html += "<table class='table'>";
                html += "<thead class='thead-dark text-center'>";
                html += "<tr>"
                html += "<th>F. de Inscripción</th>"
                html += "<th>Nombre</th>"
                html += "<th>Edad</th>"
                html += "<th>Representante</th>"
                html += "<th>I</th>"
                html += "<th>M</th>"
                html += "<th>C</th>"
                for (var i = 0; i < data['dates'].length; i++) {
                    html += "<th>" + (new Date(data['dates'][i].date)).getDate() + "</th>"
                }
                html += "</tr>"
                html += "</thead>";
                html += "<tbody>";
                if (data['assistances'].length > 0) {
                    for (var i = 0; i < data['assistances'].length; i++) {
                        html += "<tr>";
                        html += "<td>" + data['assistances'][i].date_inscription + "</td>";
                        html += "<td>" + data['assistances'][i].student_name + "</td>";
                        html += "<td>" + data['assistances'][i].age + "</td>";
                        html += "<td>" + data['assistances'][i].representant + "</td>";
                        html += "<td>" + data['assistances'][i].is_pay_inscription == '1' ? +' Si ' : ' No ' + "</td>";
                        html += "<td>" + data['assistances'][i].is_pay_first_month == '1' ? +' Si ' : ' No ' + "</td>";
                        html += "<td>" + data['assistances'][i].is_delivered_uniform == '1' ? +' Si ' : ' No ' + "</td>";
                        for (var i = 0; i < data['assistances'].length; i++) {
                            var idAssistance = 'id_' + i;
                            html += '<td class="text-center">' + data['assistances'][i][idAssistance] + '</td>';
                        }
                        html += "</tr>";
                    }

                } else {
                    html += "<tr><td colspan='" + (7 + data['dates'].length) + "' clas='text-center'><p class='text-center align-middle'>No existen datos</p></td></tr>";
                }
                html += "</tbody>";
                html += "</table>";
                html += "</div>";
                html += "</div>";
                html += "</div>";

                deferred.resolve(html);

            })
            .fail(function(err) {
                console.log(err);
            })
            .always(function() {
                console.log("complete");
            });

        return deferred.promise();

    }





});