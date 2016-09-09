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
                    ดูภาพรวมรายบุคคล
                    <small>แดชบอร์ด</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="#"> <i class="fa fa-dashboard"></i>
                            Home
                        </a>
                    </li>
                    <li class="active">Personal dashboard</li>
                </ol>
            </section>
            <!--/Page header -->

            <!-- Main content -->
            <!--header search filter-->
            <div class="row box-padding">
                <div class="box box-success">
                    <div class="box-body">
                        <form>
                            <div class="col-sm-4">
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
                            <div class="col-md-1">
                                <button class="btn btn-primary search-button" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <!--/header search filer-->

            <!--list employee-->
                <div class="row box-padding">
                        <div class="box box-primary">

                            <div class="box-header with-border">
                                <b>ตารางข้อมูลพนักงาน</b>
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
                                        <th width="100px">รหัสพนักงาน</th>
                                        <th>ชื่อพนักงาน</th>
                                        <th width="150px"><center>ตำแหน่ง</center></th>
                                        <th width="150px"><center>ฝ่าย/แผนก</center></th>
                                        <th width="100px"><center>ดูผลงาน</center></th>
                                        <th width="120px"><center>ความสำเร็จ(%)</center></th>
                                        <th width="50px">ติดตาม</th>   
                                    </tr>
                                </thead>
                                    <tr>
                                        <td>123456</td>
                                        <td>นาย ศตวรรษ วินวิวัฒน์</td>
                                        <td class="text-center" >พนักงานทั่วไป</td>
                                        <td class="text-center" >ฝ่ายบัญชี</td>
                                        <td width="100px">
                                            <div class="progress progress-xs progress-striped active">
                                                <div class="progress-bar progress-bar-primary" style="width: 35.5%"></div>
                                            </div>
                                        </td>
                                        <td class="text-center" >
                                            <span class="badge bg-blue ">35.5%</span>
                                        </td>
                                        <td>
                                            <a href="tracking_sub_kpi.php">    
                                            <center><span class="glyphicon glyphicon-search" aria-hidden="true"></span></center>
                                            </a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>130911</td>
                                        <td>น.ส. สมสวย เห็นงาม</td>
                                        <td class="text-center" >พนักงานทั่วไป</td>
                                        <td class="text-center" >ฝ่ายบัญชี</td>
                                        <td width="100px">
                                            <div class="progress progress-xs progress-striped active">
                                                <div class="progress-bar progress-bar-success" style="width: 90%"></div>
                                            </div>
                                        </td>
                                        <td class="text-center" >
                                            <span class="badge bg-green">90%</span>
                                        </td>
                                        <td>
                                            <a href="tracking_sub_kpi.php">    
                                            <center><span class="glyphicon glyphicon-search" aria-hidden="true"></span></center>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>130912</td>
                                        <td>นาย ชัยเดช พ่วงเพชร</td>
                                        <td class="text-center" >พนักงานทั่วไป</td>
                                        <td class="text-center" >ฝ่ายบัญชี</td>
                                        <td width="100px">
                                            <div class="progress progress-xs progress-striped active">
                                                <div class="progress-bar progress-bar-warning" style="width: 55%"></div>
                                            </div>
                                        </td>
                                        <td class="text-center" >
                                            <span class="badge bg-orange">55%</span>
                                        </td>
                                        <td>
                                            <a href="tracking_sub_kpi.php">    
                                            <center><span class="glyphicon glyphicon-search" aria-hidden="true"></span></center>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>130913</td>
                                        <td>นาย ศักดิ์ดา เกียรติกมล</td>
                                        <td class="text-center" >พนักงานทั่วไป</td>
                                        <td class="text-center" >ฝ่ายบัญชี</td>
                                        <td width="100px">
                                            <div class="progress progress-xs progress-striped active">
                                                <div class="progress-bar progress-bar-primary" style="width: 30%"></div>
                                            </div>
                                        </td>
                                        <td class="text-center" >
                                            <span class="badge bg-blue ">30%</span>
                                        </td>
                                        <td>
                                            <a href="tracking_sub_kpi.php">    
                                            <center><span class="glyphicon glyphicon-search" aria-hidden="true"></span></center>
                                            </a>
                                        </td>
                                    </tr>
                                    
                                </table>

                                
                                
                                <!-- /.chart-responsive -->
                            </div>
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