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

        <h1>Hello 123</h1>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <form action="{{ route('news.index') }}" method="GET">
                                <div class="input-group mb-2">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Search news"
                                            name="search">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="submit">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-3" style="float: right;">
                            <a href="{{ route('news.create') }}" class="btn btn-success">
                                <i class="fas fa-plus"></i> Tạo mới
                            </a>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <div class="bg-overlay" id="nav-overly"></div>
        </div>
        <div class='content d-flex flex-column flex-column-fluid pt-7'>
            <div class="container-fluid">
                <div class="d-md-flex align-items-center justify-content-between mb-7">
                    <h1 class="mb-0"> New Bill
                    </h1>
                    <a href="https://hms.infyom.com/bills" class="btn btn-outline-primary">Back</a>
                </div>
            </div>
            <div class='d-flex flex-column-fluid'>
                <div class="container-fluid">
                    <div class="d-flex flex-column">
                        <div class="row">
                            <div class="col-12">
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="https://hms.infyom.com/bills" accept-charset="UTF-8"
                                    id="billForm"><input name="_token" type="hidden"
                                        value="9C7iFVtlDytvA457I4Ki7n3bmsWTD5oXHcg7pT9p">
                                    <div class="row">
                                        <input class="currencySymbol" name="currency_symbol" type="hidden"
                                            value="usd">
                                        <div class="col-lg-3 col-md-4 col-sm-12 mb-5">
                                            <label for="patient_admission_id" class="form-label">Admission Id:</label>
                                            <span class="required"></span>
                                            <select class="form-select" id="patientAdmissionId" data-control="select2"
                                                required name="patient_admission_id">
                                                <option selected="selected" value="">Select Admission Id</option>
                                                <option value="3SY3YDND">3SY3YDND 1024p Test</option>
                                                <option value="CKXB1NN4">CKXB1NN4 Ashok Metha</option>
                                                <option value="DQFNMO7H">DQFNMO7H Pasien Satu</option>
                                                <option value="FUBCPBFA">FUBCPBFA Arun Kath</option>
                                                <option value="FVIMDL4U">FVIMDL4U Ateeb Afzal</option>
                                                <option value="GMUFVOIH">GMUFVOIH 1024p Test</option>
                                                <option value="IWYNGHGO">IWYNGHGO Md Zannatul Rana</option>
                                                <option value="JIKP8OTP">JIKP8OTP Webby Patient</option>
                                                <option value="JM9L5VWW">JM9L5VWW 1024p Test</option>
                                                <option value="KXKWL0SC">KXKWL0SC Abdulhafiz J</option>
                                                <option value="LNUW9KXY">LNUW9KXY BOOMBOX Temitope</option>
                                                <option value="LYQUAXKV">LYQUAXKV Lenore King</option>
                                                <option value="MRDJURJ5">MRDJURJ5 Chaim Franks</option>
                                                <option value="MX9RRWIS">MX9RRWIS Fredericka Lang</option>
                                                <option value="N4OJIMTV">N4OJIMTV Bahrom Parpiyev</option>
                                                <option value="NOXTEJMY">NOXTEJMY Nada Nada</option>
                                                <option value="NP6ECNNL">NP6ECNNL Bahrom Parpiyev</option>
                                                <option value="NPLMWEGY">NPLMWEGY 11111 1111</option>
                                                <option value="OKJSFXJU">OKJSFXJU Mahesha Kaushik</option>
                                                <option value="POCDWLPD">POCDWLPD Khubab Khan</option>
                                                <option value="PWNPEDI8">PWNPEDI8 Mahesha Kaushik</option>
                                                <option value="PXNFLM2N">PXNFLM2N Arslan Saleem Malik Malik</option>
                                                <option value="QKZOAPJJ">QKZOAPJJ Kumar Gautam</option>
                                                <option value="QV3EBXXF">QV3EBXXF Mahesha Kaushik</option>
                                                <option value="RFX8Y7AD">RFX8Y7AD Jayme Kirby</option>
                                                <option value="RGF3PWGT">RGF3PWGT Abdullah Geyik</option>
                                                <option value="RM6YB1DS">RM6YB1DS Mahesha Kaushik</option>
                                                <option value="SMDXK0AK">SMDXK0AK Mahesha Kaushik</option>
                                                <option value="TRJOAHWD">TRJOAHWD Niloy Khusi</option>
                                                <option value="TTTS9RXY">TTTS9RXY Martha Wheeler</option>
                                                <option value="V1BOXBMY">V1BOXBMY Zayn Joshua</option>
                                                <option value="WZBZYBO8">WZBZYBO8 34 3432</option>
                                                <option value="XAB1MHO4">XAB1MHO4 1024p Test</option>
                                                <option value="XE80F2LX">XE80F2LX John Doe</option>
                                                <option value="XGYYVWYX">XGYYVWYX Mahesha Kaushik</option>
                                                <option value="Y4HE01HV">Y4HE01HV Rizwan Rizwan</option>
                                                <option value="YDF99CKL">YDF99CKL 1024p Test</option>
                                                <option value="YMVUVY4R">YMVUVY4R Arturo Barriga</option>
                                                <option value="YY4HZAWT">YY4HZAWT JEFF TORY</option>
                                                <option value="YYZP6GTF">YYZP6GTF Abdullah Geyik</option>
                                            </select>
                                        </div>
                                        <input id="pAdmissionId" name="patient_admission_id" type="hidden">
                                        <input id="billsPatientId" name="patient_id" type="hidden">
                                        <div class="col-lg-3 col-md-4 col-sm-12 mb-5">
                                            <label for="bill_date" class="form-label">Bill Date:</label>
                                            <span class="required"></span>
                                            <input class="bg-white form-control" id="bill_date" autocomplete="off"
                                                name="bill_date" type="text">
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-12 mb-5 myclass">
                                            <label for="name" class="form-label">Patient:</label>
                                            <input class="form-control" id="name" readonly name="name"
                                                type="text">
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-12 mb-5">
                                            <label for="email" class="form-label">Patient Email:</label>
                                            <input class="form-control" id="userEmail" readonly name="email"
                                                type="text">
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-12 mb-5">
                                            <label for="phone" class="form-label">Patient Cell No:</label>
                                            <input class="form-control" id="userPhone" readonly name="phone"
                                                type="text">
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-12 mb-5">
                                            <label for="gender" class="form-label">Patient Gender:</label>
                                            <br>
                                            <div class="d-flex align-items-center mt-3">
                                                <div class="form-check me-10 mb-0">
                                                    <input class="form-check-input" tabindex="6" id="genderMale"
                                                        checked="checked" name="gender" type="radio"
                                                        value="0"> &nbsp;
                                                    <label class="form-check-label" for="genderMale">Male</label>
                                                </div>
                                                <div class="form-check mb-0">
                                                    <input class="form-check-input" tabindex="7" id="genderFemale"
                                                        name="gender" type="radio" value="1">
                                                    <label class="form-check-label" for="genderFemale">Female</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-12 mb-5">
                                            <label for="dob" class="form-label">Patient DOB:</label>
                                            <input class="form-control" id="dob" readonly name="dob"
                                                type="text">
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-12 mb-5">
                                            <label for="doctor_id" class="form-label">Doctor:</label>
                                            <input class="form-control" id="billDoctorId" readonly name="doctor_id"
                                                type="text">
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-12 mb-5">
                                            <label for="admission_date" class="form-label">Admission Date:</label>
                                            <input class="form-control" id="admissionDate" readonly
                                                name="admission_date" type="text">
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-12 mb-5">
                                            <label for="discharge_date" class="form-label">Discharge Date:</label>
                                            <input class="form-control" id="dischargeDate" readonly
                                                name="discharge_date" type="text">
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-12 mb-5">
                                            <label for="package_id" class="form-label">Package Name:</label>
                                            <input class="form-control" id="packageId" readonly name="package_id"
                                                type="text">
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-12 mb-5">
                                            <label for="insurance_id" class="form-label">Insurance Name:</label>
                                            <input class="form-control" id="insuranceId" readonly name="insurance_id"
                                                type="text">
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-12 mb-5">
                                            <label for="total_days" class="form-label">Total Days:</label>
                                            <input class="form-control" id="totalDays" readonly name="total_days"
                                                type="text">
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-12 mb-5">
                                            <label for="policy_no" class="form-label">Policy No:</label>
                                            <input class="form-control" id="policyNo" readonly name="policy_no"
                                                type="text">
                                        </div>
                                    </div>

                                    <div class="com-sm-12">
                                        <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-end mb-4">
                                            <button type="button" class="btn btn-primary text-star"
                                                id="addBillItem"> Add</button>
                                        </div>
                                        <div class="table-responsive-sm">
                                            <table class="table table-striped" id="billTbl">
                                                <thead>
                                                    <tr
                                                        class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                        <th class="text-center">#</th>
                                                        <th class="required">Item Name</th>
                                                        <th class="required">Qty</th>
                                                        <th class="required">Price</th>
                                                        <th class="text-right">Amount</th>
                                                        <th class="text-center">
                                                            Action
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="bill-item-container text-gray-600 fw-bold">
                                                    <tr>
                                                        <td class="text-center item-number">1</td>
                                                        <td class="table__item-desc">
                                                            <input class="form-control itemName" required
                                                                name="item_name[]" type="text">
                                                        </td>
                                                        <td class="table__qty">
                                                            <input class="form-control qty quantity" required
                                                                name="qty[]" type="number">
                                                        </td>
                                                        <td>
                                                            <input class="form-control price-input price" required
                                                                name="price[]" type="text">
                                                        </td>
                                                        <td class="amount text-right itemTotal">
                                                        </td>
                                                        <td class="text-center">
                                                            <i
                                                                class="fa fa-trash text-danger delete-invoice-item pointer"></i>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-4 float-right p-0">
                                            <table class="w-100">
                                                <tbody class="bill-item-footer">
                                                    <tr>
                                                        <td class="form-label text-right">Total Amount:</td>
                                                        <td class="text-right">
                                                            <span id="totalPrice" class="price">$0</span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

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
