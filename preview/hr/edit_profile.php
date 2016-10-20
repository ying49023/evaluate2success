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
<!DOCTYPE html>
<html>
    <head>
        <?php 
        include ('./classes/connection_mysqli.php');
        if (isset($_GET["emp_id"])) {
                $get_emp_id = $_GET["emp_id"];
            }
            // Include คลาส class.upload.php เข้ามา เพื่อจัดการรูปภาพ
            require_once('./classes/class.upload.php') ;
            
        ?>
        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>การจัดการวันลาพนักงานรอบการประเมินที่... : ALT Evaluation</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!--CSS PACKS -->
        <?php include ('./css_packs.html'); ?>
        <!--ListJS-->
        <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.2.0/list.min.js"></script>
        <script>
            function getJobs(val) {
                $.ajax({
                    type: "POST",
                    url: "get_jobs.php",
                    data:'department_id='+val,
                    success: function(data){
                        $("#list").html(data);
                    }
                });
            }
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
                        แก้ไขข้อมูลพนักงาน
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Edit profile</li>
                    </ol>
                </section>
                <!--/Page header -->

                <!-- Main content -->
                <div class="row box-padding">
                    <!--edit employee-->
                    <?php 
                        $sql = "SELECT * FROM employees  WHERE employee_id = " .$_GET["emp_id"]. " limit 1";                        
                        $query = mysqli_query($conn, $sql);
                        while($result = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                            $prefix = $result["prefix"]; 
                            $f_name = $result["first_name"];
                            $l_name = $result["last_name"];
                            $name = $result["prefix"].$result["first_name"]."  ".$result["last_name"];
                            $address = $result["address"];
                            $hiredate =$result["hiredate"];
                            $telno =$result["telephone_no"];
                            $email =$result["email"];
                            $department_id = $result["department_id"];
                            $job_id = $result["job_id"];
                            $position_level_id = $result["position_level_id"];
                            $id = $result["employee_id"];
                            $mng_id =$result["manager_id"];
                            
                            $pic=$result["profile_picture"];
                            if($result["profile_picture"] == ""){
                                $pic = "default.png";
                            }else{
                                $pic = $result["profile_picture"];
                            }      
                    ?>
                    <form action="edit_profile_status.php?emp_id=<?php echo $id; ?>" method='POST' enctype="multipart/form-data" >
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">ข้อมูลของ : <?php echo $name; ?></h3>
                        </div>
                        <div class="box-body">
                            <div class="col-md-offset-1 col-md-10">
                            
                                <div class="row with-border">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <img class="thumbnail img-circle img-center" src="../upload_images/<?php echo $pic;?>"  alt="รูปโปรไฟล์" height="150px" width="120px" />
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-4">                                                
                                        <div class="form-group">
                                            <label>อัพโหลดรูปภาพ</label>
                                            <input class="form-control" id="image_name" name="image_name" value="<?php echo $pic;?>" type="file"  size="40" />
                                            
                                        </div>                                                
                                    </div>
                                    <div class="col-md-2">                                                
                                        <div class="form-group">
                                            <label>ID</label>
                                            <input class="form-control" name="empid" type="text" value="<?php echo $id; ?>" disabled="true">
                                        </div>                                                
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>คำนำหน้า</label>
                                            <select class="form-control" name="prefix">
                                                <option value="">เลือก</option>
                                                <option value="นาย" <?php if($prefix == 'นาย'){ echo "selected";} ?>>นาย</option>
                                                <option value="นางสาว" <?php if($prefix == 'นางสาว'){ echo "selected";} ?> >นางสาว</option>
                                                <option value="นาง" <?php if($prefix == 'นาง'){ echo "selected";} ?> >นาง</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">                                                
                                        <div class="form-group">
                                            <label>ชื่อ</label>
                                            <input class="form-control" name="first_name" type="text" value="<?php echo $f_name; ?>">
                                        </div>                                                
                                    </div>
                                    <div class="col-md-6">                                                
                                        <div class="form-group">
                                            <label>นามสกุล</label>
                                            <input class="form-control" name="last_name" type="text" value="<?php echo $l_name; ?>">
                                        </div>                                               
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">                                                
                                        <div class="form-group">
                                            <label>วันที่เริ่มงาน</label>
                                            <div class="input-group date" data-provide="datepicker" name="startdate">
                                                <input type="text" class="form-control" value="<?php echo $hiredate; ?>" disabled="true" >
                                                <div class="input-group-addon">
                                                    <span class="glyphicon glyphicon-th"></span>
                                                </div>
                                            </div>
                                            <script>
                                                $('.datepicker').datepicker();
                                            </script>
                                        </div>                                                
                                    </div>
                                    <?php
                                    $sql_department = "SELECT * FROM departments ";
                                    $query_department = mysqli_query($conn, $sql_department);
                                    ?>
                                    <div class="col-md-6">                                               
                                        <div class="form-group">
                                            <label>แผนก</label>
                                            <select class="form-control" name="department" onchange="getJobs(this.value);">
                                                <option value="">--เลือกแผนก--</option>
                                                <?php while ($result_department = mysqli_fetch_array($query_department)) { ?>
                                                    <option <?php if($department_id == $result_department["department_id"]){ echo "selected";} ?> value="<?php echo $result_department["department_id"]; ?>"  >
                                                        <?php echo $result_department["department_id"] . " - " . $result_department["department_name"]; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>                                                        
                                        </div>                                                
                                    </div>
                                </div>

                                <div class="row">
                                    <?php
                                    $sql_position_level = "SELECT * FROM position_level ";
                                    $query_position_level = mysqli_query($conn, $sql_position_level);
                                    ?>
                                    <div class="col-md-6">                                                
                                        <div class="form-group">
                                            <label>ระดับ </label>
                                            <select class="form-control" name="position_level_id">
                                                <option value="">--เลือกระดับ--</option>
                                                <?php while ($result_position_level = mysqli_fetch_array($query_position_level)) { ?>
                                                    <option value="<?php echo $result_position_level["position_level_id"]; ?>"  <?php if($position_level_id == $result_position_level["position_level_id"]){ echo "selected";} ?>>
                                                        <?php echo $result_position_level["position_level_id"] . " - " . $result_position_level["position_description"]; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>

                                        </div>                                                
                                    </div>   
                                    
                                    <?php
                                    $sql_job = "SELECT * FROM jobs WHERE department_id = '".$department_id."'   ";
                                    $query_job = mysqli_query($conn, $sql_job);
                                    ?>
                                    <div class="col-md-6">                                                
                                        <div class="form-group">
                                            <label>ตำแหน่ง</label>
                                            <select class="form-control" name="job_id"  id="list">
                                                <option value="">--เลือกตำแหน่ง--</option>
                                                <?php foreach ( $query_job as $result_job){ ?>
                                                    <option value="<?php echo $result_job["job_id"]; ?>" <?php if($job_id == $result_job["job_id"]){ echo "selected";} ?>>
                                                        <?php echo $result_job["job_name"]; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>                                                
                                    </div>
                                     
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                                            $sql_mng = "SELECT first_name, last_name,employee_id FROM employees WHERE position_level_id IN (2,3,4) ";
                                                            $query_mng = mysqli_query($conn, $sql_mng);
                                            ?>
                                            <label>หัวหน้าผู้รับผิดชอบ</label>
                                            <select class="form-control" name="manager" required>
                                                                        <option value="">--เลือกหัวหน้า--</option>
                                                                        <?php while ($result_mng = mysqli_fetch_array($query_mng)) { 
                                                                            $mng_name = $result_mng["first_name"].' '.$result_mng["last_name"];
                                                                        ?>
                                                                        <option value="<?php echo $mng_name; ?>" <?php if($mng_id == $result_mng["employee_id"]){ echo "selected";} ?>>
                                                                                <?php echo $mng_name ?>
                                                                        </option>
                                                                        <?php } ?>
                                            </select>
                                        </div>                                               
                                    </div>
                                                
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>เบอร์ติดต่อ</label>
                                            <input type="text" name="telephone" class="form-control" value="<?php echo $telno ?>" />
                                        </div>
                                    </div>  
                                </div>                                       
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>ที่อยู่</label>
                                            <textarea name="address" class="form-control" rows="3" ><?php echo $address; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>email</label>
                                            <input type="email" name="email" class="form-control" value="<?php echo $email; ?>" />
                                        </div>
                                    </div>  
                                </div>
                                
                                <br>

                            </div>
                    </div>
                            <!-- /Box body -->
                            <div class="box-footer text-center">
                                <button class="btn btn-danger search-button" onclick="goBack()">ย้อนกลับ</button>
                                <input  class="btn btn-success search-button" type="submit" name="Send" value="บันทึก">     
                            </div>
                        
                    </div>
                    </form>
                        <?php } ?>
                    <!--/edit employee-->
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
