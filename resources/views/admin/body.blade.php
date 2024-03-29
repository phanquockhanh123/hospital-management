<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Trang chủ</h1>
        </div><!-- /.col -->
        {{-- <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
          </ol>
        </div><!-- /.col --> --}}
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  @if(Auth::user()->role == 3)
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{ $countDoctors }}</h3>

              <p>Bác sĩ</p>
            </div>
            <div class="icon">
              <i class="fa-solid fa-user-doctor" style="font-size:60px;"></i>
            </div>
            {{-- <a href="{{ route('doctors.index') }}" class="small-box-footer">Xem thêm <i
                class="fas fa-arrow-circle-right"></i></a> --}}
          </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{ number_format($countBillMoney[0]->total_money , 0, '.', ',') ?? 0 }} đồng</h3>

              <p>Tổng hóa đơn</p>
            </div>
            <div class="icon">
              <i class="fas fa-file-invoice" style="font-size:60px;"></i>
            </div>
            {{-- <a href="{{ route('bills.index') }}" class="small-box-footer">Xem thêm <i
                class="fas fa-arrow-circle-right"></i></a> --}}
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{ $countPatients }}</h3>

              <p>Bệnh nhân</p>
            </div>
            <div class="icon">
              <i class="fa-solid fa-user-injured" style="font-size:60px;"></i>
            </div>
            {{-- <a href="{{ route('patients.index') }}" class="small-box-footer">Xem thêm <i
                class="fas fa-arrow-circle-right"></i></a> --}}
          </div>
        </div>


        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{ $countUsers }}</h3>

              <p>Tài khoản người dùng</p>
            </div>
            <div class="icon">
              <i class="fa-solid fa-user-circle" style="font-size:60px;"></i>
            </div>
            {{-- <a href="{{ route('users.index') }}" class="small-box-footer">Xem thêm <i
                class="fas fa-arrow-circle-right"></i></a> --}}
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{ $countAppointments }}</h3>

              <p>Lịch hẹn </p>
            </div>
            <div class="icon">
              <i class="far fa-calendar-alt" style="font-size:60px;"></i>
            </div>
            {{-- <a href="{{ route('appointments.index') }}" class="small-box-footer">Xem thêm <i
                class="fas fa-arrow-circle-right"></i></a> --}}
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{ $countPrescriptions }}</h3>

              <p>Hóa đơn</p>
            </div>
            <div class="icon">
              <i class="fa-solid fa-file-invoice" style="font-size:60px;"></i>
            </div>
            {{-- <a href="{{ route('prescriptions.index') }}" class="small-box-footer">Xem thêm <i
                class="fas fa-arrow-circle-right"></i></a> --}}
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{ $countPrescriptions }}</h3>

              <p>Đơn thuốc</p>
            </div>
            <div class="icon">
              <i class="fas fa-prescription-bottle-alt" style="font-size:60px;"></i>
            </div>
            {{-- <a href="{{ route('prescriptions.index') }}" class="small-box-footer">Xem thêm <i
                class="fas fa-arrow-circle-right"></i></a> --}}
          </div>
        </div>


        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{ $countMedicalDevices }}</h3>

              <p>Thiết bị vật tư</p>
            </div>
            <div class="icon">
              <i class="fa-solid fa-medkit" style="font-size:60px;"></i>
            </div>
            {{-- <a href="{{ route('medical_devices.index') }}" class="small-box-footer">Xem thêm <i
                class="fas fa-arrow-circle-right"></i></a> --}}
          </div>


        </div>

        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{ $countDiagnosises }}</h3>

              <p>Chẩn đoán / Xét nghiệm</p>
            </div>
            <div class="icon">
              <i class="fas-solid fa-microscope" style="font-size:60px;"></i>
            </div>
            {{-- <a href="{{ route('diagnosises.index') }}" class="small-box-footer">Xem thêm <i
                class="fas fa-arrow-circle-right"></i></a> --}}
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{ $countAppointments }}</h3>

              <p>Lương</p>
            </div>
            <div class="icon">
              <i class="fas fa-money-bill" style="font-size:60px;"></i>
            </div>
            {{-- <a href="{{ route('appointments.index') }}" class="small-box-footer">Xem thêm <i
                class="fas fa-arrow-circle-right"></i></a> --}}
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{ $countDepartments }}</h3>

              <p>Phòng ban</p>
            </div>
            <div class="icon">
              <i class="fas fa-building" style="font-size:60px;"></i>
            </div>
            {{-- <a href="{{ route('doctor_departments.index') }}" class="small-box-footer">Xem thêm <i
                class="fas fa-arrow-circle-right"></i></a> --}}
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{ $countNews }}</h3>

              <p>Bài viết</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph" style="font-size:60px;"></i>
            </div>
            {{-- <a href="{{ route('news.index') }}" class="small-box-footer">Xem thêm <i
                class="fas fa-arrow-circle-right"></i></a> --}}
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{ $countNews }}</h3>

              <p>Cuộc họp</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph" style="font-size:60px;"></i>
            </div>
            {{-- <a href="{{ route('news.index') }}" class="small-box-footer">Xem thêm <i
                class="fas fa-arrow-circle-right"></i></a> --}}
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{ $countReceptionists }}</h3>

              <p>Lễ tân</p>
            </div>
            <div class="icon">
              <i class="fa-solid fa-user-doctor" style="font-size:60px;"></i>
            </div>
            {{-- <a href="{{ route('patients.index') }}" class="small-box-footer">Xem thêm <i
                class="fas fa-arrow-circle-right"></i></a> --}}
          </div>
        </div>
        <!-- ./col -->

        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{ $countMedicals }}</h3>

              <p>Thuốc</p>
            </div>
            <div class="icon">
              <i class="fa-solid fa-user-doctor" style="font-size:60px;"></i>
            </div>
            {{-- <a href="{{ route('patients.index') }}" class="small-box-footer">Xem thêm <i
                class="fas fa-arrow-circle-right"></i></a> --}}
          </div>
        </div>
        <!-- ./col -->

        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{ $countServices }}</h3>

              <p>Dịch vụ</p>
            </div>
            <div class="icon">
              <i class="fa-solid fa-user-doctor" style="font-size:60px;"></i>
            </div>
            {{-- <a href="{{ route('patients.index') }}" class="small-box-footer">Xem thêm <i
                class="fas fa-arrow-circle-right"></i></a> --}}
          </div>
        </div>
        <!-- ./col -->


        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->

      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
  @endif

  <!-- Content Wrapper. Contains page content -->

  <!-- Content Header (Page header) -->

  <!-- /.row -->
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Lịch hẹn hôm nay</h3>

          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
            </div>
          </div>
        </div>
        <div class="card-body table-responsive p-0">
          @if ($appointmentTodays->count() == 0)
          <div class="alert alert-danger" role="alert">
            Không tìm thấy lịch hẹn nào hôm nay.
          </div>
          @else
          <table id="example2" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Bệnh nhân</th>
                <th>Bác sĩ</th>
                <th>Phòng ban</th>
                <th>Bắt đầu</th>
                <th>Kết thúc</th>
                <th>Trạng thái</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($appointmentTodays as $appointment)
              <tr>
                <td>{{ $appointment->patient->name }}</td>
                <td>{{ $appointment->doctor->name }}</td>
                <td>{{ $appointment->doctorDepartment->name }}</td>
                <td>{{ $appointment->start_time }}</td>
                <td>{{ $appointment->end_time }}</td>
                <td>
                  @if($appointment->status == 2)
                  <i class="fa-solid fa-calendar-check" style="color:green;"></i>

                  @elseif ($appointment->status == 1)
                  <a href="{{ route('appointments.denied', $appointment->id) }}"><i class="fa-solid fa-calendar-xmark"
                      style="color:red;"></i></a>
                  <a href="{{ route('appointments.accepted', $appointment->id) }}"><i class="fa-solid fa-calendar-check"
                      style="color:blue;"></i></a>

                  @else
                  <i class="fa-solid fa-calendar-xmark" style="color:red;"></i>
                  @endif

                </td>
              </tr>
              @endforeach


            </tbody>
          </table>
          @endif
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>

  <!-- /.row -->
  <div class="row">
    <div class="col-12">
      <div class="card">
        @if (Auth::user()->role != 2)
        <div class="card-header">
          <h3 class="card-title">Danh sách đặt lich hẹn trong 10 ngày tới</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          @if ($bookAppointmentTodays->count() == 0)
          <div class="alert alert-danger" role="alert">
            Không tìm thấy lịch đặt hẹn trong 10 ngày tới.
          </div>
          @else
          <table id="example2" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Họ và tên</th>
                <th>Số điện thoại</th>
                <th>Email</th>
                <th>Nguyên nhân</th>
                <th>Thời gian mong muốn</th>
                <td>Ngày đặt lịch</td>
                <td>Hành động</td>
              </tr>
            </thead>
            <tbody>
              @foreach ($bookAppointmentTodays as $bookAppointment)
              <tr>
                <td>{{ $bookAppointment->fullname }}</td>
                <td>{{ $bookAppointment->phone }}</td>
                <td>{{ $bookAppointment->email }}</td>
                <td>{{ $bookAppointment->reason }}</td>
                <td>{{ $bookAppointment->experted_time }}</td>
                <td>{{ $bookAppointment->created_at }}</td>
                <td>
                  @if($bookAppointment->status == 2)
                  <i class="fa-solid fa-calendar-check" title="Đã tạo cuộc hẹn" style="color:green;"></i>

                  @elseif ($bookAppointment->status == 1)
                  {{-- <a href="{{ route('book_appointments.denied', $bookAppointment->id) }}" title="Từ chối"><i
                      class="fa-solid fa-calendar-xmark" style="color:red;"></i></a> --}}
                  <a href="{{ route('book_appointments.accepted', $bookAppointment->id) }}" title="Tạo cuộc hẹn"><i
                      class="fa-solid fa-calendar-check" style="color:blue;"></i></a>

                  @else
                  <i class="fa-solid fa-calendar-xmark" style="color:red;"></i>
                  @endif
                </td>
              </tr>
              @endforeach


            </tbody>
          </table>
          @endif
        </div>
        @endif
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>

  @if(Auth::user()->role == 3)
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Thiết bị sẽ hết hạn trong 60 ngày tới</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          @if ($medicalDevices->count() == 0)
          <div class="alert alert-danger" role="alert">
            Không tìm thấy thiết bị vật tư nào.
          </div>
          @else
          <table id="example2" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Mã thiết bị</th>
                <th>Tên thiết bị</th>
                <th>Phòng ban</th>
                <th>Trạng thái</th>
                <th>Số lượng còn</th>
                <th>Hết hạn kiểm định</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($medicalDevices as $medical_device)
              <tr>
                <td><a href="{{ route('medical_devices.show', $medical_device->id) }}">{{
                    $medical_device->medical_device_code }}</a>
                </td>
                <td>{{ $medical_device->name }}</td>
                <td>{{ $medical_device->department_id }}</td>
                <td>
                  @if ($medical_device->status == 0)
                  <span class="text-danger">Chưa được kiểm duyệt</span>
                  @elseif ($medical_device->status == 1)
                  <span class="text-warning">Đang chờ kiểm duyệt</span>
                  @elseif ($medical_device->status == 2)
                  <span class="text-primary">Đã được kiểm duyệt</span>
                  @endif
                </td>
                <td>{{ $medical_device->quantity }}</td>
                <td>{{ $medical_device->expired_date?->format(config('const.format.date')) }}</td>
              </tr>
              @endforeach

            </tbody>
          </table>
          @endif
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
  @endif

  @if(Auth::user()->role == 3)
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-4" style="height: 500px;">
          <div id="column_chart" style="width: 500px; height: 500px;"></div>
          <div style="text-align: center;">Thống kê tình trạng trang thiết bị</div>

        </div>
        <div class="col-sm-8">
          <div id="piechart_3d" style="width: 900px; height: 500px;"></div>
          <div style="text-align: center;">Thống kê số lượt khám bệnh theo phòng ban trong tháng {{
            $now->month }} / {{ $now->year }} </div>
        </div>
      </div>
      <div id="line_chart" style="width: 1400px; height: 500px; align-items: center;"></div>
      <h1 style="text-align:center;margin-bottom: 120px;font-size:28px;font-weight:600">Biểu đồ thống kê số lượt khám
        theo từng tháng</h1>

      <div id="column_chart_bill" style="width: 1400px; height: 500px; align-items: center;"></div>
      <h1 style="text-align:center;margin-bottom: 120px;font-size:28px;font-weight:600">Bảng thống kê thu nhập theo
        phòng ban</h1>

    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content-wrapper -->
  <!-- ./wrapper -->
  @endif
  <!-- /.row -->
</div>
</div>
<!-- /.content-wrapper -->