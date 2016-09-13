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
        $get_kpi_group_id = '';
        if (isset($_GET["kpi_group_id"])) {
            $get_kpi_group_id = $_GET["kpi_group_id"];
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
                        ดู KPIs ทั้งหมด
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="#"> <i class="fa fa-dashboard"></i>
                                Home
                            </a>
                        </li>
                        <li class="active">All KPIs</li>
                    </ol>
                </section>
                <!--/Page header -->
                
                <!-- Main content -->
                <div  class="row box-padding">
                    <div class="box box-success">
                        <div class="box-body">
                            <form action="" method="GET">
                                <div class="col-sm-offset-1 col-sm-8">
                                    <label class="col-sm-2 control-label">กลุ่ม</label>
                                    <div class="col-sm-10">
                                        <?php
                                        $sql_kpi_group = "SELECT * FROM kpi_group";
                                        $query_kpi_group = mysqli_query($conn, $sql_kpi_group);
                                        ?>
                                        <select class="form-control" name="kpi_group_id">
                                            <option value="" >--แสดงทั้งหมด--</option>
                                            <?php while ($result_kpi_group = mysqli_fetch_array($query_kpi_group, MYSQLI_ASSOC)) { ?>
                                            <option value="<?php echo $result_kpi_group["kpi_group_id"]; ?>" <?php if($get_kpi_group_id == $result_kpi_group["kpi_group_id"]) { echo "selected"; }  ?>>
                                                    <?php echo $result_kpi_group["kpi_group_id"] . " - " . $result_kpi_group["kpi_group_name"]; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class=" col-sm-2">
                                    <input type="submit" class="btn btn-primary search-button " value="ค้นหา" >
                                </div>
                                
                            </form>
                        </div>
                    </div>
                    
                </div>
                <?php 
                                
                $condition_search = '';
                
                if($get_kpi_group_id != '' ){
                    $condition_search = " WHERE kg.kpi_group_id = '".$get_kpi_group_id."'";
                }                
                ?>
                <div id="filter" class="row box-padding">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <b>รายชื่อ KPIs ทั้งหมด</b>
                            <button type="button" class="pull-right btn btn-success btn-sm" data-toggle="modal" data-target="#new_kpi">
                                <i class="glyphicon glyphicon-plus" ></i> &nbsp;เพิ่ม
                            </button>  
                        </div>
                        <!-- Modal New-->   
                        <div class="modal animated fade " id="new_kpi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="new_kpi.php" method="post">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">เพิ่มหัวข้อ KPI</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div style="width: 75%;margin: auto;">
                                                        <div class="form-group">
                                                            <label class="pull-left">ชื่อหัวข้อKPI<span style="color: red;">*</span></label>
                                                            <input type="text" class="form-control" name="kpi_name" placeholder="ชื่อหัวข้อKPI" required />
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label class="pull-left">คำอธิบาย </label>
                                                            <input type="text" class="form-control" name="kpi_description" placeholder="คำอธิบายKPI" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="pull-left">หน่วย</label>
                                                            <input type="text" class="form-control" name="unit" placeholder="ระบุหน่วย" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="pull-left">ระยะเวลา(เดือน)</label>
                                                            <input type="text" class="form-control" name="time_period" placeholder="ระบุระยะเวลา" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="pull-left">กลุ่ม</label>
                                                            <?php
                                                            $sql_kpi_group = "SELECT * FROM kpi_group" ;
                                                            $query_kpi_group = mysqli_query($conn, $sql_kpi_group);
                                                            ?>
                                                            <select class="form-control" name="kpi_group_id" required>
                                                                <option value="" >--เลือกกลุ่ม--</option>
                                                                <?php while($result_kpi_group = mysqli_fetch_array($query_kpi_group,MYSQLI_ASSOC)) { ?>
                                                                <option value="<?php echo $result_kpi_group["kpi_group_id"]; ?>" ><?php echo $result_kpi_group["kpi_group_id"]." - ".$result_kpi_group["kpi_group_name"]; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>                                    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input class="btn btn-primary" type="submit" name="submit" value="บันทึก" />
                                            <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                        </div>
                                    </form>
                                </div>
                            </div>  
                        </div>
                        <!--/Modal New-->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                <!-- ช่องค้นหา by listJS -->
                                <div class="form-inline padding-small">
                                    <i class="glyphicon glyphicon-search" style="padding: 0px 10px;" ></i>
                                    <input class="search form-control" placeholder="ค้นหา" />
                                </div>
                                
                                <?php
                                $sql_kpi = "SELECT
                                                    k.kpi_id AS kpi_id,
                                                    k.kpi_name AS kpi_name,
                                                    k.kpi_description AS kpi_description,
                                                    kg.kpi_group_name,
                                                    k.time_period as time_period,
                                                    k.unit AS unit,
                                                    k.kpi_group_id
                                            FROM
                                                    kpi k
                                            JOIN kpi_group kg ON k.kpi_group_id = kg.kpi_group_id
                                            ".$condition_search."
                                            ORDER BY
                                                    k.kpi_id";
                                $query_kpi = mysqli_query($conn, $sql_kpi);
                                
                                ?>
                                    <table class="display table table-hover table-bordered table-responsive table-striped">                               
                                        <thead>
                                            <tr>
                                                <th style="width: 65px;"><button class="sort" data-sort="id">ID</button></th>
                                                <th style="width: 200px;"><button class="sort" data-sort="kpi_name">ชื่อKPIs</button></th>
                                                <th><button class="sort" data-sort="kpi_desc">คำอธิบาย</button></th>
                                                <th style="width: 75px;text-align: center;"><button class="sort" data-sort="unit">หน่วย</button></th>
                                                <th style="width: 145px;text-align: center;"><button class="sort" data-sort="period">ระยะเวลา(เดือน)</button></th> 
                                                <th style="width: 150px;"><button class="sort" data-sort="group">กลุ่มหมวดหมู่</button></th>
                                                <th style="width: 135px;text-align: center;">แก้ไข/ลบ</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list">
                                    <?php while ($result_kpi = mysqli_fetch_array($query_kpi, MYSQLI_ASSOC)) { ?>
                                        <tr>
                                            <td class="id" ><b><?php echo $result_kpi["kpi_id"]; ?></b></td>
                                            <td class="kpi_name" ><?php echo $result_kpi["kpi_name"]; ?></td>
                                            <td class="kpi_desc" ><?php echo $result_kpi["kpi_description"]; ?></td>
                                            <td class="unit" class="text-center"><?php echo $result_kpi["unit"]; ?></td>
                                            <td class="period" class="text-center"><?php echo $result_kpi["time_period"]; ?></td>
                                            <td class="group" ><?php echo $result_kpi["kpi_group_name"]; ?></td>
                                            <td>
                                                <a class="btn btn-default btn-sm" data-toggle="modal" href="#edit_kpi_<?php echo $result_kpi["kpi_id"]; ?>" ><i class="glyphicon glyphicon-pencil"></i>แก้ไข</a>
                                                <a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#confirm-delete" data-href="delete_kpi.php?kpi_id=<?php echo $result_kpi["kpi_id"]; ?>&kpi_group_id=<?php echo $get_kpi_group_id; ?>">
                                                <i class="glyphicon glyphicon-remove"></i>ลบ</a>
                                                <!-- Modal Edit -->
                                                <?php include('./modal_edit_all_kpi.php') ; ?>
                                                <!--/Modal Edit-->        
                                                <!--Modal delete-->
                                                <?php include('./modal_delete_all_kpi.php'); ?>
                                                
                                                <!--/Modal delete-->
                                            </td>
                                            
                                        </tr>
                                        
                                    <?php } ?>
                                        </tbody>
                                        <script>
                                            var options = {
                                                valueNames: [ 'id', 'kpi_name' , 'kpi_desc' , 'unit' , 'period' , 'group' ];
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
    
</html>
            <?php
        }
    }

    
?>