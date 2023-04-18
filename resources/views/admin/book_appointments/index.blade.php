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

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <form action="{{ route('book_appointments.index') }}" method="GET">
                                <div class="input-group mb-2">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Tìm kiếm yêu cầu lịch hẹn"
                                            name="search">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="submit">Tìm kiếm</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

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
                                    @if ($book_appointments->count() == 0)
                                        <div class="alert alert-danger" role="alert">
                                            Không tìm thấy kết quả yêu cầu lịch hẹn.
                                        </div>
                                    @else
                                        <table id="example2" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>STT</th>
                                                    <th>Họ tên</th>
                                                    <th>Số điện thoại</th>
                                                    <th>Email</th>
                                                    <th>Thời gian mong muốn</th>
                                                    <th>Nguyên nhân</th></th>
                                                    <th>Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($book_appointments as $book_appointment)
                                                    <tr>
                                                        <td>{{ $count++; }}</td>
                                                        <td>{{ $book_appointment->fullname }}</td>
                                                        <td>{{ $book_appointment->phone }}</td>
                                                        <td>{{ $book_appointment->email }}</td>
                                                        <td>{{ $book_appointment->experted_time }}</td>
                                                        <td>{{ $book_appointment->reason }}</td>
                                                        <td>
                                                            @if($book_appointment->status == 2) 
                                                                <i class="fa-solid fa-calendar-check" style="color:green;"></i>
                                                                
                                                            @elseif ($book_appointment->status == 1)
                                                                <a href="{{ route('book_appointments.denied', $book_appointment->id) }}" title="Từ chối"><i class="fa-solid fa-calendar-xmark"  style="color:red;"></i></a>
                                                                <a href="{{ route('book_appointments.accepted', $book_appointment->id) }}" title="Chấp nhận"><i class="fa-solid fa-calendar-check"  style="color:blue;"></i></a>
                                                                
                                                            @else
                                                                <i class="fa-solid fa-calendar-xmark" style="color:red;"></i>
                                                            @endif
                                                        </td>
                                                        
                                                    </tr>
                                                @endforeach


                                            </tbody>
                                        </table>
                                        {{ $book_appointments->links() }}
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

