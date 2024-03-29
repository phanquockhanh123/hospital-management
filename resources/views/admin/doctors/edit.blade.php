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
            <div class="card">
                <div class="row">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-9">
                        <div class="card-header">
                            <h3 class="card-title">Chỉnh sửa bác sĩ</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('doctors.update', $doctor->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="name">Tên lễ tân:</label>
                                    <input type="text" name="name" id="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', $doctor->name) }}">
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="profile">Ảnh đại diện:</label>
                                    <img src="@if(empty($doctor->filename))  https://th.bing.com/th/id/OIP.IkXgNyoITfT5LmWWROUoMwHaHa?pid=ImgDet&rs=1  @else {{ asset('./imgDoctor/'. $doctor->filename) }} @endif"" style="vertical-align: middle;
                                                        width: 200px;
                                                        height: 300px;
                                                        margin-bottom:20px;">
                                    <input type="file" name="profile" id="profile"
                                        class="form-control @error('profile') is-invalid @enderror"
                                        value="{{ old('profile', $doctor->profile) }}">
                                    @error('profile')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="date_of_birth">Ngày sinh:</label>
                                    <input type="date" name="date_of_birth" id="date_of_birth"
                                        class="form-control @error('date_of_birth') is-invalid @enderror"
                                        value="{{ old('date_of_birth', $doctor->date_of_birth->format(config('const.format.date_form'))) }}">
                                    @error('date_of_birth')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="gender">Giới tính:</label>
                                    <select name="gender" class="form-control input-sm m-bot15">
                                        <option value="0" {{ $doctor->gender == 0 ? 'selected' : '' }}>Nữ</option>
                                        <option value="1" {{ $doctor->gender == 1 ? 'selected' : '' }}>Nam</option>
                                    </select>
                                    @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="blood_group">Nhóm máu:</label>
                                    <select name="blood_group" class="form-control input-sm m-bot15">
                                        <option value="0" {{ $doctor->blood_group == 0 ? 'selected' : '' }}>Nhóm máu O
                                        </option>
                                        <option value="1" {{ $doctor->blood_group == 1 ? 'selected' : '' }}>Nhóm máu A
                                        </option>
                                        <option value="2" {{ $doctor->blood_group == 2 ? 'selected' : '' }}>Nhóm máu B
                                        </option>
                                        <option value="3" {{ $doctor->blood_group == 3 ? 'selected' : '' }}>Nhóm máu
                                            AB</option>
                                    </select>
                                    @error('blood_group')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                                
                                <div class="form-group">
                                    <label for="doctor_department_id">Phòng ban:</label>
                                    <select name="doctor_department_id" class="form-control input-sm m-bot15">
                                        @foreach ($doctorDepartments as $doctorDepartment)
                                        <option value="{{ $doctorDepartment->id }}" {{ $doctor->doctor_department_id ==
                                            $doctorDepartment->id ? 'selected' : '' }}>
                                            {{ $doctorDepartment->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('doctor_department_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="phone">Số điện thoại:</label>
                                    <input type="text" name="phone" id="phone"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        value="{{ old('phone', $doctor->phone) }}">
                                    @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="address">Địa chỉ:</label>
                                    <input type="text" name="address" id="address"
                                        class="form-control @error('address') is-invalid @enderror"
                                        value="{{ old('address', $doctor->address) }}">
                                    @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" name="email" id="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email', $doctor->email) }}">
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="designation">Giới thiệu:</label>
                                    <input type="text" name="designation" id="designation"
                                        class="form-control @error('designation') is-invalid @enderror"
                                        value="{{ old('designation', $doctor->designation) }}">
                                    @error('designation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
        
        
                                <div class="form-group">
                                    <label for="academic_level">Trình độ chuyên môn:</label>
                                    <select name="academic_level" class="form-control input-sm m-bot15">
                                        <option value="0" {{ $doctor->academic_level == 0 ? 'selected' : '' }}>Cao đẳng</option>
                                        <option value="1" {{ $doctor->academic_level == 1 ? 'selected' : '' }}>Đại học</option>
                                        <option value="2" {{ $doctor->academic_level == 2 ? 'selected' : '' }}>Thạc sỹ</option>
                                        <option value="3" {{ $doctor->academic_level == 3 ? 'selected' : '' }}>Giáo sư</option>
                                    </select>
                                    @error('academic_level')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
        
        
                                <div class="form-group">
                                    <label for="identity_number">Số CMT/CCCD:</label>
                                    <input type="text" name="identity_number" id="identity_number"
                                        class="form-control @error('identity_number') is-invalid @enderror"
                                        value="{{ old('identity_number', $doctor->identity_number) }}">
                                    @error('identity_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
        
        
                                <div class="form-group">
                                    <label for="identity_card_date">Ngày cấp:</label>
                                    <input type="date" name="identity_card_date" id="identity_card_date"
                                        class="form-control @error('identity_card_date') is-invalid @enderror"
                                        value="{{ old('identity_card_date', $doctor->identity_card_date->format(config('const.format.date_form'))) }}">
                                    @error('identity_card_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
        
        
                                <div class="form-group">
                                    <label for="identity_card_place">Nơi cấp:</label>
                                    <input type="text" name="identity_card_place" id="identity_card_place"
                                        class="form-control @error('identity_card_place') is-invalid @enderror"
                                        value="{{ old('identity_card_place', $doctor->identity_card_place) }}">
                                    @error('identity_card_place')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
        
                                <div class="form-group">
                                    <label for="start_work_date">Ngày đi làm:</label>
                                    <input type="date" name="start_work_date" id="start_work_date"
                                        class="form-control @error('start_work_date') is-invalid @enderror"
                                        value="{{ old('start_work_date', $doctor->start_work_date->format(config('const.format.date_form'))) }}">
                                    @error('start_work_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
        
                                <div class="form-group">
                                    <label for="specialist">Chuyên ngành:</label>
                                    <input type="text" name="specialist" id="specialist"
                                        class="form-control @error('specialist') is-invalid @enderror"
                                        value="{{ old('specialist', $doctor->specialist) }}">
                                    @error('specialist')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="d-flex justify-content-between mt-4">
                                    <a href="{{ route('doctors.index') }}" class="btn btn-secondary">
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