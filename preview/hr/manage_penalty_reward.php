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
        <?php include ('./classes/connection_mysqli.php');?>
        
        
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
            <?php
        
        $get_department_id = '';
        if (isset($_GET["department_id"])) {
            $get_department_id = $_GET["department_id"];
        }
        $get_job_id = '';
        if (isset($_GET["job_id"])) {
            $get_job_id = $_GET["job_id"];
        }
        
        $get_eval_code = $my_eval_code;
        if(isset($_GET["eval_code"])){
            $get_eval_code = $_GET["eval_code"];
            $eval = " eval.evaluation_code = '".$get_eval_code ."'";
        }
        
        $condition = " WHERE eval.evaluation_code = '".$my_eval_code."' ";
        if ($get_department_id != '' && $get_job_id != '' && $get_eval_code != '') {
            $condition = " WHERE e.department_id = '$get_department_id' AND e.job_id = '$get_job_id' AND eval.evaluation_code = '$get_eval_code' ";
        } else if ($get_department_id != '' && $get_job_id != '') {
            $condition = " WHERE  e.department_id = '$get_department_id' AND e.job_id = '$get_job_id' ";
        }else if($get_job_id != '' && $get_eval_code != ''){
            $condition = " WHERE  e.job_id = '$get_job_id' AND eval.evaluation_code = '$get_eval_code' ";
        }else if($get_department_id != '' && $get_eval_code != ''){
            $condition = " WHERE e.department_id = '$get_department_id' AND eval.evaluation_code = '$get_eval_code' ";
        }else if($get_department_id != '' || $get_job_id != '' || $get_eval_code != ''){
            if ($get_department_id != '') {
                $condition = " WHERE e.department_id = '" . $get_department_id . "' ";
            } else if ($get_job_id != '') {
                $condition = " WHERE e.job_id = '" . $get_job_id . "' ";
            }else if($get_eval_code != ''){
                $condition = " WHERE eval.evaluation_code = '$get_eval_code' ";
            }
        }else if($get_department_id == '' && $get_job_id == '' && $get_eval_code == ''){
            $condition = 'WHERE eval.evaluation_code = 3 ';
        }
?>

            <!-- Content Wrapper. Contains page content แก้เนื้อหาแต่ละหน้าตรงนี้นะ -->
            <div class="content-wrapper">

                <!-- Content Header (Page header)  -->
                <section class="content-header">
                    <h1>
                        จัดการข้อมูลรางวัล / โทษ พนักงาน
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Penalty reward management</li>
                    </ol>
                </section>
                <!--/Page header -->

                <!-- Main content -->
                <div class="row box-padding">
                    <div class="box box-success">
                        <div class="box-body ">
                            <form method="get">
                                <div class="col-md-4">
                                    <label class="col-sm-4 control-label">รอบ</label>
                                    <div class="col-sm-8">
                                    <?php 
                                        $sql_eval = "SELECT * FROM evaluation ORDER BY year , term_id ASC";
                                        $query_eval = mysqli_query($conn, $sql_eval);
                                    ?>
                                        <select class="form-control" name="eval_code">
                                            <option value="">เลือกทั้งหมด</option>
                                        <?php while($result_eval = mysqli_fetch_array($query_eval,MYSQLI_ASSOC)) { ?>
                                            <option value="<?php echo $result_eval["evaluation_code"]; ?>" <?php if($get_eval_code == $result_eval["evaluation_code"]) { echo "selected"; }  ?> >
                                                <?php echo 'ปี '.$result_eval["year"]." - ครั้งที่".$result_eval["term_id"]; ?>
                                            </option>
                                        <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="col-sm-4 control-label">แผนก</label>
                                    <div class="col-sm-8">
                                    <?php 
                                        $sql_department = "SELECT * FROM departments ";
                                        $query_department = mysqli_query($conn, $sql_department);
                                    ?>
                                        <select class="form-control" name="department_id">
                                            <option value="">เลือกทั้งหมด</option>
                                        <?php while($result_department = mysqli_fetch_array($query_department,MYSQLI_ASSOC)) { ?>
                                            <option value="<?php echo $result_department["department_id"]; ?>" <?php if($get_department_id == $result_department["department_id"]) { echo "selected"; }  ?> >
                                                <?php echo $result_department["department_name"]; ?>
                                            </option>
                                        <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-sm-4 control-label">ตำแหน่ง</label>
                                    <div class="col-sm-8">
                                    <?php 
                                        $sql_job = "SELECT distinct(job_name), job_id FROM jobs ";
                                        $query_job = mysqli_query($conn, $sql_job);
                                    ?>
                                        <select class="form-control" name="job_id">
                                            <option value="">เลือกทั้งหมด</option>
                                        <?php while($result_job = mysqli_fetch_array($query_job,MYSQLI_ASSOC)) { ?>
                                            <option value="<?php echo $result_job["job_id"]; ?>" <?php if($get_job_id == $result_job["job_id"]) { echo "selected"; }  ?> >
                                                <?php echo $result_job["job_name"]; ?>
                                            </option>
                                        <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class=" col-md-1">
                                    <input type="submit" class="btn btn-primary search-button " value="ค้นหา" >
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
                
                
                <div id="filter" class="row box-padding">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h4>ตารางรายชื่อพนักงาน</h4>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"> <i class="fa fa-minus"></i>
                                </button>
                                
                                <button type="button" class="btn btn-box-tool" data-widget="remove">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
     
                        <div class="box-body ">    
                            <!-- ช่องค้นหา by listJS -->
                            <div class="form-inline padding-small">
                                <i class="glyphicon glyphicon-search" style="padding: 0px 10px;" ></i>
                                <input class="search form-control" placeholder="ค้นหา" />
                            </div>
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                               
                                    <tr class="">
                                        <th class="text-center text-middle"></th>
                                        <th class="text-center text-middle"><button class="sort" data-sort="id">ID</button></th>
                                        <th class="text-middle"><button class="sort" data-sort="name">ชื่อ-นามสกุล</button></th>
                                        <th class="text-center text-middle"><button class="sort" data-sort="job">ตำแหน่ง</button></th>
                                        <th class="text-center text-middle"><button class="sort" data-sort="dept">แผนก</button></th>
                                        <th class="text-center text-middle"><button class="sort" data-sort="count_reward">รางวัล</button></th>
                                        <th class="text-center text-middle"><button class="sort" data-sort="count_penalty">โทษ</button></th>
                                        <th class="text-center text-middle">อัพเดท</th>
                                    </tr>
                                </thead>
                                <?php
                    
                                $sql_emp = "SELECT
                                                e.employee_id As emp_id,
                                                        CONCAT(
                                                                e.prefix,
                                                                e.first_name,
                                                                '  ',
                                                                e.last_name
                                                        ) AS name,
                                                        e.profile_picture,
                                                        d.department_name As dept_name,
                                                        j.job_name As job_name,
                                                        eval.evaluation_code As eval_code,
                                                        ee.evaluate_employee_id

                                                FROM
                                                        employees e
                                                JOIN departments d ON d.department_id = e.department_id
                                                JOIN jobs j ON j.job_id = e.job_id
                                                JOIN evaluation_employee ee ON e.employee_id = ee.employee_id
                                                JOIN evaluation eval ON ee.evaluation_code = eval.evaluation_code
                                                $condition
                                                ORDER BY
                                                        e.employee_id ASC";
                                $query = mysqli_query($conn, $sql_emp); //$conn มาจากไฟล์ connection_mysqli.php เป็นตัว connect DB
                                 ?>
                                <tbody class="list">
                                <?php  while($result = mysqli_fetch_assoc($query)){ 
                                    $emp_id = $result["emp_id"];
                                    $name = $result["name"];
                                    $dept = $result["dept_name"];
                                    $job = $result["job_name"];
                                    $eval_code = $result["eval_code"];
                                    $eval_emp_id = $result["evaluate_employee_id"];
                                    $profile_picture = $result["profile_picture"];
                                    $sql_count_reward = "SELECT
                                                            pr.penalty_reward_name,	pr.penalty_reward_indicated,	pr.point,	emp.*
                                                    FROM
                                                            employees emp
                                                    LEFT JOIN evaluation_employee ee ON emp.employee_id = ee.employee_id
                                                    JOIN evaluatation_penalty_reward epr ON epr.evaluate_employee_id = ee.evaluate_employee_id
                                                    JOIN penalty_reward pr ON pr.penalty_reward_id = epr.penalty_reward_id
                                                    JOIN evaluation e ON e.evaluation_code = ee.evaluation_code
                                                    WHERE
                                                            emp.employee_id = '$emp_id' AND e.evaluation_code = '$get_eval_code'
                                                    AND pr.penalty_reward_indicated = 1";
                                    $query_count_reward = mysqli_query($conn, $sql_count_reward);
                                    $count_reward = mysqli_num_rows($query_count_reward);
                                    
                                    $sql_count_penalty = "SELECT
                                                            pr.penalty_reward_name,	pr.penalty_reward_indicated,	pr.point,	emp.*
                                                    FROM
                                                            employees emp
                                                    LEFT JOIN evaluation_employee ee ON emp.employee_id = ee.employee_id
                                                    JOIN evaluatation_penalty_reward epr ON epr.evaluate_employee_id = ee.evaluate_employee_id
                                                    JOIN penalty_reward pr ON pr.penalty_reward_id = epr.penalty_reward_id
                                                    JOIN evaluation e ON e.evaluation_code = ee.evaluation_code
                                                    WHERE
                                                            emp.employee_id = '$emp_id' AND e.evaluation_code = '$get_eval_code'
                                                    AND pr.penalty_reward_indicated = 0";
                                    $query_count_penalty = mysqli_query($conn, $sql_count_penalty);
                                    $count_penalty = mysqli_num_rows($query_count_penalty);
                                    ?>
                                
                                <tr >
                                    <td class="text-center"><img class="img-circle img-center img-sm" src="../upload_images/<?php if($profile_picture ==''){ echo "default.png";} else { echo $profile_picture; } ?>" ></td>
                                    <td class="id text-center"><?php  echo $emp_id; ?></td>
                                    <td class="name"><?php echo $name; ?></td>
                                    <td class="job text-center"><?php echo $job; ?></td>
                                    <td class="dept text-center"><?php echo $dept; ?></td>
                                    <td class="count_reward text-center"><span style="color: #000080;font-size: 18px;"><?php echo $count_reward; ?></span></td>
                                    <td class="count_penalty text-center"><span style="color: maroon;font-size: 18px;"><?php echo $count_penalty; ?></span></td>
                                    <td class="text-center"><a class="btn btn-primary" href="manage_penalty_reward_detail.php?emp_id=<?php echo $emp_id; ?>&eval_code=<?php echo $eval_code; ?>&eval_emp_id=<?php echo $eval_emp_id ; ?>"><i class="glyphicon glyphicon-refresh"></i></a></td>
                                </tr>
                                <?php } ?>
                                </tbody>
                                <script>
                                        var options = {
                                            valueNames: [ 'id', 'name' , 'job' , 'dept','count_reward','count_penalty' ]
                                        };
                                        
                                        var userList = new List('filter', options);
                                </script>
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

    </body>
    <!-- SCRIPT PACKS -->
        <?php include ('./script_packs.html'); ?>
</html>
            <?php
        }
    }

    
?>
