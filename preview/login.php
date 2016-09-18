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
                background-color:#0A406B;
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
                max-width: 420px;
                padding: 15px;
                margin: 0 auto;
            }
            .button-padding{
                padding: 10px 15px 10px 15px;
            }
        </style>
    </head>
    <body>
        <div class="wrapper">

            <div class="row bg1">
                <div class="container">
                    <h1>ALT</h1>
                    <hr>
                    <h3>Telecom Public Company Limited</h3>
                </div>
            </div>

            <div class="row ">
                <div class="container">
                    <form action="check_login.php" method="post" class="form-horizontal form-signin">
                        <div class="box-body">
                            <label for="username" class=" control-label">Username</label>
                            <div class="input-group">
                                    <input type="text" class="form-control" name="username" placeholder="username" required >
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            </div>
                            <label for="password" class=" control-label">Password</label>
                            <div class="input-group">
                                
                                    <input type="password" class="form-control" name="password" placeholder="********" required>
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            </div>
                            <p style="color: red;font-weight: 600;text-align: center;"><?php echo $value; ?></p>
                            <div class="">
                                <input type="submit" class="btn btn-info button-padding pull-left " style="width: 100%" name="submit_login"  value=" เข้าสู่ระบบ ">
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class=" box-footer">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <span style="color: #9E9E9Eว">เลือก : </span> 
                                    <a class=" label  label-success" href="login.php" style="color:#4CAF50;font-weight: 700;font-size: 14px; ">General User</a>
                                    <a class=" label  label-default" href="hr/login.php" style="color:#AD1457;font-weight: 700;font-size: 14px;">Admin User</a>
                                </div>
                            </div>
                            
                        </div>
                        <!-- /.box-footer -->
                    </form>
                    <div class="row">
                        <div class="col-md-offset-2 col-md-8">
                            <div class="well">
                                <div class="form-horizontal form-signin" style="color:green;width: 500px;font-weight: 800;font-style: italic">
                                    <p ><u>หมายเหตุ</u>โปรด  Login โดย username : ying / password : 4321 </p>
                                    <p>ขั้นตอนการ Logout</p>
                                    <ol>
                                        <li>คลิกมุมบนขวาที่แสดงชื่อ</li>
                                        <li>เลือกปุ่ม logout</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
                
            </div> 

        </div>
    </body>
</html>
