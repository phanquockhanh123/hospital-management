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
                            <h3 class="card-title">{{ $doctor->name }}</h3>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Avatar:</th>
                                        <td><img src="{{ asset('./imgDoctor/'. $doctor->filename) }}" 
                                                    style="vertical-align: middle;
                                                        width: 200px;
                                                        height: 300px;">

                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Giới tính:</th>
                                        <td>
                                            @if($doctor->gender == 0)
                                            <span class="text-primary">Nam</span>
                                            @endif
                                            @if($doctor->gender == 1)
                                            <span class="text-primary">Nữ</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Địa chỉ:</th>
                                        <td>{{ $doctor->address }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tên phòng ban:</th>
                                        <td>{{ $doctor->doctorDepartment->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nhóm máu:</th>
                                        <td>
                                            @if($doctor->blood_group == 0)
                                            <span class="text-primary">Group O</span>
                                            @endif
                                            @if($doctor->blood_group == 1)
                                            <span class="text-primary">Group A</span>
                                            @endif
                                            @if($doctor->blood_group == 2)
                                            <span class="text-primary">Group B</span>
                                            @endif
                                            @if($doctor->blood_group == 3)
                                            <span class="text-primary">Group AB</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Số điện thoại:</th>
                                        <td>{{ $doctor->phone }}</td>
                                    </tr>

                                    <tr>
                                        <th>Địa chỉ:</th>
                                        <td>{{ $doctor->address }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email:</th>
                                        <td>{{ $doctor->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Ngày sinh:</th>
                                        <td>{{ $doctor->date_of_birth->format(config('const.format.date')) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Số CMT/CCCD:</th>
                                        <td>{{ $doctor->identity_number }}</td>
                                    </tr>
                                    <tr>
                                        <th>Ngày cấp:</th>
                                        <td>{{ $doctor->identity_card_date }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nơi cấp:</th>
                                        <td>{{ $doctor->identity_card_place }}</td>
                                    </tr>
                                    <tr>
                                        <th>Giới thiệu bản thân:</th>
                                        <td>{{ $doctor->designation }}</td>
                                    </tr>
                                    <tr>
                                        <th>Trình độ  học vấn:</th>
                                        <td>
                                            @if($doctor->academic_level == 0)
                                            <span class="text-primary">Cao đẳng</span>
                                            @endif
                                            @if($doctor->academic_level == 1)
                                            <span class="text-primary">Đại học</span>
                                            @endif
                                            @if($doctor->academic_level == 2)
                                            <span class="text-primary">Thạc sỹ</span>
                                            @endif
                                            @if($doctor->academic_level == 3)
                                            <span class="text-primary">Giáo sư</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Ngày bắt đầu vào làm việc:</th>
                                        <td>{{ $doctor->start_work_date }}</td>
                                    </tr>
                                    <tr>
                                        <th>Chuyên ngành:</th>
                                        <td>{{ $doctor->specialist }}</td>
                                    </tr>
                                    
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('doctors.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Quay lại
                                </a>

                                <div>
                                    <a href="{{ route('doctors.edit', $doctor->id) }}" class="btn btn-primary">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST"
                                        class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" style="color:red;"
                                            onclick="return confirm('Bạn có chắc chắn muốn xoá phòng ban này?')">
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