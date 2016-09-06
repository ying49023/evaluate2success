<?php 
$value = ''; 
if(isset($_GET["check"])){
    $check = $_GET["check"];
    if($check == 'no_user'){
        $value = "ไม่มี User นี้อยู่ในระบบ" ;
    }else if($check == 'wrong_pass'){
        $value = "Password ผิดกรุณากรอกใหม่";
    }else if($check == 'limit_level'){
        $value = "ไม่สามารถเข้าถึงระดับ User ได้";
    }
}

?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>เข้าสู่ระบบ : Login</title>
        <meta charset="utf-8" >
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php include './css_packs.html'; ?>

        <style>
            .bg1{
                background-color:#367fa9;
                color: #fff;
            }
            .bg1 h1{
                padding-top: 60px;
                font-size: 5em;
                font-weight: 700;
            }
            .bg2{

            }
            hr{
                width: 50%;
            }
/*            button{
                width: 100%;
                max-width: 200px;
                height: 350px;
                text-align: center;
                padding: 10px;
            }*/
            .container >h1,h3{
                text-align: center;
            }
            .form-signin{
                max-width: 550px;
                padding: 15px;
                margin: 0 auto;
            }
        </style>
    </head>
    <body>
        <div class="wrapper">

            <div class="row bg1">
                <div class="container">
                    <h1>ATL</h1>
                    <hr>
                    <h3>Telecom Public Company Limited</h3>
                </div>
            </div>

            <div class="row ">
                <div class="container">
                    <form action="check_login.php" method="post" class="form-horizontal form-signin">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="username" class=" control-label">Username</label>

                                <div class="">
                                    <input type="text" class="form-control" name="username" placeholder="username" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class=" control-label">Password</label>

                                <div class=" ">
                                    <input type="password" class="form-control" name="password" placeholder="********" required>
                                </div>
                            </div>
                            <p style="color: red;font-weight: 600;text-align: center;"><?php echo $value; ?></p>
                        </div>
                        <!-- /.box-body -->
                        <div class=" box-footer">
                            <div class="">
                                <input type="submit" class="btn btn-info button-login pull-left " name="submit_login"  value=" เข้าสู่ระบบ ">
                            </div>
                            <div class="">
                                <button name="submit_forget" class="btn btn-default button-login pull-right" disabled>ลืมรหัสผ่าน?</button>
                            </div>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                    <div class="form-horizontal form-signin" style="color:green;width: 500px;font-weight: 800;font-style: italic">
                        <p ><u>หมายเหตุ</u>โปรดLogin โดย username : rose / password : 1234 </p>
                        <p>ขั้นตอนการ Logout</p>
                        <ol>
                            <li>คลิกมุมบนขวาที่แสดงชื่อ</li>
                            <li>เลือกปุ่ม logout</li>
                        </ol>
                    </div>
                </div>
                
            </div> 

        </div>
    </body>
</html>
