<?php $page = basename($_SERVER['SCRIPT_NAME']); ?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>นภัทร อินทร์ใจเอื้อ </p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <!--<form action="#" method="get" class="sidebar-form">
          <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                  <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                  </button>
                </span>
          </div>
        </form>-->
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        
        <ul class="sidebar-menu">
            <li class="header" >เมนูสำหรับฝ่ายบุคคล</li>
            <!-- เมนูsubordinate-->
            <li class="<?php if($page == '' || $page == 'index.php'){ echo "active" ; } ?>">
                <a href="index.php">
                    <i class="glyphicon glyphicon-user"></i> <span>Dashboard</span>

                </a>
            </li>
            <li class="<?php if($page == 'edit_weight_eval.php'  || $page == 'manage_evaluate.php' ){ echo "active" ; } ?>">
                <a href="">
                    <i class="glyphicon glyphicon-level-up"></i>
                        <span>แบบประเมิน</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php if($page == 'manage_evaluate.php' || $page == '' ){ echo "active" ; } ?>">
                        <a href="manage_evaluate.php"><i class="fa fa-circle-o"></i>จัดการระบบประเมิน</a>
                    </li>
                    <li class="<?php if($page == 'edit_weight_eval.php'){ echo "active" ; } ?>">
                        <a href="edit_weight_eval.php"><i class="fa fa-circle-o"></i>แก้ไขแบบประเมิน</a>
                    </li>
                </ul>
            </li>
            <li class="<?php if($page == 'hr_all_kpi_detail.php' || $page == 'hr_kpi_individual.php' || $page == 'hr_approve_kpi.php' ){ echo "active" ; } ?>">
                <a href="">
                    <i class="glyphicon glyphicon-level-up"></i>
                        <span>KPIs</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php if($page == 'hr_all_kpi_detail.php'){ echo "active" ; } ?>">
                        <a href="hr_all_kpi_detail.php"><i class="fa fa-circle-o"></i>ข้อมูลKPIsทั้งหมด</a>
                    </li>
                    <li class="<?php if($page == 'hr_kpi_individual.php'){ echo "active" ; } ?>">
                        <a href="hr_kpi_individual.php"><i class="fa fa-circle-o"></i>ข้อมูลKPIsรายบุคคล</a>
                    </li>
                    <li class="<?php if($page == 'hr_approve_kpi.php'){ echo "active" ; } ?>">
                        <a href="hr_approve_kpi.php"><i class="fa fa-circle-o"></i>อนุมัติKPIsครั้งถัดไป</a>
                    </li>
                </ul>
            </li>
            <li class="<?php if($page == 'manage_employee.php'){ echo "active" ; } ?>">
                <a href="manage_employee.php">
                    <i class="glyphicon glyphicon-user"></i> <span>จัดการข้อมูลพนักงาน</span>

                </a>
            </li>
            <li class="<?php if($page == 'hr_report_page.php'){ echo "active" ; } ?>">
                <a href="hr_report_page.php" >
                    <i class="glyphicon glyphicon-book"></i> <span>ออกรายงาน</span>

                </a>
            </li>
            <li class="<?php if($page == 'assignkpi.php'){ echo "active" ; } ?>">
                <a href="assignkpi.php">
                    <i class="glyphicon glyphicon-check"></i> <span>การกำหนดKPIs</span>

                </a>
            </li>
            <li class="<?php if($page == 'report.php'){ echo "active" ; } ?>">
                <a href="report.php">
                    <i class="glyphicon glyphicon-envelope"></i> <span>แจ้งปัญหา/รายงานข้อผิดพลาด</span>

                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>