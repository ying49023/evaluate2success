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
                    <!-- search -->
                    <div class="box box-success">
                        <div class="box-body">
                            <?php 
                            $eval_code = '';
                            if(isset($_GET["eval_code"])){
                                $eval_code = $_GET["eval_code"];
                            }
                            
                            $sql_year_term = "SELECT * FROM evaluation e JOIN term t ON e.term_id=t.term_id WHERE evaluation_code = '$eval_code'";
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
                    
                    <!-- Employee Profile -->
                    <div class="box box-primary" >
                    <div class="box-body">
                        <div class="row"> 
                            <div class="box-padding">
                                <!--ข้อมูลทั่วไป-->
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
                                                    e.employee_id ='$get_emp_id'";
                                $query_emp = mysqli_query($conn, $sql_emp);
                                while($result_emp = mysqli_fetch_array($query_emp,MYSQLI_ASSOC)){
                                ?>
                                <table class="table table-responsive ">
                                    
                                        <tr>
                                            <th rowspan="5">
                                                <img class="circle-thumbnail img-circle img-center img-thumbnail img-lg" style="width: 70px;height: 70px;" src="upload_images/<?php if($result_emp["profile_picture"] == ''){ echo "defalut.png"; }else{ echo $result_emp["profile_picture"]; } ?>">
                                            </th>
                                            <th align="center" colspan="2" width="">ชื่อ-นามสกุล: </th>
                                            <th align="center" colspan="2" width=""><?php echo $result_emp["emp_name"]; ?></th>
                                            <th align="center" colspan="1" width="">ตำแหน่ง: </th>
                                            <th align="center" colspan="1" width=""><?php echo $result_emp["job_name"]; ?></th>
                                            <th align="center" colspan="1" width="">ระดับตำแหน่ง:  </th>
                                            <th align="center" colspan="1" width=""><?php echo $result_emp["position_description"]; ?></th>

                                        </tr>
                                        <tr>
                                            <th align="center" colspan="2" width="">รหัส: </th>
                                            <th align="center" colspan="2" width=""><?php echo $result_emp["employee_id"]; ?></th>
                                            <th align="center" colspan="2" width="">อายุงาน: </th>
                                            <th align="center" colspan="2" width=""></th>
                                            
                                        </tr>
                                        <tr>
                                            <th align="center" colspan="2" width="">วันเริ่มงาน: </th>
                                            <th align="center" colspan="2" width=""><?php echo $result_emp["hiredate"]; ?></th>
                                            <th align="center" colspan="2" width="">สังกัด / ฝ่าย / สายงาน :    </th>
                                            <th align="center" colspan="2" width=""><?php echo $result_emp["department_name"]; ?></th>
                                            
                                        </tr>
                                        <tr>
                                            <th align="center" colspan="2" width="">ชื่อ - นามสกุลของผู้ประเมินที่ 1 :   </th>
                                            <th align="center" colspan="2" width=""><?php echo $result_emp["manager_name_1"]; ?></th>
                                            <th align="center" colspan="2" width="">ชื่อ - นามสกุลของผู้ประเมินที่ 2 :   </th>
                                            <th align="center" colspan="2" width=""><?php echo $result_emp["manager_name_2"]; ?></th>
                                            
                                        </tr>
                                        <tr>
                                            <th align="center" colspan="2" width="">วันที่ประเมิน : </th>
                                            <th align="center" colspan="2" width=""> </th>
                                            <th align="center" colspan="2" width="">ระยะเวลาประเมินผล </th>
                                            <th align="center" colspan="2" width=""> ......../ ......... / 25 ......  ถึง ......... / ......... / 25........ </th>
                                            
                                        </tr>
                                    
                                
                                
                                
                                       
                                   </table>
                                <?php } ?>
                                <!--/ข้อมูลทั่วไป--> 
                            </div>
                        </div>  
                    </div>
                </div>
                    <!-- /Employee Profile -->
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
                                        <thead>
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
                                            <tr> 
                                                <th rowspan="1"></th>
                                                <th rowspan="1"></th>
                                                <th rowspan="1"></th>
                                                <th rowspan="1"></th>
                                                <th rowspan="1"></th>
                                            </tr>
                                            <tr> 
                                                <th rowspan="1"></th>
                                                <th rowspan="1"></th>
                                                <th rowspan="1"></th>
                                                <th rowspan="1"></th>
                                                <th rowspan="1"></th>
                                            </tr>
                                            <tr> 
                                                <th rowspan="1"></th>
                                                <th rowspan="1"></th>
                                                <th rowspan="1"></th>
                                                <th rowspan="1"></th>
                                                <th rowspan="1"></th>
                                            </tr>
                                            <tr> 
                                                <th rowspan="1"></th>
                                                <th rowspan="1"></th>
                                                <th rowspan="1"></th>
                                                <th rowspan="1"></th>
                                                <th rowspan="1"></th>
                                            </tr>
                                            <tr> 
                                                <th rowspan="1"></th>
                                                <th rowspan="1"></th>
                                                <th rowspan="1"></th>
                                                <th rowspan="1"></th>
                                                <th rowspan="1"></th>
                                            </tr>
                                            <tr> 
                                                <th rowspan="1" colspan="2" class="text-right">รวม</th>
                                                            
                                                <th rowspan="1">100</th>
                                                <th rowspan="1"></th>
                                                <th rowspan="1"></th>
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
