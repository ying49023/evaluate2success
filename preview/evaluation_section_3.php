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
            if(isset($_POST["eval_emp_id"])){
                $eval_emp_id = $_POST["eval_emp_id"];
                $comment1 = '';
                if (isset($_POST["comment1"])) {
                    $comment1 = $_POST["comment1"];
                }
                //Check record
                $sql_check = "select * from evaluation_comment where evaluate_employee_id = '$eval_emp_id' ";
                $query_check = mysqli_query($conn, $sql_check);
                $count_row = mysqli_fetch_row($query_check);
                if($count_row == ''){
                    $sql_insert_com = "INSERT INTO evaluation_comment(evaluate_comment_id, comment1,evaluate_employee_id) 
                                VALUES (DEFAULT,'$comment1','$eval_emp_id')";
                    $query_insert_com = mysqli_query($conn, $sql_insert_com);
                    header("location:evaluation_section_4.php");
                }else{
                    $sql_update = "UPDATE evaluation_comment SET comment1 = '$comment1' WHERE evaluate_employee_id = '$eval_emp_id'  ";
                    $query_update = mysqli_query($conn, $sql_update);
                    header("location:evaluation_section_4.php");
                }
            }
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
                        <!--box-body-->
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
                                            $sql_month = "SELECT start_month, end_month FROM term t JOIN evaluation e ON e.term_id = t.term_id where evaluation_code = '".$_SESSION["eval_code"]."'";
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
                                                                AND el.evaluate_employee_id = '" . $_SESSION["eval_emp_id"] . "'";
                                            $query_leave_type = mysqli_query($conn, $sql_leave_type);
                                                
                                            while ($result_leave_type = mysqli_fetch_array($query_leave_type)) {
                                                ?>
                                    <tr>
                                        <th class="text-center" ><?php echo $result_leave_type["leave_type_id"]; ?></th>
                                        <th class="text-center" ><?php echo $result_leave_type["leave_type_description"]; ?></th>
                                        <td class="text-center" >
                                            <input class="text-center" type="number"  name="no_of_day" min="1" max="365" value="<?php
                                                if ($result_leave_type["no_of_day"] == '') {
                                                    echo '0';
                                                } else {
                                                    echo $result_leave_type["no_of_day"];
                                                }
                                                ?>" disabled > วัน
                                        </td>
                                        <td class="text-center" ><?php echo $result_leave_type["point"]; ?></td>
                                        <td class="text-center">
                                            <input class="text-center" type="number"  name="point" min="0.5" max="60" value="<?php
                                                if ($result_leave_type["point_leave"] == '') {
                                                    echo '0';
                                                } else {
                                                    echo $result_leave_type["point_leave"];
                                                }
                                                ?>" disabled > คะแนน
                                        </td>
                                    </tr>
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
                                                            evaluate_employee_id = '".$_SESSION["eval_emp_id"]."'";
                                    $query_leave_sum = mysqli_query($conn, $sql_levae_sum);
                                    $result_leave_sum = mysqli_fetch_array($query_leave_sum);
                                    
                                    ?>
                                    <tr class="bg-info">
                                        <td class="text-center" colspan="2"><b>รวม</b></td>
                                        <td class="text-center"><input class="text-center" type="number"  name="leave" min="1" max="365" value="<?php if($result_leave_sum == ''){ echo '0'; }else{ echo $result_leave_sum["sum_day_leave"];} ?>" disabled readonly>วัน</td>
                                        <td></td>
                                        <td class="text-center"><input class="text-center" type="number"  name="point" min="0.5" max="60" value="<?php if($result_leave_sum == ''){ echo '0'; }else{ echo $result_leave_sum["sum_point_leave"];} ?>" disabled readonly>คะแนน</td>
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
                                <!--Reward Table-->
                                <div class="col-md-offset-1 col-md-10 box-padding-small">
                                    <table class="table table-bordered table-striped">
                                        <thead class="bg-success">
                                            <tr>
                                                
                                                <th class="h4" colspan="2"><i class="glyphicon glyphicon-star text-green"></i>&nbsp;&nbsp;<u>ประวัติการได้รับรางวัล / ยกย่อง</u></th>
                                                <th class="h4 text-center">คะแนน</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <?php
                                                $sql_reward = "SELECT *
                                                    FROM evaluatation_penalty_reward epr 
                                                    JOIN penalty_reward pr ON epr.penalty_reward_id=pr.penalty_reward_id
                                                    WHERE evaluate_employee_id='".$_SESSION["eval_emp_id"]."' AND pr.penalty_reward_indicated=1";
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
                                                        <td class="text-center" style="width: 100px;"><?php echo $reault_reward["point"]; ?></td>
                                                    </tr>
                                                    <?php
                                                    }
                                                }
                                                ?>
                                                <?php 
                                                $sql_sum_reward = "SELECT sum(pr.point) as sum_reward_point   
                                                    FROM evaluatation_penalty_reward epr 
                                                    JOIN penalty_reward pr ON epr.penalty_reward_id=pr.penalty_reward_id
                                                    WHERE epr.evaluate_employee_id='".$_SESSION["eval_emp_id"]."' AND pr.penalty_reward_indicated=1";
                                                $query_sum_reward = mysqli_query($conn, $sql_sum_reward);
                                                $result_sum_reward = mysqli_fetch_array($query_sum_reward,MYSQLI_ASSOC);
                                                ?>
                                                <tr class="bg-success">
                                                    <th class="text-center" colspan="2"> รวม </th>
                                                    <th class="text-center"><?php echo $result_sum_reward["sum_reward_point"]; ?></th>
                                                </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!--/Reward Table-->
                                
                                <!--Penalty Table-->
                                <div class="col-md-offset-1 col-md-10 box-padding-small">
                                    <table class="table table-bordered table-striped">
                                        <thead class="bg-danger">
                                            <tr>
                                                <th class="h4" colspan="2" ><i class="glyphicon glyphicon-warning-sign text-red"></i>&nbsp;&nbsp;<u>ประวัติการลงโทษทางวินัย</u></th>
                                                <th class="h4 text-center">คะแนน</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <?php
                                                $sql_penalty = "SELECT *
                                                    FROM evaluatation_penalty_reward epr 
                                                    JOIN penalty_reward pr ON epr.penalty_reward_id=pr.penalty_reward_id
                                                    WHERE evaluate_employee_id='".$_SESSION["eval_emp_id"]."' AND pr.penalty_reward_indicated=0 ; ";
                                                
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
                                                <?php 
                                                $sql_sum_penalty = "SELECT sum(pr.point) as sum_penalty_point   
                                                    FROM evaluatation_penalty_reward epr 
                                                    JOIN penalty_reward pr ON epr.penalty_reward_id=pr.penalty_reward_id
                                                    WHERE epr.evaluate_employee_id='".$_SESSION["eval_emp_id"]."' AND pr.penalty_reward_indicated=0";
                                                $query_sum_penalty = mysqli_query($conn, $sql_sum_penalty);
                                                $result_sum_penalty = mysqli_fetch_array($query_sum_penalty,MYSQLI_ASSOC);
                                                ?>
                                                <tr class="bg-danger">
                                                    <th class="text-center" colspan="2"> รวม </th>
                                                    <th class="text-center"><?php echo $result_sum_penalty["sum_penalty_point"]; ?></th>
                                                </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!--/Penalty Table-->
                            </div>
                            <hr>
                            
                            
                            <div class="row">
                                <!--sum point-->
                                <div class="col-md-offset-1 col-md-10">
                                    <table class="table table-striped " >
                                        <thead class="bg-light-blue-active">
                                            <tr>
                                                <th class="text-center">คะแนนเต็ม(10 คะแนน)</th>
                                                <th></th>
                                                <th class="text-center">คะแนนเวลาการทำงาน</th>
                                                <th></th>
                                                <th class="text-center">คะแนนการลงโทษทางวินัย</th>
                                                <th></th>
                                                <th class="text-center">คะแนนรวม</th>
                                            </tr>
                                        </thead>
                                        <tbody class="">
                                            <tr class="" style="background-color:#E3F2FD ;font-size: 20px;font-weight: 800;padding: 10px;">
                                                <td class="text-center">10</td>
                                                <td class="text-center"> - </td>
                                                <td class="text-center" ><?php if($result_leave_sum["sum_point_leave"] == ''){ echo '0'; } else{ echo $result_leave_sum["sum_point_leave"]; } ?></td>
                                                <td class="text-center"> - </td>
                                                <td class="text-center"><?php if($result_sum_penalty["sum_penalty_point"] == ''){ echo '0'; }else{ echo $result_sum_penalty["sum_penalty_point"];} ?></td>
                                                <td> = </td>
                                                <td class="text-center" ><?php echo 10-($result_sum_penalty["sum_penalty_point"]+$result_leave_sum["sum_point_leave"]); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!--/sum point-->
                                
                                <!--Optional-->
                                <form method="post">
                                    <div class="col-md-offset-2 col-md-8">
                                        <h4><u>ความคิดเห็นของผู้บังคับบัญชาตามสายงาน (ตามข้อเท็จจริง ตามข้อ 3.1, 3.2)</u></h4>
                                        <textarea class="form-control" name="comment1" size="60" rows="5" placeholder="เขียนความเห็น(ตามข้อเท็จจริง ตามข้อ 3.1, 3.2)"></textarea>         
                                        <div class="form-group box-padding-small text-center">
                                            <input type="hidden" name="eval_emp_id" value="<?php echo $_SESSION["eval_emp_id"]; ?>" >
                                            <input class="btn btn-success btn-lg search-button" type="submit" name="submit_comment" value="บันทึก">
                                            <input class="btn btn-danger btn-lg search-button" type="reset" name="reset" value="รีเซ็ต" >
                                        </div>          
                                    </div>
                                </form> 
                                <!--/Optional-->
                                
                            </div>            
                        </div>           
                        <!--/box-body-->
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
