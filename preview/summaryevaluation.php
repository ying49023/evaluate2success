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
                        ดูผลการประเมิน
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">summary evaluation</li>
                    </ol>
                    <hr>
                </section>
                <!--/Page header -->

                <!-- Main content -->
                <div class="row box-padding">
                    <div class="box box-default ">
                        <div class="box-header with-border">
                            <b>รอบการประเมิน 2/2559</b>
                        </div>
                        <div class="box-body">    
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="box-padding">
                                        <img class="circle-thumbnail img-circle img-responsive img-thumbnail" src="dist/img/avatar2.png" >
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="box-padding">
                                        <table class="table">
                                            <tr>
                                                <td>ชื่อ-นามสกุล :</td>
                                                <td> Mr.sitisak  jomjai</td>
                                                <td>รหัส :</td>
                                                <td> 12345</td>
                                            </tr>
                                            <tr>
                                                <td>ตำแหน่ง :</td>
                                                <td>พนักงานทั่วไป</td>
                                                <td>แผนก :</td>
                                                <td>programmer</td>
                                            </tr>
                                            <tr>
                                                <td>วันที่เริ่มงาน :</td>
                                                <td>12 ธ.ค. 2549</td>
                                                <td>ผู้บังคับบัญชาชั้นต้น :</td>
                                                <td>นายอนุสร สถาน</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row box-padding">
                    <div class="box box-default">
                        <div class="box-header">
                            <p class="text-center">
                                <strong>ผลสรุปคะแนนประเมินเมื่อวันที่  15 ก.ค. 2558</strong>
                            </p>
                        </div>  
                        <form method="get" action="compareevaluation.php" >
                            <div class="box-body box-padding-table"> 

                                <table class="table table-bordered">
                                    <tr class="bg-gray-light">
                                        <td class="text-center">ส่วน</td>
                                        <td>หัวข้อการประเมิน</td>
                                        <td class="text-center">คะแนน</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td>คะแนนวันลา(10%)</td>
                                        <td class="text-center">1.5</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">2</td>
                                        <td>การประเมินประสิทธิภาพส่วนบุคคล(40%)</td>
                                        <td class="text-center">2</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">3</td>
                                        <td>คะแนนดัชนีชี้วัดKPIs(50%)</td>
                                        <td class="text-center">1.5</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">คะแนนรวม</td>
                                        <td class="text-center">5</td>
                                    </tr>
                                    <tr >

                                        <td colspan="2"><strong>ผลการประเมิน</strong></td>
                                        <td class="bg-green text-center"><strong>A+</strong></td>
                                    </tr>
                                </table>

                            </div>
                            <div class="box-footer">
                                <div class="pull-right box-padding">
                                    <button class="btn btn-foursquare" type="submit" onclick="window.location.href='compareevaluation.php'"  >เปรียบเทียบย้อนหลัง</button>
                                </div>
                            </div>
                        </form>
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
