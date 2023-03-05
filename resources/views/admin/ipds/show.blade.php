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
                            <h3 class="card-title">Bệnh nhân {{ $ipd->patient->name }}</h3>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Bác sĩ phụ trách:</th>
                                        <td>{{ $ipd->doctor->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Giường số:</th>
                                        <td>{{ $ipd->bed->bed_code }}</td>
                                    </tr>
                                    <tr>
                                        <th>Addmission date:</th>
                                        <td>{{ $ipd->addmission_date->format(config('const.format.date')) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nhóm máu:</th>
                                        <td>{{ $ipd->blood_group }}</td>
                                    </tr>
                                    <tr>
                                        <th>Chiều cao:</th>
                                        <td>{{ $ipd->height }}</td>
                                    </tr>
                                    <tr>
                                        <th>Cân nặng:</th>
                                        <td>{{ $ipd->weight }}</td>
                                    </tr>
                                    <tr>
                                        <th>Huyết áp:</th>
                                        <td>{{ $ipd->blood_pressure }}</td>
                                    </tr>
                                    <tr>
                                        <th>Triệu chứng:</th>
                                        <td>{{ $ipd->symptoms }}</td>
                                    </tr>
                                    <tr>
                                        <th>Trạng thái:</th>
                                        <td>{{ $ipd->patient_status }}</td>
                                    </tr>
                                    <tr>
                                        <th>Lưu ý:</th>
                                        <td>{{ $ipd->notes }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('ipds.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Quay lại
                                </a>

                                <div>
                                    <a href="{{ route('ipds.edit', $ipd->id) }}"
                                        class="btn btn-primary">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <form action="{{ route('ipds.destroy', $ipd->id) }}" method="POST"
                                        class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" style="color:red;"
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