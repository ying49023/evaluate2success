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
                    <!-- search -->
                    <div class="box box-success">
                        <div class="box-body">
                            <?php 
                            $eval_code = '';
                            if(isset($_GET["eval_code"])){
                                $eval_code = $_GET["eval_code"];
                            }
                            $get_eval_emp_id = '';
                            if(isset($_GET["eval_emp_id"])){
                                $get_eval_emp_id = $_GET["eval_emp_id"];
                            }
                            
                            $sql_year_term = "SELECT * FROM evaluation e JOIN term t ON e.term_id=t.term_id WHERE evaluation_code = '$eval_code'";
                            $query_year_term = mysqli_query($conn, $sql_year_term);
                            while($result_year_term = mysqli_fetch_array($query_year_term, MYSQLI_ASSOC)){
                                echo "<span style='font-size:18px'><b>ปีการประเมิน ".$year = $result_year_term["year"]."</b></span> | ";
                                echo "<span style='font-size:18px'>รอบการประเมินที่ ".$term = $result_year_term["term_name"]." : ".$result_year_term["start_month"]."-".$result_year_term["end_month"]."</span>";
                            }
                            ?>
                        </div>
                    </div>
                    <!--/search -->
                    <!-- Navbar process -->
                    <?php include './navbar_process.php'; ?>
                    <!-- /Navbar process -->
                    <!-- Part 3 -->
                    <div class="box box-primary">
                        <div class="box-header with-border">

                            <!--Table Point-->
                            <form>
                            <table class="table table-hover">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th colspan="6"><h4><b>3.1 เวลาการทำงาน (Time Attendance)</b></h4></th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr align="center">
                                        <td rowspan=2 colspan=4 style="vertical-align: middle;"><b>ประเภทวันลา</b></td>
                                        <?php
                                            $sql_month = "SELECT start_month, end_month FROM term where term_id = 1";
                                            $query = mysqli_query($conn, $sql_month); //$conn มาจากไฟล์ connection_mysqli.php เป็นตัว connect DB
                                        ?>
                                        <?php
                                            while ($result = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                                                $start = $result["start_month"];
                                                $end = $result["end_month"];
                                         ?>
                                           
                                        <td colspan=2 align="center"><b>ระหว่างเดือน</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $start; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>ถึง</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $end?></td>
                                        <?php } ?>
                        
                                        <td rowspan=2 align="center" style="vertical-align: middle;"><b>รวมคะแนนทั้งหมด</b></td>
                                    </tr>
                                    <tr align="center">
                                       <td align="center"><b>รวมจำนวนวัน</b></td>
                                       <td align="center"><b>ชั่วโมง</b></td>
                                       
                                    </tr>
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
                                        <th scope="row">1</th>
                                        <th scope="row" colspan=2>ลาป่วย</th>
                                        <td></td>
                                        <td align="center"><input type="number" name="leave" min="1" max="365" value="<?php if($result_leave_type_1 == ''){ echo '0'; }else{ echo $result_leave_type_1["no_of_day"];} ?>" disabled readonly ></td>
                                        <td align="center"><input type="number" name="hour" min="1" max="1000" value="<?php if($result_leave_type_1 == ''){ echo '0'; }else{ echo $result_leave_type_1["no_of_hour"];} ?>" disabled readonly ></td>
                                        <td align="center"><input type="number" name="point" min="0.5" max="60" value="<?php if($result_leave_type_1 == ''){ echo '0'; }else{ echo $result_leave_type_1["point_leave"];} ?>" disabled readonly></td>
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
                                        <th scope="row">2</th>
                                        <th scope="row" colspan=2>ลากิจ</th>
                                        <td></td>
                                        <td align="center"><input type="number" name="leave" min="1" max="365" value="<?php if($result_leave_type_2 == ''){ echo '0'; }else{ echo $result_leave_type_2["no_of_day"];} ?>" disabled readonly></td>
                                        <td align="center"><input type="number" name="hour" min="1" max="1000" value="<?php if($result_leave_type_2 == ''){ echo '0'; }else{ echo $result_leave_type_2["no_of_hour"];} ?>" disabled readonly></td>
                                        <td align="center"><input type="number" name="point" min="0.5" max="60" value="<?php if($result_leave_type_2 == ''){ echo '0'; }else{ echo $result_leave_type_2["point_leave"];} ?>" disabled readonly></td>
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
                                        <th scope="row">3</th>
                                        <th scope="row">มาสาย</th>
                                        <td>จำนวนครั้ง</td>
                                        <td><input type="number" name="leave" min="1" max="365" value="<?php if($result_leave_type_3 == ''){ echo '0'; }else{ echo $result_leave_type_3["no_of_day"];} ?>" disabled readonly></td>
                                        <td align="center"><input type="number" name="leave" min="1" max="365" value="<?php if($result_leave_type_3 == ''){ echo '0'; }else{ echo $result_leave_type_3["no_of_day"];} ?>" disabled readonly></td>
                                        <td align="center"><input type="number" name="hour"  min="1" max="1000" value="<?php if($result_leave_type_3 == ''){ echo '0'; }else{ echo $result_leave_type_3["no_of_hour"];} ?>" disabled readonly></td>
                                        <td align="center"><input type="number" name="point" min="0.5" max="60" value="<?php if($result_leave_type_3 == ''){ echo '0'; }else{ echo $result_leave_type_3["point_leave"];} ?>" disabled readonly></td>
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
                                        <th scope="row">4</th>
                                        <th scope="row" colspan=2>ลาอื่นๆ</th>
                                        <td></td>
                                        <td align="center"><input type="number" name="leave" min="1" max="365" value="<?php if($result_leave_type_4 == ''){ echo '0'; }else{ echo $result_leave_type_4["no_of_day"];} ?>" disabled readonly></td>
                                        <td align="center"><input type="number" name="hour" min="1" max="1000" value="<?php if($result_leave_type_4 == ''){ echo '0'; }else{ echo $result_leave_type_4["no_of_hour"];} ?>" disabled readonly></td>
                                        <td align="center"><input type="number" name="point" min="0.5" max="60" value="<?php if($result_leave_type_4 == ''){ echo '0'; }else{ echo $result_leave_type_4["point_leave"];} ?>" disabled readonly></td>
                                    </tr>
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
                                    <tr>
                                        <td align="right" colspan=4><b>รวม</b></td>
                                        <td align="center"><input type="number" name="leave" min="1" max="365" value="<?php if($result_leave_sum == ''){ echo '0'; }else{ echo $result_leave_sum["sum_day_leave"];} ?>" disabled readonly></td>
                                        <td align="center"><input type="number" name="hour" min="1" max="1000" value="<?php if($result_leave_sum == ''){ echo '0'; }else{ echo $result_leave_sum["sum_hour_leave"];} ?>" disabled readonly></td>
                                        <td align="center"><input type="number" name="point" min="0.5" max="60" value="<?php if($result_leave_sum == ''){ echo '0'; }else{ echo $result_leave_sum["sum_point_leave"];} ?>" disabled readonly></td>
                                    </tr>

                                </tbody>
                            </table>
                            </form>
                            <br>
                            <div class="row">
                                <div class="box-padding">
                                    <h4><b>3.2 การพิจารณาความดี ความชอบ และการลงโทษทางวินัย</b></h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 box-padding-table">
                                    
                                    <table class="table table-bordered">
                                        <tr>
                                            <td colspan=2><b><u>ประวัติการได้รับรางวัล / ยกย่อง</u></b></td>
                                        </tr>
                                                <?php
                                                $sql_reward = "SELECT *
                                                    FROM evaluatation_penalty_reward epr 
                                                    JOIN penalty_reward pr ON epr.penalty_reward_id=pr.penalty_reward_id
                                                    WHERE evaluate_employee_id='$get_eval_emp_id' AND pr.penalty_reward_indicated=1";
                                                $query_reward = mysqli_query($conn, $sql_reward);
                                                $i = 0;
                                                while ($reault_reward = mysqli_fetch_array($query_reward, MYSQLI_ASSOC)) {
                                                    $i++;
                                                    ?>
                                        <tr >
                                            <th style="padding: 10px;" scope="row" style="width: 25px;" ><?php echo $i; ?></th>
                                            <td><input type="text" name="reward" size="75" value="<?php echo $reault_reward["penalty_reward_name"]; ?>" readonly></td>
                                        </tr>
                                                    <?php
                                                }
                                                ?>
                                </table>
                                </div>
                                <div class="col-md-6 box-padding-table">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td colspan=2><b><u>ประวัติการลงโทษทางวินัย</u></b></td>
                                        </tr>
                                                <?php
                                                $sql_reward = "SELECT *
                                                    FROM evaluatation_penalty_reward epr 
                                                    JOIN penalty_reward pr ON epr.penalty_reward_id=pr.penalty_reward_id
                                                    WHERE evaluate_employee_id='$get_eval_emp_id' AND pr.penalty_reward_indicated=0";
                                                $query_reward = mysqli_query($conn, $sql_reward);
                                                $i = 0;
                                                while ($reault_reward = mysqli_fetch_array($query_reward, MYSQLI_ASSOC)) {
                                                    $i++;
                                                    ?>
                                        <tr>
                                            <th style="padding: 10px;" scope="row" style="width: 25px;" ><?php echo $i; ?></th>
                                            <td><input type="text" name="reward" size="75" value="<?php echo $reault_reward["penalty_reward_name"]; ?>" readonly></td>
                                        </tr>
                                                    <?php
                                                }
                                                ?>
                                </table>
                                </div>
                            </div>
<!--                             <table class="table table-hover">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th colspan="6"><h4><b>3.2 การพิจารณาความดี ความชอบ และการลงโทษทางวินัย</b></h4></th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan=2><b><u>ประวัติการได้รับรางวัล / ยกย่อง</u></b></td>
                                        <td colspan=2><b><u>ประวัติการลงโทษทางวินัย</u></b></td>
                                    </tr>
                                    
                                    <tr>
                                
                                       <th scope="row"><?php echo $i; ?></th>
                                       <td><input type="text" name="reward" size="40" value="<?php echo $reault_reward["penalty_reward_name"]; ?>" readonly></td>
                                       <th scope="row">1</th>
                                       <td><input type="text" name="penalty" size="40" readonly></td>
                                    </tr>
                                    
                                     <tr>
                                       <th scope="row">2</th>
                                       <td><input type="text" name="reward" size="40" readonly></td>
                                       <th scope="row">2</th>
                                       <td><input type="text" name="penalty" size="40" readonly></td>
                                    </tr>
                                      <tr>
                                       <th scope="row">3</th>
                                       <td><input type="text" name="reward" size="40" readonly></td>
                                       <th scope="row">3</th>
                                       <td><input type="text" name="penalty" size="40" readonly></td>
                                    </tr>
                                     <tr>
                                       <th scope="row">4</th>
                                       <td><input type="text" name="reward" size="40" readonly></td>
                                       <th scope="row">4</th>
                                       <td><input type="text" name="penalty" size="40" readonly></td>
                                    </tr>
                                        <tr>
                                       <th scope="row">5</th>
                                       <td><input type="text" name="reward" size="40" readonly></td>
                                       <th scope="row">5</th>
                                       <td><input type="text" name="penalty" size="40" readonly></td>
                                    </tr>
                                      <tr>
                                       <th scope="row">6</th>
                                       <td><input type="text" name="reward" size="40" readonly></td>
                                       <th scope="row">6</th>
                                       <td><input type="text" name="penalty" size="40" readonly></td>
                                    </tr>
                                      <tr>
                                       <th scope="row">7</th>
                                       <td><input type="text" name="reward" size="40" readonly></td>
                                       <th scope="row">7</th>
                                       <td><input type="text" name="penalty" size="40" readonly></td>
                                    </tr>

                                </tbody>  
                        </table>-->
                            <div class="row">
                                <form action="" method="post">
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <tbody>

                                            <tr>
                                                <td colspan= 2 ><b>ความคิดเห็นของผู้บังคับบัญชาตามสายงาน (ตามข้อเท็จจริง ตามข้อ 3.1, 3.2)</b></td>
                                                <td align="center" style="background-color:#E6E6FA;"><b>คะแนนที่ได้รับเท่ากับ</b></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 20px;">1</th>
                                                <td ><input type="text" name="commentpart3" size="60"></td>
                                                <?php
                                                $sql_get_score = "SELECT point_leave
                                                                FROM evaluation_employee
                                                                WHERE evaluate_employee_id='$get_eval_emp_id'";
                                                $query_get_score = mysqli_query($conn, $sql_get_score);
                                                while($result_get_score = mysqli_fetch_array($query_get_score,MYSQLI_ASSOC)){
                                                ?>
                                                <td align="center"   style="background-color:#F5F5F5;width: 80px;"><input type="number" name="point" min="0.5" max="60" value="<?php echo $result_get_score["point_leave"]; ?>" disabled readonly></td>
                                                <?php } ?>
                                            </tr>
                                             <tr>
                                                <th scope="row">2</th>
                                                <td><input type="text" name="commentpart3" size="60"></td>
                                                <td align="center"  style="background-color:#E6E6FA;"><b>คะแนนเต็ม (ระหว่าง 5-20)</b></td>

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
                                                <th scope="row">3</th>
                                                <td><input type="text" name="commentpart3" size="60"></td>
                                                <td align="center"  style="background-color:#F5F5F5;"><input type="number" name="point" min="5" max="20" value="<?php echo $result_sum_score["sum_point_leave"]; ?>" disabled readonly></td>
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
                            </div>
                            
                                        
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
