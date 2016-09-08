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
                        <small>รอบการประเมิน 2/2559</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Summary evaluation</li>
                    </ol>
                </section>
                <!--/Page header -->

                <!-- Main content -->
                <div class="row box-padding">
                    <div class="box box-primary ">
                        <div class="box-body">
                            <div class="row">
                                    <div class="box-padding">
                                        <table class="table table-bordered table-condensed">
                                            <tr>
                                                <th rowspan="4">
                                                <img class="circle-thumbnail img-circle img-responsive img-thumbnail" src="dist/img/avatar2.png" >
                                                </th>
                                                <th align="center" width="">ชื่อ-นามสกุล</th>
                                                <th align="center" width="120px">รหัส</th>
                                                <th align="center" width="">ตำแหน่ง</th>
                                                <th align="center" width="">แผนก</th>
                                            </tr>
                                            <tr>
                                                <td >น.ส. สมสวย  เห็นงาม</td>
                                                <td >130911</td>
                                                <td >พนักงานทั่วไป</td>
                                                <td >บัญชี</td>
                                            </tr>
                                        </table>
                                        <a class="" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                            <i class="glyphicon glyphicon-triangle-bottom"></i>รายละเอียดบุคคลเพิ่มเติม
                                        </a>
                                        <div class="collapse" id="collapseExample">
                                            <table class="table table-responsive table-bordered">
                                                <thead>
                                                    <tr class="">
                                                        <th colspan="3" width="50%">วันที่เริ่มงาน</th>
                                                        <th colspan="3">ผู้บังคับบัญชา</th>
                                                    </tr>
                                                </thead>
                                                <tr>
                                                    <td colspan="3">12 ธ.ค. 2549</td>
                                                    <td colspan="3">นาย นภัทร อินทร์ใจเอื้อ</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row box-padding">
                    <div class="box box-primary">
                        <div class="box-header">
                            <div class="content-header">
                                <h1 class="text-center">
                                    ผลสรุปคะแนนประเมินเมื่อวันที่  15 ก.ค. 2558
                                </h1>
                            </div>

                        </div>  
                        <form method="get" action="compareevaluation.php" >
                            <div class="box-body box-padding-table"> 

                                <table class="table table-bordered">
                                    <tr class="bg-gray-light">
                                        <td class="text-center">ส่วน</td>
                                        <td>หัวข้อการประเมิน</td>
                                        <td class="text-center">สัดส่วน(%)</td>
                                        <td class="text-center">คะแนน</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td>คะแนนวันลา</td>
                                        <td class="text-center">10%</td>
                                        <td class="text-center">1.5</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">2</td>
                                        <td>การประเมินประสิทธิภาพส่วนบุคคล</td>
                                        <td class="text-center">40%</td>
                                        <td class="text-center">4</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">3</td>
                                        <td>คะแนนดัชนีชี้วัดKPIs</td>
                                        <td class="text-center">50%</td>
                                        <td class="text-center">5</td>
                                    </tr>
                                    <tr class="active">
                                        <td colspan="2">คะแนนรวม</td>
                                        <td class="text-center">100%</td>
                                        <td class="text-center">4.35</td>
                                    </tr>
                                    <tr class="bg-green">

                                        <td colspan="3"><strong>ผลการประเมิน</strong></td>
                                        <td class=" text-center"><strong>A+</strong></td>
                                    </tr>
                                </table>
                                <div class="row box-padding">
                                    <div class="content-header">
                                        <h1 class="text-center box-padding-small">
                                            คำแนะนำของผู้บังคับบัญชา
                                        </h1>
                                        <div class="well well-sm">
                                            <div class="row">
                                                <div class="col-sm-4" >
                                                    <ul>
                                                        <li style="list-style: none;"><strong>จุดเด่นผู้ถูกประเมิน</strong></li>
                                                        <li>การวางแผน</li>
                                                        <li>การแก้ไขปัญหาและการตัดสินใจ</li>
                                                        <li>การดำเนินตามแผนและติดตามผลงาน</li>
                                                    </ul>
                                                </div>
                                                <div class="col-sm-4" >
                                                    <ul>
                                                        <li style="list-style: none;"><strong>จุดที่ควรพัฒนาปรับปรุงผู้ถูกประเมิน</strong></li>
                                                        <li>การวางแผน</li>
                                                        <li>การแก้ไขปัญหาและการตัดสินใจ</li>
                                                        <li>การดำเนินตามแผนและติดตามผลงาน</li>
                                                    </ul>
                                                </div>
                                                <div class="col-sm-4" >
                                                    <ul>
                                                        <li style="list-style: none;"><strong>หลักสูตรการอบรมหรือแนวทางที่ควรพัฒนา</strong></li>
                                                        <li>การวางแผน</li>
                                                        <li>การแก้ไขปัญหาและการตัดสินใจ</li>
                                                        <li>การดำเนินตามแผนและติดตามผลงาน</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>

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
