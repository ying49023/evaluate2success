<?php

	/***
	Server SMTP/POP : mail.thaicreate.com
	Email Account : webmaster@thaicreate.com
	Password : 123456
	*/
	require('class.phpmailer.php');

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
	$mail->Subject ="อีเมลล์แจ้งเตือนการประเมินบริษัท ALT";  
	$mail->Body = "กรุณาทำการประเมินให้เรียบร้อย ภายในวันที่ 1 ก.ย. 2559";
        $mail->SMTPDebug = 1;

	$mail->AddAddress("ying49023@gmail.com", "Mr.Adisorn Boonsong"); // to Address

	$mail->Send(); 
        if($mail->Send()){
            echo 'Email Sending.';
        }else{
            echo 'Email Can Not Send.';
        }
?>
