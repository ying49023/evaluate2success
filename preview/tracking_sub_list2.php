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
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="bootstrap/css/metro.css">
        <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
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
                    <h1>
                        การประเมินสมรรถนะ
                        <small>ค้นหาพนักงาน</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                    <hr>
                </section>
                <!--/Page header -->

                <!-- Main content -->
                <div class="row box-padding">
                    <div class="box box-success">
                        <div class="box-body">
                            <form >
                                 <table width="90%" height="100px" border="1px">
                                    <tr>
                                        <th>รหัสพนักงาน</th>
                                        <th>ชื่อพนักงาน</th>
                                        <th>ตำแหน่ง</th>
                                        <th>ฝ่าย/แผนก</th>
                                        <th><center>เป้าหมาย</center></th>
                                        <th><center>ค่าจริง</center></th>
                                        <th><center>เทียบกับเป้าหมาย</center></th>                                    
                                    </tr>
                                    <tr>
                                        <td>123456</td>
                                        <td>นาย ศตวรรษ วินวิวัฒน์</td>
                                        <td>พนักงานฝ่ายบุคคล</td>
                                        <td>ฝ่ายบุคคล</td>
                                        <th><center>>=80%</center></th>
                                        <th><center>67%</center></th>
                                        <th><center> </center></th>                                         
                                    </tr>
                                    
                                </table>
                                </div>
                                <div class="col-md-2">
                                    <button class="button primary"><i class="material-icons">   search   </i></button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="row box-padding">
                    <div class="col-md-12">
                        <div class="box box-default">

                            <div class="box-header with-border">
                                ตารางข้อมูลพนักงาน
                            </div>
                            <div class="box-body">                               
                                <script>
                                        // Enter a speed between 0 and 180
                                        var level = 175;

                                        // Trig to calc meter point
                                        var degrees = 180 - level,
                                             radius = .5;
                                        var radians = degrees * Math.PI / 180;
                                        var x = radius * Math.cos(radians);
                                        var y = radius * Math.sin(radians);

                                        // Path: may have to change to create a better triangle
                                        var mainPath = 'M -.0 -0.025 L .0 0.025 L ',
                                             pathX = String(x),
                                             space = ' ',
                                             pathY = String(y),
                                             pathEnd = ' Z';
                                        var path = mainPath.concat(pathX,space,pathY,pathEnd);

                                        var data = [{ type: 'scatter',
                                           x: [0], y:[0],
                                            marker: {size: 28, color:'850000'},
                                            showlegend: false,
                                            name: 'speed',
                                            text: level,
                                            hoverinfo: 'text+name'},
                                          { values: [50/6, 50/6, 50/6, 50/6, 50/6, 50/6, 50],
                                          rotation: 90,
                                          text: ['TOO FAST!', 'Pretty Fast', 'Fast', 'Average',
                                                    'Slow', 'Super Slow', ''],
                                          textinfo: 'text',
                                          textposition:'inside',      
                                          marker: {colors:['rgba(14, 127, 0, .5)', 'rgba(110, 154, 22, .5)',
                                                                 'rgba(170, 202, 42, .5)', 'rgba(202, 209, 95, .5)',
                                                                 'rgba(210, 206, 145, .5)', 'rgba(232, 226, 202, .5)',
                                                                 'rgba(255, 255, 255, 0)']},
                                          labels: ['151-180', '121-150', '91-120', '61-90', '31-60', '0-30', ''],
                                          hoverinfo: 'label',
                                          hole: .5,
                                          type: 'pie',
                                          showlegend: false
                                        }];

                                        var layout = {
                                          shapes:[{
                                              type: 'path',
                                              path: path,
                                              fillcolor: '850000',
                                              line: {
                                                color: '850000'
                                              }
                                            }],
                                          title: '<b>Gauge</b> <br> Speed 0-100',
                                          height: 1000,
                                          width: 1000,
                                          xaxis: {zeroline:false, showticklabels:false,
                                                     showgrid: false, range: [-1, 1]},
                                          yaxis: {zeroline:false, showticklabels:false,
                                                     showgrid: false, range: [-1, 1]}
                                        };

                                        Plotly.newPlot('myDiv', data, layout);
                                </script> 
                                
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
            <?php include './Controlsidebar.php'; ?>
                        
            <!-- Add the sidebar's background. This div must be placed
                 immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->

        <!-- jQuery 2.2.0 -->
        <script src="plugins/jQuery/jQuery-2.2.0.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
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
