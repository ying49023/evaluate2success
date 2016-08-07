<!DOCTYPE html>
<html>
    <head>
        <?php include('./classes/connection_mysqli.php') ?>
        <?php
        $get_kpi_group_id = '';
        if (isset($_GET["kpi_group_id"])) {
            $get_kpi_group_id = $_GET["kpi_group_id"];
        }
        ?>
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
                        ดู KPIs ทั้งหมด
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="#"> <i class="fa fa-dashboard"></i>
                                Home
                            </a>
                        </li>
                        <li class="active">All KPIs</li>
                    </ol>
                </section>
                <!--/Page header -->
                
                <!-- Main content -->
                <div class="row box-padding">
                    <div class="box box-success">
                        <div class="box-body">
                            <form action="" method="GET">
                                <div class="col-sm-offset-1 col-sm-8">
                                    <label class="col-sm-2 control-label">กลุ่ม</label>
                                    <div class="col-sm-10">
                                        <?php
                                        $sql_kpi_group = "SELECT * FROM kpi_group";
                                        $query_kpi_group = mysqli_query($conn, $sql_kpi_group);
                                        ?>
                                        <select class="form-control" name="kpi_group_id">
                                            <option value="" >--แสดงทั้งหมด--</option>
                                            <?php while ($result_kpi_group = mysqli_fetch_array($query_kpi_group, MYSQLI_ASSOC)) { ?>
                                            <option value="<?php echo $result_kpi_group["kpi_group_id"]; ?>" <?php if($get_kpi_group_id == $result_kpi_group["kpi_group_id"]) { echo "selected"; }  ?>>
                                                    <?php echo $result_kpi_group["kpi_group_id"] . " - " . $result_kpi_group["kpi_group_name"]; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class=" col-sm-2">
                                    <input type="submit" class="btn btn-primary search-button " value="ค้นหา" >
                                </div>
                                
                            </form>
                        </div>
                    </div>
                    
                </div>
                <?php 
                                
                $condition_search = '';
                
                if($get_kpi_group_id != '' ){
                    $condition_search = " WHERE kg.kpi_group_id = '".$get_kpi_group_id."'";
                }                
                ?>
                <div class="row box-padding">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <b>รายชื่อ KPIs ทั้งหมด</b>
                            <button type="button" class="pull-right btn btn-success btn-sm" data-toggle="modal" data-target="#new_kpi">
                                <i class="glyphicon glyphicon-plus" ></i> &nbsp;เพิ่ม
                            </button>  
                        </div>
                        <!-- Modal New-->   
                        <div class="modal animated fade " id="new_kpi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="new_kpi.php" method="post">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">เพิ่มหัวข้อ KPI</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div style="width: 75%;margin: auto;">
                                                        <div class="form-group">
                                                            <label class="pull-left">ชื่อหัวข้อKPI<span style="color: red;">*</span></label>
                                                            <input type="text" class="form-control" name="kpi_name" placeholder="ชื่อหัวข้อKPI" required />
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label class="pull-left">คำอธิบาย </label>
                                                            <input type="text" class="form-control" name="kpi_description" placeholder="คำอธิบายKPI" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="pull-left">หน่วย</label>
                                                            <input type="text" class="form-control" name="unit" placeholder="ระบุหน่วย" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="pull-left">ระยะเวลา(เดือน)</label>
                                                            <input type="text" class="form-control" name="time_period" placeholder="ระบุระยะเวลา" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="pull-left">กลุ่ม</label>
                                                            <?php
                                                            $sql_kpi_group = "SELECT * FROM kpi_group" ;
                                                            $query_kpi_group = mysqli_query($conn, $sql_kpi_group);
                                                            ?>
                                                            <select class="form-control" name="kpi_group_id" required>
                                                                <option value="" >--เลือกกลุ่ม--</option>
                                                                <?php while($result_kpi_group = mysqli_fetch_array($query_kpi_group,MYSQLI_ASSOC)) { ?>
                                                                <option value="<?php echo $result_kpi_group["kpi_group_id"]; ?>" ><?php echo $result_kpi_group["kpi_group_id"]." - ".$result_kpi_group["kpi_group_name"]; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>                                    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input class="btn btn-primary" type="submit" name="submit" value="บันทึก" />
                                            <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                        </div>
                                    </form>
                                </div>
                            </div>  
                        </div>
                        <!--/Modal New-->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                <?php
                                $sql_kpi = "SELECT
                                                    k.kpi_id AS kpi_id,
                                                    k.kpi_name AS kpi_name,
                                                    k.kpi_description AS kpi_description,
                                                    kg.kpi_group_name,
                                                    k.time_period as time_period,
                                                    k.unit AS unit,
                                                    k.kpi_group_id
                                            FROM
                                                    kpi k
                                            JOIN kpi_group kg ON k.kpi_group_id = kg.kpi_group_id
                                            ".$condition_search."
                                            ORDER BY
                                                    k.kpi_id";
                                $query_kpi = mysqli_query($conn, $sql_kpi);
                                
                                ?>
                                    <table class="table table-hover table-responsive table-striped">                               
                                        <thead>
                                            <tr>
                                                <th style="width: 60px;">ID</th>
                                                <th>ชื่อKPIs</th>
                                                <th>คำอธิบาย</th>
                                                <th style="width: 80px;text-align: center;">หน่วย</th>
                                                <th style="width: 80px;text-align: center;">ระยะเวลา(เดือน)</th> 
                                                <th style="width: 150px;">กลุ่มหมวดหมู่</th>
                                                <th style="width: 80px;">แก้ไข/ลบ</th>
                                            </tr>
                                        </thead>
                                    <?php while ($result_kpi = mysqli_fetch_array($query_kpi, MYSQLI_ASSOC)) { ?>
                                        <tr>
                                            <td><b><?php echo $result_kpi["kpi_id"]; ?></b></td>
                                            <td><?php echo $result_kpi["kpi_name"]; ?></td>
                                            <td><?php echo $result_kpi["kpi_description"]; ?></td>
                                            <td class="text-center"><?php echo $result_kpi["unit"]; ?></td>
                                            <td class="text-center"><?php echo $result_kpi["time_period"]; ?></td>
                                            <td><?php echo $result_kpi["kpi_group_name"]; ?></td>
                                            <td><div class="dropdown">
                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    <i class="glyphicon glyphicon-cog"></i>
                                                  <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                  <li><a data-toggle="modal" href="#edit_kpi_<?php echo $result_kpi["kpi_id"]; ?>" ><i class="glyphicon glyphicon-pencil"></i>แก้ไข</a></li>
                                                  <li role="separator" class="divider"></li>
                                                  <li><a href="#" data-toggle="modal" data-target="#confirm-delete" data-href="delete_kpi.php?kpi_id=<?php echo $result_kpi["kpi_id"]; ?>&kpi_group_id=<?php echo $get_kpi_group_id; ?>">
                                                          <i class="glyphicon glyphicon-remove"></i>ลบ</a>
                                                  </li>
                                                  
                                                </ul>
                                              </div>
                                                <!--Modal delete-->
                                                      <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                          <div class="modal-dialog">
                                                              <div class="modal-content">

                                                                  <div class="modal-header">
                                                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                      <h4 class="modal-title" id="myModalLabel">ยืนยันการลบ</h4>
                                                                  </div>

                                                                  <div class="modal-body">
                                                                      <p></p>
                                                                      
                                                                      <p class="debug-url"></p>
                                                                  </div>

                                                                  <div class="modal-footer">
                                                                      <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                                                                      <a class="btn btn-danger btn-ok">ลบ</a>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <!--/Modal delete-->
                                                        <script>
                                                            $('#confirm-delete').on('show.bs.modal', function(e) {
                                                                $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

//                                                                $('.debug-url').html('Delete URL: <b style="color:red;">' + $(this).find('.btn-ok').attr('href') + '</b>');
                                                            });
                                                        </script>
                                            </td>
                                        </tr>
                                        <tr>
                                        <form action="edit_kpi.php" method="post" >
                                        <!-- Modal Edit -->   
                                            <div class="modal animated fade " id="edit_kpi_<?php echo $result_kpi["kpi_id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="myModalLabel">แก้ไขหัวข้อ KPI</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div style="width: 75%;margin: auto;">
                                                                        <div class="form-group">
                                                                            <label class="pull-left">ชื่อหัวข้อKPI </label>
                                                                            <input type="text" class="form-control" name="kpi_name" placeholder="ชื่อหัวข้อKPI" value="<?php echo $result_kpi["kpi_name"]; ?>" >
                                                                                    
                                                                        </div>
                                                                                
                                                                        <div class="form-group">
                                                                            <label class="pull-left">คำอธิบาย </label>
                                                                            <input type="text" class="form-control" name="kpi_description" placeholder="คำอธิบายKPI" value="<?php echo $result_kpi["kpi_description"]; ?>" >
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="pull-left">หน่วย </label>
                                                                            <input type="text" class="form-control" name="unit" placeholder="ระบุหน่วย" value="<?php echo $result_kpi["unit"]; ?>" >
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="pull-left">ระยะเวลา(เดือน)</label>
                                                                            <input type="text" class="form-control" name="time_period" placeholder="ระบุระยะเวลา" value="<?php echo $result_kpi["time_period"]; ?>" >
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="pull-left">กลุ่ม</label>
                                                                                <?php
                                                                                $sql_kpi_group = "SELECT * FROM kpi_group";
                                                                                $query_kpi_group = mysqli_query($conn, $sql_kpi_group);
                                                                                ?>
                                                                            <select class="form-control" name="kpi_group_id" required>
                                                                                <option value="" >--เลือกกลุ่ม--</option>
                                                                                    <?php while ($result_kpi_group = mysqli_fetch_array($query_kpi_group, MYSQLI_ASSOC)) { ?>
                                                                                <option value="<?php echo $result_kpi_group["kpi_group_id"]; ?>" <?php if ($result_kpi["kpi_group_id"] == $result_kpi_group["kpi_group_id"]) {
                                                                                    echo "selected";
                                                                                } ?> >
                                                                                        <?php echo $result_kpi_group["kpi_group_id"] . " - " . $result_kpi_group["kpi_group_name"]; ?>
                                                                                </option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div>                                            
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input class="btn btn-primary" type="submit" name="submit" value="บันทึก" >
                                                            <input type="hidden" name="kpi_id" value="<?php echo $result_kpi["kpi_id"]; ?>" >
                                                            <input type="hidden" name="kpi_current_group_id" value="<?php echo $get_kpi_group_id; ?>" >
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                        </div>                 
                                                    </div>
                                                </div>  
                                            </div>
                                            <!--/Modal Edit-->
                                            </form>
                                        </tr>
                                        
                                    <?php } ?>
                                        
                                    </table>
                                </div>
                            </div>
                            
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