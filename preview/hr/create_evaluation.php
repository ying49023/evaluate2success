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
            if (isset($_GET["term"]) && isset($_GET["year"])) {
                $term = $_GET["term"];
                $year = $_GET["year"];

                $sql_evaluation = "insert into evaluation(company_id,term_id,year,open_system_date,close_system_date,current_eval) values(1,$term,$year,'0000-00-00','0000-00-00',1)";
                $query_evaluation = mysqli_query($conn, $sql_evaluation);


                $eval_code = '';
                $sql_eval_id = "select max(e.evaluation_code) as code from evaluation e  join term t on e.term_id=t.term_name";
                $query_eval_id = mysqli_query($conn, $sql_eval_id);

                $result_eval_id = mysqli_fetch_array($query_eval_id, MYSQLI_ASSOC);
                $_SESSION["eval_id"] = $result_eval_id['code'];
                
                if($eval_code != ''){
                    echo $eval_code;
                    header("location:explan_evaluation.php");
                }           

            }
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
                        สร้างการประเมิน
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Edit profile</li>
                    </ol>
                </section>
                <!--/Page header -->

                <!-- Main content -->
                
                <div class="row box-padding">
                    <div class="box box-success">
                        <div class="box-body" style="padding: 80px 0px 80px 0px;">
                            <form action="new_evaluation.php" method="post">
                                <div class="row box-padding">
                                    <div class="col-md-offset-2 col-sm-4">
                                            <label class=" control-label">ปี</label>

                                            <select class="form-control " name="year" >
                                                <option value="">--เลือกปี--</option>
                                                <?php for($i=2015;$i<=2020;$i++){ echo "<option value='$i'>$i</option>" ; } ?>                                         
                                            </select>
                                    </div> 

                                    <div class="col-md-4">
                                        <label class=" control-label">รอบการประเมิน</label>
                                                <?php
                                                $slq_term = "SELECT term_id,term_name,start_month,end_month
                                                            FROM term";
                                                $query_term = mysqli_query($conn, $slq_term);
                                                ?>
                                        <select class="form-control " name="term" >
                                            <option value="">--เลือกรอบการประเมิน--</option>
                                                    <?php
                                                    while ($result_term = mysqli_fetch_array($query_term, MYSQLI_ASSOC)) {
                                                        $term_name = $result_term['term_name'];
                                                        $term_date = $result_term['start_month'] . '-' . $result_term['end_month'];
                                                        $term_id = $result_term['term_id'];
                                                        ?>
                                            ?>
                                            <option value="<?php echo $term_name; ?>">เทอม<?php echo $term_name . ' ( '; ?><?php echo $term_date . ' )'; ?></option>
                                                <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row box-padding" style="margin-top: 20px;">
                                    <div class="col-md-2"></div>
                                    <div class=" col-md-4" >
                                        <a class="btn btn-warning " data-toggle="modal" data-target="#history" style="width: 100%;" ><i class="glyphicon glyphicon glyphicon-list"></i> &nbsp; ประวัติย้อนหลัง</a>
                                    </div>
                                    <div class=" col-md-4" >
                                        <button  type="submit" class="btn btn-success " style="width: 100%;" ><i class="glyphicon glyphicon glyphicon-triangle-right"></i> &nbsp; สร้างแบบประเมิน</button>
                                    </div>
                                </div>
                                
                            </form>
                            <!-- Show รอบการประเมินที่ Active อยู่ current eval = 1 -->
                            <hr>
                            <div class="row box-padding">
                                <div class="col-sm-offset-1 col-sm-10">
                                   
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>รอบการประเมิน</th>
                                            <th>วันเปิด</th>
                                            <th>วันปิด</th>
                                            <th class="text-center">สถานะ</th>
                                            <th class="text-center">แก้ไข</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    $sql_active_eval = "SELECT evaluation_code,current_eval, term_id as term,year,DATE_FORMAT(open_system_date,'%d/ %m/ %Y') as open_system_date ,DATE_FORMAT(close_system_date,'%d/ %m/ %Y') as close_system_date from evaluation where current_eval=1  ";
                                    $query_active_eval = mysqli_query($conn, $sql_active_eval);
                                    
                                    while ($result_active_eval = mysqli_fetch_array($query_active_eval, MYSQLI_ASSOC)) {                                    
                                        ?>
                                        <tr>
                                            <td><?php echo $result_active_eval["term"]; ?> / <?php echo $result_active_eval["year"]; ?></td>
                                            <td><?php echo $result_active_eval["open_system_date"]; ?></td>
                                            <td><?php echo $result_active_eval["close_system_date"]; ?></td>
                                            <td class="text-center"><span style="color:green;">เปิดรอบการประเมิน</span></td>
                                            <td class="text-center">
                                                <a class="btn btn-primary" href="explan_evaluation.php?eval_code=<?php echo $result_active_eval["evaluation_code"]; ?>" ><i class="glyphicon glyphicon-edit"></i>&nbsp; แก้ไข</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                            <!-- /Show รอบการประเมินที่ Active อยู่ current eval = 1 -->
                            
                            <!--History -->
                            <div class="modal fade" id="history" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-yellow">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">ข้อมูลการประเมินย้อนหลัง</h4>
                                        </div>
                                        <div class="modal-body">                                           
                                            <?php
                                            $sql_history_eval = "SELECT term_id as term,year,DATE_FORMAT(open_system_date,'%d/ %m/ %Y') as open_system_date ,DATE_FORMAT(close_system_date,'%d/ %m/ %Y') as close_system_date from evaluation where current_eval=0 ORDER BY year,term ";
                                            $query_history_eval = mysqli_query($conn, $sql_history_eval);
                                            
                                            ?>    
                                            <table class="table table-hover">
                                                        <tr>

                                                            <th>รอบการประเมิน</th>
                                                            <th>วันเปิด</th>
                                                            <th>วันปิด</th>
                                                            <th class="text-center">สถานะ</th>

                                                        </tr>
                                                        <?php while ($result_history_eval = mysqli_fetch_array($query_history_eval, MYSQLI_ASSOC)) { ?>
                                                            <tr>

                                                                <td>ปี <?php echo $result_history_eval["year"]; ?> | รอบการประเมินที่ <?php echo $result_history_eval["term"]; ?></td>
                                                                <td><?php echo $result_history_eval["open_system_date"]; ?></td>
                                                                <td><?php echo $result_history_eval["close_system_date"]; ?></td>
                                                                <td class="text-center"><span style="color:maroon;">ปิดรอบการประเมิน</span></td>
                                                            </tr>



                                                        <?php } ?>
                                                    </table>
                                        </div>
                                        <div class="modal-footer">
                                            
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/History-->
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
