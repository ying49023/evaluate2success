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
        
        if(isset($_POST["submit_skills"])){
            if(isset($_POST["skill_dev_id"])){
                $array_sk[] = array();
                $c_skill_id = 0;
                foreach ($_POST["skill_dev_id"] as $skill_dev_id) {
                    $array_sk[$c_skill_id] = $skill_dev_id;
                    //echo 'array : '.$c_skill_id.' -->'.$skill_dev_id.', ';
                    $c_skill_id++;
                }
            
                $array_p[] = array();
                $c_prominent = 0;
                foreach ($_POST["prominent_dev"] as $prominent_dev) {
                    $array_p[$c_prominent] = $prominent_dev;
                    $c_prominent++;
                }
                    
                    
                $i= 0 ;
                foreach ($_POST["skill_dev_id"] as $skill_dev_id){
                    $eval_emp_id = $_SESSION["eval_emp_id"];
                    
                    $sql_insert_skill = 'CALL insert_develop('.$eval_emp_id.','.$array_sk[$i].','.$array_p[$i].')';
                    $query_insert_skill = mysqli_query($conn, $sql_insert_skill);
                    echo '<br>'.$sql_insert_skill;
                    $i++;

                }
                header("location:evaluation_summary.php");
            }
            header("location:evaluation_summary.php");
            
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
                            <table class="table table-bordered table-hover ">
                                <?php  
                                    $sql_score = "SELECT
                                                                *
                                                        FROM
                                                                employees emp
                                                        JOIN evaluation_employee ee ON emp.employee_id = ee.employee_id
                                                        JOIN evaluation e ON e.evaluation_code = ee.evaluation_code
                                                        WHERE
                                                                ee.evaluate_employee_id = '".$_SESSION["eval_emp_id"]."'";
                                    $query_score = mysqli_query($conn, $sql_score);
                                    while($result_score = mysqli_fetch_array($query_score)){
                                        $score_1 = $result_score["point_kpi"];
                                        $score_2_1_m_1 = round($result_score["point_com1_part1"],1);
                                        $score_2_2_m_1 = round($result_score["point_com1_part2"],1);
                                        $score_2_1_m_2 = round($result_score["point_com2_part1"],1);
                                        $score_2_2_m_2 = round($result_score["point_com2_part2"],1);
                                        $score_3 = 10-($result_score["point_leave"]+$result_score["point_penalty"]);
                                        $sum_score_m_1 = ($score_1 + $score_2_1_m_1 + $score_2_2_m_1) + $score_3;
                                        $sum_score_m_2 = ($score_1 + $score_2_1_m_2 + $score_2_2_m_2) + $score_3;
                                        
                                    ?>
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
                                        <td    class="text-center"><input class="text-center" type="number" name="ass1part1point" min="0" max="60" value="<?php echo $score_1; ?>" disabled></td>
                                        <td  class="text-center"><b>60</b></td>
                                        <td  class="text-center"><input class="text-center" type="number" name="ass2part1point" min="0" max="60" value="<?php echo $score_1; ?>" disabled></td>
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
                                        <td  class="text-center"><input class="text-center" type="number" name="ass1part2/1point" value="<?php echo $score_2_1_m_1; ?>" min="0" max="20" disabled></td>
                                        <td  class="text-center"><b>20</b></td>
                                        <td  class="text-center"><input class="text-center" type="number" name="ass1part2/1point" value="<?php echo $score_2_1_m_2; ?>" min="0" max="20" disabled></td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left: 40px;">ส่วนที่ 2.2 ในส่วนพฤติกรรมทั่วไป (General Competency)</td>
                                        <td class="text-center"><b>20</b></td>
                                        <td class="text-center"><input class="text-center" type="number" name="ass1part2/2point" value="<?php echo $score_2_2_m_1; ?>" min="0" max="20" disabled></td>
                                        <td class="text-center"><b>20</b></td>
                                        <td class="text-center"><input class="text-center" type="number" name="ass2part2/1point" value="<?php echo $score_2_2_m_2; ?>" min="0" max="20" disabled></td>
                                    </tr>
                                     <tr>
                                        <td ><b>ส่วนที่ 3:  การปฏิบัติตามกฎระเบียบและข้อบังคับของบริษัท (กำหนดคะแนนเต็ม 10)</td>
                                        <td ></td>
                                        <td class="text-center"><input class="text-center" type="number" name="part3point" value="<?php echo $score_3; ?>" min="0" max="20" disabled></td>
                                        <td ></td>
                                        <td class="text-center"><input class="text-center" type="number" name="part3point" value="<?php echo $score_3; ?>" min="0" max="20" disabled></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr class="active">
                                        <th>คะแนนสุทธิ (ส่วนที่ 1 + ส่วนที่ 2 + ส่วนที่ 3 )</th>
                                        <th></th>
                                        <th class="text-center" style="color: blue;"><b><input class="text-center" type="number" value="<?php echo $sum_score_m_1; ?>" name="ass1part1+2point" min="0" max="100"  disabled></b></th>
                                        <th></th>
                                        <th class="text-center" style="color: blue;"><input class="text-center" type="number" value="<?php echo $sum_score_m_2; ?>"  name="ass2part1+2point" min="0" max="100" disabled></th>
                                    </tr>
                                </tfoot>
                                    <?php } ?>
                            </table>
                            <!--/Table Point-->
                        </div>
                        <br>
                        <form method="post">
                        <div class="row box-padding">
                            <div ><h4>ความคิดเห็นเพิ่มเติม</h4>   </div>
                            <!--จุดเด่น-->
                            <div class="col-md-6">
                                <div class="box box-success box-padding-small">
                                    <div class="box-body">
                                        
                                        <div class="form-group">
                                            <h4><u>จุดเด่นของผู้ถูกประเมิน</u></h4>
                                            <div id="myTbl"> 
                                                        <?php
                                                        $max = 2;
                                                        for ($n = 0; $n <= $max; $n++) {
                                                            ?>
                                                <div class="firstTr form-group">
                                                    <input name="h_item_id[]" type="hidden" id="h_item_id[]" value="" /> 
                                                    <input type="text" class="text_data form-control" name="strong_point[]" id="data2[]" placeholder="ระบุจุดเด่นของผู้ถูกประเมิน" />  
                                                        
                                                </div> 
                                                        <?php } ?> 
                                            </div>  
                                            <div class="form-group">
                                                <button id="addRow" type="button">+</button>    
                                                &nbsp;  
                                                <button id="removeRow" type="button">-</button>  
                                                &nbsp;    
                                                <!--<input type="submit" name="Submit" id="Submit" value="Submit" /></td>-->  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/จุดเด่น-->
                            
                            <!-- จุดด้อย -->
                            <div class="col-md-6">
                                <div class="box box-danger box-padding-small">
                                    <div class="box-body">
                                        
                                        <div class="form-group">
                                            <h4><u>จุดด้อยของผู้ถูกประเมิน</u></h4>
                                            <div id="myTbl2"> 
                                                        <?php
                                                        $max = 2;
                                                        for ($n = 0; $n <= $max; $n++) {
                                                            ?>
                                                <div class="firstTr2 form-group">
                                                    
                                                    <input name="h_item_id[]" type="hidden" id="h_item_id[]" value="" /> 
                                                    <input type="text" class="text_data form-control" name="weak_point[]" id="data2[]" placeholder="ระบุจุดด้อยของผู้ถูกประเมิน" />  
                                                        
                                                </div> 
                                                        <?php } ?> 
                                            </div>  
                                            <div class="form-group">
                                                <button id="addRow2" type="button">+</button>    
                                                &nbsp;  
                                                <button id="removeRow2" type="button">-</button>  
                                                &nbsp;    
                                                <!--<input type="submit" name="Submit" id="Submit" value="Submit" /></td>  -->
                                            </div>
                                                
                                               
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/จุดด้อย-->
                        </div>
                        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> 
                        <script type="text/javascript">  
                                $(function(){  
                                    
                                    $("#addRow").click(function(){  
                                        // ส่วนของการ clone ข้อมูลด้วย jquery clone() ค่า true คือ  
                                        // การกำหนดให้ ไม่ต้องมีการ ดึงข้อมูลจากค่าเดิมมาใช้งาน  
                                        // รีเซ้ตเป็นค่าว่าง ถ้ามีข้อมูลอยู่แล้ว ทั้ง select หรือ input  
                                        $(".firstTr:eq(0)").clone(true)   
                                                .find("input").attr("value","").end()    
                                                .appendTo($("#myTbl"));  
                                    });  
                                    $("#removeRow").click(function(){  
                                        // // ส่วนสำหรับการลบ  
                                        if($("#myTbl div").size()>1){ // จะลบรายการได้ อย่างน้อย ต้องมี 1 รายการ  
                                            $("#myTbl div:last").remove(); // ลบรายการสุดท้าย  
                                        }else{  
                                            // เหลือ 1 รายการลบไม่ได้  
                                            alert("ต้องมีรายการข้อมูลอย่างน้อย 1 รายการ");  
                                        }  
                                    });   
                                    
                                    $("#addRow2").click(function(){  
                                        // ส่วนของการ clone ข้อมูลด้วย jquery clone() ค่า true คือ  
                                        // การกำหนดให้ ไม่ต้องมีการ ดึงข้อมูลจากค่าเดิมมาใช้งาน  
                                        // รีเซ้ตเป็นค่าว่าง ถ้ามีข้อมูลอยู่แล้ว ทั้ง select หรือ input  
                                        $(".firstTr2:eq(0)").clone(true)   
                                                .find("input").attr("value","").end()    
                                                .appendTo($("#myTbl2"));  
                                    });  
                                    $("#removeRow2").click(function(){  
                                        // // ส่วนสำหรับการลบ  
                                        if($("#myTbl2 div").size()>1){ // จะลบรายการได้ อย่างน้อย ต้องมี 1 รายการ  
                                            $("#myTbl2 div:last").remove(); // ลบรายการสุดท้าย  
                                        }else{  
                                            // เหลือ 1 รายการลบไม่ได้  
                                            alert("ต้องมีรายการข้อมูลอย่างน้อย 1 รายการ");  
                                        }  
                                    });   
                                    
                                });  
                            </script>
                        
                        <div class="row box-padding">
                            <h4>ควรได้รับการพัฒนาและฝึกอบรมในด้านใด</h4>
                            <div class="col-md-12">
                                <script>
                                        function getSkillDev(val) {
                                            $.ajax({
                                                type: "POST",
                                                url: "get_skill_development.php",
                                                data:'skill_dev_group_id='+val,
                                                success: function(data){
                                                    $("#list").html(data);
                                                }
                                            });
                                        }
                                </script>
                                <div class="box box-primary box-padding-small">
                                    <div class="box-header with-border" >
                                        <div class="row" id="table_header">
                                            <div class="col-md-5">
                                                <div class="form-group"> 
                                                    <label>หัวข้อการพัฒนาและฝึกอบรม</label>
                                                    <select id="stemplate" class="form-control" name="skill_dev_group_id"  onChange="getSkillDev(this.value);">
                                                        <option value="" >--เลือกหัวข้อการพัฒนาและฝึกอบรม--</option>
                                                        <?php
                                                        $sql_skill_group = "SELECT * FROM skill_development_group" ;
                                                        $query_skill_group = mysqli_query($conn, $sql_skill_group);
                                                        foreach ($query_skill_group as $result_skill_group){
                                                            ?>
                                                            <option value="<?php echo $result_skill_group["skill_dev_group_id"]; ?>"><?php echo $result_skill_group["skill_dev_group_name"]; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group"> 
                                                    <label>หัวข้อย่อย</label>
                                                    <select class="form-control" name="skill_development_id" id="list">
                                                        <option value="" >--เลือก--</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <button onclick="add_dev()" class="btn btn-success margin-top-form" style="width: 100%;">+ เพิ่ม</button>
                                                </div>
                                            </div>
                                        </div>
<!--                                        <div class="row">
                                            <div id="table_dev"></div>
                                            <script type="text/javascript">
                                                function add_dev(){
                                                    $("#stemplate ").val();
                                                    $("#table_dev").append($("#table_header :selected").html());
                                                    
                                                }
                                            </script>
                                        </div>-->
                                        
                                    </div>                                      
                                </div>
                            </div>
                        </div>
                            
                        
                        <!--submit button-->    
                        <div class="box-footer">
                            <div class="row box-padding text-center">
                                <button class="btn btn-success btn-lg" type="submit" name="submit_skill"><i class="glyphicon glyphicon-play-circle"></i>&nbsp; หน้าถัดไป - สรุปผลการประเมิน</button>
                                <input class="btn btn-danger btn-lg" type="reset" value="รีเซ็ต" >
                            </div>
                        </div>
                        <!--submit button-->    
                        
                        </form>
                        
                        </div>
                            <!--modal submit button-->
                            <div class="modal fade" id="save_point" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">ยืนยันการประเมิน</h4>
                                        </div>
                                        <div class="modal-body">                                                                                                      <!--<iframe id="iframe_target" name="iframe_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>-->

                                            เมื่อกดยืนยันคุณจะไม่สามารถกลับมาแก้ไขได้!! ทำรายการต่อไหม?

                                        </div>
                                        <div class="modal-footer">                                                                   
                                            <button class="btn btn-info " type="submit" >ยืนยัน</button>                                                                             
                                            <input type="hidden" name="position_level" value="" >
                                            <input type="hidden" name="emp" value="" >
                                            <input type="hidden" name="evalcode" value="" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/modal submit button-->
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
