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

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <form action="{{ route('users.index') }}" method="GET">
                                <div class="input-group mb-2">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Search users"
                                            name="search">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="submit">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-3" style="float: right;">
                            <a href="{{ route('users.create') }}" class="btn btn-success">
                                <i class="fas fa-plus"></i> Tạo mới
                            </a>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->

            @if (Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
            @endif
            <div class="card">
                <div class="card-header">
                    All Zoom Meetings
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @if ($meetings->count() > 0)
                        @foreach ($meetings as $meeting)
                        <li class="list-group-item">
                            <div>
                                Meeting Name: <strong>{{$meeting->meeting_name}}</strong>
                            </div>
                            <div>
                                Meeting Password: <strong>{{$meeting->meeting_password}}</strong>
                            </div>
                            @if (!$meeting->is_active && !$meeting->finished)
                            <div>
                                <a href="{{ route('meeting.start', $meeting->meeting_id)}}"><strong>Click To Start
                                        Meeting</strong></a>
                            </div>
                            @elseif ($meeting->is_active && !$meeting->finished)
                            Meeting Status: <img src="{{ asset('live-streaming.png') }}" style="color:red" width="40px"
                                height="40px" alt="">
                            <div>
                                <a href="{{ route('meeting.join', $meeting->meeting_id) }}"><strong>Click To Join
                                        Meeting</strong></a>
                            </div>
                            @endif

                            @if ($meeting->user_id == auth()->user()->id)
                            <form action="{{ route('meeting.destroy', $meeting->meeting_id) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger btn-sm">Delete Meeting</button>
                            </form>
                            @endif
                        </li>
                        @endforeach
                        @else
                        <h3 style="color:red;text-align:center">No Meetings Created Yet!</h3>
                        @endif
                    </ul>
                </div>
            </div>
            <!-- /.content -->
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