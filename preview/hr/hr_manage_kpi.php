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
<html>
<head>
    <?php
    include ('./classes/connection_mysqli.php');
     $get_eval_code = ''; //ตั้งค่า Default = 1 ไว้เพื่อไม่ให้เกิด ERROR ในการ Query SQL
        //เงื่อนไขนี้เป็นการเช็คว่ามีส่งมาไหม
        if (isset($_GET["eval_code"])) {
            $get_eval_code = $_GET["eval_code"]; //GET ค่ามาจากหน้า hr_kpi_individual.php ผ่านลิงค์ 
        }
    $get_emp_id = "1"; //ตั้งค่า Default = 1 ไว้เพื่อไม่ให้เกิด ERROR ในการ Query SQL
        //เงื่อนไขนี้เป็นการเช็คว่ามีส่งมาไหม
        if (isset($_GET["emp_id"])) {
            $get_emp_id = $_GET["emp_id"]; //GET ค่ามาจากหน้า hr_kpi_individual.php ผ่านลิงค์ 
            
        }
       
        
        $erp='';
        if(isset($_GET['erp'])){
            $erp=$_GET['erp'];
            
            if($erp=='insert'){
               $i_emp_id=$_POST['i_emp_id'];
               $i_eval_code=$_POST['i_eval_code'];
               $insert_kpi_id =$_POST['insert_kpi_id']; 
               $insert_goal =$_POST['insert_goal'];
               $insert_weight =$_POST['insert_weight'];
              // $hidden_group_id=$_POST['hidden_group_id'];
               $sql_eval_emp ="select * from evaluation_employee where employee_id=$i_emp_id and evaluation_code=$i_eval_code";
               $query_eval_emp = mysqli_query($conn, $sql_eval_emp);
              while($result_eval_emp = mysqli_fetch_array($query_eval_emp,MYSQLI_ASSOC)){
                $eval_emp = $result_eval_emp['evaluate_employee_id'];
                $strSQL ="CALL assign_kpi_individual($eval_emp,$insert_kpi_id,$insert_goal,$insert_weight)";
               $objQuery = mysqli_query($conn,$strSQL);
            }
               
               if ($objQuery) {

                   header ("location:hr_manage_kpi.php?emp_id=$i_emp_id&eval_code=$i_eval_code");

               } else {

                   echo "Error Save [" . $strSQL . "]";
               }
            }
            
             //++++++++++++++++++update record+++++++++++++
           if($erp=='update'){          
               $u_emp_id=$_POST['u_emp_id'];
               $u_eval_code=$_POST['u_eval_code'];
               //$u_kpicode =$_POST['kpi_code'];
               $u_kpiname =$_POST['u_kpi_name'];
               $u_kpi_desc =$_POST['u_kpi_desc'];
               $u_measure_symbol =$_POST['u_measure_symbol'];
               $u_measure_desc =$_POST['u_measure_desc'];
               $u_unit =$_POST['u_unit'];
               $u_time_period =$_POST['u_time_period'];
               $u_default_weight =$_POST['u_default_weight'];
               //$hidden_group_id=$_POST['hidden_group_id'];
               $u_id=$_GET['id'];
               $u_goal=$_POST['u_goal'];
               $strSQL =" UPDATE kpi_responsible SET goal='$u_goal',percent_weight='$u_default_weight'"                       
                       . "where kpi_id=$u_id ";
               $objQuery = mysqli_query($conn,$strSQL);
               if ($objQuery) {

                   header ("location:hr_manage_kpi.php?emp_id=$u_emp_id&eval_code=$u_eval_code");


               } else {

                   echo "Error Save [" . $strSQL . "]";
               }

           }
           
           //++++++++++++++++++delete record+++++++++++++
           if($erp=='delete'){        
               $d_emp_id=$_POST['d_emp_id'];
               $d_eval_code=$_POST['d_eval_code'];
               $id=$_GET['id'];
               $strSQL =" DELETE FROM kpi_responsible WHERE kpi_responsible_id=$id ";
               $objQuery = mysqli_query($conn,$strSQL);
               if ($objQuery) {

                   header ("location:hr_manage_kpi.php?emp_id=$d_emp_id&eval_code=$d_eval_code");


               } else {

                   echo "Error Save [" . $strSQL . "]";
               }

           }
           
           //++++++++++++++++++submit+++++++++++++
           if($erp=='submit'){        
               $s_dept_id=$_POST['hidden_dept'];
               $s_job_id=$_POST['hidden_job'];
               $s_eval=$_POST['hidden_eval'];               
               $sql_submit = "call auto_assign_kpi($s_dept_id,$s_job_id,$s_eval)";
               $objQuery = mysqli_query($conn,$sql_submit);
               if ($objQuery) {

                   header ("location:hr_manage_kpi.php?department_id=$s_dept_id&job_id=$s_job_id");


               } else {

                   echo "Error Save [" . $sql_submit . "]";
               }

           }
            
        }
        
        ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ระบบประเมินผลปฏิบัติงาน : ALT Evaluation</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- CSS PACKS -->
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
                    กำหนดKPIs
                    <small>รอบที่ 1 2559</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="#"> <i class="fa fa-dashboard"></i>
                            Home
                        </a>
                    </li>
                    <li class="active">Assign KPIs</li>
                </ol>
            </section>
            <!--/Page header -->

            <!-- Main content -->
            <div class="row box-padding">
                <div class="box box-success">
                            <?php
                            $sql_emp = "SELECT
                                                    GROUP_CONCAT(e.prefix,e.first_name,'  ',e.last_name) as emp_name,e.hiredate , e.*, p.*,j.*,d.*,
                                                    GROUP_CONCAT(m.prefix,m.first_name,'  ',m.last_name) as manager_name_1,
                                                    GROUP_CONCAT(m2.prefix,m2.first_name,'  ',m2.last_name) as manager_name_2
                                            FROM
                                                    employees e
                                            JOIN position_level p ON p.position_level_id = e.position_level_id
                                            JOIN departments d ON d.department_id = e.department_id
                                            JOIN jobs j ON j.job_id = e.job_id
                                            JOIN employees m ON e.manager_id = m.employee_id
                                            JOIN employees m2 ON m.manager_id = m2.employee_id
                                            WHERE
                                                    e.employee_id ='" . $get_emp_id . "'";
                            $query_emp = mysqli_query($conn, $sql_emp);
                            while ($result_emp = mysqli_fetch_array($query_emp, MYSQLI_ASSOC)) {
                                ?>
                                <div class="box-header">
                                    <div class="col-md6">


                                        <div style="float: right;">
                                            <img class='img-circle img-sm img-center' src="../upload_images/<?php if ($result_emp["profile_picture"] == '') {
                        echo 'default.png';
                    } else {
                        echo $result_emp["profile_picture"];
                    } ?>"  > <span span style="font-size:18px"><?php echo "&nbsp;&nbsp;" . $result_emp["employee_id"] . ' : ' . $result_emp["emp_name"]; ?></span>
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

                                                $sql_year_term = "SELECT * FROM evaluation e JOIN term t ON e.term_id=t.term_id WHERE evaluation_code = '$eval_code'";
                                                $query_year_term = mysqli_query($conn, $sql_year_term);
                                                while ($result_year_term = mysqli_fetch_array($query_year_term, MYSQLI_ASSOC)) {
                                                    $eval_year = $result_year_term["year"];
                                                    $eval_term = $result_year_term["term_name"] . " : " . $result_year_term["start_month"] . "-" . $result_year_term["end_month"];
                                                    echo "<span style='font-size:18px'><b>ปีการประเมิน " . $eval_year . "</b></span> | ";
                                                    echo "<span style='font-size:18px'>รอบการประเมินที่ " . $eval_term . "</span>";
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
                                                <img class="img-center img-thumbnail" style="height: 130px;max-width: 110px;" src="../upload_images/<?php
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
                                            <td><?php echo $result_emp["emp_name"]; ?> </td>
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
                                            <td><?php echo $result_emp["manager_name_1"]; ?></td>
                                            <td><?php echo $result_emp["manager_name_2"]; ?></td>
                                            <td>
                                                <?php
                                                $sql_eval_period = "SELECT * FROM evaluation WHERE evaluation_code = '$eval_code' ";
                                                $query_eval_period = mysqli_query($conn, $sql_eval_period) or die(mysqli_errno());
                                                $result_eval_period = mysqli_fetch_array($query_eval_period, MYSQLI_ASSOC);
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
            <div class="row box-padding" style="margin-top: -20px;">
                <h3>KPIs สำหรับการประเมินในรอบ ม.ค. - มิ.ย. 59</h3>
            </div>
            <div class="row box-padding">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <b>เพิ่ม และ แก้ไขข้อ KPI</b>
                        <button class="btn btn-success pull-right"  data-toggle="collapse" data-target="#newNextKPI">+ เพิ่ม</button>
                    </div>
                    <div id="newNextKPI" class="collapse">
                        <form action="hr_manage_kpi.php?erp=insert" method="post">
                        <div class="box-padding row">
                            <div class="form-group col-sm-5">
                                <label>ชื่อ KPI</label>
                                <?php
                                $sql_kpi = "SELECT * FROM kpi";
                                $query_kpi = mysqli_query($conn, $sql_kpi);
                                ?>

                                <select class="form-control " name="insert_kpi_id" required >

                                    <option>เลือกkpi </option>
                                    <?php while ($result_kpi = mysqli_fetch_array($query_kpi, MYSQLI_ASSOC)) { ?>
                                    <option value="<?php echo $result_kpi["kpi_id"]; ?>"><?php echo $result_kpi["kpi_code"]." - ".$result_kpi["kpi_name"]; ?></option>
                                    <?php } ?>

                                </select>
                            </div>
                            <div class="form-group col-sm-3">
                                <label>น้ำหนัก(%)</label>
                                <input class="form-control" type="number"  step="5" name="insert_weight" required > 
                            </div>
                            <div class="form-group col-sm-3">
                                <label>เป้าหมาย</label>
                                <input class="form-control" type="text"  name="insert_goal" required> 
                            </div>
                            
                            <div class="form-group col-sm-1">
                                <input style="margin-top: 25px;" class="btn btn-danger" type="submit"  name="submit" value="บันทึก" > 
                                <input  type="hidden" name="i_emp_id" value="<?php echo $get_emp_id; ?>" >                                
                                <input type="hidden" value="<?php echo $get_eval_code; ?>" name="i_eval_code">
                            </div>
                        </div>
                        </form>
                    </div>
                    <div class="box-body">
                        <?php
                               
                                        
                                        $sql_kpi = "select k.*,kp.percent_weight as percent_weight,kp.goal as goal,kp.kpi_responsible_id
                                                    from kpi_responsible kp join kpi k on kp.kpi_id=k.kpi_id
                                                    join evaluation_employee ee on ee.evaluate_employee_id=kp.evaluate_employee_id
                                                    where ee.employee_id=$get_emp_id and ee.evaluation_code=$get_eval_code
                                                    order by kpi_id";
                                        $query_kpi= mysqli_query($conn, $sql_kpi);     
                                        
                                       
                        ?>
                        <table class="table table-hover table-bordered">
                                <thead class="bg-blue">
                                                <tr>
                                                    <th>KPI-CODE</th>
                                                    <th>ชื่อตัวชี้วัด</th>
                                                    <th>คำอธิบาย</th>                                                    
                                                    <th>สัญลักษณ์</th>
                                                    <th>คำอธิบายสัญลักษณ์</th>
                                                    <th>เป้าหมาย</th>
                                                    <th>หน่วยวัด</th>
                                                    <th>ระยะเวลา</th>                                                    
                                                    <th>น้ำหนัก</th>
                                                    <th>จัดการ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php  while($result_kpi  = mysqli_fetch_array($query_kpi ,MYSQLI_ASSOC)) {
                                                        $kpi_id = $result_kpi['kpi_id'];
                                                        $kpi_name = $result_kpi['kpi_name'];
                                                        $kpi_description = $result_kpi['kpi_description'];
                                                        $kpi_code = $result_kpi['kpi_code'];
                                                        $kpi_group_id = $result_kpi['kpi_group_id'];
                                                        $kpi_unit = $result_kpi['unit'];
                                                        $kpi_goal= $result_kpi['goal'];
                                                        $kpi_time_period= $result_kpi['time_period'];
                                                        $kpi_measure_symbol = $result_kpi['measure_symbol'];
                                                        $kpi_measure_desc = $result_kpi['measure_desc'];
                                                        $kpi_default_weight = $result_kpi['percent_weight']; 
                                                        $kpi_responsible_id=$result_kpi['kpi_responsible_id'];
                                                ?>            
                                                <tr>
                                                    <td><?php echo $kpi_code; ?></td>
                                                    <td><?php echo $kpi_name; ?></td>
                                                    <td><?php echo $kpi_description; ?></td>                                                   
                                                    <td><?php echo $kpi_measure_symbol; ?></td>
                                                    <td><?php echo $kpi_measure_desc; ?></td>
                                                    <td><?php echo $kpi_goal; ?></td>
                                                    <td><?php echo $kpi_unit; ?></td>
                                                    <td><?php echo $kpi_time_period.' เดือน'; ?></td>
                                                    
                                                    <td><?php echo $kpi_default_weight; ?></td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#<?php echo $kpi_id; ?>_update">
                                                            <i class="glyphicon glyphicon-pencil" ></i>แก้ไข
                                                        </button>                                                   
                                                        |
                                                                                    
                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"  data-target="#<?php echo $kpi_id; ?>_delete">
                                                            <i class="glyphicon glyphicon-remove" ></i>ลบ
                                                        </button>
                                                        <!--Edit Modal -->
                                                        <form class="form-horizontal" name="frmMain" method="post" action="hr_manage_kpi.php?erp=update&id=<?php echo $kpi_id; ?>" >
                                                            <div class="modal fade" id="<?php echo $kpi_id; ?>_update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                            <h4 class="modal-title" id="myModalLabel">แก้ไขข้อมูล</h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                                                    
                                                                            <div class="input-group col-sm-12">
                                                                                <label  for="KPI-CODE" class="col-sm-4 control-label">KPI-CODE</label>
                                                                                <div class="form-group col-sm-8">                                                                                                            
                                                                                    <input type="text" class="form-control" disabled="true" name="u_kpi_code" value="<?php echo $kpi_code ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="input-group col-sm-12">
                                                                                <label  for="kpi_name" class="col-sm-4 control-label">ชื่อตัวชี้วัด</label>
                                                                                <div class="form-group col-sm-8">                                                                                                            
                                                                                    <input readonly="true" type="text" class="form-control" name="u_kpi_name" value="<?php echo $kpi_name ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="input-group col-sm-12">
                                                                                <label  for="kpi_desc" class="col-sm-4 control-label">คำอธิบาย</label>
                                                                                <div class="form-group col-sm-8">                                                                                                            
                                                                                    <input readonly="true" type="text" style="" class="form-control" name="u_kpi_desc" value="<?php echo $kpi_description ?>">
                                                                                </div>
                                                                            </div>
                                                                                                        
                                                                                                        
                                                                            <div class="input-group col-sm-12">
                                                                                <label  for="measure_symbol" class="col-sm-4 control-label">สัญลักษณ์</label>
                                                                                <div class="form-group col-sm-8">                                                                                                            
                                                                                    <input readonly="true" type="text" class="form-control" name="u_measure_symbol" value="<?php echo $kpi_measure_symbol ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="input-group col-sm-12">
                                                                                <label  for="measure_desc" class="col-sm-4 control-label">คำอธิบายสัญลักษณ์</label>
                                                                                <div class="form-group col-sm-8">                                                                                                            
                                                                                    <input readonly="true" type="text" class="form-control" name="u_measure_desc" value="<?php echo $kpi_measure_desc ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="input-group col-sm-12">
                                                                                <label  for="goal" class="col-sm-4 control-label">เป้าหมาย</label>
                                                                                <div class="form-group col-sm-8">                                                                                                            
                                                                                    <input  type="text" class="form-control" name="u_goal" value="<?php echo $kpi_goal ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="input-group col-sm-12">
                                                                                <label  for="unit" class="col-sm-4 control-label">หน่วยวัด</label>
                                                                                <div class="form-group col-sm-8">                                                                                                            
                                                                                    <input readonly="true" type="text" class="form-control" name="u_unit" value="<?php echo $kpi_unit ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="input-group col-sm-12">
                                                                                <label  for="time_period" class="col-sm-4 control-label">ระยะเวลา(เดือน)</label>
                                                                                <div class="form-group col-sm-8">                                                                                                            
                                                                                    <input readonly="true" type="text" class="form-control" name="u_time_period" value="<?php echo $kpi_time_period ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="input-group col-sm-12">
                                                                                <label  for="default_weight" class="col-sm-4 control-label">น้ำหนัก</label>
                                                                                <div class="form-group col-sm-8">                                                                                                            
                                                                                    <input type="text" class="form-control" name="u_default_weight" value="<?php echo $kpi_default_weight ?>">
                                                                                </div>
                                                                            </div>                                           
                                                                                                        
                                                                                                        
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" class="btn btn-success">บันทึก</button>
                                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
                                                                            <input type="hidden" value="<?php echo $get_emp_id; ?>" name="u_emp_id">
                                                                            <input type="hidden" value="<?php echo $get_eval_code; ?>" name="u_eval_code">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <!--Edit Modal -->
                                                                                    
                                                        <!--Delete Modal -->
                                                        <form class="form-horizontal" name="frmMain" method="post" action="hr_manage_kpi.php?erp=delete&id=<?php echo $kpi_responsible_id; ?>" >
                                                            <div class="modal fade" id="<?php echo $kpi_id; ?>_delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                            <h4 class="modal-title" id="myModalLabel">ลบข้อมูล</h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="input-group col-sm-12">
                                                                                <label  for="KPI-CODE" class="col-sm-4 control-label">KPI-CODE</label>
                                                                                <div class="form-group col-sm-8">                                                                                                            
                                                                                    <input type="text" class="form-control" disabled="true"  value="<?php echo $kpi_code ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="input-group col-sm-12">
                                                                                <label  for="kpi_name" class="col-sm-4 control-label">ชื่อตัวชี้วัด</label>
                                                                                <div class="form-group col-sm-8">                                                                                                            
                                                                                    <input type="text" class="form-control"  disabled="true" value="<?php echo $kpi_name ?>">
                                                                                </div>
                                                                            </div>
                                                                                                        
                                                                                                        
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" class="btn btn-danger">ยืนยันการลบ</button>
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                                            <input type="hidden" value="<?php echo $get_emp_id; ?>" name="d_emp_id">
                                                                            <input type="hidden" value="<?php echo $get_eval_code; ?>" name="d_eval_code">
                                                                                                        
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <!--Delete Modal -->
                                                    </td>
                                                </tr>
                                            </tbody>
                                         <?php }  ?>

                                        </table>
                    </div>
                </div>

            </div>
            <!--สำรอง-->
            <!--            <div class="row box-padding">
                            <div class="box box-primary">
                                <div class="box-header with-border"> <b>เพิ่มเติม/แก้ไขKPI</b>
                                </div>
                                <div class="box-body box-padding-small">
                                    <form action="">
                                        <div class="row">
                                            <div class="form-group col-sm-7">
                                                <label class="control-label pull-left">ชื่อ KPI</label>
                                                <div class="">
                                                <?php 
                                                  $sql_kpi = "SELECT * FROM kpi"; 
                                                  $query_kpi = mysqli_query($conn, $sql_kpi);

                                                ?>

                                                    <select class="form-control">

                                                        <option>เลือกkpi </option>
                                                         <?php while ($result_kpi = mysqli_fetch_array($query_kpi, MYSQLI_ASSOC)) { ?>
                                                        <option><?php echo $result_kpi["kpi_name"]; ?></option>
                                                    <?php } ?>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-2">
                                                <label class="control-label pull-left">น้ำหนัก(%)</label>
                                                    <input class="form-control" type="text">
                                            </div>
                                            <div class="form-group col-sm-3">
                                                <label class="control-label pull-left">เป้าหมาย</label>
                                                    <input class="form-control" type="text">
                                            </div>
                                            <div class="form-group col-sm-2">
                                                <label class="control-label pull-left">หน่วย</label>
                                                <input class="form-control" type="text" placeholder="(เปลี่ยนตามหัวข้อKPI)" readonly="">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <button class="btn btn-file">เพิ่ม</button>
                                                <input type="submit" class="btn btn-microsoft" value="บันทึก" />
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>-->

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
            <?php
        }
    }

    
?>