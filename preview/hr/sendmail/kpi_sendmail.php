<?php

	/***
	Server SMTP/POP : mail.thaicreate.com
	Email Account : webmaster@thaicreate.com
	Password : 123456
	*/
	require('class.phpmailer.php');
         if(isset($_POST['kpi_sendmail'])){
            $id=$_POST['emp_id'];
            $name=$_POST['emp_name'];
            $kpi_code=$_POST['kpi_code'];
            $kpi_name=$_POST['kpi_name'];
            $date=$_POST['date'];
            $kpi_goal=$_POST['kpi_goal'];
            $old_success=$_POST['old_success'];
            $new_success=$_POST['new_success'];
            $desc=$_POST['desc'];
            $reason=$_POST['reason'];
        
	$mail = new PHPMailer();
	$mail->IsHTML(true);
	$mail->IsSMTP();
        $mail->CharSet = "utf-8";
        $mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
        $mail->SMTPSecure = "ssl"; // sets the prefix to the servier
	$mail->SMTPAuth = true; // enable SMTP authentication		
	$mail->Port = 465; // set the SMTP port for the GMAIL server
	$mail->Username = "evaluate2success@gmail.com"; // GMAIL username
	$mail->Password = "altadmin"; // GMAIL password
	$mail->From = "evaluate2success@gmail.com"; // "name@yourdomain.com";
	//$mail->AddReplyTo = "support@thaicreate.com"; // Reply
	$mail->FromName = "webmaster@alt.com";  // set from Name
	$mail->Subject ="อีเมลล์คำรองขอการเปลี่ยนแปลงค่าKPI - [".$name."]  - ALT";  
	$mail->Body = "<h3>อีเมลล์คำรองขอการเปลี่ยนแปลงค่าKPI - [".$name."]  - ALT</h3>
                <table width='285' border='1'>
                    <tr>
                        <th bgcolor='#FF5733'>รหัสพนักงาน</th>
                        <td bgcolor='#ffffcc'>$id</td>
                    </tr>
                    <tr>
                        <th bgcolor='#FF5733'>ชื่อ - สกุล</th>
                        <td bgcolor='#ffffcc'>$name</td>
                    </tr>
                    <tr>
                        <th bgcolor='#FF5733'>KPI CODE</th>
                        <td bgcolor='#ffffcc'>$kpi_code</td>
                    </tr>
                     <tr>
                        <th bgcolor='#FF5733'>ชื่อตัวชี้วัด</th>
                        <td bgcolor='#ffffcc'>$kpi_name</td>
                    </tr>
                    <tr>
                        <th bgcolor='#FF5733'>อัพเดทเมื่อ</th>
                        <td bgcolor='#ffffcc'>$date</td>
                    </tr>
                    <tr>
                        <th bgcolor='#FF5733'>เป้าหมาย</th>
                        <td bgcolor='#ffffcc'>$kpi_goal</td>
                    </tr>
                    <tr>
                        <th bgcolor='#FF5733'>ค่าจริงเดิม</th>
                        <td bgcolor='#ffffcc'>$old_success</td>
                    </tr>
                    <tr>
                        <th bgcolor='#FF5733'>ค่าจริงใหม่ที่ต้องการเปลี่ยนแปลง</th>
                        <td bgcolor='#ffffcc'>$new_success</td>
                    </tr>
                    <tr>
                        <th bgcolor='#FF5733'>คำอธิบาย</th>
                        <td bgcolor='#ffffcc'>$desc</td>
                    </tr>
                    <tr>
                        <th bgcolor='#FF5733'>เหตุผลขอการเปลี่ยนแปลง</th>
                        <td bgcolor='#ffffcc'>$reason</td>
                    </tr>                    
                    </table>";
        
        $mail->SMTPDebug = 1;

	$mail->AddAddress("ying49023@gmail.com", "Mr.Saranya Sitthimunkhong"); // to Address

	$mail->Send(); 
        if($mail->Send()){
            echo 'Email Sending.';
        }else{
            echo 'Email Can Not Send.';
        }
        
        
        }
?>
