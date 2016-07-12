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
                        การประเมิน
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">การประเมิน</li>
                    </ol>
                </section>
                <!--/Page header -->

                <!-- Main content -->
                <div class="row box-padding">
                    <div class="box box-success">
                        <div class="box-body">
                            <form >
                                <div class="col-sm-3">
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
                                            <option>ครั้งที่ 1 </option>
                                            <option>ครั้งที่ 2 </option>
                                        </select>
                                    </div>                               
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-default search-button" type="submit">ค้นหา</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="row box-padding">
                    <div class="col-md-8">
                        <div class="box box-default">

                            <div class="box-header with-border">
                                ภาพรวมการทำงานย้อนหลัง
                            </div>
                            <div class="box-body">

                                <p class="text-center">
                                    <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
                                </p>

                                <div class="chart">
                                    <!-- Sales Chart Canvas -->
                                    <canvas id="salesChart" style="height: 180px; width: 703px;" width="703" height="180"></canvas>
                                </div>
                                <script>
                                    var salesChartData = {
                                        labels: ["January", "February", "March", "April", "May", "June", "July"],
                                        datasets: [
                                            {
                                                label: "Electronics",
                                                fillColor: "rgb(210, 214, 222)",
                                                strokeColor: "rgb(210, 214, 222)",
                                                pointColor: "rgb(210, 214, 222)",
                                                pointStrokeColor: "#c1c7d1",
                                                pointHighlightFill: "#fff",
                                                pointHighlightStroke: "rgb(220,220,220)",
                                                data: [65, 59, 80, 81, 56, 55, 40]
                                            },
                                            {
                                                label: "Digital Goods",
                                                fillColor: "rgba(60,141,188,0.9)",
                                                strokeColor: "rgba(60,141,188,0.8)",
                                                pointColor: "#3b8bba",
                                                pointStrokeColor: "rgba(60,141,188,1)",
                                                pointHighlightFill: "#fff",
                                                pointHighlightStroke: "rgba(60,141,188,1)",
                                                data: [28, 48, 40, 19, 86, 27, 90]
                                            }
                                        ]
                                    };
                                </script>
                                <!-- /.chart-responsive -->
                            </div>
                        </div>
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

        <!-- jQuery 2.2.0 -->
        <script src="plugins/jQuery/jQuery-2.2.0.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.6 -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <!-- Morris.js charts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="plugins/morris/morris.min.js"></script>
        <!-- Sparkline -->
        <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
        <!-- jvectormap -->
        <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <!-- jQuery Knob Chart -->
        <script src="plugins/knob/jquery.knob.js"></script>
        <!-- daterangepicker -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
        <script src="plugins/daterangepicker/daterangepicker.js"></script>
        <!-- datepicker -->
        <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
        <!-- Slimscroll -->
        <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="plugins/fastclick/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/app.min.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="dist/js/pages/dashboard.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="dist/js/demo.js"></script>
    </body>
</html>

