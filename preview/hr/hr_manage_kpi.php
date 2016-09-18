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
    
    $get_emp_id = "1"; //ตั้งค่า Default = 1 ไว้เพื่อไม่ให้เกิด ERROR ในการ Query SQL
        //เงื่อนไขนี้เป็นการเช็คว่ามีส่งมาไหม
        if (isset($_GET["emp_id"])) {
            $get_emp_id = $_GET["emp_id"]; //GET ค่ามาจากหน้า hr_kpi_individual.php ผ่านลิงค์ 
        }
        $get_eval_code = ''; //ตั้งค่า Default = 1 ไว้เพื่อไม่ให้เกิด ERROR ในการ Query SQL
        //เงื่อนไขนี้เป็นการเช็คว่ามีส่งมาไหม
        if (isset($_GET["eval_code"])) {
            $get_eval_code = $_GET["eval_code"]; //GET ค่ามาจากหน้า hr_kpi_individual.php ผ่านลิงค์ 
        }
        ?>
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
                    กำหนดKPIs
                    <small>รอบที่ 1 2559</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="#"> <i class="fa fa-dashboard"></i>
                            Home
                        </a>
                    </li>
                    <li class="active">Assign KPIs</li>
                </ol>
            </section>
            <!--/Page header -->

            <!-- Main content -->
            <div class="row box-padding">
                <div class="box box-success">
                            <?php
                            $sql_emp = "SELECT
                                                    GROUP_CONCAT(e.prefix,e.first_name,'  ',e.last_name) as emp_name,e.hiredate , e.*, p.*,j.*,d.*,
                                                    GROUP_CONCAT(m.prefix,m.first_name,'  ',m.last_name) as manager_name_1,
                                                    GROUP_CONCAT(m2.prefix,m2.first_name,'  ',m2.last_name) as manager_name_2
                                            FROM
                                                    employees e
                                            JOIN position_level p ON p.position_level_id = e.position_level_id
                                            JOIN departments d ON d.department_id = e.department_id
                                            JOIN jobs j ON j.job_id = e.job_id
                                            JOIN employees m ON e.manager_id = m.employee_id
                                            JOIN employees m2 ON m.manager_id = m2.employee_id
                                            WHERE
                                                    e.employee_id ='" . $get_emp_id . "'";
                            $query_emp = mysqli_query($conn, $sql_emp);
                            while ($result_emp = mysqli_fetch_array($query_emp, MYSQLI_ASSOC)) {
                                ?>
                                <div class="box-header">
                                    <div class="col-md6">


                                        <div style="float: right;">
                                            <img class='img-circle img-sm img-center' src="../upload_images/<?php if ($result_emp["profile_picture"] == '') {
                        echo 'default.png';
                    } else {
                        echo $result_emp["profile_picture"];
                    } ?>"  > <span span style="font-size:18px"><?php echo "&nbsp;&nbsp;" . $result_emp["employee_id"] . ' : ' . $result_emp["emp_name"]; ?></span>
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"> <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <div col-md-6>
                                            <div style="float: left;">
                                                <?php
                                                $eval_code = '';
                                                if (isset($_GET["eval_code"])) {
                                                    $eval_code = $_GET["eval_code"];
                                                }

                                                $sql_year_term = "SELECT * FROM evaluation e JOIN term t ON e.term_id=t.term_id WHERE evaluation_code = '$eval_code'";
                                                $query_year_term = mysqli_query($conn, $sql_year_term);
                                                while ($result_year_term = mysqli_fetch_array($query_year_term, MYSQLI_ASSOC)) {
                                                    $eval_year = $result_year_term["year"];
                                                    $eval_term = $result_year_term["term_name"] . " : " . $result_year_term["start_month"] . "-" . $result_year_term["end_month"];
                                                    echo "<span style='font-size:18px'><b>ปีการประเมิน " . $eval_year . "</b></span> | ";
                                                    echo "<span style='font-size:18px'>รอบการประเมินที่ " . $eval_term . "</span>";
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                                <div class="box-body">
                                    <table class="table table-bordered table-striped table-responsive">

                                        <tr >
                                            <th rowspan="4" style="text-align: center;">
                                                <img class="img-center img-thumbnail" style="height: 130px;max-width: 110px;" src="../upload_images/<?php
                                                if ($result_emp["profile_picture"] == '') {
                                                    echo "default.png";
                                                } else {
                                                    echo $result_emp["profile_picture"];
                                                }
                                                ?>" >
                                            </th>
                                            <th>ชื่อ-นามสกุล</th>
                                            <th>รหัส</th>
                                            <th>ระดับ</th>
                                        </tr>
                                        <tr>
                                            <td><?php echo $result_emp["emp_name"]; ?> </td>
                                            <td><?php echo $result_emp["employee_id"]; ?></td>
                                            <td><?php echo $result_emp["position_description"]; ?> </td>
                                        </tr>
                                        <tr>
                                            <th>ตำแหน่ง</th>
                                            <th>สังกัด / ฝ่าย / สายงาน</th>
                                            <th>วันเริ่มงาน: </th>
                                        </tr>
                                        <tr>
                                            <td><?php echo $result_emp["job_name"]; ?></td>
                                            <td><?php echo $result_emp["department_name"]; ?></td>
                                            <td><?php echo $result_emp["hiredate"]; ?> <span style="color:maroon;"></span> </td>
                                        </tr>
                                        <tr>
                                            <th class="text-center">วันที่ประเมิน</th>
                                            <th>ชื่อ - นามสกุลของผู้ประเมินที่ 1</th>
                                            <th>ชื่อ - นามสกุลของผู้ประเมินที่ 2</th>
                                            <th>ระยะเวลาประเมินผล</th>
                                        </tr>
                                        <tr>
                                            <td class="text-center"> - </td>
                                            <td><?php echo $result_emp["manager_name_1"]; ?></td>
                                            <td><?php echo $result_emp["manager_name_2"]; ?></td>
                                            <td>
                                                <?php
                                                $sql_eval_period = "SELECT * FROM evaluation WHERE evaluation_code = '$eval_code' ";
                                                $query_eval_period = mysqli_query($conn, $sql_eval_period) or die(mysqli_errno());
                                                $result_eval_period = mysqli_fetch_array($query_eval_period, MYSQLI_ASSOC);
                                                ?>
            <?php echo $result_eval_period["open_system_date"]; ?>  ถึง <?php echo $result_eval_period["close_system_date"]; ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                            <?php
                        }
                        ?> 
                        </div>
            </div>
            <div class="row box-padding" style="margin-top: -20px;">
                <h3>KPIs สำหรับการประเมินในรอบ ม.ค. - มิ.ย. 59</h3>
            </div>
            <div class="row box-padding">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <b>เพิ่ม และ แก้ไขข้อ KPI</b>
                        <button class="btn btn-success pull-right"  data-toggle="collapse" data-target="#newNextKPI">+ เพิ่ม</button>
                    </div>
                    <div id="newNextKPI" class="collapse">
                        <form action="new_assign_kpi.php" method="post">
                        <div class="box-padding row">
                            <div class="form-group col-sm-5">
                                <label>ชื่อ KPI</label>
                                <?php
                                $sql_kpi = "SELECT * FROM kpi";
                                $query_kpi = mysqli_query($conn, $sql_kpi);
                                ?>

                                <select class="form-control " name="kpi_id" required >

                                    <option>เลือกkpi </option>
                                    <?php while ($result_kpi = mysqli_fetch_array($query_kpi, MYSQLI_ASSOC)) { ?>
                                    <option value="<?php echo $result_kpi["kpi_id"]; ?>"><?php echo $result_kpi["kpi_id"]." - ".$result_kpi["kpi_name"]; ?></option>
                                    <?php } ?>

                                </select>
                            </div>
                            <div class="form-group col-sm-3">
                                <label>น้ำหนัก(%)</label>
                                <input class="form-control" type="number"  step="5" name="weight" required > 
                            </div>
                            <div class="form-group col-sm-3">
                                <label>เป้าหมาย</label>
                                <input class="form-control" type="text"  name="goal" required> 
                            </div>
                            
                            <div class="form-group col-sm-1">
                                <input style="margin-top: 25px;" class="btn btn-danger" type="submit"  name="submit" value="บันทึก" > 
                                <input  type="hidden" name="emp_id" value="<?php echo $get_emp_id; ?>" >
                            </div>
                        </div>
                        </form>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr class="bg-primary  ">
                                <td>รหัส</td>
                                <td>ชื่อตัวชี้วัด</td>
                                <td>คำอธิบาย</td>
                                <td width="60px">น้ำหนัก</td>
                                <td width="70px">เป้าหมาย</td>
                                <td width="120px">การจัดการ</td>
                            </tr>
                            <?php
//                            $sql_next_kpi = "SELECT k.kpi_id as kpi_id, k.kpi_name as kpi_name,k.kpi_description as kpi_description, nrk.weight as weight, nrk.goal as goal
//                                            FROM evaluation_next_kpi enk 
//                                            JOIN next_responsible_kpi nrk ON enk.evaluate_next_kpi_id = nrk.evaluate_next_kpi_id 
//                                            JOIN kpi k ON nrk.kpi_id = k.kpi_id
//                                            WHERE nrk.evaluate_next_kpi_id = (SELECT enk.evaluate_next_kpi_id 
//                                                                              FROM evaluation_next_kpi enk 
//                                                                              JOIN evaluation_employee ee ON enk.evaluate_employee_id = ee.evaluate_employee_id 
//                                                                              WHERE ee.employee_id = '".$get_emp_id."')";
                            $sql_next_kpi = "SELECT
                                    k.kpi_code AS kpi_id,
                                    k.kpi_name AS kpi_name,
                                    k.kpi_description As kpi_description,
                                    k.unit As unit,
                                    kr.percent_weight AS weight,
                                    kr.goal AS goal,
                                    kr.success AS success,
                                    e.term_id AS term,
                                    e.YEAR AS year,
                                    k.measure_symbol AS symbol,
                                    kr.percent_performance,
                                    kr.kpi_responsible_id
                            FROM
                                    kpi k
                            JOIN kpi_responsible kr ON k.kpi_id = kr.kpi_id
                            JOIN evaluation_employee ee ON ee.evaluate_employee_id = kr.evaluate_employee_id
                            JOIN evaluation e ON ee.evaluation_code = e.evaluation_code
                            WHERE
                                    ee.employee_id = '$get_emp_id' AND e.evaluation_code = '$get_eval_code'
                            ORDER BY
                                    kpi_id";
                            $query_next_kpi = mysqli_query($conn, $sql_next_kpi);
                            $count = mysqli_num_rows($query_next_kpi);
                            if($count == 0){
                                echo "<th class='text-center' colspan='6'> ไม่มีการกำหนด KPI สำหรับปีการประเมิน ". $eval_year.' รอบการประเมินที่ '.$eval_term ." </th>";
                            }
                            while ($result_next_kpi = mysqli_fetch_array($query_next_kpi,MYSQLI_ASSOC)) {
                                $sql_unit = "SELECT unit FROM kpi WHERE kpi_id = '".$result_next_kpi["kpi_id"]."'" ;
                                $query_unit = mysqli_query($conn, $sql_unit);
                                $result_unit = mysqli_fetch_array($query_unit);
                            ?>
                            <tr>
                                <td><?php echo $result_next_kpi["kpi_id"]; ?></td>
                                <td><?php echo $result_next_kpi["kpi_name"]; ?></td>
                                <td>
                                    <?php echo $result_next_kpi["kpi_description"]; ?>
                                </td>
                                <td><?php echo $result_next_kpi["weight"]."%"; ?></td>
                                <td><?php echo $result_next_kpi["goal"]." ".$result_unit["unit"] ; ?></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit_<?php echo $result_next_kpi["kpi_id"]; ?>">
                                        <i class="glyphicon glyphicon-pencil" ></i>
                                    </button> 
                                    |
                                    <a class="btn btn-danger btn-sm" href="delete_assign_kpi.php?kpi_id=<?php echo $result_next_kpi["k.kpi_id"]."&emp_id=". $get_emp_id; ?>" >
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <!-- Modal -->    
                            <div class="modal animated fade " id="edit_<?php echo $result_next_kpi["kpi_id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
                                <div class="modal-dialog" role="document">
                                    <form action="update_next_kpi.php" method="post" >
                                        <div class="modal-content">
                                            <div class="modal-header bg-blue">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">แก้ไขหัวข้อ</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row box-padding">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                
                                                                <label>ชื่อตัวชี้วัด</label>
                                                                <input class="form-control" type="text" name="kpi_name" value="<?php echo $result_next_kpi["kpi_name"]; ?>" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>น้ำหนัก(%)</label>
                                                                <input class="form-control" type="number" name="weight" step="5" value="<?php echo $result_next_kpi["weight"]; ?>" >
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6" >
                                                            <div class="form-group">
                                                                <label>เป้าหมาย</label>
                                                                <input class="form-control" type="text" name="goal" value="<?php echo $result_next_kpi["goal"]; ?>" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input class="btn btn-success" type="submit" name="submit" value="บันทึก" >
                                                <input type="hidden" name="emp_id" value="<?php echo $emp_id; ?>" >
                                                <input type="hidden" name="next_responsible_kpi_id" value="<?php echo $result_next_kpi["next_responsible_kpi_id"]; ?>" >
                                                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                            </div>
                                                                    
                                        </div>
                                    </form>
                                </div>
                            </div>   
                            <!--Modal-->
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>

            </div>
            <!--สำรอง-->
            <!--            <div class="row box-padding">
                            <div class="box box-primary">
                                <div class="box-header with-border"> <b>เพิ่มเติม/แก้ไขKPI</b>
                                </div>
                                <div class="box-body box-padding-small">
                                    <form action="">
                                        <div class="row">
                                            <div class="form-group col-sm-7">
                                                <label class="control-label pull-left">ชื่อ KPI</label>
                                                <div class="">
                                                <?php 
                                                  $sql_kpi = "SELECT * FROM kpi"; 
                                                  $query_kpi = mysqli_query($conn, $sql_kpi);

                                                ?>

                                                    <select class="form-control">

                                                        <option>เลือกkpi </option>
                                                         <?php while ($result_kpi = mysqli_fetch_array($query_kpi, MYSQLI_ASSOC)) { ?>
                                                        <option><?php echo $result_kpi["kpi_name"]; ?></option>
                                                    <?php } ?>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-2">
                                                <label class="control-label pull-left">น้ำหนัก(%)</label>
                                                    <input class="form-control" type="text">
                                            </div>
                                            <div class="form-group col-sm-3">
                                                <label class="control-label pull-left">เป้าหมาย</label>
                                                    <input class="form-control" type="text">
                                            </div>
                                            <div class="form-group col-sm-2">
                                                <label class="control-label pull-left">หน่วย</label>
                                                <input class="form-control" type="text" placeholder="(เปลี่ยนตามหัวข้อKPI)" readonly="">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <button class="btn btn-file">เพิ่ม</button>
                                                <input type="submit" class="btn btn-microsoft" value="บันทึก" />
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>-->

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