<?php 
        $erp='';
        $msg='';
        
        include './classes/connection_mysqli.php';
        
        if(isset($_GET['erp'])) {
            $erp=$_GET['erp'];
            //++++++++++++++++++insert record+++++++++++++
           if($erp=='insert'){          
                $name =$_POST['company_name'];
                $fullname =$_POST['company_full_name'];
                $strSQL =" INSERT INTO company(company_name,company_full_name) VALUES('$name','$fullname') ";
			   
               $objQuery = mysqli_query($conn,$strSQL);
               if ($objQuery) {

                   header ("location:company_table.php");

               } else {

                   echo "Error Save [" . $strSQL . "]";
               }

           }
            //++++++++++++++++++update record+++++++++++++
           if($erp=='update'){          
                $name =$_POST['textcom'];
                $fullname =$_POST['textfullcom'];
                $id=$_GET['id'];
                $strSQL =" UPDATE company SET company_name ='$name',company_full_name ='$fullname'  WHERE company_id=$id ";
                $objQuery = mysqli_query($conn,$strSQL);
                if ($objQuery) {

                    header ("location:company_table.php");
                } else {
                   echo "Error Save [" . $strSQL . "]";
               }

           }
            //++++++++++++++++++delete record+++++++++++++
           if($erp=='delete'){        

               $id=$_GET['id'];
               $strSQL =" DELETE FROM company WHERE company_id=$id ";
               $objQuery = mysqli_query($conn,$strSQL);
               if ($objQuery) {
                   header ("location:company_table.php");
               } else {
                   echo "Error Save [" . $strSQL . "]";
               }
           }
        }
            
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
                        ส่วนที่ 4: ความคิดเห็นเพิ่มเติม
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
                    <div class="box box-primary">
                    <div class="box-header with-border">

 <!--Table Good Bad-->

                    <table class="table ">
                      <thead class="thead-inverse">
                        <tr>
                          <th colspan="2">จุดเด่นของผู้ถูกประเมิน</th>
                          <th colspan="2">จุดด้อยของผู้ถูกประเมิน</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">1</th>
                          <td></td>
                          <th scope="row">1</th>
                          <td></td>
                        </tr>
                        <tr>
                          <th scope="row">2</th>
                          <td></td>
                          <th scope="row">2</th>
                          <td></td>
                        </tr>
                        <tr>
                          <th scope="row">3</th>
                          <td></td>
                          <th scope="row">3</th>
                          <td></td>
                        </tr>
                          <tr>
                          <th scope="row">4</th>
                          <td></td>
                          <th scope="row">4</th>
                          <td></td>
                        </tr>
                        <tr>
                          <th scope="row">5</th>
                          <td></td>
                          <th scope="row">5</th>
                          <td></td>
                        </tr>
                        <tr>
                          <th scope="row">6</th>
                          <td></td>
                          <th scope="row">6</th>
                          <td></td>
                        </tr>
                      </tbody>
                    
                      <thead class="thead-default">
                        <tr>

                          <th colspan="4">ควรได้รับการพัฒนาด้านใด</th>

                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">1</th>
                          <td></td>
                          <th scope="row">5</th>
                          <td></td>
                        </tr>
                        <tr>
                          <th scope="row">2</th>
                          <td></td>
                          <th scope="row">6</th>
                          <td></td>
                        </tr>
                        <tr>
                          <th scope="row">3</th>
                          <td></td>
                          <th scope="row">7</th>
                          <td></td>
                        </tr>
                           <tr>
                          <th scope="row">4</th>
                          <td></td>
                          <th scope="row">8</th>
                          <td></td>
                        </tr>
                      </tbody>
                       </table>

  <!--Table Grade-->
                       <table class="table ">
                        <thead class="thead-default">
                        <tr>

                          <th colspan="13">การประเมินผลโดยรวม (Overall Rating) </th>

                        </tr>
                      </thead>
                      <tbody>
                    <form>

                        <tr align="center">
                       
                          <th scope="row" rowspan="3">ผลการปฏิบัติงาน</th>  
                            <td><input type="radio" name="A++"></td>
                            <td><input type="radio" name="A+"></td>
                            <td><input type="radio" name="A"></td>
                            <td><input type="radio" name="A-"></td>
                            <td><input type="radio" name="B++"></td>
                            <td><input type="radio" name="B+"></td>
                            <td><input type="radio" name="B"></td>
                            <td><input type="radio" name="B-"></td>
                            <td><input type="radio" name="C++"></td>
                            <td><input type="radio" name="C+"></td>
                            <td><input type="radio" name="C"></td>
                            <td><input type="radio" name="C-"></td>
                            
                       
                        </tr>

                    </form>

                        <tr align="center">
                          
                        
                               <?php
                    
                                $sql_grade = "SELECT * FROM grade ORDER BY standard_max_point desc";
                                                 
                                $query = mysqli_query($conn, $sql_grade); //$conn มาจากไฟล์ connection_mysqli.php เป็นตัว connect DB

                                 ?>
                                <?php  while($result = mysqli_fetch_array($query, MYSQLI_ASSOC)){ 
                                    $name = $result["grade_description"];
                                    $desc = $result["grade_explaned"];
                                    $maxpoint = $result["standard_max_point"];
                                    $minpoint = $result["standard_min_point"];
                                    $id = $result["grade_id"];

                                   
                                ?>
                          <td><?php echo $name; ?></td>
                        <?php } ?>
                    
                        </tr>

                        <tr align="center">
                          
                         
                               <?php
                    
                                $sql_grade = "SELECT * FROM grade ORDER BY standard_max_point desc";
                                                 
                                $query = mysqli_query($conn, $sql_grade); //$conn มาจากไฟล์ connection_mysqli.php เป็นตัว connect DB

                                 ?>
                                <?php  while($result = mysqli_fetch_array($query, MYSQLI_ASSOC)){ 
                                    $name = $result["grade_description"];
                                    $desc = $result["grade_explaned"];
                                    $maxpoint = $result["standard_max_point"];
                                    $minpoint = $result["standard_min_point"];
                                    $id = $result["grade_id"];

                                   
                                ?>
                          <td>(<?php echo $desc; ?>)</td>
                        <?php } ?>
                    
                        </tr>


                        <tr align="center">
                          <th scope="row">คะแนน</th>

                               <?php
                    
                                $sql_grade = "SELECT * FROM grade ORDER BY standard_max_point desc";
                                                 
                                $query = mysqli_query($conn, $sql_grade); //$conn มาจากไฟล์ connection_mysqli.php เป็นตัว connect DB

                                 ?>
                                <?php  while($result = mysqli_fetch_array($query, MYSQLI_ASSOC)){ 
                                    $name = $result["grade_description"];
                                    $desc = $result["grade_explaned"];
                                    $maxpoint = $result["standard_max_point"];
                                    $minpoint = $result["standard_min_point"];
                                    $id = $result["grade_id"];

                                   
                                ?>
                          <td><?php echo $minpoint; ?> - <?php echo $maxpoint; ?></td>
                        <?php } ?>
                        </tr>
                       
                      </tbody>
                    </table>
 
 <!--Table assessor-->

                       <table class="table ">
                      <thead class="thead-inverse">
                        <tr>
                          <th colspan="2">ลงนามผู้ประเมินที่ 1</th>
                          <th colspan="2">ลงนามผู้ประเมินที่ 2</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row" colspan="2" rowspan="4"></th>
                          <th scope="row" colspan="2" rowspan="4"></th>
                          
                        </tr>
                        <tr>
                          <td>ลงชื่อ...........................................................………. </td>
                          <td>ลงชื่อ...........................................................………. </td>
                        </tr>
                        <tr>
                          <td>ตำแหน่ง...........................................………......………</td>
                          <td>ตำแหน่ง...........................................………......………</td>
                          
                        </tr>
                        <tr>
                          <td colspan="2">วันที่ ...................................................................</td>
                          <td colspan="2">วันที่ ...................................................................</td>
                          
                        </tr>
                        
                      </tbody>
                    
                      <thead class="thead-default">
                      <tr>
                          <th colspan="2">ผู้บริหารลงนามอนุมัติผลการประเมิน</th>
                          <th colspan="2">พนักงานรับทราบผลการประเมิน</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row" colspan="2" rowspan="4"></th>
                          <th scope="row" colspan="2" rowspan="4"></th>
                        </tr>
                        <tr>
                          <td colspan="2">ลงชื่อ...........................................................………. </td>
                          <td colspan="2">ลงชื่อ...........................................................………. </td>
                        </tr>
                        <tr>
                          <td colspan="2">ตำแหน่ง...........................................………......………</td>
                          <td colspan="2">ตำแหน่ง...........................................………......………</td>
                          
                        </tr>
                        <tr>
                          <td colspan="2">วันที่ ...................................................................</td>
                          <td colspan="2">วันที่ ...................................................................</td>
                          
                        </tr>
                        
                      </tbody>
                      </tbody>
                       </table>
                   
                                                               
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
