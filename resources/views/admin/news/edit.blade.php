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
            <div class="card">
                <div class="row">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-9">
                        <div class="card-header">
                            <h3 class="card-title">Chỉnh sửa bài viết</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('news.update', $new->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="title">Tiêu đề bài viết:</label>
                                    <input type="text" name="title" id="title"
                                        class="form-control @error('title') is-invalid @enderror"
                                        value="{{ old('title', $new->title) }}">
                                    @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="key_words">Từ khóa:</label>
                                    <input type="text" name="key_words" id="key_words"
                                        class="form-control @error('key_words') is-invalid @enderror"
                                        value="{{ old('key_words', $new->key_words) }}">
                                    @error('key_words')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="image">Ảnh đại diện:</label>
                                    <img src="{{ asset('./imgNews/'. $new->filename) }}" style="vertical-align: middle;
                                                        width: 200px;
                                                        height: 300px;
                                                        margin-bottom:20px;">
                                    <input type="file" name="image" id="image"
                                        class="form-control @error('image') is-invalid @enderror"
                                        value="{{ old('image', $new->image) }}">
                                    @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="content">Nội dung:</label>
                                    <textarea class="form-control" id="content" name="content"
                                        rows="5">{{ $new->content }}</textarea>
                                    @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="source_news">Nguồn:</label>
                                    <input type="text" name="source_news" id="source_news"
                                        class="form-control @error('source_news') is-invalid @enderror"
                                        value="{{ old('source_news', $new->source_news) }}">
                                    @error('source_news')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="author">Tác giả:</label>
                                    <input type="text" name="author" id="author"
                                        class="form-control @error('author') is-invalid @enderror"
                                        value="{{ old('author', $new->author) }}">
                                    @error('author')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="priority_level">Mức độ ưu tiên:</label>
                                    <select name="priority_level" class="form-control input-sm m-bot15">
                                        <option value="0" {{ $new->priority_level == 0 ? 'selected' : '' }}>Tin cũ</option>
                                        <option value="1" {{ $new->priority_level == 1 ? 'selected' : '' }}>Tin thường</option>
                                        <option value="2" {{ $new->priority_level == 2 ? 'selected' : '' }}>Tin hot</option>
                                    </select>
                                    @error('priority_level')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
        

                                <div class="d-flex justify-content-between mt-4">
                                    <a href="{{ route('news.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Quay lại
                                    </a>

                                    <button type="submit" class="btn btn-primary" style="color:blue;">
                                        <i class="fas fa-save"></i> Chỉnh sửa
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
        <script>
            CKEDITOR.replace('content', {
                filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
                filebrowserUploadMethod: 'form'
            });

            $(document).ready(function() { 
                $('body').on('submit', '#submitform', function(e) {
                    e.preventDefault();

                    $.ajax({
                        url: $(this).attr('action'),
                        data: new FormData(this),
                        type: 'POST',
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data) {
                            alert('data.msg');
                        }
                    })
                });
            });

        </script>
</body>

</html>