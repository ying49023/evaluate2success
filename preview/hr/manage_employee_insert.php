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
            $telephone=$_POST['telephone'];
            $address=$_POST['address'];
            $email=$_POST['email'];
            $hiredate =$_POST['startdate'];
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

                $upload_image->process( "upload_images" ); // เก็บภาพไว้ในโฟลเดอร์ที่ต้องการ  *** โฟลเดอร์ต้องมี permission 0777

                // ถ้าหากว่าการจัดเก็บรูปภาพไม่มีปัญหา  เก็บชื่อภาพไว้ในตัวแปร เพื่อเอาไปเก็บในฐานข้อมูลต่อไป
                if ( $upload_image->processed ) {

                    $image_name =  $upload_image->file_dst_name ; // ชื่อไฟล์หลังกระบวนการเก็บ จะอยู่ที่ file_dst_name
                    $upload_image->clean(); // คืนค่าหน่วยความจำ
                    //
                    //
                    //
                    $sql = "SELECT employee_id,concat(first_name,' ',last_name) as name from employees where concat(first_name,' ',last_name) like '%$manager%'  ";
                    $query= mysqli_query($conn, $sql);
                     while($mresult = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                     $mng =$mresult['employee_id'];                                           
                     $name =$mresult['name'];
                     echo $mng;
                     echo $name;

                     }   
                    $add_query="INSERT INTO employees(prefix,first_name,last_name,department_id,job_id,position_level_id,manager_id,telephone_no,address,email,company_id,hiredate,profile_picture) VALUES ('$prefix','$first_name','$last_name',$department_id,$job_id,$position_level_id,$mng,'$telephone','$address','$email',1,'$hiredate','$image_name')";            
                    $a_query =  mysqli_query($conn,$add_query);

                    if($a_query)
                       header ("location:manage_employee_list.php");
                    else {
                        $msg='Error :'.mysql_error();
                        echo "Error Save [" . $add_query . "]";
                        echo $sql;


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
        <!-- SCRIPT PACKS -->
        <?php include ('./script_packs.html'); ?>
        <script>
            $.extend(true, $.fn.dataTable.defaults, {
                "language": {
                    "sProcessing": "กำลังดำเนินการ...",
                    "sLengthMenu": "แสดง_MENU_ แถว",
                    "sZeroRecords": "ไม่พบข้อมูล",
                    "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
                    "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
                    "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
                    "sInfoPostFix": "",
                    "sSearch": "ค้นหา:",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "เริ่มต้น",
                        "sPrevious": "ก่อนหน้า",
                        "sNext": "ถัดไป",
                        "sLast": "สุดท้าย"
                    }
                }
            });
            $(document).ready(function() {
                $('#example').DataTable();
            } );
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
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">manage employee</li>
                    </ol>
                </section>
                <!--/Page header -->

                <!-- Main content -->
                    <div class="row box-padding">
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
                                                                    <select class="form-control" name="department" required>
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
                                                            $sql_job = "SELECT * FROM jobs ";
                                                            $query_job = mysqli_query($conn, $sql_job);
                                                            ?>
                                                            <div class="col-md-6">                                                
                                                                <div class="form-group">
                                                                    <label>ตำแหน่ง<span style="color: red;">*</span></label>
                                                                    <select class="form-control" name="job_id" required>
                                                                        <option value="">--เลือกตำแหน่ง--</option>
                                                                        <?php while ($result_job = mysqli_fetch_array($query_job)) { ?>
                                                                        <option value="<?php echo $result_job["job_id"]; ?>">
                                                                                <?php echo $result_job["job_id"] . " - " . $result_job["job_name"]; ?>
                                                                        </option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>                                                
                                                            </div>
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
                                                        </div>

                                                        <div class="row">
                                                            <?php
                                                            $sql_mng = "SELECT first_name, last_name FROM employees WHERE position_level_id IN (2,3,4) and department_id = 1";
                                                            $query_mng = mysqli_query($conn, $sql_mng);
                                                            ?>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>หัวหน้าผู้รับผิดชอบ</label>                                                                    
                                                                    <select class="form-control" name="manager" required>
                                                                        <option value="">--เลือกหัวหน้า--</option>
                                                                        <?php while ($result_mng = mysqli_fetch_array($query_mng)) { 
                                                                            $mng_name = $result_mng["first_name"].' '.$result_mng["last_name"];
                                                                        ?>
                                                                        <option value="<?php echo $mng_name; ?>">
                                                                                <?php echo $mng_name ?>
                                                                        </option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>                                               
                                                            </div>
                                                            <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>เบอร์ติดต่อ</label>
                                                                        <input type="text" name="telephone" class="form-control" />
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
                                                                    <label>email</label>
                                                                    <input type="email" name="email" class="form-control" />
                                                                </div>
                                                            </div>  
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group">
                                                                <div class="col-md-6">
                                                                    <label>อัพโหลดภาพ</label>
                                                                    <input name="image_name" type="file" id="image_name" size="40" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>

                                                    </div><!-- /Box body -->
                                                    <div class="box-footer">
                                                        <center>
                                                            <input  class="btn btn-danger search-button" type="reset" name="Reset">
                                                            <button type="submit" class="btn btn-primary search-button" value="Upload" >เพิ่ม</button>
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
</html>