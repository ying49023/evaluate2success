<?php
include ('./classes/connection_mysqli.php');
require_once('classes/class.upload.php') ;
$status = '';
$empid = '';
$msg = '';
/* if(isset($_GET["status"])){
  $status = $_GET["status"];
  } */
if (isset($_GET["emp_id"])) {
    $get_emp_id = $_GET["emp_id"];
}
if ($get_emp_id != '') {
    $prefix = $_POST['prefix'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $department_id = $_POST['department'];
    $job_id = $_POST['job_id'];
    $position_level_id = $_POST['position_level_id'];
    $manager = $_POST['manager'];
    $telephone = $_POST['telephone'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $pic= strtolower($_POST['image_name']);
    //$hiredate =$_POST['startdate'];
    $mng = '';
    $sql = "SELECT employee_id,concat(first_name,' ',last_name) as name from employees where concat(first_name,' ',last_name) like '%$manager%'  ";
    $query = mysqli_query($conn, $sql);
    while ($mresult = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        $mng = $mresult['employee_id'];
        $name = $mresult['name'];
    }
    //$add_query="UPDATE employees(prefix,first_name,last_name,department_id,job_id,position_level_id,manager_id,telephone_no,address,email,company_id) VALUES ('$prefix','$first_name','$last_name',$department_id,$job_id,$position_level_id,$mng,'$telephone','$address','$email',1) where employee_id=$id";            
     $upload_image = new upload($_FILES['image_name']) ;
     //  ถ้าหากมีภาพถูกอัปโหลดมาจริง
            if( $upload_image->uploaded ) {
                // ย่อขนาดภาพให้เล็กลงหน่อย  โดยยึดขนาดภาพตามความกว้าง  ความสูงให้คำณวนอัตโนมัติ
                // ถ้าหากไม่ต้องการย่อขนาดภาพ ก็ลบ 3 บรรทัดด้านล่างทิ้งไปได้เลย
                $upload_image->image_resize         = true ; // อนุญาติให้ย่อภาพได้
                $upload_image->image_x              = 400 ; // กำหนดความกว้างภาพเท่ากับ 400 pixel 
                $upload_image->image_ratio_y        = true; // ให้คำณวนความสูงอัตโนมัติ
                $upload_image->process( "upload_images" ); // เก็บภาพไว้ในโฟลเดอร์ที่ต้องการ  *** โฟลเดอร์ต้องมี permission 0777
                // ถ้าหากว่าการจัดเก็บรูปภาพไม่มีปัญหา  เก็บชื่อภาพไว้ในตัวแปร เพื่อเอาไปเก็บในฐานข้อมูลต่อไป
                if( $upload_image->processed ) {
                    $image_name =  $upload_image->file_dst_name ; // ชื่อไฟล์หลังกระบวนการเก็บ จะอยู่ที่ file_dst_name
                    $upload_image->clean(); // คืนค่าหน่วยความจำ
                    //
                    //
                    //
                      $add_query = "UPDATE employees SET prefix ='$prefix',first_name='$first_name',last_name='$last_name',department_id=$department_id,job_id=$job_id,manager_id=$mng,position_level_id=$position_level_id,telephone_no='$telephone',email='$email',address='$address',company_id=1,profile_picture='$pic' WHERE employee_id=$get_emp_id ";
                        $a_query = mysqli_query($conn, $add_query);
                        if ($a_query)
                            echo "Record update successfully";
                        else {
                            $msg = 'Error :' . mysql_error();
                            echo "Error Save [" . $add_query . "]";
                        }
                        header("Location: edit_profile.php?emp_id=".$get_emp_id);                 
                }// END if ( $upload_image->processed )
            }
                if($pic!=''){
                    $add_query = "UPDATE employees SET prefix ='$prefix',first_name='$first_name',last_name='$last_name',department_id=$department_id,job_id=$job_id,manager_id=$mng,position_level_id=$position_level_id,telephone_no='$telephone',email='$email',address='$address',company_id=1,profile_picture='$pic'  WHERE employee_id=$get_emp_id ";
                    $a_query = mysqli_query($conn, $add_query);

                    if ($a_query)
                        echo "Record update successfully";
                    else {
                        $msg = 'Error :' . mysql_error();
                        echo "Error Save [" . $add_query . "]";
                    }

                    header("Location: edit_profile.php?emp_id=".$get_emp_id);
                }else{
                    $add_query2 = "UPDATE employees SET prefix ='$prefix',first_name='$first_name',last_name='$last_name',department_id=$department_id,job_id=$job_id,manager_id=$mng,position_level_id=$position_level_id,telephone_no='$telephone',email='$email',address='$address',company_id=1  WHERE employee_id=$get_emp_id ";
                    $a_query2 = mysqli_query($conn, $add_query2);

                    if ($a_query2)
                        echo "Record update successfully";
                    else {
                        $msg = 'Error :' . mysql_error();
                        echo "Error Save [" . $add_query2 . "]";
                    }

                    header("Location: edit_profile.php?emp_id=".$get_emp_id);
                }
}
?>