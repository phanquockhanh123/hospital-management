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

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <h2>
                                    @if(session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif</h2>
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
                                                        <td>{{ $salary->allowance }}</td>
                                                        <td>{{ $salary->total_salary }}</td>
                                                        <td>{{ $salary->created_at }}</td>
                                                        <td>
                                                            <th>
                                                                @if ($salary->status == 0)
                                                                <span class="text-warning">Chưa thanh toán</span>
                                                                @elseif ($salary->status == 1)
                                                                <span class="text-primary">Đã thanh toán</span>
                                                                @endif
                                                            </th>
                                                        </td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <a href="{{ route('salaries.payment', $salary->id) }}"
                                                                    class="btn btn-warning  @if ($salary->status == 1) disabled @endif">
                                                                    <i class="fas fa-edit"></i> Thanh toán
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

