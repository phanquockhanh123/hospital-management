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
                            <form action="{{ route('appointments.index') }}" method="GET">
                                <div class="input-group mb-2">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Tìm kiếm lịch hẹn"
                                            name="search">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="submit">Tìm kiếm</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-3" style="float: right;">
                            <a href="{{ route('appointments.create') }}" class="btn btn-success">
                                <i class="fas fa-plus"></i> Tạo mới
                            </a>
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
                                    @if ($appointments->count() == 0)
                                        <div class="alert alert-danger" role="alert">
                                            Không tìm thấy cuộc hẹn nào.
                                        </div>
                                    @else
                                        <table id="example2" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>STT</th>
                                                    <th>Bệnh nhân</th>
                                                    <th>Bác sĩ</th>
                                                    <th>Phòng ban</th>
                                                    <th>Bắt đầu</th>
                                                    <th>Kết thúc</th>
                                                    <th>Trạng thái</th>
                                                    <th>Sửa/Xóa</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($appointments as $appointment)
                                                    <tr>
                                                        <td><a
                                                                href="{{ route('appointments.show', $appointment->id) }}">{{ $count++ }}</a>
                                                        </td>
                                                        <td>{{ $appointment->patient->name }}</td>
                                                        <td>{{ $appointment->doctor->name }}</td>
                                                        <td>{{ $appointment->doctorDepartment->name }}</td>
                                                        <td>{{ $appointment->start_time }}</td>
                                                        <td>{{ $appointment->end_time }}</td>
                                                        <td>
                                                            @if($appointment->status == 2) 
                                                                <i class="fa-solid fa-calendar-check" style="color:green;"></i>
                                                                
                                                            @elseif ($appointment->status == 1)
                                                                <a href="{{ route('appointments.denied', $appointment->id) }}"><i class="fa-solid fa-calendar-xmark"  style="color:red;"></i></a>
                                                                <a href="{{ route('appointments.accepted', $appointment->id) }}"><i class="fa-solid fa-calendar-check"  style="color:blue;"></i></a>
                                                                
                                                            @else
                                                                <i class="fa-solid fa-calendar-xmark" style="color:red;"></i>
                                                            @endif
                                                            
                                                        </td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <a href="{{ route('appointments.edit', $appointment->id) }}"
                                                                    class="btn btn-primary">
                                                                    <i class="fas fa-edit"></i> Sửa
                                                                </a>
                                                                <button type="button" class="btn btn-danger"
                                                                    data-toggle="modal"
                                                                    data-target="#deleteModal{{ $appointment->id }}"
                                                                    style="color: red;">
                                                                    <i class="fas fa-trash-alt"></i> Xóa
                                                                </button>
                                                            </div>
                                                        </td>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="deleteModal{{ $appointment->id }}"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="deleteModalLabel{{ $appointment->id }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="deleteModalLabel{{ $appointment->id }}">
                                                                            Xóa loại giường</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Bạn có chắc chắn muốn xóa lịch hẹn với bệnh nhân
                                                                        "{{ $appointment->patient->name }}" không? Hành động này
                                                                        không
                                                                        thể hoàn tác!
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal" style="color:black;">Hủy</button>
                                                                        <form
                                                                            action="{{ route('appointments.destroy', $appointment->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit" style="color:red;"
                                                                                class="btn btn-danger"
                                                                                onclick="return confirm('Bạn có chắc chắn muốn xóa lịch hẹn này không?')">Xóa</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </tr>
                                                @endforeach


                                            </tbody>
                                        </table>
                                        {{ $appointments->links() }}
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

