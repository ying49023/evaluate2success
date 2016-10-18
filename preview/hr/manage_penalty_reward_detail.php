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
    <?php include ('./classes/connection_mysqli.php'); 
     
        $get_emp_id = "1"; //ตั้งค่า Default = 1 ไว้เพื่อไม่ให้เกิด ERROR ในการ Query SQL
        //เงื่อนไขนี้เป็นการเช็คว่ามีส่งมาไหม
        if (isset($_GET["emp_id"])) {
            $get_emp_id = $_GET["emp_id"]; //GET ค่ามาจากหน้า hr_kpi_individual.php ผ่านลิงค์ 
        }
        $get_eval_code = ''; //ตั้งค่า Default = 1 ไว้เพื่อไม่ให้เกิด ERROR ในการ Query SQL
        //เงื่อนไขนี้เป็นการเช็คว่ามีส่งมาไหม
        if(isset($_GET["eval_code"])) {
            $get_eval_code = $_GET["eval_code"]; //GET ค่ามาจากหน้า hr_kpi_individual.php ผ่านลิงค์ 
        }
        $get_eval_emp_id = ''; //ตั้งค่า Default = 1 ไว้เพื่อไม่ให้เกิด ERROR ในการ Query SQL
        //เงื่อนไขนี้เป็นการเช็คว่ามีส่งมาไหม
        if (isset($_GET["eval_emp_id"])) {
            $get_eval_emp_id = $_GET["eval_emp_id"]; //GET ค่ามาจากหน้า hr_kpi_individual.php ผ่านลิงค์ 
        }
        
        if(isset($_POST["submit_penalty_reward"])){
            $emp_id = $_POST["emp_id"];
            $penalty_reward = $_POST["penalty_reward_id"];
            $eval_emp_id = $_POST["eval_emp_id"];
            $eval_code = $_POST["eval_code"];
            
            $sql_insert = "CALL auto_point_penalty($eval_emp_id, $penalty_reward)";
            $query_insert = mysqli_query($conn, $sql_insert);
            header("location:manage_penalty_reward_detail.php?emp_id=$emp_id&eval_code=$eval_code&eval_emp_id=$eval_emp_id");
        }
        ?>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ระบบประเมินผลปฏิบัติงาน : ALT Evaluation</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!--CSS PACKS -->
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
                    การจัดการข้อมูลรางวัล / โทษ
                  
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="#"> <i class="fa fa-dashboard"></i>
                            Home
                        </a>
                    </li>
                    <li class="active">Individual KPIs</li>
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
                                                    
                                                $sql_year_term = "SELECT * FROM evaluation e JOIN term t ON e.term_id=t.term_id WHERE evaluation_code = '$get_eval_code'";
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
                                                $sql_eval_period = "SELECT * FROM evaluation WHERE evaluation_code = '$get_eval_code' ";
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
            <div class="row box-padding" style="margin-top:-20px;">
                <h3>รายการข้อมูลรางวัล / โทษ</h3>
            </div>
            <div class="row box-padding">
                <div class="box box-primary">
                    <div class="box-header">
                        <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#new_penalty_reward">
                            <i class="glyphicon glyphicon-plus" ></i>เพิ่ม
                        </button> 
                    </div>
                    <div class="box-body">
                        
                        <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr class="bg-success">
                                    <th class="text-center">รางวัล/การยกย่อง</th>
                                    <th class="text-center" style="width: 65px;">คะแนน</th>
                                </tr>
                                <?php
                                $sql_reward = "SELECT
                                                            pr.penalty_reward_name,	pr.penalty_reward_indicated,	pr.point,	emp.*
                                                    FROM
                                                            employees emp
                                                    LEFT JOIN evaluation_employee ee ON emp.employee_id = ee.employee_id
                                                    JOIN evaluatation_penalty_reward epr ON epr.evaluate_employee_id = ee.evaluate_employee_id
                                                    JOIN penalty_reward pr ON pr.penalty_reward_id = epr.penalty_reward_id
                                                    JOIN evaluation e ON e.evaluation_code = ee.evaluation_code
                                                    WHERE
                                                            emp.employee_id = '$get_emp_id' AND e.evaluation_code = '$get_eval_code'
                                                    AND pr.penalty_reward_indicated = 1";
                                $query_reward = mysqli_query($conn, $sql_reward);
                                while($result_reward = mysqli_fetch_array($query_reward)){
                                        ?>
                                <tr>
                                    <td ><?php echo $result_reward["penalty_reward_name"]; ?></td>
                                    <td class="text-center padding-left-lg"><?php echo $result_reward["point"]; ?></td>
                                </tr>
                                <?php } ?>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr class="bg-danger">
                                    <th class="text-center">โทษทางวินัย</th>
                                    <th class="text-center" style="width: 65px;">คะแนน</th>
                                </tr>
                                <?php
                                $sql_penalty = "SELECT
                                                            pr.penalty_reward_name,	pr.penalty_reward_indicated,	pr.point,	emp.*
                                                    FROM
                                                            employees emp
                                                    LEFT JOIN evaluation_employee ee ON emp.employee_id = ee.employee_id
                                                    JOIN evaluatation_penalty_reward epr ON epr.evaluate_employee_id = ee.evaluate_employee_id
                                                    JOIN penalty_reward pr ON pr.penalty_reward_id = epr.penalty_reward_id
                                                    JOIN evaluation e ON e.evaluation_code = ee.evaluation_code
                                                    WHERE
                                                            emp.employee_id = '$get_emp_id' AND e.evaluation_code = '$get_eval_code'
                                                    AND pr.penalty_reward_indicated = 0";
                                $query_penalty = mysqli_query($conn, $sql_penalty);
                                while($result_penalty = mysqli_fetch_array($query_penalty)){
                                        ?>
                                <tr>
                                    <td><?php echo $result_penalty["penalty_reward_name"]; ?></td>
                                    <td class="text-center padding-left-lg"><?php echo $result_penalty["point"]; ?></td>
                                </tr>
                                <?php } ?>
                            </table>
                        </div>
                        </div>
                        <!--Add Modal -->
                        <form class="form-horizontal" name="frmMain" method="post" >
                            <div class="modal fade" id="new_penalty_reward" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-blue">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">แก้ไขข้อมูล</h4>
                                        </div>
                                        <script>
                                            function getPenaltyReward(val) {
                                                $.ajax({
                                                    type: "POST",
                                                    url: "get_penalty_reward.php",
                                                    data:'penalty_reward_indicated='+val,
                                                    success: function(data){
                                                        $("#state-list").html(data);
                                                    }
                                                });
                                            }
                                        </script>
                                        <div class="modal-body">
                                            <div class="row box-padding">
                                                <div class="col-md-offset-2 col-md-8">
                                                    <label>เลือกประเภท</label>
                                                    <select class="form-control" name="penalty_reward_indicated" onChange="getPenaltyReward(this.value);">
                                                        <option value="">--เลือกประเภท--</option>
                                                        <option value="0">โทษทางวินัย</option>
                                                        <option value="1">รางวัล</option>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row box-padding">
                                                <div class="col-md-offset-2 col-md-8">
                                                    <label>เลือกหัวข้อรางวัล/โทษทางวินัย</label>
                                                    <select class="form-control" name="penalty_reward_id"  id="state-list" >
                                                        <option value="">--เลือกหัวข้อรางวัล/โทษทางวินัย--</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="modal-footer">
                                            <input type="hidden" name="emp_id" value="<?php echo $get_emp_id; ?>" >
                                            <input type="hidden" name="eval_code" value="<?php echo $get_eval_code; ?>" >
                                            <input type="hidden" name="eval_emp_id" value="<?php echo $get_eval_emp_id; ?>" >
                                            <input type="submit" class="btn btn-success" name="submit_penalty_reward" value="บันทึก" >
                                            <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!--Add Modal -->
                    </div>
                    <div class="box-footer text-center">
                        <a class=" btn btn-danger" href="manage_penalty_reward.php"> ย้อนกลับ</a>
                    </div>
                </div>

            </div>
            
            

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
    <?php include ('./script_packs.html'); ?>
</html>
            <?php
        }
    }

    
?>