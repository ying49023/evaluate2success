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
                        กำหนดKPIs
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Assign KPIs</li>
                    </ol>
                </section>
                <!--/Page header -->

                <!-- Main content -->
                <div class="row box-padding">
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
     
                        <div  id="filter" class="box-body ">
                            <!-- ช่องค้นหา by listJS -->
                            <div class="form-inline padding-small">
                                <i class="glyphicon glyphicon-search" style="padding: 0px 10px;" ></i>
                                <input class="search form-control" placeholder="ค้นหา" />
                            </div>
                            <table class="table table-bordered table-hover">
                                <thead>
                               
                                    <tr class="bg-gray-light">
                                        <th class="text-center"><button class="sort" data-sort="emp_id">ID</button></th>
                                        <th><button class="sort" data-sort="name">ชื่อ-นามสกุล</button></th>
                                        <th class="text-center"><button class="sort" data-sort="job_name">ตำแหน่ง</button></th>
                                        <th class="text-center"><button class="sort" data-sort="department_name">แผนก</button></th>
                                        <th class="text-center">กำหนดKPI</th>
                                        
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    <?php 
                                    $sql_emp = "SELECT
                                                        e.employee_id as employee_id, e.prefix as prefix, e.first_name as first_name, e.last_name as last_name, d.department_name as department_name, j.job_name as job_name
                                                FROM
                                                        employees e
                                                JOIN employees m ON e.manager_id = m.employee_id
                                                JOIN departments d ON e.department_id = d.department_id
                                                JOIN jobs j ON j.job_id = e.job_id
                                                WHERE
                                                        m.employee_id = '$my_emp_id'";
                                    $query_emp = mysqli_query($conn, $sql_emp);
                                    while($result_emp = mysqli_fetch_array($query_emp , MYSQLI_ASSOC)){
                                    
                                    ?>
                                        <tr>
                                            <td class="emp_id text-center"><?php echo $result_emp["employee_id"]; ?></td>
                                            <td class="name" ><?php echo $result_emp["prefix"].$result_emp["first_name"]."  ".$result_emp["last_name"]; ?></td>
                                            <td class="job_name text-center"><?php echo $result_emp["job_name"]; ?></td>
                                            <td class="department_name text-center"><?php echo $result_emp["department_name"]; ?></td>
                                            <td class="text-center"><a href="manageassignkpi.php?employee_id=<?php echo $result_emp["employee_id"]; ?>"><i class="glyphicon glyphicon-folder-open"></i></a></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <script>
                                    var options = {
                                        valueNames: [ 'emp_id', 'name' , 'job_name' , 'department_name' ]
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
        <?php include('./script_packs.html') ?>
</html>
<?php
        }
    }
?>
