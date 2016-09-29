<div class="box box-success collapsed-box">
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
                                                    e.employee_id ='".$_SESSION["emp_id"]."'";
    $query_emp = mysqli_query($conn, $sql_emp);
    while ($result_emp = mysqli_fetch_array($query_emp, MYSQLI_ASSOC)) {
        ?>
    <div class="box-header">
        <div class="col-md6">
            
            
            <div style="float: right;">
                <img class='img-circle img-sm img-center' src="./upload_images/<?php echo $result_emp["profile_picture"]; ?>" > <span span style="font-size:18px"><?php echo "&nbsp;&nbsp;" . $result_emp["employee_id"] . ' : ' . $result_emp["emp_name"]; ?></span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"> <i class="fa fa-plus"></i>
                </button>
            </div>
                <div col-md-6>
            <div style="float: left;">
                    <?php
                    $eval_code = '';
                    if (isset($_GET["eval_code"])) {
                        $eval_code = $_GET["eval_code"];
                    }

                    $sql_year_term = "SELECT * FROM evaluation e JOIN term t ON e.term_id=t.term_id WHERE evaluation_code = '".$_SESSION["eval_code"]."'";
                    $query_year_term = mysqli_query($conn, $sql_year_term);
                    while ($result_year_term = mysqli_fetch_array($query_year_term, MYSQLI_ASSOC)) {
                        $year = $result_year_term["year"];
                        $term = $result_year_term["term_name"];
                        $start_month_name = $result_year_term["start_month"];
                        $end_month_name = $result_year_term["end_month"];
                        echo "<span style='font-size:18px'><b>ปีการประเมิน " . $year. "</b></span> | ";
                        echo "<span style='font-size:18px'>รอบการประเมินที่ " . $term. " : " . $start_month_name . "-" . $end_month_name . "</span>";
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
                    <img class="img-center img-thumbnail" style="height: 130px;max-width: 110px;" src="upload_images/<?php
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
                <td><?php echo $result_emp["hiredate"]; ?> <span style="color:maroon;">(อายุงาน : 5 ปี)</span> </td>
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
                    $sql_eval_period = "SELECT * FROM evaluation WHERE evaluation_code = '".$_SESSION["eval_code"]."' ";
                    $query_eval_period = mysqli_query($conn, $sql_eval_period) or die(mysqli_errno());
                    $result_eval_period = mysqli_fetch_array($query_eval_period,MYSQLI_ASSOC);
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
