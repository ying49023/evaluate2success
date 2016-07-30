<!DOCTYPE html>
<html>
    <head>
        <?php include ('./classes/connection_mysqli.php');?>
        <?php
        $get_department_id = '';
        if (isset($_GET["department_id"])) {
            $get_department_id = $_GET["department_id"];
        }

        $condition_search = '';
        if ($get_department_id != '') {
            $condition_search = " WHERE dept.department_id = '" . $get_department_id . "'";
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
                        KPIs ที่รับผิดชอบรายบุคคลของพนักงาน
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Individual KPIs</li>
                    </ol>
                </section>
                <!--/Page header -->

                <!-- Main content -->
                <div class="row box-padding">
                    <div class="box box-success">
                        <div class="box-body ">
                            <form method="get">
                                <div class=" col-md-3">
                                    <label class="col-sm-4 control-label">รหัสพนักงาน</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="text"  name="emp_id" >
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="col-sm-4 control-label">ชื่อ-นามสกุล</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="text"  name="emp_name" >
                                    </div>
                                </div>
                                 <div class="col-md-4">
                                 <label class="col-sm-4 control-label">แผนก</label>
                                <div class="col-sm-8">
                                    <?php
                                    $sql_department = "SELECT * FROM departments ";
                                    $query_department = mysqli_query($conn, $sql_department);
                                    ?>
                                    <select class="form-control" name="department_id">
                                        <option value="">เลือกทั้งหมด</option>
                                        <?php while ($result_department = mysqli_fetch_array($query_department, MYSQLI_ASSOC)) { ?>
                                        <option value="<?php echo $result_department["department_id"]; ?>" <?php if($get_department_id == $result_department["department_id"]) { echo "selected"; }  ?> >
                                            <?php echo $result_department["department_name"]; ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                 </div>

                           <div class="col-md-1">
                                <button class="btn btn-primary search-button" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </div>

                            </form>
                        </div>

                    </div>
                </div>
                
                
                <div class="row box-padding">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h4>ตารางรายชื่อพนักงาน</h4>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"> <i class="fa fa-minus"></i>
                                </button>
                                
                                <button type="button" class="btn btn-box-tool" data-widget="remove">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
     
                        <div class="box-body ">    
                            <table class="table table-bordered table-hover">
                                <thead>
                               
                                    <tr class="bg-gray-light">
                                        <th class="text-center">ID</th>
                                        <th>ชื่อ-นามสกุล</th>
                                        <th class="text-center">ตำแหน่ง</th>
                                        <th class="text-center">แผนก</th>
                                        <th class="text-center">KPI ที่รับผิดชอบ</th>
                                        
                                    </tr>
                                </thead>
                                <?php
                    
                                $sql_emp = "SELECT emp.employee_id as emp_id, emp.prefix as prefix, emp.first_name as f_name, emp.last_name as l_name, "
                                                    . "dept.department_name as dept_name, j.job_name as job FROM employees emp "
                                                    . "join departments dept on emp.department_id = dept.department_id join jobs j "
                                                    . "on emp.job_id = j.job_id ".$condition_search." ORDER BY emp_id ASC";
                                $query = mysqli_query($conn, $sql_emp); //$conn มาจากไฟล์ connection_mysqli.php เป็นตัว connect DB
                                 ?>
                                <?php  while($result = mysqli_fetch_assoc($query)){ 
                                    $emp_id = $result["emp_id"];
                                    $name = $result["prefix"].$result["f_name"]."  ".$result["l_name"];
                                    $dept = $result["dept_name"];
                                    $job = $result["job"];
                                    
                                ?>
                                <tr>
                                    <td class="text-center"><?php  echo $emp_id; ?></td>
                                    <td><?php echo $name; ?></td>
                                    <td class="text-center"><?php echo $job; ?></td>
                                    <td class="text-center"><?php echo $dept; ?></td>
                                    <td class="text-center"><a href="hr_kpi_individual_resp.php?emp_id=<?php echo $emp_id; ?>"><i class="glyphicon glyphicon-folder-open"></i></a></td>
                                </tr>
                                <?php } ?>
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
