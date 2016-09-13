<?php
    session_start();
    //Check_login
    if($_SESSION["employee_id"]==''){
        echo "Please login again";
        echo "<a href='login.php'>Click Here to Login</a>";
        header("location:login.php");
    }else{
        $now = time(); // Checking the time now when home page starts.
//        echo $now." - session expire ".$_SESSION["expire"];
        if ($now > $_SESSION['expire']) {
            session_destroy();
            header("location:session_timeout.php");
            echo "Your session has expired! <a href='login.php'>Login here</a>";
        }else{
            //HTML PAGE
            ?>
<?php include('./classes/connection_mysqli.php'); 
        $erp='';
        $msg='';
        
        if(isset($_GET['erp'])) {
            $erp=$_GET['erp'];
            //++++++++++++++++++insert record+++++++++++++
           if($erp=='insert'){          
               $name =$_POST['position_description'];

               $strSQL =" INSERT INTO position_level(position_description) VALUES('$name') ";
               $objQuery = mysqli_query($conn,$strSQL);
               if ($objQuery) {

                   header ("location:position_level.php");

               } else {

                   echo "Error Save [" . $strSQL . "]";
               }

           }
            //++++++++++++++++++update record+++++++++++++
           if($erp=='update'){          
               $name =$_POST['textlevel'];
               $id=$_GET['id'];
               $strSQL =" UPDATE position_level SET position_description ='$name' WHERE position_level_id=$id ";
               $objQuery = mysqli_query($conn,$strSQL);
               if ($objQuery) {

                   header ("location:position_level.php");


               } else {

                   echo "Error Save [" . $strSQL . "]";
               }

           }
            //++++++++++++++++++delete record+++++++++++++
           if($erp=='delete'){        

               $id=$_GET['id'];
               $strSQL =" DELETE FROM position_level WHERE position_level_id=$id ";
               $objQuery = mysqli_query($conn,$strSQL);
               if ($objQuery) {

                   header ("location:position_level.php");


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
                        ระดับที่ใช้ในแบบประเมิน
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Position_Level</li>
                    </ol>
                </section>
                <!--/Page header -->

                <!-- Main content -->
             
                <div class="row box-padding">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">ตารางแสดงรายชื่อระดับ</h3>
                            <a class="pull-right " data-toggle="collapse" href="#strenghtPoint">
                                <button type="button" class="btn btn-primary">เพิ่มระดับ</button>
                            </a>
                        </div>
                   <div class="box-body">
                    <div class="collapse bg-gray-light box-padding" id="strenghtPoint" >
                        <form action="position_level.php?erp=insert" method="POST">
                        <div class="row">
                            <div class="col-sm-7">
                                ชื่อระดับ
                                <input class="form-control" type="text" name="position_description" placeholder="----- กรุณากรอกชื่อระดับ-----">
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
                                        <th class="text-center">ชื่อระดับ</th>
                                        <th class="text-center" style="width: 150px">จัดการ</th>
                                    </tr>
                                </thead>
                                <?php
                    
                                $sql_dept = "SELECT * FROM position_level";
                                                 
                                $query = mysqli_query($conn, $sql_dept); //$conn มาจากไฟล์ connection_mysqli.php เป็นตัว connect DB

                                 ?>
                                <?php  while($result = mysqli_fetch_array($query, MYSQLI_ASSOC)){ 
                                    $name = $result["position_description"];
                                    $id = $result["position_level_id"];
                                   
                                ?>
                                
                            
                                <tr>
                                        <td>&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $name; ?></td>
                                        
                                        <td class="text-center">
                                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#<?php echo $id; ?>">
                                                <i class="glyphicon glyphicon-pencil" ></i>
                                            </button>                                                   
                                            |

                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"  data-target="#<?php echo $id; ?>_delete">
                                                <i class="glyphicon glyphicon-remove" ></i>ลบ
                                            </button>
                                        </td>
                                    </tr>
                                
                                <!--Edit Modal -->

                                <form class="form-horizontal" name="frmMain" method="post" action="position_level.php?erp=update&id=<?php echo $id; ?>" >
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
                                                            <label for="ชื่อระดับ" class="col-sm-4 control-label">ชื่อระดับ:</label>
                                                            <div class="col-sm-8">               
                                                                <input type="text" class="form-control" value="<?php echo $result["position_description"]; ?>" name='textlevel'   >
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

                                <form class="form-horizontal" name="frmMain" method="post" action="position_level.php?erp=delete&id=<?php echo $id; ?>" >
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
                                                            <label for="ชื่อระดับ" class="col-sm-4 control-label">ชื่อระดับ:</label>
                                                            <div class="col-sm-8">               
                                                                <input type="text" class="form-control" value="<?php echo $result["position_description"]; ?>" name='textlevel' disabled="true"  >
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
    <!-- SCRIPT PACKS -->
<?php include('./script_packs.html') ?>
</html>
            <?php
        }
    }

    
?>
