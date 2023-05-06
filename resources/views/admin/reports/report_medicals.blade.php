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
            
            <h1 style="font-size: 30px;color:black;font-weight:bold;text-align:center">Thống kê dịch vụ</h1>
            <!-- Content Header (Page header) -->
            <!-- /.card-header -->
            <div class="card-body">
                <div class="col-md-10 offset-md-1">
                    <form action="{{ route('reports.report-medicals') }}" method="GET">
                        @csrf

                        <div class="row">
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="start_date">Ngày bắt đầu:</label>
                                    <input type="date" name="start_date" class="form-control input-sm m-bot15" placeholder="Nhập họ tên">
                                    @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <label for="end_date">Ngày kết thúc:</label>
                                    <input type="date" name="end_date" class="form-control input-sm m-bot15" placeholder="Nhập họ tên">
                                    @error('end_date')
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
                @if ($medicals->count() == 0)
                <div class="alert alert-danger" role="alert">
                    Không tìm thấy thuốc nào.
                </div>
                @else
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã thuốc</th>
                            <th>Tên thuốc</th>
                            <th>Đơn vị</th>
                            <th>Giá bán</th>
                            <th>Số lượng bán</th>
                            <th>Doanh thu : <b>{{ number_format($countMoney, 0, '.', ',') }}</b> đồng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($medicals ?? [] as $medical)

                        <tr>
                            <td>{{ $medical->id }}</td>
                            <td>{{ $medical->medical_code }}</td>
                            <td>{{ $medical->medical_name }}</td>
                            <td>{{ $medical->unit }}</td>
                            <td>{{ number_format($medical->export_price, 0, '.', ',') }}</td>
                            <td>{{ $prescriptionItems->where('medical_id', $medical->id)->sum('amount') }} </td>
                            <td>{{ number_format($prescriptionItems->where('medical_id', $medical->id)->sum('amount') * $medical->export_price, 0, '.', ',') }}</td>
                        </tr>
                        @endforeach


                    </tbody>
                </table>
                @endif
            </div>
            <!-- /.card-body -->

            
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

