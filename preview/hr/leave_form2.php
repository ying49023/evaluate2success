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
        $get_emp__id = '1';
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
        //Company
        $get_company_id = '1';
        if(isset($_GET["comp_id"])){
            $get_company_id = $_GET["comp_id"];
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
                        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="" onclick="goBack()">Manage leave</a></li>
                        <li class="active">Add/update leave</li>
                    </ol>
                </section>
                <!--/Page header -->

            <!-- Main content -->
            <div class="row box-padding">
                <div class="box ">
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
                                WHERE e.employee_id ='".$get_emp_id."' and e.company_id = '$get_company_id'";
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
                                        WHERE e.employee_id = '".$get_emp_id."' and e.company_id = '$get_company_id' ";
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
                                <td><?php echo $manager_name_1; ?></td>
                                <td><?php echo $manager_name_2; ?></td>
                                <td>
                                    <?php 
                                    $sql_eval_period = "SELECT * FROM evaluation WHERE evaluation_code = '".$my_eval_code."' ";
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