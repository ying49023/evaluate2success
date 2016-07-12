<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ระบบประเมินผลปฏิบัติงาน : ALT Evaluation</title>
    <!-- CSS PACKS -->
    <?php include ('./css_packs.html'); ?>
    
    <!-- SCRIPT PACKS -->
    <?php include('./script_packs.html') ?>
    <style>
            .box-padding{
                padding: 10px 30px 10px 30px;
            }
            .box-padding-small{
                padding: 10px 15px 10px 15px;
            }
            .search-button{
                max-width: 120px;
                width: 100%;
            }
            #img-box{
              width:120px;
              height: 150px;
              margin: -5px 5px 5px 130px;
              float:left 
            }
           #detail-content{
              width:700px;
              height: 130px;
              margin: 0px 5px 5px 350px;
              

           }
           #menu_status{
            margin: 5px 5px 5px 55px;
            width:100%;
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
            <div id="menu_status">
                <center>
                    <ul class="nav nav-pills">
                        <li class="bg-info" role="presentation" style="width:30%">
                            <a href="evalstep1.php">ส่วนที่1 การวัความสามารถในการปฏิบัติงาน</a>
                        </li>
                        <li class="bg-info" role="presentation" style="width:30%">
                            <a href="prominent_page.php">ส่วนที่2 ความจำเป็นในการพัฒนา</a>
                        </li>
                        <li class="active" role="presentation" class="active" style="width:30%">
                            <a href="complete_page.php">การประเมินเรียบร้อย</a>
                        </li>
                    </ul>
                </center>
            </div>

            <div class="row box-padding">
                <div class="box box-success">
                    <br>
                    <br>
                    <center>
                        <img src="img/icon_success.png" style="width:180px; height:180px "></center>
                    <br>
                    <center>
                        <h4>
                            คุณได้ทำการประเมิน นาย ศตวรรษ วินวิวัฒน์ <b>เรียบร้อยแล้ว!!</b>
                        </h4>
                    </center>
                    <br>
                    <br></div>
            </div>

        </div>

    </div>
    <!-- /.row -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- ./box-body -->

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