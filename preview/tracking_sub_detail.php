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
                            
                            <table class="table table-bordered table-condensed" width="90%" height="100px" align="right" >
                                <tr>
                                    <th rowspan="2">
                                        <img class="img-circle img-thumbnail circle-thumbnail" src="img/emp1.jpg" alt="Smiley face" style="margin:10px 0px 0px 15px;">
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
                                <center>123456</center>
                                </td>
                                <td>
                                <center>นาย ศตวรรษ วินวิวัฒน์</center>
                                </td>
                                <td>
                                <center>พนักงานฝ่ายบุคคล</center>
                                </td>
                                <td>
                                <center>ฝ่ายบุคคล</center>
                                </td>
                                <th>
                                <center>>=80%</center>
                                </th>
                                <th>
                                <center>35.5%</center>
                                </th>
                                <th>
                                <center></center>
                                </th>
                                </tr>
                            </table>
                        </div>
                        
                    </div>
                </div>
                <div class="row box-padding">
                    <div class="box box-primary ">
                        <div class="box-header with-border">
                            <strong>KPI 1201 -ความสามารถในการสรรหาคนได้ตามเวลาที่กำหนด</strong> - <small>ข้อมูลความก้าวหน้าของงาน</small>
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
                <div class="row box-padding">
                    <div class="box box-default">
                        <div class="box-header">
                            <p class="text-center">
                                <strong>ประวัติการอัพเดต KPIs</strong>
                            </p>
                        </div>  
                        <form method="get" action="compareevaluation.php" >
                            <div class="box-body box-padding-table"> 
                                
                                <table class="table table-striped">
                                    <tr class="bg-gray-light">
                                        <td class="text-center">ลำดับ</td>
                                        <td class="text-center">วันที่</td>
                                        <td class="text-center">KPIs</td>
                                        <td class="text-center">เป้าหมาย</td>
                                        <td class="text-center">ค่าจริง</td>
                                        <td class="text-center">อัพเดท</td>
                                        <td class="text-center">คำอธิบาย</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td class="text-center">30 ม.ค. 59</td>
                                        <td class="text-center">2001</td>
                                        <td class="text-center">10 คน</td>
                                        <td class="text-center">1 คน</td>
                                        <td class="text-center">1 คน</td>
                                        <td class="text-center"> </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">2</td>
                                        <td class="text-center">30 ก.พ. 59</td>
                                        <td class="text-center">2001</td>
                                        <td class="text-center">10 คน</td>
                                        <td class="text-center">2 คน</td>
                                        <td class="text-center">1 คน</td>
                                        <td class="text-center"> </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">3</td>
                                        <td class="text-center">30 มี.ค. 59</td>
                                        <td class="text-center">2001</td>
                                        <td class="text-center">10 คน</td>
                                        <td class="text-center">4 คน</td>
                                        <td class="text-center">2 คน</td>
                                        <td class="text-center"> </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">4</td>
                                        <td class="text-center">30 เม.ย. 59</td>
                                        <td class="text-center">2001</td>
                                        <td class="text-center">10 คน</td>
                                        <td class="text-center">5 คน</td>
                                        <td class="text-center">1 คน</td>
                                        <td class="text-center"> </td>
                                    </tr>
                                    <tr >
                                        
                                        <td class="text-center">5</td>
                                        <td class="text-center">30 พ.ค. 59</td>
                                        <td class="text-center">2001</td>
                                        <td class="text-center">10 คน</td>
                                        <td class="text-center">6 คน</td>
                                        <td class="text-center">1 คน</td>
                                        <td class="text-center"> </td>
                                    </tr>
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
