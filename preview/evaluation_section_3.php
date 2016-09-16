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
<?php 
        $erp='';
        $msg='';
        
        include './classes/connection_mysqli.php';
        
        if (isset($_GET["emp_id"])) {
            $get_emp_id = $_GET["emp_id"];
        }
        //Get Evaluation employee id
        if (isset($_GET["eval_emp_id"])) {
            $get_eval_emp_id = $_GET["eval_emp_id"];
        }
        //Get Evaluation code
        if (isset($_GET["eval_code"])) {
            $get_eval_code = $_GET["eval_code"];
        }
        //Get Position Level
        if(isset($_GET["position_level_id"])){
            $level = $_GET["position_level_id"];
        }


        if(isset($_POST["submit_comment"])){
            $comment1 = '';
            if(isset($_POST["comment1"])){
                $comment1 = $_POST["comment1"];
            }
            $comment2 = '';
            if(isset($_POST["comment2"])){
                $comment2 = $_POST["comment2"];
            }
            $comment3 = '';
            if(isset($_POST["comment3"])){
                $comment3 = $_POST["comment3"];
            }
            $sql_insert_com = "INSERT INTO evaluation_comment(evaluate_comment_id, comment1, comment2, comment3, evaluate_employee_id) 
                                VALUES (DEFAULT,'$comment1','$comment2','$comment3',9)";
            
        }
            
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
                        ส่วนที่ 3 :  การปฏิบัติตามกฎระเบียบและข้อบังคับของบริษัท 
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Evaluation</li>
                    </ol>
                </section>
                <!--/Page header -->
                
                <!-- Main content -->
                <div class="row box-padding">
                    <!-- Brief Info Profile Employee  -->
                    <?php include './breif_info_profile_eval.php'; ?>
                    <!-- /Brief Info Profile Employee  -->
                    
                    <!-- Navbar process -->
                    <?php include './navbar_process.php'; ?>
                    <!-- /Navbar process -->
                    <!-- Part 3 -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h4><b>ส่วนที่ 3 : การปฏิบัติตามกฎระเบียบและข้อบังคับของบริษัท </b></h4>
                        </div>
                        <div class="box-body ">
                            <div class="box-padding-small">
                                <h4><u>ส่วนที่ 3.1</u> เวลาการทำงาน (Time Attendance)</h4>
                            </div>
                            <!--Table leave -->
                            <div class="row box-padding-small">
                                <div class="col-sm-offset-1 col-sm-10">
                            <table class="table table-hover table-striped table-bordered">
                                <thead class="table-active">
                                    <?php
                                            $sql_month = "SELECT start_month, end_month FROM term where term_id = 1";
                                            $query = mysqli_query($conn, $sql_month); //$conn มาจากไฟล์ connection_mysqli.php เป็นตัว connect DB

                                            while ($result = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                                                $start = $result["start_month"];
                                                $end = $result["end_month"];
                                    ?>
                                    <tr class="bg-info">
                                        <th colspan="4">เวลาการทำงาน ระหว่าง <u><?php echo $start; ?></u> ถึง <u><?php echo $end; ?></u></th>
                                       
                                    </tr>
                                    <?php } ?>
                                    <tr align="center">
                                        <th></th>
                                        <th class="text-center">ประเภทวันลา</th>
                                        <th class="text-center">จำนวนวันลา</th>
                                        <th class="text-center">คะแนนวันลา</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql_levae_type_1 = "SELECT * 
                                                        FROM evaluatation_leave
                                                        WHERE
                                                                evaluate_employee_id = '$get_eval_emp_id'
                                                        AND leave_type_id = '1'";
                                    $query_leave_type_1 = mysqli_query($conn, $sql_levae_type_1);
                                    $result_leave_type_1 = mysqli_fetch_array($query_leave_type_1);
                                    ?>
                                    <tr>
                                        <th class="text-center">1</th>
                                        <th class="text-center">ลาป่วย</th>
                                        <td class="text-center"><input class="text-center" type="number"  name="leave" min="1" max="365" value="<?php if($result_leave_type_1 == ''){ echo '0'; }else{ echo $result_leave_type_1["no_of_day"];} ?>" disabled readonly ></td>
                                        <td class="text-center"><input class="text-center" type="number"  name="point" min="0.5" max="60" value="<?php if($result_leave_type_1 == ''){ echo '0'; }else{ echo $result_leave_type_1["point_leave"];} ?>" disabled readonly></td>
                                    </tr>
                                    <?php
                                    $sql_levae_type_2 = "SELECT * 
                                                        FROM evaluatation_leave

                                                        WHERE
                                                                evaluate_employee_id = '$get_eval_emp_id'
                                                        AND leave_type_id = '2'";
                                    $query_leave_type_2 = mysqli_query($conn, $sql_levae_type_2);
                                    $result_leave_type_2 = mysqli_fetch_array($query_leave_type_2);
                                    ?>
                                    <tr>
                                        <th class="text-center">2</th>
                                        <th class="text-center">ลากิจ</th>
                                        <td class="text-center"><input class="text-center" type="number"  name="leave" min="1" max="365" value="<?php if($result_leave_type_2 == ''){ echo '0'; }else{ echo $result_leave_type_2["no_of_day"];} ?>" disabled readonly></td>
                                        <td class="text-center"><input class="text-center " type="number" name="point" min="0.5" max="60" value="<?php if($result_leave_type_2 == ''){ echo '0'; }else{ echo $result_leave_type_2["point_leave"];} ?>" disabled readonly></td>
                                    </tr>
                                    <?php
                                    $sql_levae_type_3 = "SELECT * 
                                                        FROM evaluatation_leave

                                                        WHERE
                                                                evaluate_employee_id = '$get_eval_emp_id'
                                                        AND leave_type_id = '3'";
                                    $query_leave_type_3 = mysqli_query($conn, $sql_levae_type_3);
                                    $result_leave_type_3 = mysqli_fetch_array($query_leave_type_3);
                                    ?>
                                    <tr>
                                        <th class="text-center">3</th>
                                        <th class="text-center">มาสาย</th>
                                        <td class="text-center"><input class="text-center" type="number"  name="leave" min="1" max="365" value="<?php if($result_leave_type_3 == ''){ echo '0'; }else{ echo $result_leave_type_3["no_of_day"];} ?>" disabled readonly></td>
                                        <td class="text-center"><input class="text-center" type="number"  name="point" min="0.5" max="60" value="<?php if($result_leave_type_3 == ''){ echo '0'; }else{ echo $result_leave_type_3["point_leave"];} ?>" disabled readonly></td>
                                    </tr>
                                    <?php
                                    $sql_levae_type_4 = "SELECT * 
                                                        FROM evaluatation_leave

                                                        WHERE
                                                                evaluate_employee_id = '$get_eval_emp_id'
                                                        AND leave_type_id = '4'";
                                    $query_leave_type_4 = mysqli_query($conn, $sql_levae_type_4);
                                    $result_leave_type_4 = mysqli_fetch_array($query_leave_type_4);
                                    ?>
                                    <tr>
                                        <th class="text-center">4</th>
                                        <th class="text-center">ลาอื่นๆ</th>
                                        <td class="text-center"><input class="text-center" type="number"  name="leave" min="1" max="365" value="<?php if($result_leave_type_4 == ''){ echo '0'; }else{ echo $result_leave_type_4["no_of_day"];} ?>" disabled readonly></td>
                                        <td class="text-center"><input class="text-center" type="number"  name="point" min="0.5" max="60" value="<?php if($result_leave_type_4 == ''){ echo '0'; }else{ echo $result_leave_type_4["point_leave"];} ?>" disabled readonly></td>
                                    </tr>
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
                                                            evaluate_employee_id = '$get_eval_emp_id'";
                                    $query_leave_sum = mysqli_query($conn, $sql_levae_sum);
                                    $result_leave_sum = mysqli_fetch_array($query_leave_sum);
                                    
                                    ?>
                                    <tr class="bg-info">
                                        <td class="text-center" colspan="2"><b>รวม</b></td>
                                        <td class="text-center"><input class="text-center" type="number"  name="leave" min="1" max="365" value="<?php if($result_leave_sum == ''){ echo '0'; }else{ echo $result_leave_sum["sum_day_leave"];} ?>" disabled readonly></td>
                                        <td class="text-center"><input class="text-center" type="number"  name="point" min="0.5" max="60" value="<?php if($result_leave_sum == ''){ echo '0'; }else{ echo $result_leave_sum["sum_point_leave"];} ?>" disabled readonly></td>
                                    </tr>
                                </tfoot>
                                
                            </table>
                                </div>
                            </div>
                            <!--/Table leave -->
                            <div class="box-padding-small">
                                <h4><u>ส่วนที่ 3.2</u> การพิจารณาความดี ความชอบ และการลงโทษทางวินัย</h4>
                            </div>
                            <div class="row">
                                <div class="col-md-offset-1 col-md-10 box-padding-small">
                                    <table class="table table-bordered table-striped">
                                        <thead class="bg-success">
                                            <tr>
                                                <th colspan=2><u>ประวัติการได้รับรางวัล / ยกย่อง</u></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <?php
                                                $sql_reward = "SELECT *
                                                    FROM evaluatation_penalty_reward epr 
                                                    JOIN penalty_reward pr ON epr.penalty_reward_id=pr.penalty_reward_id
                                                    WHERE evaluate_employee_id='$get_eval_emp_id' AND pr.penalty_reward_indicated=1";
                                                $query_reward = mysqli_query($conn, $sql_reward);
                                                $count_reward = mysqli_num_rows($query_reward);
                                                if($count_reward == 0){
                                                    ?>
                                                <tr >
                                                    <th  class="text-center" colspan="2">ไม่มีข้อมูลรางวัล </th>
                                                </tr>
                                                    <?php
                                                }else {
                                                $i = 0;
                                                while ($reault_reward = mysqli_fetch_array($query_reward, MYSQLI_ASSOC)) {
                                                    $i++; ?>
                                                    <tr >
                                                        <th style="padding: 10px;width: 60px" class="text-center" ><?php echo $i; ?></th>
                                                        <td><?php echo $reault_reward["penalty_reward_name"]; ?></td>
                                                    </tr>
                                                    <?php
                                                    }
                                                }
                                                ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-offset-1 col-md-10 box-padding-small">
                                    <table class="table table-bordered table-striped">
                                        <thead class="bg-danger">
                                            <tr>
                                                <th colspan="2"><u>ประวัติการลงโทษทางวินัย</u></th>
                                                <th class="text-center">คะแนน</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <?php
                                                $sql_penalty = "SELECT *
                                                    FROM evaluatation_penalty_reward epr 
                                                    JOIN penalty_reward pr ON epr.penalty_reward_id=pr.penalty_reward_id
                                                    WHERE evaluate_employee_id='$get_eval_emp_id' AND pr.penalty_reward_indicated=0";
                                                $query_penalty = mysqli_query($conn, $sql_penalty);
                                                $i = 0;
                                                $count_penalty = mysqli_num_rows($query_penalty);
                                                
                                                if($count_penalty == 0){ ?>
                                                <tr >
                                                    <th  class="text-center" colspan="3">ไม่มีข้อมูลรางวัล </th>
                                                </tr>
                                                <?php
                                                }else{
                                                while ($reault_penalty = mysqli_fetch_array($query_penalty, MYSQLI_ASSOC)) {
                                                    $i++;
                                                    ?>
                                                <tr>
                                                    <th style="padding: 10px;width: 60px" class="text-center" ><?php echo $i; ?></th>
                                                    <td><?php echo $reault_penalty["penalty_reward_name"]; ?></td>
                                                    <td class="text-center" style="width: 100px;"><?php echo $reault_penalty["point"]; ?></td>
                                                </tr>
                                                    <?php
                                                    }
                                                }
                                                ?>
                                                <tr class="bg-danger">
                                                    <th class="text-center" colspan="2"> รวม </th>
                                                    <th class="text-center">0</th>
                                                </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <form method="post">
                            <div class="row">
                                <div class="col-md-offset-1 col-md-10">
                                    <table class="table table-striped table-bordered table-info">
                                        <thead class="bg-light-blue-active">
                                            <tr>
                                                <th class="text-center">คะแนนเวลาการทำงาน + คะแนนการลงโทษทางวินัย</th>
                                                <th class="text-center">คะแนนเต็มรวม</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-info">
                                            <tr>
                                                <?php
                                                $sql_get_score = "SELECT point_leave
                                                                FROM evaluation_employee
                                                                WHERE evaluate_employee_id='$get_eval_emp_id'";
                                                $query_get_score = mysqli_query($conn, $sql_get_score);
                                                
                                                $sql_sum_score = "SELECT sum_point_leave
                                                                    FROM evaluation_sumpoint
                                                                    WHERE position_level_id=( 	SELECT position_level_id
                                                                    FROM employees e 
                                                                    JOIN evaluation_employee ee ON e.employee_id=ee.employee_id
                                                                                                                    WHERE ee.evaluate_employee_id='$get_eval_emp_id')
                                                                    ";
                                                 $query_sum_score = mysqli_query($conn, $sql_sum_score);
                                                 
                                                while($result_get_score = mysqli_fetch_array($query_get_score,MYSQLI_ASSOC)){
                                                ?>
                                                <td class="text-center"><input class="text-center input-md" type="number"  name="point" min="0.5" max="60" value="<?php echo $result_get_score["point_leave"]; ?>" readonly></td>
                                                <?php }
                                                
                                                while($result_sum_score = mysqli_fetch_array($query_sum_score,MYSQLI_ASSOC)){
                                                
                                                ?>
                                                <td class="text-center"><input class="text-center input-md" type="number"  name="point" min="5" max="20" value="<?php echo $result_sum_score["sum_point_leave"]; ?>" readonly></td>
                                                <?php } ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-offset-2 col-md-8">
                                    <h4><u>ความคิดเห็นของผู้บังคับบัญชาตามสายงาน (ตามข้อเท็จจริง ตามข้อ 3.1, 3.2)</u></h4>
                                    <div>
                                        <textarea class="form-control" name="commentpart3" size="60" rows="5" placeholder="เขียนความเห็น(ตามข้อเท็จจริง ตามข้อ 3.1, 3.2)"></textarea>
                                    </div>         
                                            
                                </div>
                                <div class="col-md-offset-1 col-md-10">
                                    <div class="form-group box-padding-small text-center">
                                        <input class="btn btn-success btn-lg search-button" type="submit" name="submit_comment" value="บันทึก">
                                        <input class="btn btn-danger btn-lg search-button" type="reset" name="reset" value="รีเซ็ต" >
                                    </div>  
                                </div>
                            </div>
                            </form>
<!--                            
                                
                                <form action="" method="post"> 
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <tbody>

                                            <tr>
                                                <td colspan= 2 ><b>ความคิดเห็นของผู้บังคับบัญชาตามสายงาน (ตามข้อเท็จจริง ตามข้อ 3.1, 3.2)</b></td>
                                                <td class="text-center" style="background-color:#E6E6FA;"><b>คะแนนที่ได้รับเท่ากับ</b></td>
                                            </tr>
                                            <tr>
                                                <th class="text-center" style="width: 20px;">1</th>
                                                <td ><input type="text" size="60"></td>
                                                <?php
                                                $sql_get_score = "SELECT point_leave
                                                                FROM evaluation_employee
                                                                WHERE evaluate_employee_id='$get_eval_emp_id'";
                                                $query_get_score = mysqli_query($conn, $sql_get_score);
                                                while($result_get_score = mysqli_fetch_array($query_get_score,MYSQLI_ASSOC)){
                                                ?>
                                                <td class="text-center"   style="background-color:#F5F5F5;width: 80px;"><input class="text-center" type="number"  name="point" min="0.5" max="60" value="<?php echo $result_get_score["point_leave"]; ?>" disabled readonly></td>
                                                <?php } ?>
                                            </tr>
                                             <tr>
                                                <th class="text-center">2</th>
                                                <td><input type="text" name="commentpart3" size="60"></td>
                                                <td class="text-center"  style="background-color:#E6E6FA;"><b>คะแนนเต็ม (ระหว่าง 5-20)</b></td>

                                            </tr>
                                             <tr>
                                                 <?php
                                                 $sql_sum_score = "SELECT sum_point_leave
                                                                    FROM evaluation_sumpoint
                                                                    WHERE position_level_id=( 	SELECT position_level_id
                                                                    FROM employees e 
                                                                    JOIN evaluation_employee ee ON e.employee_id=ee.employee_id
                                                                                                                    WHERE ee.evaluate_employee_id='$get_eval_emp_id')
                                                                    ";
                                                 $query_sum_score = mysqli_query($conn, $sql_sum_score);
                                                 while($result_sum_score = mysqli_fetch_array($query_sum_score,MYSQLI_ASSOC)){
                                                 ?>
                                                <th class="text-center">3</th>
                                                <td><input type="text" name="commentpart3" size="60"></td>
                                                <td class="text-center"  style="background-color:#F5F5F5;"><input class="text-center" type="number"  name="point" min="5" max="20" value="<?php echo $result_sum_score["sum_point_leave"]; ?>" disabled readonly></td>
                                                 <?php } ?>
                                             </tr>


                                        </tbody>
                                        
                                  </table>
                                    <div class="form-group">
                                        <input class="btn btn-success" type="submit" name="submit_comment" value="บันทึก">
                                        <input class="btn btn-danger" type="reset" name="reset" value="รีเซ็ต" >
                                    </div>
                                </div>
                            </form>    
                            </div>-->
                            
                                        
                        </div>           
                    </div> 
                    <!-- /Part 3 -->       
                    <!-- /.content -->
                </div>
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
    <!-- SCRIPT PACKS -->
    <?php include('./script_packs.html') ?>
        
</html>
            <?php
        }
    }

    
?>
