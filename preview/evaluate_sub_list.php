<?php
    //General user
    session_start();
    //Check_login
    if($_SESSION["employee_id"]==''){
        echo "Please login again";
        echo "<a href='login.php'>Click Here to Login</a>";
        header("location:login.php");
    }else if($_SESSION["login_status"] != '0' ){
        echo "Login wrong level" ;
        header("location:hr/index.php");
    } else{
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
                        <small>ค้นหาพนักงาน</small>
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
                                            <option>บริหาร/การเงิน</option>
                                            <option>บริหาร/บัญชี</option>
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
                          <span class="info-box-text">ประเมินแล้ว</span>
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
                          <span class="info-box-text">ยังไม่ประเมิน</span>
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
                                <?php 
                                            $sql_emp_list="SELECT
                                                                    ee.employee_id,
                                                                    e.prefix,
                                                                    e.first_name,
                                                                    e.last_name,
                                                                    e.position_level_id,
                                                                    ee.status_success
                                                            FROM
                                                                    employees e
                                                            JOIN evaluation_employee ee ON e.employee_id = ee.employee_id
                                                            JOIN evaluation ev ON ee.evaluation_code = ev.evaluation_code
                                                            WHERE
                                                                    e.manager_id = $my_emp_id                                                            
                                                            AND ev.term_id = 1
                                                            AND ev. YEAR = '2016'";
                                            $query_emp_list = mysqli_query($conn, $sql_emp_list);
                                        ?>

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
                                    <?php
                                        while($result_emp_list = mysqli_fetch_assoc($query_emp_list)) {
                
                                        $employee_id = $result_emp_list["employee_id"];                                       
                                        $emp_name = $result_emp_list["prefix"].' '.$result_emp_list["first_name"].'  '.$result_emp_list["last_name"];
                                        $status=$result_emp_list["status_success"];
                                        $position=$result_emp_list["position_level_id"];
                                        
                                        ?>
                                    <tr>
                                        <td><?php echo $employee_id; ?></td>
                                        <td><?php echo $emp_name; ?></td>
                                        <td> </td>
                                        <td> </td>
                                        <td>
                                            <a href="evaluation_section_2.php?emp_id=<?php echo $employee_id;?>&position_level_id=<?php echo $position;?>&eval_code=41">    
                                            <center><i class="glyphicon glyphicon-book"></i></center>
                                            </a>
                                        </td>
                                        <?php if($status==0){
                                           echo '<td ><center><font color="red" >ยังไม่ประเมิน</font></center></td>';   
                                        }else{
                                            echo '<td ><center><font color="green" >ประเมินแล้ว</font></center></td>';  
                                        }?>
                                       
                                        
                                    </tr>
                                        <?php } ?>
                                    
                                    
                                    
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
<?php
        }
    }
?>
