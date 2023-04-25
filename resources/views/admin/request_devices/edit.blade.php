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
                            <h3 class="card-title">Chỉnh sửa thiết bị y tế</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('request_devices.update', $request_device->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="patient_id">Bệnh nhân:</label>
                                    <select name="patient_id" class="form-control input-sm m-bot15">
                                        @foreach ($patients as $patient)
                                        <option value="{{ $patient->id }}" {{ $request_device->patient_id ==
                                            $patient->id ? 'selected' : '' }}>
                                            {{ $patient->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('patient_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="borrow_time">Thời gian mượn:</label>
                                    <input type="datetime-local" name="borrow_time" id="borrow_time"
                                        class="form-control @error('borrow_time') is-invalid @enderror"
                                        value="{{ old('borrow_time', $request_device->borrow_time->format(config('const.format.datetie-local_form'))) }}">
                                    @error('borrow_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="return_time">Thời gian trả:</label>
                                    <input type="datetime-local" name="return_time" id="return_time"
                                        class="form-control @error('return_time') is-invalid @enderror"
                                        value="{{ old('return_time', $request_device->return_time->format(config('const.format.date_form'))) }}">
                                    @error('return_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="card-header" style="display: flex!important">
                                    <label style="font-size: 20px;">Thiết bị y tế</label>
                                    <button style="margin-left: 80%;" class="btn btn-primary" id="btAddRequestDevice">Thêm</button>
                                </div>

                                <table class="table" id="table">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="min-width: 400px;">TÊN THIẾT BỊ</th>
                                            <th scope="col">SỐ LƯỢNG</th>
                                            <th scope="col">LƯU Ý</th>
                                            <th scope="col">THAO TÁC</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody" name="tbody">
                                        @foreach ($requestDeviceItem as $item)
                                        <tr id="sectionMain" name="sectionMain">
                                            <td style="width:200px">
                                                <select name="medical_device_id[]" class="form-control input-sm m-bot15">
                                                    @foreach ($medicalDevices as $medicalDevice)
                                                        <option value="{{ $medicalDevice->id }}" {{ $item['medical_device_id'] ==
                                                            $medicalDevice->id ? 'selected' : '' }}>{{ $medicalDevice->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" name="quantity[]" id="quantity"
                                                    class="form-control @error('quantity') is-invalid @enderror"
                                                    value="{{ old('quantity', $item['quantity']) }}">
                                            </td>
                                            <td>
                                                <input type="text" name="description[]" id="description"
                                                    class="form-control @error('description') is-invalid @enderror"
                                                    value="{{ old('description', $item['description']) }}">
                                            </td>
                                            <td>
                                                <button id="btnDeleteRequestDevice">
                                                    <svg id="deleteElement" style="color: red" xmlns="http://www.w3.org/2000/svg"
                                                    width="26" height="26" fill="currentColor"
                                                    class="bi bi-trash3" viewBox="0 0 16 16" >
                                                    <path
                                                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                    </svg>
                                                </button>
                                                
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="d-flex justify-content-between mt-4">
                                    <a href="{{ route('request_devices.index') }}" class="btn btn-secondary">
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
    <script>
        document.getElementById("btAddRequestDevice").onclick = function(e) {
            e.preventDefault();
            var body = document.getElementById("tbody");
            var section = document.getElementById("sectionMain");
            body.appendChild(section.cloneNode(true));
        }

        document.getElementById("btnDeleteRequestDevice").onclick = function(e) {
            e.preventDefault();
            var body = document.getElementById("tbody");
            var section = document.getElementById("sectionMain");
            body.removeChild(body.lastElementChild);
        }
    </script>
    @include('admin.script')
</body>

</html>