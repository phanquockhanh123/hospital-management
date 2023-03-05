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


        <!DOCTYPE html>
        <html lang='en'>

        <head>
            <meta charset='utf-8' />
            <script src='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.1.4/index.global.min.js'></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'resourceTimelineWeek'
                  
                });
                // $event = \Calendar::event(
                //     "Valentine's Day", //event title
                //     true, //full day event?
                //     '2015-02-14', //start time, must be a DateTime object or valid DateTime format (http://bit.ly/1z7QWbg)
                //     '2015-02-14', //end time, must be a DateTime object or valid DateTime format (http://bit.ly/1z7QWbg),
                //     1, //optional event ID
                //     [
                //         'url' => 'http://full-calendar.io'
                //     ]
                // );

                // var view = calendar.view;
                // alert("The view's title is " + view.activeStart);
                calendar.render();
              });
        
            </script>

        </head>

        <body>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-10">
                            <div id='calendar'></div>
                        </div>
                    </div>
                </div>
            </section>
        </body>

        </html>

        @include('admin.script')
</body>

</html>