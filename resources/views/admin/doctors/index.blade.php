<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hospital Management</title>
    @include('admin.css')
    <script>
        var msg = '{{Session::get('alert')}}';
        var exist = '{{Session::has('alert')}}';
        if(exist){
          alert(msg);
        }
      </script>
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
                            <form action="{{ route('doctors.index') }}" method="GET">
                                <div class="input-group mb-2">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Tìm kiếm bác sĩ"
                                            name="search">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="submit">Tìm kiếm</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-3" style="float: right;">
                            <a href="{{ route('doctors.create') }}" class="btn btn-success">
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
                                    @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                    @endif
                                </h2>

                                <!-- /.card-header -->
                                <div class="card-body">
                                    @if ($doctors->count() == 0)
                                    <div class="alert alert-danger" role="alert">
                                        Không tìm thấy bác sĩ!.
                                    </div>
                                    @else
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Bác sĩ</th>
                                                <th>Phòng ban</th>
                                                <th>Chuyên ngành</th>
                                                <th>Ngày vào làm</th>
                                                <th>Trạng thái</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($doctors as $doctor)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('doctors.show', $doctor) }}" ><img
                                                            src="./imgDoctor/{{ $doctor->filename}}" style="border-radius: 50%;vertical-align: middle;
                                                                    width: 50px;
                                                                    height: 50px;
                                                                    border-radius: 50%;" alt="" title="">{{ $doctor->name }}</a>
                                                </td>
                                                <td>{{ $doctor->doctorDepartment->name }}</td>
                                                <td>{{ $doctor->specialist }}</td>
                                                <td>{{ $doctor->start_work_date->format(config('const.format.date')) }}
                                                </td>
                                                <td>
                                                    @if ($doctor->status == 1)
                                                    <span class="text-primary">Đang làm việc</span>
                                                    @elseif ($doctor->status == 0)
                                                    <span class="text-danger">Đã nghĩ việc</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{ route('doctors.show', $doctor) }}" style="margin-right: 10px;color:blue;font-size:22px">
                                                          <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('doctors.edit', $doctor->id) }}" style="margin-right: 10px;color:green;font-size:22px">
                                                          <i class="fas fa-edit"></i>
                                                        </a>
                                                        <button type="button" data-toggle="modal"
                                                          data-target="#deleteModal{{ $doctor->id }}" style="color: red;font-size:22px">
                                                          <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                        @if (Auth::user()->role == 3  && $doctor->user_id == null)
                                                        <a  href="{{ route('doctors.add-account-doctor', $doctor->id) }}" style="margin-left : 10px;color:aqua;font-size:22px">
                                                            <i class="fas fa-add"></i>
                                                        </a>
                                                        @endif
                                                      </div>
                                                </td>

                                                <!-- Modal -->
                                                <div class="modal fade" id="deleteModal{{ $doctor->id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="deleteModalLabel{{ $doctor->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="deleteModalLabel{{ $doctor->id }}">
                                                                    Xóa bác sĩ</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Bạn có chắc chắn muốn xóa bác sĩ
                                                                "{{ $doctor->name }}" không? Hành động này
                                                                không
                                                                thể hoàn tác!
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal"
                                                                    style="color: black;">Hủy</button>
                                                                <form
                                                                    action="{{ route('doctors.destroy', $doctor->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger"
                                                                        style="color: red;"
                                                                        onclick="return confirm('Bạn có chắc chắn muốn xóa bác sĩ này không?')">Xóa</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $doctors->links() }}
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