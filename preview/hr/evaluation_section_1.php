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
<!DOCTYPE html>
<html>
    <head>
        <?php 
        include ('./classes/connection_mysqli.php');
        if (isset($_GET["emp_id"])) {
                $get_emp_id = $_GET["emp_id"];
            }
            // Include คลาส class.upload.php เข้ามา เพื่อจัดการรูปภาพ
            require_once('./classes/class.upload.php') ;
            
        ?>
        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>แก้ไขข้อมูลพนักงาน : ALT Evaluation</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!--CSS PACKS -->
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
                        แก้ไขแบบประเมิน
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Edit profile</li>
                    </ol>
                </section>
                <!--/Page header -->

                <!-- Main content -->
                <!--search-->
                <div class="row box-padding">
                    <div class="box box-success">
                        <div class="box-body">
                            <form method="get">
                                <div class="col-sm-4">
                                    
                                    <div class="col-sm-2 form-inline">
                                        <label class=" control-label">ปี</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <select class="form-control " name="year" >
                                            <option value="">--เลือกปี--</option>
                                            <option value="2016">2016</option>
                                            <option value="2016">2015</option>
                                            <option value="2016">2014</option>
                                        </select>
                                    </div>
                                </div> 

                                <div class="col-md-6">
                                    <div class="col-sm-3 form-inline">
                                        <label class=" control-label">รอบการประเมิน</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select class="form-control " name="term" >
                                            <option value="">--เลือกรอบการประเมิน--</option>
                                            <option value="1">ครั้งที่ 1 (มค - มิย)</option>
                                            <option value="2">ครั้งที่ 2 (กค - ธค)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary " style="width: 100%;"><i class="glyphicon glyphicon glyphicon-triangle-right"></i> &nbsp; สร้างแบบประเมิน</button>
                                </div>
                            </form>
                        </div>
                    </div>     
                    <div>
                            <ul id="tabs" class="nav nav-pills nav-justified" data-tabs="tabs">
                                <li >
                                    <a href="explan_evaluation.php" data-toggle="tab" aria-expanded="false">คำชี้แจง</a>
                                </li>
                                <li class="active">
                                    <a href="evaluation_section_1.php" data-toggle="tab" aria-expanded="true">ส่วนที่ 1 : KPIs</a>
                                </li>        
                                <li class="">
                                    <a href="edit_weight_eval.php?position_level_id="  aria-expanded="false">ส่วนที่ 2 : Competency</a>
                                </li>        
                                <li class="">
                                    <a href="" data-toggle="tab" aria-expanded="false">ส่วนที่ 3 : กฎระเบียบข้อบังคับ</a>
                                </li>        
                                <li class="">
                                    <a href="" data-toggle="tab" aria-expanded="false">ส่วนที่ 4 : ควมคิดเห็นเพิ่มเติม</a>
                                </li>        
                            </ul>
                    </div>
                <!--</div>-->
                <br>
                <div id="" class="box box-primary" >
                    <div class="box-body">
                        <div class="row"> 
                            <div class="box-padding">
                                <!--ข้อมูลทั่วไป-->
                                <table class="table table-responsive ">
                                    
                                        <tr>
                                            <th rowspan="5">
                                                <img class="circle-thumbnail img-circle img-responsive img-thumbnail" src="upload_images/default.png">
                                            </th>
                                            <th align="center" colspan="2" width="">ชื่อ-นามสกุล: </th>
                                            <th align="center" colspan="2" width=""> </th>
                                            <th align="center" colspan="1" width="">ตำแหน่ง: </th>
                                            <th align="center" colspan="1" width=""> </th>
                                            <th align="center" colspan="1" width="">ระดับตำแหน่ง:  </th>
                                            <th align="center" colspan="1" width=""> </th>

                                        </tr>
                                        <tr>
                                            <th align="center" colspan="2" width="">รหัส: </th>
                                            <th align="center" colspan="2" width=""> </th>
                                            <th align="center" colspan="2" width="">อายุงาน: </th>
                                            <th align="center" colspan="2" width=""> </th>
                                            
                                        </tr>
                                        <tr>
                                            <th align="center" colspan="2" width="">วันเริ่มงาน: </th>
                                            <th align="center" colspan="2" width=""> </th>
                                            <th align="center" colspan="2" width="">สังกัด / ฝ่าย / สายงาน :    </th>
                                            <th align="center" colspan="2" width=""> </th>
                                            
                                        </tr>
                                        <tr>
                                            <th align="center" colspan="2" width="">ชื่อ - นามสกุลของผู้ประเมินที่ 1 :   </th>
                                            <th align="center" colspan="2" width=""> </th>
                                            <th align="center" colspan="2" width="">ชื่อ - นามสกุลของผู้ประเมินที่ 2 :   </th>
                                            <th align="center" colspan="2" width=""> </th>
                                            
                                        </tr>
                                        <tr>
                                            <th align="center" colspan="2" width="">วันที่ประเมิน : </th>
                                            <th align="center" colspan="2" width=""> </th>
                                            <th align="center" colspan="2" width="">ระยะเวลาประเมินผล </th>
                                            <th align="center" colspan="2" width=""> ......../ ......... / 25 ......  ถึง ......... / ......... / 25........ </th>
                                            
                                        </tr>
                                    
                                
                                
                                
                                       
                                   </table><!--/ข้อมูลทั่วไป--> 
                            </div>
                        </div>  
                    </div>
                </div>
                <!--/search-->
                <!--<div class="row box-padding" >-->
                    <div class="box box-primary ">
                        <div class="box-header with-border">
                            <h4><i class="glyphicon glyphicon-info-sign"></i> &nbsp; ส่วนที่ 1  :   การประเมินด้านผลงาน (คะแนนเต็ม 60 )</h4>
                        </div>
                    <div class="box-body">
                        <div class="box-padding">
                            <div class="row">
                                <h4 class="text-bold">สำหรับการประเมินผลครั้งที่: </h4>
                                <h4></h4>
                                <br>
                                <table>
                                    <tr> 
                                        <th>ผู้บังคับบัญชาและพนักงาน : </th>
                                    </tr>
                                    <tr>
                                    <th>1) กำหนดเต็มในส่วนที่ 1 (คะแนนเต็ม 60 )  </th>
                                    </tr>
                                    <tr>
                                    <th>2) กำหนดวัตถุประสงค์ / เป้าหมายที่กำหนดร่วมกันระหว่างผู้ประเมิน และผู้ถูกประเมิน</th>
                                    </tr>
                                    <tr>
                                    <th>3) การวัดผลงานควรอยู่ระหว่าง 4-7 ข้อ เท่านั้น เพื่อให้พนักงานใช้เป็นแนวทางและเป้าหมายในการปฏิบัติงาน</th>
                                </tr>
                                </table>
                                
                            </div>  
                            <div class="row">
                                <br>
                                <table class="table table-bordered ">
                                    <thead>
                                    <tr> 
                                        <th rowspan="2">
                                            วัตถุประสงค์ / เป้าหมายที่กำหนดร่วมกันระหว่างผู้ประเมิน และผู้ถูกประเมิน (Performance Objectives / KPIs)
                                        </th>
                                        <th rowspan="2">
                                            ผลการปฏิบัติงานที่เกิดขึ้นจริง (Actual Performance)
                                        </th>
                                        <th rowspan="1" colspan="3">ครั้งที่ 1 ม.ค. - มิ.ย. </th>
                                    </tr>
                                    <tr> 
                                        
                                        <th rowspan="1">น้ำหนักรวม</th>
                                        <th rowspan="1">คะแนน</th>
                                        <th rowspan="1">คะแนนรวม(น้ำหนัก X คะแนน) </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                       <tr> 
                                        <th rowspan="1"></th>
                                        <th rowspan="1"></th>
                                        <th rowspan="1"></th>
                                        <th rowspan="1"></th>
                                        <th rowspan="1"></th>
                                        </tr>
                                        <tr> 
                                        <th rowspan="1"></th>
                                        <th rowspan="1"></th>
                                        <th rowspan="1"></th>
                                        <th rowspan="1"></th>
                                        <th rowspan="1"></th>
                                        </tr>
                                        <tr> 
                                        <th rowspan="1"></th>
                                        <th rowspan="1"></th>
                                        <th rowspan="1"></th>
                                        <th rowspan="1"></th>
                                        <th rowspan="1"></th>
                                        </tr>
                                        <tr> 
                                        <th rowspan="1"></th>
                                        <th rowspan="1"></th>
                                        <th rowspan="1"></th>
                                        <th rowspan="1"></th>
                                        <th rowspan="1"></th>
                                        </tr>
                                        <tr> 
                                        <th rowspan="1"></th>
                                        <th rowspan="1"></th>
                                        <th rowspan="1"></th>
                                        <th rowspan="1"></th>
                                        <th rowspan="1"></th>
                                        </tr>
                                        <tr> 
                                            <th rowspan="1" colspan="2" class="text-right">รวม</th>
                                        
                                        <th rowspan="1">100</th>
                                        <th rowspan="1"></th>
                                        <th rowspan="1"></th>
                                        </tr>
                                    </tbody>
                                    
                                </table>
                                
                            </div>  
                        
                        
                    </div>
                    </div>
                </div>
                </div>
                
                
                <!-- /.content -->
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
