<!DOCTYPE html>
<?php include('./classes/connection_mysqli.php');
        
        $erp='';
        $msg='';
        if(isset($_GET['erp']))
            $erp=$_GET['erp'];
        //++++++++++++++++++save record+++++++++++++
        if($erp=='save'){
            
            $period=$_POST['add_period'];
            $year=$_POST['add_year'];
            $open_eval=$_POST['add_open'];
            $close_eval=$_POST['add_close'];
            $add_query="INSERT INTO evaluation VALUES (5,1,'$period','$year','$open_eval','$close_eval')";
            
            $a_query =  mysqli_query($conn,$add_query);
            if($a_query)
               header ("location:manage_evaluate.php");
            else {
                $msg='Error :'.mysql_error();
                echo "Error Save [" . $add_query . "]";
                
                
            }
            
        }
        ?>
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
                        <small>Evaluate Management </small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Report</li>
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
                                    <?php 
                                        $sql_eval = "SELECT term,year,DATE_FORMAT(open_system_date,'%d/%m/%Y') as open_system_date ,DATE_FORMAT(close_system_date,'%d/%m/%Y') as close_system_date from evaluation where company_id=1  ";
                                        $query_eval= mysqli_query($conn, $sql_eval);
                                    ?>
                                     
                                   <table class="table table-hover">
                                       
                                       <tr>
                                           
                                           <th>รอบการประเมิน</th>
                                           <th>วันเปิด</th>
                                           <th>วันปิด</th>
                                           <th align="center">จัดการ</th>
                                       </tr>
                                       <?php while($result_eval = mysqli_fetch_array($query_eval,MYSQLI_ASSOC)) { ?>
                                       <tr>
                                           
                                           <td><?php echo $result_eval["term"] ; ?> / <?php echo $result_eval["year"] ; ?></td>
                                           <td><?php echo $result_eval["open_system_date"] ; ?></td>
                                           <td><?php echo $result_eval["close_system_date"] ; ?></td>
                                           <td >
                                               <a href="" data-toggle="modal" data-target="#<?php echo $result_eval["term"] ; ?>_<?php echo $result_eval["year"] ; ?>">
                                                   <i class="glyphicon glyphicon-pencil"></i>
                                               </a>|
                                               <a href="manage_evaluate.php?epr=delete" >
                                                   <i class="glyphicon glyphicon-trash"></i>
                                               </a>
                                           </td>
                                       </tr>
                                       <!--Edit Modal -->
                                        <div class="modal fade" id="<?php echo $result_eval["term"] ; ?>_<?php echo $result_eval["year"] ; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">แก้ไขข้อมูล</h4>
                                              </div>
                                              <div class="modal-body">
                                                  <form class="form-horizontal" name="frmMain" method="post" action="EditModal.php" >
                                                      <iframe id="iframe_target" name="iframe_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>
                                                      <div class="input-group col-sm-12" >
                                                          <label for="รอบการประเมิน" class="col-sm-4 control-label">เทอม:</label>
                                                          <div class="col-sm-8">               
                                                              <input type="text" class="form-control" value="<?php echo $result_eval["term"] ; ?>" name='textterm'   >
                                                          </div>
                                                      </div>
                                                      <div class="input-group col-sm-12" >
                                                          <label for="รอบการประเมิน" class="col-sm-4 control-label">ปี:</label>
                                                          <div class="col-sm-8">               
                                                              <input type="text" class="form-control" value="<?php echo $result_eval["year"] ; ?>" name='textyear'    >
                                                          </div>
                                                      </div>
                                                      <div class="input-group col-sm-12">
                                                          <label class="col-sm-4 control-label" >วันเปิด: </label>
                                                          <div class="col-sm-8"> 
                                                              <input type="date" class="form-control" name="textopen"  >
                                                          </div>
                                                      </div>
                                                      <div class="input-group col-sm-12">
                                                          <label class="col-sm-4 control-label">วันปิด: </label>
                                                          <div class="col-sm-8"> 
                                                              <input type="date" class="form-control" name="textclose" >
                                                          </div>
                                                      </div>
                                                      <button type="submit" class="btn btn-primary">Save changes</button>
                                                  </form>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      <!-- Edit Modal -->
                                       
                                       <?php } mysqli_close($conn); ?>
                                      
                                      
                                   </table>
                                      
                                     <?php echo $msg;?> 
                                      <!--Add Modal -->
                                        <div class="modal fade" id="myModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">เพิ่มข้อมูล</h4>
                                              </div>
                                              <div class="modal-body">
                                                  <form class="form-horizontal" action='manage_evaluate.php?erp=save' method="post">
                                                      <div class="input-group col-sm-12" >
                                                          <label for="รอบการประเมิน" class="col-sm-4 control-label">รอบการประเมิน:</label>
                                                          <div class="col-sm-8">               
                                                              <input type="text" class="form-control" placeholder="รอบการประเมิน" name="add_period"  >
                                                          </div>
                                                          <label for="ปีการประเมิน" class="col-sm-4 control-label">ปีการประเมิน:</label>
                                                          <div class="col-sm-8">               
                                                              <input type="text" class="form-control" placeholder="ปีการประเมิน" name="add_year"  >
                                                          </div>
                                                      </div>
                                                      <div class="input-group col-sm-12">
                                                          <label class="col-sm-4 control-label">วันเปิด: </label>
                                                          <div class="col-sm-8"> 
                                                              <input type="date" class="form-control" name="add_open">
                                                          </div>
                                                      </div>
                                                      <div class="input-group col-sm-12">
                                                          <label class="col-sm-4 control-label">วันปิด: </label>
                                                          <div class="col-sm-8"> 
                                                              <input type="date" class="form-control" name="add_close" >
                                                          </div>
                                                          <button type="submit" class="btn btn-primary">Save changes</button>
                                                      </div>
                                                  </form>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                
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
                                           <th>ประเมินแล้ว</th>
                                           <th>ยังไม่ประเมิน</th>
                                           <th>ทั้งหมด</th>
                                           <th>แจ้งเตือน</th>
                                       </tr>
                                       <tr>
                                           <td>นาย สมศักดิ์ ดวงจันทร์</td>
                                           <td>8</td>
                                           <td>12</td>
                                           <td>20</td>
                                           <td>
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
