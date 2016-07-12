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
                    ดูภาพรวม
                    <small>แดชบอร์ด</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="#"> <i class="fa fa-dashboard"></i>
                            Home
                        </a>
                    </li>
                    <li class="active">Dashboard</li>
                </ol>
            </section>
            <!--/Page header -->

            <!-- Main content -->
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
            <div class="row box-padding">

                <div class="row">
                    <div class="col-md-8">
                        <div class="box box-primary">

                            <div class="box-header with-border"> 
                                <strong>ภาพรวมการทำงานย้อนหลัง</strong>
                                <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"> <i class="fa fa-minus"></i>
                                </button>

                            </div>
                            </div>
                            <div class="box-body">

                                <p class="text-center"> <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
                                </p>
                                <img src="chart.PNG" width="100%" />
                                <div class="chart">
                                    <!-- Sales Chart Canvas -->
                                    <!--<canvas id="salesChart" style="height: 180px; width: 703px;" width="703" height="180"></canvas>-->
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
                                <!-- /.chart-responsive --> </div>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <strong>KPIภาพรวมล่าสุด ประจำเดือน : พฤษภาคม</strong>
                                <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"> <i class="fa fa-minus"></i>
                                </button>
                                
                            </div>
                            </div>
                            <div class="box-body">
                                <div id="g5" class="200px160px" style="height:220px">
                                    <script>
                                    document.addEventListener("DOMContentLoaded", function(event) {
                                      var g5 = new JustGage({
                                        id: "g5",
                                        //value: getRandomInt(0, 100),
                                        value : 65,
                                        min: 0,
                                        max: 100,
                                        title: "เดือนพฤษภาคม",
                                        label: "%",
                                        levelColorsGradient: false
                                      });
                                  });
                                    </script>
                                </div>
                                
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <div class="row box-padding">
            <div class="box box-primary">
                <div class="box-body">
                    <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="80px" >ID</th>
                            <th>ชื่อKPIs</th>
                            <th width="90px">เป้าหมาย</th>
                            <th width="90px">ทำจริง</th>
                            <th width="200px">ประสิทธิภาพ</th>
                            <th width="60" style="text-align:center">%</th>
                        </tr>
                    </thead>
                    <tr>
                        <td>KPI001</td>
                        <td>เขียนโปรแกรมให้ได้ 5 ไฟล์ใน 1 สัปดาห์</td>
                        <td>10</td>
                        <td>9</td>
                        <td>
                            <div class="progress progress-xs progress-striped active">
                              <div class="progress-bar progress-bar-success" style="width: 90%"></div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-green">90%</span>
                        </td>
                    </tr>
                    <tr>
                        <td>KPI002</td>
                        <td>เขียนโปรแกรมให้ได้ 5 ไฟล์ใน 1 สัปดาห์</td>
                        <td>8</td>
                        <td>2</td>
                        <td>
                            <div class="progress progress-xs progress-striped active">
                              <div class="progress-bar progress-bar-primary" style="width: 25%"></div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-blue">20%</span>
                        </td>
                    </tr>
                    <tr>
                        <td>KPI003</td>
                        <td>เขียนโปรแกรมให้ได้ 5 ไฟล์ใน 1 สัปดาห์</td>
                        <td>20</td>
                        <td>14</td>
                        <td>
                            <div class="progress progress-xs progress-striped active">
                              <div class="progress-bar progress-bar-warning" style="width: 70%"></div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-orange">70%</span>
                        </td>
                    </tr>
                    <tr>
                        <td>KPI004</td>
                        <td>เขียนโปรแกรมให้ได้ 5 ไฟล์ใน 1 สัปดาห์</td>
                        <td>30</td>
                        <td>10</td>
                        <td>
                            <div class="progress progress-xs progress-striped active">
                              <div class="progress-bar progress-bar-success" style="width: 80%"></div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-green">80%</span>
                        </td>
                    </tr>
                        
                    </table>
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