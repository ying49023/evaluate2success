<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ระบบประเมินผลปฏิบัติงาน : ALT Evaluation</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!--CSS ปรับแต่งเอง -->
    <link rel="stylesheet" href="customize.css"></head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <!--Header part-->
        <?php include './headerpart.php'; ?>
        <!-- Left side column. contains the logo and sidebar -->
        <?php include './sidebarpart.php'; ?>

        <!-- Content Wrapper. Contains page content แก้เนื้อหาแต่ละหน้าตรงนี้นะ -->
        <div class="content-wrapper">

            <!-- Content Header (Page header)  -->
            <section class="content-header">
                <h1>
                    ดูภาพรวม
                    <small>แดชบอร์ด</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="#"> <i class="fa fa-dashboard"></i>
                            Home
                        </a>
                    </li>
                    <li class="active">Dashboard</li>
                </ol>
                <hr></section>
            <!--/Page header -->

            <!-- Main content -->
            <div class="row box-padding">
                <div class="box box-success">
                    <div class="box-body">
                        <form >
                            <div class="col-sm-3">
                                <label class="col-sm-6 control-label">ปีการประเมิน</label>
                                <div class="col-sm-6">
                                    <select class="form-control ">
                                        <option>2013</option>
                                        <option>2014</option>
                                        <option>2015</option>
                                        <option>2016</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label class="col-sm-4 control-label">แผนก</label>
                                <div class="col-sm-8">
                                    <select class="form-control">
                                        <option>ฝ่ายบัญชี</option>
                                        <option>การเงิน</option>
                                        <option>ฝ่ายบุคคล</option>
                                        <option>ฝ่ายขาย</option>
                                        <option>ฝ่ายไอที และสารสนเทศ</option>
                                        <option>ฝ่ายปฏิบัติการ</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">

                                <label class="col-sm-6 control-label">รอบการประเมิน</label>
                                <div class="col-sm-6">
                                    <select class="form-control">
                                        <option>ครั้งที่ 1</option>
                                        <option>ครั้งที่ 2</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary search-button" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="row box-padding">

                <div class="row">
                    <div class="col-md-8">
                        <div class="box box-primary">

                            <div class="box-header with-border"> 
                                <strong>ภาพรวมการทำงานย้อนหลัง</strong>
                                <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"> <i class="fa fa-minus"></i>
                                </button>

                            </div>
                            </div>
                            <div class="box-body">

                                <p class="text-center"> <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
                                </p>

                                <div class="chart">
                                    <!-- Sales Chart Canvas -->
                                    <canvas id="salesChart" style="height: 180px; width: 703px;" width="703" height="180"></canvas>
                                </div>
                                <script>
                                        var salesChartData = {
                                            labels: ["January", "February", "March", "April", "May", "June", "July"],
                                            datasets: [
                                                {
                                                    label: "Electronics",
                                                    fillColor: "rgb(210, 214, 222)",
                                                    strokeColor: "rgb(210, 214, 222)",
                                                    pointColor: "rgb(210, 214, 222)",
                                                    pointStrokeColor: "#c1c7d1",
                                                    pointHighlightFill: "#fff",
                                                    pointHighlightStroke: "rgb(220,220,220)",
                                                    data: [65, 59, 80, 81, 56, 55, 40]
                                                },
                                                {
                                                    label: "Digital Goods",
                                                    fillColor: "rgba(60,141,188,0.9)",
                                                    strokeColor: "rgba(60,141,188,0.8)",
                                                    pointColor: "#3b8bba",
                                                    pointStrokeColor: "rgba(60,141,188,1)",
                                                    pointHighlightFill: "#fff",
                                                    pointHighlightStroke: "rgba(60,141,188,1)",
                                                    data: [28, 48, 40, 19, 86, 27, 90]
                                                }
                                            ]
                                        };
                                    </script>
                                <!-- /.chart-responsive --> </div>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <strong>KPIภาพรวมล่าสุด ประจำเดือน : พฤษภาคม</strong>
                                <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"> <i class="fa fa-minus"></i>
                                </button>
                                
                            </div>
                            </div>
                            <div class="box-body">
                                <div id="g5" class="200px160px" style="height:220px">
                                    <script>
                                    document.addEventListener("DOMContentLoaded", function(event) {
                                      var g5 = new JustGage({
                                        id: "g5",
                                        //value: getRandomInt(0, 100),
                                        value : 67,
                                        min: 0,
                                        max: 100,
                                        title: "เดือนพฤษภาคม",
                                        label: "%",
                                        levelColorsGradient: false
                                      });
                                  });
                                    </script>
                                </div>
                                
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <div class="row box-padding">
            <div class="box box-primary">
                <div class="box-body">
                    <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="80px" >ID</th>
                            <th>ชื่อKPIs</th>
                            <th width="90px">เป้าหมาย</th>
                            <th width="90px">ทำจริง</th>
                            <th width="200px">ประสิทธิภาพ</th>
                            <th width="60" style="text-align:center">%</th>
                        </tr>
                    </thead>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <div class="progress progress-xs progress-striped active">
                              <div class="progress-bar progress-bar-success" style="width: 90%"></div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-green">90%</span>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <div class="progress progress-xs progress-striped active">
                              <div class="progress-bar progress-bar-primary" style="width: 20%"></div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-blue">20%</span>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <div class="progress progress-xs progress-striped active">
                              <div class="progress-bar progress-bar-warning" style="width: 70%"></div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-orange">70%</span>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <div class="progress progress-xs progress-striped active">
                              <div class="progress-bar progress-bar-success" style="width: 82%"></div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-green">82%</span>
                        </td>
                    </tr>
                        
                    </table>
                </div>
            </div>
                
            </div>

            <!-- /.content --> </div>
        <!-- /.content-wrapper -->

        <!--Footer -->
        <?php include './footer.php'; ?>

        <!-- Control Sidebar -->
        <?php include './Controlsidebar.php'; ?>

        <!-- Add the sidebar's background. This div must be placed
                 immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->

    <!--Raphael 2.1.4 -->
    <!--<script src="\plugins\Raphael/raphael-2.1.4.min.js"></script>-->
    <!--JustGage-->
    <script src="plugins/justGage/justgage.js"></script>
    <!-- jQuery 2.2.0 -->
    <script src="plugins/jQuery/jQuery-2.2.0.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>$.widget.bridge('uibutton', $.ui.button);</script>
    <!-- Bootstrap 3.3.6 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="plugins/morris/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
</body>
</html>