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
                            <form action="{{ route('ipds.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="doctor_id">Bác sĩ phụ trách:</label>
                                    <select name="doctor_id" class="form-control input-sm m-bot15">
                                        <option value="">----Chọn bác sĩ phụ trách----</option>
                                        @foreach ($doctors as $doctor)
                                        <option value="{{ $doctor->id }}" >
                                            {{ $doctor->name }}</option>
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
                                        <option value="{{ $patient->id }}">
                                            {{ $patient->name }}</option>
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
                                        <option value="{{ $bed->id }}">
                                            {{ $bed->name }}</option>
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
                                    <label for="blood_group">Nhóm máu:</label>
                                    <select name="blood_group" class="form-control input-sm m-bot15">
                                        <option value="">----Chọn nhóm máu----</option>
                                        <option value="0">Nhóm máu O
                                        </option>
                                        <option value="1">Nhóm máu A
                                        </option>
                                        <option value="2">Nhóm máu B
                                        </option>
                                        <option value="3">Nhóm máu
                                            AB</option>
                                    </select>
                                    @error('blood_group')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="height">Chiều cao:</label>
                                    <input type="text" name="height" id="height"
                                        class="form-control @error('height') is-invalid @enderror"
                                        value="{{ old('height') }}">
                                    @error('height')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="weight">Cân nặng:</label>
                                    <input type="text" name="weight" id="weight"
                                        class="form-control @error('weight') is-invalid @enderror"
                                        value="{{ old('weight') }}">
                                    @error('weight')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="blood_pressure">Huyết áp:</label>
                                    <input type="text" name="blood_pressure" id="blood_pressure"
                                        class="form-control @error('blood_pressure') is-invalid @enderror"
                                        value="{{ old('blood_pressure') }}">
                                    @error('blood_pressure')
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
                                    <label for="symptoms">Triệu chứng:</label>
                                    <input type="text" name="symptoms" id="symptoms"
                                        class="form-control @error('symptoms') is-invalid @enderror"
                                        value="{{ old('symptoms') }}">
                                    @error('symptoms')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="notes">Lưu ý:</label>
                                    <input type="text" name="notes" id="notes"
                                        class="form-control @error('notes') is-invalid @enderror"
                                        value="{{ old('notes')}}">
                                    @error('notes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="patient_status">Trạng thái:</label>
                                    <select name="patient_status" class="form-control input-sm m-bot15">
                                        <option value="0">Bệnh nhân nhập viện</option>
                                        <option value="1">Bệnh nhân xuất viện</option>
                                    </select>
                                    @error('patient_status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <a href="{{ route('ipds.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Quay lại
                                    </a>

                                    <button type="submit" class="btn btn-primary" style="color: blue">
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