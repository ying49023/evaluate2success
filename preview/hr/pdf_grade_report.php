
<?php
//require('./dist/pdf/fpdf.php');

require('./mysql_table/mysql_table.php');
define('FPDF_FONTPATH','font/');
// require('fpdf.php');
$sql_grade=$_POST['sql_grade'];
$con_grade=$_POST['con_grade'];
$avg_grade=$_POST['avg_grade'];
 
$pdf=new FPDF();
class PDF extends PDF_MySQL_Table
{
    // Page header

    function Header()
    {


    //         เพิ่มฟอนต์ภาษาไทยเข้ามา ตัวธรรมดา กำหนด ชื่อ เป็น angsana
    //        $this->AddFont('AngsanaNew','','angsa.php');


        // Logo
        $this->Image('./dist/pdf/logo.png',85,8,33);
        // Arial bold 15
        $this->AddFont('angsana','B','angsa.php');

        $this->SetFont('angsana','B',24);


        //$this->SetFont('Arial','B',15);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(25,70,iconv( 'UTF-8','cp874' , 'รายงานผลการประเมินผลการปฏิบัติงานทั่วทั้งองค์การบริษัท ALT' ),0,0,'C');

        // Line break
        $this->Ln(50);
    }

    // Page footer
    function Footer()
    {
        $this->AddFont('angsana','B','angsa.php');

        $this->SetFont('angsana','B',24);
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
    //    $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
    //Simple table

    function TableZa($header, $data){


        //Colors, line width and bold font
//        $this->SetFillColor(255,0,0);
//        $this->SetTextColor(255);
//        $this->SetDrawColor(128,0,0);
//        $this->SetLineWidth(.3);
        $this->SetFont('angsana','',12);

        //Header
        $w=array(10,20,40,55,50,10,10);
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C');
        $this->Ln();

        //Data
        $no=1;
        foreach($data as $row)
        {
                $this->Cell($w[0],6,iconv( 'UTF-8','cp874' , $no),1,0,'L');
                $this->Cell($w[1],6,iconv( 'UTF-8','cp874' , $row[0]),1,0,'C');
                $this->Cell($w[2],6,iconv( 'UTF-8','cp874' , $row[1]),1,0,'L');
                $this->Cell($w[3],6,iconv( 'UTF-8','cp874' , $row[2]),1,0,'L');
                $this->Cell($w[4],6,iconv( 'UTF-8','cp874' , $row[3]),1,0,'L');
                $this->Cell($w[5],6,iconv( 'UTF-8','cp874' , $row[4]),1,0,'C');
                $this->Cell($w[6],6,iconv( 'UTF-8','cp874' , $row[5]),1,0,'C');
                $this->Ln();
                $no++;
        }
        $this->Cell(array_sum($w),0,'','T');
        //$this->SetFillColor(200,220,255);
    }

}





?>

<?php

$db=mysql_connect('103.27.202.37','prasukrit_alt','13579alt');
mysql_set_charset('utf8');
$con=mysql_select_db('prasukrit_evaluate2success',$db);

//mysql_query("SET NAMES UTF8 ");



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
//$pdf->AddCol('employee_id',20,'empno','C');
//$pdf->AddCol('fullname',60,'name');
//$pdf->AddCol('department_name',40,'department','C');
//$pdf->AddCol('job_name',30,'job','C');
//$pdf->AddCol('grade_description',10,'grade','R');




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

//$pdf->Table("$sql_grade",$prop); $con_grade

$res=mysql_query($sql_grade,$db);
$data = [];
$i = 0;
while($result = mysql_fetch_array($res)){
    $row = [];
    $row[0] = $result['employee_id'];
    $row[1] = $result['fullname'];
    $row[2] = $result['department_name'];
    $row[3] = $result['job_name'];
    $row[4] = $result['sum_overall_point'];
    $row[5] = $result['grade_description'];
    $data[$i] = $row;
    $i += 1;
}
$header = array(iconv( 'UTF-8','cp874' ,'ลำดับ'),iconv( 'UTF-8','cp874' ,'รหัสพนักงาน'),iconv( 'UTF-8','cp874' ,'ชื่อพนักงาน'),iconv( 'UTF-8','cp874' ,'ฝ่าย/แผนก'),iconv( 'UTF-8','cp874' ,'ตำแหน่ง'),iconv( 'UTF-8','cp874' ,'คะแนน'),iconv( 'UTF-8','cp874' ,'เกรด'));

$pdf->TableZa($header, $data); 
$pdf->Ln(10);
$pdf->Table("$con_grade",$prop); 
$query_avg_grade = mysql_query($avg_grade,$db);
 while($result_avg_grade = mysql_fetch_array($query_avg_grade)) { 
      $avggrade = $result_avg_grade['grade_description'];                                    
}
$pdf->AddFont('angsana','B','angsa.php');
$pdf->SetFont('angsana','B',20);

$pdf->Cell(40,20,iconv( 'UTF-8','cp874' , 'เกรดเฉลี่ยรวมทุกแผนก' ),0,0,'L');
$pdf->Cell(35,20,iconv( 'UTF-8','cp874' , $avggrade ),0,0,'C');
$pdf->Output();
?>

