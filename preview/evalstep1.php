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

    <style>

            table.table tr td,th{
                text-align: center;
            }

        </style>
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

                <h1>แบบฟอร์มประเมินผลการปฏิบัติงาน<small>แบบเน้น Competency, KPIs และ Development</small></h1>
                
                <ol class="breadcrumb">
                    <li>
                        <a href="#"> <i class="fa fa-dashboard"></i>
                            Home
                        </a>
                    </li>
                    <li class="active">Evaluation</li>
                </ol>
                <hr>
            </section>
            <!--/Page header -->

            <!-- Main content -->
            
            <div id="menu_status">
                <center>
                    <ul class="nav nav-pills">
                        <li class="active" role="presentation" style="width:30%">
                            <a href="evalstep1.php">ส่วนที่1 การวัความสามารถในการปฏิบัติงาน</a>
                        </li>
                        <li class="bg-info" role="presentation" style="width:30%">
                            <a href="prominent_page.php">ส่วนที่2 ความจำเป็นในการพัฒนา</a>
                        </li>
                        <li class="bg-info" role="presentation" class="active" style="width:30%">
                            <a href="complete_page.php">การประเมินเรียบร้อย</a>
                        </li>
                    </ul>

                </center>
            </div>
            <!--/Process bar-->
            
            <div class="row box-padding">
                <div class="box box-success">
                    <div class="box-body">
                        <div class="row"> 
                            <div class="box-padding">
                                <!--ข้อมูลทั่วไป-->
                                <table class="table table-bordered table-condensed">
                                    <tbody><tr>
                                            <th rowspan="4">
                                                <img class="circle-thumbnail img-circle img-responsive img-thumbnail" src="img/emp1.jpg">
                                            </th>
                                            <th align="center" width="">ชื่อ-นามสกุล</th>
                                            <th align="center" width="120px">รหัส</th>
                                            <th align="center" width="">ตำแหน่ง</th>
                                            <th align="center" width="">แผนก</th>
                                            <th align="center" width="">ครั้งที่ 1 </th>

                                        </tr>
                                        <tr>
                                            <td>นาย ศตวรรษ วินวิวัฒน์</td>
                                            <td> 123456</td>
                                            <td>พนักงานฝ่ายบุคคล</td>
                                            <td>ฝ่ายบุคคล</td>
                                            <td><span class="text-green"><i class="glyphicon glyphicon-ok"></i></span></td>
                                        </tr>
                                    </tbody>
                                </table><!--/ข้อมูลทั่วไป-->
                                <a class="" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                    <i class="glyphicon glyphicon-triangle-bottom"></i>รายละเอียดบุคคลเพิ่มเติม
                                </a>
                                <div class="collapse" id="collapseExample" style="margin-top:10px;">
                                    <table class="table table-responsive table-bordered ">
                                        <thead>
                                            <tr class="">
                                                <th colspan="3">วันที่เริ่มงาน</th>
                                                <th colspan="3">ผู้บังคับบัญชา</th>
                                            </tr>
                                        </thead>
                                        <tr>
                                            <td colspan="3">1 ก.พ. 2556</td>
                                            <td colspan="3">นาย นภัทร อินทร์ใจเอื้อ</td>
                                        </tr>
                                        <thead>
                                            <tr class="">
                                                <th colspan="6">
                                                    สถิติการมาปฏิบัติงาน
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>ลาป่วย</th>
                                                <th>ลากิจ</th>
                                                <th>ลาอื่นๆ</th>
                                                <th>ขาดงาน</th>
                                                <th>ลางาน</th>
                                                <th width="16%">ลงโทษทางวินัย</th>
                                            </tr>
                                        </thead>
                                        <TR>
                                            <TD>1วัน</TD>
                                            <TD>1วัน</TD>
                                            <TD>-</TD>
                                            <TD>-</TD>
                                            <TD>2วัน</TD>
                                            <TD>-</TD>
                                        </TR>
                                    </table>
                                </div>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>

            <!--555555555555555555555555555555555-->

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
                                    <TABLE class="table table-bordered" HEIGHT="100" WIDTH="100%" border="1" >
                                        <thead>
                                            <TR>
                                                <th style="padding-top:25px;" rowspan="2" colspan="4">ความสามารถ(Competency)</th>
                                                <th style="padding-top:25px;" rowspan="2" >%น้ำหนัก(W)</th>
                                                <th colspan="2">ระดับที่คาดหวัง (E)</th>
                                                <th colspan="6">ระดับที่ทำจริง (A)</th>
                                            </TR>
                                            <tr>
                                                <td>ระดับ</td>
                                                <td>รวม</td>
                                                <td>1</td>
                                                <td>2</td>
                                                <td>3</td>
                                                <td>4</td>
                                                <td>5</td>
                                                <td>รวม</td>
                                            </tr>
                                        </thead>
                                        <TR>
                                            <th colspan="13">
                                                ความสามารถในการปฏิบัติงาน (Competency) - ผู้บังคับบัญชากรุณาทำความเข้าใจ "คำอธิบายระดับความสามารถ" เพื่อประเมินได้ถูกต้อง
                                            </th>
                                        </TR>

                                        <TR>
                                            <th style="text-align:left"  colspan="13">ความสามารถในการบริหารหรือจัดการงาน (10%)</th>

                                        </TR>
                                        <TR>
                                            <td style="text-align:left" colspan="4">1. การวางแผนงาน</td>

                                            <td >3</td>
                                            <td >2</td>
                                            <td >6</td>
                                            <td >
                                                <input type="radio" name="optradio"></td>
                                            <td >
                                                <input type="radio" name="optradio"></td>
                                            <td >
                                                <input type="radio" name="optradio"></td>
                                            <td >
                                                <input type="radio" name="optradio"></td>
                                            <td >
                                                <input type="radio" name="optradio"></td>
                                            <td ></td>
                                        </TR>
                                        <TR>
                                            <td style="text-align:left" colspan="4">2. การดำเนินการตามแผนและติดตามผลงาน</td>

                                            <td >3</td>
                                            <td >3</td>
                                            <td >9</td>
                                            <td >
                                                <input type="radio" name="optradio2"></td>
                                            <td >
                                                <input type="radio" name="optradio2"></td>
                                            <td >
                                                <input type="radio" name="optradio2"></td>
                                            <td >
                                                <input type="radio" name="optradio2"></td>
                                            <td >
                                                <input type="radio" name="optradio2"></td>
                                            <td ></td>
                                        </TR>
                                        <TR>
                                            <td style="text-align:left" colspan="4">3. การแก้ไขปัญหาและการตัดสินใจ</td>

                                            <td >3</td>
                                            <td >3</td>
                                            <td >9</td>
                                            <td >
                                                <input type="radio" name="optradio3"></td>
                                            <td >
                                                <input type="radio" name="optradio3"></td>
                                            <td >
                                                <input type="radio" name="optradio3"></td>
                                            <td >
                                                <input type="radio" name="optradio3"></td>
                                            <td >
                                                <input type="radio" name="optradio3"></td>
                                            <td ></td>
                                        </TR>
                                        <TR>
                                            <td style="text-align:left" colspan="4">4. การพัฒนาผู้ใต้บังคับบัญชา</td>

                                            <td >2</td>
                                            <td >2</td>
                                            <td >4</td>
                                            <td >
                                                <input type="radio" name="optradio4"></td>
                                            <td >
                                                <input type="radio" name="optradio4"></td>
                                            <td >
                                                <input type="radio" name="optradio4"></td>
                                            <td >
                                                <input type="radio" name="optradio4"></td>
                                            <td >
                                                <input type="radio" name="optradio4"></td>
                                            <td ></td>
                                        </TR>
                                        <TR>
                                            <td style="text-align:left" colspan="4">5. การสร้างทีมงาน</td>

                                            <td >1</td>
                                            <td >3</td>
                                            <td >3</td>
                                            <td >
                                                <input type="radio" name="optradio5"></td>
                                            <td >
                                                <input type="radio" name="optradio5"></td>
                                            <td >
                                                <input type="radio" name="optradio5"></td>
                                            <td >
                                                <input type="radio" name="optradio5"></td>
                                            <td >
                                                <input type="radio" name="optradio5"></td>
                                            <td ></td>
                                        </TR>

                                        <TR>
                                            <th style="text-align:left" colspan="13">ความสามารถในงาน (ความรู้ ,ทักษะ ,คุณสมบัติเฉพาะบุคคล) (20%)</th>

                                        </TR>
                                        <TR>
                                            <td style="text-align:left" colspan="4">6. ความรู้ความเข้าใจในหน้าที่งานที่รับผิดชอบ</td>

                                            <td >4</td>
                                            <td >3</td>
                                            <td >12</td>
                                            <td >
                                                <input type="radio" name="optradio6"></td>
                                            <td >
                                                <input type="radio" name="optradio6"></td>
                                            <td >
                                                <input type="radio" name="optradio6"></td>
                                            <td >
                                                <input type="radio" name="optradio6"></td>
                                            <td >
                                                <input type="radio" name="optradio6"></td>
                                            <td ></td>
                                        </TR>
                                        <TR>
                                            <td style="text-align:left" colspan="4">7. ความละเอียดรอบคอบ</td>

                                            <td >4</td>
                                            <td >3</td>
                                            <td >12</td>
                                            <td >
                                                <input type="radio" name="optradio7"></td>
                                            <td >
                                                <input type="radio" name="optradio7"></td>
                                            <td >
                                                <input type="radio" name="optradio7"></td>
                                            <td >
                                                <input type="radio" name="optradio7"></td>
                                            <td >
                                                <input type="radio" name="optradio7"></td>
                                            <td ></td>
                                        </TR>
                                        <TR>
                                            <td style="text-align:left" colspan="4">8. ความสามารถในการสื่อสาร</td>

                                            <td >1</td>
                                            <td >3</td>
                                            <td >3</td>
                                            <td >
                                                <input type="radio" name="optradio8"></td>
                                            <td >
                                                <input type="radio" name="optradio8"></td>
                                            <td >
                                                <input type="radio" name="optradio8"></td>
                                            <td >
                                                <input type="radio" name="optradio8"></td>
                                            <td >
                                                <input type="radio" name="optradio8"></td>
                                            <td ></td>
                                        </TR>
                                        <TR>
                                            <td style="text-align:left" colspan="4">9. มนุษยสัมพันธ์ในการทำงาน</td>

                                            <td >2</td>
                                            <td >3</td>
                                            <td >6</td>
                                            <td >
                                                <input type="radio" name="optradio9"></td>
                                            <td >
                                                <input type="radio" name="optradio9"></td>
                                            <td >
                                                <input type="radio" name="optradio9"></td>
                                            <td >
                                                <input type="radio" name="optradio9"></td>
                                            <td >
                                                <input type="radio" name="optradio9"></td>
                                            <td ></td>
                                        </TR>
                                        <TR>
                                            <td style="text-align:left" colspan="4">10. การบริหารจัดการรายงานและเอกสารต่างๆ</td>

                                            <td >3</td>
                                            <td >3</td>
                                            <td >9</td>
                                            <td >
                                                <input type="radio" name="optradio10"></td>
                                            <td >
                                                <input type="radio" name="optradio10"></td>
                                            <td >
                                                <input type="radio" name="optradio10"></td>
                                            <td >
                                                <input type="radio" name="optradio10"></td>
                                            <td >
                                                <input type="radio" name="optradio10"></td>
                                            <td ></td>
                                        </TR>

                                        <TR>
                                            <td style="text-align:left" colspan="4">11. ความรับผิดชอบและไว้วางใจได้</td>

                                            <td >4</td>
                                            <td >2</td>
                                            <td >8</td>
                                            <td >
                                                <input type="radio" name="optradio11"></td>
                                            <td >
                                                <input type="radio" name="optradio11"></td>
                                            <td >
                                                <input type="radio" name="optradio11"></td>
                                            <td >
                                                <input type="radio" name="optradio11"></td>
                                            <td >
                                                <input type="radio" name="optradio11"></td>
                                            <td ></td>
                                        </TR>
                                        <TR>
                                            <td style="text-align:left" colspan="4">12. ความร่วมมือต่อทั้งผู้บังคับบัญชาและบริษัทฯ</td>

                                            <td >2</td>
                                            <td >3</td>
                                            <td >6</td>
                                            <td >
                                                <input type="radio" name="optradio12"></td>
                                            <td >
                                                <input type="radio" name="optradio12"></td>
                                            <td >
                                                <input type="radio" name="optradio12"></td>
                                            <td >
                                                <input type="radio" name="optradio12"></td>
                                            <td >
                                                <input type="radio" name="optradio12"></td>
                                            <td ></td>
                                        </TR>
                                        <TR>
                                            <th colspan="4">รวม</th>

                                            <td >30</td>
                                            <td ></td>
                                            <td >83</td>
                                            <td colspan="6"></td>

                                        </TR>
                                    </TABLE>

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
            <!-- Add the sidebar's background. This div must be placed
                                 immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>

        </div>
    </div>
</div>
<!--Finish body content-wrapper-->

<!--Footer -->
<?php include './footer.php'; ?>

<!-- Control Sidebar -->
<?php include './controlsidebar.php'; ?></div>
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