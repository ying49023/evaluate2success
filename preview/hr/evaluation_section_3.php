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
                            <h4><b>ส่วนที่ 3 : การปฏิบัติตามกฎระเบียบและข้อบังคับของบริษัท </b></h4>
                        </div>
                        <div class="box-body ">
                            <div class="box-padding-small">
                                <h4><u>ส่วนที่ 3.1</u> เวลาการทำงาน (Time Attendance)</h4>
                            </div>
                            <!--Table leave -->
                            <div class="row box-padding-small">
                                <div class="col-sm-offset-1 col-sm-10">
                            <table class="table table-hover table-striped table-bordered">
                                <thead class="table-active">

                                    <tr class="bg-info">
                                        <th colspan="5">เวลาการทำงาน </th>
                                       
                                    </tr>

                                    <tr align="center">
                                        <th></th>
                                        <th class="text-center">ประเภทวันลา</th>
                                        <th class="text-center">จำนวนวันลา</th>
                                        <th class="text-center">คะแนนต่อครั้ง</th>
                                        <th class="text-center">คะแนนวันลา</th>
                                    </tr>
                                </thead>
                                <tbody>
                                            <?php
                                            $sql_leave_type = "SELECT * FROM leaves_type";
                                            $query_leave_type = mysqli_query($conn, $sql_leave_type);
                                                
                                            while ($result_leave_type = mysqli_fetch_array($query_leave_type)) {
                                                ?>
                                    <tr>
                                        <th class="text-center" ><?php echo $result_leave_type["leave_type_id"]; ?></th>
                                        <th class="text-center" ><?php echo $result_leave_type["leave_type_description"]; ?></th>
                                        <td class="text-center" >
                                            <input class="text-center" type="number"  name="no_of_day" min="1" max="365" value="" disabled > วัน
                                        </td>
                                        <td class="text-center" ><?php echo $result_leave_type["point"]; ?></td>
                                        <td class="text-center">
                                            <input class="text-center" type="number"  name="point" min="0.5" max="60" value="" disabled > คะแนน
                                        </td>
                                    </tr>
                                            <?php } ?>
                                </tbody>
                                <tfoot>

                                    <tr class="bg-info">
                                        <td class="text-center" colspan="2"><b>รวม</b></td>
                                        <td class="text-center"><input class="text-center" type="number"  name="leave" min="1" max="365" value="" disabled readonly>วัน</td>
                                        <td></td>
                                        <td class="text-center"><input class="text-center" type="number"  name="point" min="0.5" max="60" value="" disabled readonly>คะแนน</td>
                                    </tr>
                                </tfoot>
                                
                            </table>
                                </div>
                            </div>
                            <!--/Table leave -->
                            <div class="box-padding-small">
                                <h4><u>ส่วนที่ 3.2</u> การพิจารณาความดี ความชอบ และการลงโทษทางวินัย</h4>
                            </div>
                            <div class="row">
                                <div class="col-md-offset-1 col-md-10 box-padding-small">
                                    <table class="table table-bordered table-striped">
                                        <thead class="bg-success">
                                            <tr>
                                                <th colspan=2><u>ประวัติการได้รับรางวัล / ยกย่อง</u></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                
                                                <tr >
                                                    <th  class="text-center" colspan="2">ไม่มีข้อมูลรางวัล </th>
                                                </tr>
                                                
                                    </table>
                                </div>
                                <div class="col-md-offset-1 col-md-10 box-padding-small">
                                    <table class="table table-bordered table-striped">
                                        <thead class="bg-danger">
                                            <tr>
                                                <th colspan="2"><u>ประวัติการลงโทษทางวินัย</u></th>
                                                <th class="text-center">คะแนน</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <tr >
                                                    <th  class="text-center" colspan="3">ไม่มีข้อมูลรางวัล </th>
                                                </tr>


                                                <tr class="bg-danger">
                                                    <th class="text-center" colspan="2"> รวม </th>
                                                    <th class="text-center"></th>
                                                </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <hr>
                            
                            <form method="post">
                            <div class="row">
                                <div class="col-md-offset-1 col-md-10">
                                    <table class="table table-striped " >
                                        <thead class="bg-light-blue-active">
                                            <tr>
                                                <th class="text-center">คะแนนเวลาการทำงาน</th>
                                                <th></th>
                                                <th class="text-center">คะแนนการลงโทษทางวินัย</th>
                                                <th></th>
                                                <th class="text-center">คะแนนเต็มรวม(10 คะแนน)</th>
                                            </tr>
                                        </thead>
                                        <tbody class="">
                                            <tr class="" style="background-color:#E3F2FD ;font-size: 20px;font-weight: 800;padding: 10px;">
                                                <td class="text-center" ></td>
                                                <td class="text-center"> + </td>
                                                <td class="text-center"></td>
                                                <td> = </td>
                                                <td class="text-center" ></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-offset-2 col-md-8">
                                    <h4><u>ความคิดเห็นของผู้บังคับบัญชาตามสายงาน (ตามข้อเท็จจริง ตามข้อ 3.1, 3.2)</u></h4>
                                    <div>
                                        <textarea class="form-control" name="comment1" size="60" rows="5" placeholder="เขียนความเห็น(ตามข้อเท็จจริง ตามข้อ 3.1, 3.2)" disabled></textarea>
                                    </div>         
                                            
                                </div>
                                <div class="col-md-offset-1 col-md-10">
                                            <div class="form-group box-padding  text-center">

                                                <a class="btn btn-success btn-lg " href="evaluation_section_4.php?eval_code=<?php echo $eval_code; ?>" id="btncheck"  name="submit"><i class="glyphicon glyphicon-play-circle"></i> &nbsp; หน้าถัดไป - ส่วนที่ 4 : KPIs</a>
                                            </div>   
                                </div>
                                </div>
                            </form>                            
                                        
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
