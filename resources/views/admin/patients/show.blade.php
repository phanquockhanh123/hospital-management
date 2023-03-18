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
                            <h3 class="card-title"> <span class="text-primary">BỆNH NHÂN :  {{ $patient->name }}</span></h3>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Mã bệnh nhân:</th>
                                        <td>{{ $patient->code }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tên bệnh nhân:</th>
                                        <td>{{ $patient->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Avatar:</th>
                                        <td><img src="{{ asset('./imgPatient/'. $patient->filename) }}" 
                                                    style="vertical-align: middle;
                                                        width: 200px;
                                                        height: 300px;">

                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Giới tính:</th>
                                        <td>
                                            @if($patient->gender == 0)
                                            <span class="text-primary">Nam</span>
                                            @endif
                                            @if($patient->gender == 1)
                                            <span class="text-primary">Nữ</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Nhóm máu:</th>
                                        <td>
                                            @if($patient->blood_group == 0)
                                            <span class="text-primary">Group O</span>
                                            @endif
                                            @if($patient->blood_group == 1)
                                            <span class="text-primary">Group A</span>
                                            @endif
                                            @if($patient->blood_group == 2)
                                            <span class="text-primary">Group B</span>
                                            @endif
                                            @if($patient->blood_group == 3)
                                            <span class="text-primary">Group AB</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Điện thoại:</th>
                                        <td>{{ $patient->phone }}</td>
                                    </tr>
                                    <tr>
                                        <th>Địa chỉ:</th>
                                        <td>{{ $patient->address }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email:</th>
                                        <td>{{ $patient->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Số CMT/CCCD:</th>
                                        <td>{{ $patient->identity_number }}</td>
                                    </tr>
                                    <tr>
                                        <th>Ngày cấp:</th>
                                        <td>{{ $patient->identity_card_date?->format(config('const.format.date')) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nơi cấp:</th>
                                        <td>{{ $patient->identity_card_place }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('patients.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Quay lại
                                </a>

                                <div>
                                    <a href="{{ route('patients.edit', $patient->id) }}"
                                        class="btn btn-primary">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <form action="{{ route('patients.destroy', $patient->id) }}" method="POST"
                                        class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" style="color: red"
                                            onclick="return confirm('Bạn có chắc chắn muốn xoá bệnh nhân này?')">
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