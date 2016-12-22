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
<?php include('./classes/connection_mysqli.php');
        
        $fn='';
        $msg='';
        if(isset($_GET['fn']))
            $fn=$_GET['fn'];
        
        
        // Include คลาส class.upload.php เข้ามา เพื่อจัดการรูปภาพ
        require_once('classes/class.upload.php') ;
        //  ถ้าหากหน้านี้ถูกเรียก เพราะการ submit form  
        //  ประโยคนี้จะเป็นจริงกรณีเดียวก็ด้วยการ submit form 

        //++++++++++++++++++save record+++++++++++++        
                               
        if($fn=='add'){
            $prefix =$_POST['prefix'];
            $first_name=$_POST['first_name'];
            $last_name=$_POST['last_name'];
            $department_id=$_POST['department'];
            $job_id=$_POST['job_id'];
            $position_level_id=$_POST['position_level_id'];
            $manager=$_POST['manager'];
            $manager2=$_POST['manager2'];
            $telephone=$_POST['telephone'];
            $address=$_POST['address'];
            $email=$_POST['email'];
            $hiredate =$_POST['startdate'];
            $emp_id = $_POST['emp_id'];
            $mng =''; 
            
            // เริ่มต้นใช้งาน class.upload.php ด้วยการสร้าง instant จากคลาส
            $upload_image = new upload($_FILES['image_name']) ; // $_FILES['image_name'] ชื่อของช่องที่ให้เลือกไฟล์เพื่ออัปโหลด

            //  ถ้าหากมีภาพถูกอัปโหลดมาจริง
            if ( $upload_image->uploaded ) {

                // ย่อขนาดภาพให้เล็กลงหน่อย  โดยยึดขนาดภาพตามความกว้าง  ความสูงให้คำณวนอัตโนมัติ
                // ถ้าหากไม่ต้องการย่อขนาดภาพ ก็ลบ 3 บรรทัดด้านล่างทิ้งไปได้เลย
                $upload_image->image_resize         = true ; // อนุญาติให้ย่อภาพได้
                $upload_image->image_x              = 400 ; // กำหนดความกว้างภาพเท่ากับ 400 pixel 
                $upload_image->image_ratio_y        = true; // ให้คำณวนความสูงอัตโนมัติ

                $upload_image->process( "http://palmup.xyz/evaluate2success/preview/upload_images" ); // เก็บภาพไว้ในโฟลเดอร์ที่ต้องการ  *** โฟลเดอร์ต้องมี permission 0777

                // ถ้าหากว่าการจัดเก็บรูปภาพไม่มีปัญหา  เก็บชื่อภาพไว้ในตัวแปร เพื่อเอาไปเก็บในฐานข้อมูลต่อไป
                if ( $upload_image->processed ) {

                    $image_name =  $upload_image->file_dst_name ; // ชื่อไฟล์หลังกระบวนการเก็บ จะอยู่ที่ file_dst_name
                    $upload_image->clean(); // คืนค่าหน่วยความจำ
                    //
                    //
                    //
//                    $sql = "SELECT employee_id,concat(first_name,' ',last_name) as name from employees where concat(first_name,' ',last_name) like '%$manager%'  ";
//                    $query= mysqli_query($conn, $sql);
//                     while($mresult = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
//                     $mng =$mresult['employee_id'];                                           
//                     $name =$mresult['name'];
//                     echo $mng;
//                     echo $name;
//
//                     }   
                    echo $add_query="INSERT INTO employees(prefix,first_name,last_name,department_id,job_id,position_level_id,manager_id,manager_id2,telephone_no,address,email,company_id,hiredate,profile_picture,employee_id) VALUES ('$prefix','$first_name','$last_name',$department_id,$job_id,$position_level_id,$manager,$manager2,'$telephone','$address','$email',1,'$hiredate','$image_name',$emp_id)";            
                    $a_query =  mysqli_query($conn,$add_query);
                    $sql_Individual_eval_Emp = "CALL gen_Individual_eval_Emp($emp_id)";
                    $query_Individual_eval_Emp = mysqli_query($conn, $sql_Individual_eval_Emp);
                    if($a_query){
                        echo $add_query;
                       header ("location:manage_employee_list.php");
                    }else {
                        $msg='Error :'.mysql_error();
                        echo "Error Save [" . $add_query . "]";
                        //echo $sql;


                    }
                    // เก็บชื่อภาพลงฐานข้อมูล
                    //$insertSQL = sprintf("INSERT INTO tbl_image (image_name) VALUES ( '%s' )", $image_name );
                    //echo $insertSQL ;
                    //mysql_select_db($dbName, $conn);
                    //mysqli_select_db($conn, $dbName);
                    //$Result1 = mysqli_query($conn,$insertSQL) or die(mysql_error());



                }// END if ( $upload_image->processed )

            }//END if ( $upload_image->uploaded )
            
            
        }
           
            
       
        ?>
<html>
    <head>
        <?php include ('./classes/connection_mysqli.php'); ?>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>เพิ่มข้อมูลพนักงาน : ALT Evaluation</title>
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
                        จัดการข้อมูลพนักงาน
                        <small>เพิ่มข้อมูลพนักงาน</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Add employee</li>
                    </ol>
                </section>
                <!--/Page header -->

                <!-- Main content -->
                    <div class="animated fadeIn row box-padding">
                        <div class="box box-primary">
                        <div class="box-header with-border">
                            <h4>เพิ่มข้อมูลพนักงาน</h4>                           
                        </div>                           
                        <!--add employee-->
                        <div class="row ">
                            <div class="col-md-offset-1 col-md-10 box-padding">
                                <form action='manage_employee_insert.php?fn=add' method='POST' enctype="multipart/form-data" name="form1" id="form1">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-4">                                                
                                                <div class="form-group">
                                                    <label>อัพโหลดรูปภาพ</label>
                                                    <input class="form-control" name="image_name" value="<?php echo $pic;?>" type="file" id="image_name" size="40" >

                                                </div>                                                
                                            </div>
                                            
                                            <div class="col-md-2">                                                
                                                <div class="form-group">
                                                    <label>รหัสพนักงาน<span style="color: red;">*</span></span></label>
                                                    <input class="form-control" name="emp_id" type="text" required>
                                                </div>                                                
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>คำนำหน้า<span style="color: red;">*</span></label>
                                                    <select class="form-control" name="prefix" required>
                                                        <option value="">เลือก</option>
                                                        <option value="นาย">นาย</option>
                                                        <option value="นางสาว">นางสาว</option>
                                                        <option value="นาง">นาง</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">                                                
                                                <div class="form-group">
                                                    <label>ชื่อ<span style="color: red;">*</span></span></label>
                                                    <input class="form-control" name="first_name" type="text" required>
                                                </div>                                                
                                            </div>
                                            <div class="col-md-6">                                                
                                                <div class="form-group">
                                                    <label>นามสกุล<span style="color: red;">*</span></label>
                                                    <input class="form-control" name="last_name" type="text" required >
                                                </div>                                               
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">                                                
                                                <div class="form-group">
                                                    <label>วันที่เริ่มงาน<span style="color: red;">*</span></label>                                                                    
                                                    <input type="date" class="form-control"  name="startdate" required>                                                                    
                                                </div>                                                
                                            </div>
                                            <?php
                                            $sql_department = "SELECT * FROM departments ";
                                            $query_department = mysqli_query($conn, $sql_department);                                                            
                                            ?>
                                            <div class="col-md-6">                                               
                                                <div class="form-group">
                                                    <label>แผนก<span style="color: red;">*</span></label>
                                                    <select class="form-control" name="department" onchange="getJobs(this.value)" required>
                                                        <option value="">--เลือกแผนก--</option>
                                                        <?php while ($result_department = mysqli_fetch_array($query_department)) { ?>
                                                        <option value="<?php echo $result_department["department_id"]; ?>">
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
                                                    <label>ระดับ<span style="color: red;">*</span></label>
                                                    <select class="form-control" name="position_level_id" required>
                                                        <option value="">--เลือกระดับ--</option>
                                                        <?php while ($result_position_level = mysqli_fetch_array($query_position_level)) { ?>
                                                        <option value="<?php echo $result_position_level["position_level_id"]; ?>">
                                                                <?php echo $result_position_level["position_level_id"] . " - " . $result_position_level["position_description"]; ?>
                                                        </option>
                                                        <?php } ?>
                                                    </select>

                                                </div>                                                
                                            </div>    
                                            <?php
                                            $sql_job = "SELECT * FROM jobs ";
                                            $query_job = mysqli_query($conn, $sql_job);
                                            ?>
                                            <div class="col-md-6">                                                
                                                <div class="form-group">
                                                    <label>ตำแหน่ง<span style="color: red;">*</span></label>
                                                    <select class="form-control" name="job_id" id="list" required>
                                                        <option value="">--เลือกตำแหน่ง--</option>
                                                        <?php while ($result_job = mysqli_fetch_array($query_job)) { ?>
                                                        <option value="<?php echo $result_job["job_id"]; ?>">
                                                                <?php echo $result_job["job_id"] . " - " . $result_job["job_name"]; ?>
                                                        </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>                                                
                                            </div>

                                        </div>

                                        <div class="row">
                                            <?php
                                            $sql_mng = "SELECT first_name, last_name , employee_id FROM employees WHERE position_level_id IN (2,3,4) ";
                                            $query_mng = mysqli_query($conn, $sql_mng);
                                            ?>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>หัวหน้าผู้รับผิดชอบคนที่ 1</label>                                                                    
                                                    <select class="form-control" name="manager" required>
                                                        <option value="">--เลือกหัวหน้า--</option>
                                                                                                            <?php echo $mng_name ?>
                                                        <?php while ($result_mng = mysqli_fetch_array($query_mng)) {
                                                            $mng_id = $result_mng["employee_id"];
                                                            $mng_name = $result_mng["first_name"].' '.$result_mng["last_name"];
                                                        ?>
                                                        <option value="<?php echo $mng_id; ?>">
                                                                <?php echo $mng_name ?>
                                                        </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>                                               
                                            </div>
                                            <?php
                                            $sql_mng2 = "SELECT first_name, last_name,employee_id FROM employees WHERE position_level_id IN (2,3,4) ";
                                            $query_mng2 = mysqli_query($conn, $sql_mng2);
                                            ?>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>หัวหน้าผู้รับผิดชอบคนที่ 2</label>                                                                    
                                                    <select class="form-control" name="manager2" required>
                                                        <option value="">--เลือกหัวหน้า--</option>
                                                        <?php while ($result_mng2 = mysqli_fetch_array($query_mng2)) { 
                                                            $mng_name2 = $result_mng2["first_name"].' '.$result_mng2["last_name"];
                                                            $mng_id2 = $result_mng2["employee_id"];
                                                        ?>
                                                        <option value="<?php echo $mng_id2; ?>">
                                                                <?php echo $mng_id2.' - '.$mng_name2; ?>
                                                        </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>                                               
                                            </div>
                                             
                                        </div>                                       
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>ที่อยู่</label>
                                                    <textarea name="address" class="form-control" rows="3"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>email<span style="color: red;">*</span></label>
                                                    <input type="email" name="email" class="form-control" required />
                                                </div>
                                            </div>  
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>เบอร์ติดต่อ</label>
                                                        <input type="text" name="telephone" class="form-control" />
                                                    </div>
                                                </div> 
                                            <div class="col-md-6">
                                                 <?php
                                                 $sql_maincompany = "SELECT * FROM company";
                                                 $query_maincompany = mysqli_query($conn, $sql_maincompany );


                                                ?>

                                                <div class="form-group">
                                                    <label>บริษัทหลัก<span style="color: red;">*</span></label>

                                                    <select class="form-control" name="maincompany" required >
                                                        <option value="">--เลือก--</option> 
                                                        <?php while($result_maincompany = mysqli_fetch_array($query_maincompany,MYSQLI_ASSOC)) { 
                                                        $maincompany_name = $result_maincompany["company_name"];
                                                        $maincompany_id = $result_maincompany["company_id"];
                                                    ?>
                                                        <option value="<?php echo $maincompany_id; ?>">
                                                                <?php echo $maincompany_name; ?>
                                                        </option>
                                                     <?php } ?>    
                                                    </select>

                                                </div>

                                                </div>
                                <!--            <div class="col-md-6">
                                                <?php
                                                 $sql_company = "SELECT * FROM company";
                                                 $query_company = mysqli_query($conn, $sql_company);


                                                ?>

                                                <div class="col-md-12">
                                                    <label>บริษัททั้งหมด </label>
                                                </div>

                                                    <?php while($result_company = mysqli_fetch_array($query_company,MYSQLI_ASSOC)) { 
                                                        $company_name = $result_company["company_name"];
                                                        $company_id = $result_company["company_id"];
                                                    ?>
                                                <div class="col-md-2">
                                                        <div class="form-inline">

                                                            <label class="">
                                                                <input class="form-check-input" type="checkbox" name="company" id="inlineCheckbox1" value="<?php echo $company_id; ?>" ><?php echo $company_name; ?>

                                                            </label>

                                                        </div>
                                                </div>


                                                    <?php } ?>
                                            </div> -->


                                        </div>


                                    </div><!-- /Box body -->
                                    <div class="box-footer">
                                        <center>
                                            <input  class="btn btn-danger search-button" type="reset" name="Reset">
                                            <button type="submit" class="btn btn-success search-button" value="Upload" >เพิ่ม</button>
                                        </center>

                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--/add employee-->
                         <?php echo $msg;?>                                     
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