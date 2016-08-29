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
                    รายงานประจำปีสำหรับแผนกฝ่ายบุคคล
                    
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
            <!-- Filter tab-->
            <div class="row box-padding">
                <div class="box box-success">
                    <div class="box-body">
                        <form>
                            <div class="col-sm-5">
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

                            
                            <div class="col-md-5">

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
            <!-- /Filter tab-->
            
            <!--Table-->
            <div class="row box-padding">
                <div class="box box-primary">
                    <div class="box-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>

                                    <th>รายการ</th>
                                    <th>ดูรายละเอียด</th>
                                    <th>ออกรายงาน</th>
                                </tr>
                            </thead>
                            <tr>

                                <td>รายงานการพัฒนา ฝึกอบรมประจำปี</td>
                                <td>
                                    <a href="hr_report_grade.php">    
                                        <center><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></center>
                                    </a>
                                </td>
                                <td class="text-center"><button class=" btn btn-danger btn-sm glyphicon glyphicon-export ">&nbsp;PDF</button>&nbsp;
                                    <button class=" btn btn-success btn-sm glyphicon glyphicon-export ">&nbsp;EXCEL</button>
                                </td>
                            </tr>
                            <tr>

                                <td>รายงานด้านเงินเดือนค่าจ้าง โบนัส ประจำปี</td>
                                <td>
                                    <a href="hr_report_grade.php">    
                                        <center><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></center>
                                    </a>
                                </td>
                                <td class="text-center"><button class=" btn btn-danger btn-sm glyphicon glyphicon-export ">&nbsp;PDF</button>&nbsp;
                                    <button class=" btn btn-success btn-sm glyphicon glyphicon-export ">&nbsp;EXCEL</button>
                                </td>
                            </tr>
                            <tr>

                                <td>รายงานสถิติพนักงานจำแนกตามหน่วยงาน การขาด ลา มาสาย การหยุดงาน ประจำปี</td>
                                <td>
                                    <a href="hr_report_grade.php">    
                                        <center><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></center>
                                    </a>
                                </td>
                                <td class="text-center"><button class=" btn btn-danger btn-sm glyphicon glyphicon-export ">&nbsp;PDF</button>&nbsp;
                                    <button class=" btn btn-success btn-sm glyphicon glyphicon-export ">&nbsp;EXCEL</button>
                                </td>

                            </tr>
                            <tr>

                                <td>รายงานผลการประเมินผลการปฏิบัติงานทั่วทั้งองค์การ(ส่วนของเกรด)</td>
                                <td>
                                    <a href="hr_report_grade.php">    
                                        <center><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></center>
                                    </a>
                                </td>
                                <td class="text-center"><button class=" btn btn-danger btn-sm glyphicon glyphicon-export ">&nbsp;PDF</button>&nbsp;
                                    <button class=" btn btn-success btn-sm glyphicon glyphicon-export ">&nbsp;EXCEL</button>
                                </td>
                            </tr>
                            <tr>

                                <td>รายงานผลการปฏิบัติงานตามตัวชี้วัดความสำเร็จที่กำหนดไว้(ส่วนที่4 KPIs)</td>
                                <td>
                                    <a href="">    
                                        <center><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></center>
                                    </a>
                                </td>
                                <td class="text-center"><button class=" btn btn-danger btn-sm glyphicon glyphicon-export ">&nbsp;PDF</button>&nbsp;
                                    <button class=" btn btn-success btn-sm glyphicon glyphicon-export ">&nbsp;EXCEL</button>
                                </td>
                            </tr>

                        </table>
                    </div>
                </div>

            </div>
            <!--/Table
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
<?php include('./script_packs.html') ?>
</html>