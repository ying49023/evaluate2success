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
        <!-- SCRIPT PACKS -->
        <?php include('./script_packs.html') ?>
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
                        แก้ไขข้อมูลพนักงาน
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Edit profile</li>
                    </ol>
                </section>
                <!--/Page header -->

                  <!-- Main content -->
            <div class="row box-padding">
                <div class="box box-success">
                    <div class="box-body">
                        <div class="row"> 
                            <div class="box-padding">
                                
                                <?php
                                
                                $get_emp_id = "1"; //ตั้งค่า Default = 1 ไว้เพื่อไม่ให้เกิด ERROR ในการ Query SQL
                                
                                //เงื่อนไขนี้เป็นการเช็คว่ามีส่งมาไหม
                                if(isset($_GET["emp_id"])){
                                    $get_emp__id = $_GET["emp_id"]; //GET ค่ามาจากหน้า hr_kpi_individual.php ผ่านลิงค์ 
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
                                        emp.employee_id = '".$get_emp__id."'
                                LIMIT 1";
                                $query = mysqli_query($conn, $sql_emp); //$conn มาจากไฟล์ connection_mysqli.php เป็นตัว connect DB

                                 ?>
                                
                                
                                <!--ข้อมูลทั่วไป-->
                                <table class="table table-bordered table-condensed">
                                    <tbody>
                                        <tr>
                                            <th rowspan="2" style="padding: 10px;width: 90px;">
                                                <img class="img-circle img-center img-md img-thumbnail"  src="../upload_images/<?php echo $picture;?>">
                                            </th>
                                            <th align="center" width="" >ชื่อ-นามสกุล</th>
                                            <th align="center" width="120px">รหัส</th>
                                            <th align="center" width="" >ระดับ</th>
                                            <th align="center" width="" >แผนก</th>
                                        </tr>
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
                                        <tr>
                                            <td><?php  echo $name ;?></td>
                                            <td><?php  echo $emp_id ;?></td>
                                            <td><?php  echo $pos ;?></td>
                                            <td><?php  echo $dept ;?></td>
                                            
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                                <!--/ข้อมูลทั่วไป-->
                                <a class="" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                    <i class="glyphicon glyphicon-triangle-bottom"></i>รายละเอียดบุคคลเพิ่มเติม
                                </a>
                                <div class="collapse" id="collapseExample" style="margin-top:10px;">
                                    <table class="table table-responsive table-bordered ">
                                        <thead>
                                            <tr class="text-center">
                                                <td colspan="2">วันที่เริ่มงาน</td>
                                                <td colspan="2">email</td>
                                                <td colspan="2">เบอร์โทรศัพท์</td>
                                                <td colspan="2">ผู้บังคับบัญชา</td>
                                            </tr>
                                        </thead>
                                        <tr class="text-center">
                                            <td colspan="2"><?php echo $hire ;?></td>
                                            <td colspan="2"><?php echo $email ;?></td>
                                            <td colspan="2"><?php echo $tel ;?></td>
                                            <td colspan="2"><?php echo $manager_name ; ?></td>
                                        </tr>
                                    </table> 
                                </div>  
                                </div>  

                             </div>

                            </div>

                            <div class="box-body">
                             <?php $sql_leave_type = "SELECT
                                        
                                        leave_type_id,
                                        leave_type_description
                                FROM
                                        leaves_type";
                              
                                $query = mysqli_query($conn, $sql_leave_type); 
                                 ?>
                                <form>
                                    <table>
                                    
                                        <tr>
                                        <th>ประเภทการลา</th>
                                        <th>จำนวน(วัน)</th>
                                        </tr>
                                    
                                    <?php while($result_leave_type = mysqli_fetch_assoc($query)) {
                
                                $leave_id = $result_leave_type["leave_type_id"];
                                $name = $result_leave_type["leave_type_description"];
                             
                             ?>
                              <tr>      
                                        <td><?php echo $name ; ?></td>
                                        <td><input type="number" min="0" max="200"></td>
                                    </tr>
                                
                            <?php } ?>
                                        
                                    </table>
                                </form>
                            </div>


                            <!-- /Box body -->
                            <div class="box-footer text-center">
                                <button class="btn btn-danger search-button" onclick="goBack()">ย้อนกลับ</button>
                                <input  class="btn btn-success search-button" type="submit" name="Send" value="บันทึก">     
                            </div>
                        
                       
                 
            

         </div>    



                <!-- /.content -->
                </div>
         
            <!-- /.content-wrapper -->
            </div>

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