<?php
    //General user
    session_start();
    //Check_login
    if($_SESSION["employee_id"]==''){
        echo "Please login again";
        echo "<a href='login.php'>Click Here to Login</a>";
        header("location:login.php");
    }else if($_SESSION["login_status"] != '0' ){
        echo "Login wrong level" ;
        header("location:hr/index.php");
    } else{
        $now = time(); // Checking the time now when home page starts.
//        echo $now." - session expire ".$_SESSION["expire"];
        if ($now > $_SESSION['expire']) {
            session_destroy();
            header("location:session_timeout.php");
            echo "Your session has expired! <a href='login.php'>Login here</a>";
        }else{
            //HTML PAGE
            ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ระบบประเมินผลปฏิบัติงาน : ALT Evaluation</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- CSS PACKS -->
    <?php include ('./css_packs.html'); ?>
    
    <!-- SCRIPT PACKS -->
    <?php include('./script_packs.html') ?>
    <style>
            .myDiv{
                height: 100%;
                width: 100%;
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
                <h1>
                    ติดตามสถานะการทำงาน
                    <small></small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="#"> <i class="fa fa-dashboard"></i>
                            Home
                        </a>
                    </li>
                    <li class="active">KPIs</li>
                </ol>
            </section>
            <!--/Page header -->

            <!-- Main content -->
            <div class="row box-padding">
                <div class="box box-success">
                    <div class="box-body">

                        <table class="table table-bordered table-condensed" width="90%" height="100px" align="right" >
                            <tr>
                                <th rowspan="2">
                                    <img class="img-circle img-thumbnail circle-thumbnail" src="img/emp1.jpg" alt="Smiley face" style="margin:10px 0px 0px 15px;"></th>
                                <th>
                                    <center>รหัสพนักงาน</center>
                                </th>
                                <th>
                                    <center>ชื่อพนักงาน</center>
                                </th>
                                <th>
                                    <center>ตำแหน่ง</center>
                                </th>
                                <th>
                                    <center>ฝ่าย/แผนก</center>
                                </th>
                                <th>
                                    <center>เป้าหมาย</center>
                                </th>
                                <th>
                                    <center>ค่าจริง</center>
                                </th>
                                <th>
                                    <center>เทียบกับเป้าหมาย</center>
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <center>123456</center>
                                </td>
                                <td>
                                    <center>นาย ศตวรรษ วินวิวัฒน์</center>
                                </td>
                                <td>
                                    <center>พนักงานฝ่ายบุคคล</center>
                                </td>
                                <td>
                                    <center>ฝ่ายบุคคล</center>
                                </td>
                                <th>
                                    <center>>=80%</center>
                                </th>
                                <th>
                                    <center>35.5%</center>
                                </th>
                                <th>
                                    <center></center>
                                </th>
                            </tr>

                        </table>
                    </div>

                </div>

            </div>
            <div class="row box-padding">
                <div class="row">
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
                                        value : 35.5,
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
                    <div class="col-md-8">
                        <div class="box box-primary">

                            <div class="box-header with-border">
                                <strong>รายการKPIs</strong>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="box-body" >
                                <table class="table table-bordered " width="90%" height="100px" border="1px">
                                    <tr>
                                        <th>No.</th>
                                        <th>KPIs</th>
                                        <th>
                                            <center>เป้าหมาย</center>
                                        </th>
                                        <th>
                                            <center>ค่าจริง</center>
                                        </th>
                                        <th>
                                            <center>สถานะ</center>
                                        </th>
                                        <th>
                                            <center>ดูรายละเอียด</center>
                                        </th>

                                    </tr>
                                    <tr>
                                        <th>1201</th>
                                        <th>ความสามารถในการสรรหาตรงตามเวลาที่กำหนด(60วัน)</th>
                                        <th>
                                            <center>>=80%</center>
                                        </th>
                                        <th>
                                            <center>60%</center>
                                        </th>
                                        <th>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" 
                                                style="width: 60%;">60%</div>
                                            </div>
                                        </th>
                                        <th>
                                            <center>
                                                <a href="tracking_sub_detail.php">
                                                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                                </a>
                                            </center>
                                        </th>

                                    </tr>
                                    <tr>
                                        <th>1202</th>
                                        <th>ความสามารถจัดทำอัตราแผนความสามารถกำลังคน</th>
                                        <th>
                                            <center>
                                                <20% </center></th>
                                                <th>
                                                    <center>14%</center>
                                                </th>
                                                <th>
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" aria-valuenow="14" aria-valuemin="0" aria-valuemax="100" 
                                                style="width: 14%;">14%</div>
                                                    </div>
                                                </th>
                                                <th>
                                                    <center>
                                                        <a href="tracking_sub_detail.php">
                                                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                                        </a>
                                                    </center>
                                                </th>
                                            </tr>

                                            <tr>
                                                <th>1203</th>
                                                <th>อัตราจำนวนชั่วโมงการฝึกอบรม/คน/ครึ่งปี</th>
                                                <th>
                                                    <center>>=6ชั่วโมง</center>
                                                </th>
                                                <th>
                                                    <center>2ชั่วโมง</center>
                                                </th>
                                                <th>
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100" 
                                                style="width: 33%;">33%</div>
                                                    </div>
                                                </th>
                                                <th>
                                                    <center>
                                                        <a href="">
                                                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                                        </a>
                                                    </center>
                                                </th>
                                            </tr>

                                            <tr>
                                                <th>1204</th>
                                                <th>การจัดปฐมนิเทศให้กับพนักงานใหม่ภายใน 3 วันทำการ</th>
                                                <th>
                                                    <center>100%</center>
                                                </th>
                                                <th>
                                                    <center>35%</center>
                                                </th>
                                                <th>
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100" 
                                                style="width: 35%;">35%</div>
                                                    </div>
                                                </th>
                                                <th>
                                                    <center>
                                                        <a href="">
                                                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                                        </a>
                                                    </center>
                                                </th>

                                            </tr>

                                        </table>

                                    </div>
                                </div>
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

        
</body>
</html>
    <?php
        }
    }
?>