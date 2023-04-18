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
                            <h3 class="card-title">Hóa đơn</h3>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Bệnh nhân:</th>
                                        <td>{{ $bill->diagnosis->patient->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Bác sĩ:</th>
                                        <td>{{ $bill->diagnosis->doctor->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Bệnh chính:</th>
                                        <td>{{ $bill->diagnosis->main_diagnosis }}</td>
                                    </tr>
                                    <tr>
                                        <th>Bệnh phụ:</th>
                                        <td>{{ $bill->diagnosis->side_diagnosis }}</td>
                                    </tr>
                                    <tr>
                                        <th>Xét nghiệm:</th>
                                        <td>
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>Mã xét nghiệm</th>
                                                        <th>Tên xét nghiệm</th>
                                                        <th>Kết quả</th>
                                                        <th>Trị số tham chiếu</th>
                                                        <th>Đơn vị</th>
                                                        <th>QT/PPXN</th>
                                                        <th>Lưu ý</th>
                                                        <th>Giá tiền</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($diaPre as $val)
                                                    <tr>
                                                        <td>{{ $services->where('id', $val['service_id'])->first()->service_code }}</td>
                                                        <td>{{ $services->where('id', $val['service_id'])->first()->service_name }}</td>
                                                        <td>{{ $val['result'] }}</td>
                                                        <td>{{ $val['references_range'] }}</td>
                                                        <td>{{ $val['unit'] }}</td>
                                                        <td>{{ $val['method'] }}</td>
                                                        <td>{{ $val['diagnosis_note'] }}</td>
                                                        <td>{{ $services->where('id', $val['service_id'])->first()->all_price }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Lưu ý:</th>
                                        <td>{{ $bill->diagnosis->note }}</td>
                                    </tr>
                                    @if (!empty($preItem))
                                    <tr>
                                        <th>Thuốc:</th>
                                        <td>
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>Tên thuốc</th>
                                                        <th>Hàm lượng</th>
                                                        <th>Lưu ý</th>
                                                        <th>DVT</th>
                                                        <th>Số lượng</th>
                                                        <th>Đơn giá</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($preItem as $val)
                                                    <tr>
                                                        <td>{{ $medicals->where('id', $val['medical_id'])->first()->medical_name }}</td>
                                                        <td>{{ $val['dosage'] }}</td>
                                                        <td>{{ $val['dosage_note'] }}</td>
                                                        <td>{{ $val['unit'] }}</td>
                                                        <td>{{ $val['amount'] }}</td>
                                                        <td>{{ $medicals->where('id', $val['medical_id'])->first()->export_price }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </td>
                                        
                                    </tr>
                                    @endif

                                    <tr>
                                        <th>Tổng thanh toán</th>
                                        <td>{{$bill->total_money}}</td>
                                    </tr>

                                    <tr>
                                        <th>Đã thanh toán</th>
                                        <td>@if(empty($bill->paid_money)) 0 @endif</td>
                                    </tr>
                                    <tr>
                                        <th>Còn lại</th>
                                        <td>{{$bill->total_money - $bill->paid_money}}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('bills.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Quay lại
                                </a>

                                <div>
                                    <a href="{{ route('diagnosises.edit', $bill->diagnosis->id) }}" class="btn btn-warning">
                                        <i class="fas fa-edit"></i> Sửa chẩn đoán/xét nghiệm
                                    </a>
                                    @if ($bill->prescription)
                                        <a href="{{ route('prescriptions.edit', $bill->prescription->id) }}" class="btn btn-warning">
                                            <i class="fas fa-edit"></i> Sửa đơn thuốc
                                        </a>
                                    @endif
                                    
                                    <form action="{{ route('bills.destroy', $bill->id) }}" method="POST"
                                        class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" style="color: red;"
                                            onclick="return confirm('Bạn có chắc chắn muốn xoá hóa đơn này?')">
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
