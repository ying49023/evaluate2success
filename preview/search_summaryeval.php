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
            </section>
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
                                        <center>ดูผลการประเมิน</center>
                                    </th>
                                    <th>
                                        <center>สถานะ</center>
                                    </th>

                                </tr>
                            </thead>
                            <tr>
                                <td>130911</td>
                                <td>น.ส. สมสวย เห็นงาม</td>
                                <td></td>
                                <td></td>

                                <td >
                                    <a href="summaryevaluation.php">
                                        <center>
                                            <i class="glyphicon glyphicon-eye-open"></i>
                                        </center>
                                    </a>
                                </td>
                                <td>
                                    <center> <font color="green" >ประเมินแล้ว</font>
                                    </center>
                                </td>
                            </tr>
                            <tr>
                                <td>130912</td>
                                <td>นาย ชัยเดช พ่วงเพชร</td>
                                <td></td>
                                <td></td>

                                <td >
                                    <a href="summaryevaluation.php">
                                        <center>
                                            <i class="glyphicon glyphicon-eye-open"></i>
                                        </center>
                                    </a>
                                </td>
                                <td>
                                    <center> <font color="red" >ยังไม่ประเมิน</font>
                                    </center>
                                </td>
                            </tr>
                            <tr>
                                <td>130913</td>
                                <td>นาย ศักดิ์ดา เกียรติกมล</td>
                                <td></td>
                                <td></td>

                                <td >
                                    <a href="summaryevaluation.php">
                                        <center>
                                            <i class="glyphicon glyphicon-eye-open"></i>
                                        </center>
                                    </a>
                                </td>
                                <td>
                                    <center>
                                        <font color="red" >ยังไม่ประเมิน</font>
                                    </center>
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

    
</body>
</html>
<?php
        }
    }
?>