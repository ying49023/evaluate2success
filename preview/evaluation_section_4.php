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
        
        if (isset($_GET["emp_id"])) {
            $get_emp_id = $_GET["emp_id"];
        }
        //Get Evaluation employee id
        if (isset($_GET["eval_emp_id"])) {
            $get_eval_emp_id = $_GET["eval_emp_id"];
        }
        //Get Evaluation code
        if (isset($_GET["eval_code"])) {
            $get_eval_code = $_GET["eval_code"];
        }
        //Get Position Level
        if(isset($_GET["position_level_id"])){
            $level = $_GET["position_level_id"];
        }
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
                    <!-- Brief Info Profile Employee  -->
                    <?php include './breif_info_profile_eval.php'; ?>
                    <!-- /Brief Info Profile Employee  -->
                    
                    <!-- Navbar process -->
                    <?php include './navbar_process.php'; ?>
                    <!-- /Navbar process -->
                    <!-- Part 4 -->
                    <div class="box box-primary">
                        <div class="box-header "><h4>สรุปคะแนนที่ได้รับจากแต่ละส่วนเพื่อประเมินผลโดยรวม</h4></div>
                        <div class="box-body">
                            <!--Table Point-->
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr align="center">
                                        <td rowspan=2 class="bg-inverse" style="vertical-align: middle;"><b>หัวข้อประเมิน</b></td>
                                        <td colspan=2 class="bg-orange"><b>ผู้ประเมินที่ 1</b></td>
                                        <td colspan=2 class="bg-olive"><b>ผู้ประเมินที่ 2</b></td>
                                    </tr>
                                    <tr align="center">
                                       <td class="bg-warning"><b>คะแนนเต็ม</b></td>
                                       <td class="bg-warning"><b>คะแนนที่ได้รับ</b></td>
                                       <td class="bg-success"><b>คะแนนเต็ม</b></td>
                                       <td class="bg-success"><b>คะแนนที่ได้รับ</b></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <tr>
                                        <td><b>คะแนนรวมส่วนที่ 1:</b> การประเมินด้านผลงาน (กำหนดคะแนนเต็ม 60)</td>
                                        <td class="" align="center"><b>60</b></td>
                                        <td class=""   align="center"><input type="number" name="ass1part1point" min="0" max="60" disabled readonly></td>
                                        <td class="" align="center"><b>60</b></td>
                                        <td class="" align="center"><input type="number" name="ass2part1point" min="0" max="60" disabled readonly></td>
                                    </tr>
                                    <tr>
                                        <td><b>คะแนนรวมส่วนที่ 2 : พฤติกรรมการทำงาน</b></td>
                                        <td class=""></td>
                                        <td class=""></td>
                                        <td class="" ></td>
                                        <td class="" ></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ส่วนที่ 2.1 พฤติกรรมหลักร่วมกันทั้งองค์กร (Corporate Competency)</td>
                                        <td class="" align="center"><b>20</b></td>
                                        <td class="" align="center"><input type="number" name="ass1part2/1point" min="0" max="20" disabled readonly></td>
                                        <td class="" align="center"><b>20</b></td>
                                        <td class="" align="center"><input type="number" name="ass1part2/1point" min="0" max="20" disabled readonly></td>
                                    </tr>
                                    <tr>
                                         <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ส่วนที่ 2.2 ในส่วนพฤติกรรมทั่วไป (General Competency)</td>
                                        <td align="center"><b>20</b></td>
                                        <td align="center"><input type="number" name="ass1part2/2point" min="0" max="20" disabled readonly></td>
                                        <td align="center"><b>20</b></td>
                                        <td align="center"><input type="number" name="ass2part2/1point" min="0" max="20" disabled readonly></td>
                                    </tr>
                                     <tr>
                                        <td><b>ส่วนที่ 3:  การปฏิบัติตามกฎระเบียบและข้อบังคับของบริษัท (กำหนดคะแนนเต็ม 10)</td>
                                        <td ></td>
                                        <td class="text-center"><input type="number" name="part3point" min="0" max="20" disabled readonly></td>
                                        <td ></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>คะแนนสุทธิ (ส่วนที่ 1 + ส่วนที่ 2 )</td>
                                        <td colspan=2 align="center" style="color: red;"><b><input type="number" name="ass1part1+2point" min="0" max="100" disabled readonly></b></td>
                                        <td colspan=2 align="center" style="color: red;"><b><input type="number" name="ass2part1+2point" min="0" max="100" disabled readonly></b></td>
                                    </tr>
                                     <tr>
                                        <td align= right><b>สรุปคะแนนตลอดปี (คะแนนสุทธิผู้ประเมินที่ 1 +  คะแนนสุทธิผู้ประเมินที่ 2) หาร 2</b></td>
                                        <td colspan=4 align="center" style="background-color:#FFEFD5;"><b><input type="number" name="term1+2point" min="0" max="100" disabled readonly></b></td>
                                       
                                    </tr>
                                    <tr>
                                        <td align= right><b>สรุปคะแนนพิจารณาบทลงโทษทางวินัย</b></td>
                                        <td colspan=4 align="center" style="background-color:#FAF0E6;"><b><input type="number" name="penaltypoint" min="0" max="100" disabled readonly></b></td>
                                       
                                    </tr>
                                    <tr>
                                        <td align= right><b>สรุปคะแนนประเมินผลงานโดยรวม (Overall rating)</b></td>
                                        <td colspan=4 align="center" style="background-color:#F0FFFF;"><b><input type="number" name="allpoint" min="0" max="100" disabled readonly></b></td>
                                       
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <div class="row box-padding">
                            <div class=""><h4>ความคิดเห็นเพิ่มเติม</h4>   </div>
                            <div class="col-md-6">
                                <h5><u>จุดเด่นของผู้ถูกประเมิน</u></h5>
                                <div class="box box-success box-padding-small">
                                    <div class="form-group">
                                       <ol>
                                           <?php
                                           $sql_skill = "SELECT
                                                                *
                                                        FROM
                                                                skill_development sd
                                                        JOIN skill_devlopment_group skg ON skg.skill_dev_group_id = sd.skill_development_id" ;
                                           $query_skill = mysqli_query($conn, $sql_skill);
                                           
                                           for($i = 1;$i<=5;$i++) {
                                           ?>
                                                   <li>
                                                       <select class="form-control" name="good">
                                                           <?php 
                                                           foreach ($query_skill as $result_skill){
                                                                echo $result_skill["skill_development_name"];
                                                           ?>
                                                           <option value=""><?php echo $result_skill["skill_development_name"]; ?></option>
                                                           <?php } ?>
                                               </select>
                                                   </li>
                                           <?php 
                                           
                                           } ?>
                                    </ol> 
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5><u>จุดด้อยของผู้ถูกประเมิน</u></h5>
                                <div class="box box-danger box-padding-small">
                                    <div class="form-group">
                                       <ol>
                                           <?php
                                           for($i = 1;$i<=5;$i++) {
                                           ?>
                                           <li><input class="form-control" type="text" name="bad"></li>
                                           <?php } ?>
                                    </ol> 
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
     
                            <!--Table Good Bad-->

                            <table class="table">
                                <thead class="thead-default">
                                    <tr>
                                                
                                        <th colspan="4">ควรได้รับการพัฒนาด้านใด</th>
                                                    
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td><input type="text" name="develop" size="40"></td>
                                        <th scope="row">5</th>
                                        <td><input type="text" name="develop" size="40"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td><input type="text" name="develop" size="40"></td>
                                        <th scope="row">6</th>
                                        <td><input type="text" name="develop" size="40"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td><input type="text" name="develop" size="40"></td>
                                        <th scope="row">7</th>
                                        <td><input type="text" name="develop" size="40"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">4</th>
                                        <td><input type="text" name="develop" size="40"></td>
                                        <th scope="row">8</th>
                                        <td><input type="text" name="develop" size="40"></td>
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
                                        <td><input type="radio" value="A++"  name="grade" disabled readonly></td>
                                        <td><input type="radio" value="A+" name="grade" disabled readonly></td>
                                        <td><input type="radio" value="A-" name="grade" disabled readonly></td>
                                        <td><input type="radio" value="B++" name="grade" disabled readonly></td>
                                        <td><input type="radio" value="B+" name="grade" disabled readonly></td>
                                        <td><input type="radio" value="B" name="grade" disabled readonly></td>
                                        <td><input type="radio" value="B-" name="grade" disabled readonly></td>
                                        <td><input type="radio" value="C++" name="grade" disabled readonly></td>
                                        <td><input type="radio" value="C+" name="grade" disabled readonly></td>
                                        <td><input type="radio" value="C" name="grade" disabled readonly></td>
                                        <td><input type="radio" value="C-" name="grade" disabled readonly></td>
                                                    
                                                    
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
