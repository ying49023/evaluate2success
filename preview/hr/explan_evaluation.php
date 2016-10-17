<?php
    include ('./classes/connection_mysqli.php');
    
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
        <?php
        //Get Position Level
        $level = 1;
        if(isset($_GET["position_level_id"])){
            $level = $_GET["position_level_id"];
        }
        
        
        ?>
              
<!DOCTYPE html>
<html>
    <head>
        <?php
            if (isset($_POST["type"])) {
                    if ($_POST["type"] == "header") {
                        $get_eval_code = $_POST["evaluation_code"];
                        $get_pos = $_POST["position_level_id"];
                        //Header
                        if (isset($_POST["explaned_header"])) {
                            if ($_POST["status"] == "insert") {
                                $sql = "INSERT INTO explaned_evaluation (explaned_header,evaluation_code) values ('" . $_POST["explaned_header"] . "' , '" . $_POST["evaluation_code"] . "')";
                                $query = mysqli_query($conn, $sql);
                                header("location:explan_evaluation.php?eval_code=$get_eval_code&position_level_id=$get_pos");
                            } else if ($_POST["status"] == "edit") {
                                $sql = "UPDATE explaned_evaluation SET explaned_header = '" . $_POST["explaned_header"] . "' WHERE explaned_id = '" . $_POST["explaned_id"] . "' ";
                                $query = mysqli_query($conn, $sql);
                                header("location:explan_evaluation.php?eval_code=$get_eval_code&position_level_id=$get_pos");
                            } else if ($_POST["status"] == "delete") {
                                $sql = "DELETE explaned_evaluation WHERE  explaned_id = '" . $_POST["explaned_id"] . "'";
                                $query = mysqli_query($conn, $sql);
                                header("location:explan_evaluation.php?eval_code=$get_eval_code&position_level_id=$get_pos");
                            }
                        }
                    } else if ($_POST["type"] == "detail") {
                        //Detail
                        if (isset($_POST["explan_detail"])) {
                            
                            
                            if ($_POST["status"] == "insert") {
                                $sql = "";
                                $query = mysqli_query($conn, $sql);
                            } else if ($_POST["status"] == "edit") {
                                $sql = "";
                                $query = mysqli_query($conn, $sql);
                            } else if ($_POST["status"] == "delete") {
                                $sql = "DELETE";
                                $query = mysqli_query($conn, $sql);
                            }
                        }
                    }
                }
        ?>
        <?php 
        
        $sql_eval = "SELECT * evaluation"
            
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
        <style>
            .modal-body{
                min-height: 150px;
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
                    <h1>
                        คำชี้แจงแบบประเมินผลการปฏิบัติงาน
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
                    
                    
                    <!-- Explane -->
                    <div class="box box-primary ">
                        <script type="text/javascript">
                            //Script สำหรับ เลือก dropdown menu แบบไม่ต้องกด submit จะเปลี่ยนข้อมูลแบบ " A U T O "
                            function position_level()
                            {
                                document.form_name.submit();
                            };
                        </script>
                        <div class="box-header with-border">
                            <div class="row">
                                    <form name="form_name" onchange="position_level()" method="get" class="form-inline" >
                                        <span class="box-padding" style="font-size: 20px;"><i class="glyphicon glyphicon-info-sign"></i>&nbsp;คำชี้แจงแบบประเมินผลการปฏิบัติงาน (Performance Appraisal Guideline)</span> 
                                        <input type="hidden" name="eval_code" value="3" >
                                        <div class="form-group">
                                                    <?php
                                                    $sql_position_level = "SELECT * FROM position_level ";
                                                    $query_position_level = mysqli_query($conn, $sql_position_level);
                                                    ?>
                                            <select class="form-control" name="position_level_id" style="width: 150px;">
                                                <option value="">--เลือกระดับ--</option>
                                                        <?php while ($result_position_level = mysqli_fetch_array($query_position_level)) { ?>
                                                <option value="<?php echo $result_position_level["position_level_id"]; ?>" <?php if ($level == $result_position_level["position_level_id"]) {
                                                    echo "selected";
                                                } ?> >
                                                            <?php echo "ระดับ".$result_position_level["position_description"]; ?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        
                                        <button type="button" class="pull-right form-group btn btn-success btn-sm" style="margin-right: 20px;" data-toggle="modal" data-target="#insert_header">
                                            <i class="glyphicon glyphicon-plus" ></i> &nbsp;เพิ่มหัวข้อ
                                        </button> 
                                    </form>          
                                <!-- Insert Deatail -->
                                <form class="form-horizontal" name="frmMain" method="post" >
                                    <div class="modal fade" id="insert_header" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog modal-lg" role="document">
                                                    <?php
                                                    foreach ($query as $result) {
                                                        ?>
                                            <div class="modal-content">
                                                <div class="modal-header bg-blue">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">เพิ่มหัวข้อ</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group col-sm-12" >
                                                        <label for="ชื่อหัวข้อ" class="col-sm-offset-1 col-sm-2 control-label">ชื่อหัวข้อ:</label>
                                                        <div class="col-sm-8">               
                                                            <input type="text" class="form-control" value="" name='explaned_header'  >
                                                        </div>
                                                    </div>
                                                        
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="hidden" name="evaluation_code" value="<?php echo $eval_code; ?>" >
                                                    <input type="hidden" name="position_level_id" value="<?php echo $level; ?>" >
                                                    <input type="hidden" name="type" value="header" >
                                                    <input type="hidden" name="status" value="insert" >
                                                    <input type="submit" class="btn btn-success" value="เพิ่ม" >
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>  
                                                </div>
                                            </div>
                                                    <?php } ?>
                                        </div>
                                    </div>
                                </form>
                                <!--/Insert Deatil -->
                            </div>
                        </div>
                        <div class=" box-body " >
                            <div class="box-padding-small" >
                                <?php
                                        $sql_title_exp = "SELECT * FROM explaned_evaluation WHERE explaned_id > 1 ";
                                        $query_title_exp = mysqli_query($conn, $sql_title_exp);
                                        while ($result_title_exp = mysqli_fetch_array($query_title_exp, MYSQLI_ASSOC)) {
                                            $explaned_id = $result_title_exp["explaned_id"];
                                            $explaned_header = $result_title_exp["explaned_header"].' '.$result_title_exp["explaned_small_header"];
                                            
                                            $sql_detail = "SELECT * FROM explaned_detail WHERE explaned_id = '$explaned_id' AND position_level_id = '$level' ";
                                            $query_detail = mysqli_query($conn, $sql_detail);
                                            $count = mysqli_num_rows($query_detail);
                                            ?>
                                    <div style="margin-bottom: 2px;border:none;"  class="box ">
                                    <div class="box-header ">
                                        <div class="row">
                                            <div class="col-sm-10">
                                                <b><?php echo $explaned_header; ?></b>
                                                (<a  class="" data-toggle="modal" data-target="#<?php echo $explaned_id; ?>_edit_header" >
                                                    <i class="glyphicon glyphicon-pencil bg-blue" ></i> 
                                                        
                                                </a> |
                                                <a class="" data-toggle="modal"  data-target="#<?php echo $explaned_id; ?>_delete_header" >
                                                    <i class="glyphicon glyphicon-remove bg-red" ></i>
                                                </a> )
                                            </div>
                                            <div class="col-sm-2">
                                                <button type="button" class="pull-right btn btn-success btn-sm" data-toggle="modal" data-target="#insert_detail_<?php echo $explaned_id; ?>">
                                                    <i class="glyphicon glyphicon-plus" ></i> เพิ่มรายละเอียด
                                                </button>  
                                            </div>
                                            
                                        </div>
                                                
                                                    <!-- Insert Deatail -->
                                                    <form class="form-horizontal" name="frmMain" method="post" >
                                                        <div class="modal fade" id="insert_detail_<?php echo $explaned_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <?php
                                                                foreach ($query as $result) {
                                                                    ?>
                                                                    <div class="modal-content">
                                                                        <div class="modal-header bg-blue">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                            <h4 class="modal-title" id="myModalLabel">เพิ่มรายละเอียด</h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="form-group col-sm-12" >
                                                                                <label for="ชื่อหัวข้อ" class="col-sm-4 control-label">ชื่อหัวข้อ:</label>
                                                                                <div class="col-sm-8">               
                                                                                    <input type="text" class="form-control" value="<?php echo $explaned_header; ?>" name='explaned_header' disabled  >
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group col-sm-12" >
                                                                                <label for="รายละเอียด" class="col-sm-4 control-label">รายละเอียด:</label>
                                                                                <div class="col-sm-8">               
                                                                                    <textarea type="text" class="form-control" value="" name='explan_detail' ></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <input type="hidden" name="position_level_id" value="<?php echo $level; ?>" >
                                                                            <input type="hidden" name="type" value="detail" >
                                                                            <input type="hidden" name="evaluation_code" value="<?php echo $eval_code; ?>" >
                                                                            <input type="hidden" name="explaned_id" value="<?php echo $explaned_id; ?>" >
                                                                            <input type="hidden" name="status" value="edit" >
                                                                            <input type="submit" class="btn btn-success" value="เพิ่ม" >
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>

                                                                        </div>
                                                                    </div>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <!--/Insert Deatil -->
                                                    <!--Edit Modal -->
                                                    <form class="form-horizontal" name="frmMain" method="post"  >
                                                        <div class="modal fade" id="<?php echo $explaned_id; ?>_edit_header" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <?php
                                                                foreach ($query as $result) {
                                                                    ?>
                                                                    <div class="modal-content">
                                                                        <div class="modal-header bg-blue">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                            <h4 class="modal-title" id="myModalLabel">แก้ไขข้อมูล</h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="form-group col-sm-12" >
                                                                                <label for="ชื่อหัวข้อ" class="col-sm-4 control-label">ชื่อหัวข้อ:</label>
                                                                                <div class="col-sm-8">               
                                                                                    <input type="text" class="form-control" value="<?php echo $explaned_header; ?>" name='explaned_header'  >
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <input type="hidden" name="position_level_id" value="<?php echo $level; ?>" >
                                                                            <input type="hidden" name="type" value="header" >
                                                                            <input type="hidden" name="status" value="edit" >
                                                                            <input type="hidden" name="evaluation_code" value="<?php echo $eval_code; ?>" >
                                                                            <input type="hidden" name="explaned_id" value="<?php echo $explaned_id ?>" >
                                                                            <input type="submit" class="btn btn-primary" value="แก้ไข" >
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>

                                                                        </div>
                                                                    </div>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <!--Edit Modal -->

                                                    <!--Delete Modal -->
                                                    <form class="form-horizontal" name="frmMain" method="post"  >
                                                        <div class="modal fade" id="<?php echo $explaned_id; ?>_delete_header" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <?php
                                                                    foreach ($query as $result) {
                                                                        ?>
                                                                        <div class="modal-content">
                                                                            <div class="modal-header bg-blue">
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                                <h4 class="modal-title" id="myModalLabel">ยืนยันการลบข้อมูล?</h4>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="form-group col-sm-12" >
                                                                                    <label for="ชื่อหัวข้อ" class="col-sm-4 control-label">ชื่อหัวข้อ:</label>
                                                                                    <div class="col-sm-8">               
                                                                                        <input type="text" class="form-control" value="<?php echo $explaned_header; ?>" name='explaned_header' disabled  >
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <input type="hidden" name="position_level_id" value="<?php echo $level; ?>" >
                                                                                <input type="hidden" name="type" value="header" >
                                                                                <input type="hidden" name="status" value="delete" >
                                                                                <input type="hidden" name="evaluation_code" value="<?php echo $eval_code; ?>" >
                                                                                <input type="hidden" name="explaned_id" value="<?php echo $explaned_id ?>" >
                                                                                <input type="submit" class="btn btn-danger" value="ลบ" >
                                                                                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                                            </div>
                                                                        </div>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <!--Delete Modal -->
                                        
                                        
                                    </div>
                                    <?php if($count != 0){ ?>    
                                    <div class="box-body">
                                        <?php
                                                while ($result_detail = mysqli_fetch_array($query_detail, MYSQLI_ASSOC)) {
                                                    ?>
                                                    <p><?php echo $result_detail["detail"]; ?>
                                                        <a  class="" data-toggle="modal" data-target="#<?php echo $result_detail["explaned_detail_id"]; ?>_edit" >
                                                            ( <i class="glyphicon glyphicon-pencil bg-blue" ></i> 

                                                        </a>
                                                        |
                                                        <a class="" data-toggle="modal"  data-target="#<?php echo $result_detail["explaned_detail_id"]; ?>_delete" >
                                                             <i class="glyphicon glyphicon-remove bg-red" ></i> )
                                                        </a>
                                                    </p>
                                                                        <?php
                                                                        $sql = "SELECT * FROM explaned_detail  ed JOIN explaned_evaluation ee ON ed.explaned_id = ee.explaned_id WHERE ed.explaned_detail_id = '" . $result_detail["explaned_detail_id"] . "' AND position_level_id = '".$level."' LIMIT 1";
                                                                        $query = mysqli_query($conn, $sql);
                                                                        ?>
                                    <!--Edit Modal -->
                                            <form class="form-horizontal" name="frmMain" method="post" action="explan_evaluation.php?id=<?php echo $result_detail["explaned_detail_id"]; ?>" >
                                                <div class="modal fade" id="<?php echo $result_detail["explaned_detail_id"]; ?>_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <?php
                                                        foreach ($query as $result){
                                                        ?>
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-blue">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title" id="myModalLabel">แก้ไขข้อมูล</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group col-sm-12" >
                                                                    <label for="ชื่อหัวข้อ" class="col-sm-4 control-label">ชื่อหัวข้อ:</label>
                                                                    <div class="col-sm-8">               
                                                                        <input type="text" class="form-control" value="<?php echo $result["explaned_header"]; ?>" name='textcom' disabled  >
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-sm-12" >
                                                                    <label for="รายละเอียด" class="col-sm-4 control-label">รายละเอียด:</label>
                                                                    <div class="col-sm-8">               
                                                                        <textarea type="text" class="form-control" rows="5" value="<?php echo $result["detail"]; ?>" name='textfullcom' ><?php echo $result["detail"]; ?></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="hidden" name="position_level_id" value="<?php echo $level; ?>" >
                                                                <input type="hidden" name="evaluation_code" value="<?php echo $eval_code; ?>" >
                                                                <input type="hidden" name="type" value="detail" >
                                                                <input type="hidden" name="status" value="edit" >
                                                                <input type="submit" class="btn btn-primary" value="แก้ไข" >
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                            </div>
                                                        </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </form>
                                        <!--Edit Modal -->

                                        <!--Delete Modal -->
                                            <form class="form-horizontal" name="frmMain" method="post" action="explan_evaluation.php?status=delete&id=<?php echo $result_detail["explaned_detail_id"]; ?>" >
                                                <div class="modal fade" id="<?php echo $result_detail["explaned_detail_id"]; ?>_delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <?php
                                                        foreach ($query as $result){
                                                        ?>
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-blue">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title" id="myModalLabel">ยืนยันการลบข้อมูล?</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group col-sm-12" >
                                                                    <label for="ชื่อหัวข้อ" class="col-sm-4 control-label">ชื่อหัวข้อ:</label>
                                                                    <div class="col-sm-8">               
                                                                        <input type="text" class="form-control" value="<?php echo $result["explaned_header"]; ?>" name='textcom' disabled  >
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-sm-12" >
                                                                    <label for="รายละเอียด" class="col-sm-4 control-label">รายละเอียด:</label>
                                                                    <div class="col-sm-8">               
                                                                        <textarea type="text" class="form-control" value="<?php echo $result["detail"]; ?>" name='textfullcom' disabled ><?php echo $result["detail"]; ?></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="hidden" name="position_level_id" value="<?php echo $level; ?>" >
                                                                <input type="hidden" name="evaluation_code" value="<?php echo $eval_code; ?>" >
                                                                <input type="hidden" name="type" value="detail" >
                                                                <input type="hidden" name="status" value="delete" >
                                                                <input type="submit" class="btn btn-warning" value="ลบ" >
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                            </div>
                                                        </div>
                                                        <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        <!--Delete Modal -->
                                                <?php } ?>
                                    </div>
                                    <?php } ?>
                                </div>
                                <?php } ?>
                                        
                                        
                            </div>
                            
                            
                        </div>
                        <div class="box-footer">
                            <form action="evaluation_section_1.php" method="post">
                                <script>
                                $(function() {
                                    var chk = $('#check');
                                    var btn = $('#btncheck');

                                    chk.on('change', function() {
                                      btn.prop("disabled", !this.checked);//true: disabled, false: enabled
                                    }).trigger('change'); //page load trigger event
                                  });
                                </script>

                                <div class="form-group  text-center">
                                    <div class="checkbox ">
                                       <input id="check" name="checkbox" type="checkbox" > 
                                       <label for="check">ยอมรับข้อตกลงและคำชี้แจง</label><!-- for must be the id of input -->
                                    </div>
                                    <button class="btn btn-success btn-lg " type="submit" id="btncheck"  name="submit"><i class="glyphicon glyphicon-play-circle"></i> &nbsp; หน้าถัดไป - ส่วนที่ 1 : KPIs</button>
                                </div>  
                            </form>
                        </div>
                    </div>
                    <!--/Explane -->
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
