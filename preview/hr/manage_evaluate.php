<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>ระบบประเมินผลปฏิบัติงาน : ALT Evaluation</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!--CSS PACKS -->
        <?php include ('./css_packs.html'); ?>
        <!-- SCRIPT PACKS -->
        <?php include ('./script_packs.html'); ?>
        <!-- javascript   menu -->
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                $('#tabs').tab();
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
                        จัดการระบบการประเมินผลการปฏิบัติงาน
                        <small> </small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Evaluate Management</li>
                    </ol>
                </section>
                <!--/Page header -->

                <!-- Main content -->

                <!--list employee-->
                <div class="row box-padding">                   

                    <div class="box-header with-border">                        
                        <ul id="tabs" class="nav nav-pills nav-justified" data-tabs="tabs">
                            <li class="active"><a href="#addEmp" data-toggle="tab">จัดการระบบการประเมิน</a></li>
                            <li><a href="#editEmp" data-toggle="tab">จัดการการติดตามKPIs</a></li>        
                        </ul>

                    </div>                                                     

                </div>
                <div id="my-tab-content" class="tab-content" >
                    <div class="tab-pane active col-md-12" id="addEmp">
                        <div class="row box-padding">                  
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <p>กำหนดการเปิด/ปิดระบบการประเมิน</p>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"> 
                                            <i class="fa fa-minus"></i>
                                        </button>

                                    </div>
                                </div>
                                <div class="box-body">
                                  <div class="col-md-offset-1 col-md-10 ">
                                   <table class="table table-hover">
                                       <tr>
                                           
                                           <th>รอบการประเมิน</th>
                                           <th>วันเปิด</th>
                                           <th>วันปิด</th>
                                           <th>แก้ไข</th>
                                       </tr>
                                       <tr>
                                           
                                           <td>1/2559</td>
                                           <td>15/07/2559</td>
                                           <td>15/07/2559</td>
                                           <td>
                                               <a href="" data-toggle="modal" data-target="#myModalEdit">
                                                   <i class="glyphicon glyphicon-pencil"></i>
                                               </a>
                                           </td>
                                       </tr>
                                       <tr>
                                           
                                           <td>2/2559</td>
                                           <td>15/01/2560</td>
                                           <td>15/02/2560</td>
                                           <td>
                                               <a href="">
                                                   <i class="glyphicon glyphicon-pencil"></i>
                                               </a>
                                           </td>
                                       </tr>
                                   </table>
                                      <!--Edit Modal -->
                                        <div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">แก้ไขข้อมูล</h4>
                                              </div>
                                              <div class="modal-body">
                                                  <form class="form-horizontal">
                                                      <div class="input-group col-sm-12" >
                                                          <label for="รอบการประเมิน" class="col-sm-4 control-label">รอบการประเมิน:</label>
                                                          <div class="col-sm-8">               
                                                              <input type="text" class="form-control" value="1/2559" disabled="true" >
                                                          </div>
                                                      </div>
                                                      <div class="input-group col-sm-12">
                                                          <label class="col-sm-4 control-label">วันเปิด: </label>
                                                          <div class="col-sm-8"> 
                                                              <input type="date" class="form-control" >
                                                          </div>
                                                      </div>
                                                      <div class="input-group col-sm-12">
                                                          <label class="col-sm-4 control-label">วันปิด: </label>
                                                          <div class="col-sm-8"> 
                                                              <input type="date" class="form-control"  >
                                                          </div>
                                                      </div>
                                                  </form>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Save changes</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      <!-- Edit Modal -->
                                      
                                      <!--Add Modal -->
                                        <div class="modal fade" id="myModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">เพิ่มข้อมูล</h4>
                                              </div>
                                              <div class="modal-body">
                                                  <form class="form-horizontal">
                                                      <div class="input-group col-sm-12" >
                                                          <label for="รอบการประเมิน" class="col-sm-4 control-label">รอบการประเมิน:</label>
                                                          <div class="col-sm-8">               
                                                              <input type="text" class="form-control" placeholder="รอบ/ปีการประเมิน"  >
                                                          </div>
                                                      </div>
                                                      <div class="input-group col-sm-12">
                                                          <label class="col-sm-4 control-label">วันเปิด: </label>
                                                          <div class="col-sm-8"> 
                                                              <input type="date" class="form-control" >
                                                          </div>
                                                      </div>
                                                      <div class="input-group col-sm-12">
                                                          <label class="col-sm-4 control-label">วันปิด: </label>
                                                          <div class="col-sm-8"> 
                                                              <input type="date" class="form-control"  >
                                                          </div>
                                                      </div>
                                                  </form>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Save changes</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      <!-- Add Modal -->
                                      
                                      <br>
                                      <input type="submit" value="เพิ่มข้อมูล" class="btn btn-success pull-right" data-toggle="modal" data-target="#myModalAdd">
                                      
                                   </div>
                                </div>
                            </div>                                                             
                        </div>

                        <div class="row box-padding">                  
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <p>สถานะการประเมินและแจ้งเตือนอีเมลล์</p>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"> 
                                            <i class="fa fa-minus"></i>
                                        </button>

                                    </div>
                                </div>
                                <div class="box-body">
                                  <div class="col-md-offset-1 col-md-10 ">
                                   <table class="table table-hover">
                                       <tr>
                                           <th>ผู้ประเมิน</th>
                                           <th class="text-center">ประเมินแล้ว</th>
                                           <th class="text-center">ยังไม่ประเมิน</th>
                                           <th class="text-center">ทั้งหมด</th>
                                           <th class="text-center">แจ้งเตือน</th>
                                       </tr>
                                       <tr>
                                           <td>นาย สมศักดิ์ ดวงจันทร์</td>
                                           <td class="text-center">8</td>
                                           <td class="text-center">12</td>
                                           <td class="text-center">20</td>
                                           <td class="text-center">
                                               <a href="">
                                                   <i class="glyphicon glyphicon-envelope"></i>
                                               </a>
                                           </td>
                                       </tr>
                                       
                                   </table>
                                   </div>
                                </div>
                            </div>                                                             
                        </div>

                    </div>
                
                   <div class="tab-pane col-md-12" id="editEmp">
                        <div class="row box-padding">                  
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <p>สถานะการอัพเดทและแจ้งเตื่อนอีเมลล์</p>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"> 
                                            <i class="fa fa-minus"></i>
                                        </button>

                                    </div>
                                </div>
                                <div class="box-body">

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
