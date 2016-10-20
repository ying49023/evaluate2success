<?php
    //HR Admin
    session_start();
    //Check_login
    if($_SESSION["employee_id"]==''){
        echo "Please login again";
        echo "<a href='login.php'>Click Here to Login</a>";
        header("location:login.php");
    }else if($_SESSION["login_status"] != '1' ){
        echo "Login wrong level" ;
        header("location:../index.php");
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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ระบบประเมินผลปฏิบัติงาน : ALT Evaluation</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <!-- CSS PACKS -->
    <?php include ('./css_packs.html'); ?>
    <?php
    $get_eval_code = '3';
        if (isset($_GET["eval_code"])) {
            $get_eval_code = $_GET["eval_code"];
            $eval = " eval.evaluation_code = '" . $get_eval_code . "'";
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
                    <div class="box-body">
                        <form>
                            <div class="col-sm-4">
                                <label class="col-sm-4 control-label">รอบ</label>
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

                            <div class="col-md-3">
                                <label class="col-sm-4 control-label">แผนก</label>
                                <div class="col-sm-8">
                                    <?php
                                    $sql_department = "SELECT * FROM departments ";
                                    $query_department = mysqli_query($conn, $sql_department);
                                    ?>
                                    <select class="form-control">
                                        <option value="">เลือกทั้งหมด</option>
                                        <?php while ($result_department = mysqli_fetch_array($query_department, MYSQLI_ASSOC)) { ?>
                                            <option><?php echo $result_department["department_name"]; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <button class="btn btn-primary search-button" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="row box-padding">

                <div class="row">
                    <div class="col-md-8">

                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">ภาพรวมการทำงานย้อนหลัง</h3>
                                    
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
                    <div class="col-md-4">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <strong>KPIภาพรวมล่าสุด ประจำเดือน : กรกฎาคม</strong>
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
                                        value : 65,
                                        min: 0,
                                        max: 100,
                                        title: "กรกฎาคม",
                                        label: "%",
                                        levelColorsGradient: true
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
                <div class="box-header with-border">
                    <h4>KPIs ภาพรวมของบริษัท</h4>
                </div>
                <div class="box-body">
                    <table class="table table-bordered">
                    <?php
                        $sql_kpi_goal = "SELECT
                                                k.kpi_id As kpi_id,
                                                k.kpi_name As kpi_name,
                                                k.kpi_description As kpi_description,
                                                k.unit As unit ,
                                                sum(r.goal) AS goal_kpi,
                                                SUM(success) AS completed_kpi
                                        FROM
                                                kpi k
                                        JOIN kpi_responsible r ON k.kpi_id = r.kpi_id
                                        GROUP BY
                                                kpi_id";
                        $query_kpi_goal = mysqli_query($conn, $sql_kpi_goal);
                    ?>
                    <thead>
                        <tr>
                            <th width="80px" >ID</th>
                            <th>ชื่อKPIs</th>
                            <th width="90px">เป้าหมาย</th>
                            <th width="90px">ทำจริง</th>
                            <th width="200px">ประสิทธิภาพ</th>
                            <th width="60" style="text-align:center">%</th>
                        </tr>
                    </thead>
                    <?php while($result_kpi_goal = mysqli_fetch_array($query_kpi_goal, MYSQLI_ASSOC)) { 
                            $percent_completed = ($result_kpi_goal["completed_kpi"]/$result_kpi_goal["goal_kpi"])*100 ;
                        ?>
                    <tr>
                        <td><?php echo $result_kpi_goal["kpi_id"]; ?></td>
                        <td><?php echo $result_kpi_goal["kpi_name"]; ?></td>
                        <td><?php echo number_format($result_kpi_goal["goal_kpi"])." ".$result_kpi_goal["unit"]; ?></td>
                        <td><?php echo number_format($result_kpi_goal["completed_kpi"])." ".$result_kpi_goal["unit"] ; ?></td>
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
    <!-- jQuery 2.2.0 -->
    <script src="./plugins/jQuery/jQuery-2.2.0.min.js"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="./plugins/chartjs/Chart.min.js"></script>

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
<!-- SCRIPT PACKS -->
<?php include('./script_packs.html'); ?>
</html>
            <?php
        }
    }

    
?>