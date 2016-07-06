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
        <script src="dist/js/circleDonutChart.js"></script>

        <script type="text/javascript">
        window.onload = function () {
            var chart = new CanvasJS.Chart("chartContainer", {
                title: {
                    text: "KPI 1201 -ความสามารถในการสรรหาคนได้ตามเวลาที่กำหนด"
                },
                data: [{
                    type: "column",
                    dataPoints: [
                        { y: 1, label: "มกราคม" },
                        { y: 2, label: "กุมภาพันธ์" },
                        { y: 4, label: "มีนาคม" },
                        { y: 5, label: "เมษายน" },
                        { y: 6, label: "พฤษภาคม" }
                    ]
                }]
            });
            chart.render();
        }
    </script>
    <script src="canvasjs.min.js"></script>


        
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
                        จัดการระบบประเมิน
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Manage evaluation</li>
                    </ol>
                </section>
                <!--/Page header -->

                <!-- Main content -->
                  <div class="row box-padding ">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <b>การวัดความสามารถ (Competency)</b>
                            ในการปฏิบัติงานตามตำแหน่งงานของพนักงานในระดับนี้ที่บริษัทกำหนดไว้ (career level)
                        </h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!--box-body-->
                    <div class="box-body">
                        <!-- /.row -->
                        <div class="row">
                            <div class="box-padding-small">
                                <center>
                                    <table class="table table-bordered" height="100" width="100%" border="1">
                                        <thead>
                                            <tr>
                                                <th style="padding-top:25px;" colspan="">ความสามารถ(Competency)</th>
                                                <th style="padding-top:25px;">%น้ำหนัก(W)</th>
                                                <th>ระดับที่คาดหวัง (E)</th>
                                            </tr>                                     
                                        </thead>
                                        <tbody><tr>
                                            <th colspan="3">
                                                ความสามารถในการปฏิบัติงาน (Competency) - ผู้บังคับบัญชากรุณาทำความเข้าใจ "คำอธิบายระดับความสามารถ" เพื่อประเมินได้ถูกต้อง
                                            </th>
                                        </tr>
                                        <tr>
                                            <th style="text-align:left" colspan="3">ความสามารถในการบริหารหรือจัดการงาน (10%)</th>
                                        </tr>
                                        <tr>
                                            <td style="text-align:left" colspan="4">1. การวางแผนงาน</td>                                                  
                                        </tr>
                                        <tr>
                                            <td style="text-align:left" colspan="4">2. การดำเนินการตามแผนและติดตามผลงาน</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:left" colspan="4">3. การแก้ไขปัญหาและการตัดสินใจ</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:left" colspan="4">4. การพัฒนาผู้ใต้บังคับบัญชา</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:left" colspan="4">5. การสร้างทีมงาน</td>
                                        </tr>

                                        <tr>
                                            <th style="text-align:left" colspan="3">ความสามารถในงาน (ความรู้ ,ทักษะ ,คุณสมบัติเฉพาะบุคคล) (20%)</th>

                                        </tr>
                                        <tr>
                                            <td style="text-align:left" colspan="4">6. ความรู้ความเข้าใจในหน้าที่งานที่รับผิดชอบ</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:left" colspan="4">7. ความละเอียดรอบคอบ</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:left" colspan="4">8. ความสามารถในการสื่อสาร</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:left" colspan="4">9. มนุษยสัมพันธ์ในการทำงาน</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:left" colspan="4">10. การบริหารจัดการรายงานและเอกสารต่างๆ</td>
                                        </tr>

                                        <tr>
                                            <td style="text-align:left" colspan="4">11. ความรับผิดชอบและไว้วางใจได้</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:left" colspan="4">12. ความร่วมมือต่อทั้งผู้บังคับบัญชาและบริษัทฯ</td>

                                        </tr>
                                        
                                    </tbody>
                                    </table>

                                </center>

                            </div>

                        </div>

                    </div>
                    <!-- ./box-body -->
                    <!-- /.content -->

                    <!--box footer-->
                    <div class="box-footer">
                        <button class="btn btn-success">บันทึกข้อมูล</button>
                        <a href="prominent_page.php">
                            <button class="btn btn-instagram pull-right">หน้าถัดไป</button>
                        </a>
                    </div>
                    <!--/box footer--> </div>

                <!-- /.content-wrapper --> </div>
                <div class="row box-padding">
                    <div class="box box-default ">
                        <div class="box-header with-border">

                            <b>ข้อมูลความก้าวหน้าของงาน</b>
                        </div>
                        <div class="box-body">    
                            <div class="row">
                                <div class="col-md-3" style="margin:50px 0px 0px 0px;">
                                    <div id="example" >
                                        
                                        <script >
                                            var circle = new circleDonutChart('example');
                                                    circle.draw({
                                                    end:60,
                                                    start:0, 
                                                    maxValue:100, 
                                                    titlePosition:"outer-top", 
                                                    titleText:"สถานะปัจจุบัน", 
                                                    outerCircleColor:'#0085c8', 
                                                    innerCircleColor:'#909081'
                                                    });

                                        </script>
                                    </div>

                                </div>
                                <div class="col-md-9">
                                    <div class="box-padding">
                                        <div id="chartContainer" style="height: 400px; width: 100%;"></div>
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
                                <strong>ประวัติการอัพเดต KPIs</strong>
                            </p>
                        </div>  
                        <form method="get" action="compareevaluation.php" >
                            <div class="box-body box-padding-table"> 

                                <table class="table table-bordered">
                                    <tr class="bg-gray-light">
                                        <td class="text-center">ลำดับ</td>
                                        <td class="text-center">วันที่</td>
                                        <td class="text-center">KPIs</td>
                                        <td class="text-center">เป้าหมาย</td>
                                        <td class="text-center">ค่าจริง</td>
                                        <td class="text-center">อัพเดท</td>
                                        <td class="text-center">คำอธิบาย</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td class="text-center">30 ม.ค. 59</td>
                                        <td class="text-center">2001</td>
                                        <td class="text-center">10 คน</td>
                                        <td class="text-center">1 คน</td>
                                        <td class="text-center">1 คน</td>
                                        <td class="text-center"> </td>
                                    </tr>
                                    <tr>
                                         <td class="text-center">2</td>
                                        <td class="text-center">30 ก.พ. 59</td>
                                        <td class="text-center">2001</td>
                                        <td class="text-center">10 คน</td>
                                        <td class="text-center">2 คน</td>
                                        <td class="text-center">1 คน</td>
                                        <td class="text-center"> </td>
                                    </tr>
                                    <tr>
                                         <td class="text-center">3</td>
                                        <td class="text-center">30 มี.ค. 59</td>
                                        <td class="text-center">2001</td>
                                        <td class="text-center">10 คน</td>
                                        <td class="text-center">4 คน</td>
                                        <td class="text-center">2 คน</td>
                                        <td class="text-center"> </td>
                                    </tr>
                                    <tr>
                                         <td class="text-center">4</td>
                                        <td class="text-center">30 เม.ย. 59</td>
                                        <td class="text-center">2001</td>
                                        <td class="text-center">10 คน</td>
                                        <td class="text-center">5 คน</td>
                                        <td class="text-center">1 คน</td>
                                        <td class="text-center"> </td>
                                    </tr>
                                    <tr >

                                         <td class="text-center">5</td>
                                        <td class="text-center">30 พ.ค. 59</td>
                                        <td class="text-center">2001</td>
                                        <td class="text-center">10 คน</td>
                                        <td class="text-center">6 คน</td>
                                        <td class="text-center">1 คน</td>
                                        <td class="text-center"> </td>
                                    </tr>
                                </table>

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
