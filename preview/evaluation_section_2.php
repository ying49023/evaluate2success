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
    <?php include ('./classes/connection_mysqli.php');
        //Get Employee id
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
        if(isset($_SESSION["position"])){
            $level = $_SESSION["position"];
        }
        
        if(isset($_POST['comp_id'])&&isset($_POST['score_huahna1'])){
            //$pdo = new PDO('mysql:host=103.27.202.37;dbname=prasukrit_evaluate2success', "prasukrit_alt", "13579alt");           
            $array_h[] = array();
            $c=0;
            foreach ($_POST['score_huahna1'] as $score_huahna1){
                $array_h[$c]=$score_huahna1;
                $c++;
            }
            $i=0;
            foreach ($_POST['comp_id'] as $compId){
                $positionID=$_SESSION['position'];
                $e_code=$_POST['evalcode'];
                $emp=$_SESSION['emp_id'];
                //echo $compId.' '.$_GET['eval_code'].' '.$_GET['emp_id'].' '.$_GET['position_level_id'].' score '.$array_h[$i].' | ';
               $sql_insert="INSERT INTO evaluation_competency (
                                                    evaluation_competency_id,
                                                    evaluate_employee_id,
                                                    point_assessor1,
                                                    point_assessor2,
                                                    COMMENT,
                                                    manage_comp_id
                                            )
                                            VALUES
                                                    (
                                                            DEFAULT,
                                                            (
                                                                    SELECT
                                                                            evaluate_employee_id
                                                                    FROM
                                                                            evaluation_employee
                                                                    WHERE
                                                                            employee_id = $emp
                                                                    AND evaluation_code = $e_code
                                                            ),
                                                            $array_h[$i],
                                                            0,
                                                            ' ',
                                                            (
                                                                    SELECT
                                                                            manage_comp_id
                                                                    FROM
                                                                            manage_competency
                                                                    WHERE
                                                                            competency_id = $compId
                                                                    AND position_level_id = $positionID
                                                                    AND evaluation_code = $e_code
                                                            )
                                                    )";
               $query_insert=  mysqli_query($conn, $sql_insert);
               if ($query_insert)
                            echo "Record update successfully";
                        else {
                            $msg = 'Error :' . mysql_error();
                            echo "Error Save [" . $sql_insert . "]";
                        }
                $sql_max_compId = "select max(evaluate_employee_id) as max_compId from evaluation_competency";  
                $query_max_compId=  mysqli_query($conn, $sql_max_compId);
                $max_compId=0;//8

                while ($result_max_compId = mysqli_fetch_array($query_max_compId, MYSQLI_ASSOC)) {  
                                        $max_compId = $result_max_compId['max_compId'];
                                      
                }
                
                
                /*$query_insert =$pdo->prepare("INSERT INTO evaluation_competency (
                                                    evaluation_competency_id,
                                                    evaluate_employee_id,
                                                    point_assessor1,
                                                    point_assessor2,
                                                    COMMENT,
                                                    manage_comp_id
                                            )
                                            VALUES
                                                    (
                                                            DEFAULT,
                                                            (
                                                                    SELECT
                                                                            evaluate_employee_id
                                                                    FROM
                                                                            evaluation_employee
                                                                    WHERE
                                                                            employee_id = $emp
                                                                    AND evaluation_code = $e_code
                                                            ),
                                                            $array_h[$i],
                                                            0,
                                                            ' ',
                                                            (
                                                                    SELECT
                                                                            manage_comp_id
                                                                    FROM
                                                                            manage_competency
                                                                    WHERE
                                                                            competency_id = $compId
                                                                    AND position_level_id = $positionID
                                                                    AND evaluation_code = $e_code
                                                            )
                                                    )");
                $query_insert->bindParam(':comp_id',$compId);
                $query_insert->bindParam(':positionID',$positionID);
                $query_insert->bindParam(':e_code',$e_code);
                $query_insert->bindParam(':emp',$emp);
                $query_insert->bindParam(':huahna_score',$huahna_score);
                $query_insert->execute();      */                 
                
                /*$query_update =$pdo->prepare("UPDATE 	evaluation_employee 
                                                SET 	point_competency1=( SELECT sum(point_assessor1) 
                                                                        FROM evaluation_competency 
                                                                        WHERE  evaluate_employee_id = 9), 
                                                        point_competency2=( SELECT sum(point_assessor2) 
                                                                        FROM evaluation_competency 
                                                                        WHERE  evaluate_employee_id = 9)
                                                   WHERE evaluate_employee_id = 9");
                */
                
                $i++;
              
            }
            $sql_update="UPDATE evaluation_employee SET point_competency1=(
                        SELECT sum(mc.weight*ec.point_assessor1)
                        FROM manage_competency mc JOIN evaluation_competency ec
                        ON mc.manage_comp_id = ec.manage_comp_id
                        WHERE ec.evaluate_employee_id='".$_SESSION["eval_emp_id"]."')
                        WHERE evaluate_employee_id='".$_SESSION["eval_emp_id"]."'";
                $query_update=  mysqli_query($conn, $sql_update);
                if ($query_update) {
                    echo "Record update successfully";
                    header("location:evaluation_section_3.php");
                } else {
                    $msg = 'Error :' . mysql_error();
                    echo "Error Save [" . $sql_update . "]";
                }
            }
         
    ?>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>ระบบประเมินผลปฏิบัติงาน : ALT Evaluation</title>
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
                    
                    <h1>ส่วนที่ 2 พฤติกรรมในการทำงานของพนักงาน (Competency) </h1>
                        
                    <ol class="breadcrumb">
                        <li>
                            <a href="#"> <i class="fa fa-dashboard"></i>
                                Home
                            </a>
                        </li>
                        <li class="active">Evaluation</li>
                    </ol>
                </section>
                <!--/Page header -->
                    
                <!-- Main content -->
                <div class="row box-padding ">
                    <!-- Brief Info Profile Employee  -->
                    <?php include './breif_info_profile_eval.php'; ?>
                    <!-- /Brief Info Profile Employee  -->
                    
                    <!-- Navbar process -->
                    <?php include './navbar_process.php'; ?>
                    <!-- /Navbar process -->
                    <!-- Part 2 -->
                    <div class="box box-primary">
                        <script type="text/javascript">
                            //Script สำหรับ เลือก dropdown menu แบบไม่ต้องกด submit จะเปลี่ยนข้อมูลแบบ " A U T O "
                            function position_level()
                            {
                                document.form_name.submit();
                            };
                        </script>
                        <!--box-body-->
                        
                        <!-- ./box-body -->                 
                    
                    <?php
                    if($level != '') {

                        $sql_level = "SELECT * FROM position_level WHERE position_level_id = '".$_SESSION["position"]."'" ; 
                        $query_level = mysqli_query($conn, $sql_level);
                        $result_level = mysqli_fetch_array($query_level,MYSQLI_ASSOC);
                        $level_name = $result_level["position_description"];
                    ?>
                        <div class="box-header with-border">
                            <b>การจัดการแบบประเมินระดับ<?php echo $level_name; ?></b>
                            
                            
                        </div>
                        
                        <div class="box-body">
                            <form method="post" >
                            <div class="row"> 
                                <?php

                                $sql_title =    "SELECT
                                                        t.title_id AS title_id,
                                                        t.title_name AS title_name,
                                                        SUM(m.weight*5) as sumweight
                                                FROM
                                                        competency_title t
                                                JOIN competency c ON c.title_id = t.title_id 
                                                JOIN manage_competency m ON c.competency_id = m.competency_id
                                                WHERE
                                                        m.position_level_id = '".$_SESSION["position"]."'
                                                AND m.STATUS = 1 
                                                GROUP BY t.title_name";

                                $query_title= mysqli_query($conn, $sql_title);
                                
                                while ($result_title = mysqli_fetch_array($query_title, MYSQLI_ASSOC))  {
                                        $result_title_id = $result_title["title_id"];
                                        $result_title_name = $result_title["title_name"];
                                        $result_title_sum = $result_title["sumweight"];
                                    
                                 ?> 
                                <div class="col-md-12">
                                    <div class="col-md-12 bg-blue-active" style=" height:40px;" >                                        
                                                                                           
                                        <h4>
                                            <?php echo $result_title_name." | Total Weight: ".$result_title_sum." %" ;?> 
                                            
                                        </h4>
                                    </div>
                                    
                                </div>
                            
                            
                                <div class="col-md-12">
                                    <?php
                                $sql_mng = "
                                    SELECT 
                                            m.manage_comp_id As manage_comp_id,
                                            c.competency_description As detail,
                                            t.title_name As title_name,
                                            p.position_description As position,
                                            m.weight As weight,
                                            c.competency_id As competency_id
                                            FROM manage_competency m 
                                            JOIN competency c ON m.competency_id=c.competency_id 
                                            JOIN competency_title t ON c.title_id=t.title_id 
                                            JOIN position_level p ON p.position_level_id=m.position_level_id 
                                            WHERE m.position_level_id='".$_SESSION["position"]."' and t.title_id = '$result_title_id' and m.status=1 ";
                                $query_mng= mysqli_query($conn, $sql_mng);
                                $no=0;
                                ?>
                                    <table class="table table-hover table-responsive table-striped table-bordered">                               
                                        <thead>
                                            <tr>
                                                <th rowspan="2" style="width: 50px;">ข้อที่</th>
                                                <th style="text-align: left;" rowspan="2" >หัวข้อ</th>
                                                <th   colspan="3" >ผู้ประเมิน1</th>
                                                <th   colspan="3">ผู้ประเมิน2</th>
                                                <th style="width: 70px;text-align: center;" rowspan="2" >คำอธิบายคะแนน</th>
                                                

                                            </tr>
                                            <tr>                                                
                                                <th style="width: 70px;text-align: center;"  >น้ำหนัก</th>
                                                <th style="width: 70px;text-align: center;" >คะแนน</th>
                                                <th style="width: 70px;text-align: center;" >รวม</th>
                                                <th style="width: 70px;text-align: center;"  >น้ำหนัก</th>
                                                <th style="width: 70px;text-align: center;" >คะแนน</th>
                                                <th style="width: 70px;text-align: center;" >รวม</th>
                                                

                                            </tr>
                                        </thead>
                                        <tbody class="list">
                                        <?php while ($result_mng = mysqli_fetch_array($query_mng, MYSQLI_ASSOC))  {
                                            $m_id = $result_mng["manage_comp_id"];
                                            //$m_title = $result_mng["title_name"];
                                            $m_detail = $result_mng["detail"];
                                            $m_position = $result_mng["position"];
                                            $m_weight = $result_mng["weight"];
                                            $m_com = $result_mng["competency_id"];
                                            
                                            $no++;
                                            ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td style="text-align: left;"><?=$m_detail ?></td>
                                                <td id="<?=$m_id?>weight<?=$no?>" value="<?=$m_weight?>" style="text-align: center;"><?=$m_weight?></td>
                                                
                                                <!-- เช็คคนประเมิน -->
                                                <?php
                                                $employee_id_com =$_SESSION["emp_id"];
                                                    $sql_huahna = "
                                                        SELECT
                                                            e.employee_id AS looknong,
                                                            m.employee_id AS huahna1,
                                                            (
                                                                    SELECT
                                                                            m2.manager_id
                                                                    FROM
                                                                            employees m2
                                                                    WHERE
                                                                            m2.employee_id = m.employee_id
                                                            ) AS huahna2
                                                    FROM
                                                            employees e
                                                    JOIN employees m ON e.manager_id = m.employee_id
                                                    WHERE
                                                            e.employee_id = '$employee_id_com' ";
                                                   $query_huahna= mysqli_query($conn, $sql_huahna);
                                                   $huahna1=0;
                                                   $huahna2=0;
                                                   
                                                   
                                                   ?>
                                                <?php  while($result_huahna = mysqli_fetch_assoc($query_huahna)){ 
                                                    $huahna1 = $result_huahna["huahna1"];
                                                    $huahna2 = $result_huahna["huahna2"];                                                                
                                                }?>
                                                <!-- คนประเมิน1 -->
                                                <?php
                                                    $sql_score1 = "
                                                        SELECT 
                                                            cp.point_score as score
                                                            FROM  competency_point cp 
                                                            JOIN match_competency_point mcp 
                                                            ON cp.point_id = mcp.point_id 
                                                            JOIN manage_competency mc 
                                                            ON mcp.manage_comp_id = mc.manage_comp_id 
                                                            JOIN competency c 
                                                            ON c.competency_id = mc.competency_id
                                                            WHERE mc.competency_id = '".$_SESSION["comp_id"]."' AND mc.position_level_id = '".$_SESSION["position"]."' AND mc.status= 1";
                                                    $query_score1= mysqli_query($conn, $sql_score1);
                                                            ?>
                                                <td style="text-align: center;">
                                                    
                                                    <?php if($my_emp_id==$huahna1){?>
                                                    <select name="score_huahna1[]" class="form-control" required id="score<?=$m_id?>_1" onchange="show_selected('<?=$m_id?>weight<?=$no?>', 'display<?=$m_id?>_1', 'score<?=$m_id?>_1')" >
                                                                <option value=""> </option>
                                                                        <?php while ($result_score1 = mysqli_fetch_array($query_score1)) { ?>
                                                                <option value="<?php echo $result_score1["score"]; ?>"  >
                                                                                <?php  echo $result_score1["score"]; ?>
                                                                </option>
                                                                        <?php } ?>
                                                            </select>
                                                    <?php }else {?>
                                                    <select disabled="true" class="form-control" id="score<?=$m_id?>" onchange="show_selected('<?=$m_id?>weight<?=$no?>', 'display<?=$m_id?>', 'score<?=$m_id?>')" >
                                                                <option value=""> </option>
                                                                        <?php while ($result_score1 = mysqli_fetch_array($query_score1)) { ?>
                                                                <option value="<?php echo $result_score1["score"]; ?>">
                                                                                <?php  echo $result_score1["score"]; ?>
                                                                </option>
                                                                        <?php } ?>
                                                            </select>
                                                    <?php } ?>
                                                </td>
                                                <script>       
                                                    function show_selected(name, display, score) {
                                                        var selector = document.getElementById(score);
                                                        var value = selector[selector.selectedIndex].value;
                                                        var weight = document.getElementById(name).innerText;
                                                        document.getElementById(display).innerHTML = (value * weight).toFixed(1);;
                                                    }                                                    
                                                </script>
                                                
                                                <td style="text-align: center;"><p id="display<?=$m_id?>_1"></p></td>                                                                            
                                                <td style="text-align: center;" ><?php echo $m_weight; ?></td>
                                                <!-- คนประเมิน2 -->
                                                <?php
                                                    $score2=0;
                                                    $sql_score2 = "
                                                        SELECT 
                                                            c.title_id,c.competency_description,mc.weight,mcp.point_id
                                                            ,cp.point_score as score, cp.point_description,c.competency_id
                                                            FROM  competency_point cp 
                                                            JOIN match_competency_point mcp 
                                                            ON cp.point_id = mcp.point_id 
                                                            JOIN manage_competency mc 
                                                            ON mcp.manage_comp_id = mc.manage_comp_id 
                                                            JOIN competency c 
                                                            ON c.competency_id = mc.competency_id
                                                            WHERE mc.competency_id = '".$_SESSION["comp_id"]."' AND mc.position_level_id = '".$_SESSION["position"]."' AND mc.status=1";
                                                    $query_score2= mysqli_query($conn, $sql_score2);
                                                            ?>
                                                <?php if($my_emp_id==$huahna2){?>
                                                <td style="text-align: center;">                                                    
                                                    <select class="form-control" id="score<?=$m_id?>_2" required onchange="show_selected('<?=$m_id?>weight<?=$no?>', 'display<?=$m_id?>_2', 'score<?=$m_id?>_2')" >
                                                                <option value=""> </option>
                                                                        <?php while ($result_score2 = mysqli_fetch_array($query_score2)) {
                                                                            $score2=$result_score2["score"];
                                                                            ?>
                                                                <option value="<?php echo $score2; ?>">
                                                                                <?php  echo $score2; ?>
                                                                </option>
                                                                        <?php } ?>
                                                            </select>
                                                </td>
                                                <?php }else{?>
                                                <td style="text-align: center;">                                                    
                                                    <select class="form-control" name="score2" disabled="true" >
                                                                <option value=""> </option>
                                                                        <?php while ($result_score2 = mysqli_fetch_array($query_score2)) {
                                                                            $score2=$result_score2["score"];
                                                                            ?>
                                                                <option value="<?php echo $score2; ?>">
                                                                                <?php  echo $score2; ?>
                                                                </option>
                                                                        <?php } ?>
                                                            </select>
                                                </td>
                                                <?php }?>
                                                <td style="text-align: center;"><p id="display<?=$m_id?>_2"></p></td>
                                                
                                                    <?php
                                                    $sql_pointdetail = "
                                                        SELECT 
                                                            c.title_id,c.competency_description,mc.weight,mcp.point_id
                                                            ,cp.point_score, cp.point_description,max(cp.point_score) as maxscore
                                                            ,c.competency_id
                                                            FROM  competency_point cp 
                                                            JOIN match_competency_point mcp 
                                                            ON cp.point_id = mcp.point_id 
                                                            JOIN manage_competency mc 
                                                            ON mcp.manage_comp_id = mc.manage_comp_id 
                                                            JOIN competency c 
                                                            ON c.competency_id = mc.competency_id
                                                            WHERE mc.competency_id = '".$_SESSION["comp_id"]."' AND mc.position_level_id = '".$_SESSION["position"]."' AND mc.status=1";
                                                    $query_pointdetail= mysqli_query($conn, $sql_pointdetail);

                                                    ?>
                                                <?php while($result_pointdetail = mysqli_fetch_array($query_pointdetail, MYSQLI_ASSOC))  {
                                                    $maxscore = $result_pointdetail["maxscore"];
                                                    $comp_id=$result_pointdetail["competency_id"];
                                                    $point_score=$result_pointdetail["point_score"];
                                                    $point_description=$result_pointdetail["point_description"];
                                                    $comp_description=$result_pointdetail["competency_description"];
                                                    
                                                    ?>
                                                <!-- comp_id loop -->
                                                <input type="hidden" name="comp_id[]" value="<?php echo $comp_id;?>">
                                                <!-- comp_id loop -->
                                                <td style="text-align: center;">
                                                    <a class="btn btn-warning btn-sm" data-toggle="modal" href="#view_point<?php echo $comp_id;?>_<?php echo $level;?>" ><i class="glyphicon glyphicon-eye-open"></i></a>
                                                    <!-- Veiw Score-->   
                                                    <div class="modal animated fade " id="view_point<?php echo $comp_id;?>_<?php echo $level;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content ">

                                                                <div style="padding: 20px 30px 20px 30px;" class="modal-header bg-yellow box-padding">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title" id="myModalLabel">คำอธิบายคะแนน <?php echo $comp_description; ?></h4>
                                                                </div>
                                                                <div class="modal-body ">
                                                                    <div class="row box-padding">
                                                                        <div class="col-sm-12">
                                                                           
                                                                            <table class="table table-hover table-responsive table-striped table-bordered table-sm">                               
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>คะแนน</th>
                                                                                    <th>คำอธิบาย</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <?php
                                                                            $sql_pointdetail_sub = "
                                                                                SELECT
                                                                                        c.title_id,
                                                                                        c.competency_description,
                                                                                        mc.weight,
                                                                                        mcp.point_id,
                                                                                        cp.point_score,
                                                                                        cp.point_description,
                                                                                        c.competency_id
                                                                                FROM
                                                                                        competency_point cp
                                                                                JOIN match_competency_point mcp ON cp.point_id = mcp.point_id
                                                                                JOIN manage_competency mc ON mcp.manage_comp_id = mc.manage_comp_id
                                                                                JOIN competency c ON c.competency_id = mc.competency_id
                                                                                WHERE
                                                                                        mc.competency_id = '".$_SESSION["comp_id"]."'
                                                                                AND mc.position_level_id = '".$_SESSION["position"]."'
                                                                                AND mc. STATUS = 1";
                                                                            $query_pointdetail_sub= mysqli_query($conn, $sql_pointdetail_sub);
                                                                            ?>
                                                                            <tbody>
                                                                                <?php  while($result_pointdetail_sub = mysqli_fetch_array($query_pointdetail_sub,MYSQLI_ASSOC)) { ?>
                                                                                <tr class="text-left">
                                                                                    <td><?php echo $result_pointdetail_sub["point_score"]; ?></td>
                                                                                    <td style="text-align: left;"><?php echo $result_pointdetail_sub["point_description"]; ?></td>

                                                                                </tr>
                                                                                <?php } ?>
                                                                            </tbody>
                                                                            
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">                                                            
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
                                                                </div>                 
                                                            </div>
                                                        </div>  
                                                    </div>
                                                    <!--/Veiw Score-->
                                                </td>
                                                
                                                <?php } ?> <!--/score--> 
                                                
                                                
                                            </tr>
                                            
                                        <?php } ?>
                                        </tbody>
                                    </table>

                                </div>
                                <?php } ?> 
                                <div class="col-md-12 text-center">
                                    <button class="btn btn-success btn-lg search-button" type="submit" >บันทึก</button>  
                                    <button class="btn btn-danger btn-lg search-button" type="reset" >รีเซ็ท</button> 
                                    <input type="hidden" name="position_level" value="<?php=$level?>" >
                                    <input type="hidden" name="emp" value="<?php=$my_emp_id?>" >
                                    <input type="hidden" name="evalcode" value="<?php echo $_SESSION["eval_code"];  ?>" >
                                </div>
                            </div>
                            </form>    
                        </div>
                    
                    <?php } else {
                    ?>
                    
                        <div class="box-body">
                            <div class="box-padding text-center">
                                <p><i class="glyphicon glyphicon-warning-sign"></i>ไม่มีข้อมูล กรุณาเลือกระดับ</p>
                            </div>
                        </div>
                    
                    <?php
                    }
                    ?>
                    </div>
                    <!-- /Part 2 -->
                </div>

            </div><!-- /.content-wrapper -->
        <!-- Control Sidebar -->
        <?php include './controlsidebar.php'; ?>
            
        <!--Footer -->
        <?php include './footer.php'; ?>
            
            <!-- Add the sidebar's background. This div must be placed
                     immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
        <!--Finish body content-wrapper-->
        </div><!-- ./wrapper -->   
    </body>
    <!-- SCRIPT PACKS -->
<?php include('./script_packs.html') ?>
</html>
            <?php
        }
    }

    
?>