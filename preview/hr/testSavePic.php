<?php include('./classes/connection_mysqli.php') ?>
<?php
// Include คลาส class.upload.php เข้ามา เพื่อจัดการรูปภาพ
require_once('classes/class.upload.php') ;
 


 
 
//  ถ้าหากหน้านี้ถูกเรียก เพราะการ submit form  
//  ประโยคนี้จะเป็นจริงกรณีเดียวก็ด้วยการ submit form 
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
 
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
 
            // เก็บชื่อภาพลงฐานข้อมูล
            $insertSQL = sprintf("INSERT INTO tbl_image (image_name) VALUES ( '%s' )", $image_name );
            echo $insertSQL ;
            //mysql_select_db($dbName, $conn);
            mysqli_select_db($conn, $dbName);
            $Result1 = mysqli_query($conn,$insertSQL) or die(mysql_error());
                     
 
 
        }// END if ( $upload_image->processed )
 
    }//END if ( $upload_image->uploaded )
 
 
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Upload Image To Database</title>
</head>
 
<body>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <p>Image_name 
    <input name="image_name" type="file" id="image_name" size="40" />
  </p>
  <p>
    <input type="submit" value="Upload" />
    <input type="hidden" name="MM_insert" value="form1" />
  </p>
</form>
</body>
 
</html>