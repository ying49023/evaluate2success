
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>ระบบประเมินผลปฏิบัติงาน : ALT Evaluation</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- CSS PACKS -->
        <?php include ('./css_packs.html'); ?>

        <!-- SCRIPT PACKS -->
        <?php include('./script_packs.html') ?>
        
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
                        ตรวจสอบการประเมิน
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Evaluation</li>
                    </ol>C
                </section>
                <!--/Page header -->

                <!-- Main content -->
             
                <div class="row box-padding">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">ตารางแสดงรายชื่พนักงานที่ยังไม่ถูกประเมิน โดย คุณปรียาภรณ์ ตั้งเผ่าศักดิ์</h3>
                                                    </div>
                   <div class="box-body">
                    <div class="collapse bg-gray-light box-padding" id="strenghtPoint" >
                        <form action="company_table.php?erp=insert" method="POST">
                        <div class="row">
                            <div class="col-sm-7">
                                ชื่อบริษัท
                                <input class="form-control" type="text" name="company_name" placeholder="----- กรุณากรอกชื่อบริษัท -----">
                            </div>
                            
                            <div class="col-sm-2">
                                <div class="form-group">
                                  <input class="btn btn-info btn-md" style="margin-left:80px;margin-top:20px;width: 100%;" type="submit" value="เพิ่ม">
                                </div>
                            </div>
                        </div>
                        </form>
                      </div>
                        
                        <div class="box-body ">    
                            <table  class="table table-bordered table-condensed" >
                                <thead>
                                    <tr class="bg-gray-light">
                                        <th class="text-center">ชื่อบริษัท</th>
                                        <th class="text-center" style="width: 150px">จัดการ</th>
                                    </tr>
                                </thead>
                                <?php
                    
                                $sql_dept = "SELECT * FROM company";
                                                 
                                $query = mysqli_query($conn, $sql_dept); //$conn มาจากไฟล์ connection_mysqli.php เป็นตัว connect DB

                                 ?>
                                <?php  while($result = mysqli_fetch_array($query, MYSQLI_ASSOC)){ 
                                    $name = $result["company_name"];
                                    $id = $result["company_id"];
                                   
                                ?>
                                
                            
                                <tr>
                                        <td>&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $name; ?></td>
                                        
                                        <td class="text-center">
                                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#<?php echo $id; ?>">
                                                <i class="glyphicon glyphicon-pencil" ></i>
                                            </button>                                                   
                                            |

                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"  data-target="#<?php echo $id; ?>_delete">
                                                <i class="glyphicon glyphicon-remove" ></i>
                                            </button>
                                        </td>
                                    </tr>
                                
                                <!--Edit Modal -->

                                <form class="form-horizontal" name="frmMain" method="post" action="company_table.php?erp=update&id=<?php echo $id; ?>" >
                                        <div class="modal fade" id="<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">แก้ไขข้อมูล</h4>
                                                    </div>
                                                    <div class="modal-body">

                                                        <!--<iframe id="iframe_target" name="iframe_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>-->
                                                        <div class="input-group col-sm-12" >
                                                            <label for="ชื่อบริษัท" class="col-sm-4 control-label">ชื่อบริษัท:</label>
                                                            <div class="col-sm-8">               
                                                                <input type="text" class="form-control" value="<?php echo $result["company_name"]; ?>" name='textcom'   >
                                                            </div>
                                                        </div>
                                                     

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">บันทึก</button>
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                <!--Edit Modal -->
                                
                                <!--Delete Modal -->

                                <form class="form-horizontal" name="frmMain" method="post" action="company_table.php?erp=delete&id=<?php echo $id; ?>" >
                                        <div class="modal fade" id="<?php echo $id; ?>_delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">ลบข้อมูล</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!--<iframe id="iframe_target" name="iframe_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>-->
                                                        <div class="input-group col-sm-12" >
                                                            <label for="ชื่อบริษัท" class="col-sm-4 control-label">ชื่อบริษัท:</label>
                                                            <div class="col-sm-8">               
                                                                <input type="text" class="form-control" value="<?php echo $result["company_name"]; ?>" name='textcom' disabled="true"  >
                                                            </div>
                                                        </div>
                                                        


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger">ยืนยันการลบ</button>
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                <!--Delete Modal -->
                               <?php } ?>

                            </table>
                         
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
