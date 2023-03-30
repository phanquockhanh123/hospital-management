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
                            <h3 class="card-title">Chỉnh sửa đơn thuốc</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('prescriptions.update', $prescription->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="patient_id">Bệnh nhân:</label>
                                    <select name="patient_id" class="form-control input-sm m-bot15">
                                        <option value="">----Chọn bệnh nhân----</option>
                                        @foreach ($patients as $patient)
                                        <option value="{{ $patient->id }}" {{ $prescription->patient_id == $patient->id
                                            ?
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
                                        <option value="{{ $doctor->id }}" {{ $prescription->doctor_id == $doctor->id ?
                                            'selected' : '' }}>{{ $doctor->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('doctor_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="main_disease">Bệnh chính:</label>
                                    <input type="text" name="main_disease" id="main_disease"
                                        class="form-control @error('main_disease') is-invalid @enderror"
                                        value="{{ old('main_disease', $prescription->main_disease) }}">
                                    @error('main_disease')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="side_disease">Bệnh phụ:</label>
                                    <input type="text" name="side_disease" id="side_disease"
                                        class="form-control @error('side_disease') is-invalid @enderror"
                                        value="{{ old('side_disease', $prescription->side_disease) }}">
                                    @error('side_disease')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="card-header" style="display: flex!important">
                                    <label style="font-size: 20px;">Thuốc</label>
                                    <button style="margin-left: 80%;" class="btn btn-primary" id="btAddMedicine">Thêm
                                        thuốc</button>
                                </div>
                                <table class="table" id="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">TÊN THUỐC</th>
                                            <th scope="col">HÀM LƯỢNG</th>
                                            <th scope="col">ĐVT</th>
                                            <th scope="col">SỐ LƯỢNG</th>
                                            <th scope="col">LƯU Ý</th>
                                            <th scope="col">THAO TÁC</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody" name="tbody">
                                        @foreach ($preItem as $item)
                                        <tr id="sectionMain" name="sectionMain">
                                            <td>
                                                <input type="text" name="medical_name[]" id="medical_name"
                                                    class="form-control @error('medical_name') is-invalid @enderror"
                                                    value="{{ old('medical_name', $item['medical_name']) }}">
                                            </td>
                                            <td>
                                                <input type="text" name="dosage[]" id="dosage"
                                                    class="form-control @error('dosage') is-invalid @enderror"
                                                    value="{{ old('dosage', $item['dosage']) }}">
                                            </td>
                                            <td>
                                                <input type="text" name="unit[]" id="unit"
                                                    class="form-control @error('unit') is-invalid @enderror"
                                                    value="{{ old('unit', $item['unit']) }}">
                                            </td>
                                            <td>
                                                <input type="text" name="amount[]" id="amount"
                                                    class="form-control @error('amount') is-invalid @enderror"
                                                    value="{{ old('amount', $item['amount']) }}">
                                            </td>
                                            <td>
                                                <input type="text" name="dosage_note[]" id="dosage_note"
                                                    class="form-control @error('dosage_note') is-invalid @enderror"
                                                    value="{{ old('dosage_note', $item['dosage_note']) }}">
                                            </td>
                                            <td>
                                                <svg style="color: red" xmlns="http://www.w3.org/2000/svg" width="26"
                                                    height="26" fill="currentColor" class="bi bi-trash3"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                </svg>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <div class="form-group">
                                    <label for="note">Mô tả:</label>
                                    <textarea class="form-control" id="note" name="note"
                                        rows="5">{{  $prescription->note }}</textarea>
                                    @error('note')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <a href="{{ route('prescriptions.index') }}" class="btn btn-secondary">
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
            <strong>Copyright &copy; 2023 <a href="#">Khánh Engineer</a>.</strong>
            All rights reserved.
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
    <script>
        document.getElementById("btAddMedicine").onclick = function(e) {
            e.preventDefault();
            var body = document.getElementById("tbody");
            var section = document.getElementById("sectionMain");
            body.appendChild(section.cloneNode(true));
        }
    </script>
    @include('admin.script')
</body>

</html>