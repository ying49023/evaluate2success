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
               $name =$_POST['grade_description'];
               $maxpoint  =$_POST['standard_max_point'];
               $minpoint = $_POST['standard_min_point'];

       $strSQL =" INSERT INTO grade(grade_description,standard_max_point,standard_min_point) VALUES('$name',$maxpoint,$minpoint) ";
               $objQuery = mysqli_query($conn,$strSQL);
               if ($objQuery) {

                   header ("location:manage_grade.php");
                   echo $strSQL;
               } else {
                   echo "Error Save [" . $strSQL . "]";
               }

           }
            //++++++++++++++++++update record+++++++++++++
           if($erp=='update'){          
               $name =$_POST['textgrade'];
               $maxpoint =$_POST['textmaxpoint'];
               $minpoint =$_POST['textminpoint'];
               $id=$_GET['id'];
               $strSQL =" UPDATE grade SET grade_description ='$name', standard_min_point=$minpoint, standard_max_point = $maxpoint WHERE grade_id=$id ";
               $objQuery = mysqli_query($conn,$strSQL);
               if ($objQuery) {

                   header ("location:manage_grade.php");


               } else {

                   echo "Error Save [" . $strSQL . "]";
               }

           }
            //++++++++++++++++++delete record+++++++++++++
           if($erp=='delete'){        

               $id=$_GET['id'];
               $strSQL =" DELETE FROM grade WHERE grade_id=$id ";
               $objQuery = mysqli_query($conn,$strSQL);
               if ($objQuery) {

                   header ("location:manage_grade.php");


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
                        เกณฑ์การตัดเกรด
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Manage Grade</li>
                    </ol>
                </section>
                <!--/Page header -->

                <!-- Main content -->
             
                <div class="row box-padding">
                    <div class="box box-primary">
                         <div class="box-header with-border">
                <h3 class="box-title">ตารางแสดงเกณฑ์การตัดเกรด</h3>
                <a class="pull-right " data-toggle="collapse" href="#strenghtPoint"><button type="button" class="btn btn-success">เพิ่มเกรด
                </button></a>
             </div>
                   <div class="box-body">
                    <div class="collapse bg-gray-light box-padding" id="strenghtPoint" >
                        <form action="manage_grade.php?erp=insert" method="POST">
                        <div class="row">
                            <div class="col-sm-2">
                                เกรด
                                <input class="form-control" type="text" name="grade_description" placeholder="-- กรุณากรอกเกรด --">
                            </div>
                            <div  class="col-sm-offset-1 col-sm-2">
                                เกณฑ์ต่ำสุด
                                <input class="form-control" style="margin-left:10px;" type="text" name="standard_min_point" placeholder="-- เกณฑ์ต่ำสุด(คะแนน)--">
                            </div>
                            <div  class="col-sm-offset-1 col-sm-2">
                                เกณฑ์สูงสุด
                                <input class="form-control" style="margin-left:10px;" type="text" name="standard_max_point" placeholder="--เกณฑ์สูงสุด(คะแนน)--">
                            </div>
                            <div class="col-sm-1">
                                <div class="form-group">
                                  <input class="btn btn-info btn-md" style="margin-left:80px;margin-top:20px;width: 100%;" type="submit" value="เพิ่ม">
                                </div>
                                
                            </div>
                        </div>
                        </form>
                      </div>
                        
                        <div class="box-body ">    
                            <table  class="table table-bordered table-hover table-striped" >
                                <thead>
                               
                                    <tr class="table-active">
                                        <th class="text-center">เกรด</th>
                                        <th class="text-center">เกณฑ์ต่ำสุด</th>
                                        <th class="text-center">เกณฑ์สูงสุด</th>
                                        <th class="text-center">จัดการ</th>
                                        
                                    </tr>
                                </thead>
                                <?php
                    
                                $sql_grade = "SELECT * FROM grade ORDER BY standard_max_point desc";
                                                 
                                $query = mysqli_query($conn, $sql_grade); //$conn มาจากไฟล์ connection_mysqli.php เป็นตัว connect DB

                                 ?>
                                <?php  while($result = mysqli_fetch_array($query, MYSQLI_ASSOC)){ 
                                    $name = $result["grade_description"];
                                    $maxpoint = $result["standard_max_point"];
                                    $minpoint = $result["standard_min_point"];
                                    $id = $result["grade_id"];

                                   
                                ?>
                                
                            
                                <tr>
                                    <td style="width: 300px">&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $name; ?></td>
                                    <td class="text-center" style="width: 200px"><?php echo $minpoint; ?></td>
                                    <td class="text-center" style="width: 200px"><?php echo $maxpoint; ?></td>
                                     <td class="text-center" style="width: 200px">
                                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#<?php echo $id; ?>">
                                                        <i class="glyphicon glyphicon-pencil" ></i>แก้ไข
                                                    </button>                                                   
                                                    |
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#<?php echo $id; ?>_delete">
                                                   
                                                        <i class="glyphicon glyphicon-remove" ></i>ลบ
                                                    </button>
                                                </td>
                                </tr>
                              

                       <!--Edit Modal -->

                                <form class="form-horizontal" name="frmMain" method="post" action="manage_grade.php?erp=update&id=<?php echo $id; ?>" >
                                        <div class="modal fade" id="<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-blue">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">แก้ไขข้อมูล</h4>
                                                    </div>
                                                    <div class="modal-body">

                                                        <!--<iframe id="iframe_target" name="iframe_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>-->
                                                        <div class="input-group col-sm-12" >
                                                            <label for="ชื่อเกรด" class="col-sm-4 control-label">ชื่อเกรด:</label>
                                                            <div class="col-sm-8">               
                                                                <input type="text" class="form-control" value="<?php echo $result["grade_description"]; ?>" name='textgrade'   >
                                                            </div>
                                                        </div>
                                                        <div class="input-group col-sm-12" >
                                                            <label for="เกณฑ์คะแนนต่ำสุด" class="col-sm-4 control-label">เกณฑ์คะแนนต่ำสุด:</label>
                                                            <div class="col-sm-8">               
                                                                <input type="text" class="form-control" value="<?php echo $result["standard_min_point"]; ?>" name='textminpoint'    >
                                                            </div>
                                                        </div>
                                                        <div class="input-group col-sm-12" >
                                                            <label for="เกณฑ์คะแนนสูงสุด" class="col-sm-4 control-label">เกณฑ์คะแนนสูงสุด:</label>
                                                            <div class="col-sm-8">               
                                                                <input type="text" class="form-control" value="<?php echo $result["standard_max_point"]; ?>" name='textmaxpoint'    >
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success">บันทึก</button>
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                <!--Edit Modal -->
                                
                                <!--Delete Modal -->

                                <form class="form-horizontal" name="frmMain" method="post" action="manage_grade.php?erp=delete&id=<?php echo $id; ?>" >
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
                                                            <label for="ชื่อเกรด" class="col-sm-4 control-label">ชื่อเกรด:</label>
                                                            <div class="col-sm-8">               
                                                                <input type="text" class="form-control" value="<?php echo $result["grade_description"]; ?>" name='textgrade' readonly  >
                                                            </div>
                                                        </div>
                                                        <div class="input-group col-sm-12" >
                                                            <label for="เกณฑ์คะแนนต่ำสุด" class="col-sm-4 control-label">เกณฑ์คะแนนต่ำสุด:</label>
                                                            <div class="col-sm-8">               
                                                                <input type="text" class="form-control" value="<?php echo $result["standard_min_point"]; ?>" name='textminpoint' readonly   >
                                                            </div>
                                                        </div>
                                                        <div class="input-group col-sm-12" >
                                                            <label for="เกณฑ์คะแนนสูงสุด" class="col-sm-4 control-label">เกณฑ์คะแนนสูงสุด:</label>
                                                            <div class="col-sm-8">               
                                                                <input type="text" class="form-control" value="<?php echo $result["standard_max_point"]; ?>" name='textmaxpoint'  readonly  >
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger">ลบ</button>
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
    <?php include ('./script_packs.html'); ?>
</html>
            <?php
        }
    }

    
?>
