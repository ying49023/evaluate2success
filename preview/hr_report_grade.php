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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--<link rel="stylesheet" href="bootstrap/css/metro.css">
    -->
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
                    ดูผลการประเมิน
                    <small>ค้นหาพนักงาน</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="#"> <i class="fa fa-dashboard"></i>
                            Home
                        </a>
                    </li>
                    <li class="active">Summary evaluation</li>
                </ol>
                <hr></section>
            <!--/Page header -->

            <!-- Main content -->
            <!--search-->
            <div class="row box-padding">
                <div class="box box-success">
                    <div class="box-body">
                        <form >
                            <div class="col-sm-3">
                                <label class="col-sm-6 control-label">รหัสพนักงาน</label>
                                <div class="col-sm-6">
                                    <input class="form-control" type="text" name="emp_id"></div>
                            </div>

                            <div class="col-md-4">
                                <label class="col-sm-5 control-label">ชื่อพนักงาน</label>
                                <div class="col-sm-7">
                                    <input class="form-control" type="text"  name="emp_id" ></div>
                            </div>
                            <div class="col-md-3">

                                <label class="col-sm-6 control-label">แผนก/ฝ่าย</label>
                                <div class="col-sm-6">
                                    <select class="form-control">
                                        <option>บุคคล/ฝ่ายบุคคล</option>
                                        <option>บริหาร/การเงิน</option>
                                        <option>บริหาร/บัญชี</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary search-button"> <i class="glyphicon glyphicon-search"></i>
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <!--/search-->

            <!--list employee-->
            <div class="row box-padding">
                <div class="box box-primary">

                    <div class="box-header with-border"> <b>ตารางข้อมูลพนักงาน</b>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>

                            <button type="button" class="btn btn-box-tool" data-widget="remove">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">

                        <table class="table table-bordered table-hover" width="90%" >
                            <thead>
                                <tr>
                                    <th>รหัสพนักงาน</th>
                                    <th>ชื่อพนักงาน</th>
                                    <th>ตำแหน่ง</th>
                                    <th>ฝ่าย/แผนก</th>
                                    <th>
                                        <center>เกรด</center>
                                    </th>
                                    <th>
                                        <center>ดูผลการประเมิน</center>
                                    </th>

                                </tr>
                            </thead>
                            <tr>
                                <td>130911</td>
                                <td>น.ส. สมสวย เห็นงาม</td>
                                <td>พนักงานทั่วไป</td>
                                <td>บุคคล/ฝ่ายบุคคล</td>
                                <td>
                                    <center>A</center>
                                </td>
                                <td >
                                    <a href="summaryevaluation.php">
                                        <center>
                                            <i class="glyphicon glyphicon-eye-open"></i>
                                        </center>
                                    </a>
                                </td>
                                
                            </tr>
                            <tr>
                                <td>130912</td>
                                <td>นาย ชัยเดช พ่วงเพชร</td>
                                <td>พนักงานทั่วไป</td>
                                <td>บุคคล/ฝ่ายบุคคล</td>
                                <td><center>B+</center></td>

                                <td>
                                    <a href="summaryevaluation.php">
                                        <center>
                                            <i class="glyphicon glyphicon-eye-open"></i>
                                        </center>
                                    </a>
                                </td>
                                
                            </tr>
                            <tr>
                                <td>130913</td>
                                <td>นาย ศักดิ์ดา เกียรติกมล</td>
                                <td>พนักงานทั่วไป</td>
                                <td>บุคคล/ฝ่ายบุคคล</td>
                                <td><center>B+</center></td>
                                 
                                <td >
                                    <a href="summaryevaluation.php">
                                        <center>
                                            <i class="glyphicon glyphicon-eye-open"></i>
                                        </center>
                                    </a>
                                </td>
                                
                            </tr>

                        </table>

                        <!-- /.chart-responsive --> </div>
                </div>
            </div>
            <!--/list employee-->

            <!-- /.content --> </div>
        <!-- /.content-wrapper -->

        <!--Footer -->
        <?php include './footer.php'; ?>

        <!-- Control Sidebar -->
        <?php include './controlsidebar.php'; ?>

        <!-- Add the sidebar's background. This div must be placed
                 immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->

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