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

        <div class="container">
            <div class="card">
                <div class="row">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-9">
                        <div class="card-header">
                            <h3 class="card-title">Chỉnh sửa bệnh nhân</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('patients.update', $patient->id) }}" method="POST">
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
                                        value="{{ old('date_of_birth', $patient->date_of_birth->format(config('const.format.date_form'))) }}">
                                    @error('date_of_birth')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="gender">Giới tính:</label>
                                    <select name="gender" class="form-control input-sm m-bot15">
                                        <option value="0" {{ $patient->gender == 0 ? 'selected' : '' }}>Nữ</option>
                                        <option value="1" {{ $patient->gender == 1 ? 'selected' : '' }}>Nam</option>
                                    </select>
                                    @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="blood_group">Nhóm máu:</label>
                                    <select name="blood_group" class="form-control input-sm m-bot15">
                                        <option value="0" {{ $patient->blood_group == 0 ? 'selected' : '' }}>Nhóm máu O
                                        </option>
                                        <option value="1" {{ $patient->blood_group == 1 ? 'selected' : '' }}>Nhóm máu A
                                        </option>
                                        <option value="2" {{ $patient->blood_group == 2 ? 'selected' : '' }}>Nhóm máu B
                                        </option>
                                        <option value="3" {{ $patient->blood_group == 3 ? 'selected' : '' }}>Nhóm máu
                                            AB</option>
                                    </select>
                                    @error('blood_group')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" name="email" id="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email', $patient->email) }}">
                                    @error('email')
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
                                        value="{{ old('identity_card_date',$patient->identity_card_date->format(config('const.format.date_form'))) }}">
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
                                    <a href="{{ route('patients.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Quay lại
                                    </a>

                                    <button type="submit" class="btn btn-primary" style="color:blue;">
                                        <i class="fas fa-save"></i> Chỉnh sửa
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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