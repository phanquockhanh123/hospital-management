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
            <div class="row">
                <div class="col-md-3">
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ $medical_device->name }}</h3>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Mã thiết bị:</th>
                                        <td>{{ $medical_device->medical_device_code }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tên thiết bị:</th>
                                        <td>{{ $medical_device->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Avatar:</th>
                                        <td><img src="{{ asset('./imgDevices/'. $medical_device->filename) }}" 
                                                    style="vertical-align: middle;
                                                        width: 200px;
                                                        height: 300px;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Phòng ban:</th>
                                        <td>{{ $medical_device->department_id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Giá thiết bị:</th>
                                        <td>{{ $medical_device->charge }}</td>
                                    </tr>
                                    <tr>
                                        <th>Số lượng:</th>
                                        <td>{{ $medical_device->quantity }}</td>
                                    </tr>
                                    <tr>
                                        <th>Ngày hết hạn:</th>
                                        <td>{{ $medical_device->expired_date->format(config('const.format.date')) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Mô tả:</th>
                                        <td>{{ $medical_device->description }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('medical_devices.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Quay lại
                                </a>

                                <div>
                                    <a href="{{ route('medical_devices.edit', $medical_device->id) }}" class="btn btn-primary">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <form action="{{ route('medical_devices.destroy', $medical_device->id) }}" method="POST"
                                        class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" style="color: red"
                                            onclick="return confirm('Bạn có chắc chắn muốn xoá giường bệnh này?')">
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
