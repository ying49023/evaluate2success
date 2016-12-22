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
            // Include คลาส class.upload.php เข้ามา เพื่อจัดการรูปภาพ
            require_once('./classes/class.upload.php') ;
            
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
                        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="" onclick="goBack()">Create/edit evaluation</a></li>
                        <li class="active">Section 1</li>
                    </ol>
                </section>
                <!--/Page header -->

                <!-- Main content -->
                <!--search-->
                <div class="row box-padding">
                    <!-- search -->
                    <div class="box box-success">
                        <div class="box-body">
                            <?php 
                            $eval_code = '';
                            if(isset($_GET["eval_code"])){
                                $eval_code = $_GET["eval_code"];
                            }
                            
                            $sql_year_term = "SELECT * FROM evaluation e JOIN term t ON e.term_id=t.term_id WHERE evaluation_code = '".$eval_code."'";
                            $query_year_term = mysqli_query($conn, $sql_year_term);
                            while($result_year_term = mysqli_fetch_array($query_year_term, MYSQLI_ASSOC)){
                                echo "<span style='font-size:18px'><b>ปีการประเมิน ".$year = $result_year_term["year"]."</b></span> | ";
                                echo "<span style='font-size:18px'>รอบการประเมินที่ ".$term = $result_year_term["term_name"]." : ".$result_year_term["start_month"]."-".$result_year_term["end_month"]."</span>";
                            }
                            ?>
                        </div>
                    </div>
                    <!--/search -->
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
                                                    ผลการปฏิบัติงานที่เกิดขึ้นจริง (Actual Performance)
                                                </th>
                                                <th colspan="3" class="text-center">ครั้งที่ ?  มกราคม -มิถุนายน </th>
                                            </tr>
                                            <tr> 
                                                        
                                                <th style="width: 80px;vertical-align: middle;text-align: center;">น้ำหนักรวม</th>
                                                <th style="vertical-align: middle;">คะแนน</th>
                                                <th style="vertical-align: middle;">คะแนนรวม(น้ำหนัก X คะแนน) </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr> 
                                                <td>(ชื่อ KPI) และ เป้าหมาย</td>
                                                <td>(ผลงานจริง)</td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                            </tr>
                                            <tr> 
                                                <td>(ชื่อ KPI) และ เป้าหมาย</td>
                                                <td>(ผลงานจริง)</td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                            </tr>
                                            <tr> 
                                                <td>(ชื่อ KPI) และ เป้าหมาย</td>
                                                <td>(ผลงานจริง)</td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                            </tr>

                                            <tr class="bg-gray-active"> 
                                                <th rowspan="1" colspan="2" class="text-right" >รวม</th>
        
                                                <th  class="text-center"></th>

                                                <th rowspan="1"></th>
                                               
                                                
                                                
                                                <th  class="text-center"></th>
                                            </tr>
                                            
                                            <tr>
                                                <th colspan="4"></th>
                                                <th class="text-center bg-light-blue-active"><b>(คะแนนรวม)</b></th>

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
