@extends('layouts.master')

@section('content')

    <main>

        <div class="container-fluid text-center">
            <!-- Grid row -->
            <div class="row">
                <div class="col-md-6">
                    <!-- First name -->
                    <div class="row">
                        <input type="text" id="RegNo" class="form-control" placeholder="Registration Number">
                    </div>
                    <div class="row">
                        <button type="button" class="btn btn-primary" style="width:100%" onclick="searchAttendence()">Search</button>
                    </div>
                </div>
            </div>
            <div class="container" id="calenderDiv" style="background-color: #fff3cd" style="display: none">
                <div class="response"></div>
                <div id='calendar'></div>
            </div>

        </div>

    </main>

@endsection
@push('moreJs')
<script>
    $(document).ready(function () {

    });
    function searchAttendence() {

        $('#calendar').fullCalendar('removeEvents');
        $('#calendar').fullCalendar('refetchEvents');
        var reg_no = $('#RegNo').val();
        if(reg_no){
            $('#calenderDiv').show();
            var SITEURL = "{{url('/')}}";

//            var color = '#eaf01f';


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var calendar = $('#calendar').fullCalendar({
                editable: true,
                //events: SITEURL + "/attendence-load-by-student",
                displayEventTime: false,
                events: {
                    url: SITEURL + "/attendence-load-by-student",
                    data: function () { // a function that returns an object
                        return {
                            reg_no: $('#RegNo').val(),
                        };

                    }
                },
//                eventColor: color,

                eventRender: function (event, element, view) {

                    if (event.allDay === 'true') {
                        event.allDay = true;
                    } else {
                        event.allDay = false;
                    }
                },
                selectable: false,
                selectHelper: true,
                select: function (start, end, allDay) {
                    var title = prompt('Event Title:');
                    if (title) {
                        var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                        var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
                        $.ajax({
                            url: SITEURL + "/fullcalendareventmaster/create",
                            data: 'title=' + title + '&start=' + start + '&end=' + end,
                            type: "POST",
                            success: function (data) {
                                displayMessage("Added Successfully");
                            }
                        });
                        calendar.fullCalendar('renderEvent',
                            {
                                title: title,
                                start: start,
                                end: end,
                                allDay: allDay
                            },
                            true
                        );
                    }
                    calendar.fullCalendar('unselect');
                },
                eventDrop: function (event, delta) {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                    $.ajax({
                        url: SITEURL + '/fullcalendareventmaster/update',
                        data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
                        type: "POST",
                        success: function (response) {
                            displayMessage("Updated Successfully");
                        }
                    });
                },
                eventClick: function (event) {
                    var deleteMsg = confirm("Do you really want to delete?");
                    if (deleteMsg) {
                        $.ajax({
                            type: "POST",
                            url: SITEURL + '/fullcalendareventmaster/delete',
                            data: "&id=" + event.id,
                            success: function (response) {
                                if(parseInt(response) > 0) {
                                    $('#calendar').fullCalendar('removeEvents', event.id);
                                    displayMessage("Deleted Successfully");
                                }
                            }
                        });
                    }
                }
            });
        }


    }
    function displayMessage(message) {
        $(".response").html(message);
        setInterval(function() { $(".success").fadeOut(); }, 1000);
    }
</script>

@endpush


