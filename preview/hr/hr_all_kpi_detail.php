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
                    ดูKPIsทั้งหมด
                    <small></small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="#"> <i class="fa fa-dashboard"></i>
                            Home
                        </a>
                    </li>
                    <li class="active">All KPIs</li>
                </ol>
            </section>
            <!--/Page header -->

            <!-- Main content -->
            <div class="row box-padding">
                <div class="box box-success">
                    <div class="box-body">
                        <form>
                            <div class="col-md-offset-1 col-md-4">
                                <label class="col-sm-4 control-label">ตำแหน่ง</label>
                                <div class="col-sm-8">
                                    <select class="form-control">
                                        <option>พนักงานทั่วไป</option>
                                        <option>ผู้บริหาร</option>
                                        <option>หัวหน้าแผนก</option>
                                        <option>ผู้จัดการ</option>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="col-sm-4 control-label">แผนก</label>
                                <div class="col-sm-8">
                                    <select class="form-control">
                                        <option>ทุกแผนก</option>
                                        <option>ฝ่ายทรัพยากรบุคคล</option>
                                        <option>ฝ่ายขายและการตลาด</option>
                                        <option>การเงิน</option>
                                        <option>ฝ่ายขาย</option>
                                        <option>ฝ่ายไอที และสารสนเทศ</option>
                                        <option>ฝ่ายปฏิบัติการ</option>
                                    </select>
                                </div>
                            </div>
                            <div class=" col-md-2">
                                <button class="btn btn-primary search-button" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
            <div class="row box-padding">
            <div class="box box-primary">
                <div class="box-body">
                    <table class="table table-bordered table-hover table-striped table-responsive">
                    <thead>
                        <tr>
                            <th = >ID</th>
                            <th>ชื่อKPIs</th>
                            <th >แผนก</th>
                            <th>ตำแหน่ง</th>
                            <th>ดู</th>
                        </tr>
                    </thead>
                    <tr>
                        <td>KPI001</td>
                        <td>จัดอบรมสัมนา</td>
                        <td>ฝ่ายทรัพยากรบุคคล</td>
                        <td>พนักงานทั่วไป</td>
                        <td>
                            <a href=""><i class="glyphicon glyphicon-eye-open"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>KPI002</td>
                        <td>จัดหาคนเข้าสมัครงาน</td>
                        <td>ฝ่ายทรัพยากรบุคคล</td>
                        <td>พนักงานทั่วไป</td>
                        <td>
                            <a href=""><i class="glyphicon glyphicon-eye-open"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>KPI003</td>
                        <td>ออกรายงานครบตามผลประเมินประจำปี</td>
                        <td>ฝ่ายทรัพยากรบุคคล</td>
                        <td>พนักงานทั่วไป</td>
                        <td>
                            <a href=""><i class="glyphicon glyphicon-eye-open"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>KPI004</td>
                        <td>จัดงานประชุมผู้นำองค์กร</td>
                        <td>ฝ่ายทรัพยากรบุคคล</td>
                        <td>พนักงานทั่วไป</td>
                        <td>
                            <a href=""><i class="glyphicon glyphicon-eye-open"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>KPI101</td>
                        <td>ติดตั้งเสา</td>
                        <td>ฝ่ายติดตั้งโครงข่าย</td>
                        <td>พนักงานทั่วไป</td>
                        <td>
                            <a href=""><i class="glyphicon glyphicon-eye-open"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>KPI102</td>
                        <td>จัดหาอุปกรณ์ติดตั้ง</td>
                        <td>ฝ่ายติดตั้งโครงข่าย</td>
                        <td>พนักงานทั่วไป</td>
                        <td>
                            <a href=""><i class="glyphicon glyphicon-eye-open"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>KPI103</td>
                        <td>จัดworkshopรายสัปดาห์</td>
                        <td>ฝ่ายติดตั้งโครงข่าย</td>
                        <td>พนักงานทั่วไป</td>
                        <td>
                            <a href=""><i class="glyphicon glyphicon-eye-open"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>KPI201</td>
                        <td>จำนวนสินค้าที่ขายได้</td>
                        <td>ฝ่ายขายและการตลาด</td>
                        <td>พนักงานทั่วไป</td>
                        <td>
                            <a href=""><i class="glyphicon glyphicon-eye-open"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>KPI202</td>
                        <td>จำนวนลูกค้าใหม่ที่ได้จากสื่อโฆษณา</td>
                        <td>ฝ่ายขายและการตลาด</td>
                        <td>พนักงานทั่วไป</td>
                        <td>
                            <a href=""><i class="glyphicon glyphicon-eye-open"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>KPI202</td>
                        <td>จำนวนรายของลูกค้าใหม่</td>
                        <td>ฝ่ายขายและการตลาด</td>
                        <td>พนักงานทั่วไป</td>
                        <td>
                            <a href=""><i class="glyphicon glyphicon-eye-open"></i></a>
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