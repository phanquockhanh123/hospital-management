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
                            <h3 class="card-title">BỆNH NHÂN : <span class="text-primary">  {{ $patient->name }}</span></h3>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Mã bệnh nhân:</th>
                                        <td>{{ $patient->patient_code }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tên bệnh nhân:</th>
                                        <td>{{ $patient->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Avatar:</th>
                                        <td><img src="@if(empty($patinet->filename))  https://th.bing.com/th/id/OIP.1t1Aoq3mF7U2Cr3rWO1x6AAAAA?pid=ImgDet&rs=1  @else {{ asset('./imgPatient/'. $patinet->filename) }} @endif" 
                                                    style="vertical-align: middle;
                                                        width: 200px;
                                                        height: 300px;">

                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Giới tính:</th>
                                        <td>
                                            @if($patient->gender == 0)
                                            <span>Nam</span>
                                            @endif
                                            @if($patient->gender == 1)
                                            <span>Nữ</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Nhóm máu:</th>
                                        <td>
                                            @if($patient->blood_group == 0)
                                            <span>Group O</span>
                                            @endif
                                            @if($patient->blood_group == 1)
                                            <span>Group A</span>
                                            @endif
                                            @if($patient->blood_group == 2)
                                            <span>Group B</span>
                                            @endif
                                            @if($patient->blood_group == 3)
                                            <span>Group AB</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Điện thoại:</th>
                                        <td>{{ $patient->phone }}</td>
                                    </tr>
                                    <tr>
                                        <th>Địa chỉ:</th>
                                        <td>{{ $patient->address }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email:</th>
                                        <td>{{ $patient->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Số CMT/CCCD:</th>
                                        <td>{{ $patient->identity_number }}</td>
                                    </tr>
                                    <tr>
                                        <th>Ngày cấp:</th>
                                        <td>{{ $patient->identity_card_date?->format(config('const.format.date')) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nơi cấp:</th>
                                        <td>{{ $patient->identity_card_place }}</td>
                                    </tr>
                                    @if(!empty($diagnosisesList))
                                    <tr>
                                        <th>Lịch sử khám bệnh</th>
                                        <td>
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>Bác sĩ khám bệnh</th>
                                                        <th>Chẩn đoán bệnh chính</th>
                                                        <th>Chẩn đoán bệnh phụ</th>
                                                        <th>Ngày khám</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($diagnosisesList as $val)
                                                    <tr>
                                                        <td>{{
                                                            $doctors->where('id', $val['doctor_id'])->first()->name
                                                        }}</td>
                                                        <td>{{ $val['main_diagnosis'] }}</td>
                                                        <td>{{ $val['side_diagnosis'] }}</td>
                                                        <td>{{ date('d/m/Y', strtotime($val['created_at'])) }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    @endif
                                    @if(!empty($diaPre))
                                    <tr>
                                        <th>Lịch sử bệnh án:</th>
                                        <td>
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>Tên xét nghiệm</th>
                                                        <th>Kết quả</th>
                                                        <th>Trị số tham chiếu</th>
                                                        <th>Đơn vị</th>
                                                        <th>QT/PPXN</th>
                                                        <th>Lưu ý</th>
                                                        <th>Ngày xét nghiệm</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($diaPre as $val)
                                                    <tr>
                                                        <td>{{
                                                            $services->where('id', $val['service_id'])->first()->service_name
                                                        }}</td>
                                                        <td>{{ $val['result'] }}</td>
                                                        <td>{{ $val['references_range'] }}</td>
                                                        <td>{{ $val['unit'] }}</td>
                                                        <td>{{ $val['method'] }}</td>
                                                        <td>{{ $val['diagnosis_note'] }}</td>
                                                        <td>{{ date('d/m/Y', strtotime($val['created_at'])) }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('patients.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Quay lại
                                </a>

                                <div>
                                    <a href="{{ route('patients.edit', $patient->id) }}"
                                        class="btn btn-primary">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <form action="{{ route('patients.destroy', $patient->id) }}" method="POST"
                                        class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" style="color: red"
                                            onclick="return confirm('Bạn có chắc chắn muốn xoá bệnh nhân này?')">
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