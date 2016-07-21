<!DOCTYPE html>
<html>
<head>
    <?php include('./classes/connection_mysqli.php') ?>
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
                    ดูKPIsทั้งหมด
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
                        <form>
                            <div class="col-md-offset-1 col-md-4">
                                <label class="col-sm-4 control-label">แผนก</label>
                                <div class="col-sm-8">
                                    <?php 
                                        $sql_department = "SELECT * FROM departments ";
                                        $query_department = mysqli_query($conn, $sql_department);
                                    ?>
                                    <select class="form-control">
                                        <option value="">เลือก</option>
                                        <?php while($result_department = mysqli_fetch_array($query_department,MYSQLI_ASSOC)) { ?>
                                        <option><?php echo $result_department["department_name"]; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="col-sm-4 control-label">ตำแหน่ง</label>
                                <div class="col-sm-8">
                                    <select class="form-control">
                                        <option>ทุกแผนก</option>
                                        <option>ฝ่ายทรัพยากรบุคคล</option>
                                        <option>ฝ่ายขายและการตลาด</option>
                                        <option>การเงิน</option>
                                        <option>ฝ่ายขาย</option>
                                        <option>ฝ่ายไอที และสารสนเทศ</option>
                                        <option>ฝ่ายปฏิบัติการ</option>
                                    </select>
                                </div>
                            </div>
                            <div class=" col-md-2">
                                <button class="btn btn-primary search-button" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
            <div class="row box-padding">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?php 
                                $sql_kpi = "SELECT
                                                    k.kpi_id as kpi_id,
                                                    k.kpi_name as kpi_name,
                                                    k.kpi_description as kpi_description,
                                                    d.department_id as department_id,
                                                    d.department_name as department_name
                                            FROM
                                                    kpi k
                                            JOIN kpi_group g ON k.kpi_id = g.kpi_id
                                            JOIN departments d ON g.department_id = d.department_id
                                            ORDER BY
                                                    g.kpi_id " ;
                                $query_kpi = mysqli_query($conn, $sql_kpi);
                            ?>
                            <table class="table table-hover table-responsive">
                                <?php while($result_kpi = mysqli_fetch_array($query_kpi,MYSQLI_ASSOC)) { ?>
                                    <thead>
                                        <tr>
                                            <th class="text-center active" colspan="5">
                                                <?php echo "แผนก : ".$result_kpi["department_name"] ; ?>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th = >ID</th>
                                            <th>ชื่อKPIs</th>
                                            <th>คำอธิบาย</th>
                                            <th>แผนก</th>
                                            <th>ดู</th>
                                        </tr>
                                    </thead>
                                    <?php 
                                    $sql_each_kpi = "SELECT
                                                            k.kpi_id as kpi_id,
                                                            k.kpi_name as kpi_name,
                                                            k.kpi_description as kpi_description
                                                    FROM
                                                            kpi_group kg
                                                    JOIN kpi k ON kg.kpi_id = k.kpi_id
                                                    WHERE
                                                            kg.department_id = '".$result_kpi["department_id"]."' ";
                                    $query_each_kpi = mysqli_query($conn, $sql_each_kpi);
                                    
                                    ?>
                                    <?php while ($result_each_kpi = mysqli_fetch_array($query_each_kpi , MYSQLI_ASSOC)) { ?>
                                    <tr>
                                        <td><?php echo $result_each_kpi["kpi_id"] ; ?></td>
                                        <td><?php echo $result_each_kpi["kpi_name"] ; ?></td>
                                        <td><?php echo $result_each_kpi["kpi_description"] ; ?></td>
                                        <td><?php echo $result_kpi["department_name"] ; ?></td>
                                        <td>
                                            <a href=""><i class="glyphicon glyphicon-eye-open"></i></a>
                                        </td>
                                    </tr>
                                    <?php } ?>
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