<!DOCTYPE html>
<html>
    <head>
        <?php 
        include ('./classes/connection_mysqli.php');
        if(isset($_GET["emp_id"])){
            $get_emp_id = $_GET["emp_id"];
        }
        ?>
        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>แก้ไขข้อมูลพนักงาน : ALT Evaluation</title>
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
                        แก้ไขข้อมูลพนักงาน
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
                    <!--edit employee-->
                    <?php 
                        $sql = "SELECT * FROM employees WHERE employee_id = '".$get_emp_id."' limit 1";                        
                        $query = mysqli_query($conn, $sql);
                        while($result = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                            $prefix = $result["prefix"]; 
                            $f_name = $result["first_name"];
                            $l_name = $result["last_name"];
                            $name = $result["prefix"].$result["first_name"]."  ".$result["last_name"];
                            $address = $result["address"];
                            $hiredate =$result["hiredate"];
                            $telno =$result["telephone_no"];
                            $email =$result["email"];
                                 
                            
                            
                    ?>
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">ข้อมูลของ : <?php echo $name; ?></h3>
                        </div>
                        <form action="" type="post" >
                            <div class="col-md-offset-1 col-md-10">
                            <div class="box-body">
                                <div class="row with-border">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <img class="thumbnail img-circle" src="img/" alt="รูปโปรไฟล์" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">                                                
                                        <div class="form-group">
                                            <label>อัพโหลดรูปภาพ</label>
                                            <input class="form-control" name="first_name" type="file" value="<?php echo $f_name; ?>">
                                        </div>                                                
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>คำนำหน้า</label>
                                            <select class="form-control" name="prefix">
                                                <option value="">เลือก</option>
                                                
                                                <option value="นาย" <?php if($prefix == 'นาย'){ echo "selected";} ?>>นาย</option>
                                                <option value="นางสาว" <?php if($prefix == 'นางสาว'){ echo "selected";} ?> >นางสาว</option>
                                                <option value="นาง" <?php if($prefix == 'นาง'){ echo "selected";} ?> >นาง</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">                                                
                                        <div class="form-group">
                                            <label>ชื่อ</label>
                                            <input class="form-control" name="first_name" type="text" value="<?php echo $f_name; ?>">
                                        </div>                                                
                                    </div>
                                    <div class="col-md-6">                                                
                                        <div class="form-group">
                                            <label>นามสกุล</label>
                                            <input class="form-control" name="last_name" type="text" value="<?php echo $l_name; ?>">
                                        </div>                                               
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">                                                
                                        <div class="form-group">
                                            <label>วันที่เริ่มงาน</label>
                                            <div class="input-group date" data-provide="datepicker">
                                                <input type="text" class="form-control" value="<?php echo $hiredate; ?>">
                                                <div class="input-group-addon">
                                                    <span class="glyphicon glyphicon-th"></span>
                                                </div>
                                            </div>
                                            <script>
                                                $('.datepicker').datepicker();
                                            </script>
                                        </div>                                                
                                    </div>
                                    <?php
                                    $sql_department = "SELECT * FROM departments ";
                                    $query_department = mysqli_query($conn, $sql_department);
                                    ?>
                                    <div class="col-md-6">                                               
                                        <div class="form-group">
                                            <label>แผนก</label>
                                            <select class="form-control" name="department_id">
                                                <option value="">--เลือกแผนก--</option>
                                                <?php while ($result_department = mysqli_fetch_array($query_department)) { ?>
                                                    <option value="<?php echo $result_department["department_id"]; ?>">
                                                        <?php echo $result_department["department_id"] . " - " . $result_department["department_name"]; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>                                                        
                                        </div>                                                
                                    </div>
                                </div>

                                <div class="row">
                                    <?php
                                    $sql_job = "SELECT * FROM jobs ";
                                    $query_job = mysqli_query($conn, $sql_job);
                                    ?>
                                    <div class="col-md-6">                                                
                                        <div class="form-group">
                                            <label>ตำแหน่ง</label>
                                            <select class="form-control" name="job_id">
                                                <option value="">--เลือกตำแหน่ง--</option>
                                                <?php while ($result_job = mysqli_fetch_array($query_job)) { ?>
                                                    <option value="<?php echo $result_job["job_id"]; ?>">
                                                        <?php echo $result_job["job_id"] . " - " . $result_job["job_name"]; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>                                                
                                    </div>
                                    <?php
                                    $sql_position_level = "SELECT * FROM position_level ";
                                    $query_position_level = mysqli_query($conn, $sql_position_level);
                                    ?>
                                    <div class="col-md-6">                                                
                                        <div class="form-group">
                                            <label>ระดับ </label>
                                            <select class="form-control" name="position_level_id">
                                                <option value="">--เลือกระดับ--</option>
                                                <?php while ($result_position_level = mysqli_fetch_array($query_position_level)) { ?>
                                                    <option value="<?php echo $result_position_level["position_level_id"]; ?>">
                                                        <?php echo $result_position_level["position_level_id"] . " - " . $result_position_level["position_description"]; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>

                                        </div>                                                
                                    </div>    
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php 
                                            
                                                $msql = " select m.first_name as fname from employees m 
                                                        join employees e on m.employee_id = e.manager_id 
                                                        where e.employee_id  = '".$get_emp_id."' limit 1";
                                                $mname='';
                                                
                                                 
                                                 $mquery = mysqli_query($conn, $msql);
                                                 
                                                 ?>
                                                <?php
                                                
                                                while($mresult = mysqli_fetch_array($mquery, MYSQLI_ASSOC)) {
                                                     
                                                    $mname =$mresult['fname'];
                                                 
                                                  
                                             ?>
                                            <label>หัวหน้าผู้รับผิดชอบ</label>
                                                <input type="text" name="manager" class="form-control" value="<?php echo $mname ?>" />
                                        </div>                                               
                                    </div>
                                                <?php }  ?>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>เบอร์ติดต่อ</label>
                                            <input type="text" name="telephone" class="form-control" value="<?php echo $telno ?>" />
                                        </div>
                                    </div>  
                                </div>                                       
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>ที่อยู่</label>
                                            <textarea name="address" class="form-control" rows="3" ><?php echo $address; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>email</label>
                                            <input type="email" name="email" class="form-control" value="<?php echo $email; ?>" />
                                        </div>
                                    </div>  
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <label>อัพโหลดภาพ</label>
                                            <input name="image_name" type="file" id="image_name" size="40" />
                                        </div>
                                    </div>
                                </div>
                                <br>

                            </div>
                    </div>
                            <!-- /Box body -->
                            <div class="box-footer">
                                <center>
                                    <input  class="btn btn-danger search-button" type="reset" name="Reset">
                                    <input  class="btn btn-success search-button" type="submit" name="Send" value="เพิ่ม">
                                </center>

                            </div>
                        </form>
                    </div>
                    <?php } ?>
                    <!--/edit employee-->
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
</html>
