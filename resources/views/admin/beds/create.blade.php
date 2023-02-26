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
                            <h3 class="card-title">Tạo mới giường bệnh</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('beds.store') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="name">Tên giường bệnh:</label>
                                    <input type="text" name="name" id="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}">
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="bed_type">Loại giường bệnh:</label>
                                    <input type="text" name="bed_type" id="bed_type"
                                        class="form-control @error('bed_type') is-invalid @enderror"
                                        value="{{ old('bed_type') }}">
                                    @error('bed_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="department_id">Loại phòng ban:</label>
                                    <select name="department_id" class="form-control input-sm m-bot15">
                                        @foreach ($doctorDepartment as $key => $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}
                                        </option>
                                        @endforeach

                                    </select>
                                    @error('department_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="charge">Giá:</label>
                                    <input type="text" name="charge" id="charge"
                                        class="form-control @error('charge') is-invalid @enderror"
                                        value="{{ old('charge') }}">
                                    @error('charge')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="notes">Mô tả:</label>
                                    <textarea class="form-control" id="notes" name="notes" rows="5"></textarea>
                                    @error('notes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <a href="{{ route('beds.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Quay lại
                                    </a>

                                    <button type="submit" class="btn btn-primary">
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