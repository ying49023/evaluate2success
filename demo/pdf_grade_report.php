
<?php
//require('./dist/pdf/fpdf.php');

require('./mysql_table/mysql_table.php');
define('FPDF_FONTPATH','font/');
 

 
$pdf=new FPDF();
class PDF extends PDF_MySQL_Table
{
// Page header
   
function Header()
{
    
 
        // เพิ่มฟอนต์ภาษาไทยเข้ามา ตัวธรรมดา กำหนด ชื่อ เป็น angsana
        //$this->AddFont('AngsanaNew','','angsa.php');


    // Logo
    $this->Image('./dist/pdf/logo.png',85,8,33);
    // Arial bold 15
    $this->AddFont('angsana','B','angsa.php');

    $this->SetFont('angsana','B',24);

   
    //$this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    // Title
   $this->Cell(25,70,iconv( 'UTF-8','cp874' , 'รายงานผลการประเมินผลการปฏิบัติงานทั่วทั้งองค์การ' ),0,0,'C');
   
    // Line break
    $this->Ln(50);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
//Simple table



}




?>

<?php

$db=mysql_connect('103.27.202.37','prasukrit_alt','13579alt');
$con=mysql_select_db('prasukrit_evaluate2success',$db);

mysql_query("SET NAMES UTF8 ");



// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->AddFont('angsana','','angsa.php');

//$pdf->AddFont('angsana','B','angsab.php');

//$pdf->AddFont('angsana','I','angsai.php');

//$pdf->AddFont('angsana','BI','angsaz.php');

$pdf->SetFont('angsana','',12);


/*$pdf->AddCol('employee_id',20,'','C');
$pdf->AddCol('prefix',40,'first_name');
$pdf->AddCol('last_name',40,'Pop (2001)','R');*/

/*for($i=1;$i<=40;$i++)

    $pdf->Cell(0,10,'Printing line number '.$i,1,1);*/
//Second table: specify 3 columns
$pdf->AddCol('employee_id',20,'empno','C');
$pdf->AddCol('fullname',60,'name');
$pdf->AddCol('department_name',40,'department','C');
$pdf->AddCol('job_name',30,'job','C');
$pdf->AddCol('sum_point',10,'point','R');
$pdf->AddCol('grade_description',10,'grade','R');




$prop=array('HeaderColor'=>array(255,150,100),
			'color1'=>array(210,245,255),
			'color2'=>array(255,255,210),
			'padding'=>2);



/*$pdf->Table( "SELECT v.employee_id,CONCAT(e.prefix,e.first_name,' ', e.last_name) as fullname,d.department_name,j.job_name, v.sum_point,g.grade_description
FROM grade g 
JOIN evaluation_employee v ON g.grade_id = v.grade_id 
JOIN evaluation n on v.evaluation_code = n.evaluation_code 
JOIN company c ON n.company_id = c.company_id 
JOIN employees e on c.company_id = e.company_id 
JOIN jobs j ON e.job_id = j.job_id 
JOIN departments d ON e.department_id = d.department_id
WHERE c.company_name='ALT' and v.employee_id = e.employee_id AND j.job_id = e.job_id
GROUP by v.employee_id");*/

$pdf->Table("SELECT v.employee_id,CONCAT(e.prefix,e.first_name,' ', e.last_name) as fullname,d.department_name,j.job_name, v.sum_point,g.grade_description
FROM grade g 
JOIN evaluation_employee v ON g.grade_id = v.grade_id 
JOIN evaluation n on v.evaluation_code = n.evaluation_code 
JOIN company c ON n.company_id = c.company_id 
JOIN employees e on c.company_id = e.company_id 
JOIN jobs j ON e.job_id = j.job_id 
JOIN departments d ON e.department_id = d.department_id
WHERE c.company_name='ALT' and v.employee_id = e.employee_id AND j.job_id = e.job_id
GROUP by v.employee_id",$prop);




$pdf->Output();
?>

