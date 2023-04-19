import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();


$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    
    var calendar = $("#calendar").fullCalendar({
        editable: true,
        header:{
            left:'prev, next today',
            center:'title',
            right:'month, agendaWeek, agendaDay'
        },
        events:'/calendar',
        selectable: true,
        selectHelper: true,
    });
    function successResponse(data)
    {
        calendar.fullCalendar('refetchEvents');
    }
});

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    
    var calendar = $("#calendar1").fullCalendar({
        editable: true,
        header:{
            left:'prev, next today',
            center:'title',
            right:'month, agendaWeek, agendaDay'
        },
        events:'/calendar-user',
        selectable: true,
        selectHelper: true,
    });
    function successResponse(data)
    {
        calendar.fullCalendar('refetchEvents');
    }
});