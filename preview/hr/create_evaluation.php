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
                $eval_code = $result_eval_id['code'];
                
                if($eval_code != ''){
                    echo $eval_code;
                    header("location:explan_evaluation.php?eval_id=$eval_code");
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
                            <form action="" method="get">
                                <div class="row">
                                    <div class="col-md-offset-1 col-sm-4">
                                            <label class=" control-label">ปี</label>

                                            <select class="form-control " name="year" >
                                                <option value="">--เลือกปี--</option>
                                                <?php for($i=2015;$i<=2020;$i++){ echo "<option value='$i'>$i</option>" ; } ?>                                         
                                            </select>
                                    </div> 

                                    <div class="col-md-6">

                                            <label class=" control-label">รอบการประเมิน</label>
                                            <?php
                                                $slq_term ="SELECT term_id,term_name,start_month,end_month
                                                            FROM term";
                                                $query_term = mysqli_query($conn, $slq_term);
                                            ?>
                                            <select class="form-control " name="term" >
                                                <option value="">--เลือกรอบการประเมิน--</option>
                                                <?php while ($result_term = mysqli_fetch_array($query_term,MYSQLI_ASSOC)){
                                                    $term_name= $result_term['term_name'];
                                                    $term_date= $result_term['start_month'].'-'.$result_term['end_month'];
                                                    $term_id=$result_term['term_id'];
                                                ?>
    ?>
                                                <option value="<?php echo $term_name;?>">เทอม<?php echo $term_name.' ( ';?><?php echo $term_date.' )';?></option>
                                                <?php } ?>
                                            </select>
                                    </div>
                                </div>
                                <div class="row box-padding">
                                    <div class="col-md-offset-4 col-md-4" >
                                        <button  type="submit" class="btn btn-primary " style="width: 100%;" ><i class="glyphicon glyphicon glyphicon-triangle-right"></i> &nbsp; สร้างแบบประเมิน</button>
                                    </div>
                                </div>
                                
                            </form>
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
