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
                            <h3 class="card-title">Kết quả xét nghiệm/chẩn đoán</h3>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Bệnh nhân:</th>
                                        <td>{{ $diagnosis->patient->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Bác sĩ:</th>
                                        <td>{{ $diagnosis->doctor->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Chẩn đoán bệnh chính:</th>
                                        <td>{{ $diagnosis->main_diagnosis }}</td>
                                    </tr>
                                    <tr>
                                        <th>Chẩn đoán bệnh phụ:</th>
                                        <td>{{ $diagnosis->side_diagnosis }}</td>
                                    </tr>
                                    <tr>
                                        <th>Xét nghiệm:</th>
                                        <td>
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>Tên xét nghiệm</th>
                                                        <th>Kết quả</th>
                                                        <th>Trị số tham chiếu</th>
                                                        <th>Đơn vị</th>
                                                        <th>QT/PPXN</th>
                                                        <th>Lưu ý</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($diaPre as $val)
                                                    <tr>
                                                        <td>{{
                                                            $services->where('id', $val['service_id'])->first()->service_name
                                                        }}</td>
                                                        <td>{{ $val['result'] }}</td>
                                                        <td>{{ $val['references_range'] }}</td>
                                                        <td>{{ $val['unit'] }}</td>
                                                        <td>{{ $val['method'] }}</td>
                                                        <td>{{ $val['diagnosis_note'] }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <th>Lưu ý:</th>
                                        <td>{{ $diagnosis->note }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('diagnosises.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Quay lại
                                </a>

                                <div>
                                    <a href="{{ route('diagnosises.edit', $diagnosis->id) }}" class="btn btn-primary">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <form action="{{ route('diagnosises.destroy', $diagnosis->id) }}" method="POST"
                                        class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" style="color: red;"
                                            onclick="return confirm('Bạn có chắc chắn muốn xoá xét nghiệm/chẩn đoán này?')">
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
