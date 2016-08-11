<!DOCTYPE html>
<?php include('./classes/connection_mysqli.php');
        
        $erp='';
        $msg='';
        if(isset($_GET['erp']))
            $erp=$_GET['erp'];
        //++++++++++++++++++save record+++++++++++++
        if($erp=='save'){
            
            $period=$_POST['add_period'];
            $year=$_POST['add_year'];
            $open_eval=$_POST['add_open'];
            $close_eval=$_POST['add_close'];
            $add_query="INSERT INTO evaluation VALUES (5,1,'$period','$year','$open_eval','$close_eval')";            
            $a_query =  mysqli_query($conn,$add_query);
            if($a_query)
               header ("location:manage_evaluate.php");
            else {
                $msg='Error :'.mysql_error();
                echo "Error Save [" . $add_query . "]";
                
                
            }
        }
            //++++++++++++++++++delete record+++++++++++++
            if($erp=='delete'){            
            $dterm=$_GET['term']; 
            $dyear=$_GET['year'];            
            $delete="DELETE FROM evaluation WHERE term='$dterm' and year='$dyear'";            
            $d_query =  mysqli_query($conn,$delete);
            if($d_query)
               header ("location:manage_evaluate.php");
            else {
                $msg='Error :'.mysql_error();
                echo "Error Save [" . $delete . "]";
            }   
                
            
        }
        //++++++++++++++++++update record+++++++++++++
            if($erp=='update'){            
            $strSQL = "UPDATE evaluation SET ";
            $strSQL .="open_system_date= '" . $_POST["textopen"] . "' ";
            $strSQL .=",close_system_date = '" . $_POST["textclose"] . "' ";
            $strSQL .="WHERE company_id = 1 and term= '".$_POST["textterm"]."' and year='".$_POST["textyear"]."'";
            $objQuery = mysqli_query($conn,$strSQL);
            if ($objQuery) {

                echo "Record update successfully";


            } else {

                echo "Error Save [" . $strSQL . "]";
            }
         
                
            
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
        <!-- javascript   menu -->
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                $('#tabs').tab();
            });
        </script> 

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
                        จัดการระบบการประเมินผลการปฏิบัติงาน
                        <small> </small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Evaluate Management</li>
                    </ol>
                </section>
                <!--/Page header -->

                <!-- Main content -->

                <!--list employee-->
                <div class="row box-padding">                   

                    <div class="box-header with-border">                        
                        <ul id="tabs" class="nav nav-pills nav-justified" data-tabs="tabs">
                            <li class="active"><a href="#addEmp" data-toggle="tab">จัดการระบบการประเมิน</a></li>
                            <li><a href="#editEmp" data-toggle="tab">จัดการการติดตามKPIs</a></li>        
                        </ul>

                    </div>                                                     

                </div>
                <div id="my-tab-content" class="tab-content" >
                    <div class="tab-pane active col-md-12" id="addEmp">
                        <div class="row box-padding">                  
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <p>กำหนดการเปิด/ปิดระบบการประเมิน</p>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"> 
                                            <i class="fa fa-minus"></i>
                                        </button>

                                    </div>
                                </div>
                                <div class="box-body">
                                  <div class="col-md-offset-1 col-md-10 ">
                                    <?php 
                                        $sql_eval = "SELECT term,year,DATE_FORMAT(open_system_date,'%d/%m/%Y') as open_system_date ,DATE_FORMAT(close_system_date,'%d/%m/%Y') as close_system_date from evaluation where company_id=1  ";
                                        $query_eval= mysqli_query($conn, $sql_eval);
                                    ?>
                                     
                                   <table class="table table-hover">
                                       
                                       <tr>
                                           
                                           <th>รอบการประเมิน</th>
                                           <th>วันเปิด</th>
                                           <th>วันปิด</th>
                                           <th align="center">จัดการ</th>
                                       </tr>
                                       <?php while($result_eval = mysqli_fetch_array($query_eval,MYSQLI_ASSOC)) { ?>
                                       <tr>
                                           
                                           <td><?php echo $result_eval["term"] ; ?> / <?php echo $result_eval["year"] ; ?></td>
                                           <td><?php echo $result_eval["open_system_date"] ; ?></td>
                                           <td><?php echo $result_eval["close_system_date"] ; ?></td>
                                           <td >
                                               <a href="" data-toggle="modal" data-target="#<?php echo $result_eval["term"] ; ?>_<?php echo $result_eval["year"] ; ?>">
                                                   <i class="glyphicon glyphicon-pencil"></i>
                                               </a>|
                                               <a href="manage_evaluate.php?erp=delete&term=<?php echo $result_eval["term"] ; ?>&year=<?php echo $result_eval["year"] ; ?>">
                                                   <i class="glyphicon glyphicon-trash"></i>
                                               </a>
                                           </td>
                                       </tr>
                                       <!--Edit Modal -->
                                       <form class="form-horizontal" name="frmMain" method="post" action="manage_evaluate.php?erp=update" >
                                        <div class="modal fade" id="<?php echo $result_eval["term"] ; ?>_<?php echo $result_eval["year"] ; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">แก้ไขข้อมูล</h4>
                                              </div>
                                              <div class="modal-body">
                                                  
                                                      <iframe id="iframe_target" name="iframe_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>
                                                      <div class="input-group col-sm-12" >
                                                          <label for="รอบการประเมิน" class="col-sm-4 control-label">เทอม:</label>
                                                          <div class="col-sm-8">               
                                                              <input type="text" class="form-control" value="<?php echo $result_eval["term"] ; ?>" name='textterm'   >
                                                          </div>
                                                      </div>
                                                      <div class="input-group col-sm-12" >
                                                          <label for="รอบการประเมิน" class="col-sm-4 control-label">ปี:</label>
                                                          <div class="col-sm-8">               
                                                              <input type="text" class="form-control" value="<?php echo $result_eval["year"] ; ?>" name='textyear'    >
                                                          </div>
                                                      </div>
                                                      <div class="input-group col-sm-12">
                                                          <label class="col-sm-4 control-label" >วันเปิด: </label>
                                                          <div class="col-sm-8"> 
                                                              <input type="date" class="form-control" name="textopen"  >
                                                          </div>
                                                      </div>
                                                      <div class="input-group col-sm-12">
                                                          <label class="col-sm-4 control-label">วันปิด: </label>
                                                          <div class="col-sm-8"> 
                                                              <input type="date" class="form-control" name="textclose" >
                                                          </div>
                                                      </div>                                              
         
                                              </div>
                                              <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">บันทึก</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                                                
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        </form>
                                      <!-- Edit Modal -->
                                       

                                       <?php } ?>
                                   </table>
                                      
                                     <?php echo $msg;?> 
                                      <!--Add Modal -->
                                      <form class="form-horizontal" action='manage_evaluate.php?erp=save' method="post">
                                        <div class="modal fade" id="myModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">เพิ่มข้อมูล</h4>
                                              </div>
                                              <div class="modal-body">                                                  
                                                      <div class="input-group col-sm-12" >
                                                          <label for="รอบการประเมิน" class="col-sm-4 control-label">รอบการประเมิน:</label>
                                                          <div class="col-sm-8">               
                                                              <input type="text" class="form-control" placeholder="รอบการประเมิน" name="add_period"  >
                                                          </div>
                                                          <label for="ปีการประเมิน" class="col-sm-4 control-label">ปีการประเมิน:</label>
                                                          <div class="col-sm-8">               
                                                              <input type="text" class="form-control" placeholder="ปีการประเมิน" name="add_year"  >
                                                          </div>
                                                      </div>
                                                      <div class="input-group col-sm-12">
                                                          <label class="col-sm-4 control-label">วันเปิด: </label>
                                                          <div class="col-sm-8"> 
                                                              <input type="date" class="form-control" name="add_open">
                                                          </div>
                                                      </div>
                                                      <div class="input-group col-sm-12">
                                                          <label class="col-sm-4 control-label">วันปิด: </label>
                                                          <div class="col-sm-8"> 
                                                              <input type="date" class="form-control" name="add_close" >
                                                          </div>
                                                          
                                                      </div>
                                                  
                                              </div>
                                              <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">เพิ่ม</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                                                
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                       </form>
                                      <!-- Add Modal -->
                                      
                                      <br>
                                      <input type="submit" value="เพิ่มข้อมูล" class="btn btn-success pull-right" data-toggle="modal" data-target="#myModalAdd">
                                      
                                   </div>
                                </div>
                            </div>                                                             
                        </div>

                        <div class="row box-padding">                  
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <p>สถานะการประเมินและแจ้งเตือนอีเมลล์</p>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"> 
                                            <i class="fa fa-minus"></i>
                                        </button>

                                    </div>
                                </div>
                                <div class="box-body">
                                  <div class="col-md-offset-1 col-md-10 ">
                                        <?php   $sql_mail = "SELECT
                                                    m.prefix As prefix,
                                                    m.first_name As first_name,
                                                    m.last_name As last_name,
                                                    (
                                                          SELECT
                                                                  COUNT(e.employee_id)
                                                          FROM
                                                                  evaluation_employee v
                                                          JOIN employees e ON v.employee_id = e.employee_id
                                                          JOIN employees m ON e.manager_id = m.employee_id
                                                          WHERE
                                                                  e.manager_id = 1
                                                        AND sum_point <> 0
                                                    ) AS completed_evaluate,
                                                    COUNT(e.employee_id) - (
                                                        SELECT
                                                                COUNT(e.employee_id)
                                                        FROM
                                                                evaluation_employee v
                                                        JOIN employees e ON v.employee_id = e.employee_id
                                                        JOIN employees m ON e.manager_id = m.employee_id
                                                            WHERE
                                                                e.manager_id = 1
                                                        AND sum_point <> 0
                                                    ) AS uncompleted_evaluate,
                                                    COUNT(e.employee_id) AS all_subordinate
                                                FROM
                                                    employees e
                                            JOIN employees m ON e.manager_id = m.employee_id
                                            WHERE
                                                e.manager_id = 1"; 
                                        $query_mail = mysqli_query($conn, $sql_mail);
                                        
                                        ?>
                                   <table class="table table-hover">
                                       <tr>
                                           <th>ผู้ประเมิน</th>
                                           <th class="text-center">ประเมินแล้ว</th>
                                           <th class="text-center">ยังไม่ประเมิน</th>
                                           <th class="text-center">ทั้งหมด</th>
                                           <th class="text-center">แจ้งเตือน</th>
                                       </tr>

                                       <?php 
                                        $sql_meval = "SELECT  CONCAT(m.prefix,m.first_name,' ',m.last_name) as name, ( SELECT  COUNT(e.employee_id)
                                                        FROM evaluation_employee v JOIN employees e ON v.employee_id = e.employee_id JOIN employees m ON e.manager_id = m.employee_id
                                                        WHERE e.manager_id = 1 AND sum_point <> 0) AS 'Completed_evaluate' , COUNT(e.employee_id)-( SELECT  COUNT(e.employee_id)
                                                        FROM evaluation_employee v JOIN employees e ON v.employee_id = e.employee_id JOIN employees m ON e.manager_id = m.employee_id
                                                        WHERE e.manager_id = 1 AND sum_point <> 0) AS 'Uncompleted_evaluate',
                                                        COUNT(e.employee_id) AS 'All_subordinate' 
                                                        FROM employees e JOIN employees m ON e.manager_id = m.employee_id
                                                        WHERE e.manager_id = 1  ";
                                        $query_meval= mysqli_query($conn, $sql_meval);
                                    ?>
                                    <?php while($result_meval = mysqli_fetch_array($query_meval,MYSQLI_ASSOC)) { ?>
                                       <tr>
                                           <td><?php echo $result_meval['name']; ?></td>
                                           <td class="text-center"><?php echo $result_meval['Completed_evaluate']; ?></td>
                                           <td class="text-center"><?php echo $result_meval['Uncompleted_evaluate']; ?></td>
                                           <td class="text-center"><?php echo $result_meval['All_subordinate']; ?></td>

                                           <td class="text-center">
                                               <a href="">
                                                   <i class="glyphicon glyphicon-envelope"></i>
                                               </a>
                                           </td>
                                       </tr>

                                       <?php }?>

                                   </table>
                                   </div>
                                </div>
                            </div>                                                             
                        </div>

                    </div>
                
                   <div class="tab-pane col-md-12" id="editEmp">
                        <div class="row box-padding">                  
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <p>สถานะการอัพเดทและแจ้งเตือนอีเมลล์</p>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"> 
                                            <i class="fa fa-minus"></i>
                                        </button>

                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="col-md-offset-1 col-md-10 ">
                                        <br>
                                        <form class="form-inline">
                                            <div class="form-group col-md-2">
                                                <label class="control-label">เดือน </label>
                                                <select class="form-control" name="mont">
                                                    <option>ม.ค.</option>
                                                    <option>ก.พ.</option>
                                                    <option>มี.ค.</option>
                                                    <option>เม.ย.</option>
                                                    <option>พ.ค.</option>
                                                    <option>มิ.ย.</option>
                                                    <option selected="true">ก.ค.</option>
                                                    <option>ส.ค.</option>
                                                    <option>ก.ย.</option>
                                                    <option>ต.ค.</option>
                                                    <option>พ.ย.</option>
                                                    <option>ธ.ค.</option>
                                                 </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="control-label">รอบการอัพเดท </label>
                                                <input type="email" class="form-control" id="exampleInputEmail2" placeholder="1-29 ก.ค. 2016"disabled="true">
                                            </div>
                                            <div class="form-group col-md-4">
                                                 <?php
                                                    $sql_department = "SELECT * FROM departments ";
                                                    $query_department = mysqli_query($conn, $sql_department);
                                                 ?>
                                                <label class="control-label">แผนก </label>
                                                <select class="form-control">
                                                <?php while ($result_department = mysqli_fetch_array($query_department, MYSQLI_ASSOC)) { ?>
                                                <option><?php echo $result_department["department_name"]; ?></option>
                                                <?php }  mysqli_close($conn); ?>
                                                 </select>
                                            </div>
                                            
                                        </form>
                                        <br><br><br><br><br>
                                    </div> 
                                    <div class="col-md-offset-1 col-md-10 bg-faded ">
                                        <h4>การอัพเดทความคืบหน้า เดือน กรกฎาคม (วันที่1-29)</h4>
                                    </div>
                                    <div class="col-md-offset-1 col-md-10  ">
                                        <table class="table table-hover">
                                            <tr class="bg-blue">
                                           <th>ชื่อพนักงาน</th>
                                           <th class="text-center">สถานะ</th>
                                           <th class="text-center">ดูรายละเอียด</th>
                                           <th class="text-center">แจ้งเตือนถึงพนักงาน</th>
                                           <th class="text-center">แจ้งเตือนถึงผู้บังคับบัญชา</th>
                                       </tr>
                                       <tr>
                                           <td>นาย สมศักดิ์ ดวงจันทร์</td>
                                           <td class="text-center" style="color: red">uncomplete</td>
                                           <td class="text-center"><a href="#" class="glyphicon glyphicon-eye-open"></a></td>
                                           <td class="text-center"><a href="#" class="glyphicon glyphicon-envelope"></a></td>
                                           <td class="text-center">
                                               <a href="#">
                                                   <i class="glyphicon glyphicon-envelope"></i>
                                               </a>
                                           </td>
                                       </tr>
                                       
                                   </table>
                                    </div>
                                </div>
                            </div>                                                             
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
</html>
