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
                            <h3 class="card-title">Chỉnh sửa thuốc</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('medicals.update', $medical->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="medical_name">Tên thuốc:</label>
                                    <input type="text" name="medical_name" id="medical_name"
                                        class="form-control @error('medical_name') is-invalid @enderror"
                                        value="{{ old('medical_name', $medical->medical_name) }}">
                                    @error('medical_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="department_id">Phòng ban:</label>
                                    <select name="department_id" class="form-control input-sm m-bot15">
                                        @foreach ($doctorDepartments as $doctorDepartment)
                                        <option value="{{ $doctorDepartment->id }}" {{ $medical->department_id ==
                                            $doctorDepartment->id ? 'selected' : '' }}>
                                            {{ $doctorDepartment->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('department_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="unit">Đơn vị:</label>
                                    <input type="text" name="unit" id="unit"
                                        class="form-control @error('unit') is-invalid @enderror"
                                        value="{{ old('unit', $medical->unit) }}">
                                    @error('unit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="import_price">Giá nhập:</label>
                                    <input type="text" name="import_price" id="import_price"
                                        class="form-control @error('import_price') is-invalid @enderror"
                                        value="{{ old('import_price', $medical->import_price) }}">
                                    @error('import_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="export_price">Giá bán:</label>
                                    <input type="text" name="export_price" id="export_price"
                                        class="form-control @error('export_price') is-invalid @enderror"
                                        value="{{ old('export_price', $medical->export_price) }}">
                                    @error('export_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="quantity">Số lượng:</label>
                                    <input type="text" name="quantity" id="quantity"
                                        class="form-control @error('quantity') is-invalid @enderror"
                                        value="{{ old('quantity', $medical->quantity) }}">
                                    @error('quantity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="amount_day">Số lượng/ngày:</label>
                                    <input type="text" name="amount_day" id="amount_day"
                                        class="form-control @error('amount_day') is-invalid @enderror"
                                        value="{{ old('amount_day', $medical->amount_day) }}">
                                    @error('amount_day')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="use">Cách sử dụng</label>:</label>
                                    <input type="text" name="use" id="use"
                                        class="form-control @error('use') is-invalid @enderror"
                                        value="{{ old('use', $medical->use) }}">
                                    @error('use')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="description">Mô tả:</label>
                                    <textarea class="form-control" id="description" name="description"
                                        rows="5">{{ $medical->description }}</textarea>
                                    @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <a href="{{ route('medicals.index') }}" class="btn btn-secondary">
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
</body>

</html>