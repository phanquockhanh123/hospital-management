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

        <div class="container">
            <div class="row">
                <div class="col-md-3">
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ $new->name }}</h3>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Tiêu đề:</th>
                                        <td>{{ $new->title }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tác giả:</th>
                                        <td>{{ $new->author }}</td>
                                    </tr>
                                    <tr>
                                        <th>Avatar:</th>
                                        <td><img src="@if(empty($new->filename))  https://th.bing.com/th/id/OIP.iU0kNkfIbXt09phj1GGuXAHaGH?pid=ImgDet&rs=1  @else {{ asset('./imgNews/'. $new->filename) }} @endif" 
                                                    style="vertical-align: middle;
                                                        width: 200px;
                                                        height: 300px;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Nội dung:</th>
                                        <td>{{ $new->content }}</td>
                                    </tr>
                                    <tr>
                                        <th>Mức độ ưu tiên:</th>
                                        <td>{{ $new->priority_level }}</td>
                                    </tr>
                                    <tr>
                                        <th>Ngày tạo:</th>
                                        <td>{{ $new->submitted_date }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nguồn tin:</th>
                                        <td>{{ $new->source_news }}</td>
                                    </tr>
                                    <tr>
                                        <th>Từ khóa:</th>
                                        <td>{{ $new->source_news }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('news.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Quay lại
                                </a>

                                <div>
                                    <a href="{{ route('news.edit', $new->id) }}" class="btn btn-primary">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <form action="{{ route('news.destroy', $new->id) }}" method="POST"
                                        class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" style="color: red"
                                            onclick="return confirm('Bạn có chắc chắn muốn xoá bài viết này?')">
                                            <i class="fas fa-trash"></i> Xoá
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
