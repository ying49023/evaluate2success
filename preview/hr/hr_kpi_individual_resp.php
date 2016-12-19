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
        if (isset($_GET["eval_code"])) {
            $get_eval_code = $_GET["eval_code"]; //GET ค่ามาจากหน้า hr_kpi_individual.php ผ่านลิงค์ 
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
                    KPIs ที่รับผิดชอบรายบุคคลของพนักงาน
                  
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
                    GROUP_CONCAT(m.prefix,m.first_name,'  ',m.last_name) as manager_name_1
                    FROM
                        employees e
                    JOIN position_level p ON p.position_level_id = e.position_level_id
                    JOIN departments d ON d.department_id = e.department_id
                    JOIN jobs j ON j.job_id = e.job_id
                    JOIN employees m ON e.manager_id = m.employee_id
                    WHERE e.employee_id ='".$get_emp_id."'";
    $query_emp = mysqli_query($conn, $sql_emp);
    while ($result_emp = mysqli_fetch_array($query_emp, MYSQLI_ASSOC)) {
        $manager_name_1 = $result_emp["manager_name_1"];
        $manager_name_2 = '';
        if($result_emp["manager_id2"] != '' && $result_emp["manager_id2"] != 0){
            $sql_man2 = "SELECT GROUP_CONCAT(m2.prefix,m2.first_name,'  ',m2.last_name) as manager_name_2
                        FROM employees e
                        JOIN position_level p ON p.position_level_id = e.position_level_id
                        JOIN departments d ON d.department_id = e.department_id
                        JOIN jobs j ON j.job_id = e.job_id
                        JOIN employees m2 ON e.manager_id2 = m2.employee_id
                        WHERE e.employee_id = '".$get_emp_id."'";
            $query_man2 = mysqli_query($conn, $sql_man2);
            $result_man2 = mysqli_fetch_row($query_man2);
            $manager_name_2 = $result_man2["manager_name_2"];
        }
        
        ?>
    <div class="box-header">
        <div class="col-md6">
            
            
            <div style="float: right;">
                <img class='img-circle img-sm img-center' src="http://palmup.xyz/evaluate2success/preview/upload_images/<?php if($result_emp["profile_picture"]== ''){ echo 'default.png' ;}else { echo  $result_emp["profile_picture"];} ?>"  > <span span style="font-size:18px"><?php echo "&nbsp;&nbsp;" . $result_emp["employee_id"] . ' : ' . $result_emp["emp_name"]; ?></span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"> <i class="fa fa-minus"></i>
                </button>
            </div>
                <div col-md-6>
                    <div style="float: left;">
                                    <?php
                                    $eval_code = '';
                                    if (isset($_GET["eval_code"])) {
                                        $eval_code = $_GET["eval_code"];
                                    }
                                        
                                    $sql_year_term = "SELECT * FROM evaluation e JOIN term t ON e.term_id=t.term_id WHERE evaluation_code = '$eval_code'";
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
                    <img class="img-center img-thumbnail" style="height: 130px;max-width: 110px;" src="http://palmup.xyz/evaluate2success/preview/upload_images/<?php
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
                <td><?php echo $manager_name_1; ?></td>
                <td><?php echo $manager_name_2; ?></td>
                <td>
                    <?php 
                    $sql_eval_period = "SELECT * FROM evaluation WHERE evaluation_code = '$eval_code' ";
                    $query_eval_period = mysqli_query($conn, $sql_eval_period) or die(mysqli_errno());
                    $result_eval_period = mysqli_fetch_array($query_eval_period,MYSQLI_ASSOC);
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
                <h3>KPIs ที่รับผิดชอบทั้งหมด</h3>
            </div>
            <div class="row box-padding">
                <div class="box box-primary">
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr class="bg-primary  ">
                                <td>รหัส</td>
                                <td width="500px" class="text-center">ชื่อตัวชี้วัด</td>
                                <td width="120px" class="text-center">น้ำหนัก</td>
                                <td width="120px" class="text-center">เป้าหมาย</td>
                                <td width="120px" class="text-center">ที่ทำได้จริง</td>
                                <td width="300px" class="text-center">รอบการประเมิน</td>
                            </tr>
                                    <?php
                                    /* $sql_kpi = "SELECT kpi_resp.kpi_id as kpi_id , kpi.kpi_name as kpi_name , kpi_resp.percent_weight as weight , "
                                      ." kpi_resp.goal as goal , kpi_resp.success as success, eval.term as term , eval.year as year "
                                      ." FROM employees emp "
                                      ." JOIN evaluation_employee eval_emp on eval_emp.employee_id = emp.employee_id "
                                      ." JOIN evaluation eval on eval_emp.evaluation_code = eval.evaluation_code "
                                      ." JOIN kpi_responsible kpi_resp on eval_emp.evaluate_employee_id = kpi_resp.evaluate_employee_id "
                                      ." JOIN kpi on kpi_resp.kpi_id = kpi.kpi_id "
                                      ." WHERE eval_emp.employee_id = '".$emp_id."' ORDER BY kpi_id ";
                                      $sql_kpi="SELECT k.kpi_code as kpi_id, k.kpi_name as kpi_name, kr.percent_weight as weight, kr.goal as goal, kr.success as success, e.term_id as term, e.year as year,k.measure_symbol as symbol,k.unit
                                      FROM kpi k JOIN kpi_responsible kr ON k.kpi_id=kr.kpi_id
                                      JOIN evaluation_employee ee ON ee.evaluate_employee_id = kr.evaluate_employee_id
                                      JOIN evaluation e ON ee.evaluation_code = e.evaluation_code
                                      WHERE ee.employee_id = '".$emp_id."' ORDER BY kpi_id "; */
                                    $sql_kpi = "SELECT
                                    k.kpi_code AS kpi_id,
                                    k.kpi_name AS kpi_name,
                                    k.unit As unit,
                                    kr.percent_weight AS weight,
                                    kr.goal AS goal,
                                    kr.success AS success,
                                    e.term_id AS term,
                                    e.YEAR AS year,
                                    k.measure_symbol AS symbol,
                                    kr.percent_performance,
                                    kr.kpi_responsible_id
                            FROM
                                    kpi k
                            JOIN kpi_responsible kr ON k.kpi_id = kr.kpi_id
                            JOIN evaluation_employee ee ON ee.evaluate_employee_id = kr.evaluate_employee_id
                            JOIN evaluation e ON ee.evaluation_code = e.evaluation_code
                            WHERE
                                    ee.employee_id = '$get_emp_id' AND e.evaluation_code = '$get_eval_code'
                            ORDER BY
                                    kpi_id";
                                    $query_kpi = mysqli_query($conn, $sql_kpi);
                                    $count = mysqli_num_rows($query_kpi);
                                    if ($count == 0) {
                                        echo "<th class='text-center' colspan='6'> ไม่มีการกำหนด KPI สำหรับปีการประเมิน " . $eval_year . ' รอบการประเมินที่ ' . $eval_term . " </th>";
                                    }
                                    ?>
                            <?php while($result_kpi = mysqli_fetch_assoc($query_kpi)) {
                                
                                $kpi_id = $result_kpi["kpi_id"];
                                $kpi_name = $result_kpi["kpi_name"];
                                $weight = $result_kpi["weight"];
                                $goal = $result_kpi["goal"];
                                $symbol = $result_kpi["symbol"];
                                $success = $result_kpi["success"];
                                $term = $result_kpi["term"];
                                $year = $result_kpi["year"];
                                $unit = $result_kpi["unit"];

                             ?>
                                    <tr>
                                        <td><?php echo $kpi_id ;?></td>
                                        <td><?php echo $kpi_name ; ?></td>
                                        <td class="text-center"><?php echo $weight."%" ; ?></td>
                                        <td class="text-center"><?php echo $symbol."".$goal."".$unit ; ?></td>
                                        <td class="text-center"><?php echo $success."".$unit ; ?></td>
                                        <td class="text-center">
                                            <?php echo $term." / ".$year ;?>
                                        </td>
                                    </tr>
                                
                            <?php } ?>
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
<!-- SCRIPT PACKS -->
    <?php include ('./script_packs.html'); ?>
</html>
            <?php
        }
    }

    
?>