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
            <img class="animation__shake" src="admin2/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60"
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
                            <h3 class="card-title">Tạo mới lịch hẹn</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('appointments.store') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="patient_id">Bệnh nhân:</label>
                                    <select name="patient_id" class="form-control input-sm m-bot15">
                                        <option value="">----Chọn bệnh nhân----</option>
                                        @foreach ($patients as $patient)
                                        <option value="{{ $patient->id }}">{{ $patient->name }}</option>
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
                                        <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
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
                                        <option value="{{ $doctorDepartment->id }}">{{ $doctorDepartment->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('doctor_department_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="appointment_date">Ngày hẹn:</label>
                                    <input type="date" name="appointment_date" id="appointment_date"
                                        class="form-control @error('appointment_date') is-invalid @enderror"
                                        value="{{ old('appointment_date') }}">
                                    @error('appointment_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description">Mô tả:</label>
                                    <textarea class="form-control" id="description" name="description" rows="5"></textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <a href="{{ route('appointments.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Quay lại
                                    </a>

                                    <button type="submit" class="btn btn-primary" style="color: blue;">
                                        <i class="fas fa-save"></i> Tạo mới
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.script')
</body>

</html>