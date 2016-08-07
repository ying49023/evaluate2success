<!DOCTYPE html>
<html>
    <head>
        <?php include('./classes/connection_mysqli.php') ?>
        <?php 
            if(isset($_GET['level']))
            $level=$_GET['level'];
            if(isset($_GET['level_name']))
            $level_name=$_GET['level_name'];
        ?>
                <?php
        //Insert
        if(isset($_GET["submit_insert"])){
            $level_name=$_GET['name'];
            $detail=$_GET["competency_detail"];
            $title= $_GET["competency_title"];
            $status=1;
            $position=$level; 
            $weight=$_GET["t_weight"];
            $sql_insert_group = "INSERT INTO match_competency(competency_id,title_id,status,position_level_id,weight) VALUES($detail,$title,$status,$position,$weight)";
            if (mysqli_query($conn, $sql_insert_group)) {
                    echo "Record new successfully";
                    echo $sql_insert_group;
                } else {
                    echo "Error new record: " . mysqli_error($conn);
                    echo $sql_insert_group;
                }
                    
                //header("Location: competency_match.php");
            }
        //Edit
        if(isset($_GET["submit_edit"])){
            $name=$_GET["title_name"];
            $weight= $_GET["weight"];
            $id=$_GET["title_id"];
            
            $sql_edit_group = "UPDATE competency_title SET title_name='$name', weight='$weight' WHERE title_id='$id'";
            if (mysqli_query($conn, $sql_edit_group)) {
                    echo "Record edit successfully";
                    echo $sql_edit_group;
                } else {
                    echo "Error edit record: " . mysqli_error($conn);
                    echo $sql_edit_group;
                }
                    
                header("Location: competency_title.php");
            }
        //Delete  
        if(isset($_GET["delete_group"])){
            
            $sql_delete_group = "DELETE FROM competency_title WHERE title_id='".$_GET["titleid"]."'";
            if (mysqli_query($conn, $sql_delete_group)) {
                    echo "Record new successfully";
                    echo $sql_delete_group;
                } else {
                    echo "Error new record: " . mysqli_error($conn);
                    echo $sql_delete_group;
                }
                    
                header("Location: competency_title.php");
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
                        Competency 
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="#"> <i class="fa fa-dashboard"></i>
                                Home
                            </a>
                        </li>
                        <li class="active">Competency</li>
                    </ol>
                </section>
                <!--/Page header -->
                
                <!-- Main content -->
                <div class="row box-padding">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <b>การจัดการแบบประเมินระดับ<?php echo $level_name;?></b>
                            <button class="btn btn-success pull-right"  data-toggle="collapse" data-target="#newKPIGroup">+ เพิ่ม</button>
                            
                        </div>
                        <div id="newKPIGroup" class="collapse">
                            <form action="" method="get">
                                <div class="box-padding row">
                                    <div class="form-group col-sm-4">
                                    <?php
                                    //INSERT INTO match_competency(competency_id,title_id,status,position_level_id,weight) VALUES(19,17,0,1,10)
                                    $sql_competency_title = "SELECT * FROM competency_title  ";
                                    $query_competency_title  = mysqli_query($conn, $sql_competency_title );
                                    ?>
                                        <label>Title<span style="color: red;">*</span></label>
                                        <select class="form-control" name="competency_title">
                                                <option value="">--เลือก--</option>
                                                <?php while ($result_competency_title = mysqli_fetch_array($query_competency_title)) { ?>
                                                    <option <?php if($result_competency_title["title_id"]){ echo "selected";} ?> value="<?php echo $result_competency_title["title_id"]; ?>"  >
                                                        <?php echo $result_competency_title["title_id"] . " - " . $result_competency_title["title_name"]; ?>
                                                    </option>
                                                <?php } ?>
                                        </select>  
                                    </div>
                                    <div class="form-group col-sm-4">
                                    <?php
                                    $sql_competency = "SELECT * FROM competency ";
                                    $query_competency = mysqli_query($conn, $sql_competency);
                                    ?>
                                        <label>Detail<span style="color: red;">*</span></label>
                                        <select class="form-control" name="competency_detail">
                                                <option value="">--เลือก--</option>
                                                <?php while ($result_competency = mysqli_fetch_array($query_competency)) { ?>
                                                    <option <?php if($result_competency["competency_id"]){ echo "selected";} ?> value="<?php echo $result_competency["competency_id"]; ?>"  >
                                                        <?php echo $result_competency["competency_id"] . " - " . $result_competency["competency_description"]; ?>
                                                    </option>
                                                <?php } ?>
                                        </select>    
                                    </div>
                                    <div class="form-group col-sm-2">                                        
                                        <label>Weight<span style="color: red;">*</span></label>
                                        <input class="form-control" type="text"  step="5" name="t_weight" required > 
                                    </div>
                                    <div class="form-group col-sm-1">
                                        <input style="margin-top: 25px;" class="btn btn-danger" type="submit"  name="submit_insert" value="บันทึก" > 
                                        <input  type="hidden" name="level" value="<?php echo $level; ?>" >
                                        <input  type="hidden" name="name" value="<?php echo $level_name; ?>" >
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <?php
                                $sql_mng = "SELECT m.match_comp_id as match_comp,c.competency_description as detail,t.title_name as title,p.position_description as position,m.weight as weight FROM match_competency m JOIN competency c ON m.competency_id=c.competency_id JOIN competency_title t ON m.title_id=t.title_id JOIN position_level p ON p.position_level_id=m.position_level_id WHERE m.position_level_id='$level'";
                                $query_mng= mysqli_query($conn, $sql_mng);
                                
                                ?>
                                    <table class="table table-hover table-responsive table-striped table-bordered">                               
                                        <thead>
                                            <tr>
                                                <th style="width: 120px;">Match Comp ID</th>
                                                <th>Title</th>
                                                <th>Detail</th>
                                                
                                                <th style="text-align: center;">Weight</th>
                                                <th style="width: 150px;text-align: center;">Management</th>

                                            </tr>
                                        </thead>
                                    <?php while ($result_mng = mysqli_fetch_array($query_mng, MYSQLI_ASSOC))  {
                                        $m_id = $result_mng["match_comp"];
                                        $m_title = $result_mng["title"];
                                        $m_detail = $result_mng["detail"];
                                        $m_position = $result_mng["position"];
                                        $m_weight = $result_mng["weight"];
                                        ?>
                                        <tr>
                                            <td><b><?php echo $m_id; ?></b></td>
                                            <td><?php echo $m_title; ?></td>
                                            <td><?php echo $m_detail; ?></td>
                                            
                                            <td><?php echo $m_weight; ?></td>
                                            <td style="text-align: center;">

                                                <a class="btn btn-default btn-sm" data-toggle="modal" href="#edit_kpi_group_<?php echo $result_com["title_id"]; ?>" ><i class="glyphicon glyphicon-pencil"></i>แก้ไข</a>

                                                  <a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#confirm-delete" data-href="competency_title.php?titleid=<?php echo $result_com["title_id"]; ?>&delete_group=1">
                                                          <i class="glyphicon glyphicon-remove"></i>ลบ</a>


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
                                        <form action="" method="get" >
                                        <!-- Modal Edit -->   
                                            <div class="modal animated fade " id="edit_kpi_group_<?php echo $result_com["title_id"];; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="myModalLabel">แก้ไขหัวข้อ</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div style="width: 75%;margin: auto;">
                                                                        <div class="form-group">
                                                                            <label class="pull-left">หัวข้อ</label>
                                                                            <input type="text" class="form-control" name="title_name"  value="<?php echo $result_com["title_name"]; ?>" required >
                                                                            <br>
                                                                            <label class="pull-left">น้ำหนัก</label>
                                                                            <input type="text" class="form-control" name="weight"  value="<?php echo $result_com["weight"]; ?>" required >        
                                                                        </div>
                                                                                                            
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input class="btn btn-primary" type="submit" name="submit_edit" value="บันทึก" >
                                                            <input type="hidden" name="title_id" value="<?php echo $result_com["title_id"]; ?>" >
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                        </div>                 
                                                    </div>
                                                </div>  
                                            </div>
                                            <!--/Modal Edit-->
                                            </form>
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