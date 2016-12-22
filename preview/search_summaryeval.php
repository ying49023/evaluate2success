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
                    ดูผลการประเมิน
                    <small>ค้นหาพนักงาน</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="#"> <i class="fa fa-dashboard"></i>
                            Home
                        </a>
                    </li>
                    <li class="active">Summary evaluation</li>
                </ol>
            </section>
            <!--/Page header -->

            <!-- Main content -->
            <!--list employee-->
            <div class="row box-padding">
                <div class="box box-success">
                     <div class="box-body ">
                            <form method="get">
                                <div class="col-md-11">
                                    <label class="col-sm-2 control-label">รอบ</label>
                                    <div class="col-sm-8">
                                    <?php 
                                        $sql_eval = "SELECT * FROM evaluation where year<=YEAR(CURDATE())  ORDER BY year , term_id ASC";
                                        $query_eval = mysqli_query($conn, $sql_eval);
                                    ?>
                                        <select class="form-control" name="eval_code">
                                            <option value="">กรุณาเลือก</option>
                                        <?php while($result_eval = mysqli_fetch_array($query_eval,MYSQLI_ASSOC)) { ?>
                                            <option value="<?php echo $result_eval["evaluation_code"]; ?>" <?php if($get_eval_code == $result_eval["evaluation_code"]) { echo "selected"; }  ?> >
                                                <?php echo 'ปี '.$result_eval["year"]." - ครั้งที่".$result_eval["term_id"]; ?>
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
                        <b>ตารางข้อมูลพนักงาน</b>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"> 
                                <i class="fa fa-minus"></i>
                            </button>
                                
                            <button type="button" class="btn btn-box-tool" data-widget="remove">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <!-- ช่องค้นหา by listJS -->
                        <div class="form-inline padding-small">
                            <i class="glyphicon glyphicon-search" style="padding: 0px 10px;" ></i>
                            <input class="search form-control" placeholder="ค้นหา" />
                        </div>
                                <?php
                                $sql_emp_list = "SELECT
                                                        ee.employee_id,
                                                        e.*,
                                                        ee.status_success,
                                                        ec.evaluate_employee_id,
                                                        d.department_name,
                                                        j.job_name
                                                FROM
                                                        employees e
                                                JOIN evaluation_employee ee ON e.employee_id = ee.employee_id
                                                JOIN evaluation ev ON ee.evaluation_code = ev.evaluation_code
                                                JOIN evaluation_competency ec ON ec.evaluate_employee_id = ee.evaluate_employee_id
                                                JOIN jobs j ON j.job_id = e.job_id
                                                JOIN departments d ON d.department_id = e.department_id
                                                WHERE
                                                        e.manager_id = '$my_emp_id'
                                                AND ev.evaluation_code = '$get_eval_code'
                                                GROUP BY ee.employee_id";
                                $query_emp_list = mysqli_query($conn, $sql_emp_list);
                                ?>
                                    
                        <table class="table table-bordered table-hover" width="90%" >
                            <thead>
                                <tr>
                                    <th></th>
                                    <th><button class="sort" data-sort="emp_id">ID</button></th>
                                    <th><button class="sort" data-sort="emp_name">ชื่อพนักงาน</button></th>
                                    <th><button class="sort" data-sort="job_name">ตำแหน่ง</button></th>
                                    <th><button class="sort" data-sort="dept_name">ฝ่าย/แผนก</button></th>
                                    <th><center>ดูผลการประเมิน</center></th>
                            
                            </tr>
                            </thead>
                            <tbody class="list">
                                        <?php
                                        while ($result_emp_list = mysqli_fetch_assoc($query_emp_list)) {
                                            
                                            $employee_id = $result_emp_list["employee_id"];
                                            $emp_name = $result_emp_list["prefix"] . ' ' . $result_emp_list["first_name"] . '  ' . $result_emp_list["last_name"];
                                            $status = $result_emp_list["status_success"];
                                            $position = $result_emp_list["position_level_id"];
                                            $job_name = $result_emp_list["job_name"];
                                            $department_name = $result_emp_list["department_name"];
                                            $eval_emp_id = $result_emp_list["evaluate_employee_id"];
                                            $profile_picture = $result_emp_list["profile_picture"];
                                            ?>
                                <tr>
                                    <td class="text-center"><img class="img-circle img-center img-sm" src="http://palmup.xyz/evaluate2success/preview/upload_images/<?php if($profile_picture ==''){ echo "default.png";} else { echo $profile_picture; } ?>" ></td>
                                    <td class="emp_id"><?php echo $employee_id; ?></td>
                                    <td class="emp_name"><?php echo $emp_name; ?></td>
                                    <td class="job_name"><?php echo $job_name; ?></td>
                                    <td class="dept_name"><?php echo $department_name; ?></td>
                                    <td class="text-center">
                                        <a class="btn btn-info btn-md" href="summaryevaluation.php?emp_id=<?php echo $employee_id; ?>&position_level_id=<?php echo $position; ?>&eval_code=<?php echo $get_eval_code; ?>&eval_emp_id=<?php echo $eval_emp_id; ?>">    
                                            <i class="glyphicon glyphicon-eye-open"></i>&nbsp;ดูผล
                                        </a>
                                    </td>
                                                           
                                </tr>
        <?php } ?>
                            </tbody>
                            <script>
                                var options = {
                                    valueNames: [ 'emp_id', 'emp_name' , 'job_name' , 'dept_name' ]
                                };
                                
                                var userList = new List('filter', options);
                            </script>    
                                
                        </table>
                            
                            
                            
                        <!-- /.chart-responsive -->
                    </div>
                </div>
            </div>
            <!--/list employee-->

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