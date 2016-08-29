<!DOCTYPE html>
<?php include('./classes/connection_mysqli.php');
    $msg='';
    $id='';
    $name='';
     
    if(isset($_GET['emp_id'])){
        $id=$_GET['emp_id'];
    }
    if(isset($_GET['emp_name'])){
        $name=$_GET['emp_name'];
    }
?>
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
                    รายงานผลการประเมินผลการปฏิบัติงานทั่วทั้งองค์การ
                    <small>(ส่วนของเกรด)</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="#"> <i class="fa fa-dashboard"></i>
                            Home
                        </a>
                    </li>
                    <li class="active">Summary evaluation</li>
                </ol>
            </section>
            <!--/Page header -->

            <!-- Main content -->
            <!--search-->
                <div class="row box-padding">
                    <div class="box box-primary">
                        <div class="box-body">
                            <form action="hr_report_grade.php?" method="GET" >
                                <div class="col-sm-3">
                                    <label class="col-sm-6 control-label">รหัสพนักงาน</label>
                                    <div class="col-sm-6">
                                        <input class="form-control" type="text" name="emp_id">
                                    </div>
                                </div> 

                                <div class="col-md-3">
                                    <label class="col-sm-5 control-label">ชื่อพนักงาน</label>
                                    <div class="col-sm-7">
                                        <input class="form-control" type="text" name="emp_name">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    
                                    <label class="col-sm-4 control-label">แผนก/ฝ่าย</label>
                                    <div class="col-sm-8">
                                        <?php
                                        $sql_department = "SELECT * FROM departments ";
                                        $query_department = mysqli_query($conn, $sql_department);
                                        ?>
                                        <select class="form-control">
                                            <option value="">เลือก</option>
                                            <?php while ($result_department = mysqli_fetch_array($query_department, MYSQLI_ASSOC)) { ?>
                                                <option><?php echo $result_department["department_name"]; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>                               
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-primary search-button"><i class="glyphicon glyphicon-search"></i></button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <!--/search-->

            <!--list employee-->
            <div class="row box-padding">
                <div class="box box-primary">

                    <div class="box-header with-border"> <b>ตารางข้อมูลพนักงาน</b>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>

                            <button type="button" class="btn btn-box-tool" data-widget="remove">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">

                        <table class="table table-bordered table-hover" width="90%" >
                            <thead>
                                <tr class="bg-blue-active">
                                    <th>รหัสพนักงาน</th>
                                    <th>ชื่อพนักงาน</th>
                                    <th>ตำแหน่ง</th>
                                    <th>ฝ่าย/แผนก</th>
                                    <th>คะแนน</th>
                                    <th>
                                        <center>เกรด</center>
                                    </th>
                                    

                                </tr>
                            </thead>
                            <?php                                 
                                //default
                                $sql_emp = "SELECT v.employee_id,CONCAT(e.prefix,e.first_name,' ', e.last_name) as fullname,d.department_name,j.job_name, v.sum_point,g.grade_description
                                                FROM grade g 
                                                JOIN evaluation_employee v ON g.grade_id = v.grade_id 
                                                JOIN evaluation n on v.evaluation_code = n.evaluation_code 
                                                JOIN company c ON n.company_id = c.company_id 
                                                JOIN employees e on c.company_id = e.company_id 
                                                JOIN jobs j ON e.job_id = j.job_id 
                                                JOIN departments d ON e.department_id = d.department_id
                                                WHERE c.company_name='ALT' and v.employee_id = e.employee_id AND j.job_id = e.job_id
                                                GROUP by v.employee_id";
                                $query_emp= mysqli_query($conn, $sql_emp);
                                
                                
                              if ($id!='' and $name =='') {                                
                                $sql_emp = "SELECT v.employee_id,CONCAT(e.prefix,e.first_name,' ', e.last_name) as fullname,d.department_name,j.job_name, v.sum_point,g.grade_description
                                                FROM grade g 
                                                JOIN evaluation_employee v ON g.grade_id = v.grade_id 
                                                JOIN evaluation n on v.evaluation_code = n.evaluation_code 
                                                JOIN company c ON n.company_id = c.company_id 
                                                JOIN employees e on c.company_id = e.company_id and e.employee_id=v.employee_id
                                                JOIN jobs j ON e.job_id = j.job_id 
                                                JOIN departments d ON e.department_id = d.department_id
                                                WHERE c.company_name='ALT' and v.employee_id =$id AND j.job_id = e.job_id
                                                GROUP by v.employee_id";
                                 $query_emp= mysqli_query($conn, $sql_emp);
                                 
                            }else {                                
                                $sql_emp = "SELECT v.employee_id,CONCAT(e.prefix,e.first_name,' ', e.last_name) as fullname,d.department_name,j.job_name, v.sum_point,g.grade_description
                                                FROM grade g 
                                                JOIN evaluation_employee v ON g.grade_id = v.grade_id 
                                                JOIN evaluation n on v.evaluation_code = n.evaluation_code 
                                                JOIN company c ON n.company_id = c.company_id 
                                                JOIN employees e on c.company_id = e.company_id 
                                                JOIN jobs j ON e.job_id = j.job_id 
                                                JOIN departments d ON e.department_id = d.department_id
                                                WHERE c.company_name='ALT' and v.employee_id =e.employee_id AND j.job_id = e.job_id and e.first_name like '%$name%'
                                                GROUP by v.employee_id";
                                 $query_emp= mysqli_query($conn, $sql_emp);
                                 
                                 
                            }
                              
                              
                              
                              
                              
                             while($result_emp = mysqli_fetch_array($query_emp,MYSQLI_ASSOC)) { ?>
                            <tr>
                                <td><?php echo $result_emp['employee_id'] ; ?></td>
                                    <td><?php echo $result_emp['fullname'] ; ?></td>
                                    <td><?php echo $result_emp['job_name'] ; ?></td>
                                    <td><?php echo $result_emp['department_name'] ; ?>t</td>                                    
                                    <td><?php echo $result_emp['sum_point'] ; ?></td>
                                    <td><?php echo $result_emp['grade_description'] ; ?></td>


                            </tr>
                            
                            
                            
                            <?php } mysqli_close($conn); ?>
                            
                           
                        </table>
                        <div class="col-md-12  ">
                            <br><br>
                            <form action="pdf_grade_report.php">
                            <button  type="submit" class="btn-danger" style="float: right">
                                <img src="img/icon_pdf.png" width="16" height="16" align="absmiddle" /> PDF</button>
                            </form>
                        </div>
                        

                        <!-- /.chart-responsive --> </div>
                </div>
            </div>
            <!--/list employee-->

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