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
        <?php include('./classes/connection_mysqli.php') ?>
        <?php 
        if (isset($_GET['level'])) {
        $level = $_GET['level'];
        }
        if (isset($_GET['level_name'])) {
            $level_name = $_GET['level_name'];
        }

        //Insert Detail
        if(isset($_GET["submit_insert"])){
            $level_name=$_GET['name'];
            $detail=$_GET["competency_detail"];
            $title = $_GET["competency_title"];
            $status=1;
            $position=$level; 
            $weight=$_GET["t_weight"];
            $sql_insert_group = "INSERT INTO manage_competency(competency_id,status,position_level_id,weight) VALUES($detail,$status,$position,$weight)";
            if (mysqli_query($conn, $sql_insert_group)) {
                    echo "Record new successfully";
                    echo $sql_insert_group;
                } else {
                    echo "Error new record: " . mysqli_error($conn);
                    echo $sql_insert_group;
                }
                    
                header("Location: competency_match.php?level=$position&level_name=$level_name");
            }
        //Edit
        if(isset($_GET["submit_edit"])){
            
            $e_title=$_GET["edit_title"];
            $e_weight= $_GET["edit_weight"];
            $e_id=$_GET["edit_id"];
            $e_detail=$_GET["competency_id"];
            
            $level_name=$_GET['name'];
            $level=$_GET['level'];
            
            $sql_edit_group = "UPDATE manage_competency SET competency_id='$e_detail', weight='$e_weight', status=1 WHERE manage_comp_id='$e_id' and position_level_id = '$level' ";
            if (mysqli_query($conn, $sql_edit_group)) {
                    echo "Record edit successfully";
                    echo $sql_edit_group;
                } else {
                    echo "Error edit record: " . mysqli_error($conn);
                    echo $sql_edit_group;
                }
                    
                header("Location: competency_match.php?level=$level&level_name=$level_name");
            }
        //Delete หัวข้อ
        if(isset($_GET["delete_title"])){
            $title_id=$_GET["title_id"];
            $level_name=$_GET['level_name'];
            $level=$_GET['level'];
            $sql_delete_title = "DELETE FROM manage_competency WHERE title_id = $title_id";
            if (mysqli_query($conn, $sql_delete_title)) {
                    echo "Record new successfully";
                    echo $sql_delete_title;
                } else {
                    echo "Error new record: " . mysqli_error($conn);
                    echo $sql_delete_title;
                }
                    
               header("Location: competency_match.php?level=$level&level_name=$level_name");
        }
        //Delete ข้อย่อย
        if(isset($_GET["delete_group"])){
            $d_id=$_GET["match_id"];
            $level_name=$_GET['level_name'];
            $level=$_GET['level'];
            $sql_delete_group = "UPDATE manage_competency SET status=0 WHERE manage_comp_id='$d_id'";
            if (mysqli_query($conn, $sql_delete_group)) {
                    echo "Record new successfully";
                    echo $sql_delete_group;
                } else {
                    echo "Error new record: " . mysqli_error($conn);
                    echo $sql_delete_group;
                }
                    
               header("Location: competency_match.php?level=$level&level_name=$level_name");
        }
                
        ?>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>ระบบประเมินผลปฏิบัติงาน : ALT Evaluation</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!--CSS PACKS -->
        <?php include ('./css_packs.html'); ?>
        
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
        <!--Header part-->
        <?php include './headerpart.php'; ?>
        <!-- Left side column. contains the logo and sidebar -->
        <?php include './sidebarpart.php'; ?>
        <!--Call function confirm delete Example : <a data-target="#confirm-delete" data-href="???" data-toggle="modal"  >Link</a>   -->
        <?php include('./modal_delete.php');?>
                    
            <!-- Content Wrapper. Contains page content แก้เนื้อหาแต่ละหน้าตรงนี้นะ -->
            <div class="content-wrapper">
            
                <!-- Content Header (Page header)  -->
                <section class="content-header">
                    <h1>
                        Competency 
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="#"> <i class="fa fa-dashboard"></i>
                                Home
                            </a>
                        </li>
                        <li class="active">Competency</li>
                    </ol>
                </section>
                <!--/Page header -->
                
                <!-- Main content -->
                <div class="row box-padding">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <b>การจัดการแบบประเมินระดับ<?php echo $level_name;?></b>
                            <button class="btn btn-success pull-right"  data-toggle="collapse" data-target="#newKPIGroup">+ เพิ่มหัวข้อ</button>
                            
                        </div>
                        <!--New -->
                        <div id="newKPIGroup" class="collapse">
                            <form action="" method="get">
                                <div class="box-padding row">
                                    <div class="form-group col-sm-4">
                                    <?php
                                    //INSERT INTO match_competency(competency_id,title_id,status,position_level_id,weight) VALUES(19,17,0,1,10)
                                    $sql_competency_title = "SELECT * FROM competency_title  ";
                                    $query_competency_title  = mysqli_query($conn, $sql_competency_title );
                                    ?>
                                        <label>Title<span style="color: red;">*</span></label>
                                        <select class="form-control" name="competency_title">
                                                <option value="">--เลือก--</option>
                                                <?php while ($result_competency_title = mysqli_fetch_array($query_competency_title)) { ?>
                                                    <option <?php if($result_competency_title["title_id"]){ echo "selected";} ?> value="<?php echo $result_competency_title["title_id"]; ?>"  >
                                                        <?php echo $result_competency_title["title_id"] . " - " . $result_competency_title["title_name"]; ?>
                                                    </option>
                                                <?php } ?>
                                        </select>  
                                    </div>
                                    <div class="form-group col-sm-4">
                                    <?php
                                    $sql_competency = "SELECT * FROM competency ";
                                    $query_competency = mysqli_query($conn, $sql_competency);
                                    ?>
                                        <label>Detail<span style="color: red;">*</span></label>
                                        <select class="form-control" name="competency_detail">
                                                <option value="">--เลือก--</option>
                                                <?php while ($result_competency = mysqli_fetch_array($query_competency)) { ?>
                                                    <option <?php if($result_competency["competency_id"]){ echo "selected";} ?> value="<?php echo $result_competency["competency_id"]; ?>"  >
                                                        <?php echo $result_competency["competency_id"] . " - " . $result_competency["competency_description"]; ?>
                                                    </option>
                                                <?php } ?>
                                        </select>    
                                    </div>
                                    <div class="form-group col-sm-2">                                        
                                        <label>Weight<span style="color: red;">*</span></label>
                                        <input class="form-control" type="number"  step="0.1" name="t_weight" required > 
                                    </div>
                                    <div class="form-group col-sm-1">
                                        <input style="margin-top: 25px;" class="btn btn-danger" type="submit"  name="submit_insert" value="บันทึก" > 
                                        <input  type="hidden" name="level" value="<?php echo $level; ?>" >
                                        <input  type="hidden" name="name" value="<?php echo $level_name; ?>" >
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--/New-->
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
                                        <button style="margin-top: 5px;" class="btn btn-default pull-right btn-sm"  data-toggle="collapse" data-target="#add_<?php echo $result_title_id; ?>">เพิ่มหัวข้อย่อย</button>                                                   
                                        <h4>
                                            <?php echo $result_title_name." | Total Weight: ".$result_title_sum." %" ;?> 
                                            <a href="" data-href="competency_match.php?title_id=<?php echo $result_title_id; ?>&delete_title=1&level=<?php  echo $level; ?>&level_name=<?php  echo $level_name; ; ?>" data-toggle="modal" data-target="#confirm-delete" style="color:#aaaaaa;">(<i class="glyphicon glyphicon-trash"></i>)</a>
                                        </h4>
                                    </div>
                                    <div class="col-md-12">
                                        <div id="add_<?php echo $result_title_id;?>" class="collapse">
                                        <form method="get">
                                            <div class="box-padding row">
                                                <div class="form-group col-sm-4">
                                                    <label>Title<span style="color: red;">*</span></label>
                                                    <input class="form-control" type="text" value="<?php echo $result_title_name; ?>" disabled="true" > 
                                                </div>
                                                <div class="form-group col-sm-4">
                                                    <?php
                                                    $sql_competency = "SELECT * FROM competency WHERE title_id = $result_title_id";
                                                    $query_competency = mysqli_query($conn, $sql_competency);
                                                    ?>
                                                    <label>Detail<span style="color: red;">*</span></label>
                                                    <select class="form-control" name="competency_detail">
                                                        <option value="">--เลือก--</option>
                                                    <?php while ($result_competency = mysqli_fetch_array($query_competency)) { ?>
                                                        <option <?php if($result_competency["competency_id"]){ echo "selected";} ?> value="<?php echo $result_competency["competency_id"]; ?>"  >
                                                            <?php echo $result_competency["competency_id"] . " - " . $result_competency["competency_description"]; ?>
                                                        </option>
                                                    <?php } ?>
                                                    </select>    
                                                </div>
                                                <div class="form-group col-sm-2">                                        
                                                    <label>Weight<span style="color: red;">*</span></label>
                                                    <input type="number" class="form-control"   step="0.1" name="t_weight" required > 
                                                </div>
                                                <div class="form-group col-sm-1">
                                                    <input type="hidden" name="competency_title" value="<?php echo $result_title_id ?>" >
                                                    <input style="margin-top: 25px;" class="btn btn-danger" type="submit"  name="submit_insert" value="บันทึก" > 
                                                    <input  type="hidden" name="level" value="<?php echo $level; ?>" >
                                                    <input  type="hidden" name="name" value="<?php echo $level_name; ?>" >
                                                </div>
                                            </div>
                                        </form>
                                    </div>  
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
                                            WHERE m.position_level_id='$level' and t.title_id = '$result_title_id' and m.status=1";
                                $query_mng= mysqli_query($conn, $sql_mng);
                                
                                ?>
                                    <table class="table table-hover table-responsive table-striped table-bordered">                               
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Detail</th>
                                                <th style="width: 70px;text-align: center;">Weight</th>
                                                <th style="width: 70px;text-align: center;">Point</th>
                                                <th style="width: 150px;text-align: center;">Management</th>

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
                                            ?>
                                        
                                            <tr>
                                                
                                                <td><?php echo $m_id; ?></td>
                                                <td><?php echo $m_detail; ?></td>
                                                <td style="text-align: center;"><?php echo $m_weight; ?></td>
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
                                                    <a data-toggle="modal" href="#view_point<?php echo $comp_id;?>_<?php echo $level;?>" ><?php echo $maxscore;?></a>
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
                                                                                    <td><?php echo $result_pointdetail_sub["point_description"]; ?></td>

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
                                                
                                                <td style="text-align: center;">

                                                    <a class="btn btn-primary btn-sm" data-toggle="modal" href="#edit__manage_competency_<?php echo $m_id; ?>" ><i class="glyphicon glyphicon-pencil"></i>แก้ไข</a>
                                                    
                                                    <a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#confirm-delete" data-href="competency_match.php?match_id=<?php  echo $m_id; ; ?>&delete_group=1&level=<?php  echo $level; ?>&level_name=<?php  echo $level_name; ?>">
                                                              <i class="glyphicon glyphicon-remove"></i>ลบ</a>
                                                    <?php require_once('./modal_delete.php'); ?>
                                                    <form action method="get" >
                                                    <!-- Modal Edit -->   
                                                    <div class="modal animated fade " id="edit__manage_competency_<?php echo $m_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content ">

                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title" id="myModalLabel">แก้ไขหัวข้อ<?php echo $result_title_name."  ";?> ระดับ<?php echo $level_name;?> </h4>
                                                                </div>
                                                                <div class="modal-body ">
                                                                    <div class="row">
                                                                        <div class="col-sm-12">
                                                                            <div style="width: 75%;margin: auto;">
                                                                                <div class="form-group">

                                                                                    <div class="form-group col-sm-12">
                                                                                        <?php
                                                                                        
                                                                                        $sql_competency_title = "SELECT * FROM competency_title  ";
                                                                                        $query_competency_title  = mysqli_query($conn, $sql_competency_title );
                                                                                        
                                                                                        ?>
                                                                                            <label>Title<span style="color: red;">*</span></label>
                                                                                            <select class="form-control" name="edit_title" disabled>
                                                                                                    <option value="">--เลือก--</option>
                                                                                                    <?php while ($result_competency_title = mysqli_fetch_array($query_competency_title)) { $i++;?>
                                                                                                        <option <?php if($m_title==$result_competency_title["title_name"]){ echo "selected";} ?> value="<?php echo $result_competency_title["title_id"]; ?>"  >
                                                                                                            <?php echo $result_competency_title["title_id"] . " - " . $result_competency_title["title_name"]; ?>
                                                                                                        </option>
                                                                                                    <?php } ?>
                                                                                            </select>  
                                                                                        </div>
                                                                                        <div class="form-group col-sm-12">
                                                                                        <?php
                                                                                        $sql_competency = "SELECT * FROM competency where title_id = $result_title_id";
                                                                                        $query_competency = mysqli_query($conn, $sql_competency);
                                                                                        
                                                                                        ?>
                                                                                            <label>Detail<span style="color: red;">*</span></label>
                                                                                            <select class="form-control" name="competency_id">
                                                                                                    <option value="">--เลือก--</option>
                                                                                                    <?php while ($result_competency = mysqli_fetch_array($query_competency)) { ?>
                                                                                                        <option value="<?php echo $result_competency["competency_id"]; ?>"  <?php if($m_detail==$result_competency["competency_description"]){ echo "selected";} ?>  >
                                                                                                            <?php echo $result_competency["competency_id"]." - ".$result_competency["competency_description"]; ?>
                                                                                                        </option>
                                                                                                        
                                                                                                    <?php } ?>
                                                                                            </select>    
                                                                                        </div>
                                                                                        <div class="form-group col-sm-6">                                        
                                                                                            <label>Weight<span style="color: red;">*</span></label>
                                                                                            <input class="form-control" type="number"  step="0.1" name="edit_weight" value="<?php echo $m_weight; ?>" required > 
                                                                                        </div>     
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">                                                                    
                                                                    <input type="hidden" name="edit_id" value="<?php echo $result_mng["manage_comp_id"]; ?>" >
                                                                    <input  type="hidden" name="level" value="<?php echo $level; ?>" >
                                                                    <input  type="hidden" name="name" value="<?php echo $level_name; ?>" >
                                                                    <input class="btn btn-primary" type="submit" name="submit_edit" value="บันทึก" >
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                                </div>                 
                                                            </div>
                                                        </div>  
                                                    </div>
                                                    <!--/Modal Edit-->
                                                    </form>
                                                    
                                                </td>
                                            </tr>
                                            
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                    
                                </div>
                                <?php } ?> 
                                    
                            </div>
                                   
                                    
                                
                            
                        </div>
                    </div>
                    
                </div>
                
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
    <!-- SCRIPT PACKS -->
        <?php include ('./script_packs.html'); ?>
</html>
            <?php
        }
    }

    
?>