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
                        <div class="box-header with-border">
                            <h4>สรุปคะแนนที่ได้รับจากแต่ละส่วนเพื่อประเมินผลโดยรวม</h4>
                        </div>
                        <div class="box-body">
                            <!--Table Point-->
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <td rowspan=2 class="bg-inverse" style="vertical-align: middle;"><b>หัวข้อประเมิน</b></td>
                                        <td colspan=2 class="bg-light-blue"><b>รอบประเมินครั้งที่ 1</b></td>
                                        <td colspan=2 class="bg-blue-active"><b>รอบประเมินครั้งที่ 2</b></td>
                                    </tr>
                                    <tr class="text-center">
                                       <td class="bg-info"><b>คะแนนเต็ม</b></td>
                                       <td class="bg-info"><b>คะแนนที่ได้รับ</b></td>
                                       <td class="bg-info"><b>คะแนนเต็ม</b></td>
                                       <td class="bg-info"><b>คะแนนที่ได้รับ</b></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  
                                    $score_1_term_1 = '';
                                    $score_1_term_2 = '';
                                    
                                    $sql_kpi_score_term_1 = "SELECT * FROM evaluation_employee WHERE evaluate_employee_id = '".$_SESSION["eval_emp_id"]."'";
                                    $query_kpi_score_term_1 = mysqli_query($conn, $sql_kpi_score_term_1);
                                    $result_kpi_score_term_1 = mysqli_fetch_array($query_kpi_score_term_1);
                                    
                                    $sql_kpi_score_term_2 = "SELECT * FROM evaluation_employee WHERE evaluate_employee_id = '".$_SESSION["eval_emp_id"]."'";
                                    $query_kpi_score_term_2 = mysqli_query($conn, $sql_kpi_score_term_2);
                                    $result_kpi_score_term_2 = mysqli_fetch_array($query_kpi_score_term_2);
                                    $score_1_term_1 = ($result_kpi_score_term_1["point_kpi"]+$result_kpi_score_term_2["point_kpi"])/2;
                                    ?>
                                    <tr>
                                        <td><b>คะแนนรวมส่วนที่ 1:</b> การประเมินด้านผลงาน (กำหนดคะแนนเต็ม 60)</td>
                                        <td  class="text-center"><b>60</b></td>
                                        <td    class="text-center"><b><?php echo $score_1_term_1;?></b></td>
                                        <td  class="text-center"><b>60</b></td>
                                        <td  class="text-center"><b><?php echo $score_1_term_2; ?></b></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5"><b>คะแนนรวมส่วนที่ 2 : พฤติกรรมการทำงาน</b></td>
                                    </tr>
                                    <?php  
                                    $score_2_1_term_1 = '';
                                    $score_2_1_term_2 = '';
                                    
                                    $sql_score_2_1_term_1 = "SELECT
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
                                    $query_score_2_1_term_1 = mysqli_query($conn, $sql_score_2_1_term_1);
                                    $result_score_2_1_term_1 = mysqli_fetch_array($query_score_2_1_term_1);
                                    
                                    $sql_score_2_1_term_2 = "SELECT
                                                            SUM(point_assessor1) As sum_2_1_assessor1,
                                                            SUM(point_assessor2)As sum_2_1_assessor2
                                                    FROM
                                                            evaluation_employee ee
                                                    JOIN evaluation_competency ec ON ee.evaluate_employee_id = ec.evaluate_employee_id
                                                    JOIN manage_competency mc ON ec.manage_comp_id = mc.manage_comp_id
                                                    JOIN competency c ON mc.competency_id = c.competency_id
                                                    JOIN competency_title ct ON c.title_id = ct.title_id
                                                    WHERE
                                                            ct.title_id = 1 AND ee.evaluate_employee_id='99'";
                                    $query_score_2_1_term_2 = mysqli_query($conn, $sql_score_2_1_term_2);
                                    $result_score_2_1_term_2 = mysqli_fetch_array($query_score_2_1_term_2);
                                    
                                    $score_2_1_term_1 = ($result_score_2_1_term_1["sum_2_1_assessor1"] + $result_score_2_1_term_1["sum_2_1_assessor2"]) /2 ;
                                    $score_2_1_term_2 = ($result_score_2_1_term_2["sum_2_1_assessor1"] + $result_score_2_1_term_2["sum_2_1_assessor2"]) /2 ;
                                    ?>
                                    <tr>
                                        <td style="padding-left: 40px;">ส่วนที่ 2.1 พฤติกรรมหลักร่วมกันทั้งองค์กร (Corporate Competency)</td>
                                        <td  class="text-center"><b>20</b></td>
                                        <td  class="text-center"><b><?php echo $score_2_1_term_1; ?></b></td>
                                        <td  class="text-center"><b>20</b></td>
                                        <td  class="text-center"><b><?php echo $score_2_1_term_2; ?></b></td>
                                    </tr>
                                    
                                    <?php
                                    $score_2_2_term_1 = '';
                                    $score_2_2_term_2 = '';
                                    
                                    $sql_score_2_2_term_1 = "SELECT
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
                                    $query_score_2_2_term_1 = mysqli_query($conn, $sql_score_2_2_term_1);
                                    $result_score_2_2_term_1 = mysqli_fetch_array($query_score_2_2_term_1);
                                    
                                    $sql_score_2_2_term_2 = "SELECT
                                                            SUM(point_assessor1)As sum_2_2_assessor1,
                                                            SUM(point_assessor2)As sum_2_2_assessor2
                                                    FROM
                                                            evaluation_employee ee
                                                    JOIN evaluation_competency ec ON ee.evaluate_employee_id = ec.evaluate_employee_id
                                                    JOIN manage_competency mc ON ec.manage_comp_id = mc.manage_comp_id
                                                    JOIN competency c ON mc.competency_id = c.competency_id
                                                    JOIN competency_title ct ON c.title_id = ct.title_id
                                                    WHERE
                                                            ct.title_id = 2 AND ee.evaluate_employee_id='99'";
                                    $query_score_2_2_term_2 = mysqli_query($conn, $sql_score_2_2_term_2);
                                    $result_score_2_2_term_2 = mysqli_fetch_array($query_score_2_2_term_2);
                                    
                                    $score_2_2_term_1 = ($result_score_2_2_term_1["sum_2_2_assessor1"] + $result_score_2_2_term_1["sum_2_2_assessor2"])/2;
                                    $score_2_2_term_2 = ($result_score_2_2_term_2["sum_2_2_assessor1"] + $result_score_2_2_term_2["sum_2_2_assessor2"])/2;
                                    
                                    ?>
                                    <tr>
                                        <td style="padding-left: 40px;">ส่วนที่ 2.2 ในส่วนพฤติกรรมทั่วไป (General Competency)</td>
                                        <td class="text-center"><b>10</b></td>
                                        <td class="text-center"><b><?php echo $score_2_2_term_1 ; ?></b></td>
                                        <td class="text-center"><b>10</b></td>
                                        <td class="text-center"><b><?php echo $score_2_2_term_2; ?></b></td>
                                    </tr>

                                    <?php
                                    $score_3_term_1 = '';
                                    $score_3_term_2 = '';
                                    
                                    
                                    $sql_score_3_term_1 = "SELECT
                                                    point_leave + point_penalty As score_3
                                                  FROM
                                                          evaluation_employee
                                                  WHERE
                                                          evaluate_employee_id='".$_SESSION["eval_emp_id"]."'";
                                    $query_score_3_term_1 = mysqli_query($conn, $sql_score_3_term_1);
                                    $result_score_3_term_1 = mysqli_fetch_array($query_score_3_term_1);
                                    
                                    
                                    $sql_score_3_term_2 = "SELECT
                                                    point_leave + point_penalty As score_3
                                                  FROM
                                                          evaluation_employee
                                                  WHERE
                                                          evaluate_employee_id='99'";
                                    $query_score_3_term_2 = mysqli_query($conn, $sql_score_3_term_2);
                                    $result_score_3_term_2 = mysqli_fetch_array($query_score_3_term_2);
                                    
                                    $score_3_term_1 = $result_score_3_term_1["score_3"];
                                    $score_3_term_2 = $result_score_3_term_2["score_3"];
                                    ?>
                                     <tr>
                                        <td ><b>ส่วนที่ 3:  การปฏิบัติตามกฎระเบียบและข้อบังคับของบริษัท (กำหนดคะแนนเต็ม 10)</td>
                                        <td class="text-center"><b>10</b></td>
                                        <td class="text-center"><b><?php echo $score_3_term_1; ?></b></td>
                                        <td class="text-center"><b>10</b></td>
                                        <td class="text-center"><b><?php echo $score_3_term_2; ?></b></td>
                                    </tr>
                                    <tr class="bg-blue">
                                        <td style="padding-left: 40px;">คะแนนสุทธิ (ส่วนที่ 1 + ส่วนที่ 2 - ส่วนที่ 3 )</td>
                                        <td colspan=2 class="text-center" style="color: red;"><b><input type="number" value="<?php echo $result_kpi_score["point_kpi"]+$result_score_2_1["sum_2_1_assessor1"]+$result_score_2_2["sum_2_2_assessor1"]-$result_score_3["score_3"]; ?>" name="ass1part1+2point" min="0" max="100"  disabled></b></td>
                                        <td colspan=2 class="text-center" style="color: red;"><b><input type="number" value="<?php echo $result_kpi_score["point_kpi"]+$result_score_2_1["sum_2_1_assessor2"]+$result_score_2_2["sum_2_2_assessor2"]-$result_score_3["score_3"]; ?>"  name="ass2part1+2point" min="0" max="100" disabled></b></td>
                                    </tr>
                                    <tr class="active">
                                        <td colspan="6"></td>
                                    </tr>
                                    <tr class="table-active">
                                        <th colspan="6" class="text-center">ข้อมูลสรุปจะแสดงหลังจากประเมิน ทำการประเมินครบ 2 ครั้ง</th>
                                    </tr>
                                     <tr>
                                        <td align= right><b>สรุปคะแนนตลอดปี (คะแนนสุทธิผู้ประเมินที่ 1 +  คะแนนสุทธิผู้ประเมินที่ 2) หาร 2</b></td>
                                        <td colspan=4 class="text-center" style="background-color:#FFEFD5;"><b><input type="number" name="term1+2point" min="0" max="100" disabled></b></td>
                                       
                                    </tr>
                                    <tr>
                                        <td align= right><b>สรุปคะแนนพิจารณาบทลงโทษทางวินัย</b></td>
                                        <td colspan=4 class="text-center" style="background-color:#FAF0E6;"><b><input type="number" name="penaltypoint" min="0" max="100" disabled></b></td>
                                       
                                    </tr>
                                    <tr>
                                        <td align= right><b>สรุปคะแนนประเมินผลงานโดยรวม (Overall rating)</b></td>
                                        <td colspan=4 class="text-center" style="background-color:#F0FFFF;"><b><input type="number" name="allpoint" min="0" max="100" disabled></b></td>
                                       
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <br>
                        

<div class="row box-padding">
    <table class="table ">
        <thead class="thead-default">
            <tr>
                        
                <th colspan="13">การประเมินผลโดยรวม (Overall Rating) </th>
                            
            </tr>
        </thead>
        <tbody>
        <form>
                    
            <tr class="text-center">
                        
                <th scope="row" rowspan="3">ผลการปฏิบัติงาน</th>  
                <td><input type="radio" value="A++"  name="grade" disabled></td>
                <td><input type="radio" value="A+" name="grade" disabled></td>
                <td><input type="radio" value="A-" name="grade" disabled></td>
                <td><input type="radio" value="B++" name="grade" disabled></td>
                <td><input type="radio" value="B+" name="grade" disabled></td>
                <td><input type="radio" value="B" name="grade" disabled></td>
                <td><input type="radio" value="B-" name="grade" disabled></td>
                <td><input type="radio" value="C++" name="grade" disabled></td>
                <td><input type="radio" value="C+" name="grade" disabled></td>
                <td><input type="radio" value="C" name="grade" disabled></td>
                <td><input type="radio" value="C-" name="grade" disabled></td>
            </tr>
                        
        </form>
                    
        <tr class="text-center">
                    
                    
                    <?php
                    $sql_grade = "SELECT * FROM grade ORDER BY standard_max_point desc";
                        
                    $query = mysqli_query($conn, $sql_grade); //$conn มาจากไฟล์ connection_mysqli.php เป็นตัว connect DB
                    ?>
                    <?php
                    while ($result = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                        $name = $result["grade_description"];
                        $desc = $result["grade_explaned"];
                        $maxpoint = $result["standard_max_point"];
                        $minpoint = $result["standard_min_point"];
                        $id = $result["grade_id"];
                        ?>
            <td><?php echo $name; ?></td>
                    <?php } ?>
        </tr>
        <tr class="text-center">
                    
                    
                    <?php
                    $sql_grade = "SELECT * FROM grade ORDER BY standard_max_point desc";
                        
                    $query = mysqli_query($conn, $sql_grade); //$conn มาจากไฟล์ connection_mysqli.php เป็นตัว connect DB
                    ?>
                    <?php
                    while ($result = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                        $name = $result["grade_description"];
                        $desc = $result["grade_explaned"];
                        $maxpoint = $result["standard_max_point"];
                        $minpoint = $result["standard_min_point"];
                        $id = $result["grade_id"];
                        ?>
            <td>(<?php echo $desc; ?>)</td>
                    <?php } ?>
        </tr>
                    
        <tr class="text-center">
            <th scope="row">คะแนน</th>
                        
                    <?php
                    $sql_grade = "SELECT * FROM grade ORDER BY standard_max_point desc";
                        
                    $query = mysqli_query($conn, $sql_grade); //$conn มาจากไฟล์ connection_mysqli.php เป็นตัว connect DB
                    ?>
                    <?php
                    while ($result = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                        $name = $result["grade_description"];
                        $desc = $result["grade_explaned"];
                        $maxpoint = $result["standard_max_point"];
                        $minpoint = $result["standard_min_point"];
                        $id = $result["grade_id"];
                        ?>
            <td><?php echo $minpoint; ?> - <?php echo $maxpoint; ?></td>
                    <?php } ?>
        </tr>
                    
        </tbody>
    </table>
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
