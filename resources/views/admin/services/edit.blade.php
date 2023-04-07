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
                            <h3 class="card-title">Chỉnh sửa dịch vụ khám bệnh</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('services.update', $service->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="service_name">Tên dịch vụ khám bệnh:</label>
                                    <input type="text" name="service_name" id="service_name"
                                        class="form-control @error('service_name') is-invalid @enderror"
                                        value="{{ old('service_name', $service->service_name) }}">
                                    @error('service_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="all_price">Tổng giá:</label>
                                    <input type="text" name="all_price" id="all_price"
                                        class="form-control @error('all_price') is-invalid @enderror"
                                        value="{{ old('all_price', $service->all_price) }}">
                                    @error('all_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="discount">Giảm giá(%):</label>
                                    <input type="text" name="discount" id="discount"
                                        class="form-control @error('discount') is-invalid @enderror"
                                        value="{{ old('discount', $service->discount) }}">
                                    @error('discount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description">Mô tả:</label>
                                    <textarea class="form-control" id="description" name="description"
                                        rows="5">{{ $service->description }}</textarea>
                                    @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <a href="{{ route('services.index') }}" class="btn btn-secondary">
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