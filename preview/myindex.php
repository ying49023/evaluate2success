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
    
    <!-- SCRIPT PACKS -->
    <?php include('./script_packs.html') ?>
    <!-- SCRIPT PACKS -->
    <?php include('./script_packs.html') ?>
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
        $eval = ' eval_code = 3';
        $get_eval_code = '3';
        if(isset($_GET["eval_code"])){
            $get_eval_code = $_GET["eval_code"];
            $eval = " eval.evaluation_code = '".$get_eval_code ."'";
        }
        
        $condition = 'WHERE eval.evaluation_code = 3 ';
        if ($get_department_id != '' && $get_job_id != '' && $get_eval_code != '') {
            $condition = " WHERE e.department_id = '$get_department_id' AND e.job_id = '$get_job_id' AND eval.evaluation_code = '$get_eval_code' ";
        } else if ($get_department_id != '' && $get_job_id != '') {
            $condition = " WHERE  e.department_id = '$get_department_id' AND e.job_id = '$get_job_id' ";
        }else if($get_job_id != '' && $get_eval_code != ''){
            $condition = " WHERE  e.job_id = '$get_job_id' AND eval.evaluation_code = '$get_eval_code' ";
        }else if($get_department_id != '' && $get_eval_code != ''){
            $condition = " WHERE e.department_id = '$get_department_id' AND eval.evaluation_code = '$get_eval_code' ";
        }else if($get_department_id != '' || $get_job_id != '' || $get_eval_code != ''){
            if ($get_department_id != '') {
                $condition = " WHERE e.department_id = '" . $get_department_id . "' ";
            } else if ($get_job_id != '') {
                $condition = " WHERE e.job_id = '" . $get_job_id . "' ";
            }else if($get_eval_code != ''){
                $condition = " WHERE eval.evaluation_code = '$get_eval_code' ";
            }
        }else if($get_department_id == '' && $get_job_id == '' && $get_eval_code == ''){
            $condition = 'WHERE eval.evaluation_code = 3 ';
        }
?>
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
            <div class="row box-padding">
                <div class="box box-success">
                     <div class="box-body ">
                            <form method="get">
                                <div class="col-md-11">
                                    <label class="col-sm-2 control-label">รอบ</label>
                                    <div class="col-sm-8">
                                    <?php 
                                        $sql_eval = "SELECT * FROM evaluation ORDER BY year , term_id ASC";
                                        $query_eval = mysqli_query($conn, $sql_eval);
                                    ?>
                                        <select class="form-control" name="eval_code">
                                            <option value="">เลือกทั้งหมด</option>
                                        <?php while($result_eval = mysqli_fetch_array($query_eval,MYSQLI_ASSOC)) { ?>
                                            <option value="<?php echo $result_eval["evaluation_code"]; ?>" <?php if($get_eval_code == $result_eval["evaluation_code"]) { echo "selected"; }  ?> >
                                                <?php echo 'ปี '.$result_eval["year"]." - ครั้งที่".$result_eval["term_id"]; ?>
                                            </option>
                                        <?php } ?>
                                        </select>
                                    </div>
                                </div>                                
                                
                                <div class=" col-md-1">
                                    <input type="submit" class="btn btn-primary search-button " value="ค้นหา" >
                                </div>

                            </form>
                        </div>
                </div>
            </div>
            <div class="row box-padding">

                <div class="row">
                    <div class="col-md-8">
                        <!-- AREA CHART -->
                    <div class="box box-primary">
                      <div class="box-header with-border">
                        <h3 class="box-title">Area Chart</h3>

                        <div class="box-tools pull-right">
                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                          </button>
                          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                      </div>
                      <div class="box-body">
                        <div class="chart">
                          <canvas id="areaChart" style="height:250px"></canvas>
                        </div>
                      </div>
                      <!-- /.box-body -->
                    </div>

                    </div>
                    <div class="col-md-4">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <strong>KPIภาพรวม</strong>
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
                                    WHERE ee.employee_id=$my_emp_id  ) as mile_percent
                                    FROM kpi_responsible r
                                    JOIN evaluation_employee e ON e.evaluate_employee_id = r.evaluate_employee_id
                                    JOIN evaluation ev ON ev.evaluation_code = e.evaluation_code
                                    WHERE e.employee_id=$my_emp_id AND r.percent_performance IS NOT NULL  and ev.evaluation_code =$get_eval_code";
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
                                        value : <?php if($mile==''){  echo 0;}else{ echo $mile; }?>,
                                        min: 0,
                                        max: 100,
                                        title: "สถานะ KPIs",
                                        label: "%",
                                        levelColorsGradient: false
                                      });
                                  });
                                    </script>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <div class="row box-padding">
            <div class="box box-primary">
                <div class="box-body" >
                                <?php  
               
                                        $sql_kpi="SELECT k.unit,k.kpi_code as kpi_id, k.kpi_name as kpi_name, kr.percent_weight as weight, kr.goal as goal, kr.success as success, e.term_id as term, e.year as year,k.measure_symbol as symbol,kr.kpi_responsible_id,kr.percent_performance 
                                                    FROM kpi k JOIN kpi_responsible kr ON k.kpi_id=kr.kpi_id 
                                                    JOIN evaluation_employee ee ON ee.evaluate_employee_id = kr.evaluate_employee_id
                                                    JOIN evaluation e ON ee.evaluation_code = e.evaluation_code 
                                                    WHERE e.evaluation_code=$get_eval_code and ee.employee_id = '".$my_emp_id."' ORDER BY kpi_id ";
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
                                        

                                    </tr>
                                     <?php } ?>
                                  

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
        <!-- jQuery 2.2.0 -->
<script src="./plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="./bootstrap/js/bootstrap.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="./plugins/chartjs/Chart.min.js"></script>
<!-- FastClick -->
<script src="./plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="./dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="./dist/js/demo.js"></script>
<!-- page script -->
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
      labels: ["January", "February", "March", "April", "May", "June", "July"],
      datasets: [
        {
          label: "Electronics",
          fillColor: "rgba(210, 214, 222, 1)",
          strokeColor: "rgba(210, 214, 222, 1)",
          pointColor: "rgba(210, 214, 222, 1)",
          pointStrokeColor: "#c1c7d1",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(220,220,220,1)",
          data: [65, 59, 80, 81, 56, 55, 40]
        },
        {
          label: "Digital Goods",
          fillColor: "rgba(60,141,188,0.9)",
          strokeColor: "rgba(60,141,188,0.8)",
          pointColor: "#3b8bba",
          pointStrokeColor: "rgba(60,141,188,1)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(60,141,188,1)",
          data: [28, 48, 40, 19, 86, 27, 90]
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
</html>
<?php
        }
    }
?>