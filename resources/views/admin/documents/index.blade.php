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
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <form action="{{ route('documents.index') }}" method="GET">
                                <div class="input-group mb-2">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Tìm kiếm file của bệnh nhân"
                                            name="search">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="submit">Tìm kiếm</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-3" style="float: right;">
                            <a href="{{ route('documents.create') }}" class="btn btn-success">
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
                                    @if ($documents->count() == 0)
                                        <div class="alert alert-danger" role="alert">
                                            Không tìm thấy file nào.
                                        </div>
                                    @else
                                        <table id="example2" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Tiêu đề</th>
                                                    <th>Bệnh nhân</th>
                                                    <th>Bác sĩ</th>
                                                    <th>CREATED_AT</th>
                                                    <th>File</th>
                                                    <th>Lưu ý</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($documents as $document)
                                                    <tr>
                                                        <td>{{ $document->title }}</td>
                                                        <td>{{ $document->patient->name }}</td>
                                                        <td>{{ $document->doctor->name }}</td>
                                                        <td>{{ $document->created_at->format(config('const.format.date')) }}</td>
                                                        <td>
                                                            @if($document->document_type ==  0)
                                                            <span>X-Quang</span>
                                                            @endif
                                                            @if($document->document_type ==  1)
                                                            <span>CLS</span>
                                                            @endif
                                                            @if($document->document_type ==  2)
                                                            <span>Hồ sơ tổng quát</span>
                                                            @endif
                                                            @if($document->document_type ==  3)
                                                            <span>MRI</span>
                                                            @endif
                                                            @if($document->document_type ==  4)
                                                            <span>Siêu âm</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $document->note }}</td>
                                                        
                                                        <td>
                                                            <div class="btn-group">
                                                                <a href="#"
                                                                    class="btn btn-warning">
                                                                    <i class="fa-solid fa-download"></i> Tải xuống
                                                                </a>
                                                                <a href="{{ route('documents.edit', $document->id) }}"
                                                                    class="btn btn-primary">
                                                                    <i class="fas fa-edit"></i> Sửa
                                                                </a>
                                                                <button type="button" class="btn btn-danger"
                                                                    data-toggle="modal"
                                                                    data-target="#deleteModal{{ $document->id }}"
                                                                    style="color: red;">
                                                                    <i class="fas fa-trash-alt"></i> Xóa
                                                                </button>
                                                            </div>
                                                        </td>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="deleteModal{{ $document->id }}"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="deleteModalLabel{{ $document->id }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="deleteModalLabel{{ $document->id }}">
                                                                            Xóa tài liệu bệnh nhân</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Bạn có chắc chắn muốn xóa tài liệu bệnh nhân
                                                                        "{{ $document->patient->name }}" không? Hành động này
                                                                        không
                                                                        thể hoàn tác!
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal" style="color:black;">Hủy</button>
                                                                        <form
                                                                            action="{{ route('documents.destroy', $document->id) }}"
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
                                        {{ $documents->links() }}
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

