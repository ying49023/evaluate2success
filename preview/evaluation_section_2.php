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
    
        //Get Position Level
        if(isset($_GET["position_level_id"])){
            $level = $_GET["position_level_id"];
        }
         
    ?>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>ระบบประเมินผลปฏิบัติงาน : ALT Evaluation</title>
        <!-- CSS PACKS -->
        <?php include ('./css_packs.html'); ?>
        <!--ListJS-->
        <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.2.0/list.min.js"></script>
        
        <style type="text/css">    
            table.table tr td,th{
                text-align: center;
            }
        </style>  
            
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

                        $sql_level = "SELECT * FROM position_level WHERE position_level_id = '$level'" ; 
                        $query_level = mysqli_query($conn, $sql_level);
                        $result_level = mysqli_fetch_array($query_level,MYSQLI_ASSOC);
                        $level_name = $result_level["position_description"];
                    ?>
                        <div class="box-header with-border">
                            <b>การจัดการแบบประเมินระดับ<?php echo $level_name; ?></b>
                            
                            
                        </div>
                        
                        <div class="box-body">
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
                                                        m.position_level_id = '$level'
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
                                            WHERE m.position_level_id='$level' and t.title_id = '$result_title_id' and m.status=1 ";
                                $query_mng= mysqli_query($conn, $sql_mng);
                                $no=0;
                                ?>
                                    <table class="table table-hover table-responsive table-striped table-bordered">                               
                                        <thead>
                                            <tr>
                                                <th rowspan="2" >ข้อที่</th>
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
                                            $m_title = $result_mng["title_name"];
                                            $m_detail = $result_mng["detail"];
                                            $m_position = $result_mng["position"];
                                            $m_weight = $result_mng["weight"];
                                            $m_com = $result_mng["competency_id"];
                                            $no++;
                                            ?>
                                        
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td style="text-align: left;"><?php echo $m_detail; ?></td>
                                                <td style="text-align: center;"><?php echo $m_weight; ?></td>
                                                <td style="text-align: center;">
                                                    <?php
                                                    $sql_score1 = "
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
                                                            WHERE mc.competency_id = $m_com AND mc.position_level_id = '$level' AND mc.status=1";
                                                    $query_score1= mysqli_query($conn, $sql_score1);
                                                            ?>
                                                            <select class="form-control" id="score1" onchange="show_selected()" >
                                                                <option value=""> </option>
                                                                        <?php while ($result_score1 = mysqli_fetch_array($query_score1)) { ?>
                                                                <option value="<?php echo $result_score1["score"]; ?>">
                                                                                <?php  echo $result_score1["score"]; ?>
                                                                </option>
                                                                        <?php } ?>
                                                            </select>
                                                </td>
                                                <script>       
                                                    function show_selected() {
                                                                        var selector = document.getElementById('score1');
                                                                        var value = selector[selector.selectedIndex].value;
                                                                        document.getElementById('display').innerHTML = value*<?php echo $m_weight ; ?>;
                                                                    }                                                    
                                                </script>
                                                <td style="text-align: center;"><p id="display"></p></td>
                                                <td style="text-align: center;" ><?php echo $m_weight; ?></td>
                                                <td style="text-align: center;">
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
                                                            WHERE mc.competency_id = $m_com AND mc.position_level_id = '$level' AND mc.status=1";
                                                    $query_score2= mysqli_query($conn, $sql_score2);
                                                            ?>
                                                            <select class="form-control" name="score2" >
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
                                                <td style="text-align: center;"><?php echo $m_weight*$result_score2; ?></td>
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
                                                            WHERE mc.competency_id = $m_com AND mc.position_level_id = '$level' AND mc.status=1";
                                                    $query_pointdetail= mysqli_query($conn, $sql_pointdetail);

                                                    ?>
                                                <?php while($result_pointdetail = mysqli_fetch_array($query_pointdetail, MYSQLI_ASSOC))  {
                                                    $maxscore = $result_pointdetail["maxscore"];
                                                    $comp_id=$result_pointdetail["competency_id"];
                                                    $point_score=$result_pointdetail["point_score"];
                                                    $point_description=$result_pointdetail["point_description"];
                                                    $comp_description=$result_pointdetail["competency_description"];
                                                    
                                                    ?>
                                                <td style="text-align: center;">
                                                    <a data-toggle="modal" href="#view_point<?php echo $comp_id;?>_<?php echo $level;?>" class="glyphicon glyphicon-eye-open"></a>
                                                    <!-- Veiw Score-->   
                                                    <div class="modal animated fade " id="view_point<?php echo $comp_id;?>_<?php echo $level;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content ">

                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title" id="myModalLabel">คำอธิบายคะแนน <?php echo $comp_description; ?></h4>
                                                                </div>
                                                                <div class="modal-body ">
                                                                    <div class="row">
                                                                        <div class="col-sm-12">
                                                                           
                                                                            <table class="table table-hover table-responsive table-striped table-bordered">                               
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
                                                                                        mc.competency_id = '$m_com'
                                                                                AND mc.position_level_id = '$level'
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
                                                                    
                                                                    
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
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
                                <button class="btn-success btn-lg" >บันทึก</button>  
                                <button class="btn-danger btn-lg" >รีเซ็ท</button> 
                                </div>
                            </div>
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