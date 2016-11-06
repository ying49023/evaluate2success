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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ระบบประเมินผลปฏิบัติงาน : ALT Evaluation</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!--CSS PACKS -->
    <?php include ('./css_packs.html'); ?>
    <!--ListJS-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.2.0/list.min.js"></script>
    <?php
        
        
        $eval = ' eval_code = 3';
        $get_eval_code = '3';
        if(isset($_GET["eval_code"])){
            $get_eval_code = $_GET["eval_code"];
            $eval = " eval.evaluation_code = '".$get_eval_code ."'";
        }
        
       // $condition = 'WHERE eval.evaluation_code = 3 ';
        
?>
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
                    รายงานประจำปีสำหรับแผนกฝ่ายบุคคล
                    
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="#"> <i class="fa fa-dashboard"></i>
                            Home
                        </a>
                    </li>
                    <li class="active">Dashboard</li>
                </ol>
            </section>
            <!--/Page header -->

            <!-- Main content -->
            <!-- Filter tab-->
            <div class="row box-padding">
                <div class="box box-success">
                     <div class="box-body ">
                            <form method="get">
                                <div class="col-md-10">
                                    <label class="col-sm-2 control-label">รอบ</label>
                                    <div class="col-sm-8">
                                    <?php 
                                        $sql_eval = "SELECT * FROM evaluation ORDER BY year , term_id ASC";
                                        $query_eval = mysqli_query($conn, $sql_eval);
                                    ?>
                                        <select class="form-control" name="eval_code">
                                            <!--<option value="">เลือกทั้งหมด</option>-->
                                        <?php while($result_eval = mysqli_fetch_array($query_eval,MYSQLI_ASSOC)) { ?>
                                            <option value="<?php echo $result_eval["evaluation_code"]; ?>" <?php if($get_eval_code == $result_eval["evaluation_code"]) { echo "selected"; }  ?> >
                                                <?php echo 'ปี '.$result_eval["year"]." - ครั้งที่".$result_eval["term_id"]; ?>
                                            </option>
                                        <?php } ?>
                                        </select>
                                    </div>
                                </div>                                
                                
                                <div class=" col-md-2">
                                    <input type="submit" class="btn btn-primary search-button " value="ค้นหา" >
                                </div>

                            </form>
                        </div>
                </div>
            </div>
            <!-- /Filter tab-->
            
            <!--Table-->
            <div class="row box-padding">
                <div class="box box-primary">
                    <div class="box-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>

                                    <th>รายการ</th>
                                    <th>ดูรายละเอียด</th>
                                   
                                </tr>
                            </thead>
                            <tr>

                                <td>รายงานผลการประเมินผลการปฏิบัติงานทั่วทั้งองค์การ(ส่วนของเกรด)</td>
                                <td>
                                    <a href="hr_report_grade.php?eval_code=<?php echo $get_eval_code; ?>">    
                                        <center><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></center>
                                    </a>
                                </td>
                                
                            </tr>
                            <tr>

                                <td>แบบประเมินรายบุคคล</td>
                                <td>
                                    <a href="hr_report_individual.php?eval_code=<?php echo $get_eval_code; ?>">    
                                        <center><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></center>
                                    </a>
                                </td>
                                
                            </tr>
                            
                           <!-- <tr>

                                <td>รายงานการพัฒนา ฝึกอบรมประจำปี</td>
                                <td>
                                    <a href="hr_report_grade.php">    
                                        <center><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></center>
                                    </a>
                                </td>
                                <td class="text-center"><button class=" btn btn-danger btn-sm glyphicon glyphicon-export ">&nbsp;PDF</button>&nbsp;
                                    <button class=" btn btn-success btn-sm glyphicon glyphicon-export ">&nbsp;EXCEL</button>
                                </td>
                            </tr>
                            <tr>

                                <td>รายงานด้านเงินเดือนค่าจ้าง โบนัส ประจำปี</td>
                                <td>
                                    <a href="hr_report_grade.php">    
                                        <center><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></center>
                                    </a>
                                </td>
                                <td class="text-center"><button class=" btn btn-danger btn-sm glyphicon glyphicon-export ">&nbsp;PDF</button>&nbsp;
                                    <button class=" btn btn-success btn-sm glyphicon glyphicon-export ">&nbsp;EXCEL</button>
                                </td>
                            </tr>
                            <tr>

                                <td>รายงานสถิติพนักงานจำแนกตามหน่วยงาน การขาด ลา มาสาย การหยุดงาน ประจำปี</td>
                                <td>
                                    <a href="hr_report_grade.php">    
                                        <center><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></center>
                                    </a>
                                </td>
                                <td class="text-center"><button class=" btn btn-danger btn-sm glyphicon glyphicon-export ">&nbsp;PDF</button>&nbsp;
                                    <button class=" btn btn-success btn-sm glyphicon glyphicon-export ">&nbsp;EXCEL</button>
                                </td>

                            </tr>
                            
                            <tr>

                                <td>รายงานผลการปฏิบัติงานตามตัวชี้วัดความสำเร็จที่กำหนดไว้(ส่วนที่4 KPIs)</td>
                                <td>
                                    <a href="">    
                                        <center><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></center>
                                    </a>
                                </td>
                                <td class="text-center"><button class=" btn btn-danger btn-sm glyphicon glyphicon-export ">&nbsp;PDF</button>&nbsp;
                                    <button class=" btn btn-success btn-sm glyphicon glyphicon-export ">&nbsp;EXCEL</button>
                                </td>
                            </tr>
                           -->
                        </table>
                    </div>
                </div>

            </div>
            <!--/Table
            <!-- /.content --> </div>
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