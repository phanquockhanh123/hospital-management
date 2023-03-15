<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hospital Management</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @include('admin.css')

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-sparkline@2.4.0/jquery.sparkline.min.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="admin2/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60"
                width="60">
        </div>

        <!-- Navbar -->
        @include('admin.navbar')
        <!-- /.navbar -->

        @include('admin.sidebar')


        <!-- Modal -->
        <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Booking title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control" id="title">
                        <span id="titleError" class="text-danger"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" style="color: black;"
                            data-bs-dismiss="modal">Close</button>
                        <button type="button" id="saveBtn" style="color: blue;" class="btn btn-primary">Save
                            changes</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-10">
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
        </section>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
            integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var booking = @json($events);
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridWeek',
                    headerToolbar: {
                        left: 'prev,next',
                        center: 'title',
                        right: 'dayGridDay,dayGridWeek,dayGridMonth,dayGridYear' // user can switch between the two
                    },
                    events: booking,
                    selectable: true,
                    selectHelper: true,
                    select: function(selectionInfo) {
                        $('#bookingModal').modal('toggle');

                        $('#saveBtn').click(function() {
                            var title = $('#title').val();
                            var start_date = moment(selectionInfo.start).format('YYYY-MM-DD');
                            var end_date = moment(selectionInfo.end).format('YYYY-MM-DD');

                            $.ajax({
                                url: "{{ route('calendar.store') }}",
                                type: "POST",
                                dataType: 'json',
                                data: {
                                    title,
                                    start_date,
                                    end_date
                                },
                                success: function(response) {
                                    $('#bookingModal').modal('hide')
                                    $('#calendar').fullCalendar('renderEvent', {
                                        'title': response.title,
                                        'start': response.start,
                                        'end': response.end,
                                        'color': response.color
                                    });
                                },
                                error: function(error) {
                                    if (error.responseJSON.errors) {
                                        $('#titleError').html(error.responseJSON.errors
                                            .title);
                                    }
                                },
                            });
                        });
                    },
                    editable: true,
                    eventDrop: function(eventDropInfo) {
                        var id = eventDropInfo.id;
                        console.log(eventDropInfo);
                        var start_date = moment(eventDropInfo.start).format('YYYY-MM-DD');
                        var end_date = moment(eventDropInfo.end).format('YYYY-MM-DD');
                        $.ajax({
                            url: "{{ route('calendar.update', '') }}" + '/' + id,
                            type: "PATCH",
                            dataType: 'json',
                            data: {
                                start_date,
                                end_date
                            },
                            success: function(response) {
                                swal("Good job!", "Event Updated!", "success");
                            },
                            error: function(error) {
                                console.log(error)
                            },
                        });
                    },
                    eventClick: function(event) {
                        var id = event.id;
                        if (confirm('Are you sure want to remove it')) {
                            $.ajax({
                                url: "{{ route('calendar.destroy', '') }}" + '/' + id,
                                type: "DELETE",
                                dataType: 'json',
                                success: function(response) {
                                    $('#calendar').fullCalendar('removeEvents', response);
                                    // swal("Good job!", "Event Deleted!", "success");
                                },
                                error: function(error) {
                                    console.log(error)
                                },
                            });
                        }
                    },
                });
                calendar.render();
            });
        </script>

        @include('admin.script')
</body>

</html>
