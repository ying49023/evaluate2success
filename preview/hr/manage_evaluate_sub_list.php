<?php include('./classes/connection_mysqli.php') ?>
        <?php 
            if(isset($_GET['mng_id']))
            $mng_id=$_GET['mng_id'];
            
        ?>
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
                        การประเมินสมรรถนะ
                        <small>สถานะการประเมิน</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Competency evaluation</li>
                    </ol>
                </section>
                <!--/Page header -->

                <!-- Main content -->
                 <?php 
                            $sql_meval = "SELECT  CONCAT(m.prefix,m.first_name,' ',m.last_name) as name,e.manager_id, ( SELECT  COUNT(e.employee_id)
                                                        FROM evaluation_employee v JOIN employees e ON v.employee_id = e.employee_id JOIN employees m ON e.manager_id = m.employee_id
                                                        WHERE e.manager_id = 1 AND sum_point <> 0) AS 'Completed_evaluate' , COUNT(e.employee_id)-( SELECT  COUNT(e.employee_id)
                                                        FROM evaluation_employee v JOIN employees e ON v.employee_id = e.employee_id JOIN employees m ON e.manager_id = m.employee_id
                                                        WHERE e.manager_id = 1 AND sum_point <> 0) AS 'Uncompleted_evaluate',
                                                        COUNT(e.employee_id) AS 'All_subordinate' 
                                                        FROM employees e JOIN employees m ON e.manager_id = m.employee_id
                                                        WHERE e.manager_id = '$mng_id'  ";
                                        $query_meval= mysqli_query($conn, $sql_meval);
                            ?>
                             <?php while($result_meval = mysqli_fetch_array($query_meval,MYSQLI_ASSOC)) { 
                                        $name=$result_meval['name'];
                                        $completed=$result_meval['Completed_evaluate'];
                                        $uncompleted=$result_meval['Uncompleted_evaluate'];
                                        $all=$result_meval['All_subordinate'];
                                        $mng_id=$result_meval['manager_id'];
                                        ?>
                <!--search-->
                <div class="row box-padding">
                    <div class="box box-success">
                        <div class="box-body">
                           
                            <p>ผู้ประเมิน <?php echo $name; ?> </p>
                            
                        </div>
                    </div>
                </div>
                <!--/search-->
                
                <div class="row box-padding">
                  
                    
                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="glyphicon glyphicon-ok"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-text">ประเมินแล้ว</span>
                          <span class="info-box-number"><?php echo $completed; ?></span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    
                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-orange"><i class="glyphicon glyphicon-remove"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-text">ยังไม่ประเมิน</span>
                          <span class="info-box-number"><?php echo $uncompleted; ?></span>
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
                          <span class="info-box-number"><?php echo $all; ?></span>
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
                                        <th>ตำแหน่ง</th>
                                        <th>ฝ่าย/แผนก</th>
                                        <th><center>ประเมิน</center></th>
                                        <th><center>สถานะ</center></th>
                                    </tr>
                                </thead>
                                    <tr>
                                        <td>123456</td>
                                        <td>นาย ศตวรรษ วินวิวัฒน์</td>
                                        <td> </td>
                                        <td> </td>
                                        <td>
                                            <a href="evalstep1.php">    
                                            <center><i class="glyphicon glyphicon-book"></i></center>
                                            </a>
                                        </td>
                                        <td ><center><font color="green" >ประเมินแล้ว</font></center></td>
                                        
                                    </tr>

                                    <tr>
                                        <td>130911</td>
                                        <td>น.ส. สมสวย เห็นงาม</td>
                                        <td> </td>
                                        <td> </td>
                                        <td>
                                            <a href="">    
                                            <center><i class="glyphicon glyphicon-book"></i></center>
                                            </a>
                                        </td>
                                        <td ><center><font color="red" >ยังไม่ประเมิน</font></center></td>
                                    </tr>
                                    <tr>
                                        <td>130912</td>
                                        <td>นาย ชัยเดช พ่วงเพชร</td>
                                        <td> </td>
                                        <td> </td>
                                        <td>
                                            <a href="">    
                                            <center><i class="glyphicon glyphicon-book"></i></center>
                                            </a>
                                        </td>
                                        <td ><center><font color="red" >ยังไม่ประเมิน</font></center></td>
                                    </tr>
                                    <tr>
                                        <td>130913</td>
                                        <td>นาย ศักดิ์ดา เกียรติกมล</td>
                                        <td> </td>
                                        <td> </td>
                                        <td>
                                            <a href="">    
                                            <center><i class="glyphicon glyphicon-book"></i></center>
                                            </a>
                                        </td>
                                        <td ><center><font color="red" >ยังไม่ประเมิน</font></center></td>
                                    </tr>
                                    
                                </table>

                                
                                
                                <!-- /.chart-responsive -->
                            </div>
                        </div>
                </div>
                <?php }?>
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
