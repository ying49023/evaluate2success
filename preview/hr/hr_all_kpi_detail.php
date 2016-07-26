<!DOCTYPE html>
<html>
    <head>
        <?php include('./classes/connection_mysqli.php') ?>
        <?php
        $get_department_id = '';
        if (isset($_GET["department_id"])) {
            $get_department_id = $_GET["department_id"];
        }
        $get_job_id = '';
        if (isset($_GET["job_id"])) {
            $get_job_id = $_GET["job_id"];
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
                        ดูKPIsทั้งหมด
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
                <div class="row box-padding">
                    <div class="box box-success">
                        <div class="box-body">
                            <form action="" method="GET">
                                <div class="col-md-offset-1 col-md-4">
                                    <label class="col-sm-4 control-label">แผนก</label>
                                    <div class="col-sm-8">
                                    <?php 
                                        $sql_department = "SELECT * FROM departments ";
                                        $query_department = mysqli_query($conn, $sql_department);
                                    ?>
                                        <select class="form-control" name="department_id">
                                            <option value="">เลือกทั้งหมด</option>
                                        <?php while($result_department = mysqli_fetch_array($query_department,MYSQLI_ASSOC)) { ?>
                                            <option value="<?php echo $result_department["department_id"]; ?>" <?php if($get_department_id == $result_department["department_id"]) { echo "selected"; }  ?> >
                                                <?php echo $result_department["department_name"]; ?>
                                            </option>
                                        <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-sm-4 control-label">ตำแหน่ง</label>
                                    <div class="col-sm-8">
                                    <?php 
                                        $sql_job = "SELECT distinct(job_name), job_id FROM jobs ";
                                        $query_job = mysqli_query($conn, $sql_job);
                                    ?>
                                        <select class="form-control" name="job_id">
                                            <option value="">เลือกทั้งหมด</option>
                                        <?php while($result_job = mysqli_fetch_array($query_job,MYSQLI_ASSOC)) { ?>
                                            <option value="<?php echo $result_job["job_id"]; ?>" <?php if($get_job_id == $result_job["job_id"]) { echo "selected"; }  ?> >
                                                <?php echo $result_job["job_name"]; ?>
                                            </option>
                                        <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class=" col-md-2">
                                    <input type="submit" class="btn btn-primary search-button " value="ค้นหา" >
                                </div>
                                
                            </form>
                        </div>
                    </div>
                    
                </div>
                <?php 
                                
                $condition_search = '';
                
                if($get_department_id != '' && $get_job_id != ''){
                    $condition_search = " WHERE g.department_id = '".$get_department_id."' AND g.job_id = '".$get_job_id."' ";
                }else if($get_department_id != '' || $get_job_id != ''){
                    if($get_department_id != ''){
                        $condition_search = " WHERE g.department_id = '".$get_department_id."' ";
                    }else if($get_job_id != ''){
                        $condition_search = " WHERE g.job_id = '".$get_job_id."' ";
                    }
                }
                
                ?>
                <div class="row box-padding">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <b>รายชื่อ KPIs ทั้งหมด</b>
                            <button type="button" class="pull-right btn btn-success btn-sm" data-toggle="modal" data-target="#new_kpi">
                                <i class="glyphicon glyphicon-plus" ></i> &nbsp;เพิ่ม
                            </button>  
                        </div>
                        <!-- Modal -->   
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
                                                        <?php
                                                        $sql_department = "SELECT * FROM departments ";
                                                            $query_department = mysqli_query($conn, $sql_department);
                                                        ?>
                                             
                                                        <div class="form-group">
                                                            <label>แผนก<span style="color: red;">*</span></label>
                                                            <select class="form-control" name="department_id" required>
                                                                <option value="">--เลือกแผนก--</option>
                                                                        <?php while ($result_department = mysqli_fetch_array($query_department)) { ?>
                                                                <option value="<?php echo $result_department["department_id"]; ?>">
                                                                                <?php echo $result_department["department_id"] . " - " . $result_department["department_name"]; ?>
                                                                </option>
                                                                        <?php } ?>
                                                            </select>                                                        
                                                        </div>
                                                        <?php
                                                            $sql_job = "SELECT * FROM jobs ";
                                                            $query_job = mysqli_query($conn, $sql_job);
                                                            ?>                                               
                                                        <div class="form-group">
                                                            <label>ตำแหน่ง<span style="color: red;">*</span></label>
                                                            <select class="form-control" name="job_id" required>
                                                                <option value="">--เลือกตำแหน่ง--</option>
                                                                        <?php while ($result_job = mysqli_fetch_array($query_job)) { ?>
                                                                <option value="<?php echo $result_job["job_id"]; ?>">
                                                                                <?php echo $result_job["job_id"] . " - " . $result_job["job_name"]; ?>
                                                                </option>
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
                        <!--Modal-->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                <?php
                                $sql_kpi = "SELECT
                                                    k.kpi_id as kpi_id,
                                                    k.kpi_name as kpi_name,
                                                    k.kpi_description as kpi_description,
                                                    k.unit as unit,
                                                    j.job_name as job_name,
                                                    d.department_name as department_name
                                            FROM
                                                    kpi k
                                            JOIN kpi_group g ON k.kpi_id = g.kpi_id
                                            JOIN departments d ON g.department_id = d.department_id
                                            JOIN jobs j ON j.job_id = g.job_id ".$condition_search." 
                                            ORDER BY
                                                    k.kpi_id,j.job_name";
                                $query_kpi = mysqli_query($conn, $sql_kpi);
                                
                                ?>
                                    <table class="table table-hover table-responsive table-striped">                               
                                        <thead>
                                            <tr>
                                                <th = >ID</th>
                                                <th>ชื่อKPIs</th>
                                                <th>คำอธิบาย</th>
                                                <th>หน่วย</th>
                                                <th>ตำแหน่ง</th>
                                                <th>แผนก</th>
                                                <th>แก้ไข/ลบ</th>
                                            </tr>
                                        </thead>
                                    <?php while ($result_kpi = mysqli_fetch_array($query_kpi, MYSQLI_ASSOC)) { ?>
                                        <tr>
                                            <td><b><?php echo $result_kpi["kpi_id"]; ?></b></td>
                                            <td style="width: 250px"><?php echo $result_kpi["kpi_name"]; ?></td>
                                            <td style="width: 250px"><?php echo $result_kpi["kpi_description"]; ?></td>
                                            <td><?php echo $result_kpi["unit"]; ?></td>
                                            <td><?php echo $result_kpi["job_name"]; ?></td>
                                            <td><?php echo $result_kpi["department_name"]; ?></td>
                                            <td><div class="dropdown">
                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    <i class="glyphicon glyphicon-cog"></i>
                                                  <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                  <li><a data-toggle="modal" href="#edit_kpi_<?php echo $result_kpi["kpi_id"]; ?>" ><i class="glyphicon glyphicon-pencil"></i>แก้ไข</a></li>
                                                  <li role="separator" class="divider"></li>
                                                  <li><a href="delete_kpi.php?kpi_id=<?php echo $result_kpi["kpi_id"]; ?>"><i class="glyphicon glyphicon-remove"></i>ลบ</a></li>
                                                </ul>
                                              </div>
                                            </td>
                                        </tr>
                                        <!-- Modal -->   
                                            <div class="modal animated fade " id="edit_kpi_<?php echo $result_kpi["kpi_id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <form action="edit_kpi.php" method="post">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title" id="myModalLabel">แก้ไขหัวข้อ KPI</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <div style="width: 75%;margin: auto;">
                                                                            <div class="form-group">
                                                                                <label class="pull-left">ชื่อหัวข้อKPI </label>
                                                                                <input type="text" class="form-control" name="kpi_name" placeholder="ชื่อหัวข้อKPI" value="<?php echo $result_kpi["kpi_name"]; ?>" />
                                                                                <input type="hidden" name="kpi_id" value="<?php echo $result_kpi["kpi_id"]; ?>" />
                                                                            </div>
                                                                            
                                                                            <div class="form-group">
                                                                                <label class="pull-left">คำอธิบาย </label>
                                                                                <input type="text" class="form-control" name="kpi_description" placeholder="คำอธิบายKPI" value="<?php echo $result_kpi["kpi_description"]; ?>" />
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label class="pull-left">หน่วย </label>
                                                                                <input type="text" class="form-control" name="unit" placeholder="ระบุหน่วย" value="<?php echo $result_kpi["unit"]; ?>" />
                                                                            </div>
                                                                            <?php
                                                                            $sql_department = "SELECT * FROM departments ";
                                                                            $query_department = mysqli_query($conn, $sql_department);
                                                                            ?>

                                                                            <div class="form-group">
                                                                                <label>แผนก</label>
                                                                                <select class="form-control" name="department_id">
                                                                                    <option value="">--เลือกแผนก--</option>
                                                                                    <?php while ($result_department = mysqli_fetch_array($query_department)) { ?>
                                                                                        <option value="<?php echo $result_department["department_id"]; ?>" <?php if($result_kpi["department_name"] == $result_department["department_name"]){ echo "selected" ; } ?> >
                                                                                            <?php echo $result_department["department_id"] . " - " . $result_department["department_name"]; ?>
                                                                                        </option>
                                                                                    <?php } ?>
                                                                                </select>                                                        
                                                                            </div>
                                                                            <?php
                                                                            $sql_job = "SELECT * FROM jobs ";
                                                                            $query_job = mysqli_query($conn, $sql_job);
                                                                            ?>                                               
                                                                            <div class="form-group">
                                                                                <label>ตำแหน่ง</label>
                                                                                <select class="form-control" name="job_id">
                                                                                    <option value="">--เลือกตำแหน่ง--</option>
                                                                                    <?php while ($result_job = mysqli_fetch_array($query_job)) { ?>
                                                                                        <option value="<?php echo $result_job["job_id"]; ?>" <?php if($result_kpi["job_name"] == $result_job["job_name"]){ echo "selected" ; } ?> >
                                                                                            <?php echo $result_job["job_id"] . " - " . $result_job["job_name"]; ?>
                                                                                        </option>
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
                                            <!--Modal-->
                                    <?php } ?>
                                        
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