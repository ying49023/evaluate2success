<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PHPExcel</title>
	</head>
<body>
<?php

/** PHPExcel */
require_once 'Classes/PHPExcel.php';

/** PHPExcel_IOFactory - Reader */
include 'Classes/PHPExcel/IOFactory.php';


//กำหนดไฟล์ที่ต้องการดึงข้อมูล / จากโฟลเดอร์ที่เก็บหรืออัพโหลดมาเก็บไว้
$inputFileName = "node3.xlsx";  

$inputFileType = PHPExcel_IOFactory::identify($inputFileName);  
$objReader = PHPExcel_IOFactory::createReader($inputFileType);  
$objReader->setReadDataOnly(true);  
$objPHPExcel = $objReader->load($inputFileName);  


// ไม่เอา Header เริ่มอ่านข้อมูลที่แถวที่ 4

$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
$highestRow = $objWorksheet->getHighestRow();
$highestColumn = $objWorksheet->getHighestColumn();


//edit
$r = -1;
$namedDataArray = array();
for ($row = 4; $row <= $highestRow; ++$row) {
    $dataRow = $objWorksheet->rangeToArray('D'.$row.':'.$highestColumn.$row,null, true, true, true);
    if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
        ++$r;
        $namedDataArray[$r] = $dataRow[$row];
    }
}



echo '<pre>';
var_dump($namedDataArray);
echo '</pre><hr />';

//ตาราง แสดงข้อมูล ที่อ่านข้อมูลจาก Excel
//คอลัมที่ A-J ตามไฟล์ Excel
?>
<table width="100%" border="1">
    <tr>
        <td align="center">Lot</td>
        <td align="center">No</td>
        <td align="center">Name</td>
        <td align="center">Location Code</td>
        <td align="center">distance</td>
        <td align="center">Address</td>
        <td align="center">Rent 1</td>
        <td align="center">Rent 2</td>
        <td align="center">Rent 3</td>
        <td align="center">Rent 4</td>
            
    </tr>
<?php
foreach ($namedDataArray as $result) {

	/*
   Code :
	Insert to Database
	ดึงค่ามาบันทึกลงในฐานข้อมูลที่ออกแบบไว้ ตามฟิลด์ที่ต้องการเก็บข้อมูล อยู่ใน Loop Foreach

	*/
	
?>
    <tr>
        <td><?php echo $result["A"]; ?></td>
        <td><?php echo $result["B"]; ?></td>
        <td><?php echo $result["C"]; ?></td>
        <td><?php echo $result["D"]; ?></td>
        <td><?php echo $result["E"]; ?></td>		
        <td><?php echo $result["F"]; ?></td>		
        <td><?php echo $result["G"]; ?></td>	
        <td><?php echo $result["H"]; ?></td>	
        <td><?php echo $result["I"]; ?></td>	
        <td><?php echo $result["J"]; ?></td>	
    </tr>
<?php
}
?>
</table>
</body>
</html>