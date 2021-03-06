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
<?php include ('./classes/connection_mysqli.php'); 
    
    if(isset($_GET["emp_id"])){
     $get_emp_id = $_GET["emp_id"]; //GET ค่ามาจากหน้า hr_kpi_individual.php ผ่านลิงค์ 
     }
     if(isset($_GET["kpi_id"])){
     $kpi_id = $_GET["kpi_id"]; //GET ค่ามาจากหน้า hr_kpi_individual.php ผ่านลิงค์ 
     }
      if(isset($_GET["kpi_responsible_id"])){
     $get_kpi_responsible_id = $_GET["kpi_responsible_id"]; //GET ค่ามาจากหน้า hr_kpi_individual.php ผ่านลิงค์ 
     }
     if(isset($_POST["update"])){      
       $resp_id=$_POST["resp_id"];
       $input_upd=$_POST["upd"];
       $input_desc=$_POST["upd_desc"];
       $float_value_of_var = floatval($input_upd);
       $kpicode=$_POST["kpicode"];
       $empid=$_POST["empid"];
       $get_kpi_responsible_id = $_GET["kpi_responsible_id"]; 
       $round=$_POST["round"];
       $sql_submit = "call getMile_kpi_progress($resp_id,$float_value_of_var,'$input_desc','$round')";
       $objQuery = mysqli_query($conn,$sql_submit);
               if ($objQuery) {
                  
                   header ("location:update_kpi_detail.php?emp_id=$empid&kpi_id=$kpicode&kpi_responsible_id=$get_kpi_responsible_id");


               } else {

                   echo "Error Save [" . $sql_submit . "]";
               }
     }
     
     
 ?>    
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
        
        
        <!-- Google Chart Script-->
        <?php
                $sql_progess = "call getCurrentKPIPerformance($get_kpi_responsible_id) ";
                $query_progess = mysqli_query($conn, $sql_progess);
        ?>                
                    
                        
        

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
                        รายละเอียด KPI -<?php echo $kpi_id;?>
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="update_kpi.php">KPIs update</a></li>
                        <li class="active">KPI detail update</li>
                    </ol>
                </section>
                <!--/Page header -->

                <!-- Main content -->
                <div class="row box-padding">
                    <div class="box box-success">
                        <?php
                        $sql_emp = "SELECT
                                        GROUP_CONCAT(e.prefix,e.first_name,'  ',e.last_name) as emp_name,e.hiredate , e.*, p.*,j.*,d.*,
                                        GROUP_CONCAT(m.prefix,m.first_name,'  ',m.last_name) as manager_name_1
                                        FROM
                                            employees e
                                        JOIN position_level p ON p.position_level_id = e.position_level_id
                                        JOIN departments d ON d.department_id = e.department_id
                                        JOIN jobs j ON j.job_id = e.job_id
                                        JOIN employees m ON e.manager_id = m.employee_id
                                        WHERE e.employee_id ='".$my_emp_id."'";
                        $query_emp = mysqli_query($conn, $sql_emp);
                        while ($result_emp = mysqli_fetch_array($query_emp, MYSQLI_ASSOC)) {
                            $manager_name_1 = $result_emp["manager_name_1"];
                            $manager_name_2 = '';
                            if($result_emp["manager_id2"] != '' && $result_emp["manager_id2"] != 0){
                                $sql_man2 = "SELECT GROUP_CONCAT(m2.prefix,m2.first_name,'  ',m2.last_name) as manager_name_2
                                            FROM employees e
                                            JOIN position_level p ON p.position_level_id = e.position_level_id
                                            JOIN departments d ON d.department_id = e.department_id
                                            JOIN jobs j ON j.job_id = e.job_id
                                            JOIN employees m2 ON e.manager_id2 = m2.employee_id
                                            WHERE e.employee_id = '".$my_emp_id."'";
                                $query_man2 = mysqli_query($conn, $sql_man2);
                                $result_man2 = mysqli_fetch_array($query_man2);
                                $manager_name_2 = $result_man2["manager_name_2"];
                            }

                            ?>
                        <div class="box-header">
                            <div class="col-md6">

                                <div style="float: right;">
                                    <img class='img-circle img-sm img-center' src="http://palmup.xyz/evaluate2success/preview/upload_images/<?php if($result_emp["profile_picture"]== ''){ echo 'default.png' ;}else { echo  $result_emp["profile_picture"];} ?>"  > <span span style="font-size:18px"><?php echo "&nbsp;&nbsp;" . $result_emp["employee_id"] . ' : ' . $result_emp["emp_name"]; ?></span>
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"> <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                    <div col-md-6>
                                <div style="float: left;">
                                        <?php
                                        $eval_code = '';
                                        if (isset($_GET["eval_code"])) {
                                            $eval_code = $_GET["eval_code"];
                                        }

                                        $sql_year_term = "SELECT * FROM evaluation e JOIN term t ON e.term_id=t.term_id WHERE evaluation_code = '$my_eval_code'";
                                        $query_year_term = mysqli_query($conn, $sql_year_term);
                                        while ($result_year_term = mysqli_fetch_array($query_year_term, MYSQLI_ASSOC)) {
                                            echo "<span style='font-size:18px'><b>ปีการประเมิน " . $year = $result_year_term["year"] . "</b></span> | ";
                                            echo "<span style='font-size:18px'>รอบการประเมินที่ " . $term = $result_year_term["term_name"] . " : " . $result_year_term["start_month"] . "-" . $result_year_term["end_month"] . "</span>";
                                        }
                                        ?>
                                </div>
                            </div>
                        </div>  
                        </div>
                        <div class="box-body">
                            <table class="table table-bordered table-striped table-responsive">

                                <tr >
                                    <th rowspan="4" style="text-align: center;">
                                        <img class="img-center img-thumbnail" style="height: 130px;max-width: 110px;" src="http://palmup.xyz/evaluate2success/preview/upload_images/<?php
                                                 if ($result_emp["profile_picture"] == '') {
                                                     echo "default.png";
                                                 } else {
                                                     echo $result_emp["profile_picture"];
                                                 }
                                                 ?>" >
                                    </th>
                                    <th>ชื่อ-นามสกุล</th>
                                    <th>รหัส</th>
                                    <th>ระดับ</th>
                                </tr>
                                <tr>
                                    <td><?php $name=$result_emp["emp_name"]; echo $result_emp["emp_name"]; ?> </td>
                                    <td><?php echo $result_emp["employee_id"]; ?></td>
                                    <td><?php echo $result_emp["position_description"]; ?> </td>
                                </tr>
                                <tr>
                                    <th>ตำแหน่ง</th>
                                    <th>สังกัด / ฝ่าย / สายงาน</th>
                                    <th>วันเริ่มงาน: </th>
                                </tr>
                                <tr>
                                    <td><?php echo $result_emp["job_name"]; ?></td>
                                    <td><?php echo $result_emp["department_name"]; ?></td>
                                    <td><?php echo $result_emp["hiredate"]; ?> <span style="color:maroon;"></span> </td>
                                </tr>
                                <tr>
                                    <th class="text-center">วันที่ประเมิน</th>
                                    <th>ชื่อ - นามสกุลของผู้ประเมินที่ 1</th>
                                    <th>ชื่อ - นามสกุลของผู้ประเมินที่ 2</th>
                                    <th>ระยะเวลาประเมินผล</th>
                                </tr>
                                <tr>
                                    <td class="text-center"> - </td>
                                    <td><?php echo $manager_name_1; ?></td>
                                    <td><?php echo $manager_name_2; ?></td>
                                    <td>
                                        <?php 
                                        $sql_eval_period = "SELECT * FROM evaluation WHERE evaluation_code = '$my_eval_code' ";
                                        $query_eval_period = mysqli_query($conn, $sql_eval_period) or die(mysqli_errno());
                                        $result_eval_period = mysqli_fetch_array($query_eval_period,MYSQLI_ASSOC);
                                        ?>
                                        <?php echo $result_eval_period["open_system_date"]; ?>  ถึง <?php echo $result_eval_period["close_system_date"]; ?>
                                    </td>
                                </tr>
                            </table>
                        </div>

                            <?php
                        }
                        ?>  
                    </div>
                </div>
                <!-- Chart -->
                <div class="row box-padding">
                    <div class="box box-primary ">
                        <?php
                            $sql_kpi_title ="SELECT
                                                    k.*,kr.*,MONTH(NOW()) as current_month
                                            FROM
                                                    kpi k
                                            JOIN kpi_responsible kr ON k.kpi_id = kr.kpi_id
                                            JOIN evaluation_employee ee ON kr.evaluate_employee_id = ee.evaluate_employee_id
                                            JOIN evaluation e ON ee.evaluation_code = e.evaluation_code
                                            JOIN employees em ON em.employee_id = ee.employee_id
                                            WHERE
                                                    k.kpi_code = '$kpi_id'
                                            AND e.evaluation_code = $my_eval_code AND ee.employee_id =$my_emp_id";
                            $query_kpi = mysqli_query($conn, $sql_kpi_title);                            
                                              
                                  
                            
                        ?>
                        <div class="box-header with-border">
                             <?php while($result_kpi = mysqli_fetch_assoc($query_kpi)) {
                
                                $kpi_id = $result_kpi["kpi_code"];
                                $kpi_name = $result_kpi["kpi_name"];
                                $kpi_goal =$result_kpi["goal"];
                                $kpi_unit =$result_kpi["unit"];
                                $kpi_symbol =$result_kpi["measure_symbol"];
                                $kpi_resp_id =$result_kpi["kpi_responsible_id"];
                                $sql_round ="CALL auto_Show_Round($kpi_resp_id,@round)";
                                $query_round = mysqli_query($conn, $sql_round);
                                $sql_round2 ="select @round as round limit 1";
                                $query_round2 = mysqli_query($conn, $sql_round2);
                                // print_r($result_round1);
                                while($result_round2 = mysqli_fetch_assoc($query_round2)) {
                                     $test = $result_round2["round"];
                                }
                                $current_month = $result_kpi["current_month"];
                                    $sql_month_th = "SELECT * FROM month_th WHERE month_id = '$current_month'";
                                    $query_month_th = mysqli_query($conn, $sql_month_th);
                                    $result_month_th = mysqli_fetch_array($query_month_th);
                                    $month_th = $result_month_th["month_name_full"];
                             ?>
                            <strong><?php echo $kpi_id;?> -<?php echo $kpi_name;?></strong> - <small>ข้อมูลความก้าวหน้าของงาน</small>
                                 <?php } ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="box box-primary">
                                <div class="box-body">                                    
                                    <div id="chart_div" style="width: 200px; height: 200px;margin: auto;"></div>     
                                </div>
                            </div>
                        </div>
                        
                        <div class=" col-sm-9">
                            <div class="box box-primary">
                                <div class="box-body">    
                                    <div id="number_format_chart" width="100%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- อัพเดท KPIs-->
                <div class="row box-padding">
                    <div class="box box-default">
                        <div class="box-header">                           
                            <p class="text-center">
                                <strong>อัพเดต KPIs <?php echo ' '.$test; ?></strong>
                                &nbsp;|&nbsp;
                                <strong>ประจำเดือน: <?php echo $month_th; ?></strong>
                            </p>
                        </div>  
                        <form method="POST" action="" >
                            <div class="box-body box-padding-table"> 

                                <table class="table table-bordered ">
                                    <tr class="bg-gray-light">                                        
                                        <td class="text-center">No.</td>
                                        <td class="text-center">KPIs</td>
                                        <td class="text-center">เป้าหมาย</td>
                                        <td class="text-center">ค่าจริง</td>
                                        <td class="text-center">คำอธิบาย</td>
                                        <td class="text-center"></td>
                                        
                                    </tr>
                                    <tr>
                                        <td class="text-center"><?php echo $kpi_id;?></td>
                                        <td class="text-center"><?php echo $kpi_name;?></td>                                        
                                        <td class="text-center"><?php echo $kpi_symbol.''.$kpi_goal.' '.$kpi_unit;?></td>
                                        
                                         <td class="text-center">
                                             
                                              <input type="text" class="input-md" name="upd" >&nbsp;&nbsp;
                                             
                                         </td>
                                         <td class="text-center"><input type="text" class="input-md" name="upd_desc" ></td>
                                         <td>
                                         <div class="form-group">
                                              <button class="btn btn-primary btn-sm" type="submit" name="update">อัพเดท</button>
                                              <input type="hidden" name="resp_id" value="<?php echo $kpi_resp_id ;?>" > 
                                              <input type="hidden" name="empid" value="<?php echo $get_emp_id ;?>" > 
                                              <input type="hidden" name="kpicode" value="<?php echo $kpi_id ;?>" > 
                                              <input type="hidden" name="emp_name" value="<?php echo $progress_time_update; ?>">
                                              <input type="hidden" name="round" value="<?php echo $test ;?>" > 
                                        </div>
                                        </td>
                                    </tr>
                                    
                                </table>
                                
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /Chart -->
                
                <!-- ประวัติการแก้ไข-->
                <div class="row box-padding">
                    <div class="box box-default">
                        <div class="box-header">
                            <p class="text-center">
                                <strong>ประวัติการอัพเดต KPIs</strong>
                            </p>
                        </div> 
                        
                        <?php 
                        $sql_kpi_history ="
                            SELECT k.kpi_name,kp.kpi_progress_id as kpi_progress_id,kp.kpi_progress_update, kp.progress_time_update,k.kpi_code as kpi_id,ks.goal,k.measure_symbol as symbol,kp.kpi_comment,kp.round_update
                            FROM kpi_progress kp JOIN kpi_responsible ks ON kp.kpi_responsible_id = ks.kpi_responsible_id 
                            JOIN kpi k ON ks.kpi_id = k.kpi_id
                            JOIN evaluation_employee ee ON ks.evaluate_employee_id = ee.evaluate_employee_id 
                            JOIN evaluation e ON ee.evaluation_code = e.evaluation_code
                            WHERE ee.employee_id = $get_emp_id  AND
                            e.evaluation_code=$my_eval_code AND k.kpi_code='$kpi_id' and e.company_id=1 order by month_update";
                        $query_kpi_history = mysqli_query($conn,$sql_kpi_history);
                        $count=0;
                        ?>
                        
                            <div class="box-body box-padding-table "> 

                                <table class="table table-bordered table-hover">
                                    <tr class="bg-gray-light">
                                        <td class="text-center">ลำดับ</td>
                                        <td class="text-center">รอบอัพเดท</td>
                                        <td class="text-center">KPIs</td>
                                        <td class="text-center">เป้าหมาย</td>
                                        <td class="text-center">ค่าจริง</td>                                        
                                        <td class="text-center">คำอธิบาย</td>
                                        <td class="text-center">แจ้งขอการแก้ไข</td>
                                    </tr>
                                    <?php
                                        while($result_kpi_history = mysqli_fetch_assoc($query_kpi_history)) {
                
                                        $kpi_id = $result_kpi_history["kpi_id"];
                                        $kpi_name = $result_kpi_history["kpi_name"];                                        
                                        $goal = $result_kpi_history["goal"];
                                        $symbol = $result_kpi_history["symbol"];
                                        $comment = $result_kpi_history["kpi_comment"];
                                        $kpi_progress_update = $result_kpi_history["kpi_progress_update"];
                                        $progress_time_update = $result_kpi_history["progress_time_update"];
                                        $kpi_progress_id = $result_kpi_history["kpi_progress_id"];
                                        $round_update= $result_kpi_history["round_update"];
                                        
                                        $count++;
                                    ?>
                                    <tr>
                                        <td class="text-center"><?php echo $count;?></td>
                                        <td class="text-center"><?php echo $round_update;?></td>
                                        <td class="text-center"><?php echo $kpi_id;?></td>
                                        <td class="text-center"><?php echo $symbol.''.$goal;?></td>
                                        <td class="text-center"><?php echo $kpi_progress_update;?></td>
                                        
                                        <td class="text-center"><?php echo $comment; //href="sendmail/sendmail.php"?></td>
                                        <td class="text-center">
                                            <a class="btn btn-info btn-sm"  data-toggle="modal" data-target="#sendmail_<?php echo $kpi_progress_id; ?>">
                                                
                                                    <i class="glyphicon glyphicon-envelope"></i>
                                            </a>
                                            <!--send mail -->
                                                        <form class="form-horizontal" name="frmMain" method="post" action="hr/sendmail/kpi_sendmail.php" >
                                                            <div class="modal fade" id="sendmail_<?php echo $kpi_progress_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                            <h4 class="modal-title" id="myModalLabel">แจ้งขอการแก้ไข</h4>
                                                                        </div>
                                                                        <div class="modal-body">                                                                                                       <!--<iframe id="iframe_target" name="iframe_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>-->

                                                                            <div class="input-group col-sm-12">
                                                                                <label  for="KPI-CODE" class="col-sm-4 control-label">KPI-CODE</label>
                                                                                <div class="form-group col-sm-8">                                                                                                            
                                                                                    <input readonly type="text" class="form-control"  name="kpi_code" value="<?php echo $kpi_id; ?>">
                                                                                </div>
                                                                            </div>
                                                                           <div class="input-group col-sm-12">
                                                                                <label  for="kpi_name" class="col-sm-4 control-label">ชื่อตัวชี้วัด</label>
                                                                                <div class="form-group col-sm-8">                                                                                                            
                                                                                    <input readonly type="text" class="form-control" name="kpi_name" value="<?php echo $kpi_name; ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="input-group col-sm-12">
                                                                                <label  for="kpi_name" class="col-sm-4 control-label">วันที่</label>
                                                                                <div class="form-group col-sm-8">                                                                                                            
                                                                                    <input readonly type="text" class="form-control" name="date" value="<?php echo $progress_time_update; ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="input-group col-sm-12">
                                                                                <label  for="kpi_desc" class="col-sm-4 control-label">เป้าหมาย</label>
                                                                                <div class="form-group col-sm-8">                                                                                                            
                                                                                    <input readonly type="text" style="" class="form-control" name="kpi_goal" value="<?php echo $symbol . '' . $goal; ?>">
                                                                                </div>
                                                                            </div>                                                                                                

                                                                            <div class="input-group col-sm-12">
                                                                                <label disabled="true" for="measure_symbol" class="col-sm-4 control-label">ค่าจริงเดิม</label>
                                                                                <div class="form-group col-sm-8">                                                                                                            
                                                                                    <input readonly type="text" class="form-control" name="old_success" value="<?php echo $kpi_progress_update; ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="input-group col-sm-12">
                                                                                <label disabled="true" for="measure_symbol" class="col-sm-4 control-label">ค่าจริงใหม่</label>
                                                                                <div class="form-group col-sm-8">                                                                                                            
                                                                                    <input type="text" class="form-control" name="new_success" >
                                                                                </div>
                                                                            </div>
                                                                            <div class="input-group col-sm-12">
                                                                                <label  for="measure_desc" class="col-sm-4 control-label">คำอธิบาย</label>
                                                                                <div class="form-group col-sm-8">                                                                                                            
                                                                                    <input type="text" class="form-control" name="desc" >
                                                                                </div>
                                                                            </div>
                                                                            <div class="input-group col-sm-12">
                                                                                <label  for="measure_desc" class="col-sm-4 control-label">เหตุผลขอการเปลี่ยนแปลง</label>
                                                                                <div class="form-group col-sm-8">                                                                                                            
                                                                                    <input type="text" class="form-control" name="reason" >
                                                                                </div>
                                                                            </div>



                                                                        </div>
                                                                        <div class="modal-footer">                                                                   
                                                                            <button type="submit" name="kpi_sendmail" class="btn btn-primary">ส่งคำร้อง</button>                                                                    
                                                                            <input type="hidden" name="emp_name" value="<?php echo $name; ?>">
                                                                            <input type="hidden" name="emp_id" value="<?php echo $get_emp_id; ?>">
                                                                            
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <!-- send mail-->
                                        </td>
                                    </tr>
                                        <?php } ?>
                                </table>

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
        <?php
                $show_date ="SELECT kp.progress_time_update as date_show,kp.kpi_progress_update as success,ks.goal,kp.round_update                        
                            FROM kpi_progress kp JOIN kpi_responsible ks ON kp.kpi_responsible_id = ks.kpi_responsible_id                             
                            JOIN kpi k ON ks.kpi_id = k.kpi_id
                            JOIN evaluation_employee ee ON ks.evaluate_employee_id = ee.evaluate_employee_id 
                            JOIN evaluation e ON ee.evaluation_code = e.evaluation_code
                            WHERE ee.employee_id = $get_emp_id  AND
                            e.evaluation_code=$my_eval_code AND k.kpi_code='$kpi_id' and e.company_id=1 order by month_update";
                $query_show_date = mysqli_query($conn, $show_date);
               // $round_update= $result_kpi_history["round_update"];
                $array_date[] = array();
                $array_goal[] = array();
                $array_success[] = array();
                $i=0;
                
             
                
            ?>
            
        <script>
            google.charts.load('current', {'packages':['gauge','corechart']});
            
            google.charts.setOnLoadCallback(drawChart);
            
            function drawChart() {
                
                var data = google.visualization.arrayToDataTable([
                    ['Label', 'Value'],
                    <?php while($result_progess = mysqli_fetch_assoc($query_progess)){
                    ?>
                    ['Performance', <?php if($result_progess!=''){echo $result_progess['performance_mile'];}else{ echo 0;} ?>],
                    <?php } ?>        
                    
                ]);
                
                var options = {
                    width: 200, height: 200,
                    redFrom: 90, redTo: 100,
                    yellowFrom:75, yellowTo: 90,
                    minorTicks: 5
                };
                
                var chart = new google.visualization.Gauge(document.getElementById('chart_div'));
                
                chart.draw(data, options);
                
            }
            
            //Colume Chart
            google.charts.setOnLoadCallback(columnChart);
            function columnChart() {
            
                var data2 = google.visualization.arrayToDataTable([
                    ['Month', 'value', { role: 'style' }],
                     <?php 
                     while($result_show_date=  mysqli_fetch_array($query_show_date)){
                    //$array_date[$i] =date("F",strtotime($result_show_date['date_show']));
                    $array_date[$i]=$result_show_date['round_update'];
                    $array_goal[$i] =$result_show_date['goal'];
                    $array_success[$i] =$result_show_date['success'];       
                    //echo $array_date[$i].' '.$array_goal[$i].' '.$array_success[$i]."<br>";
                    
                
                     ?>          
                    ['<?php echo $array_date[$i]; ?>',<?php echo $array_success[$i];?>,'gold'],
                        <?php $i++; } ?>
                ]);
                
                
                var options2 = {
                    title: '<?php echo $kpi_id;?> - <?php echo $kpi_name ?>',
                    legend: 'none',
                    bar: {groupWidth: '70%'},
                    vAxis: { gridlines: { count: 5 } }
                };
                
                var chart = new google.visualization.ColumnChart(document.getElementById('number_format_chart'));
                chart.draw(data2, options2);
            };
            
        </script>
    </body>
</html>
<?php
        }
    }
?>
