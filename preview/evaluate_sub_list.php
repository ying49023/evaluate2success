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
                <?php 
                                    $sql_eval = "select * from evaluation where current_eval = 1 and company_id=1";
                                    $query_eval = mysqli_query($conn, $sql_eval);
                                ?>
                                 <?php while($result_eval = mysqli_fetch_array($query_eval,MYSQLI_ASSOC)) {
                                    $eval_code = $result_eval['evaluation_code'];
                                    $term_id = $result_eval['term_id'];
                                    $year = $result_eval['year'];
                                 } ?>
                                <?php 
                                    
                                    
                                    $sql_count = "SELECT e.manager_id,
                                                    (
                                                        SELECT COUNT(e.employee_id)
                                                        FROM
                                                                evaluation_employee ee
                                                        JOIN employees e ON ee.employee_id = e.employee_id
                                                        JOIN employees m ON e.manager_id = m.employee_id
                                                        WHERE
                                                                e.manager_id = '".$my_emp_id."'
                                                        AND status_success = 1 AND ee.evaluation_code = '".$my_eval_code."'
                                                    ) AS count_com,
                                                    (
                                                        SELECT
                                                                COUNT(e.employee_id)
                                                        FROM
                                                                evaluation_employee ee
                                                        JOIN employees e ON ee.employee_id = e.employee_id
                                                        JOIN employees m ON e.manager_id = m.employee_id
                                                        WHERE
                                                                e.manager_id = '".$my_emp_id."'
                                                        AND status_success = 0 AND ee.evaluation_code = '".$my_eval_code."'
                                                    ) AS count_uncom,
                                                    COUNT(e.employee_id) AS count_all
                                            FROM employees e
                                            JOIN employees m ON e.manager_id = m.employee_id
                                            JOIN departments d ON m.department_id = d.department_id
                                            JOIN evaluation_employee ee ON e.employee_id = ee.employee_id
                                            WHERE ee.evaluation_code = '".$my_eval_code."' AND e.manager_id = '".$my_emp_id."' ";
                                    $query_count = mysqli_query($conn, $sql_count);
                                    foreach ($query_count as $result_count){
                                        $complete_emp = $result_count["count_com"];
                                        $uncomplete_emp = $result_count["count_uncom"];
                                        $all_emp = $result_count["count_all"];
                                    }

                                        ?>
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
                          <span class="info-box-number"><?php echo $complete_emp; ?> คน</span>
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
                          <span class="info-box-number"><?php echo $uncomplete_emp; ?> คน</span>
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
                          <span class="info-box-number"><?php echo $all_emp; ?> คน</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!--/Style2-->
                </div>

                <!--list employee-->
                <div id="filter" class="row box-padding">
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
                                <!-- ช่องค้นหา by listJS -->
                            <div class="form-inline padding-small">
                                <i class="glyphicon glyphicon-search" style="padding: 0px 10px;" ></i>
                                <input class="search form-control" placeholder="ค้นหา" />
                            </div>
                                 

                                <table class="table table-bordered table-hover" width="90%" >
                                <thead>
                                    <tr>
                                        <th><button class="sort" data-sort="emp_id">รหัสพนักงาน</button></th>
                                        <th><button class="sort" data-sort="emp_name">ชื่อพนักงาน</button></th>
                                        <th><button class="sort" data-sort="job_name">ตำแหน่ง</button></th>
                                        <th><button class="sort" data-sort="dept_name">ฝ่าย/แผนก</button></th>
                                        <th><center>ประเมิน</center></th>
                                        <th><center>สถานะ</center></th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    <?php
                                        $sql_emp_list="SELECT * FROM employees e
                                                  JOIN evaluation_employee ee ON e.employee_id = ee.employee_id
                                                  JOIN jobs j ON j.job_id = e.job_id
                                                  JOIN departments d ON d.department_id = e.department_id
                                                  JOIN company c ON c.company_id = e.company_id
                                                  WHERE ( ee.assessor1_id = $my_emp_id OR ee.assessor2_id = $my_emp_id ) AND ee.evaluation_code = '$eval_code'
                                                  GROUP BY ee.employee_id";
                                        $query_emp_list = mysqli_query($conn, $sql_emp_list);
                                        
                                        while($result_emp_list = mysqli_fetch_assoc($query_emp_list)) {
                
                                        $employee_id = $result_emp_list["employee_id"];                                       
                                        $emp_name = $result_emp_list["prefix"].' '.$result_emp_list["first_name"].'  '.$result_emp_list["last_name"];
                                        $status_accessor1=$result_emp_list["status_assessor1"];
                                        $status_accessor2=$result_emp_list["status_assessor2"];
                                        $position=$result_emp_list["position_level_id"];
                                        $job_name = $result_emp_list["job_name"];
                                        $department_name = $result_emp_list["department_name"];
                                        $comp_id = $result_emp_list["company_id"];
                                        $eval_emp_id = $result_emp_list["evaluate_employee_id"];
                                        $assessor1_id = $result_emp_list["assessor1_id"];
                                        $assessor2_id = $result_emp_list["assessor2_id"];
                                        
                                        
                                        $sql_huahna = "
                                                        select assessor1_id as huahna1,assessor2_id as huahna2,status_assessor1 as status_mgn1,status_assessor2 as status_mgn2
                                                        from evaluation_employee
                                                        where employee_id =$employee_id and evaluation_code =$my_eval_code ";
                                                $query_huahna= mysqli_query($conn, $sql_huahna);
                                        $huahna1=0;
                                        $huahna2=0;
                                        
                                        while ($result_huahna = mysqli_fetch_assoc($query_huahna)) {
                                            $huahna1 = $result_huahna["huahna1"];
                                            $huahna2 = $result_huahna["huahna2"];
                                            $status_mgn1 =$result_huahna["status_mgn1"];
                                            $status_mgn2 =$result_huahna["status_mgn2"];
                                        }
                                        
//                                        $sql_check_ass1 = " SELECT * FROM employees e 
//                                                            JOIN evaluation_employee ee ON e.employee_id = ee.assessor1_id
//                                                            WHERE e.manager_id = '$my_emp_id' AND ee.status_assessor1 = 1";
//                                        $query_check_ass1 = mysqli_query($conn, $sql_check_ass1);
//                                        $result_check_ass1 = mysqli_fetch_array($query_check_ass1);
//                                        echo $result_check_ass1["status_assessor1"];
//                                        
//                                        echo $sql_check_ass2 = " SELECT * FROM employees e 
//                                                            JOIN evaluation_employee ee ON e.employee_id = ee.assessor2_id
//                                                            WHERE e.manager_id2 = '$my_emp_id' AND ee.status_assessor2 = 1";
//                                        $query_check_ass2 = mysqli_query($conn, $sql_check_ass2);
//                                        $result_check_ass2 = mysqli_fetch_array($query_check_ass2);
//                                        echo $result_check_ass2["status_assessor2"]
                                        ?>
                                                
                                    <tr>
                                        <td class="emp_id"><?php echo $employee_id; ?></td>
                                        <td class="emp_name"><?php echo $emp_name; ?></td>
                                        <td class="job_name"><?php echo $job_name; ?></td>
                                        <td class="dept_name"><?php echo $department_name; ?></td>
                                        <td class="text-center">
                                            <form action="evalaution_start_session.php" method="post">
                                                <input type="hidden" name="emp_id" value="<?php echo $employee_id; ?>" >
                                                <input type="hidden" name="position" value="<?php echo $position; ?>" >
                                                <input type="hidden" name="eval_emp_id" value="<?php echo $eval_emp_id; ?>" >
                                                <input type="hidden" name="eval_code" value="<?php echo $eval_code; ?>" >
                                                <input type="hidden" name="comp_id" value="<?php echo $comp_id; ?>" >
                                                <?php
                                                if ($my_emp_id == $huahna1) {
                                                    if($status_mgn1==1){ ?>
                                                        
                                                     <button class="btn btn-success" type="submit" name="submit_eval" disabled >
                                                        <i class="glyphicon glyphicon-triangle-right"></i>ประเมิน
                                                    </button>
                                                
                                                <?php    }else{ ?>
                                                            <button class="btn btn-success" type="submit" name="submit_eval"  >
                                                        <i class="glyphicon glyphicon-triangle-right"></i>ประเมิน
                                                    </button> 
                                                <?php } }else if ($my_emp_id == $huahna2) {
                                                    if($status_mgn2==1){  ?>
                                                
                                                
                                                        
                                                     <button class="btn btn-success" type="submit" name="submit_eval" disabled >
                                                        <i class="glyphicon glyphicon-triangle-right"></i>ประเมิน
                                                    </button>
                                                
                                                <?php    }else{ ?>
                                                            <button class="btn btn-success" type="submit" name="submit_eval"  >
                                                        <i class="glyphicon glyphicon-triangle-right"></i>ประเมิน
                                                    </button> 
                                               <?php } }  ?>
                                                
                                               <!-- <button class="btn btn-success" type="submit" name="submit_eval" <?php if($huahna1 ==1 ){ echo "disabled"; } ?> >
                                                    <i class="glyphicon glyphicon-triangle-right"></i>ประเมิน
                                                </button> -->
                                            </form>
                                        </td>
                                        
                                        
                                        <?php
                                                if ($my_emp_id == $huahna1) {
                                                    if($status_mgn1==1){ 
                                                        
                                                     echo '<td ><center><font color="green" >ประเมินแล้ว</font></center></td>';
                                                
                                                  }else{ 
                                                             echo '<td ><center><font color="red" >ยังไม่ประเมิน</font></center></td>';
                                                } } ?>
                                                
                                                <?php
                                                if ($my_emp_id == $huahna2) {
                                                    if($status_mgn2==1){ 
                                                      echo '<td ><center><font color="green" >ประเมินแล้ว</font></center></td>';
                                                
                                                   }else{
                                                           echo '<td ><center><font color="red" >ยังไม่ประเมิน</font></center></td>';
                                                }}   ?>
                                       
                                        
                                    </tr>
                                        <?php } ?>
                                </tbody>
                                <script>
                                    var options = {
                                        valueNames: [ 'emp_id', 'emp_name' , 'job_name' , 'dept_name' ]
                                    };
                                    
                                    var userList = new List('filter', options);
                                </script>    
                                    
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
