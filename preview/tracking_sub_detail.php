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
                        รายละเอียด KPI - <?php echo $get_kpi_id; ?>
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="#"> <i class="fa fa-dashboard"></i>
                                Home
                            </a>
                        </li>
                        <li><a href="tracking_sub_list.php">Tracking</a></li>
                        <li><a href="" onclick="goBack()">KPIs Tracking</a></li>
                        <li class="active">KPI</li>
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

                    $sql_year_term = "SELECT * FROM evaluation e JOIN term t ON e.term_id=t.term_id WHERE evaluation_code = '".$my_eval_code."'";
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
                <td><?php echo $result_emp["manager_name_1"]; ?></td>
                <td><?php echo $result_emp["manager_name_2"]; ?></td>
                <td>
                    <?php 
                    $sql_eval_period = "SELECT * FROM evaluation WHERE evaluation_code = '".$my_eval_code."' ";
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
                    <div class="box box-primary ">
                        <?php
                            $sql_kpi_title ="SELECT
                                                    k.*,kr.*
                                            FROM
                                                    kpi k
                                            JOIN kpi_responsible kr ON k.kpi_id = kr.kpi_id
                                            JOIN evaluation_employee ee ON kr.evaluate_employee_id = ee.evaluate_employee_id
                                            JOIN evaluation e ON ee.evaluation_code = e.evaluation_code
                                            JOIN employees em ON em.employee_id = ee.employee_id
                                            WHERE
                                                    k.kpi_code = '$get_kpi_id'
                                            AND e.evaluation_code = $my_eval_code AND ee.employee_id =$get_emp_id";
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
                            <h4><?php echo $kpi_id;?> -<?php echo $kpi_name;?> - <small>ข้อมูลความก้าวหน้าของงาน</small></h4>
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
                            SELECT kp.kpi_comment,k.kpi_name, kp.kpi_progress_update, kp.progress_time_update,k.kpi_code as kpi_id,ks.goal,k.measure_symbol as symbol,kp.round_update
                            FROM kpi_progress kp JOIN kpi_responsible ks ON kp.kpi_responsible_id = ks.kpi_responsible_id 
                            JOIN kpi k ON ks.kpi_id = k.kpi_id
                            JOIN evaluation_employee ee ON ks.evaluate_employee_id = ee.evaluate_employee_id 
                            JOIN evaluation e ON ee.evaluation_code = e.evaluation_code
                            WHERE ee.employee_id = $get_emp_id  AND
                            e.evaluation_code=$my_eval_code AND k.kpi_code='$get_kpi_id' order by month_update";
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
                                        $progress_time_update = $result_kpi_history["round_update"];
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
        <!-- Google Chart Script-->
        <?php
                $show_date ="SELECT kp.progress_time_update as date_show,kp.kpi_progress_update as success,ks.goal ,kp.round_update                           
                            FROM kpi_progress kp JOIN kpi_responsible ks ON kp.kpi_responsible_id = ks.kpi_responsible_id                             
                            JOIN kpi k ON ks.kpi_id = k.kpi_id
                            JOIN evaluation_employee ee ON ks.evaluate_employee_id = ee.evaluate_employee_id 
                            JOIN evaluation e ON ee.evaluation_code = e.evaluation_code
                            WHERE ee.employee_id = $get_emp_id  AND
                            e.evaluation_code=$my_eval_code AND k.kpi_code='$get_kpi_id' and e.company_id=1 order by month_update";
                $query_show_date = mysqli_query($conn, $show_date);
                $array_date[] = array();
                $array_goal[] = array();
                $array_success[] = array();
                $i=0;
                
             
                
            ?>
        <?php
                $sql_kpi_responsible_id = "select kr.kpi_responsible_id 
                                            from kpi k 
                                            JOIN kpi_responsible kr 
                                            ON k.kpi_id=kr.kpi_id
                                            JOIN evaluation_employee ev
                                            ON ev.evaluate_employee_id = kr.evaluate_employee_id
                                            JOIN employees e ON e.employee_id=ev.employee_id
                                            where kpi_code='$get_kpi_id' AND e.employee_id=$get_emp_id and ev.evaluation_code=$my_eval_code";
                
                $query_kpi_responsible_id = mysqli_query($conn,$sql_kpi_responsible_id);

                while ($result_kpi_responsible_id = mysqli_fetch_array($query_kpi_responsible_id, MYSQLI_ASSOC)) {

                    $kpi_responsible_id = $result_kpi_responsible_id["kpi_responsible_id"];
                    $sql_progess = "call getCurrentKPIPerformance($kpi_responsible_id) ";
                    $query_progess = mysqli_query($conn, $sql_progess);
                }
                ?> 
        <script>
            google.charts.load('current', {'packages':['gauge','corechart']});
            
            google.charts.setOnLoadCallback(drawChart);
            
            function drawChart() {
                
                var data = google.visualization.arrayToDataTable([
                    ['Label', 'Value'],
                    <?php while($result_progess = mysqli_fetch_assoc($query_progess)){
                    ?>
                    ['Performance', <?php if($result_progess!=''){echo $result_progess['performance_mile'];}else{ echo 0;} ?>],
                    <?php } ?>     
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
                     <?php 
                     while($result_show_date=  mysqli_fetch_array($query_show_date)){
                   // $array_date[$i] =date("F",strtotime($result_show_date['date_show']));
                    $array_date[$i]=iconv_substr($result_show_date['round_update'],8,25,"UTF-8");
                    $array_goal[$i] =$result_show_date['goal'];
                    $array_success[$i] =$result_show_date['success'];    
                    
                                 
                     ?>          
                    ['<?php echo $array_date[$i]; ?>',<?php echo $array_success[$i];?>,'gold'],
                        <?php $i++; } ?>
                ]);
                
                
                var options2 = {
                    title: '<?php echo $kpi_id;?> - <?php echo $kpi_name ?>',
                    legend: 'none',
                    bar: {groupWidth: '70%'},
                    vAxis: { gridlines: { count: 5 } }
                };
                
                var chart = new google.visualization.ColumnChart(document.getElementById('number_format_chart'));
                chart.draw(data2, options2);
            };
            
        </script>
     
        
    </body>
</html>
<?php
        }
    }
?>
