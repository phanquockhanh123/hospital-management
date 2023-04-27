@include('user.header')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img src="@if (!empty($patient->filename)) ./imgPatient/{{ $patient->filename}} @else https://cdn.iconscout.com/icon/premium/png-256-thumb/patient-2460481-2128797.png @endif"
                                style="background-color: #00D9A5;border-radius: 50%;vertical-align: middle;
                                                                    width: 100px;
                                                                    height: 100px;
                                                                    border-radius: 50%;">
                        </div>

                        <h3 class="profile-username text-center">{{ $patient->name }}</h3>

                        <p class="text-muted text-center">{{ $patient->patient_code }}</p>

                        <!-- /.card -->

                        <!-- About Me Box -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin cá nhân</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <strong><i class="fas fa-book mr-1"></i> Nhóm máu</strong>

                                <p class="text-muted">
                                    @if($patient->blood_group == 0)
                                    <span class="text-primary">Group O</span>
                                    @elseif ($patient->blood_group == 1)
                                    <span class="text-primary">Group A</span>
                                    @elseif($patient->blood_group == 2)
                                    <span class="text-primary">Group B</span>
                                    @elseif($patient->blood_group == 3)
                                    <span class="text-primary">Group AB</span>
                                    @else
                                    <span class="text-primary">Đang cập nhật</span>
                                    @endif
                                </p>

                                <hr>

                                <strong><i class="fas fa-map-marker-alt mr-1"></i> Số điện thoại</strong>

                                <p class="text-muted">
                                    @if ( $patient->phone )
                                    <span class="text-primary">{{ $patient->phone }}</span>
                                    @else
                                    <span class="text-primary">Đang cập nhật</span>
                                    @endif
                                </p>

                                <hr>

                                <strong><i class="fas fa-pencil-alt mr-1"></i> Ngày sinh</strong>

                                <p class="text-muted">
                                    @if ( $patient->date_of_birth )
                                    <span class="text-primary">{{ $patient->date_of_birth }}</span>
                                    @else
                                    <span class="text-primary">Đang cập nhật</span>
                                    @endif
                                </p>

                                <hr>

                                <strong><i class="fas fa-pencil-alt mr-1"></i> Email</strong>

                                <p class="text-muted">{{ $patient->email }}</p>

                                <hr>

                                <strong><i class="fas fa-pencil-alt mr-1"></i> Giới tính</strong>

                                <p class="text-muted">
                                    @if($patient->gender == 1)
                                    <span>Nam</span>
                                    @else
                                    <span>Nữ</span>
                                    @endif
                                </p>

                                <hr>

                                <strong><i class="fas fa-pencil-alt mr-1"></i> Số CMT/CCCD</strong>

                                <p class="text-muted">
                                    @if ( $patient->identity_number )
                                    <span class="text-primary">{{ $patient->identity_number }}</span>
                                    @else
                                    <span class="text-primary">Đang cập nhật</span>
                                    @endif
                                </p>

                                <hr>

                                <strong><i class="fas fa-pencil-alt mr-1"></i> Ngày cấp</strong>

                                <p class="text-muted">
                                    @if ( $patient->identity_card_date )
                                    <span class="text-primary">{{ $patient->identity_card_date }}</span>
                                    @else
                                    <span class="text-primary">Đang cập nhật</span>
                                    @endif
                                </p>


                                <hr>

                                <strong><i class="fas fa-pencil-alt mr-1"></i> Nơi cấp</strong>

                                <p class="text-muted">
                                    @if ( $patient->identity_card_place )
                                    <span class="text-primary">{{ $patient->identity_card_place }}</span>
                                    @else
                                    <span class="text-primary">Đang cập nhật</span>
                                    @endif
                                </p>

                                <hr>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        {{-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
                    </div>
                    <!-- /.card-body -->
                </div>

            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link" href="#appointment" data-toggle="tab">Lịch hẹn</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Chẩn
                                    đoán/ Xét nghiệm</a></li>
                            <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Đơn thuốc</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Hóa đơn</a>
                            </li>

                            <li class="nav-item"><a class="nav-link @if (session('success')) active @endif"
                                    href="#profile" data-toggle="tab">Chỉnh sửa trang cá nhân</a>
                            </li>
                        </ul>
                    </div><!-- /.card-header -->

                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane" id="appointment">
                                @if($appointments->count() != 0)
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên bác sĩ</th>
                                            <th>Phòng ban</th>
                                            <th>Thời gian bắt đầu</th>
                                            <th>Thời gian kết thúc</th>
                                            <th>Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($appointments ?? [] as $appointment)
                                        <tr>
                                            <td>{{ $countAppointment++; }}</td>
                                            <td>{{ $appointment->doctor->name }}</td>
                                            <td>{{ $appointment->doctorDepartment->name }}</td>
                                            <td>{{ $appointment->start_time->format('d-m-Y H:m:i') }}</td>
                                            <td>{{ $appointment->end_time->format('d-m-Y H:m:i') }}</td>
                                            <td>
                                                @if($appointment->status == 0)
                                                <span class="text text-danger">Từ chối</span>
                                                @elseif ($appointment->status == 1)
                                                <span class="text text-warning">Đang chờ</span>
                                                @else
                                                <span class="text text-primary">Chấp nhận</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @else
                                Không có lịch hẹn nào !
                                @endif
                            </div>
                            <div class="tab-pane" id="activity">
                                @if($diagnosisesList->count() != 0 )
                                <table class="table">

                                    <tr>
                                        <th>Lịch sử khám bệnh</th>
                                        <td>
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>Lần</th>
                                                        <th>Bác sĩ khám bệnh</th>
                                                        <th>Chẩn đoán bệnh chính</th>
                                                        <th>Chẩn đoán bệnh phụ</th>
                                                        <th>Ngày khám</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($diagnosisesList as $val)
                                                    <tr>
                                                        <td>Lần {{ $countDiagnosis++; }}</td>
                                                        <td>{{
                                                            $doctors->where('id', $val['doctor_id'])->first()->name
                                                            }}</td>
                                                        <td>{{ $val['main_diagnosis'] }}</td>
                                                        <td>{{ $val['side_diagnosis'] }}</td>
                                                        <td>{{ date('d/m/Y H:i:s', strtotime($val['created_at'])) }}
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                @else
                                Không có chẩn đoán nào !
                                @endif
                                @if(!empty($diaPre))
                                <table class="table">

                                    <tr>
                                        <th>Lịch sử bệnh án:</th>
                                        <td>
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>Lần</th>
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
                                                        <td>Lần {{ $countDiagnosisItem++; }}</td>
                                                        <td>{{
                                                            $services->where('id',
                                                            $val['service_id'])->first()->service_name
                                                            }}</td>
                                                        <td>{{ $val['result'] }}</td>
                                                        <td>{{ $val['references_range'] }}</td>
                                                        <td>{{ $val['unit'] }}</td>
                                                        <td>{{ $val['method'] }}</td>
                                                        <td>{{ $val['diagnosis_note'] }}</td>
                                                        <td>{{ date('d/m/Y H:i:s', strtotime($val['created_at'])) }}
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>

                                </table>
                                @else
                                Không có xét nghiệm nào !
                                @endif
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="timeline">
                                <table class="table">
                                    @if(!empty($prescriptionItemList))
                                    <tr>
                                        <th>Lịch sử đơn thuốc:</th>
                                        <td>
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>Tên thuốc</th>
                                                        <th>Liều lượng</th>
                                                        <th>Cách dùng</th>
                                                        <th>Đơn vị</th>
                                                        <th>Số lượng</th>
                                                        <th>Đơn giá</th>
                                                        <th>Ngày xuất đơn</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($prescriptionItemList ?? [] as $preItem)
                                                    @foreach($preItem ?? [] as $val)
                                                    <tr>
                                                        <td>{{
                                                            $medicals->where('id',
                                                            $val['medical_id'])->first()->medical_name
                                                            }}</td>
                                                        <td>{{ $val['dosage'] }}</td>
                                                        <td>{{ $val['dosage_note'] }}</td>
                                                        <td>{{ $val['unit'] }}</td>
                                                        <td>{{ $val['amount'] }}</td>
                                                        <td>{{
                                                            $medicals->where('id',
                                                            $val['medical_id'])->first()->export_price
                                                            }} đồng</td>
                                                        <td>{{ date('d/m/Y H:i:s', strtotime($val['created_at'])) }}
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    @else
                                    Không có đơn thuốc nào !
                                    @endif
                                </table>


                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="settings">

                                @if(!empty($billList))
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Lần</th>
                                            <th>Ngày tạo hóa đơn</th>
                                            <th>Tổng hóa đơn</th>
                                            <th>Đã thanh toán</th>
                                            <th>Trạng thái</th>
                                            <th>Lưu ý</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($billList as $val)
                                        <tr>
                                            <td>Lần {{ $countBill++; }}</td>
                                            <td>{{ date('d/m/Y H:i:s', strtotime($val['created_at'])) }}</td>
                                            <td>{{ $val['total_money'] }}</td>
                                            <td>@if(empty($val['paid_money'])) 0 @else {{ $val['paid_money'] }} @endif
                                            </td>
                                            <td>
                                                @if($val['status'] == 0)
                                                <span class="text-warning">Chưa thanh toán</span>
                                                @endif
                                                @if($val['status'])
                                                <span class="text-primary">Đã thanh toán</span>
                                                @endif
                                            </td>
                                            <td>{{ $val['note'] }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @else
                                Không có hóa đơn nào !
                                @endif
                            </div>

                            <div class=" @if (session('success')) active @endif tab-pane" id="profile">
                                <h3>Chỉnh sửa trang cá nhân</h3>
                                <span>
                                    @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                    @endif
                                </span>
                                <div class="card-body">
                                    <form action="{{ route('home.update-patient', $patient->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="form-group">
                                            <label for="name">Tên bệnh nhân:</label>
                                            <input type="text" name="name" id="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                value="{{ old('name', $patient->name) }}">
                                            @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="profile">Ảnh đại diện:</label>
                                            <img src="{{ asset('./imgPatient/'. $patient->filename) }}" style="vertical-align: middle;
                                                                width: 200px;
                                                                height: 300px;
                                                                margin-bottom:20px;">
                                            <input type="file" name="profile" id="profile"
                                                class="form-control @error('profile') is-invalid @enderror"
                                                value="{{ old('profile', $patient->profile) }}">
                                            @error('profile')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="date_of_birth">Ngày sinh:</label>
                                            <input type="date" name="date_of_birth" id="date_of_birth"
                                                class="form-control @error('date_of_birth') is-invalid @enderror"
                                                value="{{ old('date_of_birth', $patient->date_of_birth?->format(config('const.format.date_form'))) }}">
                                            @error('date_of_birth')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="gender">Giới tính:</label>
                                            <select name="gender" class="form-control input-sm m-bot15">
                                                <option value="0" {{ $patient->gender == 0 ? 'selected' : '' }}>Nữ
                                                </option>
                                                <option value="1" {{ $patient->gender == 1 ? 'selected' : '' }}>Nam
                                                </option>
                                            </select>
                                            @error('gender')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="blood_group">Nhóm máu:</label>
                                            <select name="blood_group" class="form-control input-sm m-bot15">
                                                <option value="0" {{ $patient->blood_group == 0 ? 'selected' : ''
                                                    }}>Nhóm máu O
                                                </option>
                                                <option value="1" {{ $patient->blood_group == 1 ? 'selected' : ''
                                                    }}>Nhóm máu A
                                                </option>
                                                <option value="2" {{ $patient->blood_group == 2 ? 'selected' : ''
                                                    }}>Nhóm máu B
                                                </option>
                                                <option value="3" {{ $patient->blood_group == 3 ? 'selected' : ''
                                                    }}>Nhóm máu
                                                    AB</option>
                                            </select>
                                            @error('blood_group')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="phone">Số điện thoại:</label>
                                            <input type="text" name="phone" id="phone"
                                                class="form-control @error('phone') is-invalid @enderror"
                                                value="{{ old('phone', $patient->phone) }}">
                                            @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="address">Địa chỉ:</label>
                                            <input type="text" name="address" id="address"
                                                class="form-control @error('address') is-invalid @enderror"
                                                value="{{ old('address', $patient->address) }}">
                                            @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="identity_number">Số CMT/CCCD:</label>
                                            <input type="text" name="identity_number" id="identity_number"
                                                class="form-control @error('identity_number') is-invalid @enderror"
                                                value="{{ old('identity_number',$patient->identity_number ) }}">
                                            @error('identity_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="identity_card_date">Ngày cấp:</label>
                                            <input type="date" name="identity_card_date" id="identity_card_date"
                                                class="form-control @error('identity_card_date') is-invalid @enderror"
                                                value="{{ old('identity_card_date',$patient->identity_card_date?->format(config('const.format.date_form'))) }}">
                                            @error('identity_card_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="identity_card_place">Nơi cấp:</label>
                                            <input type="text" name="identity_card_place" id="identity_card_place"
                                                class="form-control @error('identity_card_place') is-invalid @enderror"
                                                value="{{ old('identity_card_place',$patient->identity_card_place) }}">
                                            @error('identity_card_place')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="d-flex justify-content-between mt-4">

                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save"></i> Chỉnh sửa
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->


@include('user.footer')