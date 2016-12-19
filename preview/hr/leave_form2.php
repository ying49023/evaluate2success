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
        //EMP
        if (isset($_GET["emp_id"])) {
            $get_emp_id = $_GET["emp_id"];
        }
        //EVAL_EMP_ID
        if (isset($_GET["eval_emp_id"])) {
            $get_eval_emp_id = $_GET["eval_emp_id"];
        }
        //EVAL_ID
        if (isset($_GET["eval_code"])) {
            $get_eval_code = $_GET["eval_code"];
        }
        
        //Insert leave date
        if (isset($_POST["submit_leave"])) {
            if (isset($_POST["leave_type_id"])) {
                $array_day = array();
                $c_day = 0;
                foreach($_POST["no_of_day"] as $no_of_day){
                    $array_day[$c_day] = $no_of_day;
//                    echo "date : ".$array_day[$c_day]." / ";
                    $c_day++;
                }
                $array_point = array();
                $c_point = 0;
                foreach ($_POST["point"] as $point){
                    $array_point[$c_point] = $point;
//                    echo "date : ".$array_day[$c_point]." / ";
                    $c_point++;
                }
                $i = 0;
                foreach ($_POST["leave_type_id"] as $leave_type_id) {
                    $eval_emp_id = $_GET["eval_emp_id"];
                    
                    $sql_insert_leave = "CALL insert_eval_leave ($eval_emp_id , $leave_type_id , $array_day[$i])";
                    $i++;
                    $sql_insert_leave;
                    $query_insert_leave = mysqli_query($conn, $sql_insert_leave);
                    
                }
//                header("location:leave_form2.php");
            }
        }
        ?>
        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>แก้ไขข้อมูลพนักงาน : ALT Evaluation</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!--CSS PACKS -->
        <?php include ('./css_packs.html'); ?>
        <!-- SCRIPT PACKS -->
        <?php include('./script_packs.html') ?>
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
                        จัดการวันลาของพนักงาน
                        <small>รอบการ
                        <?php
                            $sql_year_term = "SELECT * FROM evaluation e JOIN term t ON e.term_id=t.term_id WHERE evaluation_code = '3'";
                            $query_year_term = mysqli_query($conn, $sql_year_term);
                            while ($result_year_term = mysqli_fetch_array($query_year_term, MYSQLI_ASSOC)) {
                                echo "<span>ปี : " . $year = $result_year_term["year"] . "</span> | ";
                                echo "<span>รอบการประเมินที่ " . $term = $result_year_term["term_name"] . " : " . $result_year_term["start_month"] . "-" . $result_year_term["end_month"] . "</span>";
                            }
                            ?>
                        </small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Edit profile</li>
                    </ol>
                </section>
                <!--/Page header -->

            <!-- Main content -->
            <div class="row box-padding">
                <div class="box box-success">
                    <div class="box-body">
                        <div class="row"> 
                            <div class="box-padding">
                                <?php
                                $sql_emp = "SELECT
                                        emp.employee_id AS emp_id,
                                        emp.prefix As prefix,
                                        emp.first_name AS f_name,
                                        emp.last_name AS l_name,
                                        emp.hiredate AS hiredate,
                                        emp.manager_id AS manager_id,
                                        emp.email AS email,
                                        emp.telephone_no AS telephone,
                                        dept.department_name AS dept_name,
                                        pos.position_description AS pos,
                                        emp.profile_picture As profile_picture
                                FROM
                                        employees emp
                                JOIN departments dept ON emp.department_id = dept.department_id
                                JOIN position_level pos ON emp.position_level_id = pos.position_level_id
                                WHERE
                                        emp.employee_id = '".$get_emp_id."'
                                LIMIT 1";
                                $query_emp = mysqli_query($conn, $sql_emp); //$conn มาจากไฟล์ connection_mysqli.php เป็นตัว connect DB

                                 while($result_emp = mysqli_fetch_assoc($query_emp)){ 
                                            $emp_id = $result_emp["emp_id"];
                                            $name = $result_emp["prefix"].$result_emp["f_name"]."  ".$result_emp["l_name"];
                                            $hire = $result_emp["hiredate"];
                                            $manager_id = $result_emp["manager_id"];
                                            $dept = $result_emp["dept_name"];
                                            $pos = $result_emp["pos"];
                                            $email = $result_emp["email"];
                                            $tel = $result_emp["telephone"];
                                            $picture = $result_emp["profile_picture"];
                                            
                                            $sql_manager = "SELECT * from employees where employee_id = '".$manager_id."'" ;
                                            $query_manager = mysqli_query($conn, $sql_manager);
                                            $result_manager = mysqli_fetch_array($query_manager);
                                            $manager_name = $result_manager["prefix"].$result_manager["first_name"]." ".$result_manager["last_name"];
                                        ?>

                                <!--ข้อมูลทั่วไป-->
                                <table class="table table-bordered table-condensed">
                                    <tbody>
                                        <tr>
                                            <th rowspan="2" style="padding: 10px;width: 90px;">
                                                <img class="img-circle img-center img-md img-thumbnail" alt="<?php echo $picture; ?>"  src="http://palmup.xyz/evaluate2success/preview/upload_images/<?php if($picture == ''){ echo 'default.png'; }else { echo $picture ; } ?>" >
                                            </th>
                                            <th align="center" width="" >ชื่อ-นามสกุล</th>
                                            <th align="center" width="120px">รหัส</th>
                                            <th align="center" width="" >ระดับ</th>
                                            <th align="center" width="" >แผนก</th>
                                        </tr>
                                            
                                        <tr>
                                            <td><?php echo $name; ?></td>
                                            <td><?php echo $emp_id; ?></td>
                                            <td><?php echo $pos; ?></td>
                                            <td><?php echo $dept; ?></td>
                                                
                                        </tr>
                                        
                                    </tbody>
                                </table>
                                <!--/ข้อมูลทั่วไป-->
                                <a class="" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                    <i class="glyphicon glyphicon-triangle-bottom"></i>รายละเอียดบุคคลเพิ่มเติม
                                </a>
                                <div class="collapse" id="collapseExample" style="margin-top:10px;">
                                    <table class="table table-responsive table-bordered ">
                                        <thead>
                                            <tr class="text-center">
                                                <td colspan="2">วันที่เริ่มงาน</td>
                                                <td colspan="2">email</td>
                                                <td colspan="2">เบอร์โทรศัพท์</td>
                                                <td colspan="2">ผู้บังคับบัญชา</td>
                                            </tr>
                                        </thead>
                                        <tr class="text-center">
                                            <td colspan="2"><?php echo $hire; ?></td>
                                            <td colspan="2"><?php echo $email; ?></td>
                                            <td colspan="2"><?php echo $tel; ?></td>
                                            <td colspan="2"><?php echo $manager_name; ?></td>
                                        </tr>
                                    </table> 
                                </div>  
                                <?php } ?>
                            </div>  
                        </div>
                    </div>
                    <?php 
                                    $sql_select_leave = "SELECT * FROM evaluation_employee WHERE evaluate_employee_id = '$get_eval_emp_id'";
                                    $query_select_leave = mysqli_query($conn, $sql_select_leave);
                                    while($result_select_leave = mysqli_fetch_array($query_select_leave,MYSQLI_ASSOC)) {
                                        if($result_select_leave["point_leave"] != '0') {
                                    
                                    ?>
                                    <!-- Show Leave -->
                                    <form method="post">
                                    <div class="box-body">
                                        
                                        <div class="row box-padding-small">
                                            <div class="col-sm-offset-1 col-sm-10">
                                                                
                                                <table class="table table-hover table-striped table-bordered">
                                                    <thead class="table-active">
                                                                        <?php
                                                                        $sql_month = "SELECT start_month, end_month FROM term t JOIN evaluation e ON e.term_id = t.term_id where evaluation_code = '" . $get_eval_code . "'";
                                                                        $query = mysqli_query($conn, $sql_month); //$conn มาจากไฟล์ connection_mysqli.php เป็นตัว connect DB
                                                                            
                                                                        while ($result = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                                                                            $start = $result["start_month"];
                                                                            $end = $result["end_month"];
                                                                            ?>
                                                        <tr class="bg-info">
                                                            <th colspan="5">เวลาการทำงาน ระหว่าง <u><?php echo $start; ?></u> ถึง <u><?php echo $end; ?></u></th>
                                                                                    
                                                    </tr>
                                                                    <?php } ?>
                                                    <tr align="center">
                                                        <th></th>
                                                        <th class="text-center">ประเภทวันลา</th>
                                                        <th class="text-center">จำนวนวันลา</th>
                                                        <th class="text-center">คะแนนต่อครั้ง</th>
                                                        <th class="text-center">คะแนนวันลา</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                                        <?php
                                                                        $sql_leave_type = "SELECT
                                                                                        lt.leave_type_id AS leave_type_id,
                                                                                        lt.leave_type_description AS leave_type_description,
                                                                                        lt.point AS point,
                                                                                        el.no_of_day as no_of_day,
                                                                                        el.point_leave as point_leave
                                                                                FROM
                                                                                        leaves_type lt
                                                                                LEFT JOIN evaluatation_leave el ON lt.leave_type_id = el.leave_type_id
                                                                                AND el.evaluate_employee_id = '$get_eval_emp_id'";
                                                                        $query_leave_type = mysqli_query($conn, $sql_leave_type);
                                                                            
                                                                        while ($result_leave_type = mysqli_fetch_array($query_leave_type)) {
                                                                            ?>
                                                        <tr>
                                                            <th class="text-center" ><?php echo $result_leave_type["leave_type_id"]; ?></th>
                                                            <th class="text-center" ><?php echo $result_leave_type["leave_type_description"]; ?></th>
                                                            <td class="text-center" ><input class="text-center" type="number"  name="no_of_day[]" min="0" max="365" value="<?php
                                                                                    if ($result_leave_type["no_of_day"] == '') {
                                                                                        echo '0';
                                                                                    } else {
                                                                                        echo $result_leave_type["no_of_day"];
                                                                                    }
                                                                                    ?>"  ></td>
                                                            <td class="text-center" ><?php echo $result_leave_type["point"]; ?></td>
                                                            <td class="text-center"><input class="text-center" type="number"  name="point" min="0" max="60" value="<?php
                                                                                    if ($result_leave_type["point_leave"] == '') {
                                                                                        echo '0';
                                                                                    } else {
                                                                                        echo $result_leave_type["point_leave"];
                                                                                    }
                                                                                    ?>" disabled ></td>
                                                        </tr>
                                                        <input type="hidden" name="point[]" value="<?php echo $result_leave_type["point"]; ?>" >
                                                        <input type="hidden" name="eval_emp_id[]" value="<?php echo $get_eval_emp_id; ?>" >
                                                        <input type="hidden" name="leave_type_id[]" value="<?php echo $result_leave_type["leave_type_id"];  ?>" >
                                                                        <?php } ?>
                                                    </tbody>
                                                    <tfoot>
                                                                        <?php
                                                                        $sql_levae_sum = "SELECT
                                                                                                            SUM(no_of_day) AS sum_day_leave,
                                                                                                            SUM(no_of_hour) AS sum_hour_leave,
                                                                                                            SUM(point_leave) AS sum_point_leave
                                                                                                    FROM
                                                                                                            evaluatation_leave
                                                                                                    WHERE
                                                                                                            evaluate_employee_id = '" . $get_eval_emp_id . "'";
                                                                        $query_leave_sum = mysqli_query($conn, $sql_levae_sum);
                                                                        $result_leave_sum = mysqli_fetch_array($query_leave_sum);
                                                                        ?>
                                                        <tr class="bg-info">
                                                            <td class="text-center" colspan="2"><b>รวม</b></td>
                                                            <td class="text-center"><input class="text-center" type="number"  name="leave" min="1" max="365" value="<?php
                                                                                if ($result_leave_sum == '') {
                                                                                    echo '0';
                                                                                } else {
                                                                                    echo $result_leave_sum["sum_day_leave"];
                                                                                }
                                                                                ?>"  disabled ></td>
                                                            <td></td>
                                                            <td class="text-center"><input class="text-center" type="number"  name="point" min="0.5" max="60" value="<?php
                                                                                if ($result_leave_sum == '') {
                                                                                    echo '0';
                                                                                } else {
                                                                                    echo $result_leave_sum["sum_point_leave"];
                                                                                }
                                                                                ?>"  disabled ></td>
                                                        </tr>
                                                    </tfoot>
                                                                        
                                                </table>
                                            </div>
                                        </div>
                                        <div class="box-footer text-center">
                                            <a class="btn btn-danger search-button" href="leave_form.php">ย้อนกลับ</a>
                                            <button type="submit" class="btn btn-success search-button" name="submit_leave" value="update">อัพเดท</button>
                                        </div>
                                                            
                                    </div>
                                    </form>
                                    <!-- /Show Leave -->
                                    <?php
                                        }else {
                                    ?>
                                    <!-- Insert Leave --> 
                                    <form method="post">
                                    <div class="box-body">
                                        <div class="row box-padding-small">
                                            <div class="col-md-offset-1 col-md-10">
                                                <table class="table table-hover table-striped table-bordered">
                                                            <thead class="table-active">
                                                                            <?php
                                                                            $sql_month = "SELECT start_month, end_month FROM term t JOIN evaluation e ON e.term_id = t.term_id where evaluation_code = '" . $get_eval_code . "'";
                                                                            $query = mysqli_query($conn, $sql_month); //$conn มาจากไฟล์ connection_mysqli.php เป็นตัว connect DB

                                                                            while ($result = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                                                                                $start = $result["start_month"];
                                                                                $end = $result["end_month"];
                                                                                ?>
                                                                <tr class="bg-info">
                                                                    <th colspan="5">เวลาการทำงาน ระหว่าง <u><?php echo $start; ?></u> ถึง <u><?php echo $end; ?></u></th>

                                                            </tr>
                                                                        <?php } ?>
                                                            <tr align="center">
                                                                <th></th>
                                                                <th class="text-center">ประเภทวันลา</th>
                                                                <th class="text-center">จำนวนวันลา</th>
                                                                <th class="text-center">คะแนนต่อครั้ง</th>
                                                                <th class="text-center">คะแนนวันลา</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                                            <?php
                                                                            $sql_leave_type = "SELECT
                                                                                        lt.leave_type_id AS leave_type_id,
                                                                                        lt.leave_type_description AS leave_type_description,
                                                                                        lt.point AS point,
                                                                                        el.no_of_day as no_of_day,
                                                                                        el.point_leave as point_leave
                                                                                FROM
                                                                                        leaves_type lt
                                                                                LEFT JOIN evaluatation_leave el ON lt.leave_type_id = el.leave_type_id
                                                                                AND el.evaluate_employee_id = '$get_eval_emp_id'";
                                                                            $query_leave_type = mysqli_query($conn, $sql_leave_type);

                                                                            while ($result_leave_type = mysqli_fetch_array($query_leave_type)) {
                                                                                ?>
                                                                <tr>
                                                                    <th class="text-center" ><?php echo $result_leave_type["leave_type_id"]; ?></th>
                                                                    <th class="text-center" ><?php echo $result_leave_type["leave_type_description"]; ?></th>
                                                                    <td class="text-center" ><input class="text-center" type="number"  name="no_of_day[]" min="1" max="365"  ></td>
                                                                    <td class="text-center" ><?php echo $result_leave_type["point"]; ?></td>
                                                                    <td class="text-center"><input class="text-center" type="number"  name="point" min="0.5" max="60" value="" disabled ></td>
                                                                </tr>
                                                            <input type="hidden" name="point[]" value="<?php echo $result_leave_type["point"]; ?>" >
                                                            <input type="hidden" name="eval_emp_id[]" value="<?php echo $get_eval_emp_id; ?>" >
                                                            <input type="hidden" name="leave_type_id[]" value="<?php echo $result_leave_type["leave_type_id"];  ?>" >
                                                                            <?php } ?>
                                                            </tbody>
                                                        </table>
                                            </div>
                                        </div>
                                        <div class="box-footer text-center">
                                            <button class="btn btn-danger search-button" onclick="goBack()">ย้อนกลับ</button>
                                            <input  class="btn btn-success search-button" type="submit" name="submit_leave" value="บันทึก">     
                                        </div>
                                    </div>
                                    <!-- /Insert Leave -->   
                                    </form>
                                    <?php        
                                        }
                                    
                                    } 
                                    ?>
                                                  
                 
            

         </div>    



                <!-- /.content -->
                </div>
         
            <!-- /.content-wrapper -->
            </div>

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