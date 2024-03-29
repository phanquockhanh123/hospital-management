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
                            <form action="{{ route('request_devices.index') }}" method="GET">
                                @csrf
                               
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="patient_id">Bệnh nhân:</label>
                                            <select name="patient_id" class="form-control input-sm m-bot15">
                                                <option value="">----Chọn bệnh nhân----</option>
                                                @foreach ($patients as $patient)
                                                <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('patient_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="status">Trạng thái:</label>
                                            <select name="status" class="form-control input-sm m-bot15">
                                                <option value="">----Chọn trạng thái----</option>
                                                <option value="0">Đang mượn</option>
                                                <option value="1">Đã trả</option>
                                            </select>
                                            @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-3" style="margin-top: 32px;">
                                            <button class="btn btn-outline-secondary" type="submit">Tìm
                                                kiếm</button>
                                    </div>
                                </div>

                            </form>

                        </div>
                        @if(Auth::user()->role == 2)
                        <div class="col-sm-3" style="float: right;">
                            <a href="{{ route('request_devices.create') }}" class="btn btn-success">
                                <i class="fas fa-plus"></i> Tạo mới
                            </a>
                        </div>
                        @endif
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
                                    @if ($request_devices->count() == 0)
                                        <div class="alert alert-danger" role="alert">
                                            Không tìm thấy đơn yêu cầu thiết bị nào.
                                        </div>
                                    @else
                                        <table id="example2" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>STT</th>
                                                    <th>Bác sĩ</th>
                                                    <th>Bệnh nhân</th>
                                                    <th>Thời gian mượn</th>
                                                    <th>Thời gian trả</th>
                                                    <th>Trạng thái</th>
                                                    @if(Auth::user()->role == 2)
                                                    <th>Hành động</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($request_devices as $request_device)
                                                    <tr>
                                                        <td>{{ $count++; }}</td>
                                                        <td>{{ $request_device->doctor->name }}</td>
                                                        <td>{{ $request_device->patient->name }}</td>
                                                        <td>{{ $request_device->borrow_time->format(config('const.format.datetime')) }}</td>
                                                        <td>{{ $request_device->return_time->format(config('const.format.datetime')) }}</td>
                                                        <td>
                                                            @if($request_device->status == 0)
                                                            <span class="text-warning">Đang mượn</span>
                                                            @endif
                                                            @if($request_device->status == 1)
                                                            <span class="text-primary">Đã trả</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <a href="{{ route('request_devices.show', $request_device) }}" style="margin-right: 10px;color:blue;font-size:22px">
                                                                  <i class="fas fa-eye"></i>
                                                                </a>
                                                                <a href="{{ route('request_devices.edit', $request_device->id) }}" style="margin-right: 10px;color:green;font-size:22px">
                                                                  <i class="fas fa-edit"></i>
                                                                </a>
                                                                <button type="button" data-toggle="modal"
                                                                  data-target="#deleteModal{{ $request_device->id }}" style="color: red;font-size:22px">
                                                                  <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                              </div>
                                                        </td>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="deleteModal{{ $request_device->id }}"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="deleteModalLabel{{ $request_device->id }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="deleteModalLabel{{ $request_device->id }}">
                                                                            Xóa yêu cầu thiết bị</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Bạn có chắc chắn muốn xóa yêu cầu thiết bị cho bệnh nhân
                                                                        "{{ $request_device->patient->name }}" không? Hành động này
                                                                        không
                                                                        thể hoàn tác!
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal" style="color:black;">Hủy</button>
                                                                        <form
                                                                            action="{{ route('request_devices.destroy', $request_device->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit" style="color:red;"
                                                                                class="btn btn-danger"
                                                                                onclick="return confirm('Bạn có chắc chắn muốn xóa yêu cầu thiết bị y tế này không?')">Xóa</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                        {{ $request_devices->links() }}
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

