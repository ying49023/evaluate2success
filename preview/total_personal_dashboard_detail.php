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
    $get_eval_code = '';
    if(isset($_GET["eval_code"])){
        $get_eval_code  = $_GET["eval_code"];
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
                    ดูภาพรวมรายบุคคล 
                    <small>แดชบอร์ด</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="index.php"> <i class="fa fa-dashboard"></i>
                            Home
                        </a>
                    </li>
                    <li ><a href="total_personal_dashboard.php">Personal dashboard</a></li>
                    <li class="active">Overall personal dashboard</li>
                </ol>
            </section>
            <!--/Page header -->

            <!-- Main content -->
            <div class="row box-padding">
                <div class="box box-success ">
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
                                                    e.employee_id ='".$get_emp_id."'";
    $query_emp = mysqli_query($conn, $sql_emp);
    while ($result_emp = mysqli_fetch_array($query_emp, MYSQLI_ASSOC)) {
        ?>
    <div class="box-header">
        <div class="col-md6">
            
            
            <div style="float: right;">
                <img class='img-circle img-sm img-center' src="./upload_images/<?php if($result_emp["profile_picture"]== ''){ echo 'default.png' ;}else { echo  $result_emp["profile_picture"];} ?>"  > <span span style="font-size:18px"><?php echo "&nbsp;&nbsp;" . $result_emp["employee_id"] . ' : ' . $result_emp["emp_name"]; ?></span>
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

                    $sql_year_term = "SELECT * FROM evaluation e JOIN term t ON e.term_id=t.term_id WHERE evaluation_code = '".$get_eval_code."'";
                    $query_year_term = mysqli_query($conn, $sql_year_term);
                    while ($result_year_term = mysqli_fetch_array($query_year_term, MYSQLI_ASSOC)) {
                        echo "<span style='font-size:18px'><b>ปีการประเมิน " . $year = $result_year_term["year"] . "</b></span> | ";
                        echo "<span style='font-size:18px'>รอบการประเมินที่ " . $term = $result_year_term["term_name"] . " : " . $result_year_term["start_month"] . "-" . $result_year_term["end_month"] . "</span>";
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
                    <img class="img-center img-thumbnail" style="height: 130px;max-width: 110px;" src="upload_images/<?php
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
                    $sql_eval_period = "SELECT * FROM evaluation WHERE evaluation_code = '".$get_eval_code."' ";
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
            <div class="row box-padding">
                <div class="row">
                    <div class="col-md-4">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <strong>KPIภาพรวมล่าสุด</strong>
                                <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"> <i class="fa fa-minus"></i>
                                </button>
                                
                            </div>
                            </div>
                            <div class="box-body">
                                <!-- คิวรี่แสดงค่าไมล์รวม -->
                                <?php
                                    $sql_mile ="select SUM(r.percent_weight*r.percent_performance)/ (SELECT SUM(percent_weight) FROM kpi_responsible er
                                    JOIN evaluation_employee ee ON ee.evaluate_employee_id = er.evaluate_employee_id
                                    WHERE ee.employee_id=$get_emp_id and ee.evaluation_code =$get_eval_code  ) as mile_percent
                                    FROM kpi_responsible r
                                    JOIN evaluation_employee e ON e.evaluate_employee_id = r.evaluate_employee_id
                                    JOIN evaluation ev ON ev.evaluation_code = e.evaluation_code
                                    WHERE e.employee_id=$get_emp_id  AND r.percent_performance IS NOT NULL and ev.evaluation_code =$get_eval_code ";
                                    $query_mile = mysqli_query($conn, $sql_mile);
                                    while ($result_mile = mysqli_fetch_assoc($query_mile)){
                                        $mile = $result_mile['mile_percent'];
                                    }
                                ?>
                                <div id="g5" class="200px160px" style="height:220px">
                                    <script>
                                    document.addEventListener("DOMContentLoaded", function(event) {
                                      var g5 = new JustGage({
                                        id: "g5",
                                        //value: getRandomInt(0, 100),
                                        value : <?php echo $mile; ;?>,
                                        min: 0,
                                        max: 100,
                                        title: "สถานะKPIs",
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
                                    
                                    <?php  
               
                                        $sql_kpi="SELECT k.unit,k.kpi_code as kpi_id, k.kpi_name as kpi_name, kr.percent_weight as weight, kr.goal as goal, kr.success as success, e.term_id as term, e.year as year,k.measure_symbol as symbol,kr.kpi_responsible_id,kr.percent_performance 
                                                    FROM kpi k JOIN kpi_responsible kr ON k.kpi_id=kr.kpi_id 
                                                    JOIN evaluation_employee ee ON ee.evaluate_employee_id = kr.evaluate_employee_id
                                                    JOIN evaluation e ON ee.evaluation_code = e.evaluation_code 
                                                    WHERE e.evaluation_code =$get_eval_code and ee.employee_id = '".$get_emp_id."' ORDER BY kpi_id ";
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
                                            <center>ติดตามสถานะการทำงาน</center>
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
                                                <a href="total_personal_dashboard_detail2.php?emp_id=<?php echo $get_emp_id; ?>&kpi_id=<?php echo $kpi_id ?>&eval_code=<?php echo $eval_code; ?>">
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