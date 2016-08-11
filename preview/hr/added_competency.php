<!DOCTYPE html>
<html>
    <head>
        <?php include('./classes/connection_mysqli.php') ?>
        <?php
        //Insert
        if(isset($_GET["submit_insert"])){
            
            $sql_insert_group = "INSERT INTO competency (competency_description) VALUES ('".$_GET["com_desc"]."')";
            if (mysqli_query($conn, $sql_insert_group)) {
                    echo "Record new successfully";
                    echo $sql_insert_group;
                } else {
                    echo "Error new record: " . mysqli_error($conn);
                    echo $sql_insert_group;
                }
                    
                header("Location: added_competency.php");
            }
        //Edit
        if(isset($_GET["submit_edit"])){
            
            $sql_edit_group = "UPDATE competency SET competency_description='".$_GET["competency_desc"]."' WHERE competency_id='".$_GET["competency_id"]."'";
            if (mysqli_query($conn, $sql_edit_group)) {
                    echo "Record edit successfully";
                    echo $sql_edit_group;
                } else {
                    echo "Error edit record: " . mysqli_error($conn);
                    echo $sql_edit_group;
                }
                    
                header("Location: added_competency.php");
            }
        //Delete  
        if(isset($_GET["delete_group"])){
            
            $sql_delete_group = "DELETE FROM competency WHERE competency_id='".$_GET["comp_id"]."'";
            if (mysqli_query($conn, $sql_delete_group)) {
                    echo "Record new successfully";
                    echo $sql_delete_group;
                } else {
                    echo "Error new record: " . mysqli_error($conn);
                    echo $sql_delete_group;
                }
                    
                header("Location: added_competency.php");
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
                <div class="row box-padding">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <b>หัวข้อพฤติกรรมที่ทำการประเมิน และ ปัจจัยการพิจารณา </b>
                            <button class="btn btn-success pull-right"  data-toggle="collapse" data-target="#newKPIGroup">+ เพิ่ม</button>
                        </div>
                        <div id="newKPIGroup" class="collapse">
                            <form action="" method="get">
                                <div class="box-padding row">
                                    <div class="form-group col-sm-5">
                                        <label>เพิ่มหัวข้อใหม่<span style="color: red;">*</span></label>
                                        <input class="form-control" type="text"  step="5" name="com_desc" required > 
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
                                <?php
                                $sql_com = "SELECT competency_id,competency_description FROM competency ORDER BY competency_id ASC";
                                $query_com = mysqli_query($conn, $sql_com);
                                
                                ?>
                                    <table class="table table-hover table-responsive table-striped table-bordered">                               
                                        <thead>
                                            <tr>
                                                <th style="width: 120px;">Competency ID</th>
                                                <th>Competency Name</th>
                                                <th style="width: 150px;text-align: center;">Management</th>

                                            </tr>
                                        </thead>
                                    <?php while ($result_com = mysqli_fetch_array($query_com, MYSQLI_ASSOC)) { ?>
                                        <tr>
                                            <td><b><?php echo $result_com["competency_id"]; ?></b></td>
                                            <td><?php echo $result_com["competency_description"]; ?></td>
                                            <td style="text-align: center;">

                                                <a class="btn btn-default btn-sm" data-toggle="modal" href="#edit_kpi_group_<?php echo $result_com["competency_id"]; ?>" ><i class="glyphicon glyphicon-pencil"></i>แก้ไข</a>

                                                  <a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#confirm-delete" data-href="added_competency.php?comp_id=<?php echo $result_com["competency_id"]; ?>&delete_group=1">
                                                          <i class="glyphicon glyphicon-remove"></i>ลบ</a>


                                                <!--Modal delete-->
                                                      <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                          <div class="modal-dialog">
                                                              <div class="modal-content">

                                                                  <div class="modal-header">
                                                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                      <h4 class="modal-title" id="myModalLabel">ยืนยันการลบ</h4>
                                                                  </div>

                                                                  <div class="modal-body">
                                                                      <p></p>
                                                                      
                                                                      <p class="debug-url"></p>
                                                                  </div>

                                                                  <div class="modal-footer">
                                                                      <a class="btn btn-danger btn-ok">ลบ</a>
                                                                      <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                                                                      
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <!--/Modal delete-->
                                                        <script>
                                                            $('#confirm-delete').on('show.bs.modal', function(e) {
                                                                $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

//                                                                $('.debug-url').html('Delete URL: <b style="color:red;">' + $(this).find('.btn-ok').attr('href') + '</b>');
                                                            });
                                                        </script>
                                            </td>
                                        </tr>
                                        <form action="" method="get" >
                                        <!-- Modal Edit -->   
                                            <div class="modal animated fade " id="edit_kpi_group_<?php echo $result_com["competency_id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                                                                            <input type="text" class="form-control" name="competency_desc" placeholder="ชื่อหัวข้อCompetency" value="<?php echo $result_com["competency_description"]; ?>" required >
                                                                                    
                                                                        </div>
                                                                                                            
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input class="btn btn-primary" type="submit" name="submit_edit" value="บันทึก" >
                                                            <input type="hidden" name="competency_id" value="<?php echo $result_com["competency_id"]; ?>" >
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                        </div>                 
                                                    </div>
                                                </div>  
                                            </div>
                                            <!--/Modal Edit-->
                                            </form>
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