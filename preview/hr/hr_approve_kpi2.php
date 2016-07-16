<!DOCTYPE html>
<html>
<head>
    <?php include ('./classes/connection_mysqli.php'); ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ระบบประเมินผลปฏิบัติงาน : ALT Evaluation</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!--CSS PACKS -->
    <?php include ('./css_packs.html'); ?>
    <!-- SCRIPT PACKS -->
    <?php include ('./script_packs.html'); ?>
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
                    อนุมัติKPIs
                    <small>รอบที่ 2 2559</small>
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
                    <div class="box-body">
                        <div class="row"> 
                            <div class="box-padding">
                                
                                <?php
                                
                                $get_emp_id = "1"; //ตั้งค่า Default = 1 ไว้เพื่อไม่ให้เกิด ERROR ในการ Query SQL
                                
                                //เงื่อนไขนี้เป็นการเช็คว่ามีส่งมาไหม
                                if(isset($_GET["emp_id"])){
                                    $get_emp__id = $_GET["emp_id"]; //GET ค่ามาจากหน้า hr_kpi_individual.php ผ่านลิงค์ 
                                }
                                
                                
                                $sql_emp = "SELECT
                                        emp.employee_id AS emp_id,
                                        emp.first_name AS f_name,
                                        emp.last_name AS l_name,
                                        emp.hiredate AS hiredate,
                                        emp.manager_id AS manager_id,
                                        emp.email AS email,
                                        emp.telephone_no AS telephone,
                                        dept.department_name AS dept_name,
                                        pos.position_description AS pos
                                FROM
                                        employees emp
                                JOIN departments dept ON emp.department_id = dept.department_id
                                JOIN position_level pos ON emp.position_level_id = pos.position_level_id
                                WHERE emp.employee_id = '".$get_emp_id."' LIMIT 1";
                                
                                $query = mysqli_query($conn, $sql_emp); //$conn มาจากไฟล์ connection_mysqli.php เป็นตัว connect DB

                                 ?>
                                
                                <?php  while($result = mysqli_fetch_assoc($query)){ 
                                    $emp_id = $result["emp_id"];
                                    $name = $result["f_name"]."  ".$result["l_name"];
                                    $hire = $result["hiredate"];
                                    $manager_id = $result["manager_id"];
                                    $dept = $result["dept_name"];
                                    $pos = $result["pos"];
                                    $email = $result["email"];
                                    $tel = $result["telephone"];
                                    $sql_manager = "SELECT * from employees where employee_id = '".$manager_id."'" ;
                                    $query_manager = mysqli_query($conn, $sql_manager);
                                    $result_manager = mysqli_fetch_array($query_manager);
                                    $manager_name = $result_manager["first_name"]." ".$result_manager["last_name"];
                                ?>
                                <!--ข้อมูลทั่วไป-->
                                <table class="table table-bordered table-condensed">
                                    <tbody>
                                        <tr>
                                            <th rowspan="4">
                                                <img class="circle-thumbnail img-circle img-responsive img-thumbnail" src="img/emp1.jpg">
                                            </th>
                                            <th align="center" width="" >ชื่อ-นามสกุล</th>
                                            <th align="center" width="120px">รหัส</th>
                                            <th align="center" width="" >ระดับ</th>
                                            <th align="center" width="" >แผนก</th>
                                        </tr>
                                        <tr>
                                            <td><?php  echo $name ;?></td>
                                            <td><?php  echo $emp_id ;?></td>
                                            <td><?php  echo $pos ;?></td>
                                            <td><?php  echo $dept ;?></td>
                                            
                                        </tr>
                                    </tbody>
                                </table><!--/ข้อมูลทั่วไป-->
                                <a class="" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                    <i class="glyphicon glyphicon-triangle-bottom"></i>รายละเอียดบุคคลเพิ่มเติม
                                </a>
                                <div class="collapse" id="collapseExample" style="margin-top:10px;">
                                    <table class="table table-responsive table-bordered ">
                                        <thead>
                                            <tr class="text-center">
                                                <td colspan="2">วันที่เริ่มงาน</td>
                                                <td colspan="2">email</td>
                                                <td colspan="2">เบอร์โทรศัพท์</td>
                                                <td colspan="2">ผู้บังคับบัญชา</td>
                                            </tr>
                                        </thead>
                                        <tr class="text-center">
                                            <td colspan="2"><?php echo $hire ;?></td>
                                            <td colspan="2"><?php echo $email ;?></td>
                                            <td colspan="2"><?php echo $tel ;?></td>
                                            <td colspan="2"><?php echo $manager_name ; ?></td>
                                        </tr>
                                    </table>
                                    <table class="table table-responsive table-bordered ">
                                        <thead>
                                            <tr class="">
                                                <th colspan="8">
                                                    สถิติการมาปฏิบัติงาน
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>ลาป่วย</th>
                                                <th>ลากิจ</th>
                                                <th>ลาอื่นๆ</th>
                                                <th>ขาดงาน</th>
                                                <th>มาสาย</th>
                                                <th>ตักเตือนด้วยวาจา</th>
                                                <th>ตักเตือนด้วยลายลักษณ์อักษร</th>
                                                <th>ลงโทษ อื่นๆ</th>
                                            </tr>
                                        </thead>
                                        <TR class="text-center">
                                            <TD>
                                                <?php 
                                                    $sql_leave_type_1 = "SELECT COUNT(L.leave_type_id) as leave_type_1 FROM employees E 
                                                                        JOIN leaves L ON E.employee_id = L.employee_id 
                                                                        JOIN leaves_type T ON L.leave_type_id = T.leave_type_id
                                                                        WHERE E.employee_id = '".$emp_id."' AND T.leave_type_id='1'
                                                                        GROUP BY T.leave_type_id";
                                                    $query_leave_type_1 = mysqli_query($conn, $sql_leave_type_1);
                                                    $result_leave_type_1 = mysqli_fetch_array($query_leave_type_1);
                                                    
                                                    if($result_leave_type_1["leave_type_1"] == ''){
                                                        echo "0 วัน";
                                                    }else{
                                                        echo $result_leave_type_1["leave_type_1"]." วัน" ;
                                                    }
                                                    
                                                ?>
                                            </TD>
                                            <TD>
                                                <?php 
                                                    $sql_leave_type_2 = "SELECT COUNT(L.leave_type_id) as leave_type_2 FROM employees E 
                                                                        JOIN leaves L ON E.employee_id = L.employee_id 
                                                                        JOIN leaves_type T ON L.leave_type_id = T.leave_type_id
                                                                        WHERE E.employee_id = '".$emp_id."' AND T.leave_type_id='2'
                                                                        GROUP BY T.leave_type_id";
                                                    $query_leave_type_2 = mysqli_query($conn, $sql_leave_type_2);
                                                    $result_leave_type_2 = mysqli_fetch_array($query_leave_type_2);
                                                   
                                                    if($result_leave_type_2["leave_type_2"] == ''){
                                                        echo "0 วัน";
                                                    }else{
                                                        echo $result_leave_type_2["leave_type_2"]." วัน" ;
                                                    }
                                                ?>
                                            </TD>
                                            <TD>
                                                <?php 
                                                $sql_leave_type_3 = "SELECT COUNT(L.leave_type_id) as leave_type_3 FROM employees E 
                                                                    JOIN leaves L ON E.employee_id = L.employee_id 
                                                                    JOIN leaves_type T ON L.leave_type_id = T.leave_type_id
                                                                    WHERE E.employee_id = '".$emp_id."' AND T.leave_type_id='6'
                                                                    GROUP BY T.leave_type_id";
                                                $query_leave_type_3 = mysqli_query($conn, $sql_leave_type_3);
                                                $result_leave_type_3 = mysqli_fetch_row($query_leave_type_3);
                                                if ($result_leave_type_3["leave_type_3"] == '') {
                                                    echo "0 วัน";
                                                } else {
                                                    echo $result_leave_type_3["leave_type_3"] . " วัน";
                                                }
                                            ?>
                                            </TD>
                                            <TD>
                                                <?php 
                                                $sql_leave_type_4 = "SELECT COUNT(L.leave_type_id) as leave_type_4 FROM employees E 
                                                                    JOIN leaves L ON E.employee_id = L.employee_id 
                                                                    JOIN leaves_type T ON L.leave_type_id = T.leave_type_id
                                                                    WHERE E.employee_id = '".$emp_id."' AND T.leave_type_id='4'
                                                                    GROUP BY T.leave_type_id";
                                                $query_leave_type_4 = mysqli_query($conn, $sql_leave_type_4);
                                                $result_leave_type_4 = mysqli_fetch_row($query_leave_type_4);
                                                
                                                if ($result_leave_type_4["leave_type_4"] == '') {
                                                    echo "0 วัน";
                                                } else {
                                                    echo $result_leave_type_4["leave_type_4"] . " วัน";
                                                }
                                            ?>
                                            </TD>
                                            <TD>
                                                <?php 
                                                $sql_leave_type_5 = "SELECT COUNT(L.leave_type_id) as leave_type_5 FROM employees E 
                                                                    JOIN leaves L ON E.employee_id = L.employee_id 
                                                                    JOIN leaves_type T ON L.leave_type_id = T.leave_type_id
                                                                    WHERE E.employee_id = '".$emp_id."' AND T.leave_type_id='6'
                                                                    GROUP BY T.leave_type_id";
                                                $query_leave_type_5 = mysqli_query($conn, $sql_leave_type_5);
                                                $result_leave_type_5 = mysqli_fetch_row($query_leave_type_5);
                                                if ($result_leave_type_5["leave_type_5"] == '') {
                                                    echo "0 วัน";
                                                } else {
                                                    echo $result_leave_type_5["leave_type_5"] . " วัน";
                                                }
                                            ?>
                                            </TD>
                                            <TD>
                                                <?php 
                                                $sql_leave_type_6 = "SELECT COUNT(L.leave_type_id) as leave_type_6 FROM employees E 
                                                                    JOIN leaves L ON E.employee_id = L.employee_id 
                                                                    JOIN leaves_type T ON L.leave_type_id = T.leave_type_id
                                                                    WHERE E.employee_id = '".$emp_id."' AND T.leave_type_id='6'
                                                                    GROUP BY T.leave_type_id";
                                                $query_leave_type_6 = mysqli_query($conn, $sql_leave_type_6);
                                                $result_leave_type_6 = mysqli_fetch_row($query_leave_type_6);
                                                if ($result_leave_type_6["leave_type_6"] == '') {
                                                    echo "0 วัน";
                                                } else {
                                                    echo $result_leave_type_6["leave_type_6"] . " วัน";
                                                }
                                            ?>
                                            </TD>
                                            <td>
                                                <?php 
                                                $sql_leave_type_7 = "SELECT COUNT(L.leave_type_id) as leave_type_7 FROM employees E 
                                                                    JOIN leaves L ON E.employee_id = L.employee_id 
                                                                    JOIN leaves_type T ON L.leave_type_id = T.leave_type_id
                                                                    WHERE E.employee_id = '".$emp_id."' AND T.leave_type_id='7'
                                                                    GROUP BY T.leave_type_id";
                                                $query_leave_type_7 = mysqli_query($conn, $sql_leave_type_7);
                                                $result_leave_type_7 = mysqli_fetch_row($query_leave_type_7);
                                                
                                                if ($result_leave_type_7["leave_type_7"] == '') {
                                                    echo "0 วัน";
                                                } else {
                                                    echo $result_leave_type_7["leave_type_7"] . " วัน";
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                $sql_leave_type_8 = "SELECT COUNT(L.leave_type_id) as leave_type_8 FROM employees E 
                                                                    JOIN leaves L ON E.employee_id = L.employee_id 
                                                                    JOIN leaves_type T ON L.leave_type_id = T.leave_type_id
                                                                    WHERE E.employee_id = '".$emp_id."' AND T.leave_type_id='8'
                                                                    GROUP BY T.leave_type_id";
                                                $query_leave_type_8 = mysqli_query($conn, $sql_leave_type_8);
                                                $result_leave_type_8 = mysqli_fetch_row($query_leave_type_8);
                                                
                                                if ($result_leave_type_8["leave_type_8"] == '') {
                                                    echo "0 วัน";
                                                } else {
                                                    echo $result_leave_type_8["leave_type_8"] . " วัน";
                                                }
                                                ?>
                                            </td>
                                        </TR>
                                    </table>
                                </div>
                                <?php } ?>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
            <div class="row box-padding" style="margin-top: -20px;">
                <h3>KPIs สำหรับการประเมินในรอบ ก.ค.-ธ.ค. 59</h3>
            </div>
            <div class="row box-padding">
                <div class="box box-primary">
                    <div class="box-body">
                        <?php
                        $sql_next_kpi = "SELECT
                                                emp.employee_id AS employee_id,
                                                emp.prefix AS prefix,
                                                emp.first_name AS first_name,
                                                emp.manager_id AS manager_id,
                                                d.department_name,
                                                nk.approval AS approval,
                                                k.kpi_id As kpi_id,
                                                k.kpi_name AS kpi_name,
                                                k.kpi_description As kpi_description,
                                                nk.weight AS weight,
                                                nk.goal AS goal,
                                                k.unit As unit
                                        FROM
                                                evaluation_next_kpi enk
                                        JOIN next_responsible_kpi nk ON enk.evaluate_next_kpi_id = nk.evaluate_next_kpi_id
                                        JOIN kpi k ON k.kpi_id = nk.kpi_id
                                        JOIN evaluation_employee eemp ON eemp.evaluate_employee_id = enk.evaluate_employee_id
                                        JOIN employees emp ON eemp.employee_id = emp.employee_id
                                        JOIN departments d ON d.department_id = emp.department_id";
                        $query_next_kpi = mysqli_query($conn, $sql_next_kpi);
                        
                        ?>
                        <table class="table table-bordered">
                            <tr class="bg-primary  ">
                                <td>รหัส</td>
                                <td>ชื่อตัวชี้วัด</td>
                                <td>คำอธิบาย</td>
                                <td width="60px">น้ำหนัก</td>
                                <td width="70px">เป้าหมาย</td>
                                <td width="80px">การจัดการ</td>
                            </tr>
                            <?php while($result_next_kpi = mysqli_fetch_array($query_next_kpi, MYSQLI_ASSOC)) { ?>
                            <tr>
                                <td><?php echo $result_next_kpi["kpi_id"];?></td>
                                <td><?php echo $result_next_kpi["kpi_name"];?></td>
                                <td>
                                    <?php echo $result_next_kpi["kpi_description"];?>
                                </td>
                                <td><?php echo $result_next_kpi["weight"]."%";?></td>
                                <td>><?php echo $result_next_kpi["goal"].$result_next_kpi["unit"];?></td>
                                <td class="text-center">
                                    <a href="edit_next_kpi.php?kpi_id=<?php echo $result_next_kpi["kpi_id"];?>">
                                        <i class="glyphicon glyphicon-pencil"></i>
                                    </a>
                                    |
                                    <a href="delete_next_kpi.php?kpi_id=<?php echo $result_next_kpi["kpi_id"];?>">
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php } ?>
                        </table>
                        
                    </div>
                    <div class="box-footer">
                        <button class="btn btn-success pull-right">ยืนยันการอนุมัติ</button>
                    </div>
                </div>

            </div>
            
            <div class="row box-padding">
                <div class="box box-primary">
                    <div class="box-header with-border"> <b>เพิ่มเติม/แก้ไขKPI</b>
                    </div>
                    <div class="box-body box-padding-small">
                        <form action="" method="post">
                            <div class="row">
                                <div class="form-group col-sm-7">
                                    <label class="control-label pull-left">ชื่อ KPI</label>
                                    <div class="">
                                        <?php
                                        $sql_kpi_responsible = "SELECT
                    
                                                k.kpi_name AS kpi_name,
                                                k.unit AS unit,
                                                kr.goal AS goal,
                                                kr.percent_weight AS weight,
                                                d.department_name As department_name
                                        FROM
                                                kpi k
                                        JOIN kpi_responsible kr ON k.kpi_id = kr.kpi_id
                                        JOIN kpi_group kg ON kg.kpi_id = k.kpi_id
                                        JOIN departments d ON d.department_id = kg.department_id
                                        ORDER BY
                                                d.department_id ASC  ";
                                        $query_kpi_responsible = mysqli_query($conn, $sql_kpi_responsible);
                                        ?>
                                        <select id="kpi_responsible" class="form-control">
                                            <option value="" name="kpi_responsible_id">-- เลือกKPI --</option>
                                            <?php while($result_kpi_responsible = mysqli_fetch_array($query_kpi_responsible ,MYSQLI_ASSOC)) { ?>
                                            <option value="<?php echo $result_kpi_response["kpi_responsible_id"]; ?>">
                                                <?php echo $result_kpi_responsible["department_name"]." - ".$result_kpi_responsible["kpi_name"]; ?>
                                            </option>
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
                                    <input class="form-control" type="text" placeholder="(เปลี่ยนตามหัวข้อKPI)" value="" readonly="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <button class="btn btn-file">เพิ่ม</button>
                                    <button class="btn btn-microsoft">บันทึก</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

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
</html>