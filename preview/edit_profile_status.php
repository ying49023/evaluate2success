<?php
include ('./classes/connection_mysqli.php');

$status = '';
$empid = '';
$msg = '';
/* if(isset($_GET["status"])){
  $status = $_GET["status"];
  } */
if (isset($_POST["emp_id"])) {
    $get_emp_id = $_POST["emp_id"];
    require_once('hr/classes/class.upload.php') ;
}
if ($get_emp_id != '') {

    $telephone = $_POST['telephone'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $pic= $_POST['image_name'];
    //$hiredate =$_POST['startdate'];
    $mng = '';
    $sql = " SELECT e.employee_id,concat(m.first_name,' ',m.last_name) as name from employees e JOIN employees m ON m.employee_id = e.manager_id WHERE e.employee_id = '$get_emp_id' ";
    $query = mysqli_query($conn, $sql);
    foreach($query as $mresult) {
        $mng = $mresult['employee_id'];
        $name = $mresult['name'];
    }
    //$add_query="UPDATE employees(prefix,first_name,last_name,department_id,job_id,position_level_id,manager_id,telephone_no,address,email,company_id) VALUES ('$prefix','$first_name','$last_name',$department_id,$job_id,$position_level_id,$mng,'$telephone','$address','$email',1) where employee_id=$id";            
            
                if($pic!=''){
                    $add_query = "UPDATE employees SET telephone_no='$telephone',email='$email',address='$address',profile_picture='$pic'  WHERE employee_id='$get_emp_id' ";
                    $a_query = mysqli_query($conn, $add_query);

                    if ($a_query)
                        echo "Record update successfully";
                    else {
                        $msg = 'Error :' . mysql_error();
                        echo "Error Save [" . $add_query . "]";
                    }
                    
            $upload_image = new upload($_FILES['image_name']) ;
            //  ถ้าหากมีภาพถูกอัปโหลดมาจริง
            if( $upload_image->uploaded ) {
                // ย่อขนาดภาพให้เล็กลงหน่อย  โดยยึดขนาดภาพตามความกว้าง  ความสูงให้คำณวนอัตโนมัติ
                // ถ้าหากไม่ต้องการย่อขนาดภาพ ก็ลบ 3 บรรทัดด้านล่างทิ้งไปได้เลย
                $upload_image->image_resize         = true ; // อนุญาติให้ย่อภาพได้
                $upload_image->image_x              = 400 ; // กำหนดความกว้างภาพเท่ากับ 400 pixel 
                $upload_image->image_ratio_y        = true; // ให้คำณวนความสูงอัตโนมัติ
                $upload_image->process( "./upload_images" ); // เก็บภาพไว้ในโฟลเดอร์ที่ต้องการ  *** โฟลเดอร์ต้องมี permission 0777
                // ถ้าหากว่าการจัดเก็บรูปภาพไม่มีปัญหา  เก็บชื่อภาพไว้ในตัวแปร เพื่อเอาไปเก็บในฐานข้อมูลต่อไป
                if( $upload_image->processed ) {
                    $image_name =  $upload_image->file_dst_name ; // ชื่อไฟล์หลังกระบวนการเก็บ จะอยู่ที่ file_dst_name
                    $upload_image->clean(); // คืนค่าหน่วยความจำ
                    //
                    //
                    //
                      $add_query = "UPDATE employees SET telephone_no='$telephone',email='$email',address='$address',profile_picture='$image_name' WHERE employee_id='$get_emp_id' ";
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

                    header("Location: edit_profile.php?emp_id=".$get_emp_id);
                }else{
                    $add_query2 = "UPDATE employees SET telephone_no='$telephone',email='$email',address='$address' WHERE employee_id=$get_emp_id ";
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