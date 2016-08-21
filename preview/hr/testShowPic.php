<?php include('./classes/connection_mysqli.php') ?>
<?php
// Include คลาส class.upload.php เข้ามา เพื่อจัดการรูปภาพ
require_once('classes/class.upload.php') ;
 

mysqli_select_db($conn, $dbName);
$query_rs_image = "SELECT * FROM tbl_image ORDER BY image_id ASC";  
$rs_image = mysqli_query($conn,$query_rs_image) or die(mysql_error());  

$row_rs_image = mysqli_fetch_assoc($rs_image);  
$totalRows_rs_image = mysqli_num_rows($rs_image);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>upload image with php II</title>
</head>
<body>
<table>
  <?php if ($totalRows_rs_image > 0) { 
  // แสดงผลถ้ามีข้อมูลในฐานข้อมูล 
      $iLoop='';
  ?>
    <tr>
      <?php do { ?>
        <?php 
        // รูปภาพให้เอาค่าจากฐานข้อมูลมาต่อ ให้ชี้ไปยังภาพที่อัปโหลดมา
        ?>
        <td><?php echo "<img src='upload_images/{$row_rs_image['image_name']}' />";?></td>
        <?php  
        // กำหนดว่า จะให้ตาราง แสดงกี่คอลัมน์ ง่ายๆ ด้วยคำสั่งแค่ 2 บรรทัด  
        $iLoop++ ;  
 
        if ( $iLoop % 3 == 0 ) {echo "</tr><tr>" ;}  
 
		} while ($row_rs_image = mysqli_fetch_assoc($rs_image));
       ?>
    </tr>
    <?php } ?>
</table>
</body>
</html>