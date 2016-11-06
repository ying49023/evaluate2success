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
        //Insert
        if(isset($_GET["submit_insert"])){
            
            $sql_insert_group = "INSERT INTO kpi_group (kpi_group_name) VALUES ('".$_GET["kpi_group_name"]."')";
            if (mysqli_query($conn, $sql_insert_group)) {
                    echo "Record new successfully";
                    echo $sql_insert_group;
                } else {
                    echo "Error new record: " . mysqli_error($conn);
                    echo $sql_insert_group;
                }
                    
                header("Location: hr_kpi_group.php");
            }
        //Edit
        if(isset($_GET["submit_edit"])){
            
            $sql_edit_group = "UPDATE kpi_group SET kpi_group_name='".$_GET["kpi_group_name"]."' , kpi_group_detail='".$_GET["kpi_group_detail"]."' WHERE kpi_group_id='".$_GET["kpi_group_id"]."'";
            if (mysqli_query($conn, $sql_edit_group)) {
                    echo "Record edit successfully";
                    echo $sql_edit_group;
                } else {
                    echo "Error edit record: " . mysqli_error($conn);
                    echo $sql_edit_group;
                }
                    
                header("Location: hr_kpi_group.php");
            }
        //Delete  
        if(isset($_GET["delete_group"])){
            
            $sql_delete_group = "DELETE FROM kpi_group WHERE kpi_group_id = '".$_GET["kpi_group_id"]."'";
            if (mysqli_query($conn, $sql_delete_group)) {
                    echo "Record new successfully";
                    echo $sql_delete_group;
                } else {
                    echo "Error new record: " . mysqli_error($conn);
                    echo $sql_delete_group;
                }
                    
                header("Location: hr_kpi_group.php");
            }
                
        ?>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>ระบบประเมินผลปฏิบัติงาน : ALT Evaluation</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!--CSS PACKS -->
        <?php include ('./css_packs.html'); ?>
        <!-- SCRIPT PACKS -->
        <?php include ('./script_packs.html'); ?>
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
                        กลุ่มทั้งหมด
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="#"> <i class="fa fa-dashboard"></i>
                                Home
                            </a>
                        </li>
                        <li class="active">KPIs group</li>
                    </ol>
                </section>
                <!--/Page header -->
                
                <!-- Main content -->
                
                <div id="filter" class="row box-padding">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">กลุ่มทั้งหมด</h3>
                            <button class="btn btn-success pull-right"  data-toggle="collapse" data-target="#newKPIGroup">+ เพิ่ม</button>
                        </div>
                        <div id="newKPIGroup" class="collapse box-padding bg-gray-light ">
                            <form action="" method="get">
                                <div class="row">
                                    <div class="form-group col-md-2 col-sm-3">
                                        <label>สร้างชื่อกลุ่ม<span style="color: red;">*</span></label>
                                        <input class="form-control" type="text"  step="5" name="kpi_group_name" required > 
                                    </div>
                                    <div class="form-group col-md-5 col-sm-5">
                                        <label>คำอธิบาย<span style="color: red;">*</span></label>
                                        <input class="form-control" type="text"  step="5" name="kpi_group_detail" required > 
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <input style="margin-top: 25px;width: 100px;" class="btn btn-info search" type="submit"  name="submit_insert" value="เพิ่ม" > 
                                        <input  type="hidden" name="emp_id" value="<?php echo $get_emp_id; ?>" >
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="box-body">
                            <!-- ช่องค้นหา by listJS -->
                            <div class="form-group col-md-5 col-sm-6 col-lg-4">
                                <label><i class="glyphicon glyphicon-search" style="padding: 0px 10px;" ></i>ค้นหา</label>
                                <input class="search form-control" placeholder="พิมพ์ค้นหา" >
                            </div>
                                <?php
                                $sql_kpi_group = "SELECT * FROM kpi_group ORDER BY	kpi_group_id ASC";
                                $query_kpi_group = mysqli_query($conn, $sql_kpi_group);
                                
                                ?>
                                    <table class="display table table-hover table-responsive table-striped table-bordered">                               
                                        <thead>
                                            <tr>
                                                <th  style="width: 120px;">
                                                    <button class="sort" data-sort="group_id">Group ID</button>
                                                </th>
                                                <th style="width: 120px;">
                                                    <button class="sort" data-sort="kpi_group_name">
                                                        ชื่อกลุ่ม
                                                    </button>
                                                </th>
                                                <th>
                                                    <button class="sort" data-sort="kpi_group_detail">
                                                    คำอธิบาย
                                                    </button>
                                                </th>
                                                <th style="width: 150px;text-align: center;">แก้ไข/ลบ</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list">
                                    <?php while ($result_kpi_group = mysqli_fetch_array($query_kpi_group, MYSQLI_ASSOC)) { ?>
                                        <tr>
                                            <td class="group_id"><b><?php echo $result_kpi_group["kpi_group_id"]; ?></b></td>
                                            <td class="kpi_group_name"><?php echo $result_kpi_group["kpi_group_name"]; ?></td>
                                            <td class="kpi_group_detail"><?php echo $result_kpi_group["kpi_group_detail"]; ?></td>
                                            <td class="edit_delete" style="text-align: center;">

                                                <a class="btn btn-primary btn-sm" data-toggle="modal" href="#edit_kpi_group_<?php echo $result_kpi_group["kpi_group_id"]; ?>" ><i class="glyphicon glyphicon-pencil"></i>แก้ไข</a>

                                                  <a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#confirm-delete" data-href="hr_kpi_group.php?kpi_group_id=<?php echo $result_kpi_group["kpi_group_id"]; ?>&delete_group=1">
                                                          <i class="glyphicon glyphicon-remove"></i>ลบ</a>

                                                <!-- Modal Edit -->   
                                                <form action="" method="get" >
                                                <div class="modal animated fade " id="edit_kpi_group_<?php echo $result_kpi_group["kpi_group_id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                    <div class="modal-dialog" role="document">
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
                                                                                <label class="pull-left">แก้ไขชื่อกลุ่ม<span style="color: red;">*</span></label>
                                                                                <input type="text" class="form-control" name="kpi_group_name" placeholder="ชื่อกลุ่มKPI" value="<?php echo $result_kpi_group["kpi_group_name"]; ?>" required >

                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <div style="width: 75%;margin: auto;">
                                                                            <div class="form-group">
                                                                                <label class="pull-left">แก้ไขคำอธิบาย<span style="color: red;">*</span></label>
                                                                                <input type="text" class="form-control" name="kpi_group_detail" placeholder="คำอธิบาย" value="<?php echo $result_kpi_group["kpi_group_detail"]; ?>" required >

                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input class="btn btn-success" type="submit" name="submit_edit" value="บันทึก" >
                                                                <input type="hidden" name="kpi_group_id" value="<?php echo $result_kpi_group["kpi_group_id"]; ?>" >
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                            </div>                 
                                                        </div>
                                                    </div>  
                                                </div>
                                                </form>
                                                <!--/Modal Edit-->
                                                <!--Modal delete-->
                                                      <?php include ('./modal_delete.php'); ?>
                                                <!--/Modal delete-->
                                                      
                                            </td>
                                        </tr>
                                         <?php } ?>
                                    </tbody>
                                    <script>
                                        var options = {
                                            valueNames: [ 'group_id', 'kpi_group_name','kpi_group_detail' ]
                                        };
                                        var userList = new List('filter', options);
                                </script>
                                    </table>
                            
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

</html>
            <?php
        }
    }

    
?>