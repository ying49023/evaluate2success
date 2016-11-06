
<?php
//require('./dist/pdf/fpdf.php');

require('./mysql_table/mysql_table.php');

define('FPDF_FONTPATH','font/');
// require('fpdf.php');
$emp_id=$_GET['emp_id'];
$eval_code=$_GET['eval_code'];
$eval_emp_id=$_GET['eval_emp_id'];
 
$pdf=new FPDF();
class PDF extends PDF_MySQL_Table
{
    // Page header

    function Header()
    {


    //         เพิ่มฟอนต์ภาษาไทยเข้ามา ตัวธรรมดา กำหนด ชื่อ เป็น angsana
    //        $this->AddFont('AngsanaNew','','angsa.php');


        // Logo
        //$this->Image('./dist/pdf/logo.png',85,8,33);
        // Arial bold 15
        $this->AddFont('angsana','B','angsa.php');

        $this->SetFont('angsana','B',24);


        //$this->SetFont('Arial','B',15);
        // Move to the right
        //$this->Cell(80);
        // Title
        //$this->Cell(25,70,iconv( 'UTF-8','cp874' , 'แบบฟอร์มประเมินผลงาน' ),0,0,'C');
        
        // Line break
       // $this->Ln(10);
        
    }

    // Page footer
    function Footer()
    {
        $this->AddFont('angsana','B','angsa.php');

        $this->SetFont('angsana','B',14);
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
    function WordWrap(&$text, $maxwidth)
{
    $text = trim($text);
    if ($text==='')
        return 0;
    $space = $this->GetStringWidth(' ');
    $lines = explode("\n", $text);
    $text = '';
    $count = 0;

    foreach ($lines as $line)
    {
        $words = preg_split('/ +/', $line);
        $width = 0;

        foreach ($words as $word)
        {
            $wordwidth = $this->GetStringWidth($word);
            if ($wordwidth > $maxwidth)
            {
                // Word is too long, we cut it
                for($i=0; $i<strlen($word); $i++)
                {
                    $wordwidth = $this->GetStringWidth(substr($word, $i, 1));
                    if($width + $wordwidth <= $maxwidth)
                    {
                        $width += $wordwidth;
                        $text .= substr($word, $i, 1);
                    }
                    else
                    {
                        $width = $wordwidth;
                        $text = rtrim($text)."\n".substr($word, $i, 1);
                        $count++;
                    }
                }
            }
            elseif($width + $wordwidth <= $maxwidth)
            {
                $width += $wordwidth + $space;
                $text .= $word.' ';
            }
            else
            {
                $width = $wordwidth + $space;
                $text = rtrim($text)."\n".$word.' ';
                $count++;
            }
        }
        $text = rtrim($text)."\n";
        $count++;
    }
    $text = rtrim($text);
    return $count;
}

}





?>

<?php

$db=mysql_connect('103.27.202.37','prasukrit_alt','13579alt');
mysql_set_charset('utf8');
$con=mysql_select_db('prasukrit_evaluate2success',$db);


//ข้อมูลพนักงาน
$sql_emp = "SELECT
                                                    GROUP_CONCAT(e.prefix,e.first_name,'  ',e.last_name) as emp_name,e.hiredate , e.*, p.*,j.*,d.*,
                                                    GROUP_CONCAT(m.prefix,m.first_name,'  ',m.last_name) as manager_name_1,
                                                    GROUP_CONCAT(m2.prefix,m2.first_name,'  ',m2.last_name) as manager_name_2,e.position_level_id
                                            FROM
                                                    employees e
                                            JOIN position_level p ON p.position_level_id = e.position_level_id
                                            JOIN departments d ON d.department_id = e.department_id
                                            JOIN jobs j ON j.job_id = e.job_id
                                            JOIN employees m ON e.manager_id = m.employee_id
                                            JOIN employees m2 ON m.manager_id = m2.employee_id
                                            WHERE
                                                    e.employee_id ='$emp_id'";
$query_emp = mysql_query($sql_emp,$db);
while ($result_emp = mysql_fetch_array($query_emp, MYSQLI_ASSOC)) {
      $employee_name=$result_emp["emp_name"]; 
      $employee_id=$result_emp["employee_id"];
      $position=$result_emp["position_description"];
      $job_name=$result_emp["job_name"];
      $dept_name=$result_emp["department_name"];
      $hiredate=$result_emp["hiredate"];
      $manager_name_1=$result_emp["manager_name_1"];
      $manager_name_2=$result_emp["manager_name_2"];
      $position_level_id=$result_emp["position_level_id"];
}
    
//mysql_query("SET NAMES UTF8 ");

// Instanciation of inherited class
// คำชี้แจงแบบประเมินผลการปฏิบัติงาน (Performance Appraisal Guideline) ระดับปฏิบัติการ
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Image('./dist/pdf/logo.png',85,8,33);
$pdf->AddFont('angsana','B','angsa.php');
$pdf->SetFont('angsana','B',20);
$pdf->AddFont('angsana','','angsa.php');
$pdf->Cell(0,70,iconv( 'UTF-8','cp874' , 'คำชี้แจงแบบประเมินผลการปฏิบัติงาน (Performance Appraisal Guideline)' ),0,0,'C');
$sql_title_exp = "SELECT * FROM explaned_evaluation WHERE explaned_id > 1 ";
$query_title_exp = mysql_query($sql_title_exp,$db);
$pdf->Ln(50);
while ($result_title_exp = mysql_fetch_array($query_title_exp, MYSQLI_ASSOC)) {
    $explaned_id = $result_title_exp["explaned_id"];
    $explaned_header = $result_title_exp["explaned_header"];    
    $pdf->SetFont('angsana','B',14);
   // $pdf->Cell(0,10,iconv( 'UTF-8','cp874' , $explaned_header ),0,0,'L');
   $pdf->MultiCell(0,7,iconv( 'UTF-8','cp874' , $explaned_header ),0,'L');
   $pdf->Ln(4);
    $sql_detail = "SELECT * FROM explaned_detail WHERE explaned_id = '$explaned_id' AND position_level_id = '$position_level_id'";
    $query_detail = mysql_query($sql_detail,$db);
    while ($result_detail = mysql_fetch_array($query_detail, MYSQLI_ASSOC)) {
       $detail= $result_detail["detail"];
       $pdf->SetFont('angsana','',12);
       //$pdf->Cell(0,90,iconv( 'UTF-8','cp874' , $detail ),0,0,'L');
     $pdf->MultiCell(0,6,iconv( 'UTF-8','cp874' , $detail ),0,'L');
     $pdf->Ln(1);
    }
}


//section1



$pdf->AddPage();
$pdf->SetFont('angsana','B',20);
$pdf->Cell(0,20,iconv( 'UTF-8','cp874' , 'แบบประเมินผลการปฏิบัติงาน (Performance Appraisal Sheet)' ),0,0,'C');
$pdf->Ln(20);
$pdf->SetFont('angsana','B',14);
$pdf->Cell(90,10,iconv( 'UTF-8','cp874' , 'ชื่อ - นามสกุลของพนักงาน :  ' ).''.iconv( 'UTF-8','cp874' , $employee_name ),1,0,'L');
$pdf->Cell(100,10,iconv( 'UTF-8','cp874' , 'ตำแหน่ง :').''.iconv( 'UTF-8','cp874' , $job_name ).''.iconv( 'UTF-8','cp874' , '  ระดับตำแหน่ง: ' ).''.iconv( 'UTF-8','cp874' , $position )   ,1,0,'L');
$pdf->Ln();
$pdf->Cell(90,10,iconv( 'UTF-8','cp874' , 'รหัส :   ' ).''.iconv( 'UTF-8','cp874' , $employee_id ),1,0,'L');
$pdf->Cell(100,10,iconv( 'UTF-8','cp874' , 'อายุงาน :  -  ' ),1,0,'L');
$pdf->Ln();
$pdf->Cell(90,10,iconv( 'UTF-8','cp874' , 'วันเริ่มงาน : ' ).''.iconv( 'UTF-8','cp874' , $hiredate ),1,0,'L');
$pdf->Cell(100,10,iconv( 'UTF-8','cp874' , 'สังกัด / ฝ่าย / สายงาน :    ' ).''.iconv( 'UTF-8','cp874' , $dept_name ),1,0,'L');

$pdf->Ln();
$pdf->Cell(90,10,iconv( 'UTF-8','cp874' , 'ชื่อ - นามสกุลของผู้ประเมินที่ 1 :  ' ).''.iconv( 'UTF-8','cp874' , $manager_name_1 ),1,0,'L');
$pdf->Cell(100,10,iconv('UTF-8','cp874' ,  'ชื่อ - นามสกุลของผู้ประเมินที่ 2 :  ' ).''.iconv( 'UTF-8','cp874' , $manager_name_2 ),1,0,'L');
$pdf->Ln();
$pdf->Cell(90,10,iconv( 'UTF-8','cp874' , 'วันที่ประเมิน : -' ),1,0,'L');
$sql_eval_period = "SELECT * FROM evaluation WHERE evaluation_code = '$eval_code' ";
                    $query_eval_period = mysql_query($sql_eval_period,$db) or die(mysqli_errno());
                    $result_eval_period = mysql_fetch_array($query_eval_period,MYSQLI_ASSOC);
                    $open_system_date=$result_eval_period["open_system_date"];
                    $close_system_date=$result_eval_period["close_system_date"];
$pdf->Cell(100,10,iconv( 'UTF-8','cp874' , 'ระยะเวลาประเมินผล ').''.iconv( 'UTF-8','cp874' , $open_system_date ).''.iconv( 'UTF-8','cp874' , ' ถึง ' ).''.iconv( 'UTF-8','cp874' , $close_system_date ),1,0,'L');
$pdf->Ln();
$pdf->Cell(0,15,iconv( 'UTF-8','cp874' , 'ส่วนที่ 1  :   การประเมินด้านผลงาน (คะแนนเต็ม 60 )' ),0,0,'L');
$pdf->Ln();
$pdf->SetFont('angsana','',14);
$pdf->Cell(0,7,iconv( 'UTF-8','cp874' , 'สำหรับการประเมินผลครั้งที่ :' ),0,0,'L');
$pdf->Ln();
$pdf->Cell(0,7,iconv( 'UTF-8','cp874' ,' ผู้บังคับบัญชาและพนักงาน : ' ),0,0,'L');
$pdf->Ln();
$pdf->Cell(0,5,iconv( 'UTF-8','cp874' , '1) กำหนดเต็มในส่วนที่ 1 (คะแนนเต็ม 60 )  ' ),0,0,'L');
$pdf->Ln();
$pdf->Cell(0,5,iconv( 'UTF-8','cp874' , '2) กำหนดวัตถุประสงค์ / เป้าหมายที่กำหนดร่วมกันระหว่างผู้ประเมิน และผู้ถูกประเมิน' ),0,0,'L');
$pdf->Ln();
$pdf->Cell(0,5,iconv( 'UTF-8','cp874' , '3) การวัดผลงานควรอยู่ระหว่าง 4-7 ข้อ เท่านั้น เพื่อให้พนักงานใช้เป็นแนวทางและเป้าหมายในการปฏิบัติงาน' ),0,0,'L');
$pdf->Ln(15);


//ตารางKPI
$pdf->SetFont('angsana','B',12);
$pdf->Cell(90, 5, iconv( 'UTF-8','cp874' ,''), 'LTR', 0, 'L', 0); 
$pdf->Cell(20, 5, '', 'LTR', 0, 'L', 0);
$pdf->Cell(30, 5, iconv( 'UTF-8','cp874' ,'ผลการปฏิบัติงาน'),'LTR', 0, 'C', 0);
$pdf->Cell(50, 5, iconv( 'UTF-8','cp874' ,'ครั้งที่ 1 ม.ค. - มิ.ย.' ),'LTBR', 0, 'C', 0);
$pdf->Ln();

$pdf->Cell(90, 5, iconv( 'UTF-8','cp874' ,'วัตถุประสงค์ / เป้าหมายที่กำหนดร่วมกันระหว่างผู้ประเมิน'), 'LR', 0, 'C', 0);   // empty cell with left,top, and right borders
$pdf->Cell(20, 5, iconv( 'UTF-8','cp874' ,'เป้าหมาย '),  'LR', 0, 'C', 0);
$pdf->Cell(30, 5,iconv( 'UTF-8','cp874' ,'ที่เกิดขึ้นจริง'),  'LR', 0, 'C', 0);
$pdf->Cell(15, 5,iconv( 'UTF-8','cp874' ,'น้ำหนัก'),  'LR', 0, 'C', 0);
$pdf->Cell(15, 5,iconv( 'UTF-8','cp874' ,'คะแนน'),  'LR', 0, 'C', 0);
$pdf->Cell(20, 5,iconv( 'UTF-8','cp874' ,'คะแนนรวม'),  'LR', 0, 'C', 0);
$pdf->Ln();

$pdf->Cell(90, 5, iconv( 'UTF-8','cp874' ,'และผู้ถูกประเมิน (Performance Objectives / KPIs)'), 'LR', 0, 'C', 0);  // cell with left and right borders
$pdf->Cell(20, 5, iconv( 'UTF-8','cp874' ,'(Goal) '), 'LR', 0, 'C', 0);
$pdf->Cell(30, 5,iconv( 'UTF-8','cp874' ,'(Actual Performance)'),  'LR', 0, 'C', 0);
$pdf->Cell(15, 5,iconv( 'UTF-8','cp874' ,'รวม'),  'LR', 0, 'C', 0);
$pdf->Cell(15, 5,iconv( 'UTF-8','cp874' ,'(ระดับ'),  'LR', 0, 'C', 0);
$pdf->Cell(20, 5,iconv( 'UTF-8','cp874' ,'(น้ำหนัก '),  'LR', 0, 'C', 0);
$pdf->Ln();

$pdf->Cell(90, 5, iconv( 'UTF-8','cp874' ,''), 'LBR', 0, 'L', 0);   // empty cell with left,bottom, and right borders
$pdf->Cell(20, 5, '', 'LRB', 0, 'L', 0);
$pdf->Cell(30, 5, iconv( 'UTF-8','cp874' ,''), 'LRB', 0, 'C', 0);
$pdf->Cell(15, 5, '', 'LRB', 0, 'L', 0);
$pdf->Cell(15, 5, iconv( 'UTF-8','cp874' ,'1-10)'), 'LRB', 0, 'C', 0);
$pdf->Cell(20, 5, iconv( 'UTF-8','cp874' ,'X คะแนน) '), 'LRB', 0, 'C', 0);


$pdf->Ln();


//เนื้อหาภายใน
$sql_kpi = "SELECT k.kpi_code as kpi_id, k.kpi_name as kpi_name, kr.percent_weight as weight, kr.goal as goal, kr.success as success, e.term_id as term, e.year as year,k.measure_symbol as symbol,kr.percent_performance,kr.kpi_responsible_id
                                                    FROM kpi k JOIN kpi_responsible kr ON k.kpi_id=kr.kpi_id 
                                                    JOIN evaluation_employee ee ON ee.evaluate_employee_id = kr.evaluate_employee_id
                                                    JOIN evaluation e ON ee.evaluation_code = e.evaluation_code 
                                                    WHERE ee.evaluation_code='$eval_code' and ee.employee_id = 10002 ORDER BY kpi_id ";
$query_kpi = mysql_query($sql_kpi,$db);
//$count_kpi = mysql_num_rows($query_kpi);

 while($result_kpi = mysql_fetch_array($query_kpi, MYSQLI_ASSOC)) {
                
                                                $kpi_id = $result_kpi["kpi_id"];
                                                $kpi_name = $result_kpi["kpi_name"];
                                                $weight = $result_kpi["weight"];
                                                $goal = $result_kpi["goal"];
                                                $symbol = $result_kpi["symbol"];
                                                $success = $result_kpi["success"];
                                                $percent_performance = $result_kpi["percent_performance"];
                                                $term = $result_kpi["term"];
                                                $year = $result_kpi["year"];
                                                $kpi_responsible_id=$result_kpi["kpi_responsible_id"];
                                                
$pdf->SetFont('angsana','B',11);                                             
$pdf->Cell(90, 10, iconv( 'UTF-8','cp874' ,$kpi_name), 'LTBR', 0, 'L', 0); 
$pdf->SetFont('angsana','B',12);
$pdf->Cell(20, 10, $symbol.''.$goal , 'LTBR', 0, 'C', 0);
$pdf->Cell(30, 10,iconv( 'UTF-8','cp874' ,$success),'LTBR', 0, 'C', 0);
$pdf->Cell(15, 10,iconv( 'UTF-8','cp874' ,$weight.'%'),  'LBR', 0, 'C', 0);
$pdf->Cell(15, 10,iconv( 'UTF-8','cp874' ,$percent_performance/10),  'LBR', 0, 'C', 0);
$pdf->Cell(20, 10,iconv( 'UTF-8','cp874' ,$weight*($percent_performance/10)),  'LBR', 0, 'C', 0);
$pdf->Ln();
 }
 
 //คะแนนรวม
 $sql_percent_weight = "SELECT SUM(percent_weight) as sum_percent_weight
                                                                    FROM kpi_responsible
                                                                    WHERE evaluate_employee_id=$eval_emp_id ";
//1
$query_percent_weight = mysql_query($sql_percent_weight,$db);
while ($result_percent_weight = mysql_fetch_array($query_percent_weight)) {
    $sum_percent_weight = $result_percent_weight ['sum_percent_weight'];
}

$pdf->SetFont('angsana','B',12);                                             
$pdf->Cell(140, 10, iconv( 'UTF-8','cp874' ,'รวม'), 'LTBR', 0, 'R', 0); 
$pdf->Cell(15, 10,iconv( 'UTF-8','cp874' ,$sum_percent_weight.'%'),  'LBR', 0, 'C', 0);
//2
 $sql_sum_kpi = "SELECT SUM(sum_point) as sum_point
                                                            FROM kpi_responsible
                                                            WHERE evaluate_employee_id= $eval_emp_id ";
$query_sum_kpi = mysql_query($sql_sum_kpi,$db);
while ($result_sum_kpi = mysql_fetch_array($query_sum_kpi)) {
    $sum_point = $result_sum_kpi['sum_point'];
}
$pdf->Cell(15, 10,iconv( 'UTF-8','cp874' ,''),  'LBR', 0, 'C', 0);
$pdf->Cell(20, 10,iconv( 'UTF-8','cp874' ,$sum_point),  'LBR', 0, 'C', 0);
$pdf->Ln();

//3
$sql_point_kpi = "select * from evaluation_employee WHERE evaluate_employee_id=$eval_emp_id ";
$query_point_kpi = mysql_query($sql_point_kpi,$db);
while ($result_point_kpi = mysql_fetch_assoc($query_point_kpi)) {
    $point_kpi = $result_point_kpi['point_kpi'];
}
$pdf->Cell(170, 10,iconv( 'UTF-8','cp874' ,''),  'LBR', 0, 'C', 0);
$pdf->Cell(20, 10,iconv( 'UTF-8','cp874' ,$point_kpi),  'LBR', 0, 'C', 0);
$pdf->Ln();


$pdf->Ln();
$pdf->Ln();
$pdf->Ln();

//ส่วนที่2
$pdf->AddPage();
$pdf->SetFont('angsana','B',20);
$pdf->Cell(0,20,iconv( 'UTF-8','cp874' , 'ส่วนที่ 2 พฤติกรรมในการทำงานของพนักงาน (Competency)' ),0,0,'C');
$pdf->Ln(15);
$pdf->SetFont('angsana','B',16);
$pdf->Cell(0,20,iconv( 'UTF-8','cp874' , 'การจัดการแบบประเมินระดับ'.''.$position ),0,0,'L');
$pdf->Ln();
$sql_title = "SELECT
                                                        t.title_id AS title_id,
                                                        t.title_name AS title_name,
                                                        SUM(m.weight*5) as sumweight
                                                FROM
                                                        competency_title t
                                                JOIN competency c ON c.title_id = t.title_id 
                                                JOIN manage_competency m ON c.competency_id = m.competency_id
                                                WHERE
                                                        m.position_level_id = $position_level_id
                                                AND m.STATUS = 1 and m.evaluation_code= $eval_code
                                                GROUP BY t.title_name";
$query_title = mysql_query($sql_title,$db);

while ($result_title = mysql_fetch_array($query_title, MYSQLI_ASSOC)) {

    $result_title_id = $result_title["title_id"];
    $result_title_name = $result_title["title_name"];
    $result_title_sum = $result_title["sumweight"];
    //title comp
    $pdf->SetFont('angsana','B',14);
    $pdf->Cell(190, 10, iconv( 'UTF-8','cp874' ,$result_title_name." | Total Weight: ".$result_title_sum." %"), 'LTBR', 0, 'L', 0); 
    $pdf->Ln();
    $pdf->Cell(10, 10, iconv( 'UTF-8','cp874' ,'ข้อที่'), 'LTR', 0, 'L', 0); 
    $pdf->Cell(100, 10, iconv( 'UTF-8','cp874' ,'หัวข้อ'), 'LTR', 0, 'L', 0); 
    $pdf->Cell(40, 10, iconv( 'UTF-8','cp874' ,'ผู้ประเมิน1'), 'LTBR', 0, 'C', 0);
    $pdf->Cell(40, 10, iconv( 'UTF-8','cp874' ,'ผู้ประเมิน2'), 'LTBR', 0, 'C', 0); 
    $pdf->Ln();
    $pdf->Cell(10, 10, iconv( 'UTF-8','cp874' ,''), 'LBR', 0, 'L', 0); 
    $pdf->Cell(100, 10, iconv( 'UTF-8','cp874' ,''), 'LBR', 0, 'L', 0); 
    $pdf->Cell(13, 10, iconv( 'UTF-8','cp874' ,'น้ำหนัก'), 'LTBR', 0, 'C', 0);
    $pdf->Cell(13, 10, iconv( 'UTF-8','cp874' ,'คะแนน'), 'LTBR', 0, 'C', 0);
    $pdf->Cell(14, 10, iconv( 'UTF-8','cp874' ,'รวม'), 'LTBR', 0, 'C', 0);
    $pdf->Cell(13, 10, iconv( 'UTF-8','cp874' ,'น้ำหนัก'), 'LTBR', 0, 'C', 0);
    $pdf->Cell(13, 10, iconv( 'UTF-8','cp874' ,'คะแนน'), 'LTBR', 0, 'C', 0);
    $pdf->Cell(14, 10, iconv( 'UTF-8','cp874' ,'รวม'), 'LTBR', 0, 'C', 0);
    $pdf->Ln();
    
    //detail
    $sql_detail_tb = "SELECT c.title_id,ct.title_name,c.competency_id,
                        competency_description,point_assessor1,point_assessor2,mc.weight,
                        round(point_assessor1*mc.weight,2) as point1,
                        round(point_assessor2*mc.weight,2) as point2
                        FROM evaluation_competency ec 
                        JOIN manage_competency mc 
                        ON ec.manage_comp_id = mc.manage_comp_id
                        JOIN competency c 
                        ON mc.competency_id = c.competency_id
                        JOIN competency_title ct
                        ON ct.title_id = c.title_id
                        WHERE evaluate_employee_id=$eval_emp_id and ct.title_id =$result_title_id and mc.evaluation_code =3
                        ORDER BY competency_id";
    $query_detail = mysql_query($sql_detail_tb,$db);
    $no=0;
    while ($result_detail = mysql_fetch_array($query_detail, MYSQLI_ASSOC))  {
        $pdf->SetFont('angsana','B',12);
        $competency_description = $result_detail["competency_description"];
        $m_weight = $result_detail["weight"];
        $point_assessor1 = $result_detail["point_assessor1"];
        $point_assessor2 = $result_detail["point_assessor2"];
        $point1 = $result_detail["point1"];
        $point2 = $result_detail["point2"];

        $no++;
        
    $pdf->Cell(10, 15, iconv( 'UTF-8','cp874' ,$no), 'LBR', 0, 'L', 0); 
    
    //$pdf->Cell(100, 10, iconv( 'UTF-8','cp874' ,$competency_description), 'LBR', 0, 'L', 0);
    $current_y = $pdf->GetY();
    $current_x = $pdf->GetX();
    $cell_width=100;
    $project_title = wordwrap($competency_description,175);
    $pdf->MultiCell($cell_width, 5,iconv( 'UTF-8','cp874' , $project_title),'T','T', false,'T');
    $pdf->SetXY($current_x + $cell_width, $current_y);
    $pdf->Cell(13, 15, iconv( 'UTF-8','cp874' ,$m_weight), 'LTBR', 0, 'C', 0);
    $pdf->Cell(13, 15, iconv( 'UTF-8','cp874' ,$point_assessor1), 'LTBR', 0, 'C', 0);
    $pdf->Cell(14, 15, iconv( 'UTF-8','cp874' ,$point1), 'LTBR', 0, 'C', 0);
    $pdf->Cell(13, 15, iconv( 'UTF-8','cp874' ,$m_weight), 'LTBR', 0, 'C', 0);
    $pdf->Cell(13, 15, iconv( 'UTF-8','cp874' ,$point_assessor2), 'LTBR', 0, 'C', 0);
    $pdf->Cell(14, 15, iconv( 'UTF-8','cp874' ,$point2), 'LTBR', 0, 'C', 0);
    $pdf->Ln();
    }
    $pdf->MultiCell(110, 5,iconv( 'UTF-8','cp874' , ''),'T','T', false,'T');
    
}

//ส่วนที่3
$pdf->AddPage();
$pdf->SetFont('angsana','B',20);
$pdf->Cell(0,20,iconv( 'UTF-8','cp874' , 'ส่วนที่ 3 การปฏิบัติตามกฎระเบียบและข้อบังคับของบริษัท' ),0,0,'C');
$pdf->Ln(20);
//ส่วนที่ 3.1 เวลาการทำงาน (Time Attendance)
$pdf->SetFont('angsana','B',16);
$pdf->Cell(0,5,iconv( 'UTF-8','cp874' , 'ส่วนที่ 3.1 เวลาการทำงาน (Time Attendance)' ),0,0,'L');

$sql_month = "SELECT start_month, end_month FROM term t JOIN evaluation e ON e.term_id = t.term_id where evaluation_code = '$eval_code'";
$query = mysql_query($sql_month,$db); //$conn มาจากไฟล์ connection_mysqli.php เป็นตัว connect DB

while ($result = mysql_fetch_array($query, MYSQLI_ASSOC)) {
    $start = $result["start_month"];
    $end = $result["end_month"];
}
$pdf->Ln(15);
$pdf->SetFont('angsana','B',16);
$pdf->Cell(0,5,iconv( 'UTF-8','cp874' , 'เวลาการทำงาน ระหว่าง '.$start.' ถึง '.$end ),0,0,'L');
$pdf->Ln(10);
//หัวตาราง
$pdf->Cell(20,10,iconv( 'UTF-8','cp874' , 'ลำดับ' ), 'LTBR', 0, 'C', 0);
$pdf->Cell(40,10,iconv( 'UTF-8','cp874' , 'ประเภทวันลา' ), 'LTBR', 0, 'C', 0);
$pdf->Cell(40,10,iconv( 'UTF-8','cp874' , 'จำนวนวันลา' ), 'LTBR', 0, 'C', 0);
$pdf->Cell(40, 10, iconv('UTF-8', 'cp874', 'คะแนนต่อครั้ง'), 'LTBR', 0, 'C', 0);
$pdf->Cell(50, 10, iconv('UTF-8', 'cp874', 'คะแนนวันลา'), 'LTBR', 0, 'C', 0);
//output
$pdf->Ln();

$sql_leave_type = "SELECT
	lt.leave_type_id AS leave_type_id,
	lt.leave_type_description AS leave_type_description,
	lt.point AS point,
	el.no_of_day AS no_of_day,
	el.point_leave AS point_leave
FROM
	leaves_type lt
LEFT JOIN evaluatation_leave el ON lt.leave_type_id = el.leave_type_id
AND el.evaluate_employee_id =$eval_emp_id";
$query_leave_type = mysql_query($sql_leave_type,$db);
$count_col=1;
while ($result_leave_type = mysql_fetch_array($query_leave_type)) {
    $leave_type_description=$result_leave_type["leave_type_description"];
    $no_of_day=$result_leave_type["no_of_day"];
    $point=$result_leave_type["point"];
    $point_leave=$result_leave_type["point_leave"];
    
    
    $pdf->Cell(20, 10, iconv('UTF-8', 'cp874', $count_col), 'LTBR', 0, 'C', 0);
    $pdf->Cell(40, 10, iconv('UTF-8', 'cp874', $leave_type_description), 'LTBR', 0, 'C', 0);
       if ($result_leave_type["no_of_day"] == '') {
        $pdf->Cell(40, 10, iconv('UTF-8', 'cp874', '0'), 'LTBR', 0, 'C', 0);
    } else {
        $pdf->Cell(40, 10, iconv('UTF-8', 'cp874', $no_of_day), 'LTBR', 0, 'C', 0);
    }
    //4
    $pdf->Cell(40, 10, iconv('UTF-8', 'cp874', $point), 'LTBR', 0, 'C', 0);
    //5
    
     if ($result_leave_type["point_leave"] == '') {
        $pdf->Cell(50, 10, iconv('UTF-8', 'cp874', '0'), 'LTBR', 0, 'C', 0);
    } else {
        $pdf->Cell(50, 10, iconv('UTF-8', 'cp874', $point_leave), 'LTBR', 0, 'C', 0);
    }

   
    $pdf->Ln();
    $count_col++;
}
//ท้ายตาราง ส่วนสรุปคะแนนลา
$pdf->Cell(60,10,iconv( 'UTF-8','cp874' , 'คะแนนรวม' ), 'LTBR', 0, 'C', 0);
$sql_levae_sum = "SELECT
                                                            SUM(no_of_day) AS sum_day_leave,
                                                            SUM(no_of_hour) AS sum_hour_leave,
                                                            SUM(point_leave) AS sum_point_leave
                                                    FROM
                                                            evaluatation_leave
                                                    WHERE
                                                            evaluate_employee_id = $eval_emp_id";
$query_leave_sum = mysql_query($sql_levae_sum,$db);
$result_leave_sum = mysql_fetch_array($query_leave_sum);
 if($result_leave_sum == ''){ 
     $pdf->Cell(40,10,iconv( 'UTF-8','cp874' , '0' ), 'LTBR', 0, 'C', 0); 
     
 }else{
     $pdf->Cell(40,10,iconv( 'UTF-8','cp874' , $result_leave_sum["sum_day_leave"] ), 'LTBR', 0, 'C', 0);

     
 } 

$pdf->Cell(40, 10, iconv('UTF-8', 'cp874', ''), 'LTBR', 0, 'C', 0);
if($result_leave_sum == ''){ 
     $pdf->Cell(50,10,iconv( 'UTF-8','cp874' , '0' ), 'LTBR', 0, 'C', 0); 
     
 }else{
     $pdf->Cell(50,10,iconv( 'UTF-8','cp874' , $result_leave_sum["sum_point_leave"] ), 'LTBR', 0, 'C', 0);

     
 } 

$pdf->Ln(10);
//หัวตาราง
//ส่วนที่ 3.2 
$pdf->SetFont('angsana','B',16);
$pdf->Cell(0,20,iconv( 'UTF-8','cp874' , 'ส่วนที่ 3.2 การพิจารณาความดี ความชอบ และการลงโทษทางวินัย' ),0,0,'L');
$pdf->Ln(15);
$pdf->Cell(10,10,iconv( 'UTF-8','cp874' , 'ลำดับ' ), 'LTBR', 0, 'C', 0);
$pdf->Cell(150,10,iconv( 'UTF-8','cp874' , 'ประวัติการได้รับรางวัล / ยกย่อง' ), 'LTBR', 0, 'C', 0);
$pdf->Cell(30,10,iconv( 'UTF-8','cp874' , 'คะแนน' ), 'LTBR', 0, 'C', 0);
$pdf->Ln();
 $sql_reward = "SELECT *
                                                    FROM evaluatation_penalty_reward epr 
                                                    JOIN penalty_reward pr ON epr.penalty_reward_id=pr.penalty_reward_id
                                                    WHERE evaluate_employee_id=$eval_emp_id AND pr.penalty_reward_indicated=1";
$query_reward = mysql_query($sql_reward,$db);
$count_reward = mysql_num_rows($query_reward);
if ($count_reward == 0) {
$pdf->Cell(190,10,iconv( 'UTF-8','cp874' , 'ไม่มีข้อมูลรางวัล' ), 'LTBR', 0, 'C', 0);                                                 
 $pdf->Ln();  
} else {
    $i = 0;
    while ($reault_reward = mysql_fetch_array($query_reward, MYSQLI_ASSOC)) {
        $i++;
        $pdf->Cell(10,10,iconv( 'UTF-8','cp874' , $i ), 'LTBR', 0, 'C', 0);
        $pdf->Cell(150,10,iconv( 'UTF-8','cp874' , $reault_reward["penalty_reward_name"] ), 'LTBR', 0, 'L', 0);
        $pdf->Cell(30,10,iconv( 'UTF-8','cp874' , $reault_reward["point"] ), 'LTBR', 0, 'C', 0);     
        $pdf->Ln();                                                   
        
    }
}
$pdf->Cell(160,10,iconv( 'UTF-8','cp874' , 'รวม' ), 'LTBR', 0, 'C', 0);
$sql_sum_reward = "SELECT sum(pr.point) as sum_reward_point   
                                                    FROM evaluatation_penalty_reward epr 
                                                    JOIN penalty_reward pr ON epr.penalty_reward_id=pr.penalty_reward_id
                                                    WHERE epr.evaluate_employee_id= $eval_emp_id AND pr.penalty_reward_indicated=1";
$query_sum_reward = mysql_query($sql_sum_reward,$db);
$result_sum_reward = mysql_fetch_array($query_sum_reward, MYSQLI_ASSOC);
$pdf->Cell(30,10,iconv( 'UTF-8','cp874' , $result_sum_reward["sum_reward_point"] ), 'LTBR', 0, 'C', 0);  

//โทษททางวินัย
$pdf->Ln(15);
$pdf->Cell(10,10,iconv( 'UTF-8','cp874' , 'ลำดับ' ), 'LTBR', 0, 'C', 0);
$pdf->Cell(150,10,iconv( 'UTF-8','cp874' , 'ประวัติการลงโทษทางวินัย' ), 'LTBR', 0, 'C', 0);
$pdf->Cell(30,10,iconv( 'UTF-8','cp874' , 'คะแนน' ), 'LTBR', 0, 'C', 0);
$pdf->Ln();
 $sql_penalty = "SELECT *
                                                    FROM evaluatation_penalty_reward epr 
                                                    JOIN penalty_reward pr ON epr.penalty_reward_id=pr.penalty_reward_id
                                                    WHERE evaluate_employee_id=$eval_emp_id AND pr.penalty_reward_indicated=0 ";
$query_penalty = mysql_query($sql_penalty,$db);
$count_penalty = mysql_num_rows($query_penalty);
if ($count_penalty  == 0) {
$pdf->Cell(190,10,iconv( 'UTF-8','cp874' , 'ไม่มีข้อมูลรางวัล' ), 'LTBR', 0, 'C', 0);                                                 
 $pdf->Ln();  
} else {
    $i = 0;
    while ($result_penalty = mysql_fetch_array($query_penalty, MYSQLI_ASSOC)) {
        $i++;
        $pdf->Cell(10,10,iconv( 'UTF-8','cp874' , $i ), 'LTBR', 0, 'C', 0);
        $pdf->Cell(150,10,iconv( 'UTF-8','cp874' , $result_penalty["penalty_reward_name"] ), 'LTBR', 0, 'L', 0);
        $pdf->Cell(30,10,iconv( 'UTF-8','cp874' , $result_penalty["point"] ), 'LTBR', 0, 'C', 0);     
        $pdf->Ln();                                                   
        
    }
}
$pdf->Cell(160,10,iconv( 'UTF-8','cp874' , 'รวม' ), 'LTBR', 0, 'C', 0);
$sql_sum_penalty = "SELECT sum(pr.point) as sum_penalty_point   
                                                    FROM evaluatation_penalty_reward epr 
                                                    JOIN penalty_reward pr ON epr.penalty_reward_id=pr.penalty_reward_id
                                                    WHERE epr.evaluate_employee_id=$eval_emp_id AND pr.penalty_reward_indicated=0";
$query_sum_penalty = mysql_query($sql_sum_penalty,$db);
$result_sum_penalty = mysql_fetch_array($query_sum_penalty, MYSQLI_ASSOC);
$pdf->Cell(30,10,iconv( 'UTF-8','cp874' , $result_sum_penalty["sum_penalty_point"] ), 'LTBR', 0, 'C', 0);  
 
 
 //ส่วนสรุปรางวัลโทษ
$pdf->Ln(25);
$pdf->Cell(50,10,iconv( 'UTF-8','cp874' , 'คะแนนเต็ม(10 คะแนน)' ), 'LTBR', 0, 'C', 0);
$pdf->Cell(50,10,iconv( 'UTF-8','cp874' , 'คะแนนเวลาการทำงาน' ), 'LTBR', 0, 'C', 0);
$pdf->Cell(50,10,iconv( 'UTF-8','cp874' , 'คะแนนการลงโทษทางวินัย' ), 'LTBR', 0, 'C', 0);
$pdf->Cell(40,10,iconv( 'UTF-8','cp874' , 'คะแนนรวม' ), 'LTBR', 0, 'C', 0);

$pdf->Ln();
 
 $pdf->Cell(40,10,iconv( 'UTF-8','cp874' , '10' ), 'LTBR', 0, 'C', 0);
  $pdf->Cell(10,10,iconv( 'UTF-8','cp874' , '-' ), 'LTBR', 0, 'C', 0);
 if($result_leave_sum["sum_point_leave"] == ''){
     
     $pdf->Cell(40,10,iconv( 'UTF-8','cp874' , '0' ), 'LTBR', 0, 'C', 0); 
     
 } else{
     $pdf->Cell(40,10,iconv( 'UTF-8','cp874' , $result_leave_sum["sum_point_leave"] ), 'LTBR', 0, 'C', 0);
     
     
 }
$pdf->Cell(10,10,iconv( 'UTF-8','cp874' , '-' ), 'LTBR', 0, 'C', 0);
if($result_sum_penalty["sum_penalty_point"] == ''){
    $pdf->Cell(40,10,iconv( 'UTF-8','cp874' , '0' ), 'LTBR', 0, 'C', 0);
    
}else{
    $pdf->Cell(40,10,iconv( 'UTF-8','cp874' , $result_sum_penalty["sum_penalty_point"] ), 'LTBR', 0, 'C', 0);
    
}

$pdf->Cell(10,10,iconv( 'UTF-8','cp874' , '=' ), 'LTBR', 0, 'C', 0);

$pdf->Cell(40,10,iconv( 'UTF-8','cp874' , 10-($result_sum_penalty["sum_penalty_point"]+$result_leave_sum["sum_point_leave"]) ), 'LTBR', 0, 'C', 0);
 
 //คอมเม้น
$pdf->Ln(30);
$pdf->Cell(50,10,iconv( 'UTF-8','cp874' , 'ความคิดเห็นของผู้บังคับบัญชาตามสายงาน (ตามข้อเท็จจริง ตามข้อ 3.1, 3.2)' ), 0, 0, 'L', 0);
$pdf->Ln();
$sql_comment="select *
                from evaluation_comment
                where evaluate_employee_id = $eval_emp_id"; 
$query_comment = mysql_query($sql_comment,$db);
$result_comment = mysql_fetch_array($query_comment);
if($result_comment['comment1'] !=''){
$pdf->MultiCell(0,10,iconv( 'UTF-8','cp874' , '     '.$result_comment['comment1'] ), 1, 'L');
}else{
    $pdf->Cell(0,10,iconv( 'UTF-8','cp874' , 'ไม่มีความเห็น'), 1, 'C');
}
 

//ส่วนที่4
$pdf->AddPage();
$pdf->SetFont('angsana','B',20);
$pdf->Cell(0,20,iconv( 'UTF-8','cp874' , 'ส่วนที่ 4: ความคิดเห็นเพิ่มเติมและการประเมินผลโดยรวม (Overall Rating)' ),0,0,'C');
$pdf->Ln(20);
$pdf->SetFont('angsana','B',16);
$pdf->Cell(0,20,iconv( 'UTF-8','cp874' , 'สรุปคะแนนที่ได้รับจากแต่ละส่วนเพื่อประเมินผลโดยรวม' ),0,0,'L');
$pdf->Ln(15);
$pdf->SetFont('angsana','B',14);
$pdf->Cell(100, 10, iconv('UTF-8', 'cp874', 'หัวข้อประเมิน'), 'LTR', 0, 'C', 0);
$pdf->Cell(45, 10, iconv('UTF-8', 'cp874', 'ผู้ประเมิน1'), 'LTBR', 0, 'C', 0);
$pdf->Cell(45, 10, iconv('UTF-8', 'cp874', 'ผู้ประเมิน2'), 'LTBR', 0, 'C', 0);
$pdf->Ln();
$pdf->Cell(100, 10, iconv('UTF-8', 'cp874', ''), 'LBR', 0, 'L', 0);
$pdf->Cell(20, 10, iconv('UTF-8', 'cp874', 'คะแนนเต็ม'), 'LTBR', 0, 'C', 0);
$pdf->Cell(25, 10, iconv('UTF-8', 'cp874', 'คะแนนที่ได้รับ'), 'LTBR', 0, 'C', 0);

$pdf->Cell(20, 10, iconv('UTF-8', 'cp874', 'คะแนนเต็ม'), 'LTBR', 0, 'C', 0);
$pdf->Cell(25, 10, iconv('UTF-8', 'cp874', 'คะแนนที่ได้รับ'), 'LTBR', 0, 'C', 0);

$pdf->Ln();

//query score
$sql_score = "SELECT
                                                                *,ee.grade_id as grade_id3
                                                        FROM
                                                                employees emp
                                                        JOIN evaluation_employee ee ON emp.employee_id = ee.employee_id
                                                        JOIN evaluation e ON e.evaluation_code = ee.evaluation_code
                                                        WHERE
                                                               ee.evaluation_code= $eval_code and ee.employee_id = $emp_id";
$query_score = mysql_query($sql_score,$db);
$sql_pos = "select * from employees where employee_id=$emp_id";
$query_pos = mysql_query($sql_pos,$db);
$get_pos = mysql_fetch_array($query_pos);
$get_pos_id = $get_pos["position_level_id"];
while ($result_score = mysql_fetch_array($query_score)) {
    $grade_id3 = $result_score["grade_id3"];
    $score_1 = round($result_score["point_kpi"], 1);
    $score_2_1_m_1 = round($result_score["point_com1_part1"], 1);
    $score_2_2_m_1 = round($result_score["point_com1_part2"], 1);
    $score_2_1_m_2 = round($result_score["point_com2_part1"], 1);
    $score_2_2_m_2 = round($result_score["point_com2_part2"], 1);
    $score_3 = round(10 - ($result_score["point_leave"] + $result_score["point_penalty"]), 1);
    if ($get_pos_id != 3) {
        $sum_score_m_1 = round(($score_1 + $score_2_1_m_1 + $score_2_2_m_1) + $score_3, 1);
        $sum_score_m_2 = round(($score_1 + $score_2_1_m_2 + $score_2_2_m_2) + $score_3, 1);
    } else {
        $sum_score_m_1 = round(($score_1 + $score_2_1_m_1 + $score_2_2_m_1), 1);
        $sum_score_m_2 = round(($score_1 + $score_2_1_m_2 + $score_2_2_m_2), 1);
    }
}
//คะแนนรวมส่วนที่ 1: 

$pdf->Cell(100, 10, iconv('UTF-8', 'cp874', 'คะแนนรวมส่วนที่ 1: การประเมินด้านผลงาน (กำหนดคะแนนเต็ม 60)'), 'LBR', 0, 'L', 0);
$pdf->Cell(20, 10, iconv('UTF-8', 'cp874', '60'), 'LTBR', 0, 'C', 0);
$pdf->Cell(25, 10, iconv('UTF-8', 'cp874', $score_1), 'LTBR', 0, 'C', 0);

$pdf->Cell(20, 10, iconv('UTF-8', 'cp874', '60'), 'LTBR', 0, 'C', 0);
$pdf->Cell(25, 10, iconv('UTF-8', 'cp874', $score_1), 'LTBR', 0, 'C', 0);

$pdf->Ln();
//คะแนนรวมส่วนที่ 2: 

$pdf->Cell(190, 10, iconv('UTF-8', 'cp874', 'คะแนนรวมส่วนที่ 2 : พฤติกรรมการทำงาน'), 'LBR', 0, 'L', 0);;

$pdf->Ln();
//คะแนนรวมส่วนที่ 2.1: 

$pdf->Cell(100, 10, iconv('UTF-8', 'cp874', '   ส่วนที่ 2.1 พฤติกรรมหลักร่วมกันทั้งองค์กร (Corporate Competency)'), 'LBR', 0, 'L', 0);
$pdf->Cell(20, 10, iconv('UTF-8', 'cp874', '20'), 'LTBR', 0, 'C', 0);
$pdf->Cell(25, 10, iconv('UTF-8', 'cp874', $score_2_1_m_1), 'LTBR', 0, 'C', 0);

$pdf->Cell(20, 10, iconv('UTF-8', 'cp874', '20'), 'LTBR', 0, 'C', 0);
$pdf->Cell(25, 10, iconv('UTF-8', 'cp874', $score_2_1_m_2), 'LTBR', 0, 'C', 0);

$pdf->Ln();
//คะแนนรวมส่วนที่ 2.2: 

$pdf->Cell(100, 10, iconv('UTF-8', 'cp874', '   ส่วนที่ 2.2 ในส่วนพฤติกรรมทั่วไป (General Competency)'), 'LBR', 0, 'L', 0);
if($get_pos_id==3){ $pdf->Cell(20, 10, iconv('UTF-8', 'cp874', '20'), 'LTBR', 0, 'C', 0);}else{    $pdf->Cell(20, 10, iconv('UTF-8', 'cp874', '10'), 'LTBR', 0, 'C', 0);}

$pdf->Cell(25, 10, iconv('UTF-8', 'cp874', $score_2_2_m_1), 'LTBR', 0, 'C', 0);

if($get_pos_id==3){ $pdf->Cell(20, 10, iconv('UTF-8', 'cp874', '20'), 'LTBR', 0, 'C', 0);}else{    $pdf->Cell(20, 10, iconv('UTF-8', 'cp874', '10'), 'LTBR', 0, 'C', 0);}
$pdf->Cell(25, 10, iconv('UTF-8', 'cp874', $score_2_2_m_2), 'LTBR', 0, 'C', 0);

$pdf->Ln();
//คะแนนรวมส่วนที่ 3: 

$pdf->Cell(100, 10, iconv('UTF-8','cp874', 'ส่วนที่ 3: การปฏิบัติตามกฎระเบียบและข้อบังคับของบริษัท '), 'LBR', 0, 'L', 0);
if($get_pos_id==3){ $pdf->Cell(20, 10, iconv('UTF-8', 'cp874', '10'), 'LTBR', 0, 'C', 0);}else{    $pdf->Cell(20, 10, iconv('UTF-8', 'cp874', '10'), 'LTBR', 0, 'C', 0);}

$pdf->Cell(25, 10, iconv('UTF-8', 'cp874', $score_3), 'LTBR', 0, 'C', 0);

if($get_pos_id==3){ $pdf->Cell(20, 10, iconv('UTF-8', 'cp874', '10'), 'LTBR', 0, 'C', 0);}else{    $pdf->Cell(20, 10, iconv('UTF-8', 'cp874', '10'), 'LTBR', 0, 'C', 0);}
$pdf->Cell(25, 10, iconv('UTF-8', 'cp874', $score_3), 'LTBR', 0, 'C', 0);

$pdf->Ln();

//คะแนนสุทธิ

$pdf->Cell(100, 10, iconv('UTF-8','cp874', 'คะแนนสุทธิ (ส่วนที่ 1 + ส่วนที่ 2 + ส่วนที่ 3 )'), 'LBR', 0, 'L', 0);
$pdf->Cell(20, 10, iconv('UTF-8', 'cp874', ''), 'LTBR', 0, 'C', 0);
$pdf->Cell(25, 10, iconv('UTF-8', 'cp874', $sum_score_m_1), 'LTBR', 0, 'C', 0);
$pdf->Cell(20, 10, iconv('UTF-8', 'cp874', ''), 'LTBR', 0, 'C', 0);
$pdf->Cell(25, 10, iconv('UTF-8', 'cp874', $sum_score_m_2), 'LTBR', 0, 'C', 0);
$pdf->Ln();
//คะแนนเทอม
$sql_score_term_1 = "SELECT
                                                            *
                                                    FROM
                                                            employees emp
                                                    JOIN evaluation_employee ee ON emp.employee_id = ee.employee_id
                                                    JOIN evaluation e ON e.evaluation_code = ee.evaluation_code
                                                    WHERE
                                                           emp.employee_id = $emp_id AND ee.evaluation_code=$eval_code";
$query_score_term_1 = mysql_query($sql_score_term_1,$db);
$result_score_term_1 = mysql_fetch_array($query_score_term_1);

$score_1_term_1 = $result_score_term_1["point_kpi"];
if ($score_1_term_1 == 0) {
    $score_1_term_1 = '-';
}
$score_2_1_term_1 = ($result_score_term_1["point_com1_part1"] + $result_score_term_1["point_com2_part1"]) / 2;
if ($score_2_1_term_1 == 0) {
    $score_2_1_term_1 = '-';
}
$score_2_2_term_1 = ($result_score_term_1["point_com1_part2"] + $result_score_term_1["point_com2_part2"] ) / 2;
if ($score_2_2_term_1 == 0) {
    $score_2_2_term_1 = '-';
}
$score_3_term_1 = $result_score_term_1["point_leave"] + $result_score_term_1["point_penalty"];
if ($score_3_term_1 == 0) {
    $score_3_term_1 = '-';
}
$sum_score_term_1 = ($score_1_term_1 + $score_2_1_term_1 + $score_2_2_term_1) - $score_3_term_1;
if ($sum_score_term_1 == 0) {
    $sum_score_term_1 = '-';
}

//
$pdf->Cell(190, 10, iconv('UTF-8','cp874', 'ข้อมูลสรุปจะแสดงหลังจากประเมิน'), 'LBR', 0, 'C', 0);

$pdf->Ln();

$pdf->Cell(100, 10, iconv('UTF-8','cp874', '(คะแนนสุทธิผู้ประเมินที่ 1 + คะแนนสุทธิผู้ประเมินที่ 2) หาร 2'), 'LBR', 0, 'R', 0);
$pdf->Cell(90, 10, iconv('UTF-8','cp874', ($sum_score_m_1+$sum_score_m_2)/2), 'LBR', 0, 'C', 0);

$pdf->Ln();
$pdf->Cell(100, 10, iconv('UTF-8','cp874', 'สรุปคะแนนพิจารณาบทลงโทษทางวินัย'), 'LBR', 0, 'R', 0);
$pdf->Cell(90, 10, iconv('UTF-8','cp874', ''), 'LBR', 0, 'C', 0);
$pdf->Ln();
$pdf->Cell(100, 10, iconv('UTF-8','cp874', 'สรุปคะแนนประเมินผลงานโดยรวม (Overall rating)'), 'LBR', 0, 'R', 0);
$pdf->Cell(90, 10, iconv('UTF-8','cp874', ($sum_score_m_1+$sum_score_m_2)/2), 'LBR', 0, 'C', 0);

$pdf->Ln();
$sql_grade = " select * from grade where grade_id=$grade_id3";
$query_grade = mysql_query($sql_grade,$db);
while ($result_grade = mysql_fetch_array($query_grade, MYSQLI_ASSOC)) {
    $name_grade = $result_grade['grade_description'];
}
$pdf->Cell(100, 10, iconv('UTF-8','cp874', 'ผลประเมิน'), 'LBR', 0, 'R', 0);
$pdf->Cell(90, 10, iconv('UTF-8','cp874', $name_grade), 'LBR', 0, 'C', 0);

//developement
$sql_dev = "select *
            from evaluation_development e
            join development_group d
            on e.development_group_id = d.development_group_id
            where e.evaluate_employee_id = $eval_emp_id  and prominent_development=1";
$query_dev = mysql_query($sql_dev,$db);
$pdf->Ln(10);
$pdf->SetFont('angsana','B',16);
$pdf->Cell(0,20,iconv( 'UTF-8','cp874' , 'ความคิดเห็นเพิ่มเติม' ),0,0,'L');
$pdf->Ln();
$pdf->SetFont('angsana','B',14);
$pdf->Cell(190, 10, iconv('UTF-8','cp874', ' จุดเด่นของผู้ถูกประเมิน'), 'LTBR', 0, 'C', 0);
//$pdf->Cell(95, 10, iconv('UTF-8','cp874', 'สิ่งที่ควรปรับปรุง'), 'LTBR', 0, 'C', 0);
$pdf->Ln();
if(mysql_num_rows($query_dev)>0){
while($result_dev = mysql_fetch_array($query_dev) ){
    $prominent_development=$result_dev["prominent_development"];
    $development_group_name=$result_dev["development_group_name"];
    $comment=$result_dev["comment"];
    if($prominent_development==1){
        $pdf->Cell(40, 10, iconv('UTF-8','cp874', $development_group_name), 'LTBR', 0, 'L', 0);
        $pdf->Cell(150, 10, iconv('UTF-8','cp874', $comment), 'LTBR', 0, 'L', 0);
        $pdf->Ln();
    }else{
        $pdf->Cell(190, 10, iconv('UTF-8','cp874', 'ไม่มีข้อมูล'), 'LTBR', 0, 'C', 0);
    }
}
}else{
        $pdf->Cell(190, 10, iconv('UTF-8','cp874', 'ไม่มีข้อมูล'), 'LTBR', 0, 'C', 0);
    }
$pdf->Ln(20);
$sql_dev2 = "select *
            from evaluation_development e
            join development_group d
            on e.development_group_id = d.development_group_id
            where e.evaluate_employee_id = $eval_emp_id and prominent_development=0";
$query_dev2 = mysql_query($sql_dev2,$db);
$pdf->Cell(190, 10, iconv('UTF-8','cp874', 'สิ่งที่ควรปรับปรุง'), 'LTBR', 0, 'C', 0);
//$pdf->Cell(95, 10, iconv('UTF-8','cp874', 'สิ่งที่ควรปรับปรุง'), 'LTBR', 0, 'C', 0);
$pdf->Ln(10);
if(mysql_num_rows($query_dev2)>0){
 while($result_dev2 = mysql_fetch_array($query_dev2) ){
    $prominent_development2=$result_dev2["prominent_development"];
    $development_group_name2=$result_dev2["development_group_name"];
    $comment2=$result_dev2["comment"];
    if($prominent_development2==0){
        $pdf->Cell(40, 10, iconv('UTF-8','cp874', $development_group_name2), 'LTBR', 0, 'L', 0);
        $pdf->Cell(150, 10, iconv('UTF-8','cp874', $comment2), 'LTBR', 0, 'L', 0);
        $pdf->Ln();
    }else{
        $pdf->Cell(190, 10, iconv('UTF-8','cp874', 'ไม่มีข้อมูล'), 'LTBR', 0, 'C', 0);
    }
}
}else{
        $pdf->Cell(190, 10, iconv('UTF-8','cp874', 'ไม่มีข้อมูล'), 'LTBR', 0, 'C', 0);
    }
 //หน้าสุดท้าย
$pdf->AddPage();    
  //course dev  
$pdf->Ln(20);
$pdf->SetFont('angsana','B',16);
$pdf->Cell(0,20,iconv( 'UTF-8','cp874' , 'ควรได้รับการพัฒนาและฝึกอบรมในด้านใด' ),0,0,'L'); 
$pdf->Ln();
$pdf->Cell(50, 10, iconv('UTF-8','cp874', 'ประเภทคอร์ส'), 'LTBR', 0, 'C', 0);
$pdf->Cell(140, 10, iconv('UTF-8','cp874', 'ชื่อคอร์ส'), 'LTBR', 0, 'C', 0);
//$pdf->Cell(95, 10, iconv('UTF-8','cp874', 'สิ่งที่ควรปรับปรุง'), 'LTBR', 0, 'C', 0);
$pdf->Ln(10);
$sql_course ="select *
                from evaluation_course ec
                join suggest_course sc 
                on ec.course_id = sc.course_id
                join suggest_course_group sg
                on sc.course_group_id = sg.course_group_id
                where evaluate_employee_id =$eval_emp_id";
$query_course = mysql_query($sql_course, $db);
if(mysql_num_rows($query_course)>0){
 while($result_course = mysql_fetch_array($query_course) ){
    $course_group=$result_course["course_group_name"];
    $course_name=$result_course["course_name"];

        $pdf->Cell(50, 10, iconv('UTF-8','cp874', $course_group), 'LTBR', 0, 'L', 0);
        $pdf->Cell(140, 10, iconv('UTF-8','cp874', $course_name), 'LTBR', 0, 'L', 0);
        $pdf->Ln();
 

}
}else{
        $pdf->Cell(190, 10, iconv('UTF-8','cp874', 'ไม่มีข้อมูล'), 'LTBR', 0, 'C', 0);
    }

//ลงนามผู้ประเมิน
$pdf->Ln(40);
$pdf->SetFont('angsana','B',14);
$pdf->Cell(95, 10, iconv('UTF-8','cp874', 'ลงนามผู้ประเมินที่ 1'), 'LTBR', 0, 'C', 0);
$pdf->Cell(95, 10, iconv('UTF-8','cp874', 'ลงนามผู้ประเมินที่ 2'), 'LTBR', 0, 'C', 0);
$pdf->Ln();
$pdf->Cell(95, 20, iconv('UTF-8','cp874', ''), 'LR', 0, 'C', 0);
$pdf->Cell(95, 20, iconv('UTF-8','cp874', ''), 'LR', 0, 'C', 0);
$pdf->Ln();
$pdf->Cell(95, 10, iconv('UTF-8','cp874', 'ลงชื่อ......................................................................'), 'LR', 0, 'C', 0);
$pdf->Cell(95, 10, iconv('UTF-8','cp874', 'ลงชื่อ......................................................................'), 'LR', 0, 'C', 0);
$pdf->Ln();
$pdf->Cell(95, 10, iconv('UTF-8','cp874', 'ตำแหน่ง...........................................………......………..........'), 'LR', 0, 'C', 0);
$pdf->Cell(95, 10, iconv('UTF-8','cp874', 'ตำแหน่ง...........................................………......………..........'), 'LR', 0, 'C', 0);
$pdf->Ln();
$pdf->Cell(95, 10, iconv('UTF-8','cp874', 'วันที่ .......................................................................'), 'LBR', 0, 'C', 0);
$pdf->Cell(95, 10, iconv('UTF-8','cp874', 'วันที่ .......................................................................'), 'LBR', 0, 'C', 0);
$pdf->Ln();

$pdf->Cell(95, 10, iconv('UTF-8','cp874', 'ผู้บริหารลงนามอนุมัติผลการประเมิน'), 'LTBR', 0, 'C', 0);
$pdf->Cell(95, 10, iconv('UTF-8','cp874', 'พนักงานรับทราบผลการประเมิน'), 'LTBR', 0, 'C', 0);
$pdf->Ln();
$pdf->Cell(95, 10, iconv('UTF-8','cp874', 'รองกรรมการผู้จัดการ / กรรมการผู้จัดการ / กรรมการผู้อำนวยการ'), 'LR', 0, 'C', 0);
$pdf->Cell(95, 10, iconv('UTF-8','cp874', ''), 'LR', 0, 'C', 0);
$pdf->Ln();
$pdf->Cell(95, 10, iconv('UTF-8','cp874', ''), 'LR', 0, 'C', 0);
$pdf->Cell(95, 10, iconv('UTF-8','cp874', ''), 'LR', 0, 'C', 0);
$pdf->Ln();
$pdf->Cell(95, 10, iconv('UTF-8','cp874', 'ลงชื่อ......................................................................'), 'LR', 0, 'C', 0);
$pdf->Cell(95, 10, iconv('UTF-8','cp874', 'ลงชื่อ......................................................................'), 'LR', 0, 'C', 0);
$pdf->Ln();
$pdf->Cell(95, 10, iconv('UTF-8','cp874', 'ตำแหน่ง...........................................………......………..........'), 'LR', 0, 'C', 0);
$pdf->Cell(95, 10, iconv('UTF-8','cp874', 'ตำแหน่ง...........................................………......………..........'), 'LR', 0, 'C', 0);
$pdf->Ln();
$pdf->Cell(95, 10, iconv('UTF-8','cp874', 'วันที่ .......................................................................'), 'LBR', 0, 'C', 0);
$pdf->Cell(95, 10, iconv('UTF-8','cp874', 'วันที่ .......................................................................'), 'LBR', 0, 'C', 0);
$pdf->Ln();

$pdf->Output();
?>

