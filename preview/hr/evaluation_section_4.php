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
                        ส่วนที่ 4: ความคิดเห็นเพิ่มเติมและการประเมินผลโดยรวม (Overall Rating)
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
                                        <th colspan="5"><h4>สรุปคะแนนที่ได้รับจากแต่ละส่วนเพื่อประเมินผลโดยรวม</h4></th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr align="center">
                                        <td rowspan=2 style="vertical-align: middle;"><b>หัวข้อประเมิน</b></td>
                                        <td colspan=2 style="background-color:#FFCCFF"><b>ผู้ประเมินที่ 1</b></td>
                                        <td colspan=2 style="background-color:#99FF99"><b>ผู้ประเมินที่ 2</b></td>
                                    </tr>
                                    <tr align="center">
                                       <td><b>คะแนนเต็ม</b></td>
                                       <td><b>คะแนนที่ได้รับ</b></td>
                                       <td><b>คะแนนเต็ม</b></td>
                                       <td><b>คะแนนที่ได้รับ</b></td>
                                    </tr>
                                    <tr>
                                        <td><b>คะแนนรวมส่วนที่ 1:</b> การประเมินด้านผลงาน (กำหนดคะแนนเต็ม 60)</td>
                                        <td align="center"><b>60</b></td>
                                        <td align="center"></td>
                                        <td align="center"><b>60</b></td>
                                        <td align="center"></td>
                                    </tr>
                                    <tr>
                                        <td><b>คะแนนรวมส่วนที่ 2 : พฤติกรรมการทำงาน</b></td>
                                        <td style="background-color:rgb(200,200,200);"></td>
                                        <td style="background-color:rgb(128,128,128);"></td>
                                        <td style="background-color:rgb(200,200,200);"></td>
                                        <td style="background-color:rgb(128,128,128);"></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ส่วนที่ 2.1 พฤติกรรมหลักร่วมกันทั้งองค์กร (Corporate Competency)</td>
                                        <td align="center"><b>20</b></td>
                                        <td align="center"></td>
                                        <td align="center"><b>20</b></td>
                                        <td align="center"></td>
                                    </tr>
                                    <tr>
                                         <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ส่วนที่ 2.2 ในส่วนพฤติกรรมทั่วไป (General Competency)</td>
                                        <td align="center"><b>20</b></td>
                                        <td align="center"></td>
                                        <td align="center"><b>20</b></td>
                                        <td align="center"></td>
                                    </tr>
                                     <tr>
                                        <td><b>ส่วนที่ 3:  การปฏิบัติตามกฎระเบียบและข้อบังคับของบริษัท (กำหนดคะแนนเต็ม 10)</td>
                                        <td style="background-color:rgb(200,200,200);"></td>
                                        <td></td>
                                        <td style="background-color:rgb(200,200,200);"></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>คะแนนสุทธิ (ส่วนที่ 1 + ส่วนที่ 2 )</td>
                                        <td colspan=2 align="center" style="color: red;"><b>0</b></td>
                                        <td colspan=2 align="center" style="color: red;"><b>0</b></td>
                                    </tr>
                                     <tr>
                                        <td align= right><b>สรุปคะแนนตลอดปี (คะแนนสุทธิผู้ประเมินที่ 1 +  คะแนนสุทธิผู้ประเมินที่ 2) หาร 2</b></td>
                                        <td colspan=4 align="center" style="background-color:#FFEFD5;"><b>0</b></td>
                                       
                                    </tr>
                                    <tr>
                                        <td align= right><b>สรุปคะแนนพิจารณาบทลงโทษทางวินัย</b></td>
                                        <td colspan=4 align="center" style="background-color:#FAF0E6;"><b></b></td>
                                       
                                    </tr>
                                    <tr>
                                        <td align= right><b>สรุปคะแนนประเมินผลงานโดยรวม (Overall rating)</b></td>
                                        <td colspan=4 align="center" style="background-color:#F0FFFF;"><b></b></td>
                                       
                                    </tr>
                                </tbody>
                            </table>

                            <br>



                                    
                            <!--Table Good Bad-->
                            <h4>ความคิดเห็นเพิ่มเติม</h4>
                            <table class="table ">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th colspan="2">จุดเด่นของผู้ถูกประเมิน</th>
                                        <th colspan="2">จุดด้อยของผู้ถูกประเมิน</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                                </tbody>
                            </table>
                            <table class="table">
                                <thead class="thead-default">
                                    <tr>
                                                
                                        <th colspan="4">ควรได้รับการพัฒนาด้านใด</th>
                                                    
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td></td>
                                        <th scope="row">5</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td></td>
                                        <th scope="row">6</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td></td>
                                        <th scope="row">7</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">4</th>
                                        <td></td>
                                        <th scope="row">8</th>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                                        
                            <!--Table Grade-->
                            <table class="table ">
                                <thead class="thead-default">
                                    <tr>
                                                
                                        <th colspan="13">การประเมินผลโดยรวม (Overall Rating) </th>
                                                    
                                    </tr>
                                </thead>
                                <tbody>
                                <form>
                                            
                                    <tr align="center">
                                                
                                        <th scope="row" rowspan="3">ผลการปฏิบัติงาน</th>  
                                        <td><input type="radio" name="A++"></td>
                                        <td><input type="radio" name="A+"></td>
                                        <td><input type="radio" name="A"></td>
                                        <td><input type="radio" name="A-"></td>
                                        <td><input type="radio" name="B++"></td>
                                        <td><input type="radio" name="B+"></td>
                                        <td><input type="radio" name="B"></td>
                                        <td><input type="radio" name="B-"></td>
                                        <td><input type="radio" name="C++"></td>
                                        <td><input type="radio" name="C+"></td>
                                        <td><input type="radio" name="C"></td>
                                        <td><input type="radio" name="C-"></td>
                                                    
                                                    
                                    </tr>
                                                
                                </form>
                                            
                                <tr align="center">
                                            
                                            
                                            <?php
                                            $sql_grade = "SELECT * FROM grade ORDER BY standard_max_point desc";
                                                
                                            $query = mysqli_query($conn, $sql_grade); //$conn มาจากไฟล์ connection_mysqli.php เป็นตัว connect DB
                                            ?>
                                            <?php
                                            while ($result = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                                                $name = $result["grade_description"];
                                                $desc = $result["grade_explaned"];
                                                $maxpoint = $result["standard_max_point"];
                                                $minpoint = $result["standard_min_point"];
                                                $id = $result["grade_id"];
                                                ?>
                                    <td><?php echo $name; ?></td>
                                            <?php } ?>
                                                
                                </tr>
                                            
                                <tr align="center">
                                            
                                            
                                            <?php
                                            $sql_grade = "SELECT * FROM grade ORDER BY standard_max_point desc";
                                                
                                            $query = mysqli_query($conn, $sql_grade); //$conn มาจากไฟล์ connection_mysqli.php เป็นตัว connect DB
                                            ?>
                                            <?php
                                            while ($result = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                                                $name = $result["grade_description"];
                                                $desc = $result["grade_explaned"];
                                                $maxpoint = $result["standard_max_point"];
                                                $minpoint = $result["standard_min_point"];
                                                $id = $result["grade_id"];
                                                ?>
                                    <td>(<?php echo $desc; ?>)</td>
                                            <?php } ?>
                                                
                                </tr>
                                            
                                            
                                <tr align="center">
                                    <th scope="row">คะแนน</th>
                                                
                                            <?php
                                            $sql_grade = "SELECT * FROM grade ORDER BY standard_max_point desc";
                                                
                                            $query = mysqli_query($conn, $sql_grade); //$conn มาจากไฟล์ connection_mysqli.php เป็นตัว connect DB
                                            ?>
                                            <?php
                                            while ($result = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                                                $name = $result["grade_description"];
                                                $desc = $result["grade_explaned"];
                                                $maxpoint = $result["standard_max_point"];
                                                $minpoint = $result["standard_min_point"];
                                                $id = $result["grade_id"];
                                                ?>
                                    <td><?php echo $minpoint; ?> - <?php echo $maxpoint; ?></td>
                                            <?php } ?>
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
