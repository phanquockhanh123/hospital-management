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

        <div class="container">
            <div class="card">
                <div class="row">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-9">
                        <div class="card-header">
                            <h3 class="card-title">Tạo mới cuộc họp</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('meeting.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="meeting_name">Tiêu đề cuộc họp:</label>
                                    <input type="text" name="meeting_name" id="meeting_name"
                                        class="form-control @error('meeting_name') is-invalid @enderror"
                                        value="{{ old('meeting_name') }}">
                                    @error('meeting_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="meeting_password">Mật khẩu:</label>
                                    <input type="password" name="meeting_password" id="meeting_password"
                                        class="form-control @error('meeting_password') is-invalid @enderror"
                                        value="{{ old('meeting_password') }}">
                                    @error('meeting_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                    <button type="submit" class="btn btn-primary" style="color: blue">
                                        <i class="fas fa-save"></i> Tạo mới
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.script')
</body>

</html>
