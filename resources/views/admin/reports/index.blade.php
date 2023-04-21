<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hospital Management</title>
    @include('admin.css')
    <script>
        var msg = '{{ Session::get('alert') }}';
        var exist = '{{ Session::has('alert') }}';
        if (exist) {
            alert(msg);
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Phòng ban', 'Số lượng'],
          <?php echo $pie3DChartData; ?>
        ]);

        var options = {
          title: 'Số lượt khám theo phòng ban',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
      
    </script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake"
                src="https://media.licdn.com/dms/image/C4D03AQGB9X-aVyccoQ/profile-displayphoto-shrink_800_800/0/1517596403369?e=2147483647&v=beta&t=jJ0WBwNT7Uq1bc4KRRBHJM_cOmv3Yt544vbvRh3VwYE"
                alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        @include('admin.navbar')
        <!-- /.navbar -->

        @include('admin.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-4" style="height: 500px;">
                            <canvas id="myChart"></canvas>
                            <div style="text-align: center;">Thống kê tình trạng trang thiết bị</div>

                        </div>
                        <div class="col-sm-8">
                            <div id="piechart_3d" style="width: 900px; height: 500px;"></div>
                            <div style="text-align: center;">Thống kê số lượt khám bệnh theo phòng ban trong tháng {{
                                $now->month }} / {{ $now->year }} </div>
                        </div>
                    </div>
                    <h1 style="text-align:center;margin-top: 120px;font-size:28px;font-weight:600">Bảng thống kê thu nhập theo phòng ban</h1>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên phòng ban</th>
                                <th style="width:500px">Tổng thu nhập</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($billByDeparments as $billByDeparment)
                            <tr>
                                <td>{{ $count++; }}</td>
                                <td>{{ $billByDeparment->department_name; }}</td>
                                <td>{{ $billByDeparment->total_money; }} đồng</td>
                            </tr>
                            @endforeach
                           
                        </tbody>
                    </table>
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


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Đang chờ kiểm định', 'Đã được kiểm định'],
                datasets: [{
                    label: '# of Votes',
                    data: [(`<?php echo $devices_kiemdinh; ?>`),(`<?php echo $devices_chuakiemdinh; ?>`)],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    },
                }
            }
        });

       
    </script>
    @include('admin.script')
</body>

</html>