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
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{ $countDoctors }}</h3>

              <p>Bác sĩ</p>
            </div>
            <div class="icon">
              <i class="fa-solid fa-user-doctor"></i>
            </div>
            <a href="{{ route('doctors.index') }}" class="small-box-footer">Xem thêm <i
                class="fas fa-arrow-circle-right"></i></a>
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
              <i class="fa-solid fa-user-doctor"></i>
            </div>
            <a href="{{ route('patients.index') }}" class="small-box-footer">Xem thêm <i
                class="fas fa-arrow-circle-right"></i></a>
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
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ route('users.index') }}" class="small-box-footer">Xem thêm <i
                class="fas fa-arrow-circle-right"></i></a>
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
              <i class="far fa-calendar-alt"></i>
            </div>
            <a href="{{ route('appointments.index') }}" class="small-box-footer">Xem thêm <i
                class="fas fa-arrow-circle-right"></i></a>
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
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route('prescriptions.index') }}" class="small-box-footer">Xem thêm <i
                class="fas fa-arrow-circle-right"></i></a>
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
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route('prescriptions.index') }}" class="small-box-footer">Xem thêm <i
                class="fas fa-arrow-circle-right"></i></a>
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
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route('medical_devices.index') }}" class="small-box-footer">Xem thêm <i
                class="fas fa-arrow-circle-right"></i></a>
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
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route('diagnosises.index') }}" class="small-box-footer">Xem thêm <i
                class="fas fa-arrow-circle-right"></i></a>
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
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route('appointments.index') }}" class="small-box-footer">Xem thêm <i
                class="fas fa-arrow-circle-right"></i></a>
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
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route('doctor_departments.index') }}" class="small-box-footer">Xem thêm <i
                class="fas fa-arrow-circle-right"></i></a>
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
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route('news.index') }}" class="small-box-footer">Xem thêm <i
                class="fas fa-arrow-circle-right"></i></a>
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
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route('news.index') }}" class="small-box-footer">Xem thêm <i
                class="fas fa-arrow-circle-right"></i></a>
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
              <i class="fa-solid fa-user-doctor"></i>
            </div>
            <a href="{{ route('patients.index') }}" class="small-box-footer">Xem thêm <i
                class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->

      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
  @endif
  <div>
    <!-- /.row -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Lịch hẹn hôm nay</h3>

            <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                {{-- <input type="text" name="table_search" class="form-control float-right" placeholder="Search"> --}}

                {{-- <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                </div> --}}
              </div>
            </div>
          </div>
          <!-- /.card-header -->
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
                                        <a href="{{ route('appointments.denied', $appointment->id) }}"><i class="fa-solid fa-calendar-xmark"  style="color:red;"></i></a>
                                        <a href="{{ route('appointments.accepted', $appointment->id) }}"><i class="fa-solid fa-calendar-check"  style="color:blue;"></i></a>
                                        
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
          <div class="card-header">
            <h3 class="card-title">Danh sách đặt lich hẹn trong 10 ngày tới</h3>

            {{-- <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </div> --}}
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
                                        <i class="fa-solid fa-calendar-check" style="color:green;"></i>
                                        
                                    @elseif ($bookAppointment->status == 1)
                                        <a href="{{ route('book_appointments.denied', $bookAppointment->id) }}" title="Từ chối"><i class="fa-solid fa-calendar-xmark"  style="color:red;"></i></a>
                                        <a href="{{ route('book_appointments.accepted', $bookAppointment->id) }}" title="Chấp nhận"><i class="fa-solid fa-calendar-check"  style="color:blue;"></i></a>
                                        
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

    @if(Auth::user()->role == 3)
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Thiết bị sẽ hết hạn trong 60 ngày tới</h3>

            {{-- <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </div> --}}
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
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($medicalDevices as $medical_device)
                            <tr>
                                <td><a
                                        href="{{ route('medical_devices.show', $medical_device->id) }}">{{ $medical_device->medical_device_code }}</a>
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
                                <td>{{ $medical_device->expired_date->format(config('const.format.date')) }}</td>
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
    <!-- /.row -->
  </div>
</div>
<!-- /.content-wrapper -->
