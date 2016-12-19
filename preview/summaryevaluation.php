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
        <?php 
             $get_emp_id = '';
            if(isset($_GET["emp_id"])){
                $get_emp_id  = $_GET["emp_id"];
            }
            $get_eval_code = '';
            if(isset($_GET["eval_code"])){
                $get_eval_code  = $_GET["eval_code"];
            }
             $get_eval_emp_id = '';
            if(isset($_GET["eval_emp_id"])){
                $get_eval_emp_id  = $_GET["eval_emp_id"];
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
                        ดูผลการประเมิน
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Summary evaluation</li>
                    </ol>
                </section>
                <!--/Page header -->

                <!-- Main content -->
                <div class="row box-padding">
                    <div class="box box-success">
    <?php
    $sql_emp = "SELECT
                    GROUP_CONCAT(e.prefix,e.first_name,'  ',e.last_name) as emp_name,e.hiredate , e.*, p.*,j.*,d.*,
                    GROUP_CONCAT(m.prefix,m.first_name,'  ',m.last_name) as manager_name_1
                    FROM
                        employees e
                    JOIN position_level p ON p.position_level_id = e.position_level_id
                    JOIN departments d ON d.department_id = e.department_id
                    JOIN jobs j ON j.job_id = e.job_id
                    JOIN employees m ON e.manager_id = m.employee_id
                    WHERE e.employee_id ='".$get_emp_id."'";
    $query_emp = mysqli_query($conn, $sql_emp);
    while ($result_emp = mysqli_fetch_array($query_emp, MYSQLI_ASSOC)) {
        $manager_name_1 = $result_emp["manager_name_1"];
        $manager_name_2 = '';
        if($result_emp["manager_id2"] != '' && $result_emp["manager_id2"] != 0){
            $sql_man2 = "SELECT GROUP_CONCAT(m2.prefix,m2.first_name,'  ',m2.last_name) as manager_name_2
                        FROM employees e
                        JOIN position_level p ON p.position_level_id = e.position_level_id
                        JOIN departments d ON d.department_id = e.department_id
                        JOIN jobs j ON j.job_id = e.job_id
                        JOIN employees m2 ON e.manager_id2 = m2.employee_id
                        WHERE e.employee_id = '".$get_emp_id."'";
            $query_man2 = mysqli_query($conn, $sql_man2);
            $result_man2 = mysqli_fetch_array($query_man2);
            $manager_name_2 = $result_man2["manager_name_2"];
        }
        
        ?>
    <div class="box-header">
        <div class="col-md6">
            
            
            <div style="float: right;">
                <img class='img-circle img-sm img-center' src="http://palmup.xyz/evaluate2success/preview/upload_images/<?php if($result_emp["profile_picture"]== ''){ echo 'default.png' ;}else { echo  $result_emp["profile_picture"];} ?>"  > <span span style="font-size:18px"><?php echo "&nbsp;&nbsp;" . $result_emp["employee_id"] . ' : ' . $result_emp["emp_name"]; ?></span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"> <i class="fa fa-minus"></i>
                </button>
            </div>
                <div col-md-6>
            <div style="float: left;">
                    <?php
                    $eval_code = '';
                    if (isset($_GET["eval_code"])) {
                        $eval_code = $_GET["eval_code"];
                    }

                    $sql_year_term = "SELECT * FROM evaluation e JOIN term t ON e.term_id=t.term_id WHERE evaluation_code = '".$eval_code."'";
                    $query_year_term = mysqli_query($conn, $sql_year_term);
                    while ($result_year_term = mysqli_fetch_array($query_year_term, MYSQLI_ASSOC)) {
                        echo "<span style='font-size:18px'><b>ปีการประเมิน " . $year = $result_year_term["year"] . "</b></span> | ";
                        echo "<span style='font-size:18px'>รอบการประเมินที่ " . $term = $result_year_term["term_name"] . " : " . $result_year_term["start_month"] . "-" . $result_year_term["end_month"] . "</span>";
                    }
                    ?>
            </div>
        </div>
    </div>  
    </div>
    <div class="box-body">
        <table class="table table-bordered table-striped table-responsive">
            <tr >
                <th rowspan="4" style="text-align: center;">
                    <img class="img-center img-thumbnail" style="height: 130px;max-width: 110px;" src="http://palmup.xyz/evaluate2success/preview/upload_images/<?php
                             if ($result_emp["profile_picture"] == '') {
                                 echo "default.png";
                             } else {
                                 echo $result_emp["profile_picture"];
                             }
                             ?>" >
                </th>
                <th>ชื่อ-นามสกุล</th>
                <th>รหัส</th>
                <th>ระดับ</th>
            </tr>
            <tr>
                <td><?php echo $result_emp["emp_name"]; ?> </td>
                <td><?php echo $result_emp["employee_id"]; ?></td>
                <td><?php echo $result_emp["position_description"]; ?> </td>
            </tr>
            <tr>
                <th>ตำแหน่ง</th>
                <th>สังกัด / ฝ่าย / สายงาน</th>
                <th>วันเริ่มงาน: </th>
            </tr>
            <tr>
                <td><?php echo $result_emp["job_name"]; ?></td>
                <td><?php echo $result_emp["department_name"]; ?></td>
                <td><?php echo $result_emp["hiredate"]; ?> <span style="color:maroon;"></span> </td>
            </tr>
            <tr>
                <th class="text-center">วันที่ประเมิน</th>
                <th>ชื่อ - นามสกุลของผู้ประเมินที่ 1</th>
                <th>ชื่อ - นามสกุลของผู้ประเมินที่ 2</th>
                <th>ระยะเวลาประเมินผล</th>
            </tr>
            <tr>
                <td class="text-center"> - </td>
                <td><?php echo $manager_name_1; ?></td>
                <td><?php echo $manager_name_2; ?></td>
                <td>
                    <?php 
                    $sql_eval_period = "SELECT * FROM evaluation WHERE evaluation_code = '".$eval_code."' ";
                    $query_eval_period = mysqli_query($conn, $sql_eval_period) or die(mysqli_errno());
                    $result_eval_period = mysqli_fetch_array($query_eval_period,MYSQLI_ASSOC);
                    ?>
                    <?php echo $result_eval_period["open_system_date"]; ?>  ถึง <?php echo $result_eval_period["close_system_date"]; ?>
                </td>
            </tr>
        </table>
    </div>
    
        <?php
    }
    ?>  
</div>
                </div>
                <div class="row box-padding">
                    <div class="box box-primary">
 
                        <form method="get" action="compareevaluation.php" >
                            <div class="box-body">
                            <!--Table Point-->
                            <!--Table Point-->
                            <table class="table table-bordered table-hover table-striped">
                                  <?php  
                                    $sql_score = "SELECT
                                                                *,ee.grade_id as grade_id3
                                                        FROM
                                                                employees emp
                                                        JOIN evaluation_employee ee ON emp.employee_id = ee.employee_id
                                                        JOIN evaluation e ON e.evaluation_code = ee.evaluation_code
                                                        WHERE
                                                               ee.evaluation_code= $eval_code and ee.evaluate_employee_id = '$get_eval_emp_id'";
                                    $query_score = mysqli_query($conn, $sql_score);
                                    
                                    $sql_pos = "select * from employees where employee_id=$get_emp_id";
                                            $query_pos = mysqli_query($conn,$sql_pos);
                                            $get_pos = mysqli_fetch_array($query_pos);
                                            $get_pos_id=$get_pos["position_level_id"];
                                    while($result_score = mysqli_fetch_array($query_score)){
                                        $grade_id3=$result_score["grade_id3"];
                                        $score_1 = round($result_score["point_kpi"] ,1);
                                        $score_2_1_m_1 = round($result_score["point_com1_part1"], 1);
                                        $score_2_2_m_1 = round($result_score["point_com1_part2"] ,1);
                                        $score_2_1_m_2 = round($result_score["point_com2_part1"] ,1);
                                        $score_2_2_m_2 = round($result_score["point_com2_part2"] ,1);
                                        $score_3 = round(10-($result_score["point_leave"]+$result_score["point_penalty"]) ,1);
                                        if($get_pos_id!=3){
                                            $sum_score_m_1 = round(($score_1 + $score_2_1_m_1 + $score_2_2_m_1) + $score_3 ,1);
                                            $sum_score_m_2 = round(($score_1 + $score_2_1_m_2 + $score_2_2_m_2) + $score_3 ,1);
                                        }else{
                                           $sum_score_m_1 = round(($score_1 + $score_2_1_m_1 + $score_2_2_m_1),1);
                                           $sum_score_m_2 = round(($score_1 + $score_2_1_m_2 + $score_2_2_m_2),1); 
                                        }
                                        
                                    ?>
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
                                    
                                    <tr>
                                        <td><b>คะแนนรวมส่วนที่ 1:</b> การประเมินด้านผลงาน (กำหนดคะแนนเต็ม 60)</td>
                                        <td  class="text-center"><b>60</b></td>
                                        <td    class="text-center"><input class="text-center" type="number" name="ass1part1point" min="0" max="60" value="<?php echo $score_1; ?>" disabled></td>
                                        <td  class="text-center"><b>60</b></td>
                                        <td  class="text-center"><input class="text-center" type="number" name="ass2part1point" min="0" max="60" value="<?php echo $score_1; ?>" disabled></td>
                                    </tr>
                                    <tr>
                                        <td><b>คะแนนรวมส่วนที่ 2 : พฤติกรรมการทำงาน</b></td>
                                        <td ></td>
                                        <td ></td>
                                        <td  ></td>
                                        <td  ></td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left: 40px;">ส่วนที่ 2.1 พฤติกรรมหลักร่วมกันทั้งองค์กร (Corporate Competency)</td>
                                        <td  class="text-center"><b>20</b></td>
                                        <td  class="text-center"><input class="text-center" type="number" name="ass1part2/1point" value="<?php echo $score_2_1_m_1; ?>" min="0" max="20" disabled></td>
                                        <td  class="text-center"><b>20</b></td>
                                        <td  class="text-center"><input class="text-center" type="number" name="ass1part2/1point" value="<?php echo $score_2_1_m_2; ?>" min="0" max="20" disabled></td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left: 40px;">ส่วนที่ 2.2 ในส่วนพฤติกรรมทั่วไป (General Competency)</td>
                                        <td class="text-center"><b><?php if($get_pos_id==3){ echo '20';}else{    echo '10';} ?></b></td>
                                        <td class="text-center"><input class="text-center" type="number" name="ass1part2/2point" value="<?php echo $score_2_2_m_1; ?>" min="0" max="20" disabled></td>
                                        <td class="text-center"><b><?php if($get_pos_id==3){ echo '20';}else{    echo '10';} ?></b></td>
                                        <td class="text-center"><input class="text-center" type="number" name="ass2part2/1point" value="<?php echo $score_2_2_m_2; ?>" min="0" max="20" disabled></td>
                                    </tr>
                                     <tr>
                                        <td ><b>ส่วนที่ 3:  การปฏิบัติตามกฎระเบียบและข้อบังคับของบริษัท (กำหนดคะแนนเต็ม 10)</td>
                                        <td ></td>
                                        <td class="text-center"><input class="text-center" type="number" name="part3point" value="<?php echo $score_3; ?>" min="0" max="20" disabled></td>
                                        <td ></td>
                                        <td class="text-center"><input class="text-center" type="number" name="part3point" value="<?php echo $score_3; ?>" min="0" max="20" disabled></td>
                                    </tr>
                                
                                    <tr class="active">
                                        <th>คะแนนสุทธิ (ส่วนที่ 1 + ส่วนที่ 2 + ส่วนที่ 3 )</th>
                                        <th></th>
                                        <th class="text-center" style="color: blue;"><b><input class="text-center" type="number" value="<?php echo $sum_score_m_1; ?>" name="ass1part1+2point" min="0" max="100"  disabled></b></th>
                                        <th></th>
                                        <th class="text-center" style="color: blue;"><input class="text-center" type="number" value="<?php echo $sum_score_m_2; ?>"  name="ass2part1+2point" min="0" max="100" disabled></th>
                                    </tr>
                                
                                    <?php } ?>
                                <?php  
                                //Term 1
                                $sql_score_term_1 = "SELECT
                                                            *
                                                    FROM
                                                            employees emp
                                                    JOIN evaluation_employee ee ON emp.employee_id = ee.employee_id
                                                    JOIN evaluation e ON e.evaluation_code = ee.evaluation_code
                                                    WHERE
                                                           emp.employee_id = '".$_GET["emp_id"]."' AND term_id = 1";
                                        $query_score_term_1 = mysqli_query($conn, $sql_score_term_1);
                                        $result_score_term_1 = mysqli_fetch_array($query_score_term_1);
                                            
                                        $score_1_term_1 = $result_score_term_1["point_kpi"];
                                        if($score_1_term_1 == 0) { $score_1_term_1 = '-'; }
                                        $score_2_1_term_1 = ($result_score_term_1["point_com1_part1"] + $result_score_term_1["point_com2_part1"]) / 2;
                                        if($score_2_1_term_1 == 0) { $score_2_1_term_1 = '-'; }
                                        $score_2_2_term_1 = ($result_score_term_1["point_com1_part2"] + $result_score_term_1["point_com2_part2"] ) / 2;
                                        if($score_2_2_term_1 == 0) { $score_2_2_term_1 = '-'; }
                                        $score_3_term_1 = $result_score_term_1["point_leave"] + $result_score_term_1["point_penalty"];
                                        if($score_3_term_1 == 0 ){ $score_3_term_1 = '-'; }
                                        $sum_score_term_1 = ($score_1_term_1 + $score_2_1_term_1 + $score_2_2_term_1) - $score_3_term_1;
                                        if($sum_score_term_1 == 0){ $sum_score_term_1 = '-'; }
                                //Term 2
                                $sql_score_term_2 = "SELECT
                                                            *
                                                    FROM
                                                            employees emp
                                                    JOIN evaluation_employee ee ON emp.employee_id = ee.employee_id
                                                    JOIN evaluation e ON e.evaluation_code = ee.evaluation_code
                                                    WHERE
                                                            emp.employee_id = '".$_GET["emp_id"]."' AND term_id = 2";
                                        $query_score_term_2 = mysqli_query($conn, $sql_score_term_2);
                                        $result_score_term_2 = mysqli_fetch_array($query_score_term_2);
                                            
                                        $score_1_term_2 = $result_score_term_2["point_kpi"];
                                        if($score_1_term_2 == 0){ $score_1_term_2 = '-'; }
                                        $score_2_1_term_2 = ($result_score_term_2["point_com1_part1"] + $result_score_term_2["point_com2_part1"]) / 2;
                                        if($score_2_1_term_2 == 0){ $score_2_1_term_2 = '-'; }
                                        $score_2_2_term_2 = ($result_score_term_2["point_com1_part2"] + $result_score_term_2["point_com2_part2"] ) / 2;
                                        if($score_2_2_term_2 == 0){ $score_2_2_term_2 = '-'; }
                                        $score_3_term_2 = $result_score_term_2["point_leave"] + $result_score_term_2["point_penalty"];
                                        if($score_3_term_2 == 0){ $score_3_term_2 = '-'; }
                                        $sum_score_term_2 = ($score_1_term_2 + $score_2_1_term_2 + $score_2_2_term_2) - $score_3_term_2;
                                        if($sum_score_term_2 == 0){ $sum_score_term_2 = '-'; }
                                ?>
                                
                                    <tr class="active">
                                        <td colspan="6"></td>
                                    </tr>
                                    <tr class="table-active">
                                        <th colspan="6" class="text-center">ข้อมูลสรุปจะแสดงหลังจากประเมิน ทำการประเมินครบ 2 ครั้ง</th>
                                    </tr>
                                     <tr>
                                        <td align= right><b>สรุปคะแนนตลอดปี (คะแนนสุทธิผู้ประเมินที่ 1 +  คะแนนสุทธิผู้ประเมินที่ 2) หาร 2</b></td>
                                        <td colspan=4 class="text-center" style="background-color:#FFEFD5;"><b><input type="number" name="term1+2point" min="0" max="100" value="<?php echo ($sum_score_m_1+$sum_score_m_2)/2; ?>" disabled></b></td>
                                       
                                    </tr>
                                    <tr>
                                        <td align= right><b>สรุปคะแนนพิจารณาบทลงโทษทางวินัย</b></td>
                                        <td colspan=4 class="text-center" style="background-color:#FAF0E6;"><b><input type="number" name="penaltypoint" min="0" max="100" disabled></b></td>
                                       
                                    </tr>
                                    <tr>
                                        <td align= right><b>สรุปคะแนนประเมินผลงานโดยรวม (Overall rating)</b></td>
                                        <td colspan=4 class="text-center" style="background-color:#F0FFFF;"><b><input type="number" name="allpoint" min="0" max="100" value="<?php echo ($sum_score_m_1+$sum_score_m_2)/2; ?>" disabled></b></td>
                                       
                                    </tr>
                                    <tr class="bg-green">
                                        <td align= center colspan="1"><strong>ผลการประเมิน</strong></td>
                                        <?php 
                                        $sql_grade=" select * from grade where grade_id=$grade_id3" ;
                                        $query_grade = mysqli_query($conn, $sql_grade);
                                                while ($result_grade = mysqli_fetch_array($query_grade, MYSQLI_ASSOC)){
                                                        $name_grade = $result_grade['grade_description'];
                                                }                     
                                                ?>
                                                <td colspan=4 class="text-center"><strong><?php if($grade_id3==0){echo 'F'; }else{ echo $name_grade;}  ?></strong></td>
                                    </tr>
                                </tbody>
                                
                            </table>
                        </div>
                            <div class="box-footer">
                                <div class="pull-right box-padding">
                                   <!-- <button class="btn btn-foursquare" type="submit" ="window.location.href='compareevaluation.php'"  >เปรียบเทียบย้อนหลัง</button> -->
                                </div>
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
