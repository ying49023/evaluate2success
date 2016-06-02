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
        <link rel="stylesheet" href="customize.css">

    </head>
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
                        เปรียบเทียบย้อนหลัง
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Comparision</li>
                    </ol>
                    <hr>
                </section>
                <!--/Page header -->

                <!-- Main content -->
                <div class="row box-padding">
                    <div class="box box-success">
                        <div class="box-body ">
                            <form >
                                <div class="col-sm-5">
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

                                <div class="col-md-5 ">
                                    <label class="col-sm-7 control-label">รอบการประเมิน</label>
                                    <div class="col-sm-5">
                                        <select class="form-control">
                                            <option>ครั้งที่ 1 </option>
                                            <option>ครั้งที่ 2 </option>
                                        </select>
                                    </div>                               
                                </div>
                                <div class="col-md-2 ">
                                    <button class="btn btn-default search-button" type="submit">เพิ่ม +</button>
                                </div>

                            </form>
                        </div>
                        <div class="">
                            <table class="table table-bordered">
                                <tr>
                                    <td>1</td>
                                    <td><a href="">ปี 2559 ครั้งที่ 1</a></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><a href="">ปี 2558 ครั้งที่ 1</a></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><a href="">ปี 2557 ครั้งที่ 1</a></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><a href=""></a></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row box-padding">
                    <div class="box box-default">

                        <div class="box-body box-padding-table">    
                            <div id="bar-example"></div>
                            <script>
                                /*
                                 * Play with this code and it'll update in the panel opposite.
                                 *
                                 * Why not try some of the options above?
                                 */
                                Morris.Bar({
                                    element: 'bar-example',
                                    data: [
                                        {y: '2006', a: 100, b: 90},
                                        {y: '2007', a: 75, b: 65},
                                        {y: '2008', a: 50, b: 40},
                                        {y: '2009', a: 75, b: 65},
                                        {y: '2010', a: 50, b: 40},
                                        {y: '2011', a: 75, b: 65},
                                        {y: '2012', a: 100, b: 90}
                                    ],
                                    xkey: 'y',
                                    ykeys: ['a', 'b'],
                                    labels: ['Series A', 'Series B']
                                });
                            </script>
                        </div>

                    </div>
                </div>

                <!-- /.content -->
            </div>
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

        <!-- jQuery 2.2.0 -->
        <script src="plugins/jQuery/jQuery-2.2.0.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
                                $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.6 -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <!-- Morris.js charts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="plugins/morris/morris.js"></script>
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
