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
        <center>
          <h1>แบบฟอร์มประเมินผลการปฏิบัติงาน</h1>
          <h3>แบบเน้น Competency, KPIs และ Development</h3>
        </center>

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
      <!--Step progress-->
      <div id="menu_status">
        <center>
          <ul class="nav nav-pills">
            <li class="bg-info" role="presentation" style="width:30%">
                <a href="evalstep1.php">ส่วนที่1 การวัความสามารถในการปฏิบัติงาน</a>
            </li>
            <li class="active" role="presentation" style="width:30%">
                <a href="prominent_page.php">ส่วนที่2 ความจำเป็นในการพัฒนา</a>
            </li>
            <li class="bg-info" role="presentation" class="active" style="width:30%">
                <a href="complete_page.php">การประเมินเรียบร้อย</a>
            </li>
          </ul>
        </center>
      </div>
      <!--/Step progress-->

      <!--ข้อมูลทั่วไป-->
          <div class="row box-padding">
            <div class="box box-success">
              <div class="box-header with-border">
                <h4 class="box-title" style="text-indent: 10px"> <b>ข้อมูลทั่วไปเกี่ยวกับผู้ถูกประเมิน</b>
                </h4>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"> <i class="fa fa-minus"></i>
                  </button>

                  <button type="button" class="btn btn-box-tool" data-widget="remove">
                    <i class="fa fa-times"></i>
                  </button>
                </div>
              </div>

              <div class="box-body">

                

                <div id="detail-content">

                  <TABLE class="table table-bordered " HEIGHT="120" WIDTH="90%"  >
                    <TR >
                      <td rowspan="4">
                        <div id="img-box">
                        <img class="img-circle img-thumbnail" src="img/emp1.jpg" alt="Smiley face" >
                      </div>
                      </td>
                      <TD > <b>ชื่อ</b>
                      </TD>
                      <TD colspan="2">นาย ศตวรรษ วินวิวัฒน์</TD>
                      <TD>
                        <b>รหัสพนักงาน</b>
                      </TD>
                      <TD colspan="2">123456</TD>
                    </TR>

                    <TR>
                      <TD>
                        <b>ตำแหน่ง</b>
                      </TD>
                      <TD colspan="2">พนักงานฝ่ายบุคคล</TD>
                      <TD>
                        <b>วันที่เริ่มงาน</b>
                      </TD>
                      <TD colspan="2">1 ก.พ. 2556</TD>
                    </TR>
                    <TR>
                      <TD>
                        <b>ฝ่าย/แผนก</b>
                      </TD>
                      <TD colspan="2">ฝ่ายบุคคล</TD>
                      <TD>
                        <b>ผู้บังคับบัญชาขั้นต้น</b>
                      </TD>
                      <TD colspan="2">นาย นภัทร อินทร์ใจเอื้อ</TD>
                    </TR>
                    <TR>
                      <TD>
                        <b>ครึ่งปีแรก(ม.ค.-มิ.ย.)</b>
                      </TD>
                      <TD colspan="2">
                        <span class="text-green">ประเมินแล้ว</span>
                      </TD>
                      <TD>
                        <b>ครึ่งปีหลัง(ก.ค.-ธ.ค.)</b>
                      </TD>
                      <TD colspan="2">-</TD>
                    </TR>
                  </TABLE>
                </div>
                <!--/ข้อมูลทั่วไป--> 
              </div>
            </div>
          </div>
  
        <div class="row box-padding">
          <div class="box box-primary">

            <div class="box-header with-border">

              <div >
                <form>
                  <table style="margin:30px 30px 30px 30px; width:90%; height:200px; " >
                    <tr>
                      <td>
                        <b>จุดเด่นของผู้ถูกประเมิน</b>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <input type="checkbox" name="prominent" value="planing">การวางแผน</td>
                      <td>
                        <input type="checkbox" name="prominent" value="trackingwork">การดำเนินตามแผนและติดตามผลงาน</td>
                      <td>
                        <input type="checkbox" name="prominent" value="problemsolving">การแก้ไขปัญหาและการตัดสินใจ</td>

                    </tr>
                    <tr>
                      <td>
                        <input type="checkbox" name="prominent" value="development">การพัฒนาผู้ใต้บัคับบัญชา</td>
                      <td>
                        <input type="checkbox" name="prominent" value="createteam">การสร้างทีมงาน</td>
                    </tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>

                    <tr>
                      <td>
                        <b>จุดที่ควรพัฒนาปรับปรุงของผู้ถูกประเมิน</b>
                      </td>
                    </tr>

                    <tr>
                      <td>
                        <input type="checkbox" name="weakness" value="planing">การวางแผน</td>
                      <td>
                        <input type="checkbox" name="weakness" value="trackingwork">การดำเนินตามแผนและติดตามผลงาน</td>
                      <td>
                        <input type="checkbox" name="weakness" value="problemsolving">การแก้ไขปัญหาและการตัดสินใจ</td>

                    </tr>
                    <tr>
                      <td>
                        <input type="checkbox" name="weakness" value="development">การพัฒนาผู้ใต้บัคับบัญชา</td>
                      <td>
                        <input type="checkbox" name="weakness" value="createteam">การสร้างทีมงาน</td>
                    </tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>

                    <tr>
                      <td>
                        <b>หลักสูตรการฝึกอบรมหรือแนวทางที่ควรพัฒนา</b>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <input type="checkbox" name="development" value="planing">อบรมทักษะการวางแผน</td>
                      <td>
                        <input type="checkbox" name="development" value="trackingwork">ปรับปรุงการติดตามผลงานและการทำงานให้อยุ่ภายในกำหนดเวลา</td>
                      <td>
                        <input type="checkbox" name="development" value="problemsolving">อบรมด้านการแก้ไขปัญหาและการตัดสินใจ</td>

                    </tr>
                    <tr>
                      <td>
                        <input type="checkbox" name="development" value="development">ปรับปรุงการพัฒนาผู้ใต้บัคับบัญชา</td>
                      <td>
                        <input type="checkbox" name="development" value="createteam">อบรมเกี่ยวกับการการสร้างทีมงาน</td>
                    </tr>

                  </table>

                </form>
                <div class="box-footer">
                  <center>
                  <a href="complete_page.php">
                    <button class="btn btn-success">ยืนยันการประเมิน</button>
                  </a>
                </center>
                </div>
                
              </div>
            </div>

          </div>
        </div>
      </div>
      <!--/ข้อมูลทั่วไป-->

      <!-- /.content-wrapper -->

      <!--Footer -->
      <?php include './footer.php'; ?>

      <!-- Control Sidebar -->
      <?php include './controlsidebar.php'; ?>

      <!-- Add the sidebar's background. This div must be placed
                 immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div>
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