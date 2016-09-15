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
    $get_emp_id = '';
    if(isset($_GET["emp_id"])){
        $get_emp_id  = $_GET["emp_id"];
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
    
    <!-- SCRIPT PACKS -->
    <?php include('./script_packs.html') ?>
    <style>
            .myDiv{
                height: 100%;
                width: 100%;
            }
        </style>
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
                    ติดตามสถานะการทำงาน
                    <small></small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="#"> <i class="fa fa-dashboard"></i>
                            Home
                        </a>
                    </li>
                    <li class="active">KPIs</li>
                </ol>
            </section>
            <!--/Page header -->

            <!-- Main content -->
            <div class="row box-padding">
                <div class="box box-success">
                    <div class="box-body">
                        <!--ข้อมูลทั่วไป-->
                        <?php
                            $sql_emp = "SELECT
                                        emp.employee_id AS emp_id,
                                        emp.prefix As prefix,
                                        emp.first_name AS f_name,
                                        emp.last_name AS l_name,
                                        emp.hiredate AS hiredate,
                                        emp.manager_id AS manager_id,
                                        emp.email AS email,
                                        emp.telephone_no AS telephone,
                                        dept.department_name AS dept_name,
                                        pos.position_description AS pos,
                                        emp.profile_picture 
                                FROM
                                        employees emp
                                JOIN departments dept ON emp.department_id = dept.department_id
                                JOIN position_level pos ON emp.position_level_id = pos.position_level_id
                                WHERE
                                        emp.employee_id = '".$get_emp_id."'
                                LIMIT 1";
                                $query = mysqli_query($conn, $sql_emp); 
                        ?>
                        <?php  while($result = mysqli_fetch_assoc($query)){ 
                                    $employee_id = $result["emp_id"];
                                    $name = $result["prefix"].$result["f_name"]."  ".$result["l_name"];
                                    $hire = $result["hiredate"];
                                    $manager_id = $result["manager_id"];
                                    $dept = $result["dept_name"];
                                    $pos = $result["pos"];
                                    $email = $result["email"];
                                    $tel = $result["telephone"];
                                    $picture = $result["profile_picture"];
                                    $sql_manager = "SELECT * from employees where employee_id = '".$manager_id."'" ;
                                    $query_manager = mysqli_query($conn, $sql_manager);
                                    $result_manager = mysqli_fetch_array($query_manager);
                                    $manager_name = $result_manager["prefix"].$result_manager["first_name"]." ".$result_manager["last_name"];
                        ?>
                                <table class="table table-responsive ">
                                    
                                        <tr>
                                            <th rowspan="5">
                                                <img class=" img-responsive img-thumbnail img-lg img-center"   src="./upload_images/<?php echo $picture;?>">
                                            </th>
                                            <th align="center" colspan="2" width="">ชื่อ-นามสกุล: </th>
                                            <td  colspan="2" width=""><?php echo $name;?></td>
                                            <th align="center" colspan="2" width="">รหัส: </th>
                                            <td  colspan="2" width=""><?php echo $my_emp_id;?> </td>

                                        </tr>
                                        
                                        <tr>
                                            <th align="center" colspan="2" width="">วันเริ่มงาน: </th>
                                            <td  colspan="2" width=""><?php echo $hire;?></td>
                                            <th align="center" colspan="2" width="">สังกัด / ฝ่าย / สายงาน :    </th>
                                            <td  colspan="2" width=""><?php echo $pos;?></td>
                                            
                                        </tr>
                                        <tr>
                                            <th align="center" colspan="2" width="">ชื่อ - นามสกุลของผู้ประเมินที่ 1 :   </th>
                                            <td  colspan="2" width=""><?php echo $manager_name;?></td>
                                            <th align="center" colspan="2" width="">ชื่อ - นามสกุลของผู้ประเมินที่ 2 :   </th>
                                            <td colspan="2" width=""> </td>
                                            
                                        </tr>
                                        
                                    
                                
                                
                                
                                       
                                   </table><!--/ข้อมูลทั่วไป--> 
                        <?php } ?>
                        
                    </div>
                </div>

            </div>
            <div class="row box-padding">
                <div class="row">
                    <div class="col-md-4">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <strong>KPIภาพรวมล่าสุด ประจำเดือน : พฤษภาคม</strong>
                                <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"> <i class="fa fa-minus"></i>
                                </button>
                                
                            </div>
                            </div>
                            <div class="box-body">
                                <div id="g5" class="200px160px" style="height:220px">
                                    <script>
                                    document.addEventListener("DOMContentLoaded", function(event) {
                                      var g5 = new JustGage({
                                        id: "g5",
                                        //value: getRandomInt(0, 100),
                                        value : 35.5,
                                        min: 0,
                                        max: 100,
                                        title: "เดือนพฤษภาคม",
                                        label: "%",
                                        levelColorsGradient: false
                                      });
                                  });
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="box box-primary">

                            <div class="box-header with-border">
                                <strong>รายการKPIs</strong>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="box-body" >
                                <table class="table table-bordered " border="1px">
                                    <tr>
                                        <th>No.</th>
                                        <th>KPIs</th>
                                        <th>
                                            <center>เป้าหมาย</center>
                                        </th>
                                        <th>
                                            <center>ค่าจริง</center>
                                        </th>
                                        <th>
                                            <center>สถานะ</center>
                                        </th>
                                        <th>
                                            <center>ดูรายละเอียด</center>
                                        </th>

                                    </tr>
                                    <?php  
               
                                        $sql_kpi="SELECT k.unit,k.kpi_code as kpi_id, k.kpi_name as kpi_name, kr.percent_weight as weight, kr.goal as goal, kr.success as success, e.term_id as term, e.year as year,k.measure_symbol as symbol,kr.kpi_responsible_id,kr.percent_performance 
                                                    FROM kpi k JOIN kpi_responsible kr ON k.kpi_id=kr.kpi_id 
                                                    JOIN evaluation_employee ee ON ee.evaluate_employee_id = kr.evaluate_employee_id
                                                    JOIN evaluation e ON ee.evaluation_code = e.evaluation_code 
                                                    WHERE ee.employee_id = '".$get_emp_id."' ORDER BY kpi_id ";
                                        $query_kpi = mysqli_query($conn, $sql_kpi);
                                    ?>
            
                                <table class="table table-bordered" width="90%" height="100px" border="1px">
                                    <tr>
                                        <th>No.</th>
                                        <th>KPIs</th>
                                        <th>
                                            <center>เป้าหมาย</center>
                                        </th>
                                        <th>
                                            <center>ค่าจริง</center>
                                        </th>
                                        <th>
                                            <center>สถานะ</center>
                                        </th>
                                        <th>
                                            <center>อัพเดทKPIs</center>
                                        </th>

                                    </tr>
                                     <?php while($result_kpi = mysqli_fetch_assoc($query_kpi)) {
                
                                $kpi_id = $result_kpi["kpi_id"];
                                $kpi_name = $result_kpi["kpi_name"];
                                $weight = $result_kpi["weight"];
                                $goal = $result_kpi["goal"];
                                $symbol = $result_kpi["symbol"];
                                $success = $result_kpi["success"];
                                $term = $result_kpi["term"];
                                $year = $result_kpi["year"];
                                $kpi_resp = $result_kpi["kpi_responsible_id"];
                                $progress=$result_kpi['percent_performance'];
                                $kpi_unit =$result_kpi["unit"];
                             ?>
                             <?php
                                $sql_progess = "call getMile_kpi_response($kpi_resp) ";
                                $query_progess = mysqli_query($conn, $sql_progess);
                             ?>                
                    
                                    <tr>
                                        <th><?php echo $kpi_id;?></th>
                                        <th><?php echo $kpi_name;?></th>
                                        <th>
                                            <center><?php echo $symbol."".$goal." ".$kpi_unit;?></center>
                                        </th>
                                        <th>
                                        <center><?php echo round($success,2);?></center>
                                        </th>
                                        <th>
                                            <div class="progress">                                             
                                                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" 
                                                style="width:<?php echo round($progress,2); ?>%"><?php  echo round($progress,2); ?>
                                                </div>                                                
                                            </div>
                                        </th>
                                        <th>
                                            <center>
                                                <a href="tracking_sub_detail.php?emp_id=<?php echo $get_emp_id; ?>&kpi_id=<?php echo $kpi_id ?>">
                                                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                                </a>
                                            </center>
                                        </th>
                                    </tr>
                                    <?php } ?>
                                    

                                        </table>

                                    </div>
                                </div>
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