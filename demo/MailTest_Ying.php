

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

        $strTo = "ying49023@gmail.com>";
        $strSubject = "Test Send Email";
        $strHeader = "From: ALT_Evaluate2Success@gmail.com";
        $strMessage = "Hello World";
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
