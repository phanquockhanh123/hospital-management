<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hospital Management</title>
    @include('admin.css')
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

        <div class="container">
            <div class="card">
                <div class="row">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-9">
                        <div class="card-header">
                            <h3 class="card-title">Chỉnh sửa lịch hẹn</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('appointments.update', $appointment->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="patient_id">Bệnh nhân:</label>
                                    <select name="patient_id" class="form-control input-sm m-bot15">
                                        <option value="">----Chọn bệnh nhân----</option>
                                        @foreach ($patients as $patient)
                                        <option value="{{ $patient->id }}" {{ $appointment->patient_id == $patient->id ?
                                            'selected' : '' }}>{{ $patient->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('patient_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="doctor_id">Bác sĩ:</label>
                                    <select name="doctor_id" class="form-control input-sm m-bot15">
                                        <option value="">----Chọn bác sĩ----</option>
                                        @foreach ($doctors as $doctor)
                                        <option value="{{ $doctor->id }}" {{ $appointment->doctor_id == $doctor->id ?
                                            'selected' : '' }}>{{ $doctor->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('doctor_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="doctor_department_id">Phòng ban:</label>
                                    <select name="doctor_department_id" class="form-control input-sm m-bot15">
                                        <option value="">----Chọn phòng ban----</option>
                                        @foreach ($doctorDepartments as $doctorDepartment)
                                        <option value="{{ $doctorDepartment->id }}" {{ $appointment->
                                            doctor_department_id == $doctorDepartment->id ? 'selected' : '' }}>{{
                                            $doctorDepartment->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('doctor_department_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="start_time">Thời gian bắt đầu:</label>
                                    <input type="datetime-local" name="start_time" id="start_time"
                                        class="form-control @error('start_time') is-invalid @enderror"
                                        value="{{ old('start_time', $appointment->start_time) }}">
                                    @error('start_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="end_time">Thời gian kết thúc:</label>
                                    <input type="datetime-local" name="end_time" id="end_time"
                                        class="form-control @error('end_time') is-invalid @enderror"
                                        value="{{ old('end_time', $appointment->end_time) }}">
                                    @error('end_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description">Mô tả:</label>
                                    <textarea class="form-control" id="description" name="description"
                                        rows="5">{{  $appointment->description }}</textarea>
                                    @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <a href="{{ route('appointments.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Quay lại
                                    </a>

                                    <button type="submit" class="btn btn-primary" style="color:blue;">
                                        <i class="fas fa-save"></i> Lưu lại
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="main-footer">
            <strong>Bản quyền &copy; 2023 <a href="#">Phan Quốc Khánh</a>.</strong>
            Đã đăng ký Bản quyền.
            <div class="float-right d-none d-sm-inline-block">
              <b>Laravel</b> 8.1.0
            </div>
          </footer>
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    @include('admin.script')
</body>

</html>