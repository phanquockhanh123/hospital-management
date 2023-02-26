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
                            <h3 class="card-title">Tạo mới bệnh án</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('addmission_patients.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="doctor_id">Bác sĩ phụ trách:</label>
                                    <select name="doctor_id" class="form-control input-sm m-bot15">
                                        <option value="">----Chọn bác sĩ phụ trách----</option>
                                        @foreach ($doctors as $doctor)
                                        <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('doctor_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

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
                                    <label for="bed_id">Giường bệnh:</label>
                                    <select name="bed_id" class="form-control input-sm m-bot15">
                                        <option value="">----Chọn giường bệnh----</option>
                                        @foreach ($beds as $bed)
                                        <option value="{{ $bed->id }}">{{ $bed->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('bed_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="addmission_date">Ngày nhập viện:</label>
                                    <input type="date" name="addmission_date" id="addmission_date"
                                        class="form-control @error('addmission_date') is-invalid @enderror"
                                        value="{{ old('addmission_date') }}">
                                    @error('addmission_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="reason">Lý do nhập viện:</label>
                                    <input type="text" name="reason" id="reason"
                                        class="form-control @error('reason') is-invalid @enderror"
                                        value="{{ old('reason') }}">
                                    @error('reason')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="health_condition">Tình trạng sức khỏe:</label>
                                    <input type="text" name="health_condition" id="health_condition"
                                        class="form-control @error('health_condition') is-invalid @enderror"
                                        value="{{ old('health_condition') }}">
                                    @error('health_condition')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="guardian_name">Tên người giám hộ:</label>
                                    <input type="text" name="guardian_name" id="guardian_name"
                                        class="form-control @error('guardian_name') is-invalid @enderror"
                                        value="{{ old('guardian_name') }}">
                                    @error('guardian_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="guardian_relation">Mối quan hệ:</label>
                                    <input type="text" name="guardian_relation" id="guardian_relation"
                                        class="form-control @error('guardian_relation') is-invalid @enderror"
                                        value="{{ old('guardian_relation') }}">
                                    @error('guardian_relation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="gurdian_contact">Số điện thoại liên hệ:</label>
                                    <input type="date" name="gurdian_contact" id="gurdian_contact"
                                        class="form-control @error('gurdian_contact') is-invalid @enderror"
                                        value="{{ old('gurdian_contact') }}">
                                    @error('gurdian_contact')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="guardian_address">Địa chỉ:</label>
                                    <input type="text" name="guardian_address" id="guardian_address"
                                        class="form-control @error('guardian_address') is-invalid @enderror"
                                        value="{{ old('guardian_address') }}">
                                    @error('guardian_address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description">Mô tả:</label>
                                    <textarea class="form-control" id="description" name="description"
                                        rows="5"></textarea>
                                    @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <a href="{{ route('patients.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Quay lại
                                    </a>

                                    <button type="submit" class="btn btn-primary">
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