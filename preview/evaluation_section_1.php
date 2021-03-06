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
        <?php 
        include ('./classes/connection_mysqli.php');
     
         $eval_code = '';
            if (isset($_SESSION["eval_code"])) {
                $eval_code = $_SESSION["eval_code"];
            }
        ?>
        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>แก้ไขข้อมูลพนักงาน : ALT Evaluation</title>
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
                        ส่วนที่ 1 : KPIs
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Edit profile</li>
                    </ol>
                </section>
                <!--/Page header -->

                <!-- Main content -->
                <!--search-->
                <div class="row box-padding">
                    <!-- Brief Info Profile Employee  -->
                    <?php include './breif_info_profile_eval.php'; ?>
                    <!-- /Brief Info Profile Employee  -->
                    
                    <!-- Navbar process -->
                    <?php include './navbar_process.php'; ?>
                    <!-- /Navbar process -->
                    
                    <!-- Part 1 -->
                    <div class="box box-primary ">
                        <div class="box-header with-border">
                            <h4><i class="glyphicon glyphicon-info-sign"></i> &nbsp; ส่วนที่ 1  :   การประเมินด้านผลงาน (คะแนนเต็ม 60 )</h4>
                        </div>
                        <div class="box-body">
                            <div class="box-padding">
                                <div class="row">
                                    <h4 class="text-bold">สำหรับการประเมินผลครั้งที่: </h4>
                                    <h4></h4>
                                    <br>
                                    <table>
                                        <tr> 
                                            <th>ผู้บังคับบัญชาและพนักงาน : </th>
                                        </tr>
                                        <tr>
                                            <th>1) กำหนดเต็มในส่วนที่ 1 (คะแนนเต็ม 60 )  </th>
                                        </tr>
                                        <tr>
                                            <th>2) กำหนดวัตถุประสงค์ / เป้าหมายที่กำหนดร่วมกันระหว่างผู้ประเมิน และผู้ถูกประเมิน</th>
                                        </tr>
                                        <tr>
                                            <th>3) การวัดผลงานควรอยู่ระหว่าง 4-7 ข้อ เท่านั้น เพื่อให้พนักงานใช้เป็นแนวทางและเป้าหมายในการปฏิบัติงาน</th>
                                        </tr>
                                    </table>
                                                
                                </div>  
                                <div class="row">
                                    <br>
                                    
                                    <table class="table table-bordered ">
                                        <thead class="bg-gray">
                                            <tr> 
                                                <th rowspan="2" style="vertical-align: middle;">
                                                    วัตถุประสงค์ / เป้าหมายที่กำหนดร่วมกันระหว่างผู้ประเมิน และผู้ถูกประเมิน (Performance Objectives / KPIs)
                                                </th>
                                                <th rowspan="2"  style="vertical-align: middle;">
                                                    เป้าหมาย (Goal)
                                                </th>
                                                <th rowspan="2"  style="vertical-align: middle;">
                                                    ผลการปฏิบัติงานที่เกิดขึ้นจริง (Actual Performance)
                                                </th>
                                                <th colspan="3" class="text-center">ครั้งที่ <?php echo $term ;  ?> <?php echo $start_month_name ; ?> -<?php echo $end_month_name; ;  ?> </th>
                                            </tr>
                                            <tr> 
                                                        
                                                <th style="width: 80px;vertical-align: middle;text-align: center;">น้ำหนักรวม</th>
                                                <th style="vertical-align: middle;">คะแนน</th>
                                                <th style="vertical-align: middle;">คะแนนรวม(น้ำหนัก X คะแนน) </th>
                                            </tr>
                                        </thead>
                                        <?php  
               
                                        $sql_kpi="SELECT k.kpi_code as kpi_id, k.kpi_name as kpi_name, kr.percent_weight as weight, kr.goal as goal, kr.success as success, e.term_id as term, e.year as year,k.measure_symbol as symbol,kr.percent_performance,kr.kpi_responsible_id
                                                    FROM kpi k JOIN kpi_responsible kr ON k.kpi_id=kr.kpi_id 
                                                    JOIN evaluation_employee ee ON ee.evaluate_employee_id = kr.evaluate_employee_id
                                                    JOIN evaluation e ON ee.evaluation_code = e.evaluation_code 
                                                    WHERE ee.evaluation_code='".$_SESSION['eval_code']."' and ee.employee_id = '".$_SESSION["emp_id"]."' ORDER BY kpi_id ";
                                        $query_kpi = mysqli_query($conn, $sql_kpi);
                                        $count_kpi = mysqli_num_rows($query_kpi);
                                        if($count_kpi == 0) {
                                            echo "<tr><td colspan='5' class='text-center'>ไม่มีข้อมูล KPIs</td></tr>";
                                        }else{
                                        ?>
                                        <tbody>
                                            <?php while($result_kpi = mysqli_fetch_assoc($query_kpi)) {
                
                                                $kpi_id = $result_kpi["kpi_id"];
                                                $kpi_name = $result_kpi["kpi_name"];
                                                $weight = $result_kpi["weight"];
                                                $goal = $result_kpi["goal"];
                                                $symbol = $result_kpi["symbol"];
                                                $success = $result_kpi["success"];
                                                $percent_performance = $result_kpi["percent_performance"];
                                                $term = $result_kpi["term"];
                                                $year = $result_kpi["year"];
                                                $kpi_responsible_id=$result_kpi["kpi_responsible_id"];

                                             ?>
                                
                                            <tr> 
                                                <td rowspan="1"><?php echo $kpi_name ;?></td>
                                                <td rowspan="1"><?php echo $symbol.''.$goal ;?></td>
                                                <td rowspan="1"><?php echo $success;?></td>
                                                <td class="text-center" rowspan="1"><?php echo $weight.'%';?></td>
                                                <td class="text-center" rowspan="1"><?php echo $percent_performance/10;?></td>
                                                <td class="text-center" rowspan="1"><?php echo $weight*($percent_performance/10);?></td>
                                                <?php  
                                                $sql_update_point_responsible="UPDATE kpi_responsible
                                                                    SET point_kpi_resp =($percent_performance/10)
                                                                    WHERE kpi_responsible_id=$kpi_responsible_id
                                                            ";
                                                $query_update_point_responsible = mysqli_query($conn, $sql_update_point_responsible);
                                                $sql_update_point="UPDATE kpi_responsible
                                                                    SET sum_point =($weight*($percent_performance/10))
                                                                    WHERE kpi_responsible_id=$kpi_responsible_id
                                                            ";
                                                $query_update_point = mysqli_query($conn, $sql_update_point);
                                                ?>
                                            </tr>
                                            <?php }?>
                                            
                                            <tr class="bg-gray-active"> 
                                                <th rowspan="1" colspan="3" class="text-right" >รวม</th>
                                                 <?php                                                 
               
                                                $sql_percent_weight="SELECT SUM(percent_weight) as sum_percent_weight
                                                                    FROM kpi_responsible
                                                                    WHERE evaluate_employee_id='".$_SESSION["eval_emp_id"]."' ";
                                                                    
                                                $query_percent_weight = mysqli_query($conn, $sql_percent_weight);
                                                while($result_percent_weight = mysqli_fetch_assoc($query_percent_weight)) {
                                                    $sum_percent_weight=$result_percent_weight ['sum_percent_weight'];
                                                 ?>           
                                                <th  class="text-center" rowspan="1"><?php echo $sum_percent_weight;?></th>
                                                <?php } ?>
                                                <?php                                                 
               
                                                $sql_sum_kpi="SELECT SUM(sum_point) as sum_point
                                                            FROM kpi_responsible
                                                            WHERE evaluate_employee_id='".$_SESSION["eval_emp_id"]."' ";
                                                $query_sum_kpi = mysqli_query($conn, $sql_sum_kpi);
                                                while($result_sum_kpi = mysqli_fetch_assoc($query_sum_kpi)) {
                                                    $sum_point=$result_sum_kpi['sum_point'];
                                                 ?>
                                                <th rowspan="1"></th>
                                               
                                                
                                                
                                                <th  class="text-center" rowspan="1"><?php echo $sum_point;?></th>
                                                    <?php } ?>
                                            </tr>
                                            
                                            <tr>
                                               <?php                                                 
                                                /* สูตรเขา
                                                 $sql_sum_kpi_total="UPDATE evaluation_employee 
                                                        SET point_kpi=(	  SELECT (SUM(sum_point)*60)/1000
                                                                                    FROM kpi_responsible
                                                                                    WHERE evaluate_employee_id='".$_SESSION["eval_emp_id"]."')
                                                        WHERE evaluate_employee_id='".$_SESSION["eval_emp_id"]."' ";
                                                 */
                                                $sql_sum_kpi_total="UPDATE evaluation_employee 
                                                        SET point_kpi=(	  SELECT (SUM(sum_point)/10)
                                                                                    FROM kpi_responsible
                                                                                    WHERE evaluate_employee_id='".$_SESSION["eval_emp_id"]."')
                                                        WHERE evaluate_employee_id='".$_SESSION["eval_emp_id"]."' ";
                                                $query_sum_kpi_total = mysqli_query($conn, $sql_sum_kpi_total);
                                                ?>
                                                <th colspan="5" class=""></th>
                                                <?php 
                                                $sql_point_kpi="select * from evaluation_employee WHERE evaluate_employee_id='".$_SESSION["eval_emp_id"]."' ";
                                                $query_point_kpi=  mysqli_query($conn, $sql_point_kpi);
                                                while($result_point_kpi = mysqli_fetch_assoc($query_point_kpi)) {
                                                    $point_kpi=$result_point_kpi['point_kpi'];
                                                 ?>
                                                <th class="text-center bg-light-blue-active"><b><?php echo $point_kpi;?></b></th>
                                                <?php } ?>
                                            </tr>
                                        </tbody>
                                        <?php } ?>        
                                    </table>
                                                
                                </div>  
                                            
                                <form action="evaluation_section_2.php" method="post">
                                    <div class="form-group box-padding-small text-center">
                                        <input type="hidden" name="position_level_id" value="<?php echo $_SESSION["position"]; ?>" >
                                        <button class="btn btn-success btn-lg" type="submit" id="btncheck" name="submit" ><i class="glyphicon glyphicon-play-circle"></i>&nbsp; หน้าถัดไป - ส่วนที่ 2 : Competency</button>
                                    </div>  
                                </form>                
                            </div>
                        </div>
                    </div>
                    <!-- /Part 1 -->
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
    <!-- SCRIPT PACKS -->
<?php include('./script_packs.html') ?>
</html>
            <?php
        }
    }

    
?>
