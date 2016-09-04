<!DOCTYPE html>
<?php include ('./classes/connection_mysqli.php'); 
    
    if(isset($_GET["emp_id"])){
     $get_emp_id = $_GET["emp_id"]; //GET ค่ามาจากหน้า hr_kpi_individual.php ผ่านลิงค์ 
     }
     if(isset($_GET["kpi_id"])){
     $kpi_id = $_GET["kpi_id"]; //GET ค่ามาจากหน้า hr_kpi_individual.php ผ่านลิงค์ 
     }
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
                        <?php  while($result = mysqli_fetch_assoc($query)){ 
                                    $emp_id = $result["emp_id"];
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
                                                <img class=" img-responsive img-thumbnail img-lg"   src="hr/upload_images/<?php echo $picture;?>">
                                            </th>
                                            <th align="center" colspan="2" width="">ชื่อ-นามสกุล: </th>
                                            <td  colspan="2" width=""><?php echo $name;?></td>
                                            <th align="center" colspan="2" width="">รหัส: </th>
                                            <td  colspan="2" width=""><?php echo $emp_id;?> </td>

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
                <!-- Chart -->
                <div class="row box-padding">
                    <div class="box box-primary ">
                        <?php
                            $sql_kpi_title ="select * from kpi where kpi_code='$kpi_id'";
                            $query_kpi = mysqli_query($conn, $sql_kpi_title);
                            
                        ?>
                        <div class="box-header with-border">
                             <?php while($result_kpi = mysqli_fetch_assoc($query_kpi)) {
                
                                $kpi_id = $result_kpi["kpi_code"];
                                $kpi_name = $result_kpi["kpi_name"];
                                

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
                <!-- อัพเดท KPIs-->
                <div class="row box-padding">
                    <div class="box box-default">
                        <div class="box-header">
                            <p class="text-center">
                                <strong>อัพเดต KPIs</strong>
                            </p>
                        </div>  
                        <form method="get" action="update_kpi_detail.php" >
                            <div class="box-body box-padding-table"> 

                                <table class="table table-bordered ">
                                    <tr class="bg-gray-light">                                        
                                        <td class="text-center">No.</td>
                                        <td class="text-center">KPIs</td>
                                        <td class="text-center">เป้าหมาย</td>
                                        <td class="text-center">ค่าจริง</td>
                                        <td class="text-center">อัพเดท</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">2001</td>
                                        <td class="text-center">ความสามารถในการสรรหาตรงตามเวลาที่กำหนด(60วัน)</td>                                        
                                        <td class="text-center">10 คน</td>
                                        <td class="text-center">6 คน</td>
                                         <td class="text-center"><div class="form-group">
                                              <input type="text" class="input-md" id="upd" width="200px" >&nbsp;&nbsp;
                                              <button class="btn btn-primary btn-sm">อัพเดท</button>
                                        </div></td>
                                        
                                    </tr>
                                    
                                </table>

                            </div>
                        </form>
                    </div>
                </div>
                <!-- /Chart -->
                
                <!-- ประวัติการแก้ไข-->
                <div class="row box-padding">
                    <div class="box box-default">
                        <div class="box-header">
                            <p class="text-center">
                                <strong>ประวัติการอัพเดต KPIs</strong>
                            </p>
                        </div>  
                        <form method="get" action="compareevaluation.php" >
                            <div class="box-body box-padding-table "> 

                                <table class="table table-bordered table-hover">
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
