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
<?php include('./classes/connection_mysqli.php');
    $msg='';
    $id='';
    $name='';
    $dept_id='';
     
    if(isset($_GET['emp_id'])){
        $id=$_GET['emp_id'];
    }
    if(isset($_GET['emp_name'])){
        $name=$_GET['emp_name'];
    }
    if(isset($_GET['dept_id'])){
        $dept_id=$_GET['dept_id'];
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
        <!-- SCRIPT PACKS -->
        <?php include ('./script_packs.html'); ?>
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
                <div  class="row box-padding">
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
                                    
                                    <label class="col-sm-5 control-label" >ชื่อพนักงาน</label>
                                    
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
                                        <select class="form-control" name="dept_id">
                                            <option value="">เลือก</option>
                                            <?php while ($result_department = mysqli_fetch_array($query_department, MYSQLI_ASSOC)) { ?>
                                            <option value="<?php echo $result_department["department_id"]; ?>"><?php echo $result_department["department_name"]; ?></option>
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
            <div id="filter" class="row box-padding">
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
                        <!-- ช่องค้นหา by listJS -->
                                    <div class="form-inline padding-small">
                                        <i class="glyphicon glyphicon-search" style="padding: 0px 10px;" ></i>
                                        <input class="search form-control" placeholder="ค้นหา" />
                                    </div>
                        <table class="display table table-hover table-responsive table-striped table-bordered" width="90%" >
                            <thead>
                                <tr class="bg-blue-active">
                                    <th>ลำดับ</th>  
                                    <th><button class="sort bg-blue-active" data-sort="id">รหัสพนักงาน</button></th>
                                    <th><button class="sort bg-blue-active" data-sort="full_name">ชื่อพนักงาน</button></th>
                                    <th>ฝ่าย/แผนก</th>                                    
                                    <th>ตำแหน่ง</th>
                                    <th>คะแนน</th>
                                    <th>
                                        <center>เกรด</center>
                                    </th>
                                    

                                </tr>
                            </thead>
                            <?php         
                            if ($id=='' and $name =='' and $dept_id ==''){
                                //default
                                $sql_emp = "SELECT e.employee_id,CONCAT(e.prefix,e.first_name,' ', e.last_name) as fullname, department_name , job_name, grade_description,sum_overall_point
                                            FROM grade g JOIN evaluation_employee ee ON g.grade_id = ee.grade_id 
                                            JOIN employees e ON ee.employee_id = e.employee_id JOIN departments d ON e.department_id = d.department_id 
                                            JOIN jobs j ON e.job_id = j.job_id
                                            WHERE e.company_id = 1 ORDER BY d.department_name";
                                $query_emp= mysqli_query($conn, $sql_emp);
                                
                                $sql_conclude_grade ="
                                                    SELECT grade_description as Grade ,count(ee.grade_id) as Members
                                                    FROM grade g JOIN evaluation_employee ee ON g.grade_id = ee.grade_id
                                                    GROUP BY g.grade_id 
                                                    ORDER BY grade_description";
                                 $query_conclude_grade = mysqli_query($conn, $sql_conclude_grade);
                                $no=1;
                                //CALL get_avg_grade_allEmp();
                                $avg_grade = "CALL get_avg_grade_allEmp()";
                                $query_avg_grade = mysqli_query($conn, $avg_grade);
                                
                                
                              }else if ($id!='' and $name =='') {                                
                                $sql_emp = "SELECT e.employee_id,CONCAT(e.prefix,e.first_name,' ', e.last_name) as fullname, department_name , job_name, grade_description,sum_overall_point
                                            FROM grade g JOIN evaluation_employee ee ON g.grade_id = ee.grade_id 
                                            JOIN employees e ON ee.employee_id = e.employee_id JOIN departments d ON e.department_id = d.department_id 
                                            JOIN jobs j ON e.job_id = j.job_id
                                            WHERE e.company_id = 1 and e.employee_id=$id ";
                                 $query_emp= mysqli_query($conn, $sql_emp);
                                 $sql_conclude_grade ="
                                                    SELECT grade_description as Grade ,count(ee.grade_id) as Members
                                                    FROM grade g JOIN evaluation_employee ee ON g.grade_id = ee.grade_id
                                                    JOIN employees e ON ee.employee_id = e.employee_id 
                                                    JOIN departments d ON e.department_id = d.department_id 
                                                    JOIN jobs j ON e.job_id = j.job_id
                                                    WHERE e.company_id = 1 and e.employee_id=$id 
                                                    GROUP BY g.grade_id 
                                                    ORDER BY grade_description";
                                 $query_conclude_grade = mysqli_query($conn, $sql_conclude_grade);
                                 $no=1;
                                 
                            }else if($name !='') {                                
                                $sql_emp = "SELECT e.employee_id,CONCAT(e.prefix,e.first_name,' ', e.last_name) as fullname, department_name , job_name, grade_description,sum_overall_point
                                            FROM grade g JOIN evaluation_employee ee ON g.grade_id = ee.grade_id 
                                            JOIN employees e ON ee.employee_id = e.employee_id JOIN departments d ON e.department_id = d.department_id 
                                            JOIN jobs j ON e.job_id = j.job_id
                                            WHERE e.company_id = 1 and e.employee_id =e.employee_id AND j.job_id = e.job_id and e.first_name like '%$name%'
                                            ";
                                 $query_emp= mysqli_query($conn, $sql_emp);
                                 $sql_conclude_grade ="
                                                    SELECT grade_description as Grade ,count(ee.grade_id) as Members
                                                    FROM grade g JOIN evaluation_employee ee ON g.grade_id = ee.grade_id
                                                    JOIN employees e ON ee.employee_id = e.employee_id 
                                                    JOIN departments d ON e.department_id = d.department_id 
                                                    JOIN jobs j ON e.job_id = j.job_id
                                                    WHERE e.company_id = 1 and e.employee_id =e.employee_id AND j.job_id = e.job_id and e.first_name like '%$name%'
                                                    GROUP BY g.grade_id 
                                                    ORDER BY grade_description";
                                 $query_conclude_grade = mysqli_query($conn, $sql_conclude_grade);
                                 $no=1;
                                 
                                 
                            }else if($dept_id !='') {                                
                                $sql_emp = "SELECT e.employee_id,CONCAT(e.prefix,e.first_name,' ', e.last_name) as fullname, department_name , job_name, grade_description,sum_overall_point,d.department_id 
                                            FROM grade g JOIN evaluation_employee ee ON g.grade_id = ee.grade_id 
                                            JOIN employees e ON ee.employee_id = e.employee_id JOIN departments d ON e.department_id = d.department_id 
                                            JOIN jobs j ON e.job_id = j.job_id
                                            WHERE e.company_id = 1 and e.employee_id =e.employee_id AND j.job_id = e.job_id and d.department_id = $dept_id
                                            ";
                                 $query_emp= mysqli_query($conn, $sql_emp);
                                 $sql_conclude_grade ="
                                                    SELECT grade_description as Grade ,count(ee.grade_id) as Members
                                                    FROM grade g JOIN evaluation_employee ee ON g.grade_id = ee.grade_id
                                                    JOIN employees e ON ee.employee_id = e.employee_id 
                                                    JOIN departments d ON e.department_id = d.department_id 
                                                    JOIN jobs j ON e.job_id = j.job_id
                                                    WHERE e.company_id = 1 and e.employee_id =e.employee_id AND j.job_id = e.job_id and d.department_id =$dept_id
                                                    GROUP BY g.grade_id 
                                                    ORDER BY grade_description";
                                 $query_conclude_grade = mysqli_query($conn, $sql_conclude_grade);
                                 $no=1;
                                
                                $avg_grade = "CALL get_avg_grade_dept($dept_id)";
                                $query_avg_grade = mysqli_query($conn, $avg_grade);
                                
                                 
                            }
                              
                              
                              
                              ?>
                            <tbody class="list"> 
                            <?php while($result_emp = mysqli_fetch_assoc($query_emp)) { ?>
                            <tr>
                                <td class="emp_id"><?php echo $no ; ?></td>
                                <td class="emp_id"><?php echo $result_emp['employee_id'] ; ?></td>
                                <td class="full_name"><?php echo $result_emp['fullname'] ; ?></td>
                                <td class="dept_name"><?php echo $result_emp['department_name'] ; ?></td> 
                                <td class="job_name"><?php echo $result_emp['job_name'] ; ?></td>                                                                 
                                <td class="job_name"><?php echo $result_emp['sum_overall_point'] ; ?></td>      
                                <td class="grade"><?php echo $result_emp['grade_description'] ; ?></td>
                                
                            </tr>
                            
                            
                            
                            <?php $no++;
 }  ?>
                            </tbody>
                           <script>
                                            var options = {
                                                valueNames: [ 'emp_id' , 'full_name','dept_name','job_name','grade' ];
                                            };
                                            
                                            var userList = new List('filter', options);
                           </script>
                        </table>
                        <table class="table table-hover table-responsive table-striped table-bordered">
                            <thead>
                                <tr class="bg-blue-active">
                                    
                                    <th>เกรด</th>                                    
                                    <th>จำนวน(คน)</th>
                                    
                                    
                                    

                                </tr>
                            </thead>
                            <tbody>
                        <?php while($result_conclude_grade = mysqli_fetch_assoc($query_conclude_grade)) { ?>
                        <tr >
                                    
                                    <th><?php echo $result_conclude_grade['Grade']; ?></th>                                    
                                    <th><?php echo $result_conclude_grade['Members']; ?></th>
                                    
                                    
                                    

                                </tr>
                        <?php }?>
                                 <?php if($query_avg_grade){ while($result_avg_grade = mysqli_fetch_assoc($query_avg_grade)) { ?>
                                            <tr class="bg-blue-active">
                                                <th>เกรดเฉลี่ยรวม</th>
                                                <th><?php echo $result_avg_grade['grade_description']; ?></th>
                                            </tr>
                                 <?php }}else{}?>     
                            </tbody>
                        </table>   
                        <div class="col-md-12  ">
                            <br><br>
                            <form action="pdf_grade_report.php" method="post">
                            <button  type="submit" class="btn-danger" style="float: right">
                                <img src="img/icon_pdf.png" width="16" height="16" align="absmiddle" /> PDF order by Search</button>
                                <input type="hidden" value="<?php echo $sql_emp;?>" name="sql_grade">
                                <input type="hidden" value="<?php echo $sql_conclude_grade;?>" name="con_grade">
                                <input type="hidden" value="<?php echo $avg_grade;?>" name="avg_grade">
                            </form>
                            <form action="pdf_grade_dept_report.php" method="post">
                            <button  type="submit" class="btn-danger" style="float: right">
                                <img src="img/icon_pdf.png" width="16" height="16" align="absmiddle" /> PDF order by Department</button>
                                <input type="hidden" value="<?php echo $sql_emp;?>" name="sql_grade">
                                <input type="hidden" value="<?php echo $sql_conclude_grade;?>" name="con_grade">
                                <input type="hidden" value="<?php echo $avg_grade;?>" name="avg_grade">
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

</html>
            <?php
        }
    }

    
?>