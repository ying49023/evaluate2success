<!DOCTYPE html>
<html>
    <head>
        <?php include('./classes/connection_mysqli.php');?>
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
                        อนุมัติKPIs
                        <small>ครั้งถัดไป</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Competency evaluation</li>
                    </ol>
                </section>
                <!--/Page header -->

                <!-- Main content -->
                <!--search-->
                <div class="row box-padding">
                    <div class="box box-success">
                        <div class="box-body">
                            <form>
                                <div class="col-sm-3">
                                    <label class="col-sm-6 control-label">รหัสพนักงาน</label>
                                    <div class="col-sm-6">
                                        <input class="form-control" type="text" name="emp_id">
                                    </div>
                                </div> 

                                <div class="col-md-3">
                                    <label class="col-sm-5 control-label">ชื่อพนักงาน</label>
                                    <div class="col-sm-7">
                                        <input class="form-control" type="text" name="emp_id">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    
                                    <label class="col-sm-4 control-label">แผนก/ฝ่าย</label>
                                    <div class="col-sm-8">
                                        <?php
                                        $sql_department = "SELECT * FROM departments ";
                                        $query_department = mysqli_query($conn, $sql_department);
                                        ?>
                                        <select class="form-control">
                                            <option value="">เลือก</option>
                                            <?php while ($result_department = mysqli_fetch_array($query_department, MYSQLI_ASSOC)) { ?>
                                                <option><?php echo $result_department["department_name"]; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>                               
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-primary search-button"><i class="glyphicon glyphicon-search"></i></button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <!--/search-->
                
                <div class="row box-padding">
                    <!--Style 1 don't delete  อย่าเพิ่งลบ-->
                    <!--
                    <div class="col-md-4">
                        <div class="small-box bg-green">
                        <div class="inner">
                          <h3>50 คน</h3>

                          <p>ประเมินแล้ว</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">ดูรายชื่อทั้งหมด<i class="glyphicon glyphicon-option-horizontal"></i></a>
                      </div>
                    </div>
                    <div class="col-md-4">
                        <div class="small-box bg-orange">
                        <div class="inner">
                          <h3>7 คน</h3>

                          <p>ยังไม่ประเมิน</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-person"></i>
                        </div>
                        <a href="#" class="small-box-footer">ดูรายชื่อทั้งหมด<i class="glyphicon glyphicon-option-horizontal"></i></a>
                      </div>
                    </div>
                    <div class="col-md-4">
                        <div class="small-box bg-blue">
                        <div class="inner">
                          <h3>57 คน</h3>

                          <p>สมาชิกในแผนก</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-person-stalker"></i>
                        </div>
                        <a href="#" class="small-box-footer">ดูรายชื่อทั้งหมด<i class="glyphicon glyphicon-option-horizontal"></i></a>
                      </div>
                    </div>-->
                    <!--/Style1-->
                    
                    <!--Style2 don't delete อย่าเพิ่งลบ-->
                    <?php
                    $sql_mail = "SELECT
                                                    m.prefix As prefix,
                                                    m.first_name As first_name,
                                                    m.last_name As last_name,
                                                    (
                                                          SELECT
                                                                  COUNT(e.employee_id)
                                                          FROM
                                                                  evaluation_employee v
                                                          JOIN employees e ON v.employee_id = e.employee_id
                                                          JOIN employees m ON e.manager_id = m.employee_id
                                                          WHERE
                                                                  e.manager_id = 1
                                                        AND sum_point <> 0
                                                    ) AS completed_evaluate,
                                                    COUNT(e.employee_id) - (
                                                        SELECT
                                                                COUNT(e.employee_id)
                                                        FROM
                                                                evaluation_employee v
                                                        JOIN employees e ON v.employee_id = e.employee_id
                                                        JOIN employees m ON e.manager_id = m.employee_id
                                                            WHERE
                                                                e.manager_id = 1
                                                        AND sum_point <> 0
                                                    ) AS uncompleted_evaluate,
                                                    COUNT(e.employee_id) AS all_subordinate
                                                FROM
                                                    employees e
                                            JOIN employees m ON e.manager_id = m.employee_id
                                            WHERE
                                                e.manager_id = 1";
                    $query_mail = mysqli_query($conn, $sql_mail);
                    while($result_mail = mysqli_fetch_array($query_mail,MYSQLI_ASSOC)) {
                    ?>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="glyphicon glyphicon-ok"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-text">อนุมัติแล้ว</span>
                          <span class="info-box-number"><?php echo $result_mail["completed_evaluate"]." คน"; ?></span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    
                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-orange"><i class="glyphicon glyphicon-remove"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-text">ยังไม่อนุมัติ</span>
                          <span class="info-box-number"><?php echo $result_mail["uncompleted_evaluate"]." คน"; ?></span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>

                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-blue"><i class="glyphicon glyphicon-user"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-text">สมาชิกทั้งหมด</span>
                          <span class="info-box-number"><?php echo $result_mail["all_subordinate"]." คน"; ?></span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <?php } ?>
                    <!--/Style2-->
                </div>

                <!--list employee-->
                <div class="row box-padding">
                        <div class="box box-primary">

                            <div class="box-header with-border">
                                <b>ตารางข้อมูลพนักงาน</b>
                                <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"> 
                                    <i class="fa fa-minus"></i>
                                </button>
                                
                                <button type="button" class="btn btn-box-tool" data-widget="remove">
                                    <i class="fa fa-times"></i>
                                </button>
                                </div>
                            </div>
                            <div class="box-body">
                                <?php  
                                    $sql_list_emp_approve = "SELECT
                                                            e.employee_id as emp_id,
                                                            e.prefix as prefix,
                                                            e.first_name as f_name,
                                                            e.last_name as l_name,
                                                            e.manager_id as m_id,
                                                            m.prefix as m_prefix,
                                                            m.first_name AS m_f_name,
                                                            m.last_name AS m_l_name,
                                                            d.department_name as department_name 

                                                    FROM
                                                            departments d
                                                    JOIN employees m ON d.department_id = m.department_id
                                                    JOIN employees e ON m.employee_id = e.manager_id
                                                    JOIN evaluation_employee v ON e.employee_id = v.employee_id
                                                    JOIN evaluation_next_kpi n ON v.evaluate_employee_id = n.evaluate_employee_id
                                                    JOIN next_responsible_kpi r ON n.evaluate_next_kpi_id = r.evaluate_next_kpi_id
                                                    WHERE
                                                            r.approval <> 0
                                                    GROUP BY
                                                            v.employee_id";
                                    $query_list_emp_approve = mysqli_query($conn, $sql_list_emp_approve);
                                    
                                    $sql_list_emp_unapprove = "SELECT
                                                            e.employee_id as emp_id,
                                                            e.prefix as prefix,
                                                            e.first_name as f_name,
                                                            e.last_name as l_name,
                                                            e.manager_id as m_id,
                                                            m.prefix as m_prefix,
                                                            m.first_name AS m_f_name,
                                                            m.last_name AS m_l_name,
                                                            d.department_name as department_name 

                                                    FROM
                                                            departments d
                                                    JOIN employees m ON d.department_id = m.department_id
                                                    JOIN employees e ON m.employee_id = e.manager_id
                                                    JOIN evaluation_employee v ON e.employee_id = v.employee_id
                                                    JOIN evaluation_next_kpi n ON v.evaluate_employee_id = n.evaluate_employee_id
                                                    JOIN next_responsible_kpi r ON n.evaluate_next_kpi_id = r.evaluate_next_kpi_id
                                                    WHERE
                                                            r.approval <> 1
                                                    GROUP BY
                                                            v.employee_id";
                                    $query_list_emp_unapprove = mysqli_query($conn, $sql_list_emp_unapprove);
                                ?>
                                <table class="table table-bordered table-hover" width="90%" >
                                <thead>
                                    <tr>
                                        <th>รหัสพนักงาน</th>
                                        <th>ชื่อพนักงาน</th>
                                        <th>ชื่อผู้บังคับบัญชา</th>
                                        <th>แผนก/ฝ่าย</th>
                                        <th><center>อนุมัติKPIsครั้งถัดไป</center></th>
                                        <th><center>สถานะการอนุมัติ</center></th>
                                    </tr>
                                </thead> 
                                    <?php while ($result_list_emp_approve = mysqli_fetch_array($query_list_emp_approve, MYSQLI_ASSOC)) { ?>
                                    <tr>
                                        <td><?php echo $result_list_emp_approve["emp_id"] ?></td>
                                        <td><?php echo $result_list_emp_approve["prefix"].$result_list_emp_approve["f_name"]." ".$result_list_emp_approve["l_name"] ; ?></td>
                                        <td><?php echo $result_list_emp_approve["m_prefix"].$result_list_emp_approve["m_f_name"]." ".$result_list_emp_approve["m_l_name"] ; ?></td>
                                        <td><?php echo $result_list_emp_approve["department_name"] ?></td>
                                        <td>
                                            <a href="hr_approve_kpi2.php?emp_id=<?php echo $result_list_emp_approve["emp_id"] ?>">    
                                            <center><i class="glyphicon glyphicon-check"></i></center>
                                            </a>
                                        </td>
                                        <td ><center><font color="green" >อนุมัติแล้ว</font></center></td>
                                        
                                    </tr>
                                    <?php } ?>
                                    
                                    <?php while ($result_list_emp_unapprove = mysqli_fetch_array($query_list_emp_unapprove, MYSQLI_ASSOC)) { ?>
                                    <tr>
                                        <td><?php echo $result_list_emp_unapprove["emp_id"] ?></td>
                                        <td><?php echo $result_list_emp_unapprove["prefix"].$result_list_emp_unapprove["f_name"]." ".$result_list_emp_unapprove["l_name"] ; ?></td>
                                        <td><?php echo $result_list_emp_unapprove["m_prefix"].$result_list_emp_unapprove["m_f_name"]." ".$result_list_emp_unapprove["m_l_name"] ; ?></td>
                                        <td><?php echo $result_list_emp_unapprove["department_name"] ?></td>
                                        <td>
                                            <a href="hr_approve_kpi2.php?emp_id=<?php echo $result_list_emp_unapprove["emp_id"] ?>">    
                                            <center><i class="glyphicon glyphicon-check"></i></center>
                                            </a>
                                        </td>
                                        <td ><center><font color="red" >ยังไม่อนุมัติ</font></center></td>
                                        
                                    </tr>
                                    <?php } ?>
                                    
                                </table>

                                
                                
                                <!-- /.chart-responsive -->
                            </div>
                        </div>
                </div>
                <!--/list employee-->
                
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
