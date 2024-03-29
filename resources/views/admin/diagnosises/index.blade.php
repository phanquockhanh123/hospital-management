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
                            <form action="{{ route('diagnosises.index') }}" method="GET">
                                @csrf
                               
                                <div class="row">
                                    <div class="col-4">
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
                                            <label for="created_at">Ngày tạo:</label><br>
                                            <input type="date" name="created_at" class="form-control input-sm m-bot15">
                                            @error('created_at')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="status">Trạng thái:</label>
                                            <select name="status" class="form-control input-sm m-bot15">
                                                <option value="">----Chọn trạng thái----</option>
                                                <option value="0">Chưa tạo đơn thuốc</option>
                                                <option value="1">Đã tạo đơn thuốc</option>
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
                            <a href="{{ route('diagnosises.create') }}" class="btn btn-success">
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
                                    @if ($diagnosises->count() == 0)
                                        <div class="alert alert-danger" role="alert">
                                            Không tìm thấy xét nghiệm/chẩn đoán nào.
                                        </div>
                                    @else
                                        <table id="example2" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>STT</th>
                                                    <th>Bệnh nhân</th>
                                                    <th>Bác sĩ</th>
                                                    <th>Chẩn đoán bệnh chính</th>
                                                    <th>Chẩn đoán bệnh phụ</th>
                                                    <th>Ngày tạo</th>
                                                    <th>Trạng thái</th>
                                                    <th>PDF</th>
                                                    <th>Tạo đơn thuốc</th>
                                                    <th>Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($diagnosises as $diagnosis)
                                                    <tr>
                                                        <td><a
                                                                href="{{ route('diagnosises.show', $diagnosis->id) }}"><ins>{{ $count++ }}</ins></a>
                                                        </td>
                                                        <td>{{ $diagnosis->patient->name }}</td>
                                                        <td>{{ $diagnosis->doctor->name }}</td>
                                                        <td>{{ $diagnosis->main_diagnosis }}</td>
                                                        <td>{{ $diagnosis->side_diagnosis }}</td>
                                                        <td>{{ $diagnosis->created_at->format('d-m-Y') }}</td>
                                                        <td>
                                                            @if($diagnosis->status == 1) 
                                                                <span style="color:green;">Đã tạo đơn thuốc</span>
                                                            @else
                                                                <span style="color:red;">Chưa tạo đơn thuốc</span>
                                                            @endif
                                                        </td>
                                                        <td><a href="{{ route('diagnosises.pdf', $diagnosis->id) }}" style="font-size: 22px;color:black"><i class="fas fa-print"></i></a></td>

                                                        <td>
                                                            <a  href="{{ route('diagnosises.create-prescription', $diagnosis->id) }}"
                                                                class="btn btn-warning @if ($diagnosis->status == 1) disabled @endif">
                                                                <i class="fas fa-edit"></i> Đơn thuốc
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <a href="{{ route('diagnosises.show', $diagnosis) }}" style="margin-right: 10px;color:blue;font-size:22px">
                                                                  <i class="fas fa-eye"></i>
                                                                </a>
                                                                <a href="{{ route('diagnosises.edit', $diagnosis->id) }}" style="margin-right: 10px;color:green;font-size:22px">
                                                                  <i class="fas fa-edit" ></i>
                                                                </a>
                                                                <button type="button" data-toggle="modal"
                                                                  data-target="#deleteModal{{ $diagnosis->id }}" style="color: red;font-size:22px">
                                                                  <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                              </div>
                                                        </td>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="deleteModal{{ $diagnosis->id }}"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="deleteModalLabel{{ $diagnosis->id }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="deleteModalLabel{{ $diagnosis->id }}">
                                                                            Xóa loại giường</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Bạn có chắc chắn muốn xóa xét nghiệm/chẩn đoán với bệnh nhân
                                                                        "{{ $diagnosis->patient->name }}" không? Hành động này
                                                                        không
                                                                        thể hoàn tác!
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal" style="color:black;">Hủy</button>
                                                                        <form
                                                                            action="{{ route('diagnosises.destroy', $diagnosis->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit" style="color:red;"
                                                                                class="btn btn-danger"
                                                                                onclick="return confirm('Bạn có chắc chắn muốn xóa xét nghiệm/chẩn đoán này không?')">Xóa</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </tr>
                                                @endforeach


                                            </tbody>
                                        </table>
                                        {{ $diagnosises->links() }}
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

