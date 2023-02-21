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
      <img class="animation__shake" src="admin2/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
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
              <form action="{{ route('bed_types.index') }}" method="GET">
                <div class="input-group mb-2">
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search Bed Types" name="search">
                    <div class="input-group-append">
                      <button class="btn btn-outline-secondary" type="submit">Search</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="col-sm-3" style="float: right;">
              <a href="{{ route('bed_types.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Tạo mới
              </a>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">

                <!-- /.card-header -->
                <div class="card-body">
                  @if ($bedTypes->isEmpty())
                  <div class="alert alert-danger" role="alert">
                    No bed types found.
                  </div>
                  @else
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>DESCRIPTION</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($bedTypes as $bedType)
                      <tr>
                        <td><a href="{{ route('bed_types.show', $bedType) }}">{{ $bedType->id }}</a></td>
                        <td>{{ $bedType->name }}</td>
                        <td>{{ $bedType->description }}</td>
                        <td>
                          <div class="btn-group">
                            <a href="{{ route('bed_types.edit', $bedType->id) }}" class="btn btn-primary">
                              <i class="fas fa-edit"></i> Sửa
                            </a>
                            <button type="button" class="btn btn-danger" data-toggle="modal"
                              data-target="#deleteModal{{ $bedType->id }}" style="color: red;">
                              <i class="fas fa-trash-alt"></i> Xóa
                            </button>
                          </div>
                        </td>

                        <!-- Modal -->
                        <div class="modal fade" id="deleteModal{{ $bedType->id }}" tabindex="-1" role="dialog"
                          aria-labelledby="deleteModalLabel{{ $bedType->id }}" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel{{ $bedType->id }}">Xóa loại giường</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                Bạn có chắc chắn muốn xóa loại giường "{{ $bedType->name }}" không? Hành động này không
                                thể hoàn tác!
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                <form action="{{ route('bed_types.destroy', $bedType->id) }}" method="POST">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa loại giường này không?')">Xóa</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </tr>
                      @endforeach


                    </tbody>
                  </table>
                  {{ $bedTypes->links() }}
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