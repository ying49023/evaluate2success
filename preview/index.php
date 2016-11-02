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
            <?php include ('./classes/connection_mysqli.php');?>
        <?php
        
        $get_department_id = '';
        if (isset($_GET["department_id"])) {
            $get_department_id = $_GET["department_id"];
        }
        $get_job_id = '';
        if (isset($_GET["job_id"])) {
            $get_job_id = $_GET["job_id"];
        }
        $get_time_period = '1';
        if (isset($_GET["time_period"])) {
            $get_time_period = $_GET["time_period"];
        }
        //$eval = ' eval_code = 3';
        $get_eval_code = '';
        //if(isset($_GET["eval_code"])){
            //$get_eval_code = $_GET["eval_code"];
            //$eval = " eval.evaluation_code = '".$get_eval_code ."'";
        //}
        
        $get_year = date("Y");
        if(isset($_GET["year"])){
            $get_year = $_GET["year"];

        }
        
        $condition_kpi_list = "WHERE year = '$get_year' ";
        $get_sql_per = "SELECT ROUND(AVG(performance_mile),2) as performance_mile,MONTH(NOW()) as current_month
                        FROM kpi_progress kp JOIN kpi_responsible kr ON kp.kpi_responsible_id = kr.kpi_responsible_id
                        JOIN kpi k ON kr.kpi_id = k.kpi_id 
                        WHERE MONTH(progress_time_update) = MONTH(NOW()) AND year= '$get_year'  ";
        if ($get_department_id != '' && $get_job_id != '' && $get_time_period != '' && $get_year != '') {
            $condition_kpi_list = " WHERE department_id = '$get_department_id' AND job_id = '$get_job_id' AND time_period = '$get_time_period' AND year = '$get_year' ";
            $get_sql_per = "SELECT ROUND(AVG(performance_mile),2) as performance_mile, MONTH(NOW()) as current_month
                            FROM kpi_progress kp 
                            JOIN kpi_responsible kr ON kp.kpi_responsible_id = kr.kpi_responsible_id
                            JOIN kpi k ON kr.kpi_id = k.kpi_id 
                            JOIN kpi_group kg ON k.kpi_group_id = kg.kpi_group_id
                            WHERE MONTH(progress_time_update) = MONTH(NOW()) AND year='$get_year' AND department_id ='$get_department_id' ";
            
        } else if ($get_department_id != '' && $get_job_id != '') {
            $condition_kpi_list = " WHERE  department_id = '$get_department_id' AND e.job_id = '$get_job_id' AND time_period = '$get_time_period' AND year = '$get_year' ";
            $get_sql_per = "SELECT ROUND(AVG(performance_mile),2) as performance_mile, MONTH(NOW()) as current_month
                            FROM kpi_progress kp 
                            JOIN kpi_responsible kr ON kp.kpi_responsible_id = kr.kpi_responsible_id
                            JOIN kpi k ON kr.kpi_id = k.kpi_id 
                            JOIN kpi_group kg ON k.kpi_group_id = kg.kpi_group_id
                            WHERE MONTH(progress_time_update) = MONTH(NOW()) AND year='$get_year' AND department_id ='$get_department_id' ";
            
        }else if($get_job_id != '' ){
            $condition_kpi_list = " WHERE  job_id = '$get_job_id' AND department_id = '$get_department_id' AND time_period = '$get_time_period' AND year = '$get_year' ";
        }else if($get_department_id != ''){
            $condition_kpi_list = " WHERE department_id = '$get_department_id'  AND time_period = '$get_time_period' AND year = '$get_year' ";
            $get_sql_per = "SELECT ROUND(AVG(performance_mile),2) as performance_mile, MONTH(NOW()) as current_month
                            FROM kpi_progress kp 
                            JOIN kpi_responsible kr ON kp.kpi_responsible_id = kr.kpi_responsible_id
                            JOIN kpi k ON kr.kpi_id = k.kpi_id 
                            JOIN kpi_group kg ON k.kpi_group_id = kg.kpi_group_id
                            WHERE MONTH(progress_time_update) = MONTH(NOW()) AND year='$get_year' AND department_id ='$get_department_id' ";
            
        }else if($get_time_period != '' ){
            $condition_kpi_list = " WHERE  year = '$get_year' and time_period = '$get_time_period' ";
        }else if($get_time_period != '' && $get_year != ''){
            $condition_kpi_list = " WHERE  year = '$get_year' and time_period = '$get_time_period' ";
        }
?>
            <!--ListJS-->
        <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.2.0/list.min.js"></script>
        <script>
            function getJobs(val) {
                $.ajax({
                    type: "POST",
                    url: "./hr/get_jobs.php",
                    data:'department_id='+val,
                    success: function(data){
                        $("#list").html(data);
                        $("#list2").html(data);
                        $("#list3").html(data);
                    }
                });
            }
        </script>
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
                    ดูภาพรวม
                    <small>แดชบอร์ด</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="#"> <i class="fa fa-dashboard"></i>
                            Home
                        </a>
                    </li>
                    <li class="active">Dashboard</li>
                </ol>
            </section>
            <!--/Page header -->

            <!-- Main content -->
            
            <!-- Search -->
            <div class="row box-padding">
                <div class="box box-success">
                    <div class="box-header ">
                        <form method="get">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class=" control-label">รอบ</label>
                                    <div class="">
                                                <?php
                                                $sql_eval = "SELECT * FROM evaluation ORDER BY year , term_id ASC";
                                                $query_eval = mysqli_query($conn, $sql_eval);
                                                ?>
                                        <select class="form-control input-small" name="year" required>

                                                    <?php while ($result_eval = mysqli_fetch_array($query_eval, MYSQLI_ASSOC)) { ?>
                                            <option value="<?php echo $result_eval["year"]; ?>"<?php if ($get_year == $result_eval["year"]) {
                                                echo "selected"; } ?> >
                                                    <?php echo 'ปี ' . $result_eval["year"] . " - ครั้งที่" . $result_eval["term_id"]; ?>

                                            </option>

                                                    <?php } ?>
                                        </select>

                                    </div>
                                </div>

                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class=" control-label">ระยะเวลา</label>
                                    <div class="">
                                        <select class="form-control" name="time_period" required="">
                                            <option value="">เลือกระยะเวลา</option>
                                            <option value='1' <?php if($get_time_period == 1) { echo "selected"; }  ?> >
                                                1 เดือน
                                            </option>
                                            <option value='2' <?php if($get_time_period == 2) { echo "selected"; }  ?> >
                                                2 เดือน
                                            </option>
                                            <option value='3' <?php if($get_time_period == 3) { echo "selected"; }  ?> >
                                                3 เดือน
                                            </option>
                                            <option value='6' <?php if($get_time_period == 6) { echo "selected"; }  ?> >
                                                6 เดือน
                                            </option>
                                            <option value='12' <?php if($get_time_period == 12) { echo "selected"; }  ?> >
                                                12 เดือน
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class=" control-label">แผนก/ฝ่าย</label>
                                    <div class="">
                                    <?php 
                                        $sql_department = "SELECT * FROM departments ";
                                        $query_department = mysqli_query($conn, $sql_department);
                                    ?>
                                        <select class="form-control" name="department_id" onchange="getJobs(this.value);">
                                            <option value="">เลือกทั้งหมด</option>
                                        <?php while($result_department = mysqli_fetch_array($query_department,MYSQLI_ASSOC)) { ?>
                                            <option value="<?php echo $result_department["department_id"]; ?>" <?php if($get_department_id == $result_department["department_id"]) { echo "selected"; }  ?> >
                                                <?php echo $result_department["department_name"]; ?>
                                            </option>
                                        <?php } ?>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-3">
                                <div class="form-group" >
                                <label class=" control-label">ตำแหน่ง</label>
                                <div class="">
                                <?php 
                                    $sql_job = "SELECT distinct(job_name), job_id FROM jobs ";
                                    $query_job = mysqli_query($conn, $sql_job);
                                ?>
                                    <select class="form-control" name="job_id" id="list">
                                        <option value="">เลือกตำแหน่ง</option>
                                    </select>
                                </div>
                                </div>
                            </div>

                            <div class="pull-right">
                                <button type="submit" class="btn btn-primary search-button " style="width: 100px;" ><i class="glyphicon glyphicon-search"></i>&nbsp;&nbsp;ค้นหา</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <!--/Search -->
            <div class="row box-padding">
                <!-- AREA CHART -->
                <div class="col-lg-8">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">KPI ภาพรวม (ราย <?php echo $get_time_period; ?> เดือน)</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="chart">
                                <canvas id="areaChart" style="height:250px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /AREA CHART -->

                <!-- Mile pedformance -->
                <div class="col-lg-4">
                    <div class="box box-primary">
                        <div >
                    
                        <div class="box-header with-border">
                            <h4>ความสำเร็จของ KPIs ทั้งหมด  </h4>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"> 
                                    <i class="fa fa-minus"></i>
                                </button>   
                            </div>
                        </div>
                        <div class="box-body text-center">
                            <div id="score"  style="height:235px;min-width: 255px;">
                            <?php
                            $sql_per = $get_sql_per;
                            $query_per = mysqli_query($conn, $sql_per);
                            $result_per = mysqli_fetch_array($query_per);
                            $current_month = $result_per["current_month"];
                            if($result_per["performance_mile"] == ''){
                            ?>
                                <h3 class="text-middle text-center">ยังไม่มีข้อมูล</h3>
                            <?php 

                            }else{

                            ?> 
                                <script>
                                    document.addEventListener("DOMContentLoaded", function(event) {
                                        var score = new JustGage({
                                            id: "score",
                                            //value: getRandomInt(0, 100),
                                            value : <?php echo $result_per["performance_mile"]; ?>,
                                            min: 0,
                                            max: 100,
                                            title: "ประจำเดือนเดือน: <?php echo $current_month; ?>",
                                            label: "%",
                                            levelColorsGradient: true
                                        });
                                    });
                                </script>
                            <?php 
                            }
                            ?>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <!-- /Mile pedformance -->

            </div>
            
            <!-- KPI list -->
            <div class="row box-padding">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h4>KPIs ทั้งหมด ราย : <?php echo $get_time_period; ?> เดือน</h4>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="80px" >ID</th>
                                <th>ชื่อ KPIs</th>
                                <th width="90px">เป้าหมาย</th>
                                <th width="90px">ทำจริง</th>
                                <th width="150px">ประสิทธิภาพ</th>
                                <th width="60" style="text-align:center">%</th>
                            </tr>
                        </thead>
                        <?php
                        $sql_kpi = "SELECT kpi_code, kpi_name, CONCAT(k.default_target,' ',k.unit) as target, CONCAT(ROUND(AVG(success),2),' ',k.unit) as actual, time_period
                            FROM kpi k JOIN kpi_group kg ON k.kpi_group_id = kg.kpi_group_id 
                            JOIN kpi_responsible kr ON kr.kpi_id = k.kpi_id 
                            $condition_kpi_list
                            GROUP BY k.kpi_id
                            ORDER BY k.kpi_id";
                        $query_kpi = mysqli_query($conn, $sql_kpi);
                        $count_kpi = mysqli_num_rows($query_kpi);

                        if($count_kpi == 0){ ?>
                        <tr class="text-center bg-gray">
                            <td colspan="6"><i>ไม่มีข้อมูลสำหรับ KPI ระยะเวลา <?php echo $get_time_period; ?> เดือน</i></td>
                        </tr>
                        <?php }else{
                        foreach($query_kpi as $result_kpi){
                            $percent_completed = ($result_kpi["actual"]/$result_kpi["target"])*100 ;
                        ?>
                        <tr>
                            <td><?php echo $result_kpi["kpi_code"]; ?></td>
                            <td><?php echo $result_kpi["kpi_name"]; ?></td>
                            <td><?php echo $result_kpi["target"]; ?></td>
                            <td><?php echo $result_kpi["actual"]; ?></td>
                            <td>
                                <div class="progress progress-xs progress-striped active">
                                  <div class="progress-bar <?php if($percent_completed <= 40){ echo 'progress-bar-danger' ; }else if($percent_completed >40 && $percent_completed <=50){ echo 'progress-bar-warining' ;}else if($percent_completed >50 && $percent_completed <=75){ echo 'progress-bar-info' ;}else if($percent_completed > 75){ echo 'progress-bar-success' ;}  ?>" style="width:<?php echo (int)$percent_completed ; ?>%"></div>
                                </div>
                            </td>
                            <td>
                                <span class="badge <?php if($percent_completed ==0){ echo ''; }else if($percent_completed <= 40){ echo 'bg-red' ; }else if($percent_completed >40 && $percent_completed <=50){ echo 'bg-blue' ;}else if($percent_completed >50 && $percent_completed <=75){ echo 'bg-light-blue' ;}else if($percent_completed > 75){ echo 'bg-green' ;}  ?>" style="width:<?php echo (int)$percent_completed ; ?>">
                                    <?php if($percent_completed ==0){ echo 'N/A' ; } else{ echo (int)$percent_completed."%" ; } ?><?php  ?>
                                </span>
                            </td>
                        </tr>
                        <?php }
                        }
                        ?>

                        </table>
                    </div>
                </div>
            </div>
            <!-- /KPI list -->
            
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
    <!-- jQuery 2.2.0 -->
<script src="./plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="./plugins/chartjs/Chart.min.js"></script>

<!-- page script -->
<?php
 $sql_kpi_overveiw = "SELECT ROUND(AVG(performance_mile),2) as score ,round_update, month_update
                        FROM kpi_progress kp JOIN kpi_responsible kr ON kp.kpi_responsible_id = kr.kpi_responsible_id
                        JOIN kpi k ON kr.kpi_id = k.kpi_id JOIN kpi_group kg ON k.kpi_group_id = kg.kpi_group_id
                        $condition_kpi_list AND round_update != ''
                        GROUP BY month_update
                        ORDER BY kpi_progress_id;";
//e.evaluation_code=$get_eval_code;//

 $query_kpi_overview = mysqli_query($conn, $sql_kpi_overveiw);
 $array_month[]=array();
 $array_value[]=array();
 $count=0;
 while($result_kpi_overview = mysqli_fetch_assoc($query_kpi_overview)){
    $array_month[$count]=$result_kpi_overview['round_update'];
    $array_value[$count]=$result_kpi_overview['score'];
    // echo  $array_value[$count];
    $count++;
   
 }
 echo $count;
?>
    <script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
    // This will get the first returned node in the jQuery collection.
    var areaChart = new Chart(areaChartCanvas);

    var areaChartData = {
      labels: [<?php  
                for($i=0;$i<$count;$i++){
                     if($i<$count-1)
                        echo  " '".$array_month[$i]."' ,";
                     else
                        echo  "'".$array_month[$i]."'";
                } ;
                ?>],
      datasets: [
        {
          label: "Electronics",
          fillColor: "rgba(210, 214, 222, 1)",
          strokeColor: "rgba(210, 214, 222, 1)",
          pointColor: "rgba(210, 214, 222, 1)",
          pointStrokeColor: "#c1c7d1",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(220,220,220,1)",
          data: [<?php  
                for($i=0;$i<$count;$i++){
                        echo  "100".",";

                } ;
                ?>]
        },
        {
          label: "Digital Goods",
          fillColor: "rgba(60,141,188,0.9)",
          strokeColor: "rgba(60,141,188,0.8)",
          pointColor: "#3b8bba",
          pointStrokeColor: "rgba(60,141,188,1)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(60,141,188,1)",
          
        data: [<?php  
                for($i=0;$i<$count;$i++){
                     if($i<$count-1)
                     echo  $array_value[$i].',';
                     else
                         echo  $array_value[$i];
                } ;
                ?>]
        }
      ]
    };

    var areaChartOptions = {
      //Boolean - If we should show the scale at all
      showScale: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: false,
      //String - Colour of the grid lines
      scaleGridLineColor: "rgba(0,0,0,.05)",
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - Whether the line is curved between points
      bezierCurve: true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension: 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot: false,
      //Number - Radius of each point dot in pixels
      pointDotRadius: 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth: 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius: 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke: true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth: 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill: true,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio: true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive: true
    };

    //Create the line chart
    areaChart.Line(areaChartData, areaChartOptions);
    

    
  });
</script>

</body>
<!-- SCRIPT PACKS -->
<?php include('./script_packs.html') ?>

</html>
<?php
        }
    }
?>