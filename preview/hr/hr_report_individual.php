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
<?php include('./classes/connection_mysqli.php');
        $get_department_id = '';
        $name = '';
        $id = '';
        if (isset($_GET["department"])) {
            $get_department_id = $_GET["department"];
        }
        if (isset($_GET["full_name"])) {
            $name = $_GET["full_name"];
        }
        if (isset($_GET["emp_id"])) {
            $id = $_GET["emp_id"];
        }
        ?>
<html>
    <head>
        <?php include ('./classes/connection_mysqli.php'); ?>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>เพิ่มข้อมูลพนักงาน : ALT Evaluation</title>
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
                        แบบประเมินรายบุคคล
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">manage Leave</li>
                        
                    </ol>
                </section>
                <!--/Page header -->

                <!-- Main content -->
                <div id="filter" class="row box-padding">
                        <div class="box box-primary">
                        <div class="box-header with-border ">
                            <h4>
                            <?php
                            $sql_year_term = "SELECT
                                                    year, term_name, start_month , end_month
                                            FROM
                                                    evaluation e
                                            JOIN term t ON e.term_id = t.term_id
                                            JOIN evaluation_employee ee ON ee.evaluation_code = e.evaluation_code
                                            JOIN employees emp ON emp.employee_id = ee.employee_id
                                            WHERE
                                                    ee.evaluation_code = '".$_GET['eval_code']."' Limit 1";
                            $query_year_term = mysqli_query($conn, $sql_year_term);
                            while ($result_year_term = mysqli_fetch_array($query_year_term, MYSQLI_ASSOC)) {
                                echo "<span style='font-size:18px'><b>ปี : " . $year = $result_year_term["year"] . "</b></span> | ";
                                echo "<span style='font-size:18px'>รอบการประเมินที่ " . $term = $result_year_term["term_name"] . " : " . $result_year_term["start_month"] . "-" . $result_year_term["end_month"] . "</span>";
                            }
                            ?>
                            </h4>                           
                        </div>                                                                            
                                         <!--edit/remove -->
                                        <div class="row">
                                            <div class="box-padding">
                                                <!-- ช่องค้นหา by listJS -->
                                                <div class="form-inline padding-small">
                                                    <i class="glyphicon glyphicon-search" style="padding: 0px 10px;" ></i>
                                                    <input class="search form-control" placeholder="ค้นหา" />
                                                    
                                                </div>
                                                <table id="example" class="table table-bordered table-hover table-striped "  >
                                                    <thead>
                                                        <tr>
                                                            <th class=""></th>
                                                            <th><button class="sort" data-sort="emp_id"><b>รหัสพนักงาน</b></button></th>
                                                            <th><button class="sort" data-sort="emp_name"><b>ชื่อ-นามสกุล</b></button></th>
                                                            <th class="text-center"><button class="sort" data-sort="job_name"><b>ตำแหน่ง</b></button></th>
                                                            <th class="text-center"><button class="sort" data-sort="dept_name"><b>แผนก</b></button></th>
                                                            <th class="text-center" style="min-width:100px;"><button class="sort" data-sort="pos_level_id"><b>ระดับ</b></button></th>
                                                            
                                                            <th class="text-center"  style="min-width:100px;"><b>PDF</b></th>
                                                        </tr>
                                                    </thead>
                                                    <?php
                                                        $sql_emp = "SELECT prefix,first_name,last_name,d.department_name, j.job_name, pl.position_description,e.employee_id,e.profile_picture,ee.evaluation_code,ee.evaluate_employee_id
                                                                    FROM evaluation_employee ee 
                                                                    JOIN employees e ON ee.employee_id = e.employee_id 
                                                                    JOIN departments d ON e.department_id = d.department_id 
                                                                    JOIN jobs j ON e.job_id = j.job_id 
                                                                    JOIN position_level pl ON e.position_level_id = pl.position_level_id
                                                                    WHERE status_success = 1 AND e.company_id = 1 and ee.evaluation_code='".$_GET['eval_code']."'";
                                                        $query = mysqli_query($conn, $sql_emp); //$conn มาจากไฟล์ connection_mysqli.php เป็นตัว connect DB
                                                    ?>
                                                    <tbody class="list">
                                                        <?php
                                                        while ($result = mysqli_fetch_assoc($query)) {
                                                            $emp_id = $result["employee_id"];
                                                            $name = $result["prefix"].$result["first_name"] . "  " . $result["last_name"];
                                                            $profile_picture = $result["profile_picture"];
                                                            $dept = $result["department_name"];
                                                            $job = $result["job_name"];
                                                            $position = $result["position_description"];
                                                            $eval_code = $result["evaluation_code"];                                                            
                                                            $eval_emp_id = $result["evaluate_employee_id"];
                                                            ?>
                                                            <tr>
                                                                <td class="profile_picture"><img class="img-circle img-center" src="../upload_images/<?php if($profile_picture == ''){ echo 'default.png' ;}else { echo $profile_picture;} ?>" style="width: 35px;height: 35px;" alt="<?php echo $profile_picture; ?>" ></td>
                                                                <td class="emp_id" style="width: 130px;"><?php echo $emp_id; ?></td>
                                                                <td class="emp_name"><?php echo $name; ?></td>
                                                                <td class="job_name text-center"><?php echo $job; ?></td>
                                                                <td class="dept_name text-center"><?php echo $dept; ?></td>
                                                                <td class="pos_level_id text-center"><?php echo $position; ?></td>
                                                                
                                                                <td class="text-center">
                                                                    <a class="btn btn-danger btn-md" href="pdf_report_individual.php?emp_id=<?php echo $emp_id; ?>&eval_code=<?php echo $eval_code; ?>&eval_emp_id=<?php echo $eval_emp_id; ?>"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                                                                </td>
                                                            </tr>
                                                            
                                                        <?php } ?>
                                                    </tbody>
                                                    <script>
                                                        var options = {
                                                            valueNames: [ 'emp_id', 'emp_name' , 'job_name' , 'dept_name','pos_level_id' ]
                                                        };
                                                        
                                                        var userList = new List('filter', options);
                                                    </script>
                                                </table>
                                            </div>
                                        </div>
                                        <!--/edit/remove -->
                                         
                                    
                                    
                                

                            
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
        <?php include('./script_packs.html') ?>
</html>
            <?php
        }
    }

    
?>