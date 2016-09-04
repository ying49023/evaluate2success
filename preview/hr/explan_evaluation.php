<?php
    session_start();
    //Check_login
    if($_SESSION["employee_id"]==''){
        echo "Please login again";
        echo "<a href='login.php'>Click Here to Login</a>";
        header("location:login.php");
    }else{
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
        <?php 
        include ('./classes/connection_mysqli.php');
        if (isset($_GET["emp_id"])) {
                $get_emp_id = $_GET["emp_id"];
            }
            // Include คลาส class.upload.php เข้ามา เพื่อจัดการรูปภาพ
            require_once('./classes/class.upload.php') ;
            
        ?>
        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>แก้ไขข้อมูลพนักงาน : ALT Evaluation</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!--CSS PACKS -->
        <?php include ('./css_packs.html'); ?>
        <!--ListJS-->
        <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.2.0/list.min.js"></script>
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
                        คำชี้แจงแบบประเมินผลการปฏิบัติงาน
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Edit profile</li>
                    </ol>
                </section>
                <!--/Page header -->

                <!-- Main content -->
                
                <div class="row box-padding">
                    <!-- search -->
                    <div class="box box-success">
                        <div class="box-body">
                            <form method="get">
                                <div class="col-sm-4">
                                            
                                    <div class="col-sm-2 form-inline">
                                        <label class=" control-label">ปี</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <select class="form-control " name="year" >
                                            <option value="">--เลือกปี--</option>
                                            <option value="2016">2016</option>
                                            <option value="2016">2015</option>
                                            <option value="2016">2014</option>
                                        </select>
                                    </div>
                                </div> 
                                            
                                <div class="col-md-6">
                                    <div class="col-sm-3 form-inline">
                                        <label class=" control-label">รอบการประเมิน</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select class="form-control " name="term" >
                                            <option value="">--เลือกรอบการประเมิน--</option>
                                            <option value="1">ครั้งที่ 1 (มค - มิย)</option>
                                            <option value="2">ครั้งที่ 2 (กค - ธค)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary " style="width: 100%;"><i class="glyphicon glyphicon glyphicon-triangle-right"></i> &nbsp; สร้างแบบประเมิน</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--/search -->
                    <!-- Navbar process -->
                    <div class="navbar-process">
                        <?php // $page = basename($_SERVER['SCRIPT_NAME']); ?>
                            <ul id="tabs" class="nav nav-pills nav-justified" data-tabs="tabs">
                                <li class="<?php if($page == 'explan_evaluation.php'){ echo "active"; } ?>">
                                    <a href="explan_evaluation.php"  aria-expanded="false">คำชี้แจง</a>
                                </li>
                                <li class="<?php if($page == 'evaluation_section_1.php'){ echo "active"; } ?>">
                                    <a href="evaluation_section_1.php"  aria-expanded="true">ส่วนที่ 1 : KPIs</a>
                                </li>        
                                <li class="<?php if($page == 'edit_weight_eval.php'){ echo "active"; } ?>">
                                    <a href="edit_weight_eval.php?position_level_id="  aria-expanded="false">ส่วนที่ 2 : Competency</a>
                                </li>        
                                <li class="<?php if($page == 'evaluation_section_3.php'){ echo "active"; } ?>">
                                    <a href="evaluation_section_3.php"  aria-expanded="false">ส่วนที่ 3 : กฎระเบียบข้อบังคับ</a>
                                </li>        
                                <li class="<?php if($page == 'evaluation_section_4.php'){ echo "active"; } ?>">
                                    <a href="evaluation_section_4.php"  aria-expanded="false">ส่วนที่ 4 : ควมคิดเห็นเพิ่มเติม</a>
                                </li>        
                            </ul>
                    </div>
                    <!-- /Navbar process -->
                    
                    <!-- Explane -->
                    <div class="box box-primary ">
                        <div class="box-header with-border">
                            <h4><i class="glyphicon glyphicon-info-sign"></i> &nbsp; คำชี้แจงแบบประเมินผลการปฏิบัติงาน (Performance Appraisal Guideline) ระดับปฏิบัติการ</h4>
                        </div>
                        <div class="box-body">
                            <div class="box-padding">
                                        
                                        
                                        <?php
                                        $sql_title_exp = "SELECT * FROM explaned_evaluation WHERE explaned_id > 1 ";
                                        $query_title_exp = mysqli_query($conn, $sql_title_exp);
                                        while ($result_title_exp = mysqli_fetch_array($query_title_exp, MYSQLI_ASSOC)) {
                                            $explaned_id = $result_title_exp["explaned_id"];
                                            ?>
                                <p style="font-size: 16px;"><strong><?php echo $result_title_exp["explaned_header"] . " " . $result_title_exp["explaned_small_header"]; ?></strong></p>
                                <div class="box-padding">
                                                <?php
                                                $sql_detail = "SELECT * FROM explaned_detail WHERE explaned_id = '$explaned_id'";
                                                $query_detail = mysqli_query($conn, $sql_detail);
                                                while ($result_detail = mysqli_fetch_array($query_detail, MYSQLI_ASSOC)) {
                                                    ?>    
                                                    <p><?php echo $result_detail["detail"]; ?></p>
                                                        
                                                    <?php
                                                }
                                                ?>
                                </div>
                                            <?php
                                        }
                                        ?>
                            </div>
                        </div>
                    </div>
                    <!--/Explane -->
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
    <!-- SCRIPT PACKS -->
<?php include('./script_packs.html') ?>
</html>
            <?php
        }
    }

    
?>
