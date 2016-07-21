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
    
    <!-- SCRIPT PACKS -->
    <?php include('./script_packs.html') ?>
    
    <style>
      table.table tr td,th{
                  text-align: center;
              }
                  
    </style>

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

          <h1>แบบฟอร์มประเมินผลการปฏิบัติงาน<small>แบบเน้น Competency, KPIs และ Development</small></h1>

          <ol class="breadcrumb">
              <li>
                  <a href="#"> <i class="fa fa-dashboard"></i>
                      Home
                  </a>
              </li>
              <li class="active">Evaluation</li>
          </ol>
          <hr>
      </section>
      <!--/Page header -->

      <!-- Main content -->
      <!--Step progress-->
      <div id="menu_status">
        <center>
          <ul class="nav nav-pills">
            <li class="bg-info" role="presentation" style="width:30%">
                <a href="evalstep1.php">ส่วนที่1 การวัความสามารถในการปฏิบัติงาน</a>
            </li>
            <li class="active" role="presentation" style="width:30%">
                <a href="prominent_page.php">ส่วนที่2 ความจำเป็นในการพัฒนา</a>
            </li>
            <li class="bg-info" role="presentation" class="active" style="width:30%">
                <a href="complete_page.php">การประเมินเรียบร้อย</a>
            </li>
          </ul>
        </center>
      </div>
      <!--/Step progress-->

      <!--ข้อมูลทั่วไป-->
      <div class="row box-padding">
          <div class="box box-success">
              <div class="box-body">
                  <div class="row"> 
                      <div class="box-padding">
                          <!--ข้อมูลทั่วไป-->
                          <table class="table table-bordered table-condensed">
                              <tbody><tr>
                                      <th rowspan="4">
                                          <img class="circle-thumbnail img-circle img-responsive img-thumbnail" src="img/emp1.jpg">
                                      </th>
                                      <th align="center" width="">ชื่อ-นามสกุล</th>
                                      <th align="center" width="120px">รหัส</th>
                                      <th align="center" width="">ตำแหน่ง</th>
                                      <th align="center" width="">แผนก</th>
                                      <th align="center" width="">ครั้งที่ 1 </th>

                                  </tr>
                                  <tr>
                                      <td>นาย ศตวรรษ วินวิวัฒน์</td>
                                      <td> 123456</td>
                                      <td>พนักงานฝ่ายบุคคล</td>
                                      <td>ฝ่ายบุคคล</td>
                                      <td><span class="text-green"><i class="glyphicon glyphicon-ok"></i></span></td>
                                  </tr>
                              </tbody>
                          </table><!--/ข้อมูลทั่วไป-->
                          <a class="" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                              <i class="glyphicon glyphicon-triangle-bottom"></i>รายละเอียดบุคคลเพิ่มเติม
                          </a>
                          <div class="collapse" id="collapseExample" style="margin-top:10px;">
                              <table class="table table-responsive table-bordered ">
                                  <thead>
                                      <tr class="">
                                          <th colspan="3">วันที่เริ่มงาน</th>
                                          <th colspan="3">ผู้บังคับบัญชา</th>
                                      </tr>
                                  </thead>
                                  <tr>
                                      <td colspan="3">1 ก.พ. 2556</td>
                                      <td colspan="3">นาย นภัทร อินทร์ใจเอื้อ</td>
                                  </tr>
                                  <thead>
                                      <tr class="">
                                          <th colspan="6">
                                              สถิติการมาปฏิบัติงาน
                                          </th>
                                      </tr>
                                      <tr>
                                          <th>ลาป่วย</th>
                                          <th>ลากิจ</th>
                                          <th>ลาอื่นๆ</th>
                                          <th>ขาดงาน</th>
                                          <th>ลางาน</th>
                                          <th width="16%">ลงโทษทางวินัย</th>
                                      </tr>
                                  </thead>
                                  <TR>
                                      <TD>1วัน</TD>
                                      <TD>1วัน</TD>
                                      <TD>-</TD>
                                      <TD>-</TD>
                                      <TD>2วัน</TD>
                                      <TD>-</TD>
                                  </TR>
                              </table>
                          </div>
                      </div>
                  </div>  
              </div>
          </div>
      </div>
  
        <div class="row box-padding">
          <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">ความจำเป็นในการพัฒนา<small> (ผู้บังคับบัญชาวิเคราะห์จากสภาพที่พบจริงร่วมกับที่พบว่าเป็น gap จากการประเมินในส่วนที่ 3)</small> </h3>
                <a class="pull-right " data-toggle="collapse" href="#strenghtPoint">เพิ่มหัวข้อ</a>
            </div>
                <div class="box-body">
                    <div class="collapse bg-gray-light box-padding" id="strenghtPoint" >
                        <form>
                        <div class="row">
                            <div class="col-sm-offset-1 col-sm-3">
                                ประเภท
                                <select class="form-control">
                                    <option>จุดเด่น</option>
                                    <option>จุดด้อย</option>
                                    <option>จุดที่ควรพัฒนา</option>
                                </select>
                            </div>
                            <div class="col-sm-5">
                                หัวข้อ
                                <select class="form-control">
                                    <option>การดำเนินตามแผนและติดตามผลงาน</option>
                                    <option>การแก้ไขปัญหาและการตัดสินใจ</option>
                                    <option>การพัฒนาผู้ใต้บังคับบัญชา</option>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <input class="btn btn-danger btn-md" style="margin-top:20px;width: 100%;" type="submit" value="เพิ่ม">
                                </div>
                                
                            </div>
                        </div>
                        </form>
                      </div>
                <form>
                    <div class="row box-padding">
                        <div class="row">
                            <div class="col-sm-12">
                                <p><strong>จุดเด่นของผู้ถูกประเมิน</strong></p>
                            </div> 
                        </div>
                        <div class="col-sm-4">
                            <div class="checkbox">
                              <label> <input type="checkbox" name="prominent" value="planing">
                                  การวางแผน
                              </label>
                          </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="checkbox">
                              <label> <input type="checkbox" name="prominent" value="planing">
                                  การดำเนินตามแผนและติดตามผลงาน
                              </label>
                          </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="checkbox">
                              <label> <input type="checkbox" name="prominent" value="planing">
                                  การแก้ไขปัญหาและการตัดสินใจ
                              </label>
                          </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="checkbox">
                              <label> <input type="checkbox" name="prominent" value="planing">
                                  การพัฒนาผู้ใต้บังคับบัญชา
                              </label>
                          </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="checkbox">
                              <label> <input type="checkbox" name="prominent" value="planing">
                                  การสร้างทีมงาน
                              </label>
                          </div>
                        </div>
                        
                    </div>
                    
                    <div class="row box-padding">
                        <div class="row">
                            <div class="col-sm-12">
                                <p><strong>จุดที่ควรพัฒนาปรับปรุงของผู้ถูกประเมิน</strong></p>
                            </div> 
                        </div>
                        <div class="col-sm-4">
                            <div class="checkbox">
                              <label> <input type="checkbox" name="prominent" value="planing">
                                  การวางแผน
                              </label>
                          </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="checkbox">
                              <label> <input type="checkbox" name="prominent" value="planing">
                                  การดำเนินตามแผนและติดตามผลงาน
                              </label>
                          </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="checkbox">
                              <label> <input type="checkbox" name="prominent" value="planing">
                                  การแก้ไขปัญหาและการตัดสินใจ
                              </label>
                          </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="checkbox">
                              <label> <input type="checkbox" name="prominent" value="planing">
                                  การพัฒนาผู้ใต้บังคับบัญชา
                              </label>
                          </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="checkbox">
                              <label> <input type="checkbox" name="prominent" value="planing">
                                  การสร้างทีมงาน
                              </label>
                          </div>
                        </div>
                    </div>
                    <div class="row box-padding">
                        <div class="row">
                            <div class="col-sm-12">
                                <p><strong>หลักสูตรการฝึกอบรมหรือแนวทางที่ควรพัฒนา</strong></p>
                            </div> 
                        </div>
                        <div class="col-sm-4">
                            <div class="checkbox">
                              <label> <input type="checkbox" name="prominent" value="planing">
                                  การวางแผน
                              </label>
                          </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="checkbox">
                              <label> <input type="checkbox" name="prominent" value="planing">
                                  การดำเนินตามแผนและติดตามผลงาน
                              </label>
                          </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="checkbox">
                              <label> <input type="checkbox" name="prominent" value="planing">
                                  การแก้ไขปัญหาและการตัดสินใจ
                              </label>
                          </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="checkbox">
                              <label> <input type="checkbox" name="prominent" value="planing">
                                  การพัฒนาผู้ใต้บังคับบัญชา
                              </label>
                          </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="checkbox">
                              <label> <input type="checkbox" name="prominent" value="planing">
                                  การสร้างทีมงาน
                              </label>
                          </div>
                        </div>
                    </div>

                </form>
                <div class="box-footer">
                  <center>
                  <a href="complete_page.php">
                    <button class="btn btn-success">ยืนยันการประเมิน</button>
                  </a>
                </center>
                </div>
                
              </div>
            </div>

          </div>
        </div>
      </div>
      <!--/ข้อมูลทั่วไป-->

      <!-- /.content-wrapper -->

      <!--Footer -->
      <?php include './footer.php'; ?>

      <!-- Control Sidebar -->
      <?php include './controlsidebar.php'; ?>

      <!-- Add the sidebar's background. This div must be placed
                 immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div>
  </div>
  <!-- ./wrapper -->

</body>
</html>