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
            
            $sql_edit_group = "UPDATE kpi_group SET kpi_group_name='".$_GET["kpi_group_name"]."' WHERE kpi_group_id='".$_GET["kpi_group_id"]."'";
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
        <script>
            $(document).ready(function(){
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

                // Datatable Function
                var table = $('#example').DataTable({
                    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                    paging: false,
                    "stateSave": true,
                    'columnDefs': [{
                                'targets': 2,
                                'searchable': false,
                            'orderable': false,
                        }],
                    'order': [[0, 'asc']]
                });
            });
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
                            <b>กลุ่มทั้งหมด</b>
                            <button class="btn btn-success pull-right"  data-toggle="collapse" data-target="#newKPIGroup">+ เพิ่ม</button>
                        </div>
                        <div id="newKPIGroup" class="collapse">
                            <form action="" method="get">
                                <div class="box-padding row">
                                    <div class="form-group col-sm-5">
                                        <label>สร้างชื่อกลุ่ม<span style="color: red;">*</span></label>
                                        <input class="form-control" type="text"  step="5" name="kpi_group_name" required > 
                                    </div>
                                    <div class="form-group col-sm-1">
                                        <input style="margin-top: 25px;" class="btn btn-danger" type="submit"  name="submit_insert" value="บันทึก" > 
                                        <input  type="hidden" name="emp_id" value="<?php echo $get_emp_id; ?>" >
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- ช่องค้นหา by listJS -->
                                    <input class="search" placeholder="ค้นหา" />
                                <?php
                                $sql_kpi_group = "SELECT kpi_group_id,	kpi_group_name FROM kpi_group ORDER BY	kpi_group_id ASC";
                                $query_kpi_group = mysqli_query($conn, $sql_kpi_group);
                                
                                ?>
                                    <table class="display table table-hover table-responsive table-striped table-bordered">                               
                                        <thead>
                                            <tr>
                                                <th  style="width: 120px;">
                                                    <a href="#" class="sort" data-sort="group_id">Group ID</a>
                                                </th>
                                                <th>
                                                    <a href="#" class="sort" data-sort="kpi_group_name">
                                                        ชื่อกลุ่ม
                                                    </a>
                                                </th>
                                                <th style="width: 150px;text-align: center;">แก้ไข/ลบ</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list">
                                    <?php while ($result_kpi_group = mysqli_fetch_array($query_kpi_group, MYSQLI_ASSOC)) { ?>
                                        <tr>
                                            <td class="group_id"><b><?php echo $result_kpi_group["kpi_group_id"]; ?></b></td>
                                            <td class="kpi_group_name"><?php echo $result_kpi_group["kpi_group_name"]; ?></td>
                                            <td class="edit_delete" style="text-align: center;">

                                                <a class="btn btn-default btn-sm" data-toggle="modal" href="#edit_kpi_group_<?php echo $result_kpi_group["kpi_group_id"]; ?>" ><i class="glyphicon glyphicon-pencil"></i>แก้ไข</a>

                                                  <a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#confirm-delete" data-href="hr_kpi_group.php?kpi_group_id=<?php echo $result_kpi_group["kpi_group_id"]; ?>&delete_group=1">
                                                          <i class="glyphicon glyphicon-remove"></i>ลบ</a>


                                                <!--Modal delete-->
                                                      <?php include ('./modal_delete.php'); ?>
                                                <!--/Modal delete-->
                                                      
                                            </td>
                                        </tr>
                                        <form action="" method="get" >
                                        <!-- Modal Edit -->   
                                            <div class="modal animated fade " id="edit_kpi_group_<?php echo $result_kpi_group["kpi_group_id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="myModalLabel">แก้ไขหัวข้อ</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div style="width: 75%;margin: auto;">
                                                                        <div class="form-group">
                                                                            <label class="pull-left">แก้ไขหัวข้อ</label>
                                                                            <input type="text" class="form-control" name="kpi_group_name" placeholder="ชื่อหัวข้อKPI" value="<?php echo $result_kpi_group["kpi_group_name"]; ?>" required >
                                                                                    
                                                                        </div>
                                                                                                            
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input class="btn btn-primary" type="submit" name="submit_edit" value="บันทึก" >
                                                            <input type="hidden" name="kpi_group_id" value="<?php echo $result_kpi_group["kpi_group_id"]; ?>" >
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                        </div>                 
                                                    </div>
                                                </div>  
                                            </div>
                                            <!--/Modal Edit-->
                                            </form>
                                         <?php } ?>
                                    </tbody>
                                    <script>
                                        var options = {
                                            valueNames: [ 'group_id', 'kpi_group_name' ]
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