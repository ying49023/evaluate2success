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
    <?php include ('./classes/connection_mysqli.php'); 
        
    if(isset($_GET["position_level_id"])) {
        $position_level = $_GET["position_level_id"];
    } else {
        $position_level = "1";
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
                    
                    <h1>หน้าแก้ไขแบบฟอร์มประเมินผลการปฏิบัติงาน</h1>
                        
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
                    <div class="box box-primary">
                        <script type="text/javascript">
                            //Script สำหรับ เลือก dropdown menu แบบไม่ต้องกด submit จะเปลี่ยนข้อมูลแบบ " A U T O "
                            function position_level()
                            {
                                document.form_name.submit();
                            };
                        </script>
                        <!--box-body-->
                        <div class="box-body">
                            <!-- /.row -->
                            <div class="row">
                                <div class="box-padding-small">
                                    
                                    <TABLE class="table table-bordered table-hover" HEIGHT="100" WIDTH="100%" border="1" >
                                        <thead>
                                            <TR class="bg-primary">
                                                <th colspan="13">                                             
                                                    <form name="form_name" onchange="position_level()" method="get" class="form-inline" >
                                                        <span style="font-size: 20px;;">แบบฟอร์มประเมินผลการปฏิบัติงาน แบบเน้น Competency, KPIs และ Dehvelopment</span> 
                                                        <div class="form-group">
                                                            <?php
                                                            $sql_position_level = "SELECT * FROM position_level ";
                                                            $query_position_level = mysqli_query($conn, $sql_position_level);
                                                            ?>
                                                            <select class="form-control input-sm" name="position_level_id" style="width: 150px;">
                                                                <option value="">--เลือกระดับ--</option>
                                                                        <?php while ($result_position_level = mysqli_fetch_array($query_position_level)) { ?>
                                                                <option value="<?php echo $result_position_level["position_level_id"]; ?>">
                                                                                <?php echo $result_position_level["position_level_id"] . " - " . $result_position_level["position_description"]; ?>
                                                                </option>
                                                                        <?php } ?>
                                                            </select>
                                                        </div>
                                                    </form>
                                                </th>
                                            </TR>
                                            <TR class="bg-info">
                                                <th style="padding-bottom: 25px;" rowspan="2" colspan="4">ความสามารถ(Competency)</th>
                                                <th style="padding-bottom:25px;" rowspan="2" >%น้ำหนัก(W)</th>
                                                <th colspan="2">ระดับที่คาดหวัง (E)</th>
                                                <th colspan="6">ระดับที่ทำจริง (A)</th>
                                            </TR>
                                            <tr class="bg-info">
                                                <td>ระดับ</td>
                                                <td>รวม</td>
                                                <td>1</td>
                                                <td>2</td>
                                                <td>3</td>
                                                <td>4</td>
                                                <td>5</td>
                                                <td> </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <TR class="bg-info">
                                                <th colspan="13">
                                                    ความสามารถในการปฏิบัติงาน (Competency) - ผู้บังคับบัญชากรุณาทำความเข้าใจ "คำอธิบายระดับความสามารถ" เพื่อประเมินได้ถูกต้อง
                                                </th>
                                            </TR>
                                            <!-- New title -->
                                            <TR class="bg-success">
                                                <th colspan="13">
                                            <form action="new_title.php" method="post">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-inline">
                                                            <label>เพิ่มหัวข้อ</label>
                                                            <input class="form-control" type="text" name="title_name" placeholder="ระบุหัวข้อประเภทการประเมิน" required="true" />
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-inline">
                                                            <label>ใส่ค่าน้ำหนัก(%)</label>
                                                            <input class="form-control" type="number" step="5" name="weight" placeholder="น้ำหนัก" required="true" />
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="form-inline">
                                                            <input type="hidden" name="position_level_id" value="<?php echo $position_level; ?>" />
                                                            <input class="btn btn-primary" type="submit" value="เพิ่ม" />
                                                        </div>
                                                    </div>
                                                </div>

                                            </form>
                                            </th>
                                            </TR>
                                            <!--/New title-->
                                            <?php 

                                            $sql_title = "SELECT * FROM title" ;
                                            $query_title = mysqli_query($conn, $sql_title);
                                            while ($result_title = mysqli_fetch_array($query_title,MYSQLI_ASSOC)) {
                                            ?>
                                            <!-- Title -->
                                            <TR>
                                                <th style="text-align:left"  colspan="13" class="bg-success">
                                                    <?php echo $result_title["title_name"]." - (".$result_title["weight"]."%)"; ?>
                                                    <a href="delete_title.php?position_level_id=<?php echo $position_level; ?>&title_id=<?php echo $result_title["title_id"]; ?>">
                                                        (<i class="glyphicon glyphicon-trash"></i>)
                                                    </a>
                                                    <a  class="pull-right" data-toggle="modal" data-target="#newTitleTopic">
                                                        <button class="btn btn-warning btn-xs"  >เพิ่มหัวข้อ</button>
                                                    </a>                                              
                                                </th>
                                            </TR>
                                            <!--/Title-->
                                            <?php  
                                            $sql_form_eval_1 = "SELECT c.competency_id as competency_id, c.competency_description as description , c.weight as weight ,"
                                                            . "c.expected_level as expected_level ,c.weight*c.expected_level as summary ,"
                                                            . " p.position_level_id as position_level_id  "
                                                            . " from position_level p "
                                                            . " JOIN competency c ON p.position_level_id=c.position_level_id "
                                                            . " JOIN title t ON c.title_id = t.title_id "
                                                            . " WHERE t.title_id = '".$result_title["title_id"]."' AND p.position_level_id = '".$position_level."'";

                                            $query_form_eval_1 = mysqli_query($conn, $sql_form_eval_1);
                                            $i = 0;
                                            while($result_form_eval_1 = mysqli_fetch_array($query_form_eval_1,MYSQL_ASSOC)){ 
                                                $i++; 
                                            ?>
                                            <!-- Topic -->
                                            <TR>
                                                <td style="text-align:left" colspan="4"><?php echo $i.".".$result_form_eval_1["description"]; ?></td>
                                                <td ><?php echo $result_form_eval_1["weight"]; ?></td>
                                                <td ><?php echo $result_form_eval_1["expected_level"]; ?></td>
                                                <td ><?php echo $result_form_eval_1["summary"]; ?></td>
                                                <td >
                                                    <input type="radio" name="optradio" value="1"></td>
                                                <td >
                                                    <input type="radio" name="optradio" value="2"></td>
                                                <td >
                                                    <input type="radio" name="optradio" value="3"></td>
                                                <td >
                                                    <input type="radio" name="optradio" value="4"></td>
                                                <td >
                                                    <input type="radio" name="optradio" value="5"></td>
                                                <td class="text-center" style="width: 100px">
                                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#title_one<?php echo $result_form_eval_1["competency_id"] ?>">
                                                        <i class="glyphicon glyphicon-pencil" ></i>
                                                    </button>                                                   
                                                    |
                                                    <a href="delete_topic_eval.php?position_level_id=<?php echo $position_level; ?>&competency_id=<?php echo $result_form_eval_1["competency_id"]; ?>" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash" ></i></a>
                                                </td>
                                            </TR>
                                            <tr>
                                                <!-- Modal -->    
                                                <div class="modal animated fade " id="title_one<?php echo $result_form_eval_1["competency_id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
                                                    <div class="modal-dialog" role="document">
                                                        <form action="update_topic_eval.php" method="post">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title" id="myModalLabel">แก้ไขหัวข้อ</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-sm-12">
                                                                            <div style="width: 75%;margin: auto;">
                                                                                <h4><?php echo $result_title["title_name"]."(".$result_title["weight"]."%)"; ?></h4>

                                                                                <div class="form-group">
                                                                                    <label class="pull-left">ชื่อหัวข้อ: </label>
                                                                                    <input type="text" class="form-control" name="title_name" placeholder="ชื่อหัวข้อ" value="<?php echo $i . ' - ' . $result_form_eval_1["description"]; ?>" readonly >
                                                                                </div>
                                                                                <div class="form-group" >
                                                                                    <label class="pull-left">น้ำหนัก</label>
                                                                                    <select class="form-control" name="weight">
                                                                                        <option value="1" <?php if ($result_form_eval_1["weight"] == '1') {
                                                                echo "selected";
                                                            } ?> >1</option>
                                                                                        <option value="2" <?php if ($result_form_eval_1["weight"] == '2') {
                                                                echo "selected";
                                                            } ?>>2</option>
                                                                                        <option value="3" <?php if ($result_form_eval_1["weight"] == '3') {
                                                                echo "selected";
                                                            } ?>>3</option>
                                                                                        <option value="4" <?php if ($result_form_eval_1["weight"] == '4') {
                                                                echo "selected";
                                                            } ?>>4</option>
                                                                                        <option value="5" <?php if ($result_form_eval_1["weight"] == '5') {
                                                                echo "selected";
                                                            } ?>>5</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group" >
                                                                                    <label class="pull-left">ระดับที่คาดหวัง</label>
                                                                                    <select class="form-control" name="expected_level">
                                                                                        <option value="1" <?php if ($result_form_eval_1["expected_level"] == '1') {
                                                                echo "selected";
                                                            } ?> >1</option>
                                                                                        <option value="2" <?php if ($result_form_eval_1["expected_level"] == '2') {
                                                                echo "selected";
                                                            } ?>>2</option>
                                                                                        <option value="3" <?php if ($result_form_eval_1["expected_level"] == '3') {
                                                                echo "selected";
                                                            } ?>>3</option>
                                                                                        <option value="4" <?php if ($result_form_eval_1["expected_level"] == '4') {
                                                                echo "selected";
                                                            } ?>>4</option>
                                                                                        <option value="5" <?php if ($result_form_eval_1["expected_level"] == '5') {
                                                                echo "selected";
                                                            } ?>>5</option>
                                                                                    </select>
                                                                                </div>
                                                                                <input type="hidden" name="competency_id" value="<?php echo $result_form_eval_1["competency_id"]; ?>" >
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <input class="btn btn-primary" type="submit" name="submit" value="บันทึก" >
                                                                    <input type="hidden" name="position_level_id" value="<?php echo $position_level; ?>" >
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                                </div>

                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>   
                                                <!--Modal-->
                                            </tr>
                                            
                                            <!--/Topic-->
                                            <?php  } ?>
                                            <?php } ?>
                                            <?php
                                            $sql_sum_1 = "SELECT
                                                    SUM(c.expected_level) AS sum_expected_level,
                                                    SUM(c.weight) AS sum_weight,
                                                    sum(c.weight * c.expected_level) AS sum_summary
                                                FROM
                                                        competency c
                                                JOIN position_level p ON p.position_level_id = c.position_level_id
                                                WHERE
                                                    p.position_level_id = '".$position_level."'";
                                            $query_sum_1 = mysqli_query($conn, $sql_sum_1);
                                            $result_sum_1 = mysqli_fetch_assoc($query_sum_1);



                                            $sum_weight = $result_sum_1["sum_weight"] ;
                                            $sum_expected_level = $result_sum_1["sum_expected_level"] ;
                                            $sum_summary = $result_sum_1["sum_summary"] ;
                                            ?>
                                            <TR class="bg-info">
                                                <th colspan="4">รวม</th>
                                                <td ><?php echo $sum_weight ; ?></td>
                                                <td ><?php echo $sum_expected_level ; ?></td>
                                                <td ><?php echo $sum_summary ; ?></td>
                                                <td colspan="6"></td>

                                            </TR>
                                        </tbody>
                                    </TABLE>
                                </div>
                            </div>
                            <!-- Modal POPUP เพิ่มหัวข้อ -->     
                            <div class="modal fade" id="newTitleTopic" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form action="new_topic_eval.php" method="post">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">เพิ่มหัวข้อ</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div style="width: 75%;margin: auto;">
                                                            <div class="form-group">
                                                                <label class="pull-left">ประเภท</label>
                                                                <select class="form-control" name="title_id">
                                                                <?php 
                                                                $sql_title = "SELECT * FROM title" ;
                                                                $query_title = mysqli_query($conn, $sql_title);
                                                                while($result_title = mysqli_fetch_array($query_title)) { ?>
                                                                    <option value="<?php echo $result_title["title_id"] ?>"><?php echo $result_title["title_name"]." - (".$result_title["weight"]."%)"; ?></option>
                                                                <?php } ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="pull-left">ชื่อหัวข้อ: </label>
                                                                <input type="text" class="form-control" name="competency_description" placeholder="ชื่อหัวข้อ">
                                                            </div>
                                                            <div class="form-group" >
                                                                <label class="pull-left">น้ำหนัก</label>
                                                                <select class="form-control" name="weight">
                                                                    <option>1</option>
                                                                    <option>2</option>
                                                                    <option>3</option>
                                                                    <option>4</option>
                                                                    <option>5</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group" >
                                                                <label class="pull-left">ระดับที่คาดหวัง</label>
                                                                <select class="form-control" name="expected_level">
                                                                    <option>1</option>
                                                                    <option>2</option>
                                                                    <option>3</option>
                                                                    <option>4</option>
                                                                    <option>5</option>
                                                                </select>
                                                                    
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input class="btn btn-primary" type="submit" name="submit" value="บันทึก" >
                                                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                <input type="hidden" name="position_level_id" value="<?php echo $position_level; ?>" >
                                                    
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ./box-body -->
                        <!-- /.content -->
                            
                        <!--box footer-->
                        <div class="box-footer">
                            <input type="submit" class="btn btn-success pull-right" value="บันทึกข้อมูล" >
                            <a href="#">
                                <button class="btn btn-instagram pull-right">ภาพตัวอย่าง</button>
                            </a>
                        </div>
                        <!--/box footer--> 
                            
                    </div>
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