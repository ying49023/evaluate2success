<!DOCTYPE html>
<html>
    <head>
        <?php include ('./classes/connection_mysqli.php'); ?>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>เพิ่มข้อมูลพนักงาน : ALT Evaluation</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <!--CSS PACKS -->
        <?php include ('./css_packs.html'); ?>
        <!-- SCRIPT PACKS -->
        <?php include ('./script_packs.html'); ?>
        <script>
            $.extend(true, $.fn.dataTable.defaults, {
                "language": {
                    "sProcessing": "กำลังดำเนินการ...",
                    "sLengthMenu": "แสดง_MENU_ แถว",
                    "sZeroRecords": "ไม่พบข้อมูล",
                    "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
                    "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
                    "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
                    "sInfoPostFix": "",
                    "sSearch": "ค้นหา:",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "เิริ่มต้น",
                        "sPrevious": "ก่อนหน้า",
                        "sNext": "ถัดไป",
                        "sLast": "สุดท้าย"
                    }
                }
            });
            $(document).ready(function() {
                $('#example').DataTable();
            } );
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
                        จัดการข้อมูลพนักงาน
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">manage employee</li>
                    </ol>
                </section>
                <!--/Page header -->

                <!-- Main content -->
                    <div class="row box-padding">
                        <div class="col-md-12">
                            <div class="nav-tabs-custom">
                                <ul class=" nav nav-tabs nav-justified">
                                    <li class="active" ><a href="#add_employee" data-toggle="tab" aria-expanded="true">เพิ่มข้อมูลพนักงาน</a></li>
                                    <li class=""><a href="#edit_delete_employee" data-toggle="tab" aria-expanded="false">แก้ไข/ลบ ข้อมูพนักงาน</a></li>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane active" id="add_employee">
                                        <!--add employee-->
                                        <div class="row ">
                                            <div class="col-md-offset-1 col-md-10 box-padding">
                                                <form action="" type="post" >
                                                    <div class="box-body">

                                                        <div class="row">
                                                            <div class="col-md-6">                                                
                                                                <div class="form-group">
                                                                    <label>ชื่อ</label>
                                                                    <input class="form-control" name="first_name" type="text">
                                                                </div>                                                
                                                            </div>
                                                            <div class="col-md-6">                                                
                                                                <div class="form-group">
                                                                    <label>นามสกุล</label>
                                                                    <input class="form-control" name="last_name" type="text">
                                                                </div>                                               
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-7">                                                
                                                                <div class="form-group">
                                                                    <label>วันที่เริ่มงาน</label>
                                                                    <div class="input-group date" data-provide="datepicker">
                                                                        <input type="text" class="form-control">
                                                                        <div class="input-group-addon">
                                                                            <span class="glyphicon glyphicon-th"></span>
                                                                        </div>
                                                                    </div>
                                                                    <script>
                                                                        $('.datepicker').datepicker();
                                                                    </script>
                                                                </div>                                                
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <?php
                                                            $sql_job = "SELECT * FROM jobs ";
                                                            $query_job = mysqli_query($conn, $sql_job);
                                                            ?>
                                                            <div class="col-md-6">                                                
                                                                <div class="form-group">
                                                                    <label>ตำแหน่ง</label>
                                                                    <select class="form-control" name="job_id">
                                                                        <option value="">--เลือกตำแหน่ง--</option>
                                                                        <?php while ($result_job = mysqli_fetch_array($query_job)) { ?>
                                                                        <option value="<?php echo $result_job["job_id"]; ?>">
                                                                                <?php echo $result_job["job_id"] . " - " . $result_job["job_name"]; ?>
                                                                        </option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>                                                
                                                            </div>
                                                            <?php
                                                            $sql_position_level = "SELECT * FROM position_level ";
                                                            $query_position_level = mysqli_query($conn, $sql_position_level);
                                                            ?>
                                                            <div class="col-md-6">                                                
                                                                <div class="form-group">
                                                                    <label>ระดับ </label>
                                                                    <select class="form-control" name="position_level_id">
                                                                        <option value="">--เลือกระดับ--</option>
                                                                        <?php while ($result_position_level = mysqli_fetch_array($query_position_level)) { ?>
                                                                        <option value="<?php echo $result_position_level["position_level_id"]; ?>">
                                                                                <?php echo $result_position_level["position_level_id"] . " - " . $result_position_level["position_description"]; ?>
                                                                        </option>
                                                                        <?php } ?>
                                                                    </select>

                                                                </div>                                                
                                                            </div>    
                                                        </div>

                                                        <div class="row">
                                                            <?php
                                                            $sql_department = "SELECT * FROM departments ";
                                                            $query_department = mysqli_query($conn, $sql_department);
                                                            ?>
                                                            <div class="col-md-6">                                               
                                                                <div class="form-group">
                                                                    <label>แผนก</label>
                                                                    <select class="form-control" name="department_id">
                                                                        <option value="">--เลือกแผนก--</option>
                                                                        <?php while ($result_department = mysqli_fetch_array($query_department)) { ?>
                                                                        <option value="<?php echo $result_department["department_id"]; ?>">
                                                                                <?php echo $result_department["department_id"] . " - " . $result_department["department_name"]; ?>
                                                                        </option>
                                                                        <?php } ?>
                                                                    </select>                                                        
                                                                </div>                                                
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>หัวหน้าผู้รับผิดชอบ</label>
                                                                    <input type="text" name="manager" class="form-control" />
                                                                </div>                                               
                                                            </div>                                              
                                                        </div>                                       
                                                        <div class="row">
                                                            <div class="col-md-7">
                                                                <div class="form-group">
                                                                    <label>ที่อยู่</label>
                                                                    <textarea name="address" class="form-control" rows="3"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>เบอร์ติดต่อ</label>
                                                                        <input type="text" name="telephone" class="form-control" />
                                                                    </div>
                                                                </div>  
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>email</label>
                                                                        <input type="email" name="email" class="form-control" />
                                                                    </div>
                                                                </div>  
                                                            </div>
                                                        </div>

                                                    </div><!-- /Box body -->
                                                    <div class="box-footer">
                                                        <center>
                                                            <input  class="btn btn-danger search-button" type="reset" name="Reset">
                                                            <input  class="btn btn-success search-button" type="submit" name="Send" value="เพิ่ม">
                                                        </center>

                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!--/add employee-->
                                    </div>
                                    <div class="tab-pane" id="edit_delete_employee">
                                        <!--edit/remove -->
                                        <div class="row">
                                            <div class="box-padding">
                                                <div class="row-border with-border">
                                                    <div class="col-md-offset-1 col-md-10">
                                                        <div class="box-body ">
                                                            <div class="col-sm-3">
                                                                <label>รหัสพนักงาน</label>
                                                                <input class="form-control" type="text" name="emp_id" />
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <label>ชื่อพนักงาน</label>
                                                                <input class="form-control" type="text" name="full_name" />
                                                            </div>
                                                            <?php
                                                            $sql_dept = "SELECT * FROM departments";
                                                            $query_department = mysqli_query($conn, $sql_dept);
                                                            
                                                            ?>
                                                            <div class="col-sm-4">
                                                                <label>แผนก</label>
                                                                <select class="form-control" name="department" >
                                                                    <option value="">-- เลือกแผนก --</option>
                                                                    <?php while($result_department_2 = mysqli_fetch_assoc($query_department)) { ?>
                                                                    <option value="<?php echo $result_department_2["department_id"] ?>"><?php echo $result_department_2["department_id"]." - ".$result_department_2["department_name"]; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <input style="margin-top: 25px;" type="submit" class="btn btn-primary btn-md" name="submit_2" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <table id="example" class="table table-hover table-striped disabled"  >
                                                    <thead>
                                                        <tr>
                                                            <th><b>รหัสพนักงาน</b></th>
                                                            <th><b>ชื่อ-นามสกุล</b></th>
                                                            <th class="text-center"><b>ตำแหน่ง</b></th>
                                                            <th class="text-center"><b>แผนก</b></th>
                                                            <th class="text-center"><b>แก้ไข/ลบ</b></th>
                                                        </tr>
                                                    </thead>
                                                    <?php
                                                        $sql_emp = "SELECT emp.employee_id as emp_id, emp.first_name as f_name, emp.last_name as l_name, "
                                                                . "dept.department_name as dept_name, j.job_name as job FROM employees emp "
                                                                . "join departments dept on emp.department_id = dept.department_id join jobs j "
                                                                . "on emp.job_id = j.job_id ORDER BY emp_id ASC";
                                                        $query = mysqli_query($conn, $sql_emp); //$conn มาจากไฟล์ connection_mysqli.php เป็นตัว connect DB
                                                    ?>
                                                    <tbody>
                                                        <?php
                                                        while ($result = mysqli_fetch_assoc($query)) {
                                                            $emp_id = $result["emp_id"];
                                                            $name = $result["f_name"] . "  " . $result["l_name"];
                                                            $dept = $result["dept_name"];
                                                            $job = $result["job"];
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $emp_id; ?></td>
                                                                <td><?php echo $name; ?></td>
                                                                <td class="text-center"><?php echo $job; ?></td>
                                                                <td class="text-center"><?php echo $dept; ?></td>
                                                                <td class="text-center">
                                                                    <a href="edit_profile.php?emp_id=<?php echo $emp_id; ?>"><i class="glyphicon glyphicon-edit"></i></a>
                                                                    | <a href="delete_profile.php?emp_id=<?php echo $emp_id; ?>"><i class="glyphicon glyphicon-trash"></i></a>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!--/edit/remove -->
                                    </div>
                                </div>

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
