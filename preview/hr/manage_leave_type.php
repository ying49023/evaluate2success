<!DOCTYPE html>
<html>
    <head>
        <?php include('./classes/connection_mysqli.php'); ?>
       
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>ระบบประเมินผลปฏิบัติงาน : ALT Evaluation</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- CSS PACKS -->
        <?php include ('./css_packs.html'); ?>

        <!-- SCRIPT PACKS -->
        <?php include('./script_packs.html') ?>
        <?php include ('./classes/connection_mysqli.php'); ?>
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
                        ประเภทการลา
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Manage Leave Day</li>
                    </ol>
                </section>
                <!--/Page header -->

                <!-- Main content -->
             
                <div class="row box-padding">
                    <div class="box box-primary">
                         <div class="box-header with-border">
                <h3 class="box-title">ตารางแสดงประเภทวันลา</h3>
                <a class="pull-right " data-toggle="collapse" href="#strenghtPoint"><button type="button" class="btn btn-primary">เพิ่มประเภทวันลา
                </button></a>
           
                           
                          

                            </div>
                   <div class="box-body">
                    <div class="collapse bg-gray-light box-padding" id="strenghtPoint" >
                        <form>
                        <div class="row">
                            <div class="col-sm-4">
                                ชื่อประเภทวันลา
                                <input class="form-control" type="text" name="leave_name" placeholder="----- กรุณากรอกประเภทวันลา -----">
                            </div>
                            <div  class="col-sm-offset-1 col-sm-3">
                                คะแนน(ต่อครั้ง)
                                <input class="form-control" style="margin-left:10px;" type="text" name="leave_point" placeholder="----- กรุณากรอกคะแนนวันลา -----">
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
                                        <th class="text-center">ชื่อประเภทวันลา</th>
                                        <th class="text-center">คะแนน(ต่อครั้ง)</th>
                                        <th class="text-center">จัดการ</th>
                                        
                                    </tr>
                                </thead>
                                <?php
                    
                                $sql_leave_type = "SELECT * FROM leaves_type";
                                                 
                                $query = mysqli_query($conn, $sql_leave_type); //$conn มาจากไฟล์ connection_mysqli.php เป็นตัว connect DB

                                 ?>
                                <?php  while($result = mysqli_fetch_array($query, MYSQLI_ASSOC)){ 
                                    $name = $result["leave_type_description"];
                                    $point = $result["point"];
                                   
                                ?>
                                
                            
                                <tr>
                                    <td style="width: 300px">&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $name; ?></td>
                                    <td class="text-center" style="width: 200px"><?php echo $point; ?></td>
                                     <td class="text-center" style="width: 200px">
                                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal">
                                                        <i class="glyphicon glyphicon-pencil" ></i>
                                                    </button>                                                   
                                                    |
                                                    <button type="button" class="btn btn-danger btn-sm">
                                                   
                                                        <i class="glyphicon glyphicon-remove" ></i>
                                                    </button>
                                                </td>
                                </tr>
                               <?php } ?>

                            </table>
                         
                        </div>

                         <!--Edit Modal -->
                        <form class="form-horizontal" name="frmMain" method="post" action="" >
                                        <div class="modal fade" id="<?php echo $result["point"] ; ?>_<?php echo $result["leave_type_description"] ; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">แก้ไขข้อมูล</h4>
                                              </div>
                                              <div class="modal-body">
                                                  
                                                      <iframe id="iframe_target" name="iframe_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>
                                                      <div class="input-group col-sm-12" >
                                                          <label for="ประเภทการลา" class="col-sm-4 control-label">ชื่อประเภทการลา:</label>
                                                          <div class="col-sm-8">               
                                                              <input type="text" class="form-control" value="<?php echo $result["leave_type_description"] ; ?>" name='texttype'   >
                                                          </div>
                                                      </div>
                                                      <div class="input-group col-sm-12" >
                                                          <label for="คะแนน" class="col-sm-4 control-label">คะแนน(ต่อครั้ง):</label>
                                                          <div class="col-sm-8">               
                                                              <input type="text" class="form-control" value="<?php echo $result["point"] ; ?>" name='textpoint'    >
                                                          </div>
                                                      </div>
                                                                      
         
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        </form>
     
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
