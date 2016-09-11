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
                        <?php
                        $sql_emp = "SELECT
                                    e.employee_id as employee_id,
                                    e.prefix as prefix,
                                    e.first_name as first_name,
                                    e.last_name as last_name,
                                    e.profile_picture as profile_picture,
                                    d.department_name as department_name,
                                    j.job_name as job_name,
                                    (sum(kr.success*kr.percent_weight)/sum(kr.success*kr.percent_weight)*100) as target_percent,
                                    (sum(kr.success*kr.percent_weight)/sum(kr.goal*kr.percent_weight)*100) as actual_percent

                                    FROM
                                        kpi_responsible kr
                                    JOIN kpi k ON kr.kpi_id = k.kpi_id
                                    JOIN evaluation_employee ee ON ee.evaluate_employee_id = kr.evaluate_employee_id
                                    JOIN employees e ON ee.employee_id = e.employee_id
                                    JOIN departments d ON e.department_id = d.department_id
                                    JOIN jobs j ON e.job_id = j.job_id
                                    WHERE ee.employee_id = '$get_emp_id';";
                        $query_emp = mysqli_query($conn, $sql_emp);
                        while($result_emp = mysqli_fetch_array($query_emp, MYSQLI_ASSOC)) {
                        ?>
                        <table class="table table-bordered table-condensed" align="right" >
                            
                            <tr>
                                <th rowspan="2">
                                    <img class="img-circle img-thumbnail circle-thumbnail img-center" src="./upload_images/<?php if($result_emp["profile_picture"] == ''){ echo "default.png"; } else { echo $result_emp["profile_picture"]; } ?>" alt="<?php echo $result_emp["profile_picture"]; ?>" style="width: 55px;height: 55px;">
                                </th>
                                <th>
                                    <center>รหัสพนักงาน</center>
                                </th>
                                <th>
                                    <center>ชื่อพนักงาน</center>
                                </th>
                                <th>
                                    <center>ตำแหน่ง</center>
                                </th>
                                <th>
                                    <center>ฝ่าย/แผนก</center>
                                </th>
                                <th>
                                    <center>เป้าหมาย</center>
                                </th>
                                <th>
                                    <center>ค่าจริง</center>
                                </th>
                                <th>
                                    <center>เทียบกับเป้าหมาย</center>
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <center><?php echo $result_emp["employee_id"]; ?></center>
                                </td>
                                <td>
                                    <center><?php echo $result_emp["prefix"].$result_emp["first_name"].'  '.$result_emp["last_name"]; ?></center>
                                </td>
                                <td>
                                    <center><?php echo $result_emp["job_name"]; ?></center>
                                </td>
                                <td>
                                    <center><?php echo $result_emp["department_name"]; ?></center>
                                </td>
                                <th>
                                    <center><?php echo number_format($result_emp["target_percent"]).'%'; ?></center>
                                </th>
                                <th>
                                    <center><?php echo number_format($result_emp["actual_percent"],2).'%'; ?></center>
                                </th>
                                <th>
                                    <center></center>
                                </th>
                            </tr>
                        </table>
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
                                    $sql_kpi = "SELECT 
                                                        k.kpi_id As kpi_id,
                                                        k.kpi_code AS kpi_code,
                                                        k.kpi_name As kpi_name,
                                                        k.measure_symbol As symbol,
                                                        kr.goal as goal,
                                                        kr.success as success,
                                                        eval.year AS year,
                                                        eval.term_id AS term_id,
                                                        t.start_month AS start_month,
                                                        t.end_month AS end_month,
                                                        e.employee_id As employee_id,
                                                        (((kr.success*kr.percent_weight)/(kr.goal*kr.percent_weight))*100) as status_percent
                                                 FROM
                                                        kpi_responsible kr
                                                JOIN kpi k ON kr.kpi_id = k.kpi_id
                                                JOIN evaluation_employee ee ON ee.evaluate_employee_id = kr.evaluate_employee_id
                                                JOIN employees e ON ee.employee_id = e.employee_id
                                                JOIN departments d ON e.department_id = d.department_id
                                                JOIN jobs j ON e.job_id = j.job_id
                                                JOIN evaluation eval ON ee.evaluation_code = eval.evaluation_code
                                                JOIN term t ON t.term_id = eval.term_id
                                                WHERE ee.employee_id = '$get_emp_id'";
                                    $query_kpi = mysqli_query($conn, $sql_kpi);
                                    while($result_kpi = mysqli_fetch_array($query_kpi,MYSQLI_ASSOC)){
                                    ?>
                                    <tr>
                                        <th><?php echo $result_kpi["kpi_code"]; ?></th>
                                        <th><?php echo $result_kpi["kpi_name"]; ?></th>
                                        <th>
                                            <center><?php echo $result_kpi["symbol"].$result_kpi["goal"]; ?></center>
                                        </th>
                                        <th>
                                            <center><?php echo $result_kpi["success"]; ?></center>
                                        </th>
                                        <th>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" 
                                                     style="width: <?php echo number_format($result_kpi["status_percent"],0); ?>%;"><?php echo number_format($result_kpi["status_percent"],0)."%"; ?></div>
                                            </div>
                                        </th>
                                        <th>
                                            <center>
                                                <a href="tracking_sub_detail.php?emp_id=<?php echo $result_kpi["employee_id"]; ?>&kpi_id=<?php echo $result_kpi["kpi_id"]; ?>">
                                                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                                </a>
                                            </center>
                                        </th>
                                    </tr>
                                    <?php } ?>
                                    <tr>
                                        <th>1202</th>
                                        <th>ความสามารถจัดทำอัตราแผนความสามารถกำลังคน</th>
                                        <th>
                                            <center>
                                                <20% </center></th>
                                                <th>
                                                    <center>14%</center>
                                                </th>
                                                <th>
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" aria-valuenow="14" aria-valuemin="0" aria-valuemax="100" 
                                                style="width: 14%;">14%</div>
                                                    </div>
                                                </th>
                                                <th>
                                                    <center>
                                                        <a href="tracking_sub_detail.php">
                                                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                                        </a>
                                                    </center>
                                                </th>
                                            </tr>

                                            <tr>
                                                <th>1203</th>
                                                <th>อัตราจำนวนชั่วโมงการฝึกอบรม/คน/ครึ่งปี</th>
                                                <th>
                                                    <center>>=6ชั่วโมง</center>
                                                </th>
                                                <th>
                                                    <center>2ชั่วโมง</center>
                                                </th>
                                                <th>
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100" 
                                                style="width: 33%;">33%</div>
                                                    </div>
                                                </th>
                                                <th>
                                                    <center>
                                                        <a href="">
                                                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                                        </a>
                                                    </center>
                                                </th>
                                            </tr>

                                            <tr>
                                                <th>1204</th>
                                                <th>การจัดปฐมนิเทศให้กับพนักงานใหม่ภายใน 3 วันทำการ</th>
                                                <th>
                                                    <center>100%</center>
                                                </th>
                                                <th>
                                                    <center>35%</center>
                                                </th>
                                                <th>
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100" 
                                                style="width: 35%;">35%</div>
                                                    </div>
                                                </th>
                                                <th>
                                                    <center>
                                                        <a href="">
                                                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                                        </a>
                                                    </center>
                                                </th>

                                            </tr>

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