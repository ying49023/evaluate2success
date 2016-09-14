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
    $name='';
    $id='';
            if (isset($_GET["department"])) {
                $get_department_id = $_GET["department"];
            }
            if (isset($_GET["full_name"])) {
                $name = $_GET["full_name"];
            }
            if (isset($_GET["emp_id"])) {
                $id = $_GET["emp_id"];
            }

            $condition_search = '';
            if ($get_department_id != '') {
                $condition_search = " WHERE dept.department_id = '" . $get_department_id . "'";
            }else if($name != '') {
                $condition_search = " WHERE emp.first_name = '" . $name. "'";
            }else if($id != '') {
                $condition_search = " WHERE emp.employee_id = '" . $id. "'";
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
                        จัดการข้อมูลวันลาของพนักงาน
                        
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
                        <div class="box-header with-border">
                            <h4>รอบการประเมินที่....</h4>                           
                        </div>                                                                            
                                         <!--edit/remove -->
                                        <div class="row">
                                            <div class="box-padding">
<!--                                                <div class="row-border with-border">
                                                    <div class="col-md-offset-1 col-md-10">
                                                        <div class="box-body ">
                                                        <form method="get">    
                                                            <div class="col-sm-3">
                                                                <label>รหัสพนักงาน</label>
                                                                <input class="form-control" type="text" name="emp_id" />
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <label>ชื่อพนักงาน</label>
                                                                <input class="form-control" type="text" name="full_name" />
                                                            </div>
                                                            <?php
                                                            $sql_dept = "SELECT * FROM departments";
                                                            $query_department = mysqli_query($conn, $sql_dept);
                                                            
                                                            ?>
                                                            <div class="col-sm-4">
                                                                <label>แผนก</label>
                                                                 <select class="form-control" name="department">
                                                                    <option value="">เลือกทั้งหมด</option>
                                                                    <?php while ($result_department2 = mysqli_fetch_array($query_department, MYSQLI_ASSOC)) { ?>
                                                                    <option value="<?php echo $result_department2["department_id"]; ?>" <?php if($get_department_id == $result_department2["department_id"]) { echo "selected"; }  ?> >
                                                                        <?php echo $result_department2["department_name"]; ?>
                                                                    </option>
                                                                    <?php } ?>
                                                                </select>                                                          
                                                                
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <input style="margin-top: 25px;" type="submit" class="btn btn-primary btn-md" name="submit_2" />
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>-->
                                                <!-- ช่องค้นหา by listJS -->
                                                <div class="form-inline padding-small">
                                                    <i class="glyphicon glyphicon-search" style="padding: 0px 10px;" ></i>
                                                    <input class="search form-control" placeholder="ค้นหา" />
                                                    
                                                </div>
                                                <table id="example" class="table table-hover table-striped "  >
                                                    <thead>
                                                        <tr>
                                                            <th class=""></th>
                                                            <th><button class="sort" data-sort="emp_id"><b>รหัสพนักงาน</b></button></th>
                                                            <th><button class="sort" data-sort="emp_name"><b>ชื่อ-นามสกุล</b></button></th>
                                                            <th class="text-center"><button class="sort" data-sort="job_name"><b>ตำแหน่ง</b></button></th>
                                                            <th class="text-center"><button class="sort" data-sort="dept_name"><b>แผนก</b></button></th>
                                                            <th class="text-center"  style="min-width:100px;"><b>แก้ไข/ลบ</b></th>
                                                        </tr>
                                                    </thead>
                                                    <?php
                                                        $sql_emp = "SELECT emp.employee_id as emp_id,emp.prefix as prefix, emp.first_name as f_name, emp.last_name as l_name, "
                                                                . "dept.department_name as dept_name, j.job_name as job, emp.profile_picture as profile_picture FROM employees emp "
                                                                . "join departments dept on emp.department_id = dept.department_id join jobs j "
                                                                . "on emp.job_id = j.job_id ".$condition_search." ORDER BY emp_id ASC";
                                                        $query = mysqli_query($conn, $sql_emp); //$conn มาจากไฟล์ connection_mysqli.php เป็นตัว connect DB
                                                    ?>
                                                    <tbody class="list">
                                                        <?php
                                                        while ($result = mysqli_fetch_assoc($query)) {
                                                            $emp_id = $result["emp_id"];
                                                            $name = $result["prefix"].$result["f_name"] . "  " . $result["l_name"];
                                                            $profile_picture = $result["profile_picture"];
                                                            $dept = $result["dept_name"];
                                                            $job = $result["job"];
                                                            ?>
                                                            <tr>
                                                                <td class="profile_picture"><img class="img-circle img-center" src="../upload_images/<?php if($profile_picture == ''){ echo 'default.png' ;}else { echo $profile_picture;} ?>" style="width: 35px;height: 35px;" alt="<?php echo $profile_picture; ?>" ></td>
                                                                <td class="emp_id"><?php echo $emp_id; ?></td>
                                                                <td class="emp_name"><?php echo $name; ?></td>
                                                                <td class="job_name text-center"><?php echo $job; ?></td>
                                                                <td class="dept_name text-center"><?php echo $dept; ?></td>
                                                                <td class="text-center">
                                                                    <a class="btn btn-primary btn-sm" href="leave_form2.php?emp_id=<?php echo $emp_id; ?>"><i class="glyphicon glyphicon-log-out"></i></a>
                                                                
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