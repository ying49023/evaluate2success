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
        <?php include('./classes/connection_mysqli.php') ?>
       
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>ระบบประเมินผลปฏิบัติงาน : ALT Evaluation</title>
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
                        การจัดการแบบประเมิน Competency ตามระดับต่างๆ 
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="#"> <i class="fa fa-dashboard"></i>
                                Home
                            </a>
                        </li>
                        <li class="active">Competency</li>
                    </ol>
                </section>
                <!--/Page header -->
                
                <!-- Main content -->
                <div class="row box-padding">
                    <div class="box box-primary">
                                                
                        <div class="box-body" style="min-height: 320px;">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box-padding">
                                        <p style="font-size: 1.5em;text-align: center;">เลือกระดับการจัดการแบบประเมิน Competency </p>
                                    </div>
                                    <hr>
                               <?php
                                $sql_level = "SELECT position_level_id,position_description FROM position_level ORDER BY position_level_id ASC";
                                $query_level = mysqli_query($conn, $sql_level);
                                
                                while ($result_level = mysqli_fetch_array($query_level, MYSQLI_ASSOC)) {  
                                        $position_id = $result_level['position_level_id'];
                                        $position_name=$result_level['position_description'];
                                
                                ?>
                                    <div class="col-md-6">
                                        <div class="btn btn-default btn-lg" style="margin: 10px;width: 100%;padding-top: 15px;height: 60px;">
                                            <a href="competency_match.php?level=<?php echo $position_id; ?>&level_name=<?php echo $position_name; ?>"><?php echo $position_name; ?></a>                                             
                                                            
                                        </div>
                                    </div>
                                <?php } ?>       
                                           
                                    
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
    <!-- SCRIPT PACKS -->
    <?php include ('./script_packs.html'); ?>
</html>
            <?php
        }
    }

    
?>