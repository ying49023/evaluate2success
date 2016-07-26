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
        $mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
        $mail->SMTPSecure = "ssl"; // sets the prefix to the servier
	$mail->SMTPAuth = true; // enable SMTP authentication		
	$mail->Port = 465; // set the SMTP port for the GMAIL server
	$mail->Username = "evaluate2success@gmail.com"; // GMAIL username
	$mail->Password = "altaltalt"; // GMAIL password
	$mail->From = "webmaster@alt.com"; // "name@yourdomain.com";
	//$mail->AddReplyTo = "support@thaicreate.com"; // Reply
	$mail->FromName = "webmaster@alt";  // set from Name
	$mail->Subject = "Test sending mail."; 
	$mail->Body = "My Body & <b>My Description</b>";

	$mail->AddAddress("ying49023@gmail.com", "Mr.Adisorn Boonsong"); // to Address

	$mail->Send(); 
        if($mail->Send()){
            echo 'ส่งแล้วจ้า';
        }else{
            echo 'error ja';
        }
?>
