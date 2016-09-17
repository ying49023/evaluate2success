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
<?php 
        $erp='';
        $msg='';
        
        include './classes/connection_mysqli.php';    
        
        if (isset($_GET["emp_id"])) {
            $get_emp_id = $_GET["emp_id"];
        }
        //Get Evaluation employee id
        if (isset($_GET["eval_emp_id"])) {
            $get_eval_emp_id = $_GET["eval_emp_id"];
        }
        //Get Evaluation code
        if (isset($_GET["eval_code"])) {
            $get_eval_code = $_GET["eval_code"];
        }
        //Get Position Level
        if(isset($_GET["position_level_id"])){
            $level = $_GET["position_level_id"];
        }
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
                        ส่วนที่ 4: ความคิดเห็นเพิ่มเติมและการประเมินผลโดยรวม (Overall Rating)
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Evaluation</li>
                    </ol>
                </section>
                <!--/Page header -->

               
                <!-- Main content -->
             
                <div class="row box-padding">
                    <!-- Brief Info Profile Employee  -->
                    <?php include './breif_info_profile_eval.php'; ?>
                    <!-- /Brief Info Profile Employee  -->
                    
                    <!-- Navbar process -->
                    <?php include './navbar_process.php'; ?>
                    <!-- /Navbar process -->
                    <!-- Part 4 -->
                    <div class="box box-primary">
                        <div class="box-header "><h4>สรุปคะแนนที่ได้รับจากแต่ละส่วนเพื่อประเมินผลโดยรวม</h4></div>
                        <div class="box-body">
                            <!--Table Point-->
                            <table class="table table-bordered table-hover ">
                                <thead>
                                    <tr class="text-center">
                                        <td rowspan=2 class="bg-inverse" style="vertical-align: middle;"><b>หัวข้อประเมิน</b></td>
                                        <td colspan=2 class="bg-orange"><b>ผู้ประเมินที่ 1</b></td>
                                        <td colspan=2 class="bg-olive"><b>ผู้ประเมินที่ 2</b></td>
                                    </tr>
                                    <tr class="text-center">
                                       <td class="bg-warning"><b>คะแนนเต็ม</b></td>
                                       <td class="bg-warning"><b>คะแนนที่ได้รับ</b></td>
                                       <td class="bg-success"><b>คะแนนเต็ม</b></td>
                                       <td class="bg-success"><b>คะแนนที่ได้รับ</b></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  
                                    $sql_kpi_score = "SELECT * FROM evaluation_employee WHERE evaluate_employee_id = '".$_SESSION["eval_emp_id"]."'";
                                    $query_kpi_score = mysqli_query($conn, $sql_kpi_score);
                                    while($result_kpi_score = mysqli_fetch_array($query_kpi_score)){
                                    ?>
                                    <tr>
                                        <td><b>คะแนนรวมส่วนที่ 1:</b> การประเมินด้านผลงาน (กำหนดคะแนนเต็ม 60)</td>
                                        <td  class="text-center"><b>60</b></td>
                                        <td    class="text-center"><input class="text-center" type="number" name="ass1part1point" min="0" max="60" value="<?php echo $result_kpi_score["point_kpi"]; ?>" disabled></td>
                                        <td  class="text-center"><b>60</b></td>
                                        <td  class="text-center"><input class="text-center" type="number" name="ass2part1point" min="0" max="60" value="<?php echo $result_kpi_score["point_kpi"]; ?>" disabled></td>
                                    </tr>
                                    <?php } ?>
                                    <tr>
                                        <td><b>คะแนนรวมส่วนที่ 2 : พฤติกรรมการทำงาน</b></td>
                                        <td ></td>
                                        <td ></td>
                                        <td  ></td>
                                        <td  ></td>
                                    </tr>
                                    <?php  
                                    $sql_score_2_1 = "SELECT
                                                            SUM(point_assessor1) As sum_2_1_assessor1,
                                                            SUM(point_assessor2)As sum_2_1_assessor2
                                                    FROM
                                                            evaluation_employee ee
                                                    JOIN evaluation_competency ec ON ee.evaluate_employee_id = ec.evaluate_employee_id
                                                    JOIN manage_competency mc ON ec.manage_comp_id = mc.manage_comp_id
                                                    JOIN competency c ON mc.competency_id = c.competency_id
                                                    JOIN competency_title ct ON c.title_id = ct.title_id
                                                    WHERE
                                                            ct.title_id = 1 AND ee.evaluate_employee_id='".$_SESSION["eval_emp_id"]."'";
                                    $query_score_2_1 = mysqli_query($conn, $sql_score_2_1);
                                    while($result_score_2_1 = mysqli_fetch_array($query_score_2_1)) {
                                    ?>
                                    <tr>
                                        <td style="padding-left: 40px;">ส่วนที่ 2.1 พฤติกรรมหลักร่วมกันทั้งองค์กร (Corporate Competency)</td>
                                        <td  class="text-center"><b>20</b></td>
                                        <td  class="text-center"><input class="text-center" type="number" name="ass1part2/1point" value="<?php echo $result_score_2_1["sum_2_1_assessor1"]; ?>" min="0" max="20" disabled></td>
                                        <td  class="text-center"><b>20</b></td>
                                        <td  class="text-center"><input class="text-center" type="number" name="ass1part2/1point" value="<?php echo $result_score_2_1["sum_2_1_assessor2"]; ?>" min="0" max="20" disabled></td>
                                    </tr>
                                    <?php } ?>
                                    <?php
                                    $sql_score_2_2 = "SELECT
                                                            SUM(point_assessor1)As sum_2_2_assessor1,
                                                            SUM(point_assessor2)As sum_2_2_assessor2
                                                    FROM
                                                            evaluation_employee ee
                                                    JOIN evaluation_competency ec ON ee.evaluate_employee_id = ec.evaluate_employee_id
                                                    JOIN manage_competency mc ON ec.manage_comp_id = mc.manage_comp_id
                                                    JOIN competency c ON mc.competency_id = c.competency_id
                                                    JOIN competency_title ct ON c.title_id = ct.title_id
                                                    WHERE
                                                            ct.title_id = 2 AND ee.evaluate_employee_id='".$_SESSION["eval_emp_id"]."'";
                                    $query_score_2_2 = mysqli_query($conn, $sql_score_2_2);
                                    while($result_score_2_2 = mysqli_fetch_array($query_score_2_2)) {
                                    ?>
                                    <tr>
                                        <td style="padding-left: 40px;">ส่วนที่ 2.2 ในส่วนพฤติกรรมทั่วไป (General Competency)</td>
                                        <td class="text-center"><b>20</b></td>
                                        <td class="text-center"><input type="number" name="ass1part2/2point" value="<?php echo $result_score_2_2["sum_2_2_assessor1"]; ?>" min="0" max="20" disabled></td>
                                        <td class="text-center"><b>20</b></td>
                                        <td class="text-center"><input type="number" name="ass2part2/1point" value="<?php echo $result_score_2_2["sum_2_2_assessor_2"]; ?>" min="0" max="20" disabled></td>
                                    </tr>
                                    <?php } ?>
                                    <?php
                                    $sql_score_3 = "SELECT
                                                    point_leave + point_penalty As score_3
                                                  FROM
                                                          evaluation_employee
                                                  WHERE
                                                          evaluate_employee_id='".$_SESSION["eval_emp_id"]."'";
                                    $query_score_3 = mysqli_query($conn, $sql_score_3);
                                    while($result_score_3 = mysqli_fetch_array($query_score_3)) {
                                    ?>
                                     <tr>
                                        <td ><b>ส่วนที่ 3:  การปฏิบัติตามกฎระเบียบและข้อบังคับของบริษัท (กำหนดคะแนนเต็ม 10)</td>
                                        <td ></td>
                                        <td class="text-center"><input class="text-center" type="number" name="part3point" value="<?php echo $result_score_3["score_3"]; ?>" min="0" max="20" disabled></td>
                                        <td ></td>
                                        <td class="text-center"><input class="text-center" type="number" name="part3point" value="<?php echo $result_score_3["score_3"]; ?>" min="0" max="20" disabled></td>
                                    </tr>
                                    <?php } ?>
                                    
                                     
                                </tbody>
                                <tfoot>
                                    <tr class="active">
                                        <th>คะแนนสุทธิ (ส่วนที่ 1 + ส่วนที่ 2 - ส่วนที่ 3 )</th>
                                        <th></th>
                                        <th class="text-center" style="color: blue;"><b><input class="text-center" type="number" value="<?php echo $result_kpi_score["point_kpi"]+$result_score_2_1["sum_2_1_assessor1"]+$result_score_2_2["sum_2_2_assessor1"]-$result_score_3["score_3"]; ?>" name="ass1part1+2point" min="0" max="100"  disabled></b></th>
                                        <th></th>
                                        <th class="text-center" style="color: blue;"><input class="text-center" type="number" value="<?php echo $result_kpi_score["point_kpi"]+$result_score_2_1["sum_2_1_assessor2"]+$result_score_2_2["sum_2_2_assessor2"]-$result_score_3["score_3"]; ?>"  name="ass2part1+2point" min="0" max="100" disabled></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <br>
                        <div class="row box-padding">
                            <div ><h4>ความคิดเห็นเพิ่มเติม</h4>   </div>
                            <div class="col-md-6">
                                <div class="box box-success box-padding-small">
                                <h5><u>จุดเด่นของผู้ถูกประเมิน</u></h5>
                                
                                    <div class="form-group">
                                       <ol>
                                           <?php
                                           $sql_skill = "SELECT
                                                                *
                                                        FROM
                                                                skill_development sd
                                                        JOIN skill_devlopment_group skg ON skg.skill_dev_group_id = sd.skill_development_id" ;
                                           $query_skill = mysqli_query($conn, $sql_skill);
                                           
                                           for($i = 1;$i<=5;$i++) {
                                           ?>
                                                   <li>
                                                       <select class="form-control" name="good">
                                                           <option value="">--เลือก--</option>
                                                           <?php 
                                                           foreach ($query_skill as $result_skill){
                                                                echo $result_skill["skill_development_name"];
                                                           ?>
                                                           <option value=""><?php echo $result_skill["skill_development_name"]; ?></option>
                                                           <?php } ?>
                                               </select>
                                                   </li>
                                           <?php 
                                           
                                           } ?>
                                    </ol> 
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="box box-danger box-padding-small">
                                <h5><u>จุดด้อยของผู้ถูกประเมิน</u></h5>
                                
                                    <div class="form-group">
                                       <ol>
                                           <?php
                                           $sql_skill = "SELECT
                                                                *
                                                        FROM
                                                                skill_development sd
                                                        JOIN skill_devlopment_group skg ON skg.skill_dev_group_id = sd.skill_development_id" ;
                                           $query_skill = mysqli_query($conn, $sql_skill);
                                           
                                           for($i = 1;$i<=5;$i++) {
                                           ?>
                                                   <li>
                                                       <select class="form-control" name="good">
                                                           <option value="">--เลือก--</option>
                                                           <?php 
                                                           foreach ($query_skill as $result_skill){
                                                                echo $result_skill["skill_development_name"];
                                                           ?>
                                                           <option value=""><?php echo $result_skill["skill_development_name"]; ?></option>
                                                           <?php } ?>
                                               </select>
                                                   </li>
                                           <?php 
                                           
                                           } ?>
                                    </ol> 
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
<!--                        <div class="row box-padding">
                            <div class="col-md-12">
                                <div class="box box-warning box-padding-small">
                                <h5><u>ควรได้รับการพัฒนาด้านใด</u></h5>
                                
                                    <div class="form-group">
                                       <ol>
                                           <?php
                                           $sql_skill = "SELECT
                                                                *
                                                        FROM
                                                                skill_development sd
                                                        JOIN skill_devlopment_group skg ON skg.skill_dev_group_id = sd.skill_development_id" ;
                                           $query_skill = mysqli_query($conn, $sql_skill);
                                           
                                           for($i = 1;$i<=5;$i++) {
                                           ?>
                                                   <li>
                                                       <select class="form-control" name="good">
                                                           <option value="">--เลือก--</option>
                                                           <?php 
                                                           foreach ($query_skill as $result_skill){
                                                                echo $result_skill["skill_development_name"];
                                                           ?>
                                                           <option value=""><?php echo $result_skill["skill_development_name"]; ?></option>
                                                           <?php } ?>
                                               </select>
                                                   </li>
                                           <?php 
                                           
                                           } ?>
                                    </ol> 
                                    </div>
                                    
                                </div>
                            </div>
                        </div>-->

                        </div>   
                            <div class="modal fade" id="save_point" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">ยืนยันการประเมิน</h4>
                                        </div>
                                        <div class="modal-body">                                                                                                      <!--<iframe id="iframe_target" name="iframe_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>-->

                                            เมื่อกดยืนยันคุณจะไม่สามารถกลับมาแก้ไขได้!! ทำรายการต่อไหม?

                                        </div>
                                        <div class="modal-footer">                                                                   
                                            <button class="btn-info btn-lg" type="submit" >ยืนยัน</button>                                                                             
                                            <input type="hidden" name="position_level" value="" >
                                            <input type="hidden" name="emp" value="" >
                                            <input type="hidden" name="evalcode" value="" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <!-- /Part 4 -->       
                    <!-- /.content -->
                </div>
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
