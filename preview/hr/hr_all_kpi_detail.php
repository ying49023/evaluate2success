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
        $get_department_id = '';
        if (isset($_GET["department_id"])) {
            $get_department_id = $_GET["department_id"];
        }
        $get_job_id = '';
        if (isset($_GET["job_id"])) {
            $get_job_id = $_GET["job_id"];
        }
        ?>
        <?php
        $condition_search = '';

        if ($get_department_id != '' && $get_job_id != '') {
            $condition_search = " WHERE mk.department_id = '" . $get_department_id . "' AND mk.job_id = '" . $get_job_id . "' ";
        } else if ($get_department_id != '' || $get_job_id != '') {
            if ($get_department_id != '') {
                $condition_search = " WHERE mk.department_id = '" . $get_department_id . "' ";
            } else if ($get_job_id != '') {
                $condition_search = " WHERE mk.job_id = '" . $get_job_id . "' ";
            }
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
        <script>
            function getJobs(val) {
                $.ajax({
                    type: "POST",
                    url: "get_jobs.php",
                    data:'department_id='+val,
                    success: function(data){
                        $("#list").html(data);
                        $("#list2").html(data);
                        $("#list3").html(data);
                    }
                });
            }
        </script>
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
                        ข้อมูล KPIs ตามแผนก / ตำแหน่ง
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.php"> <i class="fa fa-dashboard"></i>Home</a>
                        </li>
                        <li class="active">
                            <a href="hr_all_kpi_detail.php">KPIs Department & Job</a>
                        </li>
                    </ol>
                </section>
                <!--/Page header -->
                
                <!-- Main content -->
                <!-- Search -->
            <div class="row box-padding">
                <div class="box box-success">
                    <div class="box-header ">
                        <form method="get">
<!--                            <div class="col-md-2 col-sm-6">
                                <div class="form-group">
                                    <label class=" control-label">ปี</label>
                                                <?php
                                                $sql_eval = "SELECT DISTINCT(year) FROM evaluation ORDER BY year , term_id ASC";
                                                $query_eval = mysqli_query($conn, $sql_eval);
                                                ?>
                                        <select class="form-control input-small" name="year" required>

                                                    <?php while ($result_eval = mysqli_fetch_array($query_eval, MYSQLI_ASSOC)) { ?>
                                            <option value="<?php echo $result_eval["year"]; ?>"<?php if ($get_year == $result_eval["year"]) {
                                                echo "selected"; } ?> >
                                                    <?php echo 'ปี ' . $result_eval["year"]; ?>

                                            </option>

                                                    <?php } ?>
                                        </select>
                                </div>

                            </div>
                            <div class="col-md-2 col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">รอบ</label>
                                    <select class="form-control" name="term">
                                        <option value="">เลือกทั้งหมด</option>
                                        <option value="1" <?php if($get_term == '1') { echo "selected"; }  ?> >รอบที่ 1</option>
                                        <option value="2" <?php if($get_term == '2') { echo "selected"; }  ?> >รอบที่ 2</option>
                                    </select>
                                </div>
                            </div>-->
                            <div class="col-md-5 col-sm-5">
                                <div class="form-group">
                                    <label class=" control-label">แผนก/ฝ่าย</label>
                                    <div class="">
                                    <?php 
                                        $sql_department = "SELECT * FROM departments ";
                                        $query_department = mysqli_query($conn, $sql_department);
                                    ?>
                                        <select class="form-control" name="department_id" onchange="getJobs(this.value);" <?php if ($my_position_level == "2" || $my_position_level == "3") { echo "disabled"; } ?>  >
                                        <option value="">เลือกทั้งหมด</option>
                                        
                                        <?php foreach ($query_department as $result_department){ ?>
                                            <option value="<?php  echo $result_department["department_id"];  ?>" <?php if($get_department_id == $result_department["department_id"]) { echo "selected"; }  ?> >
                                                <?php echo $result_department["department_name"]; ?>
                                            </option>
                                            <?php } ?>
                                        
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-5 col-sm-5">
                                <div class="form-group" >
                                    <label class=" control-label">ตำแหน่ง</label>
                                    <div class="">
                                    <?php 
                                        $sql_job = "SELECT distinct(job_name), job_id FROM jobs WHERE department_id = '".$get_department_id."' ";
                                        $query_job = mysqli_query($conn, $sql_job);

                                    ?>
                                        <select class="form-control" name="job_id" id="list">
                                            <option value="">เลือกตำแหน่งทั้งหมด</option>
                                            <?php 
                                            if (isset($_GET["department_id"])) {
                                                if($_GET["department_id"] != ''){
                                            foreach($query_job as $result_job){ ?>
                                            <option value="<?php echo $result_job["job_id"]; ?>" <?php if($get_job_id == $result_job["job_id"]){ echo "selected"; } ?> >
                                                <?php echo $result_job["job_name"]; ?>
                                            </option>
                                            <?php }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2">
                                <div class="form-group">
                                    <div class=" pull-right">
                                    <button type="submit" class="btn btn-primary " style="width: 100px;margin-top: 25px;" ><i class="glyphicon glyphicon-search"></i>&nbsp;&nbsp;ค้นหา</button>
                                </div>
                                </div>
                                    
                            </div>
                           
                        </form>
                    </div>
                </div>
            </div>
            <!--/Search -->
                
                <div id="filter" class="row box-padding">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">รายชื่อ KPIs ทั้งหมด</h3>
                            <button type="button" class="pull-right btn btn-success btn-sm" data-toggle="modal" data-target="#new_kpi">
                                <i class="glyphicon glyphicon-plus" ></i> &nbsp;เพิ่ม
                            </button>  
                        </div>
                        <!-- Modal New-->   
                        <div class="modal animated fade " id="new_kpi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="new_kpi_group.php" method="post">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">เพิ่มหัวข้อ KPI</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div style="width: 75%;margin: auto;">
                                                        <?php
                                                        $sql_kpi_list = "SELECT * FROM kpi ";
                                                            $query_kpi_list = mysqli_query($conn, $sql_kpi_list);
                                                        ?>
                                             
                                                        <div class="form-group">
                                                            <label>ชื่อหัวข้อKPI<span style="color: red;">*</span></label>
                                                            <select class="form-control" name="kpi_id" required>
                                                                <option value="">--เลือกชื่อหัวข้อKPI--</option>
                                                                        <?php while ($result_kpi_list = mysqli_fetch_array($query_kpi_list)) { ?>
                                                                <option value="<?php echo $result_kpi_list["kpi_id"]; ?>">
                                                                                <?php echo $result_kpi_list["kpi_id"] . " - " . $result_kpi_list["kpi_name"]; ?>
                                                                </option>
                                                                        <?php } ?>
                                                            </select>                                                        
                                                        </div>
                                                        
                                                        <?php
                                                        $sql_department = "SELECT * FROM departments ";
                                                            $query_department = mysqli_query($conn, $sql_department);
                                                        ?>
                                             
                                                        <div class="form-group">
                                                            <label>แผนก<span style="color: red;">*</span></label>
                                                            <select class="form-control" name="department_id" onchange="getJobs(this.value);" required>
                                                                <option value="">--เลือกแผนก--</option>
                                                                <?php foreach ($query_department as $result_department) { ?>
                                                                <option value="<?php echo $result_department["department_id"]; ?>">
                                                                                <?php echo $result_department["department_id"] . " - " . $result_department["department_name"]; ?>
                                                                </option>
                                                                <?php } ?>
                                                            </select>                                                        
                                                        </div>
                                                        <?php
//                                                            $sql_job = "SELECT * FROM jobs ";
//                                                            $query_job = mysqli_query($conn, $sql_job);
                                                            ?>                                               
                                                        <div class="form-group">
                                                            <label>ตำแหน่ง<span style="color: red;">*</span></label>
                                                            <select class="form-control" name="job_id" id="list2" required>
                                                                <option value="">--เลือกตำแหน่ง--</option>
                                                                        <?php // while ($result_job = mysqli_fetch_array($query_job)) { ?>
<!--                                                                <option value="<?php echo $result_job["job_id"]; ?>">
                                                                                <?php echo $result_job["job_id"] . " - " . $result_job["job_name"]; ?>
                                                                </option>-->
                                                                        <?php // } ?>
                                                            </select>
                                                        </div>
                                                        <?php
//                                                        $sql_kpi_group = "SELECT * FROM kpi_group ";
//                                                        $query_kpi_group = mysqli_query($conn, $sql_kpi_group);
                                                        ?>
                                             
<!--                                                        <div class="form-group">
                                                            <label>กลุ่ม KPI<span style="color: red;">*</span></label>
                                                            <select class="form-control" name="kpi_group_id" required>
                                                                <option value="">--เลือกกลุ่ม KPI--</option>
                                                                        <?php //foreach ($query_kpi_group as $result_kpi_group) { ?>
                                                                <option value="<?php //echo $result_kpi_group["kpi_group_id"]; ?>">
                                                                                <?php //echo $result_kpi_group["kpi_group_name"]; ?>
                                                                </option>
                                                                        <?php //} ?>
                                                            </select>                                                        
                                                        </div>-->
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
                                <?php
                                $sql_kpi = "SELECT
                                                  *
                                            FROM
                                                    manage_kpi mk
                                            JOIN kpi k ON mk.kpi_id = k.kpi_id
                                            JOIN departments d ON d.department_id = mk.department_id
                                            JOIN jobs j ON j.job_id = mk.job_id ".$condition_search."
                                            ORDER BY mk.manage_kpi_id";
                                $query_kpi = mysqli_query($conn, $sql_kpi);
                                
                                ?>
                                    <!-- ช่องค้นหา by listJS -->
                                    <div class="form-group col-md-5 col-sm-6 col-lg-4">
                                        <label><i class="glyphicon glyphicon-search" style="padding: 0px 10px;" ></i>ค้นหา</label>
                                        <input class="search form-control" placeholder="พิมพ์ค้นหา" >
                                    </div>
                                    
                                    <table class="table table-hover table-responsive table-bordered table-striped">                               
                                        <thead>
                                            <tr class="text-middle">
                                                <th style="width: 75px;"><button class="sort" data-sort="no">No</button></th>
                                                <th style="width: 250px"><button class="sort" data-sort="kpi_name">ชื่อ KPIs</button></th>
                                                <th style="width: 250px"><button class="sort" data-sort="kpi_desc">คำอธิบาย</button></th>
                                                <th style="width: 75px;"><button class="sort" data-sort="unit">หน่วย</button></th>
                                                <th ><button class="sort" data-sort="job_name">ตำแหน่ง</button></th>
                                                <th ><button class="sort" data-sort="dept_name">แผนก</button></th>
                                                <th style="width:135px;text-align: center;">แก้ไข/ลบ</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list" >
                                        <?php while ($result_kpi = mysqli_fetch_array($query_kpi, MYSQLI_ASSOC)) { ?>
                                            <tr class="text-middle">
                                                <td class="no"><b><?php echo $result_kpi["manage_kpi_id"]; ?></b></td>
                                                <td class="kpi_name"><?php echo $result_kpi["kpi_name"]; ?></td>
                                                <td class="kpi_desc"><?php echo $result_kpi["kpi_description"]; ?></td>
                                                <td class="unit"><?php echo $result_kpi["unit"]; ?></td>
                                                <td class="job_name"><?php echo $result_kpi["job_name"]; ?></td>
                                                <td class="dept_name"><?php echo $result_kpi["department_name"]; ?></td>
                                                <td>
                                                    <a class="btn btn-primary btn-sm" data-toggle="modal" href="#edit_kpi_<?php echo $result_kpi["kpi_id"]; ?>" ><i class="glyphicon glyphicon-pencil"></i>แก้ไข</a>
                                                    <a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#confirm-delete" data-href="delete_kpi_group.php?manage_kpi_id=<?php echo $result_kpi["manage_kpi_id"]; ?>&department_id=<?php echo $get_department_id; ?>&job_id=<?php echo $get_job_id; ?>" ><i class="glyphicon glyphicon-remove"></i>ลบ</a>
                                                    <!--Modal delete-->
                                                    <?php include('./modal_delete.php'); ?>
                                                    <!--/Modal delete-->

                                                </td>
                                            </tr>
                                        <!-- Modal Edit-->   
                                            <div class="modal animated fade " id="edit_kpi_<?php echo $result_kpi["kpi_id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <form action="edit_kpi_group.php" method="post">
                                                            <div class="modal-header bg-blue">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title" id="myModalLabel">แก้ไขหัวข้อ KPI</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <div style="width: 75%;margin: auto;">
                                                                            <?php
                                                                            $sql_kpi_list = "SELECT * FROM kpi ";
                                                                                $query_kpi_list = mysqli_query($conn, $sql_kpi_list);
                                                                            ?>

                                                                            <div class="form-group">
                                                                                <label>ชื่อหัวข้อKPI<span style="color: red;">*</span></label>
                                                                                <select class="form-control" name="kpi_id" required>
                                                                                    <option value="">--เลือกชื่อหัวข้อKPI--</option>
                                                                                            <?php while ($result_kpi_list = mysqli_fetch_array($query_kpi_list)) { ?>
                                                                                    <option value="<?php echo $result_kpi_list["kpi_id"]; ?>" <?php if($result_kpi_list["kpi_id"] == $result_kpi["kpi_id"]) { echo "selected"; } ?> >
                                                                                                    <?php echo $result_kpi_list["kpi_id"] . " - " . $result_kpi_list["kpi_name"]; ?>
                                                                                    </option>
                                                                                            <?php } ?>
                                                                                </select>                                                        
                                                                            </div>
                                                                            <?php
                                                                            $sql_department = "SELECT * FROM departments ";
                                                                            $query_department = mysqli_query($conn, $sql_department);
                                                                            ?>

                                                                            <div class="form-group">
                                                                                <label>แผนก</label>
                                                                                <select class="form-control" name="department_id" onchange="getJobs(this.value);">
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
                                                                                <select class="form-control" name="job_id" id="list3">
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
                                                                <input class="btn btn-success" type="submit" name="submit" value="บันทึก" />
                                                                <input type="hidden" name="manage_kpi_id" value="<?php echo $result_kpi["manage_kpi_id"]; ?>" >
                                                                <input type="hidden" name="post_department_id" value="<?php echo $get_department_id; ?>" >
                                                                <input type="hidden" name="post_job_id" value="<?php echo $get_job_id; ?>" >
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>  
                                            </div>
                                        <!--/Modal Edit-->
                                        <?php } ?>
                                        </tbody>
                                        <script>
                                            var options = {
                                                valueNames: [ 'no', 'kpi_name' , 'kpi_desc' ,'unit', 'job_name' , 'dept_name' ]
                                            };
                                            
                                            var userList = new List('filter', options);
                                        </script>
                                    </table>
                            
                        </div>
                    </div>
                    
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
    
</html>
            <?php
        }
    }

    
?>