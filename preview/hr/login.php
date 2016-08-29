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
                padding-top: 120px;
                font-size: 5em;
                font-weight: 700;
            }
            .bg2{

            }
            hr{
                width: 50%;
            }
            button{
                width: 100%;
                max-width: 200px;
                height: 50px;
                text-align: center;
                padding: 10px;
            }
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
                                    <input type="text" class="form-control" name="username" placeholder="username">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class=" control-label">Password</label>

                                <div class=" ">
                                    <input type="password" class="form-control" name="password" placeholder="********">
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->
                        <div class=" box-footer">
                            <div class="">
                                <input class="btn btn-info pull-left " name="submit_login" type="submit" value=" เข้าสู่ระบบ ">
                            </div>
                            <div class="">
                                <button type="submit" name="submit_forget" class="btn btn-default pull-right">ลืมรหัสผ่าน?</button>
                            </div>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>
            </div> 

        </div>
    </body>
</html>
