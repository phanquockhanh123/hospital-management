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
            <img class="animation__shake"
                src="https://media.licdn.com/dms/image/C4D03AQGB9X-aVyccoQ/profile-displayphoto-shrink_800_800/0/1517596403369?e=2147483647&v=beta&t=jJ0WBwNT7Uq1bc4KRRBHJM_cOmv3Yt544vbvRh3VwYE"
                alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        @include('admin.navbar')
        <!-- /.navbar -->

        @include('admin.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-header">
                                <h1 style="font-size: 20px; font-weight:bold">Bảng lương tháng {{ now()->month }}/{{  now()->year  }}</h1>
                            </div>
                            <div class="card">
                                <h2>
                                    @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                    @endif
                                </h2>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    @if ($salaries->count() == 0)
                                    <div class="alert alert-danger" role="alert">
                                        Không tìm thấy bảng lương tháng nay.
                                    </div>
                                    @else
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Tên nhân viên</th>
                                                <th>Email</th>
                                                <th>Số ngày làm</th>
                                                <th>Lương cơ bản</th>
                                                <th>Phụ cấp</th>
                                                <th>Tổng lương</th>
                                                <th>Ngày tạo</th>
                                                <th>Trạng thái</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($salaries as $salary)
                                            <tr>
                                                <td>{{ $count++; }}</td>
                                                <td>{{ $salary->user->name }}</td>
                                                <td>{{ $salary->user->email }}</td>
                                                <td>{{ $salary->day_worked }}</td>
                                                <td>{{ $salary->salary }}</td>
                                                <td>{{ $salary->allowance }}</td>
                                                <td>{{ $salary->allowance + $salary->salary }}</td>
                                                <td>{{ $salary->created_at }}</td>
                                                <td>
                                                    @if ($salary->status == 0)
                                                    <span class="text-warning">Chưa thanh toán</span>
                                                    @elseif ($salary->status == 1)
                                                    <span class="text-primary">Đã thanh toán</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{ route('salaries.payment', $salary->id) }}"
                                                            class="btn btn-warning  @if ($salary->status == 1) disabled @endif">
                                                            <i class="fas fa-checkout"></i> Thanh toán
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach


                                        </tbody>
                                    </table>
                                    {{ $salaries->links() }}
                                    @endif
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <strong>Bản quyền &copy; 2023 <a href="#">Phan Quốc Khánh</a>.</strong>
            Đã đăng ký Bản quyền.
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