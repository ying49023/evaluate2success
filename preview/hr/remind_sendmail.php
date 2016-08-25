<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
$strTo = "ying49023@gmail.com";

$strSubject = "=?UTF-8?B?".base64_encode("ส่งอีเมลล์แจ้งเตื่อนการประเมิน");
$strHeader = "Content-type: text/html; charset=windows-874\r\n"; // for HTML e-mail, use text/html
$strHeader .= "From: ALT Telecom<evaluate2success@gmail.com>\r\nReply-To: evaluate2success@gmail.com";



$strVar = "ข้อความภาษาไทย";

$strMessage = "กรุณาทำการประเมินให้เรียบร้อย ภายในวันที่ 1 ก.ย. 2559";
$flgSend = @mail($strTo,$strSubject,$strMessage,$strHeader);  // @ = No Show Error //

if($flgSend)

{

echo "Email Sending.";

}

else

{

echo "Email Can Not Send.";

}

?>
    </body>
</html>
