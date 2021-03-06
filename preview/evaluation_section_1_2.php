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
        
        if (isset($_GET["emp_id"])) {
            $get_emp_id = $_GET["emp_id"];
        }
        if (isset($_GET["eval_emp_id"])) {
            $get_eval_emp_id = $_GET["eval_emp_id"];
        }
        if (isset($_GET["eval_code"])) {
            $get_eval_code = $_GET["eval_code"];
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
                                    <?php  
                                        $sql_kpi_resp ="select * from kpi_responsible where evaluate_employee_id =$get_eval_emp_id";
                                        $query_kpi_resp = mysqli_query($conn, $sql_kpi_resp);
                                    
                                    ?>
                                    <table class="table table-bordered ">
                                        <thead class="bg-gray">
                                            <tr> 
                                                <th rowspan="2">
                                                    วัตถุประสงค์ / เป้าหมายที่กำหนดร่วมกันระหว่างผู้ประเมิน และผู้ถูกประเมิน (Performance Objectives / KPIs)
                                                </th>
                                                <th rowspan="2">
                                                    ผลการปฏิบัติงานที่เกิดขึ้นจริง (Actual Performance)
                                                </th>
                                                <th rowspan="1" colspan="3">ครั้งที่ 1 ม.ค. - มิ.ย. </th>
                                            </tr>
                                            <tr> 
                                                        
                                                <th rowspan="1">น้ำหนักรวม</th>
                                                <th rowspan="1">คะแนน</th>
                                                <th rowspan="1">คะแนนรวม(น้ำหนัก X คะแนน) </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            while($result_kpi_resp = mysqli_fetch_assoc($query_kpi_resp)) { 
                                            $kpi_resp =$result_kpi_resp['kpi_responsible_id'];
                                            
                                            $sql_kpi="call getPart1_kpi($kpi_resp)";                                            
                                            $query_kpi = mysqli_query($conn,$sql_kpi);
                                            echo $sql_kpi;
                                            while($result_kpi = mysqli_fetch_assoc($query_kpi)) {               
                                                
                                                $kpi_name = $result_kpi["kpi_name"];
                                                $weight = $result_kpi["percent_weight"];
                                                $goal = $result_kpi["goal"];
                                                $symbol = $result_kpi["measure_desc"];
                                                $success = $result_kpi["success"];
                                                $unit = $result_kpi["unit"];                                                
                                                $point_kpi_resp=$result_kpi["point_kpi_resp"];
                                                $kpi_sum_point=$result_kpi["sum_point"];

                                             ?>
                                
                                            <tr> 
                                                <td rowspan="1"><?php echo $kpi_name.' เป้าหมาย: '.$symbol.''.$goal ;?></td>
                                                <td rowspan="1"><?php echo $success;?></td>
                                                <td rowspan="1"><?php echo $weight.'%';?></td>
                                                <td rowspan="1"><?php echo $point_kpi_resp;?></td>
                                                <td rowspan="1"><?php echo $kpi_sum_point;?></td>                                              
                                            </tr>
                                     <?php }}?>
                                            
                                            <tr class="bg-gray-active"> 
                                                <th rowspan="1" colspan="2" class="text-right" >รวม</th>
                                                            
                                                <th rowspan="1">60</th>
                                                <?php                                                 
               
                                                $sql_sum_kpi="SELECT (SUM(sum_point)*60)/1000 as sum_point
                                                            FROM kpi_responsible
                                                            WHERE evaluate_employee_id=$get_eval_emp_id
                                                            ";
                                                $query_sum_kpi = mysqli_query($conn, $sql_sum_kpi);
                                                while($result_sum_kpi = mysqli_fetch_assoc($query_sum_kpi)) {
                                                    $sum_point=$result_sum_kpi["sum_point"];
                                                 ?>
                                                <th rowspan="1"></th>                                            
                                                 <th rowspan="1"><?php echo $sum_point*60;?></th>
                                                 <?php } ?>
                                            </tr>
                                            
                                            <tr>                                               
                                                <th colspan="4" class=""></th>
                                                <?php 
                                                $sql_point_kpi="select * from evaluation_employee WHERE evaluate_employee_id=$get_eval_emp_id";
                                                $query_point_kpi=  mysqli_query($conn, $sql_point_kpi);
                                                while($result_point_kpi = mysqli_fetch_assoc($query_point_kpi)) {
                                                    $point_kpi=$result_point_kpi["point_kpi"];
                                                 ?>
                                                <th colspan="1" class="bg-blue"><?php echo $point_kpi;?></th>
                                                <?php } ?>
                                            </tr>
                                        </tbody>
                                                    
                                    </table>
                                                
                                </div>  
                                            
                                            
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
