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
                        <div class="col-sm-6">
                            <form action="{{ route('bills.index') }}" method="GET">
                                <div class="input-group mb-2">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Tìm kiếm hóa đơn"
                                            name="search">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="submit">Tìm kiếm</button>
                                        </div>
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
                                                <th>Đã thanh toán</th>
                                                <th>Còn nợ</th>
                                                <th>Trạng thái</th>
                                                @if(Auth::user()->role == 2)
                                                <th>Hành động</th>
                                                @endif
                                                @if(Auth::user()->role == 1)
                                                <th>Thanh toán</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($bills as $bill)
                                            <tr>
                                                <td><a href="{{ route('bills.show', $bill->id) }}">{{ $count++ }}</a>
                                                </td>
                                                <td>{{ $bill->diagnosis->patient->name }}</td>
                                                <td>{{ $bill->diagnosis->doctor->name }}</td>
                                                <td>{{ $bill->created_at }}</td>
                                                <td>{{ $bill->total_money }}</td>
                                                <td>@if(empty($bill->paid_money)) 0 @else {{ $bill->total_money }} @endif</td>
                                                <td>{{ $bill->total_money - $bill->paid_money }}</td>
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
                                                        <a onclick=" @if ($bill->status == 1) return false;"  @endif href="{{ route('bills.show', $bill) }}" style="margin-right: 10px;font-size:22px;color:blue @if($bill->status == 1) color:black; @endif"  >
                                                          <i class="fas fa-eye"></i>
                                                        </a>
                                                        {{-- <a href="{{ route('bills.edit', $bill->id) }}" style="margin-right: 10px;color:green;font-size:22px">
                                                          <i class="fas fa-edit"></i>
                                                        </a> --}}
                                                        <button type="button" data-toggle="modal"
                                                          data-target="#deleteModal{{ $bill->id }}" style="color: red;font-size:22px">
                                                          <i class="fas fa-trash-alt"></i>
                                                        </button>
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