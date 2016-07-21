<!DOCTYPE html>
<html>
    <head>
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
                        แจ้งปัญหา
                        <small>รายงานข้อผิดพลาด</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Report</li>
                    </ol>
                </section>
                <!--/Page header -->

                <!-- Main content -->

                <!--list employee-->
                <div class="row box-padding">
                    <div class="box box-primary">

                        <div class="box-header with-border">
                            <b>แจ้งปัญหา</b>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"> 
                                    <i class="fa fa-minus"></i>
                                </button>

                            </div>
                        </div>
                        <form action="">
                            <div class="box-body">
                                <div class="container">
                                    <div class="col-md-offset-1 col-md-8">

                                        <div class="row box-padding-small">
                                            <div class="form-group">
                                                <div class="col-md-2">ชื่อ</div>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row box-padding-small">
                                            <div class="form-group">
                                                <div class="col-md-2">แผนก</div>
                                                <div class="col-md-8">
                                                    <select class="form-control" name="" id="">
                                                        <option value="">บัญชี</option>
                                                        <option value="">การเงิน</option>
                                                        <option value="">การตลาด</option>
                                                        <option value="">ไอที</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row box-padding-small">
                                            <div class="form-group">
                                                <div class="col-md-2">หัวข้อ</div>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row box-padding-small">
                                            <div class="form-group">
                                                <div class="col-md-2">คำอธิบาย</div>
                                                <div class="col-md-8">
                                                    <textarea name="" id="" cols="30" rows="5" class="form-control"></textarea>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <center>
                                    <input  class="btn btn-danger search-button" type="reset" name="Reset">
                                    <input  class="btn btn-success search-button" type="submit" name="Send">
                                </center>

                            </div>
                        </form>
                    </div>
                </div>
                <!--/list employee-->

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
