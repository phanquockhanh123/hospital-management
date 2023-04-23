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
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <form action="{{ route('meetings.index') }}" method="GET">
                                <div class="input-group mb-2">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Tìm kiếm cuộc họp"
                                            name="search">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="submit">Tìm kiếm</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-3" style="float: right;">
                            <a href="{{ route('meeting.create') }}" class="btn btn-success">
                                <i class="fas fa-plus"></i> Tạo mới
                            </a>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->

            @if (Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
            @endif
            <div class="card">
                <div class="card-header">
                    Tất cả các cuộc họp
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @if ($meetings->count() > 0)

                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID cuộc họp</th>
                                    <th>Tên cuộc họp</th>
                                    <th>Mật khẩu</th>
                                    <th>Người tạo</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($meetings as $meeting)
                                <tr>
                                    <td>{{ $meeting->meeting_id }}</td>
                                    <td>{{ $meeting->meeting_name}}</td>
                                    <td>{{ $meeting->meeting_password}}</td>
                                    <td>{{ $meeting->user->name }}</td>
                                    <td>
                                        <a href="{{ route('meeting.start', $meeting->meeting_id)}}"
                                            style="margin-right:20px;"><i style="font-size: 22px; color:blue;"
                                                class="fas fa-solid fa-handshake"></i></a>

                                        <button type="button" data-toggle="modal"
                                            data-target="#deleteModal{{ $meeting->meeting_id }}"
                                            style="color: red;font-size:22px">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>

                                    <!-- Modal -->
                                    <div class="modal fade" id="deleteModal{{ $meeting->meeting_id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="deleteModalLabel{{ $meeting->meeting_id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="deleteModalLabel{{ $meeting->meeting_id }}">
                                                        Xóa cuộc họp</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Bạn có chắc chắn muốn xóa cuộc họp
                                                    "{{ $meeting->meeting_name }}" không? Hành động này
                                                    không
                                                    thể hoàn tác!
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                                        style="color:black;">Hủy</button>
                                                    <form action="{{ route('meeting.destroy', $meeting->meeting_id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" style="color:red;" class="btn btn-danger"
                                                            onclick="return confirm('Bạn có chắc chắn muốn xóa cuộc họp này không?')">Xóa</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                        @else
                        <h3 style="color:red;text-align:center">Không tồn tại cuộc họp!</h3>
                        @endif
                    </ul>
                </div>
            </div>
            <!-- /.content -->
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