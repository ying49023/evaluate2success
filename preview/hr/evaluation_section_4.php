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
                    <!-- search -->
                    <div class="box box-success">
                        <div class="box-body">
                            <?php 
                            $eval_code = '';
                            if(isset($_GET["eval_code"])){
                                $eval_code = $_GET["eval_code"];
                            }
                            
                            $sql_year_term = "SELECT * FROM evaluation e JOIN term t ON e.term_id=t.term_id WHERE evaluation_code = '$eval_code'";
                            $query_year_term = mysqli_query($conn, $sql_year_term);
                            while($result_year_term = mysqli_fetch_array($query_year_term, MYSQLI_ASSOC)){
                                echo "<span style='font-size:18px'><b>ปีการประเมิน ".$year = $result_year_term["year"]."</b></span> | ";
                                echo "<span style='font-size:18px'>รอบการประเมินที่ ".$term = $result_year_term["term_name"]." : ".$result_year_term["start_month"]."-".$result_year_term["end_month"]."</span>";
                            }
                            ?>
                        </div>
                    </div>
                    <!--/search -->
                    <!-- Navbar process -->
                    <?php include './navbar_process.php'; ?>
                    <!-- /Navbar process -->
                    <!-- Part 4 -->
                    <div class="box box-primary">
                        <div class="box-header with-border">

                            <!--Table Point-->
                            <table class="table table-bordered table-hover ">
                                <thead>
                                    <tr class="text-center">
                                        <td rowspan=2 class="bg-inverse" style="vertical-align: middle;"><b>หัวข้อประเมิน</b></td>
                                        <td colspan=2 class="bg-orange"><b>ผู้ประเมินที่ 1</b></td>
                                        <td colspan=2 class="bg-olive"><b>ผู้ประเมินที่ 2</b></td>
                                    </tr>
                                    <tr class="text-center">
                                       <td class="bg-warning"><b>คะแนนเต็ม</b></td>
                                       <td class="bg-warning"><b>คะแนนที่ได้รับ</b></td>
                                       <td class="bg-success"><b>คะแนนเต็ม</b></td>
                                       <td class="bg-success"><b>คะแนนที่ได้รับ</b></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <tr>
                                        <td><b>คะแนนรวมส่วนที่ 1:</b> การประเมินด้านผลงาน (กำหนดคะแนนเต็ม 60)</td>
                                        <td  class="text-center"><b>60</b></td>
                                        <td    class="text-center"><input class="text-center" type="number" name="ass1part1point" min="0" max="60" value="" disabled></td>
                                        <td  class="text-center"><b>60</b></td>
                                        <td  class="text-center"><input class="text-center" type="number" name="ass2part1point" min="0" max="60" value="" disabled></td>
                                    </tr>
                                    <tr>
                                        <td><b>คะแนนรวมส่วนที่ 2 : พฤติกรรมการทำงาน</b></td>
                                        <td ></td>
                                        <td ></td>
                                        <td  ></td>
                                        <td  ></td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left: 40px;">ส่วนที่ 2.1 พฤติกรรมหลักร่วมกันทั้งองค์กร (Corporate Competency)</td>
                                        <td  class="text-center"><b>20</b></td>
                                        <td  class="text-center"><input class="text-center" type="number" name="ass1part2/1point" value="" min="0" max="20" disabled></td>
                                        <td  class="text-center"><b>20</b></td>
                                        <td  class="text-center"><input class="text-center" type="number" name="ass1part2/1point" value="" min="0" max="20" disabled></td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left: 40px;">ส่วนที่ 2.2 ในส่วนพฤติกรรมทั่วไป (General Competency)</td>
                                        <td class="text-center"><b>20</b></td>
                                        <td class="text-center"><input class="text-center" type="number" name="ass1part2/2point" value="" min="0" max="20" disabled></td>
                                        <td class="text-center"><b>20</b></td>
                                        <td class="text-center"><input class="text-center" type="number" name="ass2part2/1point" value="" min="0" max="20" disabled></td>
                                    </tr>
                                     <tr>
                                        <td ><b>ส่วนที่ 3:  การปฏิบัติตามกฎระเบียบและข้อบังคับของบริษัท (กำหนดคะแนนเต็ม 10)</td>
                                        <td ></td>
                                        <td class="text-center"><input class="text-center" type="number" name="part3point" value="" min="0" max="20" disabled></td>
                                        <td ></td>
                                        <td class="text-center"><input class="text-center" type="number" name="part3point" value="" min="0" max="20" disabled></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr class="active">
                                        <th>คะแนนสุทธิ (ส่วนที่ 1 + ส่วนที่ 2 - ส่วนที่ 3 )</th>
                                        <th></th>
                                        <th class="text-center" style="color: blue;"><b><input class="text-center" type="number" value="" name="ass1part1+2point" min="0" max="100"  disabled></b></th>
                                        <th></th>
                                        <th class="text-center" style="color: blue;"><input class="text-center" type="number" value=""  name="ass2part1+2point" min="0" max="100" disabled></th>
                                    </tr>
                                </tfoot>
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
            
                                        
                        </div>           
                    </div> 
                    <!-- /Part 4 -->       
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
