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
            <?php include ('./classes/connection_mysqli.php');?>
        <?php
        
        $get_department_id = '';
        if (isset($_GET["department_id"])) {
            $get_department_id = $_GET["department_id"];
        }
        $get_job_id = '';
        if (isset($_GET["job_id"])) {
            $get_job_id = $_GET["job_id"];
        }
        $eval = ' eval_code = 3';
        $get_eval_code = '3';
        if(isset($_GET["eval_code"])){
            $get_eval_code = $_GET["eval_code"];
            $eval = " eval.evaluation_code = '".$get_eval_code ."'";
        }
        
        $condition = 'WHERE eval.evaluation_code = 3 ';
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
                    ดูภาพรวมรายบุคคล
                    <small>แดชบอร์ด</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="#"> <i class="fa fa-dashboard"></i>
                            Home
                        </a>
                    </li>
                    <li class="active">Personal dashboard</li>
                </ol>
            </section>
            <!--/Page header -->

            <!-- Main content -->
            <!--header search filter-->
            <div class="row box-padding">
                <div class="box box-success">
                     <div class="box-body ">
                            <form method="get">
                                <div class="col-md-3">
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
            <!--/header search filer-->
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
                                        <th class="text-center"></th>
                                        <th class="text-center"><button class="sort" data-sort="id">ID</button></th>
                                        <th ><button class="sort" data-sort="name">ชื่อ-นามสกุล</button></th>
                                        <th class="text-center"><button class="sort" data-sort="job">ตำแหน่ง</button></th>
                                        <th class="text-center"><button class="sort" data-sort="dept">แผนก</button></th>
                                        <th width="100px"><center>ดูผลงาน</center></th>
                                        <th width="120px"><center>ความสำเร็จ(%)</center></th>
                                        <th class="text-center">ดู</th>
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
                                                        eval.evaluation_code As eval_code

                                                FROM
                                                        employees e
                                                JOIN departments d ON d.department_id = e.department_id
                                                JOIN jobs j ON j.job_id = e.job_id
                                                JOIN evaluation_employee ee ON e.employee_id = ee.employee_id
                                                JOIN employees m ON e.manager_id = m.employee_id
                                                JOIN evaluation eval ON ee.evaluation_code = eval.evaluation_code
                                                JOIN kpi_responsible r ON ee.evaluate_employee_id = r.evaluate_employee_id																								
                                                $condition and m.employee_id = '$my_emp_id'
                                                GROUP BY ee.evaluate_employee_id    
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
                                    $profile_picture = $result["profile_picture"];
                                    $sql_mile ="select SUM(r.percent_weight*r.percent_performance)/ (SELECT SUM(percent_weight) FROM kpi_responsible er
                                    JOIN evaluation_employee ee ON ee.evaluate_employee_id = er.evaluate_employee_id
                                    WHERE ee.employee_id=$emp_id and ee.evaluation_code =$get_eval_code  ) as mile_percent
                                    FROM kpi_responsible r
                                    JOIN evaluation_employee e ON e.evaluate_employee_id = r.evaluate_employee_id
                                    WHERE e.employee_id=$emp_id AND r.percent_performance IS NOT NULL and e.evaluation_code =$get_eval_code";
                                    $query_mile = mysqli_query($conn, $sql_mile);
                                    while ($result_mile = mysqli_fetch_assoc($query_mile)){
                                        $mile = $result_mile['mile_percent'];
                                   
                                    ?>
                                
                                <tr >
                                    <td class="text-center"><img class="img-circle img-center img-sm" src="./upload_images/<?php if($profile_picture ==''){ echo "default.png";} else { echo $profile_picture; } ?>" ></td>
                                    <td class="id text-center"><?php  echo $emp_id; ?></td>
                                    <td class="name"><?php echo $name; ?></td>
                                    <td class="job text-center"><?php echo $job; ?></td>
                                    <td class="dept text-center"><?php echo $dept; ?></td>
                                   <td width="100px">
                                            <div class="progress progress-xs progress-striped active">
                                                <div class="progress-bar progress-bar-success" style="width:<?php if($mile==''){  echo 0;}else{ echo $mile; }?>%"></div>
                                            </div>
                                        </td>
                                        <td class="text-center" >
                                            <span class="badge bg-orange "><?php echo round($mile); ?></span>
                                        </td>
                                    <td class="text-center"><a class="btn btn-primary" href="total_personal_dashboard_detail.php?emp_id=<?php echo $emp_id; ?>&eval_code=<?php echo $eval_code; ?>"><i class="glyphicon glyphicon-eye-open"></i>&nbsp; ดู</a></td>
                                </tr>
                                <?php } } ?>
                                </tbody>
                                <script>
                                        var options = {
                                            valueNames: [ 'id', 'name' , 'job' , 'dept','kpi_count' ]
                                        };
                                        
                                        var userList = new List('filter', options);
                                </script>
                            </table>

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
</html>
<?php
        }
    }
?>