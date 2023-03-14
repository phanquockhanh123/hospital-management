<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hospital Management</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @include('admin.css')
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

        <!DOCTYPE html>
        <html lang='en'>

        <head>
            <meta charset='utf-8' />
            <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js'></script>
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
                                    url:"{{ route('calendar.store') }}",
                                    type:"POST",
                                    dataType:'json',
                                    data:{ title, start_date, end_date  },
                                    success:function(response)
                                    {
                                        $('#bookingModal').modal('hide')
                                        $('#calendar').fullCalendar('renderEvent', {
                                            'title': response.title,
                                            'start' : response.start,
                                            'end'  : response.end,
                                            'color' : response.color
                                        });
                                    },
                                    error:function(error)
                                    {
                                        if(error.responseJSON.errors) {
                                            $('#titleError').html(error.responseJSON.errors.title);
                                        }
                                    },
                                });
                            });
                        },
                        editable: true,
                        eventDrop: function(event) {
                            console.log(event);
                        }
                    });
                    calendar.render();
                });

            </script>
        </head>

        <body>
            <!-- Modal -->
            <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
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
        </body>

        </html>

        @include('admin.script')
</body>

</html>