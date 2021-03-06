<?php
    session_start();
    //Check_login
    if($_SESSION["employee_id"]==''){
        echo "Please login again";
        echo "<a href='login.php'>Click Here to Login</a>";
        header("location:login.php");
    }else{
        $now = time(); // Checking the time now when home page starts.
//        echo $now." - session expire ".$_SESSION["expire"];
        if ($now > $_SESSION['expire']) {
            session_destroy();
            header("location:session_timeout.php");
            echo "Your session has expired! <a href='login.php'>Login here</a>";
        }else{
            //HTML PAGE
            ?>
<?php 
        $erp='';
        $msg='';
        
        include './classes/connection_mysqli.php';
        
      
            
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>ระบบประเมินผลปฏิบัติงาน : ALT Evaluation</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- CSS PACKS -->
        <?php include ('./css_packs.html'); ?>
        <!--ListJS-->
        <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.2.0/list.min.js"></script>

        
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <!--Header part-->
            <?php include './headerpart.php'; ?>
            <!-- Left side column. contains the logo and sidebar -->
            <?php include './sidebarpart.php'; ?>

            <!-- Content Wrapper. Contains page content แก้เนื้อหาแต่ละหน้าตรงนี้นะ -->
            <div class="content-wrapper">

                <!-- Content Header (Page header)  -->
                <section class="content-header">
                    <h1>
                        ส่วนที่ 3 :  การปฏิบัติตามกฎระเบียบและข้อบังคับของบริษัท 
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Evaluation</li>
                    </ol>
                </section>
                <!--/Page header -->

               
                <!-- Main content -->
             
                <div class="row box-padding">
                    <div class="box box-primary">
                        <div class="box-header with-border">

                            <!--Table Point-->

                            <table class="table table-hover">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th colspan="6"><h4><b>3.1 เวลาการทำงาน (Time Attendance)</b></h4></th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr align="center">
                                        <td rowspan=2 colspan=3 style="vertical-align: middle;"><b>ประเภทวันลา</b></td>
                                        <td colspan=2 align="center"><b>ระหว่างเดือน............ถึง.............</b></td>
                                        <td rowspan=2 align="center" style="vertical-align: middle;"><b>รวมคะแนนทั้งหมด</b></td>
                                    </tr>
                                    <tr align="center">
                                       <td align="center"><b>รวมจำนวนวัน</b></td>
                                       <td align="center"><b>ชั่วโมง</b></td>
                                       
                                    </tr>
                                    <tr>
                                        <th scope="row">1</th>
                                        <th scope="row" colspan=2>ลาป่วย</th>
                                        <td align="center"></td>
                                        <td align="center"></td>
                                        <td align="center"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <th scope="row" colspan=2>ลากิจ</th>
                                        <td align="center"></td>
                                        <td align="center"></td>
                                        <td align="center"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <th scope="row">มาสาย</th>
                                        <td>จำนวนครั้ง</td>
                                        <td align="center"></td>
                                        <td align="center"></td>
                                        <td align="center"></td>
                                    </tr>
                                      <tr>
                                        <th scope="row">4</th>
                                        <th scope="row" colspan=2>ลาอื่นๆ</th>
                                        <td align="center"></td>
                                        <td align="center"></td>
                                        <td align="center"></td>
                                    </tr>
                                    <tr>
                                        <td align="right" colspan=3><b>รวม</b></td>
                                        <td align="center"></td>
                                        <td align="center"></td>
                                        <td align="center"></td>
                                    </tr>

                                </tbody>
                            </table>

                            <br>
                             <table class="table table-hover">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th colspan="6"><h4><b>3.2 การพิจารณาความดี ความชอบ และการลงโทษทางวินัย</b></h4></th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan=2><b><u>ประวัติการได้รับรางวัล / ยกย่อง</u></b></td>
                                        <td colspan=2><b><u>ประวัติการลงโทษทางวินัย</u></b></td>
                                    </tr>
                                    <tr>
                                       <th scope="row">1</th>
                                       <td></td>
                                       <th scope="row">1</th>
                                       <td></td>
                                    </tr>
                                     <tr>
                                       <th scope="row">2</th>
                                       <td></td>
                                       <th scope="row">2</th>
                                       <td></td>
                                    </tr>
                                      <tr>
                                       <th scope="row">3</th>
                                       <td></td>
                                       <th scope="row">3</th>
                                       <td></td>
                                    </tr>
                                     <tr>
                                       <th scope="row">4</th>
                                       <td></td>
                                       <th scope="row">4</th>
                                       <td></td>
                                    </tr>
                                        <tr>
                                       <th scope="row">5</th>
                                       <td></td>
                                       <th scope="row">5</th>
                                       <td></td>
                                    </tr>
                                      <tr>
                                       <th scope="row">6</th>
                                       <td></td>
                                       <th scope="row">6</th>
                                       <td></td>
                                    </tr>
                                      <tr>
                                       <th scope="row">7</th>
                                       <td></td>
                                       <th scope="row">7</th>
                                       <td></td>
                                    </tr>

                                </tbody>  
                        </table>
                        <table>
                                <tbody>

                                    <tr>
                                        <td colspan= 2><b>ความคิดเห็นของผู้บังคับบัญชาตามสายงาน (ตามข้อเท็จจริง ตามข้อ 3.1, 3.2)</b></td>
                                        <td align="center" height="80" width="100" style="background-color:#E6E6FA;"><b>คะแนนที่ได้รับเท่ากับ</b></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td></td>
                                        <td height="50" width="100" style="background-color:#F5F5F5;"></td>

                                    </tr>
                                     <tr>
                                        <th scope="row">2</th>
                                        <td></td>
                                        <td align="center" height="80" width="100" style="background-color:#E6E6FA;"><b>คะแนนเต็ม (ระหว่าง 5-20)</b></td>

                                    </tr>
                                     <tr>
                                        <th scope="row">3</th>
                                        <td></td>
                                        <td height="50" width="100" style="background-color:#F5F5F5;"></td>
                                    </tr>
                                
                                
                                </tbody>
                          </table>
                                        
                        </div>           
                    </div> 
                                
                    <!-- /.content -->
                </div>
            </div>
            <!-- /.content-wrapper -->

            <!--Footer -->
            <?php include './footer.php'; ?>

            <!-- Control Sidebar -->
            <?php include './controlsidebar.php'; ?>
            
            <!-- Add the sidebar's background. This div must be placed
                 immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>
            
        <!-- ./wrapper -->
    </body>
    <!-- SCRIPT PACKS -->
    <?php include('./script_packs.html') ?>
        
</html>
            <?php
        }
    }

    
?>
