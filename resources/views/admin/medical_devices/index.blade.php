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
                        <div class="col-md-10 offset-md-1">
                            <form action="{{ route('medical_devices.index') }}" method="GET">
                                @csrf

                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="name">Tên thiết bị:</label>
                                            <input type="text" name="name" class="form-control input-sm m-bot15">
                                            @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="department_id">Phòng ban:</label>
                                            <select name="department_id" class="form-control input-sm m-bot15">
                                                <option value="">----Chọn phòng ban----</option>
                                                @foreach ($doctorDepartments as $doctorDepartment)
                                                <option value="{{ $doctorDepartment->id }}">{{ $doctorDepartment->name
                                                    }}</option>
                                                @endforeach
                                            </select>
                                            @error('department_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="status">Trạng thái:</label>
                                            <select name="status" class="form-control input-sm m-bot15">
                                                <option value="">----Chọn trạng thái----</option>
                                                <option value="1">Đang chờ kiểm duyệt</option>
                                                <option value="2">Đã được kiểm duyệt</option>
                                            </select>
                                            @error('doctor_department_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-2" style="margin-top: 32px;">
                                        <button class="btn btn-outline-secondary" type="submit">Tìm
                                            kiếm</button>
                                    </div>
                                </div>

                            </form>

                        </div>
                        <div class="col-sm-3" style="float: right;">
                            <a href="{{ route('medical_devices.create') }}" class="btn btn-success">
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
                                    @if ($medical_devices->count() == 0)
                                        <div class="alert alert-danger" role="alert">
                                            Không tìm thấy thiết bị y tế nào.
                                        </div>
                                    @else
                                        <table id="example2" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Mã thiết bị</th>
                                                    <th>Tên thiết bị</th>
                                                    <th>Phòng ban</th>
                                                    <th>Trạng thái</th>
                                                    <th>Số lượng còn</th>
                                                    <th>Hết hạn kiểm định</th>
                                                    <th>Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($medical_devices as $medical_device)
                                                    <tr>
                                                        <td><a
                                                                href="{{ route('medical_devices.show', $medical_device->id) }}">{{ $medical_device->medical_device_code }}</a>
                                                        </td>
                                                        <td>{{ $medical_device->name }}</td>
                                                        <td>{{ $doctorDepartments->where('id', $medical_device->department_id)->first()->name }}</td>
                                                        <td>
                                                            @if ($medical_device->status == 0)
                                                                <span class="text-danger">Chưa được kiểm duyệt</span>
                                                            @elseif ($medical_device->status == 1)
                                                                <span class="text-warning">Đang chờ kiểm duyệt</span>
                                                            @elseif ($medical_device->status == 2)
                                                                <span class="text-primary">Đã được kiểm duyệt</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $medical_device->quantity }}</td>
                                                        <td>{{ $medical_device->expired_date->format(config('const.format.date')) }}</td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <a href="{{ route('medical_devices.show', $medical_device) }}" style="margin-right: 10px;color:blue;font-size:22px">
                                                                  <i class="fas fa-eye"></i>
                                                                </a>
                                                                <a href="{{ route('medical_devices.edit', $medical_device->id) }}" style="margin-right: 10px;color:green;font-size:22px">
                                                                  <i class="fas fa-edit"></i>
                                                                </a>
                                                                <button type="button" data-toggle="modal"
                                                                  data-target="#deleteModal{{ $medical_device->id }}" style="color: red;font-size:22px">
                                                                  <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                              </div>
                                                            </div>
                                                        </td>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="deleteModal{{ $medical_device->id }}"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="deleteModalLabel{{ $medical_device->id }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="deleteModalLabel{{ $medical_device->id }}">
                                                                            Xóa loại giường</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Bạn có chắc chắn muốn xóa thiết bị y tế
                                                                        "{{ $medical_device->name }}" không? Hành động này
                                                                        không
                                                                        thể hoàn tác!
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal" style="color:black;">Hủy</button>
                                                                        <form
                                                                            action="{{ route('medical_devices.destroy', $medical_device->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit" style="color:red;"
                                                                                class="btn btn-danger"
                                                                                onclick="return confirm('Bạn có chắc chắn muốn xóa thiết bị y tế này không?')">Xóa</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                        {{ $medical_devices->links() }}
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

