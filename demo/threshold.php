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
    <!-- SCRIPT PACKS -->
    <?php include ('./script_packs.html'); ?>
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
                    มาตรฐานการวัดระดับ
                    <small></small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="#"> <i class="fa fa-dashboard"></i>
                            Home
                        </a>
                    </li>
                    <li class="active">Threshold</li>
                </ol>
            </section>
            <!--/Page header -->

            <!-- Main content -->
         
            <div class="row box-padding">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                          <center><img src="threshold_pic.png"> </center>
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