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

        <!-- SCRIPT PACKS -->
        <?php include('./script_packs.html') ?>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <!--Header part-->
            <?php include './headerpart.php'; ?>
            

            <!-- Content Wrapper. Contains page content แก้เนื้อหาแต่ละหน้าตรงนี้นะ -->
            <div class="content-wrapper">

                <!-- Content Header (Page header)  -->
                <section class="content-header">
                    <h1>
                        เปรียบเทียบผลการประเมินย้อนหลัง
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Comparision</li>
                    </ol>
                </section>
                <!--/Page header -->

                <!-- Main content -->
                <div class="row box-padding">
                    <div class="box box-success">
                        <div class="box-header ">
                            <form >
                                <div class="col-sm-5">
                                    <label class="col-sm-6 control-label">ปีการประเมิน</label>
                                    <div class="col-sm-6">
                                        <select class="form-control ">
                                            <option>2013</option>
                                            <option>2014</option>
                                            <option>2015</option>
                                            <option>2016</option>
                                        </select>
                                    </div>
                                </div> 

                                <div class="col-md-5 ">
                                    <label class="col-sm-7 control-label">รอบการประเมิน</label>
                                    <div class="col-sm-5">
                                        <select class="form-control">
                                            <option>ครั้งที่ 1 </option>
                                            <option>ครั้งที่ 2 </option>
                                        </select>
                                    </div>                               
                                </div>
                                <div class="col-md-2 ">
                                    <button class="btn btn-success search-button" type="submit">เพิ่ม +</button>
                                </div>

                            </form>
                            <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"> <i class="fa fa-minus"></i>
                                    </button>
                                    
                                </div>
                        </div>
                        <div class="box-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td>ลำดับ</td>
                                        <td>ปี/ครั้งการประเมิน</td>
                                    </tr>    
                                </thead>
                                
                                <tr>
                                    <td>1</td>
                                    <td><a href="">ปี 2559 ครั้งที่ 1</a></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><a href="">ปี 2558 ครั้งที่ 1</a></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><a href="">ปี 2557 ครั้งที่ 1</a></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><a href=""></a></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    window.onload = function () {
                        var chart = new CanvasJS.Chart("chartContainer",
                        {
                            title:{
                                text: "เปรียบเทียบผลการประเมิน"
                            },

                            data: [
                            {
                                type: "bar",

                                dataPoints: [
                                { x: 10, y: 4, label:"2/2559" },
                                { x: 20, y: 4.6, label:"2/2558" },
                                { x: 30, y: 3.51, label:"2/2557" },
                                { x: 40, y: 0, label:"-" },
                                
                                ]
                            }
                            ]
                        });

                        chart.render();
                    }
                </script>
                <div class="row box-padding">
                    <div class="box box-primary">

                        <div class="box-body box-padding-small row">
                            <div class="col-md-4">
                                <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                            </div>  
                            <div class="col-md-8">
                                <h3>
                                    <i class="glyphicon glyphicon-info-sign text-blue"></i>
                                    คำอธิบาย : สรุปการประเมินผลการปฏิบัติงานโดยรวม (ระดับการประเมิน)
                                </h3>
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr class="bg-gray">
                                            <th width="160px">เกรด</th>
                                            <th width="80px">คะแนน</th>
                                            <th>คำนิยาม (Definition)</th>
                                        </tr>
                                    </thead>
                                    
                                    <tr>
                                        <td><b>A+</b> : Outstanding (ดีเลิศ)</td>
                                        <td>4.26 - 5.00</td>
                                        <td>ความสามารถและผลการปฏิบัติงานสูงกว่าเป้าหมายที่กำหนดไว้เกินคาด</td>
                                    </tr>
                                    <tr>
                                        <td><b>A</b>   : Very Good (ดีมาก)</td>
                                        <td>3.26 - 4.25</td>
                                        <td>    ความสามารถและผลการปฏิบัติงานสูงกว่าเป้าหมายที่กำหนดไว้</td>
                                    </tr>
                                    <tr>
                                        <td><b>B</b>   : Good (ดี)</td>
                                        <td>2.01 - 3.25</td>
                                        <td>ความสามารถและผลการปฏิบัติงานบรรลุตามเป้าหมายที่กำหนดไว้</td>
                                    </tr>
                                    <tr>
                                        <td><b>C</b>   : Acceptable (พอใช้)</td>
                                        <td>1.01 - 2.00</td>
                                        <td>    ความสามารถและผลการปฏิบัติงานบรรลุตามเป้าหมายที่กำหนดไว้บางส่วน</td>
                                    </tr>
                                    <tr>
                                        <td><b>D</b>   : Need Improved (ต้องปรับปรุง)</td>
                                        <td>ต่ำกว่า 1</td>
                                        <td>    ความสามารถและผลการปฏิบัติงานไม่บรรลุตามเป้าหมายที่กำหนดไว้</td>
                                    </tr>
                                </table>
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
    <!-- Left side column. contains the logo and sidebar -->
            <?php include './sidebarpart.php'; ?>
</html>
<?php
        }
    }
?>
