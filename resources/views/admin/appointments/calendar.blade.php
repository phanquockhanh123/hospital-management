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
            <img class="animation__shake" src="https://media.licdn.com/dms/image/C4D03AQGB9X-aVyccoQ/profile-displayphoto-shrink_800_800/0/1517596403369?e=2147483647&v=beta&t=jJ0WBwNT7Uq1bc4KRRBHJM_cOmv3Yt544vbvRh3VwYE" alt="AdminLTELogo" height="60"
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
                        <h5 class="modal-title" id="exampleModalLabel">Booking Appointment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="title">Title:</label>
                                <input type="text" class="form-control" name="title" id="title">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="doctor_id">Chọn bác sĩ:</label>
                                <select name="doctor_id" id="doctor_id" class="form-control input-sm m-bot15">
                                    <option value="">----Chọn bác sĩ----</option>
                                    @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                    @endforeach
                                </select>
                                @error('doctor_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label for="patient_id">Chọn bệnh nhân:</label>
                                <select name="patient_id" id="patient_id" class="form-control input-sm m-bot15">
                                    <option value="">----Chọn bệnh nhân----</option>
                                    @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                    @endforeach
                                </select>
                                @error('patient_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label for="doctor_department_id">Phòng ban:</label>
                                <select name="doctor_department_id" id="doctor_department_id" class="form-control input-sm m-bot15">
                                    <option value="">----Chọn phòng ban----</option>
                                    @foreach ($doctorDepartments as $doctorDepartment)
                                    <option value="{{ $doctorDepartment->id }}">{{ $doctorDepartment->name }}</option>
                                    @endforeach
                                </select>
                                @error('doctor_department_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- <div class="form-group col-md-12">
                                <label for="start_time">Thời gian bắt đầu:</label>
                                    <input type="date" name="start_time" id="start_time"
                                        class="form-control @error('start_time') is-invalid @enderror"
                                        value="{{ old('start_time') }}">
                                    @error('start_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                            </div>

                            <div class="form-group col-md-12">
                                <label for="end_time">Thời gian kết thúc:</label>
                                <input type="date" name="end_time" id="end_time"
                                    class="form-control @error('end_time') is-invalid @enderror"
                                    value="{{ old('end_time') }}">
                                @error('end_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div> --}}
                            <div class="form-group col-md-12">
                                <label for="description">Description:</label>
                                <input type="text" class="form-control" name="description" id="description">
                            </div>

                        </div>
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
                        right: 'dayGridYear,dayGridMonth,timeGridWeek,timeGridDay' // user can switch between the two
                    },
                    events: booking,
                    selectable: true,
                    selectHelper: true,
                    select: function(selectionInfo) {
                        $('#bookingModal').modal('toggle');

                        $('#saveBtn').click(function() {
                            var title = $('#title').val();
                            var description = $('#description').val();
                            var doctor_id = $('#doctor_id :selected').val();
                            var patient_id = $('#patient_id :selected').val();
                            var doctor_department_id = $('#doctor_department_id :selected').val();
                            var start_time = moment(selectionInfo.start).format('YYYY/MM/DD hh:mm');
                            var end_time = moment(selectionInfo.end).format('YYYY/MM/DD hh:mm');

                            $.ajax({
                                url: "{{ route('calendar.store') }}",
                                type: "POST",
                                dataType: 'json',
                                data: {
                                    title,
                                    doctor_id,
                                    patient_id,
                                    doctor_department_id,
                                    start_time,
                                    end_time,
                                    description
                                },
                                success: function(response) {
                                    $('#bookingModal').modal('hide')
                                    $('#calendar').fullCalendar('renderEvent', {
                                        'title' : response.title,
                                        'doctor_id': response.doctor_id,
                                        'patient_id': response.patient_id,
                                        'doctor_department_id': response.doctor_department_id,
                                        'description': response.description,
                                        'start_time': response.start_time,
                                        'end_time': response.end_time,
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
                });
                calendar.render();
            });
        </script>

        @include('admin.script')
</body>

</html>