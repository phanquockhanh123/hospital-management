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
                            <form action="{{ route('news.index') }}" method="GET">
                                <div class="input-group mb-2">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Tìm kiếm tin"
                                            name="search">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="submit">Tìm kiếm</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-3" style="float: right;">
                            <a href="{{ route('news.create') }}" class="btn btn-success">
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
                                    @if ($news->count() == 0)
                                        <div class="alert alert-danger" role="alert">
                                            Không tìm thấy bài viết nào.
                                        </div>
                                    @else
                                        <table id="example2" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Tiêu đề</th>
                                                    <th>Từ khóa</th>
                                                    <th style="min-width:100px;">Ngày đăng</th>
                                                    <th>Nguồn</th>
                                                    <th>Tác giả</th>
                                                    <th>Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($news as $new)
                                                    <tr>
                                                        <td><a
                                                                href="{{ route('news.show', $new->id) }}">{{ $new->title }}</a>
                                                        </td>
                                                        <td>{{ $new->key_words }}</td>
                                                        <td>{{ $new->created_at?->format(config('const.format.date')) }}</td>
                                                        <td>{{ $new->source_news }}</td>
                                                        <td>{{ $new->author }}</td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <a href="{{ route('news.show', $new) }}" style="margin-right: 10px;color:blue;font-size:22px">
                                                                  <i class="fas fa-eye"></i>
                                                                </a>
                                                                <a href="{{ route('news.edit', $new->id) }}" style="margin-right: 10px;color:green;font-size:22px">
                                                                  <i class="fas fa-edit"></i>
                                                                </a>
                                                                <button type="button" data-toggle="modal"
                                                                  data-target="#deleteModal{{ $new->id }}" style="color: red;font-size:22px">
                                                                  <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                              </div>
                                                        </td>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="deleteModal{{ $new->id }}"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="deleteModalLabel{{ $new->id }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="deleteModalLabel{{ $new->id }}">
                                                                            Xóa bài viết</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Bạn có chắc chắn muốn xóa bài viết
                                                                        "{{ $new->title }}" không? Hành động này
                                                                        không
                                                                        thể hoàn tác!
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal" style="color:black;">Hủy</button>
                                                                        <form
                                                                            action="{{ route('news.destroy', $new->id) }}"
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
                                        {{ $news->links() }}
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

