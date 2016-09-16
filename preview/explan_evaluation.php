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
        //Get Evaluation employee id
        if (isset($_GET["eval_emp_id"])) {
            $get_eval_emp_id = $_GET["eval_emp_id"];
        }
        //Get Evaluation code
        if (isset($_GET["eval_code"])) {
            $get_eval_code = $_GET["eval_code"];
        }
        //Get Position Level
        if(isset($_GET["position_level_id"])){
            $level = $_GET["position_level_id"];
        }
            
        ?>
        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>แก้ไขข้อมูลพนักงาน : ALT Evaluation</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!--CSS PACKS -->
        <?php include ('./css_packs.html'); ?>
        <!-- SCRIPT PACKS -->
        <?php include('./script_packs.html') ?>
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
                    <?php
                    
                    ?>
                    <!-- Brief Info Profile Employee  -->
                    <?php include './breif_info_profile_eval.php'; ?>
                    <!-- /Brief Info Profile Employee  -->
                    
                    <!-- Navbar process -->
                    <?php include './navbar_process.php'; ?>
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
                            <script>
                                $('#check').click(function(){
                                    if($(this).prop('checked') == true){
                                        $('input[type="submit"]').prop('disabled', false);
                                    }else{
                                        $('input[type="submit"]').prop('disabled', true);
                                    }
                                });
                            </script>
                            <form action="evaluation_section_1.php" method="post">
                            <div class="form-group box-padding-small text-center">
                                <input type='checkbox' name='chk' value='1' id='check'> ยอมรับข้อตกลงและคำชี้แจง <br>
                                <input class="btn btn-success btn-lg search-button" type="submit" name="submit" value="หน้าถัดไป" >
                            </div>  
                            </form>
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
 
</html>
            <?php
        }
    }

    
?>
