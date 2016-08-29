<?php 
        $erp='';
        $msg='';
        
        include './classes/connection_mysqli.php';
        
        if(isset($_GET['erp'])) {
            $erp=$_GET['erp'];
            //++++++++++++++++++insert record+++++++++++++
           if($erp=='insert'){          
                $name =$_POST['company_name'];
                $fullname =$_POST['company_full_name'];
                $strSQL =" INSERT INTO company(company_name,company_full_name) VALUES('$name','$fullname') ";
			   
               $objQuery = mysqli_query($conn,$strSQL);
               if ($objQuery) {

                   header ("location:company_table.php");

               } else {

                   echo "Error Save [" . $strSQL . "]";
               }

           }
            //++++++++++++++++++update record+++++++++++++
           if($erp=='update'){          
                $name =$_POST['textcom'];
                $fullname =$_POST['textfullcom'];
                $id=$_GET['id'];
                $strSQL =" UPDATE company SET company_name ='$name',company_full_name ='$fullname'  WHERE company_id=$id ";
                $objQuery = mysqli_query($conn,$strSQL);
                if ($objQuery) {

                    header ("location:company_table.php");
                } else {
                   echo "Error Save [" . $strSQL . "]";
               }

           }
            //++++++++++++++++++delete record+++++++++++++
           if($erp=='delete'){        

               $id=$_GET['id'];
               $strSQL =" DELETE FROM company WHERE company_id=$id ";
               $objQuery = mysqli_query($conn,$strSQL);
               if ($objQuery) {
                   header ("location:company_table.php");
               } else {
                   echo "Error Save [" . $strSQL . "]";
               }
           }
        }
            
?>
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
        <!--ListJS-->
        <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.2.0/list.min.js"></script>

        
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
                        บริษัทที่ใช้แบบประเมิน
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Company</li>
                    </ol>
                </section>
                <!--/Page header -->

                <!-- Main content -->
             
                <div class="row box-padding">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">ตารางแสดงรายชื่อบริษัท</h3>
                            <a class="pull-right " data-toggle="collapse" href="#strenghtPoint">
                                <button type="button" class="btn btn-primary">เพิ่มบริษัท</button>
                            </a>
                        </div>
                   <div class="box-body">
                    <div class="collapse bg-gray-light box-padding" id="strenghtPoint" >
                        <form action="company_table.php?erp=insert" method="POST">
                        <div class="row">
                            <div class="col-sm-4">
                                ชื่อบริษัท
                                <input class="form-control" type="text" name="company_name" placeholder="----- กรุณากรอกชื่อบริษัท -----">
								 
                            </div>
                            <div class="col-sm-6">
                                ชื่อเต็มบริษัท
                                <input class="form-control" type="text" name="company_full_name" placeholder="----- กรุณากรอกชื่อเต็มบริษัท -----">
								 
                            </div>		
                            <div class="col-sm-2">
                                <div class="form-group">
                                  <input class="btn btn-info btn-md" style="margin-left:80px;margin-top:20px;width: 60%;" type="submit" value="เพิ่ม">
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
										<th class="text-center">ชื่อเต็มของบริษัท</th>
                                        <th class="text-center" style="width: 150px">จัดการ</th>
                                    </tr>
                                </thead>
                                <?php
                    
                                $sql_dept = "SELECT * FROM company";
                                                 
                                $query = mysqli_query($conn, $sql_dept); //$conn มาจากไฟล์ connection_mysqli.php เป็นตัว connect DB

                                 ?>
                                <?php  while($result = mysqli_fetch_array($query, MYSQLI_ASSOC)){ 
                                    $name = $result["company_name"];
									$fullname = $result["company_full_name"];
                                    $id = $result["company_id"];
                                   
                                ?>
                                
                            
                                <tr>
                                    <td>&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $name; ?></td>
                                    <td>&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $fullname; ?></td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#<?php echo $id; ?>">
                                            <i class="glyphicon glyphicon-pencil" ></i>
                                        </button>                                                   
                                        |
                                            
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"  data-target="#<?php echo $id; ?>_delete">
                                            <i class="glyphicon glyphicon-remove" ></i>
                                        </button>
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
                                                                <div class="input-group col-sm-12" >
                                                                    <label for="ชื่อบริษัท" class="col-sm-4 control-label">ชื่อบริษัท:</label>
                                                                    <div class="col-sm-8">               
                                                                        <input type="text" class="form-control" value="<?php echo $result["company_name"]; ?>" name='textcom'   >
                                                                    </div>
                                                                </div>
                                                                                                                        <div class="input-group col-sm-12" >
                                                                    <label for="ชื่อเต็มบริษัท" class="col-sm-4 control-label">ชื่อเต็มบริษัท:</label>
                                                                    <div class="col-sm-8">               
                                                                        <input type="text" class="form-control" value="<?php echo $result["company_full_name"]; ?>" name='textfullcom'   >
                                                                    </div>
                                                                </div>


                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="submit" class="btn btn-primary"value="บันทึก" >
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
                                                                                                                        <div class="input-group col-sm-12" >
                                                                    <label for="ชื่อเต็มบริษัท" class="col-sm-4 control-label">ชื่อเต็มบริษัท:</label>
                                                                    <div class="col-sm-8">               
                                                                        <input type="text" class="form-control" value="<?php echo $result["company_full_name"]; ?>" name='textfullcom'   >
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
                                    </td>
                                </tr>
                                
                                
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
    <!-- SCRIPT PACKS -->
    <?php include('./script_packs.html') ?>
        
</html>
