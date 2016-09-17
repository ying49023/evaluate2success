<?php
    session_start();
    //Check_login
    if($_SESSION["employee_id"]==''){
        echo "Please login again";
        echo "<a href='login.php'>Click Here to Login</a>";
        header("location:login.php");
    }else{
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
<?php include('./classes/connection_mysqli.php');
        
        $erp='';
        $msg='';
        if(isset($_GET['erp'])){
            $erp=$_GET['erp'];
        }
        //++++++++++++++++++save record+++++++++++++
        if($erp=='save'){
            
            $period=$_POST['add_period'];
            $year=$_POST['add_year'];
            $open_eval=$_POST['add_open'];
            $close_eval=$_POST['add_close'];
            $add_query="INSERT INTO evaluation(company_id,term_id,year,open_system_date,close_system_date) VALUES (1,'$period','$year','$open_eval','$close_eval')";            
            $a_query =  mysqli_query($conn,$add_query);
            if($a_query)
               header ("location:manage_evaluate.php");
            else {
                $msg='Error :'.mysql_error();
                echo "Error Save [" . $add_query . "]";
                
                
            }
        }
            //++++++++++++++++++delete record+++++++++++++
            if($erp=='delete'){            
            $dterm=$_GET['term']; 
            $dyear=$_GET['year'];   
            $eval_code = $_GET["eval_code"];
            $delete="UPDATE evaluation SET current_eval = '0'  WHERE evaluation_code = '$eval_code'";            
            $d_query =  mysqli_query($conn,$delete);
            if($d_query)
               header ("location:manage_evaluate.php");
            else {
                $msg='Error :'.mysql_error();
                echo "Error Save [" . $delete . "]";
                }   


            }
        //++++++++++++++++++update record+++++++++++++
            if($erp=='update'){
                $condition = '';
                if($_POST["textopen"] != '' && $_POST["textclose"] != ''){
                    $condition = " open_system_date= '" . $_POST["textopen"] . "' , close_system_date = '" . $_POST["textclose"] . "' ";
                }else if($_POST["textopen"] != '' && $_POST["textclose"] == ''){
                    $condition = " open_system_date= '" . $_POST["textopen"]."' ";
                }else if($_POST["textopen"] == '' && $_POST["textclose"] != ''){
                    $condition = " close_system_date = '" . $_POST["textclose"] . "' ";
                }
            $strSQL = "UPDATE evaluation SET $condition WHERE company_id = 1 and evaluation_code = '".$_POST["eval_code"]."'";
            $objQuery = mysqli_query($conn,$strSQL);
            if ($objQuery) {
                echo "Record update successfully";
                echo $strSQL;
                header("location:manage_evaluate.php");
            } else {

                echo "Error Save [" . $strSQL . "]";
            }
        }
        ?>
<html>
    <head>
        
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>ระบบประเมินผลปฏิบัติงาน : ALT Evaluation</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!--CSS PACKS -->
        <?php include ('./css_packs.html'); ?>
        <!-- SCRIPT PACKS -->
        <?php include ('./script_packs.html'); ?>
        <!--ListJS-->
        <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.2.0/list.min.js"></script>
        <!-- javascript   menu -->
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                $('#tabs').tab();
            });
        </script> 

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
                        จัดการระบบการประเมินผลการปฏิบัติงาน
                        <small> </small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Evaluate Management</li>
                    </ol>
                </section>
                <!--/Page header -->

                <!-- Main content -->
                
                <!--list employee-->
                <div class="row box-padding">                   

                    <div class="box-header with-border">                        
                        <ul id="tabs" class="nav nav-pills nav-justified" data-tabs="tabs">
                            <li class="active"><a href="#addEmp" data-toggle="tab">จัดการระบบการประเมิน</a></li>
                            <li><a href="#editEmp" data-toggle="tab">จัดการการติดตามKPIs</a></li>        
                        </ul>

                    </div>                                                     

                </div>
                <div id="my-tab-content" class="tab-content" >
                    <div class="tab-pane active col-md-12" id="addEmp">
                        <div class="row box-padding">                  
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <p>กำหนดการเปิด/ปิดระบบการประเมิน</p>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"> 
                                            <i class="fa fa-minus"></i>
                                        </button>

                                    </div>
                                </div>
                                <div class="box-body">
                                  <div class="col-md-offset-1 col-md-10 ">
                                   <table class="table table-hover table-bordered active">
                                        <thead>
                                            <tr>

                                                <th>รอบการประเมิน</th>
                                                <th>วันเปิด</th>
                                                <th>วันปิด</th>
                                                <th class="text-center" style="max-width: 150px;">จัดการ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                       <?php 
                                       $sql_eval = "SELECT evaluation_code, term_id as term,year,DATE_FORMAT(open_system_date,'%d/ %m/ %Y') as open_system_date ,DATE_FORMAT(close_system_date,'%d/ %m/ %Y') as close_system_date from evaluation where company_id=1 AND current_eval='1' ";
                                       $query_eval= mysqli_query($conn, $sql_eval);
                                       while($result_eval = mysqli_fetch_array($query_eval,MYSQLI_ASSOC)) {
                                           $e_year=$result_eval["year"];
                                           ?>
                                       <tr>
                                           
                                           <td><?php echo $result_eval["term"] ; ?> / <?php echo $result_eval["year"] ; ?></td>
                                           <td><?php echo $result_eval["open_system_date"] ; ?></td>
                                           <td><?php echo $result_eval["close_system_date"] ; ?></td>
                                           <td class="text-center">
                                               <a class="btn btn-primary btn-sm" href="" data-toggle="modal" data-target="#<?php echo $result_eval["evaluation_code"]; ?>">
                                                   <i class="glyphicon glyphicon-pencil">แก้ไขรอบประเมิน</i>
                                               </a>
                                               <a class="btn btn-danger btn-sm" href="manage_evaluate.php?erp=delete&eval_code=<?php echo $result_eval["evaluation_code"] ; ?>">
                                                   <i class="glyphicon glyphicon-remove">ปิดรอบประเมิน</i>
                                               </a>
                                               <!--Edit Modal -->
                                                <form class="form-horizontal" name="frmMain" method="post" action="manage_evaluate.php?erp=update" >
                                                    <div class="modal fade" id="<?php echo $result_eval["evaluation_code"]; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-blue">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title" id="myModalLabel">แก้ไขข้อมูล</h4>
                                                                </div>
                                                                <div class="modal-body">

                                                                    <div class="input-group col-sm-12" >
                                                                        <label for="รอบการประเมิน" class="col-sm-4 control-label">เทอม:</label>
                                                                        <div class="col-sm-8">
                                                                            <?php
                                                                                $slq_term = "SELECT term_id,term_name,start_month,end_month
                                                                                            FROM term";
                                                                                $query_term = mysqli_query($conn, $slq_term);
                                                                                ?>                                                              
                                                                            <select class="form-control " name="textterm" disabled="true">
                                                                                    <option value="">--เลือกรอบการประเมิน--</option>
                                                                                            <?php
                                                                                            while ($result_term = mysqli_fetch_array($query_term, MYSQLI_ASSOC)) {
                                                                                                $term_name = $result_term['term_name'];
                                                                                                $term_date = $result_term['start_month'] . '-' . $result_term['end_month'];
                                                                                                $term_id = $result_term['term_id'];
                                                                                                ?>
                                                                                    ?>
                                                                                    <option <?php if($term_name == $result_eval["term"]){ echo "selected";} ?> value="<?php echo $term_name; ?>">เทอม<?php echo $term_name . ' ( '; ?><?php echo $term_date . ' )'; ?></option>
                                                                                        <?php } ?>
                                                                                </select>
                                                                           
                                                                        </div>
                                                                    </div>
                                                                    <div class="input-group col-sm-12" >
                                                                        <label for="รอบการประเมิน" class="col-sm-4 control-label">ปี:</label>
                                                                        <div class="col-sm-8">
                                                                            
                                                                            <select class="form-control " name="textyear" disabled="true" >
                                                                                <option value="">--เลือกปี--</option>                                                                                
                                                                                <?php for($i=2015;$i<=2020;$i++){ ?><option <?php if($i==$e_year){ echo "selected";}?> value="<?php echo $i; ?>"> <?php echo $i; ?> </option><?php } ?>   
                                                                          </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="input-group col-sm-12">
                                                                        <label class="col-sm-4 control-label" >วันเปิด: </label>
                                                                        <div class="col-sm-8"> 
                                                                            <input type="date" class="form-control" name="textopen" value="<?php echo $result_eval["open_system_date"]; ?>" >
                                                                        </div>
                                                                    </div>
                                                                    <div class="input-group col-sm-12">
                                                                        <label class="col-sm-4 control-label">วันปิด: </label>
                                                                        <div class="col-sm-8"> 
                                                                            <input type="date" class="form-control" name="textclose" value="<?php echo $result_eval["close_system_date"]; ?>" >
                                                                        </div>
                                                                    </div>                                              

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <input type="hidden" name="eval_code" value="<?php echo $result_eval["evaluation_code"]; ?>" >
                                                                    <button type="submit" class="btn btn-primary">บันทึก</button>
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                 </form>
                                               <!-- Edit Modal -->
                                               
                                           </td>
                                       </tr>
                                       <?php } ?>
                                        </tbody>
                                   </table>
                                      
                                     <?php echo $msg;?> 
                                      <div class="inline">
                                      <a class="btn btn-warning " data-toggle="modal" data-target="#history" ><i class="glyphicon glyphicon glyphicon-list"></i> &nbsp; ประวัติย้อนหลัง</a>
                                      <input type="submit" value="เพิ่มข้อมูล" class="btn btn-success pull-right" data-toggle="modal" data-target="#myModalAdd">
                                      </div>
                                      <!--Add Modal -->
                                      <form class="form-horizontal" action='manage_evaluate.php?erp=save' method="post">
                                        <div class="modal fade" id="myModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header bg-green">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">เพิ่มข้อมูล</h4>
                                              </div>
                                              <div class="modal-body">                                                  
                                                      <div class="input-group col-sm-12" >
                                                          <label for="รอบการประเมิน" class="col-sm-4 control-label">รอบการประเมิน:</label>
                                                          <div class="col-sm-8">
                                                              <?php
                                                                $slq_term = "SELECT term_id,term_name,start_month,end_month
                                                                            FROM term";
                                                                $query_term = mysqli_query($conn, $slq_term);
                                                                ?>                                                              
                                                              <select class="form-control " name="add_period" >
                                                                    <option value="">--เลือกรอบการประเมิน--</option>
                                                                            <?php
                                                                            while ($result_term = mysqli_fetch_array($query_term, MYSQLI_ASSOC)) {
                                                                                $term_name = $result_term['term_name'];
                                                                                $term_date = $result_term['start_month'] . '-' . $result_term['end_month'];
                                                                                $term_id = $result_term['term_id'];
                                                                                ?>
                                                                    ?>
                                                                    <option value="<?php echo $term_name; ?>">เทอม<?php echo $term_name . ' ( '; ?><?php echo $term_date . ' )'; ?></option>
                                                                        <?php } ?>
                                                                </select>
                                                          </div>
                                                          <label for="ปีการประเมิน" class="col-sm-4 control-label">ปีการประเมิน:</label>
                                                          <div class="col-sm-8">
                                                              <select class="form-control " name="add_year" >
                                                                    <option value="">--เลือกปี--</option>
                                                                    <?php for($i=2015;$i<=2020;$i++){ echo "<option value='$i'>$i</option>" ; } ?>                                         
                                                              </select>
                                                              
                                                          </div>
                                                      </div>
                                                      <div class="input-group col-sm-12">
                                                          <label class="col-sm-4 control-label">วันเปิด: </label>
                                                          <div class="col-sm-8"> 
                                                              <input type="date" class="form-control" name="add_open">
                                                          </div>
                                                      </div>
                                                      <div class="input-group col-sm-12">
                                                          <label class="col-sm-4 control-label">วันปิด: </label>
                                                          <div class="col-sm-8"> 
                                                              <input type="date" class="form-control" name="add_close" >
                                                          </div>
                                                          
                                                      </div>
                                                  
                                              </div>
                                              <div class="modal-footer">
                                                <button type="submit" class="btn btn-success">เพิ่ม</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                                                
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                       </form>
                                      <!-- Add Modal -->
                                      <!--History -->
                                      <div class="modal fade" id="history" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                          <div class="modal-dialog modal-lg" role="document">
                                              <div class="modal-content">
                                                  <div class="modal-header bg-yellow">
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                      <h4 class="modal-title" id="myModalLabel">ข้อมูลการประเมินย้อนหลัง</h4>
                                                  </div>
                                                  <div class="modal-body">                                           
                                                              <?php
                                                              $sql_history_eval = "SELECT term_id as term,year,DATE_FORMAT(open_system_date,'%d/ %m/ %Y') as open_system_date ,DATE_FORMAT(close_system_date,'%d/ %m/ %Y') as close_system_date from evaluation where current_eval=0  ";
                                                              $query_history_eval = mysqli_query($conn, $sql_history_eval);
                                                              ?>    
                                                      <table class="table table-hover">
                                                          <tr>
                                                                      
                                                              <th>รอบการประเมิน</th>
                                                              <th>วันเปิด</th>
                                                              <th>วันปิด</th>
                                                              <th class="text-center">สถานะ</th>
                                                                          
                                                          </tr>
                                                                  <?php while ($result_history_eval = mysqli_fetch_array($query_history_eval, MYSQLI_ASSOC)) { ?>
                                                          <tr>
                                                                          
                                                              <td><?php echo $result_history_eval["term"]; ?> / <?php echo $result_history_eval["year"]; ?></td>
                                                              <td><?php echo $result_history_eval["open_system_date"]; ?></td>
                                                              <td><?php echo $result_history_eval["close_system_date"]; ?></td>
                                                              <td class="text-center"><span style="color:maroon;">ปิดรอบการประเมิน</span></td>
                                                          </tr>
                                                                          
                                                                          
                                                                          
                                                                  <?php } ?>
                                                      </table>
                                                  </div>
                                                  <div class="modal-footer">
                                                              
                                                      <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                                                                  
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                      <!--/History-->
                                   </div>
                                </div>
                            </div>                                                             
                        </div>
                        
                        <div class="row box-padding">                  
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <p>สถานะการประเมินและแจ้งเตือนอีเมลล์</p>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"> 
                                            <i class="fa fa-minus"></i>
                                        </button>

                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="col-md-offset-1 col-md-10">
                                        <table class="table table-bordered table-hover table-striped">
                                            
                                                    <?php
                                                    // Eval_code ตั้ง Default = 3 ไว้ก่อน
                                                    $get_eval_code = 3;
                                                    if (isset($_POST["eval_code"]) && isset($_POST["submit_eval_code"])) {
                                                        $get_eval_code = $_POST["eval_code"];
                                                    }
                                                        
                                                    $sql_pos = "SELECT
                                                                e.employee_id AS emp_id, 
                                                                concat(e.prefix,e.first_name,'  ',e.last_name) As name,
                                                                p.position_level_id AS pos_id, 
                                                                p.position_description AS pos_desc 
                                                        FROM 	position_level p 
                                                        JOIN  employees e ON p.position_level_id = e.position_level_id 
                                                        JOIN  evaluation_employee ee ON ee.employee_id = e.employee_id 
                                                        WHERE ee.evaluation_code = $get_eval_code AND e.position_level_id > 1 AND e.position_level_id <= 3   
                                                          GROUP BY e.position_level_id ORDER BY e.position_level_id";
                                                    $query_pos = mysqli_query($conn, $sql_pos) or die(mysqli_error());
                                                    while ($result_pos = mysqli_fetch_array($query_pos, MYSQLI_ASSOC)) {
                                                        $pos_id = $result_pos["pos_id"];
                                                        $pos_desc = $result_pos["pos_desc"];
                                                        ?>
                                            <thead>
                                                <tr class="bg-light-blue-active">
                                                    <th colspan="6">ระดับ : <?php echo $pos_desc; ?></th>
                                                </tr>
                                                <tr>
                                                    <th>ผู้ประเมิน</th>
                                                    <th>แผนก/ฝ่าย</th>
                                                    <th class="text-center">ประเมินแล้ว</th>
                                                    <th class="text-center">ยังไม่ประเมิน</th>
                                                    <th class="text-center">ทั้งหมด</th>
                                                    <th class="text-center">แจ้งเตือน</th>
                                                </tr>
                                            </thead>
                                            <tbody class="box-padding">
                                                            <?php
                                                            $sql_list_manager = "SELECT e.employee_id As emp_id, concat(e.prefix,e.first_name,'  ',e.last_name) As name FROM evaluation_employee ee
                                                    JOIN employees e ON ee.employee_id = e.employee_id
                                                    WHERE ee.evaluation_code = '$get_eval_code' AND e.position_level_id = $pos_id ";
                                                            $query_list_manager = mysqli_query($conn, $sql_list_manager);
                                                            while($result_list_manager = mysqli_fetch_array($query_list_manager, MYSQLI_ASSOC)) {
                                                                // Manager_id
                                                                $man_emp_id = $result_list_manager["emp_id"];
                                                                    
                                                                $sql_manager = "SELECT
                                                                CONCAT(
                                                                        m.prefix,
                                                                        m.first_name,
                                                                        ' ',
                                                                        m.last_name
                                                                ) AS name,
                                                                d.department_name As dept_name,
                                                                e.manager_id,
                                                                (
                                                                        SELECT
                                                                                COUNT(e.employee_id)
                                                                        FROM
                                                                                evaluation_employee v
                                                                        JOIN employees e ON v.employee_id = e.employee_id
                                                                        JOIN employees m ON e.manager_id = m.employee_id
                                                                        WHERE
                                                                                e.manager_id = $man_emp_id
                                                                        AND status_success = 1
                                                                ) AS count_com,
                                                                (
                                                                        SELECT
                                                                                COUNT(e.employee_id)
                                                                        FROM
                                                                                evaluation_employee v
                                                                        JOIN employees e ON v.employee_id = e.employee_id
                                                                        JOIN employees m ON e.manager_id = m.employee_id
                                                                        WHERE
                                                                                e.manager_id = $man_emp_id
                                                                        AND status_success = 0
                                                                ) AS count_uncom,
                                                                COUNT(e.employee_id) AS count_all
                                                        FROM
                                                                employees e
                                                        JOIN employees m ON e.manager_id = m.employee_id
                                                        JOIN departments d ON m.department_id = d.department_id
                                                        JOIN evaluation_employee ee ON e.employee_id = ee.employee_id
                                                        WHERE ee.evaluation_code = $get_eval_code AND e.manager_id = $man_emp_id";
                                                                $query_manager = mysqli_query($conn, $sql_manager);
                                                                    
                                                                while ($result_manager = mysqli_fetch_array($query_manager, MYSQLI_ASSOC)) {
                                                                    
                                                                    //Count 3 แบบ
                                                                    $count_com = $result_manager["count_com"];
                                                                    $count_uncom = $result_manager["count_uncom"];
                                                                    $count_all = $result_manager["count_all"];
                                                                    ?>
                                                                        
                                                <tr>
                                                    <td><?php echo $result_manager["name"]; ?></td>
                                                    <td><?php echo $result_manager["dept_name"]; ?></td>
                                                    <td class="text-center"><a href="manage_evaluate_sub_list.php?eval_code=<?php echo $get_eval_code ?>&man_id=<?php echo $man_emp_id; ?>"><?php echo $count_com; ?></a></td>
                                                    <td class="text-center"><a href="manage_evaluate_sub_list.php?eval_code=<?php echo $get_eval_code ?>&man_id=<?php echo $man_emp_id; ?>"><?php echo $count_uncom; ?></a></td>
                                                    <td class="text-center"><a href="manage_evaluate_sub_list.php?eval_code=<?php echo $get_eval_code ?>&man_id=<?php echo $man_emp_id; ?>"><?php echo $count_all; ?></a></td>
                                                    <td class="text-center">
                                                        <a class="btn btn-info btn-sm" href="sendmail/sendmail.php">
                                                            <i class="glyphicon glyphicon-envelope"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                
                                                                    <?php
                                                                } //Loop สำหรับเอา Manager_id มา Count ลูกน้อง
                                                            } //Loop เพื่อเอา Manager_id
                                                            ?>
                                                <!-- แทบสีขาว ไว้สำหรับแบ่งระดับ-->
                                                <tr class="table-active">
                                                    <td colspan="6"></td>
                                                </tr>
                                                <!-- /แทบสีขาว ไว้สำหรับแบ่งระดับ-->
                                            </tbody>
                                            
                                                        <?php
                                                    } //Loop สำหรับระดับ ตั้งแต่ระดับ 2-3
                                                    ?>
                                            <tfoot>
                                                
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                
                                <!-- เก่า OLD VERSION -->
                                <!--                                <div class="box-body">
                                  <div class="col-md-offset-1 col-md-10 ">
                                        <?php   
                                        $sql_mail = "SELECT
                                                    m.prefix As prefix,
                                                    m.first_name As first_name,
                                                    m.last_name As last_name,
                                                    (
                                                          SELECT
                                                                  COUNT(e.employee_id)
                                                          FROM
                                                                  evaluation_employee v
                                                          JOIN employees e ON v.employee_id = e.employee_id
                                                          JOIN employees m ON e.manager_id = m.employee_id
                                                          WHERE
                                                                  e.manager_id = 1
                                                        AND sum_point <> 0
                                                    ) AS completed_evaluate,
                                                    COUNT(e.employee_id) - (
                                                        SELECT
                                                                COUNT(e.employee_id)
                                                        FROM
                                                                evaluation_employee v
                                                        JOIN employees e ON v.employee_id = e.employee_id
                                                        JOIN employees m ON e.manager_id = m.employee_id
                                                            WHERE
                                                                e.manager_id = 1
                                                        AND sum_point <> 0
                                                    ) AS uncompleted_evaluate,
                                                    COUNT(e.employee_id) AS all_subordinate
                                                FROM
                                                    employees e
                                            JOIN employees m ON e.manager_id = m.employee_id
                                            WHERE
                                                e.manager_id = e.manager_id"; 
                                        $query_mail = mysqli_query($conn, $sql_mail);
                                        
                                        ?>
                                   <table class="table table-hover">
                                       <thead>
                                       <tr>
                                           <th>ผู้ประเมิน</th>
                                           <th class="text-center">ประเมินแล้ว</th>
                                           <th class="text-center">ยังไม่ประเมิน</th>
                                           <th class="text-center">ทั้งหมด</th>
                                           <th class="text-center">แจ้งเตือน</th>
                                       </tr>
                                       </thead>
                                       <?php 
                                        $sql_meval = "call getNoOfAssessor(3)";
                                        $query_meval= mysqli_query($conn, $sql_meval);
                                        
                                    ?>
                                    <tbody>
                                    <?php 
                                        while($result_meval = mysqli_fetch_array($query_meval,MYSQLI_ASSOC)) {
                                        
                                        $name=$result_meval['name'];
                                        $completed=$result_meval['Completed_evaluate'];
                                        $uncompleted=$result_meval['Uncompleted_evaluate'];
                                        $all=$result_meval['All_subordinate'];
                                        $mng_id=$result_meval['manager_id'];
                                        ?>
                                       <tr>
                                           <td><?php echo $name; ?></td>
                                           <td class="text-center"><a href="manage_evaluate_sub_list.php?mng_id=<?php echo $mng_id ?>"><?php echo $completed; ?></a></td>
                                           <td class="text-center"><a href="manage_evaluate_sub_list.php?mng_id=<?php echo $mng_id ?>"><?php echo $uncompleted; ?></a></td>
                                           <td class="text-center"><a href="manage_evaluate_sub_list.php?mng_id=<?php echo $mng_id ?>"><?php echo $all; ?></a></td>

                                           <td class="text-center">
                                               
                                               <a href="sendmail/sendmail.php">
                                                   <i class="glyphicon glyphicon-envelope"></i>
                                               </a>
                                           </td>
                                       </tr>

                                       <?php } ?>
                                    </tbody>
                                   </table>
                                   </div>
                                </div>-->
                                <!-- /เก่า OLD VERSION -->
                            </div>                                                             
                        </div>

                    </div>
                    
                    
                    <!-- Email -->
                   <div class="tab-pane col-md-12" id="editEmp">
                        <div class="row box-padding">                  
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <p>สถานะการอัพเดทและแจ้งเตือนอีเมลล์</p>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"> 
                                            <i class="fa fa-minus"></i>
                                        </button>

                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="col-md-offset-1 col-md-10 ">
                                        <br>
                                        <form class="form-inline">
                                            <div class="form-group col-md-2">
                                                <label class="control-label">เดือน </label>
                                                <select class="form-control" name="mont">
                                                    <option>ม.ค.</option>
                                                    <option>ก.พ.</option>
                                                    <option>มี.ค.</option>
                                                    <option>เม.ย.</option>
                                                    <option>พ.ค.</option>
                                                    <option>มิ.ย.</option>
                                                    <option selected="true">ก.ค.</option>
                                                    <option>ส.ค.</option>
                                                    <option>ก.ย.</option>
                                                    <option>ต.ค.</option>
                                                    <option>พ.ย.</option>
                                                    <option>ธ.ค.</option>
                                                 </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="control-label">รอบการอัพเดท </label>
                                                <input type="email" class="form-control" id="exampleInputEmail2" placeholder="1-29 ก.ค. 2016"disabled="true">
                                            </div>
                                            <div class="form-group col-md-4">
                                                 <?php
                                                    $sql_department = "SELECT * FROM departments ";
                                                    $query_department = mysqli_query($conn, $sql_department);
                                                 ?>
                                                <label class="control-label">แผนก </label>
                                                <select class="form-control">
                                                <?php while ($result_department = mysqli_fetch_array($query_department, MYSQLI_ASSOC)) { ?>
                                                <option><?php echo $result_department["department_name"]; ?></option>
                                                <?php }  mysqli_close($conn); ?>
                                                 </select>
                                            </div>
                                            
                                        </form>
                                        <br><br><br><br><br>
                                    </div> 
                                    <div class="col-md-offset-1 col-md-10 bg-faded ">
                                        <h4>การอัพเดทความคืบหน้า เดือน กรกฎาคม (วันที่1-29)</h4>
                                    </div>
                                    <div class="col-md-offset-1 col-md-10  ">
                                        <table class="table table-hover">
                                            <tr class="bg-blue">
                                           <th>ชื่อพนักงาน</th>
                                           <th class="text-center">สถานะ</th>
                                           <th class="text-center">ดูรายละเอียด</th>
                                           <th class="text-center">แจ้งเตือนถึงพนักงาน/ผู้บังคับบัญชา</th>
                                           
                                       </tr>
                                       <tr>
                                           <td>นาย สมศักดิ์ ดวงจันทร์</td>
                                           <td class="text-center" style="color: red">uncomplete</td>
                                           <td class="text-center"><a href="#" class="glyphicon glyphicon-eye-open"></a></td>
                                           <td class="text-center"><a href="#" class="glyphicon glyphicon-envelope"></a></td>
                                           
                                       </tr>
                                       
                                   </table>
                                    </div>
                                </div>
                            </div>                                                             
                        </div>

                    </div> 
                    <!-- /Email -->
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

    </body>
    
</html>
            <?php
        }
    }

    
?>
