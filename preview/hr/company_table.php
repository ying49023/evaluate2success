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
                        บริษัทที่ใช้แบบประเมิน
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Company</li>
                    </ol>
                </section>
                <!--/Page header -->

                <!-- Main content -->
             
                <div id="filter" class="row box-padding">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">ตารางแสดงรายชื่อบริษัท</h3>
                            <a class="pull-right " data-toggle="collapse" href="#strenghtPoint">
                                <button type="button" class="btn btn-success">เพิ่มบริษัท</button>
                            </a>
                        </div>
                        
                        <!--new comp -->
                        <div class="collapse bg-gray-light box-padding" id="strenghtPoint" >
                            <form action="company_table.php?erp=insert" method="POST">
                                <div class="row">
                                    <div class="col-md-5 col-sm-4 form-group">
                                        <label>ชื่อบริษัท</label>
                                        <input class="form-control" type="text" name="company_name" placeholder="----- กรุณากรอกชื่อบริษัท -----">
                                                    
                                    </div>
                                    <div class="col-md-5 col-sm-5 form-group">
                                        <label>ชื่อเต็มบริษัท</label>
                                        <input class="form-control" type="text" name="company_full_name" placeholder="----- กรุณากรอกชื่อเต็มบริษัท -----">
                                                    
                                    </div>		
                                    <div class="col-md-2 col-sm-3 form-group">
                                        <input class="btn btn-info btn-md" style="margin-top:25px;width: 100%;" type="submit" value="เพิ่ม">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--new comp-->
                        
                        <div class="box-body ">   
                            <!-- ช่องค้นหา by listJS -->
                            <div class="form-group col-md-5 col-sm-6 col-lg-4">
                                <label><i class="glyphicon glyphicon-search" style="padding: 0px 10px;" ></i>ค้นหา</label>
                                <input class="search form-control" placeholder="พิมพ์ค้นหา" >
                            </div>
                            <table  class="table table-bordered table-hover table-striped" >
                                <thead>
                                    <tr class="table-active">
                                        <th class="text-center"><button class="sort" data-sort="com_name">ชื่อบริษัท</button></th>
                                        <th class="text-center"><button class="sort" data-sort="com_full_name">ชื่อเต็มของบริษัท</button></th>
                                        <th class="text-center" style="width: 150px">จัดการ</th>
                                    </tr>
                                </thead>
                                <?php
                    
                                $sql_dept = "SELECT * FROM company";
                                                 
                                $query = mysqli_query($conn, $sql_dept); //$conn มาจากไฟล์ connection_mysqli.php เป็นตัว connect DB

                                 ?>
                                
                               
                                
                                <tbody class="list">
                                    <?php
                                    while ($result = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                                        $name = $result["company_name"];
                                        $fullname = $result["company_full_name"];
                                        $id = $result["company_id"];
                                        ?>
                                    <tr>
                                    <td class="com_name"><?php echo $name; ?></td>
                                    <td class="com_full_name"><?php echo $fullname; ?></td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#<?php echo $id; ?>">
                                            <i class="glyphicon glyphicon-pencil" ></i>แก้ไข
                                        </button>                                                   
                                        |
                                            
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"  data-target="#<?php echo $id; ?>_delete">
                                            <i class="glyphicon glyphicon-remove" ></i>ลบ
                                        </button>
                                        <!--Edit Modal -->
                                            <form class="form-horizontal" name="frmMain" method="post" action="company_table.php?erp=update&id=<?php echo $id; ?>" >
                                                <div class="modal fade" id="<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-blue">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title" id="myModalLabel">แก้ไขข้อมูล</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="input-group col-sm-12" >
                                                                    <label for="ชื่อบริษัท" class="col-sm-4 control-label">ชื่อบริษัท:</label>
                                                                    <div class="col-sm-8">               
                                                                        <input type="text" class="form-control" value="<?php echo $result["company_name"]; ?>" name='textcom'   >
                                                                    </div>
                                                                </div>
                                                                                                                        <div class="input-group col-sm-12" >
                                                                    <label for="ชื่อเต็มบริษัท" class="col-sm-4 control-label">ชื่อเต็มบริษัท:</label>
                                                                    <div class="col-sm-8">               
                                                                        <input type="text" class="form-control" value="<?php echo $result["company_full_name"]; ?>" name='textfullcom'   >
                                                                    </div>
                                                                </div>


                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="submit" class="btn btn-success" value="บันทึก" >
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        <!--Edit Modal -->

                                        <!--Delete Modal -->
                                            <form class="form-horizontal" name="frmMain" method="post" action="company_table.php?erp=delete&id=<?php echo $id; ?>" >
                                                <div class="modal fade" id="<?php echo $id; ?>_delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title" id="myModalLabel">ลบข้อมูล</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="input-group col-sm-12" >
                                                                    <label for="ชื่อบริษัท" class="col-sm-4 control-label">ชื่อบริษัท:</label>
                                                                    <div class="col-sm-8">               
                                                                        <input type="text" class="form-control" value="<?php echo $result["company_name"]; ?>" name='textcom' disabled="true"  >
                                                                    </div>

                                                                </div>
                                                                                                                        <div class="input-group col-sm-12" >
                                                                    <label for="ชื่อเต็มบริษัท" class="col-sm-4 control-label">ชื่อเต็มบริษัท:</label>
                                                                    <div class="col-sm-8">               
                                                                        <input type="text" class="form-control" value="<?php echo $result["company_full_name"]; ?>" name='textfullcom'   >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-danger">ยืนยันการลบ</button>
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        <!--Delete Modal -->
                                    </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <script>
                                    var options = {
                                        valueNames: [ 'com_name','com_full_name']
                                    };

                                    var userList = new List('filter', options);
                                </script>
                               

                            </table>
                         
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
