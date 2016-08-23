<?php include('./classes/connection_mysqli.php'); 
        $erp='';
        $msg='';
        
        if(isset($_GET['erp'])) {
            $erp=$_GET['erp'];
            //++++++++++++++++++insert record+++++++++++++
           if($erp=='insert'){          
               $name =$_POST['job_name'];

               $strSQL =" INSERT INTO jobs(job_name) VALUES('$name') ";
               $objQuery = mysqli_query($conn,$strSQL);
               if ($objQuery) {

                   header ("location:jobs_table.php");

               } else {

                   echo "Error Save [" . $strSQL . "]";
               }

           }
            //++++++++++++++++++update record+++++++++++++
           if($erp=='update'){          
               $name =$_POST['textjob'];
               $id=$_GET['id'];
               $strSQL =" UPDATE jobs SET job_name ='$name' WHERE job_id=$id ";
               $objQuery = mysqli_query($conn,$strSQL);
               if ($objQuery) {

                   header ("location:jobs_table.php");


               } else {

                   echo "Error Save [" . $strSQL . "]";
               }

           }
            //++++++++++++++++++delete record+++++++++++++
           if($erp=='delete'){        

               $id=$_GET['id'];
               $strSQL =" DELETE FROM jobs WHERE job_id=$id ";
               $objQuery = mysqli_query($conn,$strSQL);
               if ($objQuery) {

                   header ("location:jobs_table.php");


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
                        ตำแหน่งงาน
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Jobs</li>
                    </ol>
                </section>
                <!--/Page header -->

                <!-- Main content -->
             
                <div id="filter" class="row box-padding">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">ตารางแสดงตำแหน่งงาน</h3>
                            <a class="pull-right " data-toggle="collapse" href="#strenghtPoint">
                                <button type="button" class="btn btn-primary">เพิ่มตำแหน่ง</button>
                            </a>
                        </div>
                   <div class="box-body">
                       <!-- Modal New -->
                    <div class="collapse bg-gray-light box-padding" id="strenghtPoint" >
                        <form action="jobs_table.php?erp=insert" method="POST">
                        <div class="row">
                            <div class="col-sm-7">
                                ชื่อตำแหน่งงาน
                                <input class="form-control" type="text" name="job_name" placeholder="----- กรุณากรอกชื่อตำแหน่งงาน -----">
                            </div>
                            
                            <div class="col-sm-2">
                                <div class="form-group">
                                  <input class="btn btn-info btn-md" style="margin-left:80px;margin-top:20px;width: 100%;" type="submit" value="เพิ่ม">
                                </div>
                            </div>
                        </div>
                        </form>
                      </div>
                       <!--/Modal New -->
                        
                        <div class="box-body ">   
                            <!-- ช่องค้นหา by listJS -->
                            <div class="form-inline padding-small">
                                <i class="glyphicon glyphicon-search" style="padding: 0px 10px;" ></i>
                                <input class="search form-control" placeholder="ค้นหา" />
                            </div>
                            <table  class="table table-bordered table-condensed" >
                                <thead>
                                    <tr class="bg-gray-light">
                                        <th class="text-center">ชื่อตำแหน่งงาน</th>
                                        <th class="text-center" style="width: 150px;">จัดการ</th>
                                    </tr>
                                </thead>
                                <?php
                    
                                $sql_jobs = "SELECT * FROM jobs";
                                                 
                                $query = mysqli_query($conn, $sql_jobs); //$conn มาจากไฟล์ connection_mysqli.php เป็นตัว connect DB

                                 ?>
                                <tbody class="list">
                                <?php  while($result = mysqli_fetch_array($query, MYSQLI_ASSOC)){ 
                                    $name = $result["job_name"];
                                    $id = $result["job_id"];
                                   
                                ?>
                                
                            
                                <tr>
                                    <td class="name">&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $name; ?></td>
                                        
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

                                <form class="form-horizontal" name="frmMain" method="post" action="jobs_table.php?erp=update&id=<?php echo $id; ?>" >
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
                                                            <label for="ชื่อตำแหน่งงาน" class="col-sm-4 control-label">ชื่อตำแหน่งงาน:</label>
                                                            <div class="col-sm-8">               
                                                                <input type="text" class="form-control" value="<?php echo $result["job_name"]; ?>" name='textjob'   >
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

                                <form class="form-horizontal" name="frmMain" method="post" action="jobs_table.php?erp=delete&id=<?php echo $id; ?>" >
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
                                                            <label for="ชื่อตำแหน่งงาน" class="col-sm-4 control-label">ชื่อตำแหน่งงาน:</label>
                                                            <div class="col-sm-8">               
                                                                <input type="text" class="form-control" value="<?php echo $result["job_name"]; ?>" name='textjob' disabled="true"  >
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
                            </tbody>
                            <script>
                                var options = {
                                    valueNames: [ 'name']
                                };
                                
                                var userList = new List('filter', options);
                            </script>
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
