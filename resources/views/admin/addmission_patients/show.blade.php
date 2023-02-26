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
            <div class="row">
                <div class="col-md-3">
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ $addmission_patient->id }}</h3>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Bác sĩ phụ trách:</th>
                                        <td>{{ $addmission_patient->doctor->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Bệnh nhân:</th>
                                        <td>{{ $addmission_patient->patient->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Giường số:</th>
                                        <td>{{ $addmission_patient->bed->bed_code }}</td>
                                    </tr>
                                    <tr>
                                        <th>Addmission date:</th>
                                        <td>{{ $addmission_patient->addmission_date->format(config('const.format.date')) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Lý do:</th>
                                        <td>{{ $addmission_patient->reason }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tình trạng sức khỏe:</th>
                                        <td>{{ $addmission_patient->health_condition }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tên người giám hộ:</th>
                                        <td>{{ $addmission_patient->guardian_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Mối quan hệ:</th>
                                        <td>{{ $addmission_patient->guardian_relation }}</td>
                                    </tr>
                                    <tr>
                                        <th>Liên hệ:</th>
                                        <td>{{ $addmission_patient->guardian_contact }}</td>
                                    </tr>
                                    <tr>
                                        <th>Địa chỉ:</th>
                                        <td>{{ $addmission_patient->guardian_address }}</td>
                                    </tr>
                                    <tr>
                                        <th>Mô tả:</th>
                                        <td>{{ $addmission_patient->guardian_address }}</td>
                                    </tr>
                                    <tr>
                                        <th>Địa chỉ:</th>
                                        <td>{{ $addmission_patient->description }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('addmission_patients.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Quay lại
                                </a>

                                <div>
                                    <a href="{{ route('addmission_patients.edit', $addmission_patient->id) }}"
                                        class="btn btn-primary">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <form action="{{ route('addmission_patients.destroy', $addmission_patient->id) }}" method="POST"
                                        class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Bạn có chắc chắn muốn xoá bệnh án này?')">
                                            <i class="fas fa-trash"></i> Xoá
                                        </button>
                                    </form>
                                </div>
                            </div>
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

    @include('admin.script')
</body>

</html>