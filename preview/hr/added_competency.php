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
        include('./classes/connection_mysqli.php'); 
        
        $get_title_id = '';
        if(isset($_GET["title_id"])) {
            $get_title_id = $_GET["title_id"];
        }
        $condition_search = '';
        if ($get_title_id != '') {
            $condition_search = " WHERE t.title_id = ".$get_title_id." ";
        }  
        
        //Insert
        if(isset($_GET["submit_insert"])){
            
            $sql_insert_group = "INSERT INTO competency (competency_description,title_id) VALUES ('".$_GET["com_desc"]."','".$_GET["add_title_id"]."')";
            if (mysqli_query($conn, $sql_insert_group)) {
                    echo "Record new successfully";
                    echo $sql_insert_group;
                } else {
                    echo "Error new record: " . mysqli_error($conn);
                    echo $sql_insert_group;
                }
                    
                header("Location: added_competency.php?title_id=$get_title_id");
            }
        //Edit
        if(isset($_GET["submit_edit"])){
            $title_id = '';
            if(isset($_GET["titleid"])){
                $title_id = $_GET["titleid"];
            }
            if(isset($_GET["competency_id"])){
                $competency_id= $_GET["competency_id"];
            }
            $sql_edit_group = "UPDATE competency SET competency_description='".$_GET["competency_desc"]."' WHERE competency_id='".$_GET["competency_id"]."' AND title_id='$title_id' ";
            if (mysqli_query($conn, $sql_edit_group)) {
                    echo "Record edit successfully";
                    echo $sql_edit_group;
                } else {
                    echo "Error edit record: " . mysqli_error($conn);
                    echo $sql_edit_group;
                }
                    
                header("Location: added_competency.php?titleid=$get_title_id");
            }
        //Delete  
        if(isset($_GET["delete_group"])){
            $title_id = $_GET["title_id"];
            $sql_delete_group = "DELETE FROM competency WHERE competency_id='".$_GET["comp_id"]."'";
            if (mysqli_query($conn, $sql_delete_group)) {
                    echo "Record new successfully";
                    echo $sql_delete_group;
                } else {
                    echo "Error new record: " . mysqli_error($conn);
                    echo $sql_delete_group;
                }
                    
                header("Location: added_competency.php?title_id=$get_title_id");
            }
            
            
        ?>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>ระบบประเมินผลปฏิบัติงาน : ALT Evaluation</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!--CSS PACKS -->
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
                        Competency 
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="#"> <i class="fa fa-dashboard"></i>
                                Home
                            </a>
                        </li>
                        <li class="active">Competency Added</li>
                    </ol>
                </section>
                <!--/Page header -->
                
                <!-- Main content -->
                <div id="filter" class="row box-padding">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">หัวข้อพฤติกรรมที่ทำการประเมิน และ ปัจจัยการพิจารณา </h3>
                            <button class="btn btn-success pull-right"  data-toggle="collapse" data-target="#newKPIGroup">+ เพิ่ม</button>
                        </div>
                        <!--new compt -->
                        <div id="newKPIGroup" class="collapse bg-gray-light box-padding">
                            <form action="" method="get">
                                <div class="row">
                                    <div class="form-group col-sm-5">
                                        <label>เพิ่มรายการใหม่<span style="color: red;">*</span></label>
                                        <input class="form-control" type="text"  step="5" name="com_desc" required > 
                                    </div>
                                    <div class="form-group col-sm-5">
                                       <label>หัวข้อ<span style="color: red;">*</span></label>
                                    
                                    <?php 
                                        $sql_title = "SELECT * FROM competency_title ";
                                        $query_title = mysqli_query($conn, $sql_title);
                                    ?>
                                        <select class="form-control" name="add_title_id">
                                            <option value="">--เลือก--</option>
                                        <?php while($result_title = mysqli_fetch_array($query_title,MYSQLI_ASSOC)) { ?>
                                            <option value="<?php echo $result_title["title_id"]; ?>" <?php if($get_title_id == $result_title["title_id"]) { echo "selected"; }  ?> >
                                                <?php echo $result_title["title_name"]; ?>
                                            </option>
                                        <?php } ?>
                                        </select>
                                        
                                    
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <input style="margin-top: 25px;width: 100%;" class="btn btn-info" type="submit"  name="submit_insert" value="เพิ่ม" > 
                                        <input  type="hidden" name="emp_id" value="<?php echo $get_emp_id; ?>" >
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--/new compt -->
                        <div class="box-body">
                            
                                <?php
                                $sql_com = "SELECT c.competency_id,c.competency_description,t.title_name,t.title_id FROM competency c JOIN competency_title t ON c.title_id=t.title_id ".$condition_search." ORDER BY competency_id ASC";
                                $query_com = mysqli_query($conn, $sql_com);
                                
                                ?>
                                    <!-- ช่องค้นหา by listJS -->
                                    <div class="form-group col-md-5 col-sm-6 col-lg-4">
                                        <label><i class="glyphicon glyphicon-search" style="padding: 0px 10px;" ></i>ค้นหา</label>
                                        <input class="search form-control" placeholder="พิมพ์ค้นหา" >
                                    </div>
                                    <script>
                                        function searchCompt(){
                                            document.submit_auto.submit();
                                        }
                                    </script>
                                    <form name="submit_auto" onchange="searchCompt()" method="get">
                                        <div class="col-sm-6 col-md-7 col-lg-6 form-group">
                                            <label>หัวข้อ</label>
                                            <div class="">
                                                <?php
                                                $sql_title = "SELECT * FROM competency_title ";
                                                $query_title = mysqli_query($conn, $sql_title);
                                                ?>
                                                <select class="form-control" name="title_id">
                                                    <option value="">เลือกทั้งหมด</option>
                                                    <?php while ($result_title = mysqli_fetch_array($query_title, MYSQLI_ASSOC)) { ?>
                                                        <option value="<?php echo $result_title["title_id"]; ?>" <?php if ($get_title_id == $result_title["title_id"]) {
                                                        echo "selected";
                                                    } ?> >
                                                        <?php echo $result_title["title_name"]; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>

                                            </div>
                                            
                                        </div>
                                    </form>
                            <div class="row">
                                <div class="col-md-12">    
                                    <table class="table table-hover table-responsive table-striped table-bordered">                               
                                        <thead>
                                            <tr>
                                                <th style="width: 120px;"><button class="sort" data-sort="competency_id">No.</button></th>
                                                <th><button class="sort" data-sort="competency_name">ชื่อ Competency</button></th>
                                                <th><button class="sort" data-sort="title_name">ชื่อหัวข้อ</button></th>
                                                <th class="text-center" style="width: 150px;">จัดการ</th>

                                            </tr>
                                        </thead>
                                        <tbody class="list">
                                    <?php while ($result_com = mysqli_fetch_array($query_com, MYSQLI_ASSOC)) { ?>
                                        
                                        <tr>
                                            <td class="competency_id"><b><?php echo $result_com["competency_id"]; ?></b></td>
                                            <td class="competency_name"><?php echo $result_com["competency_description"]; ?></td>
                                            <td class="title_name"><?php echo $result_com["title_name"]; ?></td>
                                            <td style="text-align: center;">
                                                <button class="btn btn-primary btn-sm" data-toggle="modal" href="#edit_kpi_group_<?php echo $result_com["competency_id"]; ?>" >
                                                    <i class="glyphicon glyphicon-pencil"></i>แก้ไข
                                                </button>
                                                <!-- Modal Edit -->
                                                <div class="modal animated fade " id="edit_kpi_group_<?php echo $result_com["competency_id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                    <div class="modal-dialog" role="document">
                                                        <form method="GET">
                                                        <div class="modal-content">  
                                                            <div class="modal-header bg-blue">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title" id="myModalLabel">แก้ไขหัวข้อ</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <div style="width: 75%;margin: auto;">
                                                                            <div class="form-group">
                                                                                <label class="pull-left">หัวข้อ</label>
                                                                                <input type="text" class="form-control" name="title_name" placeholder="ชื่อหัวข้อCompetency" value="<?php echo $result_com["title_name"]; ?>" required disabled="true" >

                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label class="pull-left">แก้ไขรายละเอียด</label>
                                                                                <textarea class="form-control" rows="3" name="competency_desc"  required ><?php echo $result_com["competency_description"]; ?></textarea>

                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="hidden" name="titleid" value="<?php echo $result_com["title_id"]; ?>" >
                                                                <input type="hidden" name="competency_id" value="<?php echo $result_com["competency_id"]; ?>" >   
                                                                <input type="submit" class="btn btn-success" name="submit_edit" value="บันทึก" >                                                      
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                            </div>                 
                                                        </div>
                                                        </form>
                                                    </div>  
                                                </div>
                                            <!--/Modal Edit--> 
                                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#<?php echo $result_com["competency_id"]; ?>_delete" data-href="added_competency.php?comp_id=<?php echo $result_com["competency_id"]; ?>&delete_group=1&title_id=<?php echo $result_com["title_id"]; ?>">
                                                    <i class="glyphicon glyphicon-remove"></i>ลบ
                                                </button>
                                                <!--Modal delete-->
                                                <form class="form-horizontal" name="frmMain" method="get" action="" >
                                                <div class="modal fade" id="<?php echo $result_com["competency_id"]; ?>_delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title" id="myModalLabel">ลบข้อมูล</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="input-group col-sm-12" >
                                                                    <label for="" class="col-sm-4 control-label">Competency name</label>
                                                                    <div class="col-sm-8">               
                                                                        <input type="text" class="form-control" value="<?php echo $result_com["competency_description"]; ?>" name='textcom' disabled="true"  >
                                                                    </div>

                                                                </div>
                                                                <div class="input-group col-sm-12" >
                                                                    <label for="" class="col-sm-4 control-label">Title name</label>
                                                                    <div class="col-sm-8">               
                                                                        <input type="text" class="form-control" value="<?php echo $result_com["title_name"]; ?>" name='textfullcom' disabled="true"  >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="hidden" name="delete_group" value="1" >
                                                                <input type="hidden" name="comp_id" value="<?php echo $result_com["competency_id"];?>" >
                                                                <input type="hidden" name="title_id" value="<?php echo $result_com["title_id"];?>" >
                                                                <button type="submit" class="btn btn-danger">ยืนยันการลบ</button>
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                                <!--/Modal delete-->
                                            </td>
                                        </tr>
                                                 
                                         <?php } ?>
                                    </tbody>
                                    <script>
                                        var options = {
                                            valueNames: [ 'competency_id' , 'competency_name','title_name']
                                        };
                                        
                                        var userList = new List('filter', options);
                                    </script>
                                    </table>
                                </div>
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