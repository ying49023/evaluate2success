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
    
    <style>
        
            table.table tr td,th{
                text-align: center;
            }
                
    </style>
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

                <h1>แบบฟอร์มประเมินผลการปฏิบัติงาน<small>แบบเน้น Competency, KPIs และ Development</small></h1>
                
                <ol class="breadcrumb">
                    <li>
                        <a href="#"> <i class="fa fa-dashboard"></i>
                            Home
                        </a>
                    </li>
                    <li class="active">Evaluation</li>
                </ol>
                <hr>
            </section>
            <!--/Page header -->

            <!-- Main content -->
            
            <div id="menu_status">
                <center>
                    <ul class="nav nav-pills">
                        <li class="active" role="presentation" style="width:30%">
                            <a href="evalstep1.php">ส่วนที่1 การวัความสามารถในการปฏิบัติงาน</a>
                        </li>
                        <li class="bg-info" role="presentation" style="width:30%">
                            <a href="prominent_page.php">ส่วนที่2 ความจำเป็นในการพัฒนา</a>
                        </li>
                        <li class="bg-info" role="presentation" class="active" style="width:30%">
                            <a href="complete_page.php">การประเมินเรียบร้อย</a>
                        </li>
                    </ul>

                </center>
            </div>
            <!--/Process bar-->
            <script>
                $(document).ready(function() {
                    var s = $("#sticker");
                    var pos = s.position();                    
                    $(window).scroll(function() {
                        var windowpos = $(window).scrollTop();
                        
                        if (windowpos >= pos.top) {
                            s.addClass("stick");
                        } else {
                            s.removeClass("stick"); 
                        }
                    });
                });


            </script>
            <style>
                .clear { 
                    clear:both; 
                }
                div#sticker {
                    padding:20px;
                    margin:20px 0;
                    width: 200px;
                }
                .stick {
                    position:fixed;
                    top:0px;
                }
                div#sideBar {
                    width:130px;
                    padding:20px;
                    margin-left:30px;
                    float:left;
                }
            </style>
            <div class=" row box-padding "  >
                <div id="">

                <div id="" class="box box-success" >
                    <div class="box-body">
                        <div class="row"> 
                            <div class="box-padding">
                                <!--ข้อมูลทั่วไป-->
                                <table class="table table-bordered table-condensed">
                                    <tbody><tr>
                                            <th rowspan="4">
                                                <img class="circle-thumbnail img-circle img-responsive img-thumbnail" src="img/emp1.jpg">
                                            </th>
                                            <th align="center" width="">ชื่อ-นามสกุล</th>
                                            <th align="center" width="120px">รหัส</th>
                                            <th align="center" width="">ตำแหน่ง</th>
                                            <th align="center" width="">แผนก</th>
                                            <th align="center" width="">ครั้งที่ 1 </th>

                                        </tr>
                                        <tr>
                                            <td>นาย ศตวรรษ วินวิวัฒน์</td>
                                            <td> 123456</td>
                                            <td>พนักงานฝ่ายบุคคล</td>
                                            <td>ฝ่ายบุคคล</td>
                                            <td><span class="text-green"><i class="glyphicon glyphicon-ok"></i></span></td>
                                        </tr>
                                    </tbody>
                                </table><!--/ข้อมูลทั่วไป-->
                                <a class="" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                    <i class="glyphicon glyphicon-triangle-bottom"></i>รายละเอียดบุคคลเพิ่มเติม
                                </a>
                                <div class="collapse" id="collapseExample" style="margin-top:10px;">
                                    <table class="table table-responsive table-bordered ">
                                        <thead>
                                            <tr class="">
                                                <th colspan="3">วันที่เริ่มงาน</th>
                                                <th colspan="3">ผู้บังคับบัญชา</th>
                                            </tr>
                                        </thead>
                                        <tr>
                                            <td colspan="3">1 ก.พ. 2556</td>
                                            <td colspan="3">นาย นภัทร อินทร์ใจเอื้อ</td>
                                        </tr>
                                        <thead>
                                            <tr class="">
                                                <th colspan="6">
                                                    สถิติการมาปฏิบัติงาน
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>ลาป่วย</th>
                                                <th>ลากิจ</th>
                                                <th>ลาอื่นๆ</th>
                                                <th>ขาดงาน</th>
                                                <th>ลางาน</th>
                                                <th width="16%">ลงโทษทางวินัย</th>
                                            </tr>
                                        </thead>
                                        <TR>
                                            <TD>1วัน</TD>
                                            <TD>1วัน</TD>
                                            <TD>-</TD>
                                            <TD>-</TD>
                                            <TD>2วัน</TD>
                                            <TD>-</TD>
                                        </TR>
                                    </table>
                                </div>
                            </div>
                        </div>  
                    </div>
                </div>
                </div>
                <div class="clear"></div>
            </div>

            <div class="row box-padding ">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <b>การวัดความสามารถ (Competency)</b>
                            ในการปฏิบัติงานตามตำแหน่งงานของพนักงานในระดับนี้ที่บริษัทกำหนดไว้ (career level)
                        </h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!--box-body-->
                    <div class="box-body">
                        <!-- /.row -->
                        <div class="row">
                            <div class="box-padding-small">
                                <center>
                                    <TABLE class="table table-bordered" HEIGHT="100" WIDTH="100%" border="1" >
                                        <thead>
                                            <TR>
                                                <th style="padding-top:25px;" rowspan="2" colspan="4">ความสามารถ(Competency)</th>
                                                <th style="padding-top:25px;" rowspan="2" >%น้ำหนัก(W)</th>
                                                <th colspan="2">ระดับที่คาดหวัง (E)</th>
                                                <th colspan="6">ระดับที่ทำจริง (A)</th>
                                            </TR>
                                            <tr>
                                                <td>ระดับ</td>
                                                <td>รวม</td>
                                                <td>1</td>
                                                <td>2</td>
                                                <td>3</td>
                                                <td>4</td>
                                                <td>5</td>
                                                <td>รวม</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <TR>
                                            <th colspan="13">
                                                ความสามารถในการปฏิบัติงาน (Competency) - ผู้บังคับบัญชากรุณาทำความเข้าใจ "คำอธิบายระดับความสามารถ" เพื่อประเมินได้ถูกต้อง
                                            </th>
                                        </TR>

                                        <TR>
                                            <th style="text-align:left"  colspan="13">ความสามารถในการบริหารหรือจัดการงาน (10%)</th>

                                        </TR>
                                        <TR>
                                            <td style="text-align:left" colspan="4">1. การวางแผนงาน</td>

                                            <td >3</td>
                                            <td >2</td>
                                            <td >6</td>
                                            <td >
                                                <input type="radio" name="optradio"></td>
                                            <td >
                                                <input type="radio" name="optradio"></td>
                                            <td >
                                                <input type="radio" name="optradio"></td>
                                            <td >
                                                <input type="radio" name="optradio"></td>
                                            <td >
                                                <input type="radio" name="optradio"></td>
                                            <td ></td>
                                        </TR>
                                        <TR>
                                            <td style="text-align:left" colspan="4">2. การดำเนินการตามแผนและติดตามผลงาน</td>

                                            <td >3</td>
                                            <td >3</td>
                                            <td >9</td>
                                            <td >
                                                <input type="radio" name="optradio2"></td>
                                            <td >
                                                <input type="radio" name="optradio2"></td>
                                            <td >
                                                <input type="radio" name="optradio2"></td>
                                            <td >
                                                <input type="radio" name="optradio2"></td>
                                            <td >
                                                <input type="radio" name="optradio2"></td>
                                            <td ></td>
                                        </TR>
                                        <TR>
                                            <td style="text-align:left" colspan="4">3. การแก้ไขปัญหาและการตัดสินใจ</td>

                                            <td >3</td>
                                            <td >3</td>
                                            <td >9</td>
                                            <td >
                                                <input type="radio" name="optradio3"></td>
                                            <td >
                                                <input type="radio" name="optradio3"></td>
                                            <td >
                                                <input type="radio" name="optradio3"></td>
                                            <td >
                                                <input type="radio" name="optradio3"></td>
                                            <td >
                                                <input type="radio" name="optradio3"></td>
                                            <td ></td>
                                        </TR>
                                        <TR>
                                            <td style="text-align:left" colspan="4">4. การพัฒนาผู้ใต้บังคับบัญชา</td>

                                            <td >2</td>
                                            <td >2</td>
                                            <td >4</td>
                                            <td >
                                                <input type="radio" name="optradio4"></td>
                                            <td >
                                                <input type="radio" name="optradio4"></td>
                                            <td >
                                                <input type="radio" name="optradio4"></td>
                                            <td >
                                                <input type="radio" name="optradio4"></td>
                                            <td >
                                                <input type="radio" name="optradio4"></td>
                                            <td ></td>
                                        </TR>
                                        <TR>
                                            <td style="text-align:left" colspan="4">5. การสร้างทีมงาน</td>

                                            <td >1</td>
                                            <td >3</td>
                                            <td >3</td>
                                            <td >
                                                <input type="radio" name="optradio5"></td>
                                            <td >
                                                <input type="radio" name="optradio5"></td>
                                            <td >
                                                <input type="radio" name="optradio5"></td>
                                            <td >
                                                <input type="radio" name="optradio5"></td>
                                            <td >
                                                <input type="radio" name="optradio5"></td>
                                            <td ></td>
                                        </TR>

                                        <TR>
                                            <th style="text-align:left" colspan="13">ความสามารถในงาน (ความรู้ ,ทักษะ ,คุณสมบัติเฉพาะบุคคล) (20%)</th>

                                        </TR>
                                        <TR>
                                            <td style="text-align:left" colspan="4">6. ความรู้ความเข้าใจในหน้าที่งานที่รับผิดชอบ</td>

                                            <td >4</td>
                                            <td >3</td>
                                            <td >12</td>
                                            <td >
                                                <input type="radio" name="optradio6"></td>
                                            <td >
                                                <input type="radio" name="optradio6"></td>
                                            <td >
                                                <input type="radio" name="optradio6"></td>
                                            <td >
                                                <input type="radio" name="optradio6"></td>
                                            <td >
                                                <input type="radio" name="optradio6"></td>
                                            <td ></td>
                                        </TR>
                                        <TR>
                                            <td style="text-align:left" colspan="4">7. ความละเอียดรอบคอบ</td>

                                            <td >4</td>
                                            <td >3</td>
                                            <td >12</td>
                                            <td >
                                                <input type="radio" name="optradio7"></td>
                                            <td >
                                                <input type="radio" name="optradio7"></td>
                                            <td >
                                                <input type="radio" name="optradio7"></td>
                                            <td >
                                                <input type="radio" name="optradio7"></td>
                                            <td >
                                                <input type="radio" name="optradio7"></td>
                                            <td ></td>
                                        </TR>
                                        <TR>
                                            <td style="text-align:left" colspan="4">8. ความสามารถในการสื่อสาร</td>

                                            <td >1</td>
                                            <td >3</td>
                                            <td >3</td>
                                            <td >
                                                <input type="radio" name="optradio8"></td>
                                            <td >
                                                <input type="radio" name="optradio8"></td>
                                            <td >
                                                <input type="radio" name="optradio8"></td>
                                            <td >
                                                <input type="radio" name="optradio8"></td>
                                            <td >
                                                <input type="radio" name="optradio8"></td>
                                            <td ></td>
                                        </TR>
                                        <TR>
                                            <td style="text-align:left" colspan="4">9. มนุษยสัมพันธ์ในการทำงาน</td>

                                            <td >2</td>
                                            <td >3</td>
                                            <td >6</td>
                                            <td >
                                                <input type="radio" name="optradio9"></td>
                                            <td >
                                                <input type="radio" name="optradio9"></td>
                                            <td >
                                                <input type="radio" name="optradio9"></td>
                                            <td >
                                                <input type="radio" name="optradio9"></td>
                                            <td >
                                                <input type="radio" name="optradio9"></td>
                                            <td ></td>
                                        </TR>
                                        <TR>
                                            <td style="text-align:left" colspan="4">10. การบริหารจัดการรายงานและเอกสารต่างๆ</td>

                                            <td >3</td>
                                            <td >3</td>
                                            <td >9</td>
                                            <td >
                                                <input type="radio" name="optradio10"></td>
                                            <td >
                                                <input type="radio" name="optradio10"></td>
                                            <td >
                                                <input type="radio" name="optradio10"></td>
                                            <td >
                                                <input type="radio" name="optradio10"></td>
                                            <td >
                                                <input type="radio" name="optradio10"></td>
                                            <td ></td>
                                        </TR>

                                        <TR>
                                            <td style="text-align:left" colspan="4">11. ความรับผิดชอบและไว้วางใจได้</td>

                                            <td >4</td>
                                            <td >2</td>
                                            <td >8</td>
                                            <td >
                                                <input type="radio" name="optradio11"></td>
                                            <td >
                                                <input type="radio" name="optradio11"></td>
                                            <td >
                                                <input type="radio" name="optradio11"></td>
                                            <td >
                                                <input type="radio" name="optradio11"></td>
                                            <td >
                                                <input type="radio" name="optradio11"></td>
                                            <td ></td>
                                        </TR>
                                        <TR>
                                            <td style="text-align:left" colspan="4">12. ความร่วมมือต่อทั้งผู้บังคับบัญชาและบริษัทฯ</td>

                                            <td >2</td>
                                            <td >3</td>
                                            <td >6</td>
                                            <td >
                                                <input type="radio" name="optradio12"></td>
                                            <td >
                                                <input type="radio" name="optradio12"></td>
                                            <td >
                                                <input type="radio" name="optradio12"></td>
                                            <td >
                                                <input type="radio" name="optradio12"></td>
                                            <td >
                                                <input type="radio" name="optradio12"></td>
                                            <td ></td>
                                        </TR>
                                        <TR>
                                            <th colspan="4">รวม</th>

                                            <td >30</td>
                                            <td ></td>
                                            <td >83</td>
                                            <td colspan="6"></td>

                                        </TR>
                                        </tbody>
                                    </TABLE>

                                </center>

                            </div>

                        </div>

                    </div>
                    <!-- ./box-body -->
                    <!-- /.content -->

                    <!--box footer-->
                    <div class="box-footer">
                        <button class="btn btn-success">บันทึกข้อมูล</button>
                        <a href="prominent_page.php">
                            <button class="btn btn-instagram pull-right">หน้าถัดไป</button>
                        </a>
                    </div>
                    <!--/box footer--> </div>

                <!-- /.content-wrapper --> </div>
            <!-- Add the sidebar's background. This div must be placed
                                 immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>

        </div>
    </div>
</div>
<!--Finish body content-wrapper-->

<!--Footer -->
<?php include './footer.php'; ?>

<!-- Control Sidebar -->
<?php include './controlsidebar.php'; ?>
</div>
<!-- ./wrapper -->

</body>
</html>
<?php
        }
    }
?>