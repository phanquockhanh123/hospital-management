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
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-md-10 offset-md-1">
                            <form action="{{ route('bills.index') }}" method="GET">
                                @csrf
                               
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="patient_id">Bệnh nhân:</label>
                                            <select name="patient_id" class="form-control input-sm m-bot15">
                                                <option value="">----Chọn bệnh nhân----</option>
                                                @foreach ($patients as $patient)
                                                <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('patient_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="created_at">Ngày tạo:</label><br>
                                            <input type="date" name="created_at" class="form-control input-sm m-bot15">
                                            @error('created_at')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="status">Trạng thái:</label>
                                            <select name="status" class="form-control input-sm m-bot15">
                                                <option value="0">Chưa thanh toán</option>
                                                <option value="1">Đã thanh toán</option>
                                            </select>
                                            @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-3" style="margin-top: 32px;">
                                            <button class="btn btn-outline-secondary" type="submit">Tìm
                                                kiếm</button>
                                    </div>
                                </div>

                            </form>

                        </div>
                        {{-- @if(Auth::user()->role == 2)
                        <div class="col-sm-3" style="float: right;">
                            <a href="{{ route('bills.create') }}" class="btn btn-success">
                                <i class="fas fa-plus"></i> Tạo mới
                            </a>
                        </div>
                        @endif --}}
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <h2>
                                    @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                    @endif
                                </h2>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    @if ($bills->count() == 0)
                                    <div class="alert alert-danger" role="alert">
                                        Không tìm thấy hóa đơn nào.
                                    </div>
                                    @else
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Bệnh nhân</th>
                                                <th>Người lập</th>
                                                <th>Ngày tạo</th>
                                                <th>Tổng tiền</th>
                                                <th>Trạng thái</th>
                                                @if(Auth::user()->role == 2)
                                                <th>Hành động</th>
                                                @endif
                                                @if(Auth::user()->role == 1)
                                                
                                                <th>Thanh toán</th>
                                                @endif
                                                <th>PDF</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($bills ?? [] as $bill)
                                            <tr>
                                                <td><a href="{{ route('bills.show', $bill->id) }}">{{ $count++ }}</a>
                                                </td>
                                                <td>{{ $bill->diagnosis?->patient?->name }}</td>
                                                <td>{{ $bill->diagnosis?->doctor?->name }}</td>
                                                <td>{{ $bill->created_at }}</td>
                                                <td>{{ number_format($bill->total_money, 0, '.', ',') }}</td>
                                                <th>
                                                    @if ($bill->status == 0)
                                                    <span class="text-warning">Chưa thanh toán</span>
                                                    @elseif ($bill->status == 1)
                                                    <span class="text-primary">Đã thanh toán</span>
                                                    @endif
                                                </th>
                                                @if(Auth::user()->role == 2)
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{ route('bills.show', $bill) }}" style="margin-right: 10px;font-size:22px;color:blue @if($bill->status == 1) color:black; @endif"  >
                                                          <i class="fas fa-eye"></i>
                                                        </a>
                                                      </div>
                                                </td>

                                                @endif
                                                
                                                @if(Auth::user()->role == 1)
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{ route('bills.payment', $bill->id) }}"
                                                            class="btn btn-warning  @if ($bill->status == 1) disabled @endif">
                                                            <i class="fas fa-edit"></i> Thanh toán
                                                        </a>
                                                    </div>
                                                </td>

                                                @endif
                                                <td><a href="{{ route('bills.pdf', $bill->id) }}" style="font-size: 22px;color:black"><i class="fas fa-print"></i></a></td>
                                                <!-- Modal -->
                                                <div class="modal fade" id="deleteModal{{ $bill->id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="deleteModalLabel{{ $bill->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="deleteModalLabel{{ $bill->id }}">
                                                                    Xóa loại hóa đơn</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Bạn có chắc chắn muốn xóa hóa đơn của bệnh nhân
                                                                "{{ $bill->diagnosis->patient->name }}" không? Hành động
                                                                này
                                                                không
                                                                thể hoàn tác!
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal"
                                                                    style="color:black;">Hủy</button>
                                                                <form action="{{ route('bills.destroy', $bill->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" style="color:red;"
                                                                        class="btn btn-danger"
                                                                        onclick="return confirm('Bạn có chắc chắn muốn xóa lịch hẹn này không?')">Xóa</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </tr>
                                            @endforeach


                                        </tbody>
                                    </table>
                                    {{ $bills->links() }}
                                    @endif
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
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