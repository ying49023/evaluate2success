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
               $type = $_POST['penalty_reward_indicated'];
               $name = $_POST["penalty_reward_name"];
               $point =$_POST['point'];

               $strSQL =" INSERT INTO penalty_reward(penalty_reward_indicated,penalty_reward_name,point) VALUES('$type','$name',$point) ";
               $objQuery = mysqli_query($conn,$strSQL);
               if ($objQuery) {

                   header ("location:edit_penalty_reward.php");

               } else {

                   echo "Error Save [" . $strSQL . "]";
               }

           }
            //++++++++++++++++++update record+++++++++++++
           if($erp=='update'){          
               $type = $_POST['penalty_reward_indicated'];
               $name = $_POST["penalty_reward_name"];
               $point =$_POST['point'];
               $id=$_POST['penalty_reward_id'];
               if($type == 1){
                   $strSQL =" UPDATE penalty_reward SET penalty_reward_name ='$name', point=$point WHERE penalty_reward_id = $id AND penalty_reward_indicated = 1";
               }else{
                   $strSQL =" UPDATE penalty_reward SET penalty_reward_name ='$name', point=$point WHERE penalty_reward_id = $id AND penalty_reward_indicated = 0";
               }
               
               $objQuery = mysqli_query($conn,$strSQL);
               if ($objQuery) {

                   header ("location:edit_penalty_reward.php");


               } else {

                   echo "Error Save [" . $strSQL . "]";
               }

           }
            //++++++++++++++++++delete record+++++++++++++
           if($erp=='delete'){        
               $type = $_POST['penalty_reward_indicated'];
               $name = $_POST["penalty_reward_name"];
               $point =$_POST['point'];
               $id=$_POST['penalty_reward_id'];
               
               $strSQL =" DELETE FROM penalty_reward WHERE penalty_reward_id=$id ";
               $objQuery = mysqli_query($conn,$strSQL);
               if ($objQuery) {

                   header ("location:edit_penalty_reward.php");

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
                        ประเภทการลา
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Edit penalty reward</li>
                    </ol>
                </section>
                <!--/Page header -->

                <!-- Main content -->
             
                <div class=" row box-padding">
                    <div class="box box-primary">
                        <div class="box-header with-border ">
                            <h3 class="box-title">ตารางแสดงข้อมูลรางวัล / โทษทางวินัย</h3>
                            <a class="pull-right " data-toggle="collapse" href="#strenghtPoint">
                                <button type="button" class="btn btn-success">เพิ่มรางวัล / โทษ</button>
                            </a>
                        </div>
                        <div class="collapse bg-gray-light box-padding" id="strenghtPoint" >
                            <form action="edit_penalty_reward.php?erp=insert" method="POST">
                                 <div class="row">
                                     <div class="col-sm-2">
                                         ชื่อประเภท <span style="color: red;">*</span>
                                         <select class="form-control" name="penalty_reward_indicated" required>
                                             <option value="">--เลือกหัวข้อ--</option>
                                             <option value="1">รางวัล</option>
                                             <option value="0">โทษทางวินัย</option>
                                         </select>
                                     </div>
                                     <div  class="col-sm-5">
                                         ชื่อหัวข้อ<span style="color: red;">*</span>
                                         <input class="form-control" type="text"  name="penalty_reward_name" placeholder="กรอกชื่อหัวข้อ" required>
                                     </div>
                                     <div  class="col-sm-3">
                                         คะแนน(ต่อครั้ง)<span style="color: red;">*</span>
                                         <input class="form-control" type="number" step="0.1" name="point" placeholder="-- กรุณากรอกคะแนน --" required>
                                     </div>
                                     <div class="col-sm-2">
                                         <div class="form-group">
                                           <input class="btn btn-info btn-md" style="margin-top:20px;width: 100%;" type="submit" value="เพิ่ม">
                                         </div>
                                     </div>
                                 </div>
                             </form>
                           </div>
                        <div class="box-body"> 
                        <div class="row" >
                            <div class="col-md-6">  
                                 <table  class="table table-bordered table-hover table-striped" >
                                     <thead>
                                         <tr class="bg-success">
                                             <th colspan="3" class="text-center">รางวัล</th>
                                         </tr>
                                         <tr class="table-active">
                                             <th class=" text-middle text-center">ชื่อรางวัล</th>
                                             <th class=" text-middle text-center" style="width: 80px" >คะแนน (ต่อครั้ง)</th>
                                             <th class=" text-middle text-center"  style="width: 100px">จัดการ</th>
                                         </tr>
                                     </thead>
                                     <?php

                                     $sql_leave_type = "SELECT * FROM penalty_reward WHERE penalty_reward_indicated = 1 ";

                                     $query = mysqli_query($conn, $sql_leave_type); //$conn มาจากไฟล์ connection_mysqli.php เป็นตัว connect DB

                                      ?>
                                     <?php  while($result = mysqli_fetch_array($query, MYSQLI_ASSOC)){ 
                                         $id = $result["penalty_reward_id"];
                                         $name = $result["penalty_reward_name"];
                                         $type = $result["penalty_reward_indicated"];
                                         $point = $result["point"];

                                     ?>
                                     <tr>
                                             <td ><?php echo $name; ?></td>
                                             <td class="text-center"><?php echo $point; ?></td>
                                             <td class="text-center">
                                                 <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#<?php echo $id; ?>">
                                                     <i class="glyphicon glyphicon-pencil" ></i>
                                                 </button>                                                   

                                                 <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"  data-target="#<?php echo $id; ?>_delete">
                                                     <i class="glyphicon glyphicon-remove" ></i>
                                                 </button>
                                                <!--Edit Modal -->
                                                 <form class="form-horizontal" name="frmMain" method="post" action="edit_penalty_reward.php?erp=update" >
                                                     <div class="modal fade" id="<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                         <div class="modal-dialog" role="document">
                                                             <div class="modal-content">
                                                                 <div class="modal-header bg-primary">
                                                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                     <h4 class="modal-title" id="myModalLabel">แก้ไขข้อมูล</h4>
                                                                 </div>
                                                                 <div class="modal-body">
                                                                     <div class="row">
                                                                         <div class="form-group col-sm-12" >
                                                                             <label for="ประเภทการลา" class="col-sm-4 control-label">ชื่อหัวข้อ<span style="color: red;">*</span></label>
                                                                             <div class="col-sm-8">               
                                                                                 <textarea type="text" class="form-control" name='penalty_reward_name'  required ><?php echo $name; ?></textarea>
                                                                             </div>
                                                                         </div>
                                                                         <div class="form-group col-sm-12" >
                                                                             <label for="คะแนน" class="col-sm-4 control-label">คะแนน(ต่อครั้ง)<span style="color: red;">*</span></label>
                                                                             <div class="col-sm-8">               
                                                                                 <input type="number" step="0.1" class="form-control" value="<?php echo $point; ?>" name='point' required >
                                                                             </div>
                                                                         </div>
                                                                     </div>
                                                                         
                                                                 </div>
                                                                 <div class="modal-footer">
                                                                     <input type="hidden" name="penalty_reward_indicated" value="<?php echo $type ?>" >
                                                                     <input type="hidden" name="penalty_reward_id" value="<?php echo $id ?>" >
                                                                     <button type="submit" class="btn btn-success">บันทึก</button>
                                                                     <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                                 </div>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 </form>
                                                 <!--Edit Modal -->

                                                 <!--Delete Modal -->
                                                 <form class="form-horizontal" name="frmMain" method="post" action="edit_penalty_reward.php?erp=delete" >
                                                     <div class="modal fade" id="<?php echo $id; ?>_delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                         <div class="modal-dialog" role="document">
                                                             <div class="modal-content">
                                                                 <div class="modal-header">
                                                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                     <h4 class="modal-title" id="myModalLabel">ลบข้อมูล</h4>
                                                                 </div>
                                                                 <div class="modal-body">
                                                                     <div class="form-group col-sm-12" >
                                                                         <label for="ประเภทการลา" class="col-sm-4 control-label">ชื่อหัวข้อ</label>
                                                                         <div class="col-sm-8">               
                                                                             <textarea type="text" class="form-control" name='penalty_reward_name' disabled="true"  ><?php echo $name; ?></textarea>
                                                                         </div>
                                                                     </div>
                                                                     <div class="form-group col-sm-12" >
                                                                         <label for="คะแนน" class="col-sm-4 control-label">คะแนน(ต่อครั้ง</label>
                                                                         <div class="col-sm-8">               
                                                                             <input type="number" class="form-control" value="<?php echo $point; ?>" name='point' disabled="true"   >
                                                                         </div>
                                                                     </div>
                                                                 </div>
                                                                 <div class="modal-footer">
                                                                     <input type="hidden" name="penalty_reward_id" value="<?php echo $id ?>" >
                                                                     <button type="submit" class="btn btn-danger">ลบ</button>
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
                            <div class="col-md-6">  
                                 <table  class="table table-bordered table-hover table-striped" >
                                     <thead>
                                         <tr class="bg-danger">
                                             <th colspan="3" class="bg-danger text-center">โทษทางวินัย</th>
                                         </tr>
                                         <tr class="table-active">
                                             <th class=" text-middle text-center">ชื่อรางวัล</th>
                                             <th class=" text-middle text-center"  style="width: 80px">คะแนน (ต่อครั้ง)</th>
                                             <th class=" text-middle text-center"  style="width: 100px">จัดการ</th>
                                         </tr>
                                     </thead>
                                     <?php

                                     $sql_leave_type = "SELECT * FROM penalty_reward WHERE penalty_reward_indicated = 0 ";

                                     $query = mysqli_query($conn, $sql_leave_type); //$conn มาจากไฟล์ connection_mysqli.php เป็นตัว connect DB

                                      ?>
                                     <?php  while($result = mysqli_fetch_array($query, MYSQLI_ASSOC)){ 
                                         $id = $result["penalty_reward_id"];
                                         $name = $result["penalty_reward_name"];
                                         $type = $result["penalty_reward_indicated"];
                                         $point = $result["point"];

                                     ?>
                                     <tr>
                                             <td ><?php echo $name; ?></td>
                                             <td class="text-center"><?php echo $point; ?></td>
                                             <td class="text-center">
                                                 <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#<?php echo $id; ?>">
                                                     <i class="glyphicon glyphicon-pencil" ></i>
                                                 </button>                                                   

                                                 <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"  data-target="#<?php echo $id; ?>_delete">
                                                     <i class="glyphicon glyphicon-remove" ></i>
                                                 </button>
                                                 <!--Edit Modal -->

                                                 <form class="form-horizontal" name="frmMain" method="post" action="edit_penalty_reward.php?erp=update" >
                                                         <div class="modal fade" id="<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                             <div class="modal-dialog" role="document">
                                                                 <div class="modal-content">
                                                                     <div class="modal-header bg-primary">
                                                                         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                         <h4 class="modal-title" id="myModalLabel">แก้ไขข้อมูล</h4>
                                                                     </div>
                                                                     <div class="modal-body">
                                                                         <div class="row">
                                                                             <div class="form-group col-sm-12" >
                                                                                 <label for="ประเภทการลา" class="col-sm-4 control-label">ชื่อหัวข้อ<span style="color: red;">*</span></label>
                                                                                 <div class="col-sm-8">               
                                                                                     <textarea type="text" class="form-control" name='penalty_reward_name'  required ><?php echo $name; ?></textarea>
                                                                                 </div>
                                                                             </div>
                                                                             <div class="form-group col-sm-12" >
                                                                                 <label for="คะแนน" class="col-sm-4 control-label">คะแนน(ต่อครั้ง)<span style="color: red;">*</span></label>
                                                                                 <div class="col-sm-8">               
                                                                                     <input type="number" step="0.1" class="form-control" value="<?php echo $point; ?>" name='point'  required  >
                                                                                 </div>
                                                                             </div>
                                                                         </div>

                                                                     </div>
                                                                     <div class="modal-footer">
                                                                         <input type="hidden" name="penalty_reward_indicated" value="<?php echo $type ?>" >
                                                                         <input type="hidden" name="penalty_reward_id" value="<?php echo $id ?>" >
                                                                         <button type="submit" class="btn btn-success">บันทึก</button>
                                                                         <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                         </div>
                                                     </form>
                                                 <!--Edit Modal -->

                                                 <!--Delete Modal -->

                                                 <form class="form-horizontal" name="frmMain" method="post" action="edit_penalty_reward.php?erp=delete" >
                                                         <div class="modal fade" id="<?php echo $id; ?>_delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                             <div class="modal-dialog" role="document">
                                                                 <div class="modal-content">
                                                                     <div class="modal-header">
                                                                         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                         <h4 class="modal-title" id="myModalLabel">ลบข้อมูล</h4>
                                                                     </div>
                                                                     <div class="modal-body">
                                                                        <div class="form-group col-sm-12" >
                                                                             <label for="ประเภทการลา" class="col-sm-4 control-label">ชื่อหัวข้อ:</label>
                                                                             <div class="col-sm-8">               
                                                                                 <textarea type="text" class="form-control" name='penalty_reward_name' disabled="true"  ><?php echo $name; ?></textarea>
                                                                             </div>
                                                                         </div>
                                                                         <div class="form-group col-sm-12" >
                                                                             <label for="คะแนน" class="col-sm-4 control-label">คะแนน(ต่อครั้ง):</label>
                                                                             <div class="col-sm-8">               
                                                                                 <input type="number" class="form-control" value="<?php echo $point; ?>" name='point' disabled="true"   >
                                                                             </div>
                                                                         </div>
                                                                     </div>
                                                                     <div class="modal-footer">
                                                                         <input type="hidden" name="penalty_reward_id" value="<?php echo $id ?>" >
                                                                         <button type="submit" class="btn btn-danger">ลบ</button>
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
