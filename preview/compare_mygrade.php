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
        
        
        $eval = ' eval_code = 3';
        $get_eval_code = '3';
        if(isset($_GET["eval_code"])){
            $get_eval_code = $_GET["eval_code"];
            $eval = " eval.evaluation_code = '".$get_eval_code ."'";
        }
        $eval2='eval_code = 3';
        $get_eval_code2 = '4';
        if(isset($_GET["eval_code2"])){
            $get_eval_code2 = $_GET["eval_code2"];
            $eval2 = " eval.evaluation_code = '".$get_eval_code2 ."'";
        }
        
        $condition = 'WHERE eval.evaluation_code = 3 ';
        
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
                    <small>ย้อนหลัง</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="#"> <i class="fa fa-dashboard"></i>
                            Home
                        </a>
                    </li>
                    <li class="active">Summary evaluation</li>
                </ol>
            </section>
            <!--/Page header -->

            <!-- Main content -->
            <!--list employee-->
            <div class="row box-padding">
                <div class="box box-success">
                     <div class="box-body ">
                            <form method="get">
                                <div class="col-md-11">
                                    <label class="col-sm-1 control-label">รอบ</label>
                                    <div class="col-sm-4">
                                    <?php 
                                        $sql_eval = "SELECT * FROM evaluation where year<=YEAR(CURDATE())  ORDER BY year , term_id ASC";
                                        $query_eval = mysqli_query($conn, $sql_eval);
                                    ?>
                                        <select class="form-control" name="eval_code">
                                            <option value="">กรุณาเลือก</option>
                                        <?php while($result_eval = mysqli_fetch_array($query_eval,MYSQLI_ASSOC)) { ?>
                                            <option value="<?php echo $result_eval["evaluation_code"]; ?>" <?php if($get_eval_code == $result_eval["evaluation_code"]) { echo "selected"; }  ?> >
                                                <?php echo 'ปี '.$result_eval["year"]." - ครั้งที่".$result_eval["term_id"]; ?>
                                            </option>
                                        <?php } ?>
                                        </select>
                                    </div>
                                    <label class="col-sm-1 control-label">รอบ</label>
                                    <div class="col-sm-4">
                                    <?php 
                                        $sql_eval2 = "SELECT * FROM evaluation where year<=YEAR(CURDATE())  ORDER BY year , term_id ASC";
                                        $query_eval2 = mysqli_query($conn, $sql_eval2);
                                    ?>
                                        <select class="form-control" name="eval_code2">
                                            <option value="">กรุณาเลือก</option>
                                        <?php while($result_eval2 = mysqli_fetch_array($query_eval2,MYSQLI_ASSOC)) { ?>
                                            <option value="<?php echo $result_eval2["evaluation_code"]; ?>" <?php if($get_eval_code2 == $result_eval2["evaluation_code"]) { echo "selected"; }  ?> >
                                                <?php echo 'ปี '.$result_eval2["year"]." - ครั้งที่".$result_eval2["term_id"]; ?>
                                            </option>
                                        <?php } ?>
                                        </select>
                                    </div>
                                </div>                                
                                
                                <div class=" col-md-1">
                                    <input type="submit" class="btn btn-primary search-button " value="ค้นหา" >
                                </div>

                            </form>
                        </div>
                </div>
            </div>
            <div class="row box-padding">
                
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <?php 
                         $show_term = "SELECT CONCAT('เทอม ',term_id,'  ปี  ' ,year ) as termname 
                             FROM evaluation 
                             where evaluation_code=$get_eval_code ";
                         $query_term = mysqli_query($conn, $show_term);
                         $result_term = mysqli_fetch_array($query_term);
                         $termname=$result_term['termname'];
                          
                        ?>
                        <h4><?php echo $termname; ?></h4>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"> 
                                <i class="fa fa-minus"></i>
                            </button>
                                
                            <button type="button" class="btn btn-box-tool" data-widget="remove">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                        <form method="get" action="compare_mygrade.php" >
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
                                                               ee.evaluation_code= $get_eval_code and ee.employee_id = $my_emp_id";
                                    $query_score = mysqli_query($conn, $sql_score);
                                     $sql_pos = "select * from employees where employee_id=$my_emp_id";
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
                                                           emp.employee_id = $my_emp_id AND term_id = 1";
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
                                                            emp.employee_id = $my_emp_id AND term_id = 2";
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
                                                <td colspan=5 class="text-center"><strong><?php if($grade_id3==0){echo 'F'; }else{ echo $name_grade;}  ?></strong></td>
                                    </tr>
                                </tbody>
                                
                            </table>
                        </div>
                            
                        </form>
                    </div>
            </div>
            
            
            
            
            <div class="row box-padding">
                
                <div class="box box-primary">
                    <div class="box-header with-border">
                       <?php 
                         $show_term2 = "SELECT CONCAT('เทอม ',term_id,'  ปี  ' ,year ) as termname 
                             FROM evaluation 
                             where evaluation_code=$get_eval_code2 ";
                         $query_term2 = mysqli_query($conn, $show_term2);
                         $result_term2= mysqli_fetch_array($query_term2);
                         $termname2=$result_term2['termname'];
                          
                        ?>
                        <h4><?php echo $termname2; ?></h4>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"> 
                                <i class="fa fa-minus"></i>
                            </button>
                                
                            <button type="button" class="btn btn-box-tool" data-widget="remove">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                        <form method="get" action="compare_mygrade.php" >
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
                                                               ee.evaluation_code= $get_eval_code2 and ee.employee_id = $my_emp_id";
                                    $query_score = mysqli_query($conn, $sql_score);
                                     $sql_pos = "select * from employees where employee_id=$my_emp_id";
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
                                                           emp.employee_id = $my_emp_id AND term_id = 1";
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
                                                            emp.employee_id = $my_emp_id AND term_id = 2";
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
                                                <td colspan=5 class="text-center"><strong><?php if($grade_id3==0){echo 'F'; }else{ echo $name_grade;}  ?></strong></td>
                                    </tr>
                                </tbody>
                                
                            </table>
                        </div>
                            
                        </form>
                    </div>
            </div>
            <!--/list employee-->

            <!-- /.content --> </div>
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