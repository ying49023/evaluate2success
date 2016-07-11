<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ระบบประเมินผลปฏิบัติงาน : ALT Evaluation</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
                 folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!--popup jquery-->
    

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!--CSS ปรับแต่งเอง -->
    <link rel="stylesheet" href="customize.css">

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

                <h1>หน้าแก้ไขแบบฟอร์มประเมินผลการปฏิบัติงาน</h1>
                
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
            
            <!--/Process bar-->

            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>      
                <script type="text/javascript">  
                $(function(){  
                    $(".show_box").click(function(){  
                        $("#overlay").fadeToggle("",function(){ // แสดงส่วนของ overlay  
                            $(".msg_show").slideToggle("",function(){ // แสดงส่วนของ เนื้อหา popup  
                                if($(this).css("display")=="block"){        // ถ้าเป็นกรณีแสดงข้อมูล   
                                //  หากต้องการดึงข้อมูลมาแสดง แบบ ajax  
                                //  สามารถดัดแปลงจากโค้ดนี้ได้        
                                //  $(".msg_data").load("data.php");      
                                //      หรือ  
                                //  $.post("data.php",{},function(data){  
                                //      $(".msg_data").html(data);  
                                //  });  
                                }  
                            });  
                        });  
                    });  
                });  

                


            </script>
                  
            
                <style type="text/css">    
                 html {     
                        height: 100%;     
                        }     
                body {     
                    background: #FFF;     
                    padding: 0;     
                    margin: 0;     
                    width: 100%;     
                    height: 100%;    
                 }    
                #overlay {     
                    background:#000;  
                    width:100%;  
                    height:100%;  
                    z-index:80000;  
                    top:0px;  
                    left:0px;  
                    position:fixed;  
                    opacity: .5;     
                    filter: alpha(opacity=50);     
                    -moz-opacity: .5;    
                    display:none;  
                }     
                .msg_show{  
                    position:fixed;  
                    z-index:90000;  
                    margin:auto;  
                    width:600px;  
                    height:350px;  
                    top: 50%;  
                    left: 50%;  
                    margin-top: -100px;  
                    padding-top: 2%;
                    margin-left: -250px;  
                    border-radius: 36px 36px 36px 36px;  
                    -moz-border-radius: 36px 36px 36px 36px;  
                    -webkit-border-radius: 36px 36px 36px 36px;  
                    border: 0px solid #000000;    
                    background-color:#fff;  
                    text-align:center;  
                    display:none;  
                }  
                </style>   

            <div id="sticky-anchor"></div>
          

            <div class="row box-padding ">
                <div class="box box-primary">
                    <div class="box-header with-border">
                                                
                        
                    </div>
                    <!-- /.box-header -->
                    <!--box-body-->
                    <div class="box-body">
                        <!-- /.row -->
                        <div class="row">
                            <div class="box-padding-small">
                                <center>
                                    <TABLE class="table table-bordered table-hover" HEIGHT="100" WIDTH="100%" border="1" >
                                        <thead>
                                            <TR class="bg-primary">
                                            <th colspan="13">
                                                <h3>แบบฟอร์มประเมินผลการปฏิบัติงาน แบบเน้น Competency, KPIs และ Dehvelopment</h3>                                               
                                                <form class="form-inline">
                                                <div class="form-group">
                                                
                                                <select class="form-control">
                                                          <option>สำหรับตำแหน่งระดับปฏิบัติการ (พนักงานที่ไม่มีผู้ใต้บังคับบัญชาขึ้นตรง)</option>
                                                          <option>สำหรับตำแหน่งระดับบังคับบัญชา (หัวหน้างานหรือเทียบเท่าที่มีผู้ใต้บังคับบัญชาขึ้นตรง)</option>
                                                          <option>สำหรับตำแหน่งผู้ช่วยผู้จัดการฝ่าย ถึงผู้อำนวยการ</option>
                                                          <option>สำหรับตำแหน่งรองกรรมการผู้อำนวยการ/ รองกรรมการผู้จัดการขึ้นไป</option>
                                                          
                                                </select>
                                                </div>
                                                </form>
                                            </th>
                                          </TR>
                                            <TR class="bg-info">
                                                <th style="padding-top:25px;" rowspan="2" colspan="4">ความสามารถ(Competency)</th>
                                                <th style="padding-top:25px;" rowspan="2" >%น้ำหนัก(W)</th>
                                                <th colspan="2">ระดับที่คาดหวัง (E)</th>
                                                <th colspan="6">ระดับที่ทำจริง (A)</th>
                                            </TR>
                                            <tr class="bg-info">
                                                <td>ระดับ</td>
                                                <td>รวม</td>
                                                <td>1</td>
                                                <td>2</td>
                                                <td>3</td>
                                                <td>4</td>
                                                <td>5</td>
                                                <td> </td>
                                            </tr>
                                        </thead>
                                        <TR class="bg-info">
                                            <th colspan="13">
                                                ความสามารถในการปฏิบัติงาน (Competency) - ผู้บังคับบัญชากรุณาทำความเข้าใจ "คำอธิบายระดับความสามารถ" เพื่อประเมินได้ถูกต้อง
                                            </th>
                                        </TR>

                                        <TR>
                                            <th style="text-align:left"  colspan="13" class="bg-success">ความสามารถในการบริหารหรือจัดการงาน (10%)
                                            <a class="show_box" href="javascript:void(0);">เพิ่มหัวข้อ</a>  
                                            <!--เนื้อหาภายในเว็บ-->                                         

                                            <div class="msg_show">  
                                            
                                            <div class="msg_data">  
                                            <div class="col-md-12">
                                            <!--เนื้อหาใน popup message--> 
                                                <form >
                                                    <div class="form-group">
                                                        <label>ชื่อหัวข้อ: </label>
                                                        <input type="text" class="form-control" 
                                                        placeholder="ชื่อหัวข้อ">
                                                        <label>น้ำหนัก</label>
                                                        <select class="form-control">
                                                          <option>1</option>
                                                          <option>2</option>
                                                          <option>3</option>
                                                          <option>4</option>
                                                          <option>5</option>
                                                        </select>
                                                        <label>ระดับที่คาดหวัง</label>
                                                        <select class="form-control">
                                                          <option>1</option>
                                                          <option>2</option>
                                                          <option>3</option>
                                                          <option>4</option>
                                                          <option>5</option>
                                                        </select>
                                                        <br/>
                                                        <button href="javascript:void(0);" type="button" class="btn btn-success show_box">บันทึก</button>
                                                    </div>

                                                    </div>
                                                </form>
                                            </div>  
                                            </div>  
                                            <div id="overlay"></div>  
                                              
                                            </th>

                                        </TR>
                                        <TR>
                                            <td style="text-align:left" colspan="4">1. การวางแผนงาน</td>
                                              
                                            <div id="overlay"></div>  

                                            <td >3</td>
                                            <td >2</td>
                                            <td >6</td>
                                            <td >
                                                <input type="radio" name="optradio"></td>
                                            <td >
                                                <input type="radio" name="optradio"></td>
                                            <td >
                                                <input type="radio" name="optradio"></td>
                                            <td >
                                                <input type="radio" name="optradio"></td>
                                            <td >
                                                <input type="radio" name="optradio"></td>
                                            <td class="text-center">
                                                <a href="">
                                                    <i class="glyphicon glyphicon-pencil"></i>
                                                </a>
                                                |
                                                <a href="">
                                                    <i class="glyphicon glyphicon-trash"></i>
                                                </a>
                                            </td>
                                        </TR>
                                        
                                        <TR>
                                            <td style="text-align:left" colspan="4">2. การดำเนินการตามแผนและติดตามผลงาน</td>

                                            <td >3</td>
                                            <td >3</td>
                                            <td >9</td>
                                            <td >
                                                <input type="radio" name="optradio2"></td>
                                            <td >
                                                <input type="radio" name="optradio2"></td>
                                            <td >
                                                <input type="radio" name="optradio2"></td>
                                            <td >
                                                <input type="radio" name="optradio2"></td>
                                            <td >
                                                <input type="radio" name="optradio2"></td>
                                            <td class="text-center">
                                                <a href="">
                                                    <i class="glyphicon glyphicon-pencil"></i>
                                                </a>
                                                |
                                                <a href="">
                                                    <i class="glyphicon glyphicon-trash"></i>
                                                </a>
                                            </td>
                                        </TR>
                                        <TR>
                                            <td style="text-align:left" colspan="4">3. การแก้ไขปัญหาและการตัดสินใจ</td>

                                            <td >3</td>
                                            <td >3</td>
                                            <td >9</td>
                                            <td >
                                                <input type="radio" name="optradio3"></td>
                                            <td >
                                                <input type="radio" name="optradio3"></td>
                                            <td >
                                                <input type="radio" name="optradio3"></td>
                                            <td >
                                                <input type="radio" name="optradio3"></td>
                                            <td >
                                                <input type="radio" name="optradio3"></td>
                                            <td class="text-center">
                                                <a href="">
                                                    <i class="glyphicon glyphicon-pencil"></i>
                                                </a>
                                                |
                                                <a href="">
                                                    <i class="glyphicon glyphicon-trash"></i>
                                                </a>
                                            </td>
                                        </TR>
                                        <TR>
                                            <td style="text-align:left" colspan="4">4. การพัฒนาผู้ใต้บังคับบัญชา</td>

                                            <td >2</td>
                                            <td >2</td>
                                            <td >4</td>
                                            <td >
                                                <input type="radio" name="optradio4"></td>
                                            <td >
                                                <input type="radio" name="optradio4"></td>
                                            <td >
                                                <input type="radio" name="optradio4"></td>
                                            <td >
                                                <input type="radio" name="optradio4"></td>
                                            <td >
                                                <input type="radio" name="optradio4"></td>
                                            <td class="text-center">
                                                <a href="">
                                                    <i class="glyphicon glyphicon-pencil"></i>
                                                </a>
                                                |
                                                <a href="">
                                                    <i class="glyphicon glyphicon-trash"></i>
                                                </a>
                                            </td>
                                        </TR>
                                        <TR>
                                            <td style="text-align:left" colspan="4">5. การสร้างทีมงาน</td>

                                            <td >1</td>
                                            <td >3</td>
                                            <td >3</td>
                                            <td >
                                                <input type="radio" name="optradio5"></td>
                                            <td >
                                                <input type="radio" name="optradio5"></td>
                                            <td >
                                                <input type="radio" name="optradio5"></td>
                                            <td >
                                                <input type="radio" name="optradio5"></td>
                                            <td >
                                                <input type="radio" name="optradio5"></td>
                                            <td class="text-center">
                                                <a href="">
                                                    <i class="glyphicon glyphicon-pencil"></i>
                                                </a>
                                                |
                                                <a href="">
                                                    <i class="glyphicon glyphicon-trash"></i>
                                                </a>
                                            </td>
                                        </TR>

                                        <TR>
                                            <th style="text-align:left" colspan="13" class="bg-success">ความสามารถในงาน (ความรู้ ,ทักษะ ,คุณสมบัติเฉพาะบุคคล) (20%)
                                            <a class="show_box" href="javascript:void(0);">เพิ่มหัวข้อ</a>  
                                            <!--เนื้อหาภายในเว็บ-->                                         

                                            <div class="msg_show">  
                                            
                                            <div class="msg_data">  
                                            <div class="col-md-12">
                                            <!--เนื้อหาใน popup message--> 
                                                <form >
                                                    <div class="form-group">
                                                        <label>ชื่อหัวข้อ: </label>
                                                        <input type="text" class="form-control" 
                                                        placeholder="ชื่อหัวข้อ">
                                                        <label>น้ำหนัก</label>
                                                        <select class="form-control">
                                                          <option>1</option>
                                                          <option>2</option>
                                                          <option>3</option>
                                                          <option>4</option>
                                                          <option>5</option>
                                                        </select>
                                                        <label>ระดับที่คาดหวัง</label>
                                                        <select class="form-control">
                                                          <option>1</option>
                                                          <option>2</option>
                                                          <option>3</option>
                                                          <option>4</option>
                                                          <option>5</option>
                                                        </select>
                                                        <br/>
                                                        <button href="javascript:void(0);" type="button" class="btn btn-success show_box">บันทึก</button>
                                                    </div>

                                                    </div>
                                                </form>
                                            </div>  
                                            </div>  
                                            <div id="overlay"></div>  </th>

                                        </TR>
                                        <TR>
                                            <td style="text-align:left" colspan="4">6. ความรู้ความเข้าใจในหน้าที่งานที่รับผิดชอบ</td>

                                            <td >4</td>
                                            <td >3</td>
                                            <td >12</td>
                                            <td >
                                                <input type="radio" name="optradio6"></td>
                                            <td >
                                                <input type="radio" name="optradio6"></td>
                                            <td >
                                                <input type="radio" name="optradio6"></td>
                                            <td >
                                                <input type="radio" name="optradio6"></td>
                                            <td >
                                                <input type="radio" name="optradio6"></td>
                                            <td class="text-center">
                                                <a href="">
                                                    <i class="glyphicon glyphicon-pencil"></i>
                                                </a>
                                                |
                                                <a href="">
                                                    <i class="glyphicon glyphicon-trash"></i>
                                                </a>
                                            </td>
                                        </TR>
                                        <TR>
                                            <td style="text-align:left" colspan="4">7. ความละเอียดรอบคอบ</td>

                                            <td >4</td>
                                            <td >3</td>
                                            <td >12</td>
                                            <td >
                                                <input type="radio" name="optradio7"></td>
                                            <td >
                                                <input type="radio" name="optradio7"></td>
                                            <td >
                                                <input type="radio" name="optradio7"></td>
                                            <td >
                                                <input type="radio" name="optradio7"></td>
                                            <td >
                                                <input type="radio" name="optradio7"></td>
                                            <td class="text-center">
                                                <a href="">
                                                    <i class="glyphicon glyphicon-pencil"></i>
                                                </a>
                                                |
                                                <a href="">
                                                    <i class="glyphicon glyphicon-trash"></i>
                                                </a>
                                            </td>
                                        </TR>
                                        <TR>
                                            <td style="text-align:left" colspan="4">8. ความสามารถในการสื่อสาร</td>

                                            <td >1</td>
                                            <td >3</td>
                                            <td >3</td>
                                            <td >
                                                <input type="radio" name="optradio8"></td>
                                            <td >
                                                <input type="radio" name="optradio8"></td>
                                            <td >
                                                <input type="radio" name="optradio8"></td>
                                            <td >
                                                <input type="radio" name="optradio8"></td>
                                            <td >
                                                <input type="radio" name="optradio8"></td>
                                            <td class="text-center">
                                                <a href="">
                                                    <i class="glyphicon glyphicon-pencil"></i>
                                                </a>
                                                |
                                                <a href="">
                                                    <i class="glyphicon glyphicon-trash"></i>
                                                </a>
                                            </td>
                                        </TR>
                                        <TR>
                                            <td style="text-align:left" colspan="4">9. มนุษยสัมพันธ์ในการทำงาน</td>

                                            <td >2</td>
                                            <td >3</td>
                                            <td >6</td>
                                            <td >
                                                <input type="radio" name="optradio9"></td>
                                            <td >
                                                <input type="radio" name="optradio9"></td>
                                            <td >
                                                <input type="radio" name="optradio9"></td>
                                            <td >
                                                <input type="radio" name="optradio9"></td>
                                            <td >
                                                <input type="radio" name="optradio9"></td>
                                            <td class="text-center">
                                                <a href="">
                                                    <i class="glyphicon glyphicon-pencil"></i>
                                                </a>
                                                |
                                                <a href="">
                                                    <i class="glyphicon glyphicon-trash"></i>
                                                </a>
                                            </td>
                                        </TR>
                                        <TR>
                                            <td style="text-align:left" colspan="4">10. การบริหารจัดการรายงานและเอกสารต่างๆ</td>

                                            <td >3</td>
                                            <td >3</td>
                                            <td >9</td>
                                            <td >
                                                <input type="radio" name="optradio10"></td>
                                            <td >
                                                <input type="radio" name="optradio10"></td>
                                            <td >
                                                <input type="radio" name="optradio10"></td>
                                            <td >
                                                <input type="radio" name="optradio10"></td>
                                            <td >
                                                <input type="radio" name="optradio10"></td>
                                            <td class="text-center">
                                                <a href="">
                                                    <i class="glyphicon glyphicon-pencil"></i>
                                                </a>
                                                |
                                                <a href="">
                                                    <i class="glyphicon glyphicon-trash"></i>
                                                </a>
                                            </td>
                                        </TR>

                                        <TR>
                                            <td style="text-align:left" colspan="4">11. ความรับผิดชอบและไว้วางใจได้</td>

                                            <td >4</td>
                                            <td >2</td>
                                            <td >8</td>
                                            <td >
                                                <input type="radio" name="optradio11"></td>
                                            <td >
                                                <input type="radio" name="optradio11"></td>
                                            <td >
                                                <input type="radio" name="optradio11"></td>
                                            <td >
                                                <input type="radio" name="optradio11"></td>
                                            <td >
                                                <input type="radio" name="optradio11"></td>
                                            <td class="text-center">
                                                <a href="">
                                                    <i class="glyphicon glyphicon-pencil"></i>
                                                </a>
                                                |
                                                <a href="">
                                                    <i class="glyphicon glyphicon-trash"></i>
                                                </a>
                                            </td>
                                        </TR>
                                        <TR>
                                            <td style="text-align:left" colspan="4">12. ความร่วมมือต่อทั้งผู้บังคับบัญชาและบริษัทฯ</td>

                                            <td >2</td>
                                            <td >3</td>
                                            <td >6</td>
                                            <td >
                                                <input type="radio" name="optradio12"></td>
                                            <td >
                                                <input type="radio" name="optradio12"></td>
                                            <td >
                                                <input type="radio" name="optradio12"></td>
                                            <td >
                                                <input type="radio" name="optradio12"></td>
                                            <td >
                                                <input type="radio" name="optradio12"></td>
                                            <td class="text-center">
                                                <a href="">
                                                    <i class="glyphicon glyphicon-pencil"></i>
                                                </a>
                                                |
                                                <a href="">
                                                    <i class="glyphicon glyphicon-trash"></i>
                                                </a>
                                            </td>
                                        </TR>
                                        <TR class="bg-info">
                                            <th colspan="4">รวม</th>

                                            <td >30</td>
                                            <td ></td>
                                            <td >83</td>
                                            <td colspan="6"></td>

                                        </TR>
                                    </TABLE>

                                </center>

                            </div>

                        </div>

                    </div>
                    <!-- ./box-body -->
                    <!-- /.content -->

                    <!--box footer-->
                    <div class="box-footer">
                        <button class="btn btn-success pull-right">บันทึกข้อมูล</button>
                        <a href="#">
                            <button class="btn btn-instagram pull-right">ภาพตัวอย่าง</button>
                        </a>
                    </div>
                    <!--/box footer--> </div>

                <!-- /.content-wrapper --> </div>
            <!-- Add the sidebar's background. This div must be placed
                                 immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>

        </div>
    </div>
</div>
<!--Finish body content-wrapper-->

<!--Footer -->
<?php include './footer.php'; ?>

<!-- Control Sidebar -->
<?php include './controlsidebar.php'; ?></div>
<!-- ./wrapper -->

<!-- jQuery 2.2.0 -->
<script src="plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>$.widget.bridge('uibutton', $.ui.button);</script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>