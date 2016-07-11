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
                    อนุมัติKPIs
                    <small>รอบที่ 2 2559</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="#"> <i class="fa fa-dashboard"></i>
                            Home
                        </a>
                    </li>
                    <li class="active">Assign KPIs</li>
                </ol>
                </section>
            <!--/Page header -->

            <!-- Main content -->
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
            <div class="row box-padding" style="margin-top: -20px;">
                <h3>KPIs สำหรับการประเมินในรอบ ก.ค.-ธ.ค. 59</h3>
            </div>
            <div class="row box-padding">
                <div class="box box-primary">
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr class="bg-primary  ">
                                <td>รหัส</td>
                                <td>ชื่อตัวชี้วัด</td>
                                <td>คำอธิบาย</td>
                                <td width="60px">น้ำหนัก</td>
                                <td width="70px">เป้าหมาย</td>
                                <td width="80px">การจัดการ</td>
                            </tr>
                            <tr>
                                <td>1201</td>
                                <td>ความสามารถในการสรรหาตรงตามเวลาที่กำหนด(60วัน)</td>
                                <td>
                                    ภายในหนึ่งสัปดาห์ต้องมีความคืบหน้าและ อัพเดตงานอย่างต่อเนื่อง
                                </td>
                                <td>20%</td>
                                <td>>=80%</td>
                                <td class="text-center">
                                    <a href="">
                                        <i class="glyphicon glyphicon-pencil"></i>
                                    </a>
                                    |
                                    <a href="">
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>1202</td>
                                <td>เความสามารถจัดทำอัตราแผนความสามารถกำลังคน</td>
                                <td>
                                    ภายในหนึ่งสัปดาห์ต้องมีความคืบหน้าและ อัพเดตงานอย่างต่อเนื่อง
                                </td>
                                <td>20%</td>
                                <td><20%</td>
                                <td class="text-center">
                                    <a href="">
                                        <i class="glyphicon glyphicon-pencil"></i>
                                    </a>
                                    |
                                    <a href="">
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </a>
                                </td>

                            </tr>
                            <tr>
                                <td>1203</td>
                                <td>อัตราจำนวนชั่วโมงการฝึกอบรม/คน/ครึ่งปี</td>
                                <td>
                                    ภายในหนึ่งสัปดาห์ต้องมีความคืบหน้าและ อัพเดตงานอย่างต่อเนื่อง
                                </td>
                                <td>20%</td>
                                <td>>=6ชั่วโมง</td>
                                <td class="text-center">
                                    <a href="">
                                        <i class="glyphicon glyphicon-pencil"></i>
                                    </a>
                                    |
                                    <a href="">
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>1204</td>
                                <td>การจัดปฐมนิเทศให้กับพนักงานใหม่ภายใน 3 วันทำการ</td>
                                <td>
                                    ภายในหนึ่งสัปดาห์ต้องมีความคืบหน้าและ อัพเดตงานอย่างต่อเนื่อง
                                </td>
                                <td>20%</td>
                                <td>35%</td>
                                <td class="text-center">
                                    <a href="">
                                        <i class="glyphicon glyphicon-pencil"></i>
                                    </a>
                                    |
                                    <a href="">
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="box-footer">
                        <button class="btn btn-success pull-right">ยืนยันการอนุมัติ</button>
                    </div>
                </div>

            </div>
            <div class="row box-padding">
                <div class="box box-primary">
                    <div class="box-header with-border"> <b>เพิ่มเติม/แก้ไขKPI</b>
                    </div>
                    <div class="box-body box-padding-small">
                        <form action="">
                            <div class="row">
                                <div class="form-group col-sm-7">
                                    <label class="control-label pull-left">ชื่อ KPI</label>
                                    <div class="">
                                        <select class="form-control">
                                            <option>KPI1-</option>
                                            <option>KPI2-</option>
                                            <option>KPI3-</option>
                                            <option>KPI4-</option>
                                            <option>KPI5-</option>
                                            <option>KPI6-</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-2">
                                    <label class="control-label pull-left">น้ำหนัก(%)</label>
                                        <input class="form-control" type="text">
                                </div>
                                <div class="form-group col-sm-3">
                                    <label class="control-label pull-left">เป้าหมาย</label>
                                        <input class="form-control" type="text">
                                </div>
                                <div class="form-group col-sm-2">
                                    <label class="control-label pull-left">หน่วย</label>
                                    <input class="form-control" type="text" placeholder="(เปลี่ยนตามหัวข้อKPI)" readonly="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <button class="btn btn-file">เพิ่ม</button>
                                    <button class="btn btn-microsoft">บันทึก</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

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