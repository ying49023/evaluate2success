<?php
    //General user
    session_start();
    //Check_login
    if($_SESSION["employee_id"]==''){
        echo "Please login again";
        echo "<a href='login.php'>Click Here to Login</a>";
        header("location:login.php");
    }else if($_SESSION["login_status"] != '0' ){
        echo "Login wrong level" ;
        header("location:hr/index.php");
    } else{
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
                    <!-- Part 3 -->
                    <div class="box box-primary">
                        <div class="box-header with-border">

                            <!--Table Point-->
                            <form>
                            <table class="table table-hover">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th colspan="6"><h4><b>3.1 เวลาการทำงาน (Time Attendance)</b></h4></th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr align="center">
                                        <td rowspan=2 colspan=4 style="vertical-align: middle;"><b>ประเภทวันลา</b></td>
                                        <?php
                                            $sql_month = "SELECT start_month, end_month FROM term where term_id = 1";
                                            $query = mysqli_query($conn, $sql_month); //$conn มาจากไฟล์ connection_mysqli.php เป็นตัว connect DB
                                        ?>
                                        <?php
                                            while ($result = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                                                $start = $result["start_month"];
                                                $end = $result["end_month"];
                                         ?>
                                           
                                        <td colspan=2 align="center"><b>ระหว่างเดือน</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $start; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>ถึง</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $end?></td>
                                        <?php } ?>
                        
                                        <td rowspan=2 align="center" style="vertical-align: middle;"><b>รวมคะแนนทั้งหมด</b></td>
                                    </tr>
                                    <tr align="center">
                                       <td align="center"><b>รวมจำนวนวัน</b></td>
                                       <td align="center"><b>ชั่วโมง</b></td>
                                       
                                    </tr>
                                    <tr>
                                        <th scope="row">1</th>
                                        <th scope="row" colspan=2>ลาป่วย</th>
                                        <td></td>
                                        <td align="center"><input type="number" name="leave" min="1" max="365"></td>
                                        <td align="center"><input type="number" name="hour" min="1" max="1000" disabled readonly></td>
                                        <td align="center"><input type="number" name="point" min="0.5" max="60" disabled readonly></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <th scope="row" colspan=2>ลากิจ</th>
                                        <td></td>
                                        <td align="center"><input type="number" name="leave" min="1" max="365"></td>
                                        <td align="center"><input type="number" name="hour" min="1" max="1000" disabled readonly></td>
                                        <td align="center"><input type="number" name="point" min="0.5" max="60" disabled readonly></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <th scope="row">มาสาย</th>
                                        <td>จำนวนครั้ง</td>
                                        <td><input type="number" name="leave" min="1" max="365"></td>
                                        <td align="center"><input type="number" name="leave" min="1" max="365"></td>
                                        <td align="center"><input type="number" name="hour" min="1" max="1000"></td>
                                        <td align="center"><input type="number" name="point" min="0.5" max="60" disabled readonly></td>
                                    </tr>
                                      <tr>
                                        <th scope="row">4</th>
                                        <th scope="row" colspan=2>ลาอื่นๆ</th>
                                        <td></td>
                                        <td align="center"><input type="number" name="leave" min="1" max="365"></td>
                                        <td align="center"><input type="number" name="hour" min="1" max="1000" disabled readonly></td>
                                        <td align="center"><input type="number" name="point" min="0.5" max="60" disabled readonly></td>
                                    </tr>
                                    <tr>
                                        <td align="right" colspan=4><b>รวม</b></td>
                                        <td align="center"><input type="number" name="leave" min="1" max="365" disabled readonly></td>
                                        <td align="center"><input type="number" name="hour" min="1" max="1000" disabled readonly></td>
                                        <td align="center"><input type="number" name="point" min="0.5" max="60" disabled readonly></td>
                                    </tr>

                                </tbody>
                            </table>
                            </form>
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
                                       <td><input type="text" name="reward" size="40"></td>
                                       <th scope="row">1</th>
                                       <td><input type="text" name="penalty" size="40"></td>
                                    </tr>
                                     <tr>
                                       <th scope="row">2</th>
                                       <td><input type="text" name="reward" size="40"></td>
                                       <th scope="row">2</th>
                                       <td><input type="text" name="penalty" size="40"></td>
                                    </tr>
                                      <tr>
                                       <th scope="row">3</th>
                                       <td><input type="text" name="reward" size="40"></td>
                                       <th scope="row">3</th>
                                       <td><input type="text" name="penalty" size="40"></td>
                                    </tr>
                                     <tr>
                                       <th scope="row">4</th>
                                       <td><input type="text" name="reward" size="40"></td>
                                       <th scope="row">4</th>
                                       <td><input type="text" name="penalty" size="40"></td>
                                    </tr>
                                        <tr>
                                       <th scope="row">5</th>
                                       <td><input type="text" name="reward" size="40"></td>
                                       <th scope="row">5</th>
                                       <td><input type="text" name="penalty" size="40"></td>
                                    </tr>
                                      <tr>
                                       <th scope="row">6</th>
                                       <td><input type="text" name="reward" size="40"></td>
                                       <th scope="row">6</th>
                                       <td><input type="text" name="penalty" size="40"></td>
                                    </tr>
                                      <tr>
                                       <th scope="row">7</th>
                                       <td><input type="text" name="reward" size="40"></td>
                                       <th scope="row">7</th>
                                       <td><input type="text" name="penalty" size="40"></td>
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
                                        <td><input type="text" name="commentpart3" size="60"></td>
                                        <td align="center" height="50" width="100" style="background-color:#F5F5F5;"><input type="number" name="point" min="0.5" max="60" disabled readonly></td>

                                    </tr>
                                     <tr>
                                        <th scope="row">2</th>
                                        <td><input type="text" name="commentpart3" size="60"></td>
                                        <td align="center" height="80" width="100" style="background-color:#E6E6FA;"><b>คะแนนเต็ม (ระหว่าง 5-20)</b></td>

                                    </tr>
                                     <tr>
                                        <th scope="row">3</th>
                                        <td><input type="text" name="commentpart3" size="60"></td>
                                        <td align="center" height="50" width="100" style="background-color:#F5F5F5;"><input type="number" name="point" min="5" max="20" disabled readonly></td>
                                    </tr>
                                
                                
                                </tbody>
                          </table>
                                        
                        </div>           
                    </div> 
                    <!-- /Part 3 -->       
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
