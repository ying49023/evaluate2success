
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
                $this->Cell($w[0],10,iconv( 'UTF-8','cp874' , $no),1,0,'L');
                $this->Cell($w[1],10,iconv( 'UTF-8','cp874' , $row[0]),1,0,'C');
                $this->Cell($w[2],10,iconv( 'UTF-8','cp874' , $row[1]),1,0,'L');
                $this->Cell($w[3],10,iconv( 'UTF-8','cp874' , $row[2]),1,0,'L');
                $this->Cell($w[4],10,iconv( 'UTF-8','cp874' , $row[3]),1,0,'L');
                $this->Cell($w[5],10,iconv( 'UTF-8','cp874' , $row[4]),1,0,'C');
                $this->Cell($w[6],10,iconv( 'UTF-8','cp874' , $row[5]),1,0,'C');
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


$pdf->SetFont('angsana','',12);




$prop=array('HeaderColor'=>array(255,150,100),
			'color1'=>array(210,245,255),
			'color2'=>array(255,255,210),
			'padding'=>2);







$sql_dept="SELECT

                        department_name,d.department_id

                FROM
                        grade g
                JOIN evaluation_employee ee ON g.grade_id = ee.grade_id
                JOIN employees e ON ee.employee_id = e.employee_id
                JOIN departments d ON e.department_id = d.department_id
                JOIN jobs j ON e.job_id = j.job_id
                WHERE
                        e.company_id = 1
                GROUP BY d.department_name
                ORDER BY
                        d.department_name
                ";
$query_dept=mysql_query($sql_dept,$db);

while($result_dept = mysql_fetch_array($query_dept)){
    $dept_name = $result_dept['department_name'];
    $dept_id = $result_dept['department_id'];
    $dept_count=0;
    $sql_grade_dept = "SELECT e.employee_id,CONCAT(e.prefix,e.first_name,' ', e.last_name) as fullname, department_name , job_name, grade_description,sum_overall_point,d.department_id 
                                            FROM grade g JOIN evaluation_employee ee ON g.grade_id = ee.grade_id 
                                            JOIN employees e ON ee.employee_id = e.employee_id JOIN departments d ON e.department_id = d.department_id 
                                            JOIN jobs j ON e.job_id = j.job_id
                                            WHERE e.company_id = 1 and d.department_id = $dept_id
                                            ORDER BY d.department_name";
        
        $res=mysql_query($sql_grade_dept,$db);
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
        
        $pdf->AddFont('angsana','','angsa.php');
        $pdf->SetFont('angsana','B',20);
        
        $pdf->Cell(40,0,iconv( 'UTF-8','cp874' , $dept_name ),0,0,'L');
        $pdf->Ln(5);

        $header = array(iconv( 'UTF-8','cp874' ,'ลำดับ'),iconv( 'UTF-8','cp874' ,'รหัสพนักงาน'),iconv( 'UTF-8','cp874' ,'ชื่อพนักงาน'),iconv( 'UTF-8','cp874' ,'ฝ่าย/แผนก'),iconv( 'UTF-8','cp874' ,'ตำแหน่ง'),iconv( 'UTF-8','cp874' ,'คะแนน'),iconv( 'UTF-8','cp874' ,'เกรด'));

        $pdf->TableZa($header, $data); 
        
        //สรุปเกรดแต่ละแผนก
        $pdf->Ln(20);
        $sql_conclude_grade = "
                                                    SELECT grade_description as Grade ,count(ee.grade_id) as Members
                                                    FROM grade g JOIN evaluation_employee ee ON g.grade_id = ee.grade_id
                                                    JOIN employees e ON ee.employee_id = e.employee_id 
                                                    JOIN departments d ON e.department_id = d.department_id 
                                                    JOIN jobs j ON e.job_id = j.job_id
                                                    WHERE e.company_id = 1 and e.employee_id =e.employee_id AND j.job_id = e.job_id and d.department_id =$dept_id
                                                    GROUP BY g.grade_id 
                                                    ORDER BY grade_description";
    $query_conclude_grade = mysql_query($sql_conclude_grade, $db);
    $pdf->SetFont('angsana', 'B', 12);
    $pdf->Cell(100, 10, iconv('UTF-8', 'cp874', 'เกรด'), 'LTBR', 0, 'C', 0);
    $pdf->Cell(95, 10, iconv('UTF-8', 'cp874', 'จำนวนคน'), 'LTBR', 0, 'C', 0);
    $pdf->Ln();
    while($result_dept_conculd = mysql_fetch_array($query_conclude_grade)){
        $grade = $result_dept_conculd['Grade'];
        $member = $result_dept_conculd['Members'];
    $pdf->Cell(100, 10, iconv('UTF-8', 'cp874', $grade), 'LTBR', 0, 'C', 0);
    $pdf->Cell(95, 10, iconv('UTF-8', 'cp874', $member), 'LTBR', 0, 'C', 0);
    $pdf->Ln();
    }
   
   $avg_grade_dept = "call get_avg_grade_dept($dept_id)";
    //$pdf->Table("$con_grade",$prop); 
    $query_avg_grade_dept = mysql_query($avg_grade_dept,$db);
    if (!$query_avg_grade_dept) { // add this check.
    die('Invalid query: ' . mysql_error());
}
   /*while($result_avg_grade = mysql_fetch_array($query_avg_grade)){
    $avg_grade_dept_result = $result_dept_avg['grade_description'];
    $pdf->Cell(100, 10, iconv('UTF-8', 'cp874', 'เกรดเฉลี่ยรวม'), 'LTBR', 0, 'C', 0);
    $pdf->Cell(95, 10, iconv('UTF-8', 'cp874', $avg_grade_dept_result), 'LTBR', 0, 'C', 0);
    }*/
 
        $pdf->AddPage();
        $dept_count++;
}


$pdf->Ln(5);
$pdf->Table("$con_grade",$prop); 
$query_avg_grade = mysql_query($avg_grade,$db);
 while($result_avg_grade = mysql_fetch_array($query_avg_grade)) { 
      $avggrade = $result_avg_grade['grade_description'];                                    
}
$pdf->AddFont('angsana','','angsa.php');
$pdf->SetFont('angsana','',18);

$pdf->Cell(25,10,iconv( 'UTF-8','cp874' , 'เกรดเฉลี่ยรวมทุกแผนก' ),0,0,'L');
$pdf->Cell(25,10,iconv( 'UTF-8','cp874' , $avggrade ),0,0,'R');
           
            
$pdf->Output();
?>

