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
        
        $get_dept_id = '';
        if(isset ($_GET["department_id"])){
            $get_dept_id = $_GET["department_id"];
            $condition = " WHERE j.department_id = '$get_dept_id' ";
        }
        if($get_dept_id == ''){
            $condition = " ";
        }
        
        if(isset($_GET['erp'])) {
            $erp=$_GET['erp'];
            //++++++++++++++++++insert record+++++++++++++
           if($erp == 'insert'){          
               $job_name =$_POST['job_name'];
               $department_id = $_POST["department_id"];

               $strSQL =" INSERT INTO jobs(job_name,department_id) VALUES('$job_name','$department_id') ";
               $objQuery = mysqli_query($conn,$strSQL);
               if ($objQuery) {

                   header ("location:jobs_table.php");

               } else {

                   echo "Error Save [" . $strSQL . "]";
               }

           }
            //++++++++++++++++++update record+++++++++++++
           if($erp == 'update'){ 
               if (isset($_POST["job_id"]) && isset($_POST["department_id"])) {
                    $job_name = $_POST['job_name'];
                    $job_id = $_POST['job_id'];
                    $department_id = $_POST["department_id"];
                    $strSQL = " UPDATE jobs SET job_name ='$job_name' WHERE job_id='$job_id' and department_id = '$department_id' ";
                    $objQuery = mysqli_query($conn, $strSQL);
                    if ($objQuery) {
                        echo $strSQL;
                    header ("location:jobs_table.php");
                    } else {
                        echo "Error Save [" . $strSQL . "]";
                    }
                }
            }
            //++++++++++++++++++delete record+++++++++++++
           if($erp == 'delete'){  
               if (isset($_POST["job_id"])) {
                    $job_id = $_POST['job_id'];
                        
                    $strSQL = " DELETE FROM jobs WHERE job_id='$job_id' ";
                    $objQuery = mysqli_query($conn, $strSQL);
                    if ($objQuery) {
                        echo $strSQL;
                    header ("location:jobs_table.php");
                    } else {
                        echo "Error Save [" . $strSQL . "]";
                    }
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
        <!--CSS PACKS -->
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
             
                <div id="filter" class=" row box-padding">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">ตารางแสดงตำแหน่งงาน</h3>
                            
                            <a class="pull-right " data-toggle="collapse" href="#strenghtPoint">
                                <button type="button" class="btn btn-success">เพิ่มตำแหน่ง</button>
                            </a>
                        </div>
                        <!-- Modal New -->
                        <div class="collapse bg-gray-light box-padding" id="strenghtPoint" >
                            <form action="jobs_table.php?erp=insert" method="POST">
                            <div class="row">
                                <div class="col-sm-5">
                                    <label>ระบุแผนก / ฝ่าย</label>
                                    <select  id="dept_test" class="form-control" name="department_id"   >
                                        <option value="">  เลือกแผนก/ฝ่าย  </option>
                                                <?php
                                                $sql_dept = "SELECT * FROM departments";

                                                $query = mysqli_query($conn, $sql_dept);

                                                foreach ($query as $result) {
                                                    ?>
                                        <option value="<?php echo $result["department_id"] ?>" <?php if ($get_dept_id == $result["department_id"]) { echo "selected"; } ?> >
                                            <?php echo $result["department_name"] ?>
                                        </option>
                                                    <?php
                                                }
                                                ?>
                                    </select>
                                </div>
                                <div class="col-sm-5">
                                    <label>ระบุชื่อตำแหน่ง</label>
                                    <input class="form-control" type="text" name="job_name" placeholder="----- กรุณากรอกชื่อตำแหน่งงาน -----">
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                      <input class="btn btn-info btn-md" style="margin-top:25px;width: 100%;" type="submit" value="เพิ่ม">
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                        <!--/Modal New -->
                        
                        <!-- job table -->
                        <div class="box-body ">   
                            
                            <!-- ช่องค้นหา by listJS -->
                            <div class="form-group col-sm-6 col-md-5 col-lg-4">
                                <label><i class="glyphicon glyphicon-search" style="padding: 0px 10px;" ></i>ค้นหา</label>
                                <input class="search form-control" placeholder="พิมพ์ค้นหา" >
                            </div>
                            <script>
                                function searchDept(){
                                    document.submit_auto.submit();
                                }
                            </script>
                            <form name="submit_auto" method="get" onchange="searchDept()">
                            <div class="col-sm-6 col-md-7 col-lg-6 form-group">
                                <label>เลือกแผนก/ฝ่าย : </label>
                                <select  id="dept_test" class="form-control" name="department_id"   >
                                    <option value="">  เลือกแผนก/ฝ่าย  </option>
                                            <?php
                                            $sql_dept = "SELECT * FROM departments";
                                                
                                            $query = mysqli_query($conn, $sql_dept);
                                                
                                            foreach ($query as $result) {
                                                ?>
                                    <option value="<?php echo $result["department_id"] ?>" <?php if ($get_dept_id == $result["department_id"]) { echo "selected"; } ?> >
                                        <?php echo $result["department_name"] ?>
                                    </option>
                                                <?php
                                            }
                                            ?>
                                </select>
                            </div>
                            </form>
                            <table id="dept_table" class="table table-bordered table-hover table-striped" >
                                <thead>
                                    <tr class="table-active">
                                        <th><button class="sort" data-sort="job_name">ตำแหน่งงาน</button></th>
                                        <th><button class="sort" data-sort="dept_name">แผนก / ฝ่าย</button></th>
                                        <th class="text-center" style="width: 150px;">จัดการ</th>
                                    </tr>
                                </thead>
                                <?php
                    
                                $sql_jobs = "SELECT * FROM jobs j JOIN departments d ON j.department_id = d.department_id ".$condition." ORDER BY job_name ASC";
                                                 
                                $query = mysqli_query($conn, $sql_jobs); //$conn มาจากไฟล์ connection_mysqli.php เป็นตัว connect DB

                                 ?>
                                <tbody class="list">
                                <?php  while($result = mysqli_fetch_array($query, MYSQLI_ASSOC)){ 
                                    $job_name = $result["job_name"];
                                    $dept_name = $result["department_name"];
                                    $dept_id = $result["department_id"];
                                    $job_id = $result["job_id"];
                                   
                                ?>
                                    <tr>
                                        <td class="job_name"><?php echo $job_name; ?></td>
                                        <td class="dept_name"><?php echo $dept_name; ?></td>
                                            
                                        <td class="text-center">
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit_<?php echo $job_id; ?>">
                                                <i class="glyphicon glyphicon-pencil" ></i>แก้ไข
                                            </button>                                            
                                            |   
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"  data-target="#<?php echo $job_id; ?>_delete">
                                                <i class="glyphicon glyphicon-remove" ></i>ลบ
                                            </button>
                                            <!--Edit Modal -->
                                            <form class="form-horizontal" name="frmMain" method="post" action="jobs_table.php?erp=update" >
                                                    <div class="modal fade" id="edit_<?php echo $job_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-blue">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title" id="myModalLabel">แก้ไขข้อมูล</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="form-group row box-padding" >
                                                                        <label for="แผนก / ฝ่าย:" class="col-sm-4 control-label">แผนก / ฝ่าย:</label>
                                                                        <div class="col-sm-8">               
                                                                            <input type="text" class="form-control" value="<?php echo $dept_name; ?>" name='department_name' disabled >
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row box-padding" >
                                                                        <label for="ชื่อตำแหน่งงาน" class="col-sm-4 control-label">ชื่อตำแหน่งงาน:</label>
                                                                        <div class="col-sm-8">               
                                                                            <input type="text" class="form-control" value="<?php echo $job_name; ?>" name='job_name'   >
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <input type="hidden" class="form-control" value="<?php echo $job_id; ?>" name='job_id' >
                                                                    <input type="hidden" class="form-control" value="<?php echo $dept_id; ?>" name='department_id' >
                                                                    <input type="submit" class="btn btn-success" value="แก้ไข" >
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </form>
                                            <!--Edit Modal -->
                                            <!--Delete Modal -->
                                                <form class="form-horizontal" method="post" action="jobs_table.php?erp=delete" >
                                                    <div class="modal fade" id="<?php echo $job_id; ?>_delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title" id="myModalLabel">ลบข้อมูล</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="form-group row box-padding" >
                                                                        <label for="แผนก / ฝ่าย:" class="col-sm-4 control-label">แผนก / ฝ่าย:</label>
                                                                        <div class="col-sm-8">               
                                                                            <input type="text" class="form-control" value="<?php echo $dept_name; ?>" name='department_name' disabled   >
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row box-padding" >
                                                                        <label for="ชื่อตำแหน่งงาน" class="col-sm-4 control-label">ชื่อตำแหน่งงาน:</label>
                                                                        <div class="col-sm-8">               
                                                                            <input type="text" class="form-control" value="<?php echo $job_name; ?>" name='job_name' disabled  >
                                                                        </div>
                                                                    </div>



                                                                </div>
                                                                <div class="modal-footer">
                                                                    <input type="hidden" class="form-control" value="<?php echo $job_id; ?>" name='job_id' >
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
                            </tbody>
                            <script>
                                var options = {
                                    valueNames: [ 'job_name','dept_name']
                                };
                                
                                var userList = new List('filter', options);
                            </script>
                            </table>
                         
                        </div>
                        <!--/job table -->

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
