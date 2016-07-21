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
                        อนุมัติKPIs
                        <small>ครั้งถัดไป</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Competency evaluation</li>
                    </ol>
                </section>
                <!--/Page header -->

                <!-- Main content -->
                <!--search-->
                <div class="row box-padding">
                    <div class="box box-success">
                        <div class="box-body">
                            <form>
                                <div class="col-sm-3">
                                    <label class="col-sm-6 control-label">รหัสพนักงาน</label>
                                    <div class="col-sm-6">
                                        <input class="form-control" type="text" name="emp_id">
                                    </div>
                                </div> 

                                <div class="col-md-3">
                                    <label class="col-sm-5 control-label">ชื่อพนักงาน</label>
                                    <div class="col-sm-7">
                                        <input class="form-control" type="text" name="emp_id">
                                    </div>
                                </div>
                                <div class="col-md-4">

                                    <label class="col-sm-4 control-label">แผนก/ฝ่าย</label>
                                    <div class="col-sm-8">
                                        <select class="form-control">
                                            <option>บุคคล/ฝ่ายบุคคล </option>
                                            <option>บริหาร/ฝ่ายการเงิน</option>
                                            <option>บริหาร/ฝ่ายบัญชี</option>
                                        </select>
                                    </div>                               
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-primary search-button"><i class="glyphicon glyphicon-search"></i></button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <!--/search-->
                
                <div class="row box-padding">
                    <!--Style 1 don't delete  อย่าเพิ่งลบ-->
                    <!--
                    <div class="col-md-4">
                        <div class="small-box bg-green">
                        <div class="inner">
                          <h3>50 คน</h3>

                          <p>ประเมินแล้ว</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">ดูรายชื่อทั้งหมด<i class="glyphicon glyphicon-option-horizontal"></i></a>
                      </div>
                    </div>
                    <div class="col-md-4">
                        <div class="small-box bg-orange">
                        <div class="inner">
                          <h3>7 คน</h3>

                          <p>ยังไม่ประเมิน</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-person"></i>
                        </div>
                        <a href="#" class="small-box-footer">ดูรายชื่อทั้งหมด<i class="glyphicon glyphicon-option-horizontal"></i></a>
                      </div>
                    </div>
                    <div class="col-md-4">
                        <div class="small-box bg-blue">
                        <div class="inner">
                          <h3>57 คน</h3>

                          <p>สมาชิกในแผนก</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-person-stalker"></i>
                        </div>
                        <a href="#" class="small-box-footer">ดูรายชื่อทั้งหมด<i class="glyphicon glyphicon-option-horizontal"></i></a>
                      </div>
                    </div>-->
                    <!--/Style1-->
                    
                    <!--Style2 don't delete อย่าเพิ่งลบ-->
                    
                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="glyphicon glyphicon-ok"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-text">อนุมัติแล้ว</span>
                          <span class="info-box-number">50 คน</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    
                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-orange"><i class="glyphicon glyphicon-remove"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-text">ยังไม่อนุมัติ</span>
                          <span class="info-box-number">7 คน</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>

                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-blue"><i class="glyphicon glyphicon-user"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-text">สมาชิกทั้งหมด</span>
                          <span class="info-box-number">57 คน</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!--/Style2-->
                </div>

                <!--list employee-->
                <div class="row box-padding">
                        <div class="box box-primary">

                            <div class="box-header with-border">
                                <b>ตารางข้อมูลพนักงาน</b>
                                <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"> 
                                    <i class="fa fa-minus"></i>
                                </button>
                                
                                <button type="button" class="btn btn-box-tool" data-widget="remove">
                                    <i class="fa fa-times"></i>
                                </button>
                                </div>
                            </div>
                            <div class="box-body">

                                <table class="table table-bordered table-hover" width="90%" >
                                <thead>
                                    <tr>
                                        <th>รหัสพนักงาน</th>
                                        <th>ชื่อพนักงาน</th>
                                        <th>ชื่อผู้บังคังบัญชา</th>
                                        <th>แผนก/ฝ่าย</th>
                                        <th><center>อนุมัติKPIsครั้งถัดไป</center></th>
                                        <th><center>สถานะการอนุมัติ</center></th>
                                    </tr>
                                </thead>
                                    <tr>
                                        <td>123456</td>
                                        <td>นาย ศตวรรษ วินวิวัฒน์</td>
                                        <td>นภัทร อินทร์ใจเอื้อ</td>
                                        <td>บุคคล/ฝ่ายบุคคล</td>
                                        <td>
                                            <a href="hr_approve_kpi2.php">    
                                            <center><i class="glyphicon glyphicon-check"></i></center>
                                            </a>
                                        </td>
                                        <td ><center><font color="green" >อนุมัติแล้ว</font></center></td>
                                        
                                    </tr>

                                    <tr>
                                        <td>130911</td>
                                        <td>น.ส. สมสวย เห็นงาม</td>
                                        <td>นภัทร อินทร์ใจเอื้อ</td>
                                        <td>บุคคล/ฝ่ายบุคคล</td>
                                        <td>
                                            <a href="hr_approve_kpi2.php">    
                                            <center><i class="glyphicon glyphicon-check"></i></center>
                                            </a>
                                        </td>
                                        <td ><center><font color="red" >ยังไม่อนุมัติ</font></center></td>
                                    </tr>
                                    <tr>
                                        <td>130912</td>
                                        <td>นาย ชัยเดช พ่วงเพชร</td>
                                        <td>นภัทร อินทร์ใจเอื้อ</td>
                                        <td>บุคคล/ฝ่ายบุคคล</td>
                                        <td>
                                            <a href="hr_approve_kpi2.php">    
                                            <center><i class="glyphicon glyphicon-check"></i></center>
                                            </a>
                                        </td>
                                        <td ><center><font color="red" >ยังไม่อนุมัติ</font></center></td>
                                    </tr>
                                    <tr>
                                        <td>130913</td>
                                        <td>นาย ศักดิ์ดา เกียรติกมล</td>
                                        <td>นภัทร อินทร์ใจเอื้อ</td>
                                        <td>บุคคล/ฝ่ายบุคคล</td>
                                        <td>
                                            <a href="hr_approve_kpi2.php">    
                                            <center><i class="glyphicon glyphicon-check"></i></center>
                                            </a>
                                        </td>
                                        <td ><center><font color="red" >ยังไม่อนุมัติ</font></center></td>
                                    </tr>
                                    
                                </table>

                                
                                
                                <!-- /.chart-responsive -->
                            </div>
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
