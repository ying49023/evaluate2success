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
                        <div class="box-header with-border">
                            <b>การจัดการแบบประเมิน Competency ตามระดับต่างๆ</b>
                            
                        </div>
                        
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                               <?php
                                $sql_level = "SELECT position_level_id,position_description FROM position_level ORDER BY position_level_id ASC";
                                $query_level = mysqli_query($conn, $sql_level);
                                
                                ?>
                                    <table class="table table-hover table-responsive table-striped table-bordered">                               
                                        <thead>
                                            <tr>
                                                
                                                <th>ตารางแสดงระดับปฏิบัติงาน</th>                                            

                                            </tr>
                                        </thead>
                                <?php while ($result_level = mysqli_fetch_array($query_level, MYSQLI_ASSOC)) {  
                                        $position_id = $result_level['position_level_id'];
                                        $position_name=$result_level['position_description'];
                                
                                ?>
                                        <tr>
                                            
                                            <td><a href="competency_match.php?level=<?php echo $position_id; ?>&level_name=<?php echo $position_name; ?>"><?php echo $position_name; ?></a></td>                                              
                                        </tr>
                                        
                                        
                                <?php } ?>       
                                           
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
    <!-- SCRIPT PACKS -->
    <?php include ('./script_packs.html'); ?>
</html>