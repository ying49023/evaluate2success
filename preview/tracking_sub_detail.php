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
    $get_kpi_id ='';
    if(isset($_GET["kpi_id"])){
        $get_kpi_id  = $_GET["kpi_id"];
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
        
        <!-- Google Chart Script-->
        <script>
            google.charts.load('current', {'packages':['gauge','corechart']});
            
            google.charts.setOnLoadCallback(drawChart);
            
            function drawChart() {
                
                var data = google.visualization.arrayToDataTable([
                    ['Label', 'Value'],
                    ['Performance', 60],
                    
                ]);
                
                var options = {
                    width: 200, height: 200,
                    redFrom: 90, redTo: 100,
                    yellowFrom:75, yellowTo: 90,
                    minorTicks: 5
                };
                
                var chart = new google.visualization.Gauge(document.getElementById('chart_div'));
                
                chart.draw(data, options);
                
            }
            
            //Colume Chart
            google.charts.setOnLoadCallback(columnChart);
            function columnChart() {
                var data2 = google.visualization.arrayToDataTable([
                    ['Month', 'value', { role: 'style' }],
                    ['มกราคม', 1, '#b87333'],
                    ['กุมพาพันธ์', 2, 'silver'],            
                    ['มีนาคม', 4, 'gold'],
                    ['เมษายน', 5, 'color: #e5e4e2' ], 
                    ['พฤษภาคม', 6, 'color: orange' ],
                    ['มิถุนายน', 0, 'black' ],
                ]);
                
                
                var options2 = {
                    title: 'KPI 1201 -ความสามารถในการสรรหาคนได้ตามเวลาที่กำหนด',
                    legend: 'none',
                    bar: {groupWidth: '70%'},
                    vAxis: { gridlines: { count: 5 } }
                };
                
                var chart = new google.visualization.ColumnChart(document.getElementById('number_format_chart'));
                chart.draw(data2, options2);
            };
            
        </script>
        
    </head>
    <body class="hold-transition skin-blue sidebar-mini" >
        <div class="wrapper">
            <!--Header part-->
            <?php include './headerpart.php'; ?>
            <!-- Left side column. contains the logo and sidebar -->
            <?php include './sidebarpart.php'; ?>
            
            <!-- Content Wrapper. Contains page content แก้เนื้อหาแต่ละหน้าตรงนี้นะ -->
            <div class="content-wrapper" style="min-width: 980px;">
                
                <!-- Content Header (Page header)  -->
                <section class="content-header">
                    <h1>
                        รายละเอียด KPI -2001
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">summary evaluation</li>
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
                    <div class="box box-primary ">
                        <?php
                            $sql_kpi_title ="select * from kpi k JOIN kpi_responsible kr ON k.kpi_id=kr.kpi_id  where kpi_code='$get_kpi_id'";
                            $query_kpi = mysqli_query($conn, $sql_kpi_title);
                            
                        ?>
                        <div class="box-header with-border">
                             <?php while($result_kpi = mysqli_fetch_assoc($query_kpi)) {
                
                                $kpi_id = $result_kpi["kpi_code"];
                                $kpi_name = $result_kpi["kpi_name"];
                                $kpi_goal =$result_kpi["goal"];
                                $kpi_unit =$result_kpi["unit"];
                                $kpi_symbol =$result_kpi["measure_symbol"];
                                $kpi_resp_id =$result_kpi["kpi_responsible_id"];

                             ?>
                            <strong><?php echo $kpi_id;?> -<?php echo $kpi_name;?></strong> - <small>ข้อมูลความก้าวหน้าของงาน</small>
                             <?php } ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="box box-primary">
                                <div class="box-body">                                    
                                    <div id="chart_div" style="width: 200px; height: 200px;margin: auto;"></div>     
                                </div>
                            </div>
                        </div>
                        
                        <div class=" col-sm-9">
                            <div class="box box-primary">
                                <div class="box-body">    
                                    <div id="number_format_chart" width="100%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ประวัติการแก้ไข-->
                <div class="row box-padding">
                    <div class="box box-default">
                        <div class="box-header">
                            <p class="text-center">
                                <strong>ประวัติการอัพเดต KPIs</strong>
                            </p>
                        </div> 
                        
                        <?php 
                        $sql_kpi_history ="
                            SELECT kp.kpi_comment,k.kpi_name, kp.kpi_progress_update, kp.progress_time_update,k.kpi_code as kpi_id,ks.goal,k.measure_symbol as symbol
                            FROM kpi_progress kp JOIN kpi_responsible ks ON kp.kpi_responsible_id = ks.kpi_responsible_id 
                            JOIN kpi k ON ks.kpi_id = k.kpi_id
                            JOIN evaluation_employee ee ON ks.evaluate_employee_id = ee.evaluate_employee_id 
                            JOIN evaluation e ON ee.evaluation_code = e.evaluation_code
                            WHERE ee.employee_id = $get_emp_id  AND
                            e.term_id=1 AND e.year=2016 AND k.kpi_code='$get_kpi_id'";
                        $query_kpi_history = mysqli_query($conn,$sql_kpi_history);
                        $count=0;
                        ?>
                        <form method="get" action="compareevaluation.php" >
                            <div class="box-body box-padding-table "> 

                                <table class="table table-bordered table-hover">
                                    <tr class="bg-gray-light">
                                        <td class="text-center">ลำดับ</td>
                                        <td class="text-center">วันที่</td>
                                        <td class="text-center">KPIs</td>
                                        <td class="text-center">เป้าหมาย</td>
                                        <td class="text-center">ค่าจริง</td>                                        
                                        <td class="text-center">คำอธิบาย</td>
                                    </tr>
                                    <?php
                                        while($result_kpi_history = mysqli_fetch_assoc($query_kpi_history)) {
                
                                        $kpi_id = $result_kpi_history["kpi_id"];
                                        $kpi_name = $result_kpi_history["kpi_name"];                                        
                                        $goal = $result_kpi_history["goal"];
                                        $symbol = $result_kpi_history["symbol"];
                                        $comment = $result_kpi_history["kpi_comment"];
                                        $kpi_progress_update = $result_kpi_history["kpi_progress_update"];
                                        $progress_time_update = $result_kpi_history["progress_time_update"];
                                        $count++;
                                    ?>
                                    <tr>
                                        <td class="text-center"><?php echo $count;?></td>
                                        <td class="text-center"><?php echo $progress_time_update;?></td>
                                        <td class="text-center"><?php echo $kpi_id;?></td>
                                        <td class="text-center"><?php echo $symbol.''.$goal;?></td>
                                        <td class="text-center"><?php echo $kpi_progress_update;?></td>
                                        
                                        <td class="text-center"><?php echo $comment;?></td>
                                    </tr>
                                        <?php } ?>
                                </table>

                            </div>
                        </form>
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
</html>
<?php
        }
    }
?>
