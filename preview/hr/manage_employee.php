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
                        การจัดการข้อมูลพนักงาน
                        <small>Employee Management </small>
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
                    <div class="box box-primary">

                        <div class="box-header with-border">
                            <ul id="tabs" class="nav nav-pills nav-justified" data-tabs="tabs">
                                <li class="active"><a href="#addEmp" data-toggle="tab">เพิ่มข้อมูลพนักงาน</a></li>
                                <li><a href="#editEmp" data-toggle="tab">ลบ/แก้ไขข้อมูลพนักงาน</a></li>        
                            </ul>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"> 
                                    <i class="fa fa-minus"></i>
                                </button>

                            </div>
                        </div>

                    <div class="box-body">
                        <div class="container">
                            
                                
                            <div id="my-tab-content" class="tab-content" >
                                <div class="tab-pane active col-md-12" id="addEmp">                            
                                    
                                    <form action="">
                                        <div class="row">
                                              <div class="form-group col-md-offset-1 col-md-4">
                                                <label>ชื่อ: </label>
                                                <input type="text" class="form-control" id="empFName" placeholder="ชื่อจริง">
                                              </div>

                                              <div class="form-group col-md-offset-1 col-md-4 ">
                                                <label>นามสกุล: </label>
                                                <input type="text" class="form-control" id="empLName" placeholder="นามสกุล">
                                              </div> 
                                         </div>
                                         
                                          <div class="row">
                                            <div class="form-group col-md-offset-1 col-md-4">
                                                <label>แผนก: </label>
                                                <input type="text" class="form-control" id="department" placeholder="แผนก">
                                              </div>
                                              <div class="form-group col-md-offset-1 col-md-4">
                                                <label>ตำแหน่ง: </label>
                                                <input type="text" class="form-control" id="position" placeholder="ตำแหน่ง">
                                              </div>                                          
                                         </div> 
                                         <div class="row"> 
                                            <div class="form-group col-md-offset-1 col-md-4">
                                                <label>ระดับ: </label>
                                                <input type="text" class="form-control" id="levelEMP" placeholder="ระดับพนักงาน">
                                              </div>                                           
                                              <div class="form-group col-md-offset-1 col-md-4">
                                                <label>วันเริ่มงาน: </label>
                                                <input type="date" class="form-control" id="startDate"/>
                                              </div>
                                          </div> 
                                          <div class="row"> 
                                              <div class="form-group col-md-offset-1 col-md-4 ">
                                                <label>เบอร์โทรศัพท์: </label>
                                                <input type="number" class="form-control" id="phoneno" placeholder="เบอร์โทรศัพท์เคลื่อนที่"/>
                                              </div>
                                          </div>  
                                          <div class="row"> 
                                              <div class="form-group col-md-offset-1 col-md-4 ">
                                                <label>ที่อยู่: </label>
                                                <textarea class="form-control" rows="5" id="address"> 
                                                </textarea>
                                              </div>
                                          </div> 
                                          <div class="row"> 
                                              <div class="form-group col-md-offset-1 col-md-4 ">
                                                <label>อัพโหลดภาพ: </label>
                                                <input name="image_name" type="file" id="image_name" size="40" />
                                                <p>
                                                <input type="submit" value="Upload" />
                                                <input type="hidden" name="MM_insert" value="form1" />
                                              </p>
                                              </div>                                              
                                              
                                          </div>                                                                       
                                        
                                        <div class="box-footer">
                                            <input  class="btn btn-success search-button col-md-offset-1" type="submit" name="Send" value="บันทึก"> 
                                         </div>
                                     </form>
                                </div>
                                <div class="tab-pane" id="editEmp">
                                    <h3>ลบแก้ไขข้อมูลพนักงาน</h3>
                                    
                                </div>                                     
                            </div>                        
                                    
                            
                                
                        </div>


                               
                                </div>
                            </div>
                            <!--footer-->
                            
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
