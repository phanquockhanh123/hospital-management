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

      google.charts.setOnLoadCallback(drawChart2);
      function drawChart2() {
        var data = google.visualization.arrayToDataTable(@json($dataTable));

        var options = {
            title: 'Thống kê số lượt khám trong năm',
            legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('line_chart'));

        chart.draw(data, options);
    }

    google.charts.setOnLoadCallback(drawChart3);
      function drawChart3() {
        var data = google.visualization.arrayToDataTable(@json($dataDeviceTable));

        var options = {
            title: 'Thống kê số lượng thiết bị trong phòng khám',
            legend: { position: 'bottom' }
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('column_chart'));

        chart.draw(data, options);
      }

      google.charts.setOnLoadCallback(drawChart4);
      function drawChart4() {
        var data = google.visualization.arrayToDataTable(@json($dataBill));

        var options = {
            title: 'Thống kê tổng tiền thu được từ hóa đơn theo phòng ban',
            legend: { position: 'bottom' }
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('column_chart_bill'));

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
                            <div id="column_chart" style="width: 500px; height: 500px;"></div>
                            <div style="text-align: center;">Thống kê tình trạng trang thiết bị</div>

                        </div>
                        <div class="col-sm-8">
                            <div id="piechart_3d" style="width: 900px; height: 500px;"></div>
                            <div style="text-align: center;">Thống kê số lượt khám bệnh theo phòng ban trong tháng {{
                                $now->month }} / {{ $now->year }} </div>
                        </div>
                    </div>
                    <div id="line_chart" style="width: 1400px; height: 500px; align-items: center;"></div>
                    <h1 style="text-align:center;margin-bottom: 120px;font-size:28px;font-weight:600">Biểu đồ thống kê số lượt khám theo từng tháng</h1>
                    
                    <div id="column_chart_bill" style="width: 1400px; height: 500px; align-items: center;"></div>
                    <h1 style="text-align:center;margin-bottom: 120px;font-size:28px;font-weight:600">Bảng thống kê thu nhập theo phòng ban</h1>
                    
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