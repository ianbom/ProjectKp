
@extends('layouts.calender')
@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    <style>
        /* General Styling */

        body {
            background: linear-gradient(to bottom right, #CED2FB, #E8E9FF);
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        .card {
            background-color: #E8F0FE;
            border-radius: 7px;
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 12px 20px rgba(0, 0, 0, 0.2);
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            font-weight: 600;
            font-size: 2.2rem;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #eee;
        }

        /* Calendar Container */
        #calendar {
            padding: 20px;
            background: #E8F0FE;
            border-radius: 15px;
        }

        /* Calendar Header */
        .fc-toolbar {
            margin-bottom: 30px !important;
            padding: 20px !important;
            background-color: rgb(0, 17, 255);
            border-radius: 12px;
            color: white !important;
        }



        .fc-toolbar h2 {
            font-size: 1.8rem !important;
            font-weight: 600 !important;
            color: white !important;
        }

        .fc-toolbar button {
            background: rgba(255, 255, 255, 0.2) !important;
            border: 2px solid rgba(255, 255, 255, 0.3) !important;
            color: white !important;
            padding: 8px 15px !important;
            text-transform: capitalize !important;
            transition: all 0.3s ease !important;
            box-shadow: none !important;
        }

        .fc-toolbar button:hover {
            background: rgba(255, 255, 255, 0.3) !important;
            border-color: rgba(255, 255, 255, 0.4) !important;
            transform: translateY(-1px);
        }

        /* Calendar Grid */
        .fc-day-header {
            background-color: #f8f9fa !important;
            color: #2c3e50 !important;
            padding: 12px 0 !important;
            font-weight: 600 !important;
            text-transform: uppercase !important;
            font-size: 0.9rem !important;
        }

        .fc td, .fc th {
            border: 1px solid #e9ecef !important;
        }

        .fc-day {
            transition: all 0.3s ease;
        }

        .fc-day:hover {
            background-color: #f8f9fa !important;
        }

        /* Today Highlight */
        .fc-today {
            background-color: #CED2FB !important;
            border: 2px solid #2196f3 !important;
        }

        /* Events Styling */
        .fc-event {
            background: linear-gradient(135deg, #4CAF50 0%, #45a049 50%) !important;
            border: none !important;
            border-radius: 5px !important;
            padding: 5px 8px !important;
            margin: 2px !important;
            color: white !important;
            font-size: 0.9rem !important;
            cursor: pointer !important;
            transition: all 0.3s ease !important;
        }

        .fc-event:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2) !important;
        }

        /* More Link Styling */
        .fc-more {
            color: #3498db !important;
            font-weight: 600 !important;
        }

        /* Toastr Customization */
        .toast-success {
            background-color: #0B20E9 !important;
            border-radius: 8px !important;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .container {
                padding: 15px;
                margin: 10px;
            }

            h1 {
                font-size: 1.8rem;
            }

            .fc-toolbar h2 {
                font-size: 1.4rem !important;
            }

            .fc-toolbar button {
                padding: 5px 10px !important;
                font-size: 0.9rem !important;
            }
        }
    </style>

<div class="container ">
    <div class="card">
        <div id='calendar'></div>
    </div>
</div>
    <script>
    $(document).ready(function () {
        var SITEURL = "{{ url('/') }}";

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var calendar = $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            editable: true,
            events: SITEURL + "/fullcalender",
            displayEventTime: false,
            eventRender: function (event, element, view) {
                if (event.allDay === 'true') {
                    event.allDay = true;
                } else {
                    event.allDay = false;
                }
            },
            selectable: true,
            selectHelper: true,
            select: function (start, end, allDay) {
                var title = prompt('Event Title:');
                if (title) {
                    var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
                    var end = $.fullCalendar.formatDate(end, "Y-MM-DD");
                    $.ajax({
                        url: SITEURL + "/fullcalenderAjax",
                        data: {
                            title: title,
                            start: start,
                            end: end,
                            type: 'add'
                        },
                        type: "POST",
                        success: function (data) {
                            displayMessage("Event Created Successfully");
                            calendar.fullCalendar('renderEvent', {
                                id: data.id,
                                title: title,
                                start: start,
                                end: end,
                                allDay: allDay
                            }, true);
                            calendar.fullCalendar('unselect');
                        }
                    });
                }
            },
            eventDrop: function (event, delta) {
                var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");
                $.ajax({
                    url: SITEURL + '/fullcalenderAjax',
                    data: {
                        title: event.title,
                        start: start,
                        end: end,
                        id: event.id,
                        type: 'update'
                    },
                    type: "POST",
                    success: function (response) {
                        displayMessage("Event Updated Successfully");
                    }
                });
            },
            eventClick: function (event) {
                var deleteMsg = confirm("Do you really want to delete?");
                if (deleteMsg) {
                    $.ajax({
                        type: "POST",
                        url: SITEURL + '/fullcalenderAjax',
                        data: {
                            id: event.id,
                            type: 'delete'
                        },
                        success: function (response) {
                            calendar.fullCalendar('removeEvents', event.id);
                            displayMessage("Event Deleted Successfully");
                        }
                    });
                }
            }
        });

        // Configure toastr
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "3000"
        };
    });

    function displayMessage(message) {
        toastr.success(message, 'Event');
    }
    </script>


@endsection
