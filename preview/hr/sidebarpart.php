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
            <li class="<?php if($page == 'manage_grade.php' || $page == 'edit_weight_eval.php'  ||$page == 'competency.php'|| $page == 'manage_evaluate.php' || $page == 'grade_management.php' ){ echo "active" ; } ?>">
                <a href="">
                    <i class="glyphicon glyphicon-level-up"></i>
                        <span>แบบประเมิน</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php if($page == 'manage_evaluate.php' ){ echo "active" ; } ?>">
                        <a href="manage_evaluate.php"><i class="fa fa-circle-o"></i>จัดการระบบประเมิน</a>
                    </li>
                    <li class="<?php if($page == 'edit_weight_eval.php'){ echo "active" ; } ?>">
                        <a href="edit_weight_eval.php"><i class="fa fa-circle-o"></i>แก้ไขแบบประเมิน</a>
                    </li>
                    <li class="<?php if($page == 'competency.php'){ echo "active" ; } ?>">
                        <a href="competency.php"><i class="fa fa-circle-o"></i>Competency</a>
                    </li>
                    <li class="<?php if($page == 'manage_grade.php'){ echo "active" ; } ?>">
                        <a href="manage_grade.php"><i class="fa fa-circle-o"></i>เกณฑ์การตัดเกรด</a>


                </ul>
            </li>
            <li class="<?php if($page == 'hr_kpi_group.php' || $page == 'all_kpi.php' || $page == 'hr_all_kpi_detail.php' || $page == 'hr_kpi_individual.php' || $page == 'hr_approve_kpi.php' || $page == 'hr_approve_kpi2.php' || $page == 'hr_kpi_individual_resp.php' ){ echo "active" ; } ?>">
                <a href="">
                    <i class="glyphicon glyphicon-level-up"></i>
                        <span>KPIs</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php if($page == 'all_kpi.php'){ echo "active" ; } ?>">
                        <a href="all_kpi.php"><i class="fa fa-circle-o"></i>ข้อมูลKPIsทั้งหมด</a>
                    </li>
                    <li class="<?php if($page == 'hr_kpi_group.php'){ echo "active" ; } ?>">
                        <a href="hr_kpi_group.php"><i class="fa fa-circle-o"></i>จัดการกลุ่ม</a>
                    </li>
                    <li class="<?php if($page == 'hr_all_kpi_detail.php'){ echo "active" ; } ?>">
                        <a href="hr_all_kpi_detail.php"><i class="fa fa-circle-o"></i>จัดการข้อมูลKPIs</a>
                    </li>
                    <li class="<?php if($page == 'hr_kpi_individual.php' || $page == 'hr_kpi_individual_resp.php'){ echo "active" ; } ?>">
                        <a href="hr_kpi_individual.php"><i class="fa fa-circle-o"></i>ข้อมูลKPIsรายบุคคล</a>
                    </li>
                    <li class="<?php if($page == 'hr_approve_kpi.php' || $page == 'hr_approve_kpi2.php'){ echo "active" ; } ?>">
                        <a href="hr_approve_kpi.php"><i class="fa fa-circle-o"></i>อนุมัติKPIsครั้งถัดไป</a>
                    </li>
                </ul>
            </li>
             <li class="<?php if($page == 'manage_employee_leave.php'|| $page == 'manage_leave_type.php'){ echo "active" ; } ?>">
                 <a href="">
                    <i class="glyphicon glyphicon-calendar"></i>
                        <span>จัดการข้อมูลวันลา</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                 <ul class="treeview-menu">
                    <li class="<?php if($page == 'manage_employee_leave.php'){ echo "active" ; } ?>">
                        <a href="manage_employee_leave.php"><i class="fa fa-circle-o"></i>จัดการวันลาของพนักงาน(coming..)</a>
                    </li>
                    <li class="<?php if($page == 'manage_leave_type.php'){ echo "active" ; } ?>">
                        <a href="manage_leave_type.php"><i class="fa fa-circle-o"></i>ประเภทข้อมูลวันลา</a>
                    </li>
                    </ul>
            </li>
            
            
            
            <li class="<?php if($page == 'departments_table.php' || $page == 'jobs_table.php' || $page == 'manage_employee_insert.php'|| $page == 'manage_employee_list.php' || $page == 'edit_profile.php'){ echo "active" ; } ?>">    
                <a href="manage_employee.php">
                    <i class="glyphicon glyphicon-user"></i> <span>จัดการข้อมูลพนักงาน</span>
                    <i class="fa fa-angle-left pull-right"></i>

                </a>
                <ul class="treeview-menu">
                    
                    <li class="<?php if($page == 'manage_employee_insert.php'){ echo "active" ; } ?>">
                        <a href="manage_employee_insert.php"><i class="fa fa-circle-o"></i>เพิ่มข้อมูลพนักงาน</a>
                    </li>
                    <li class="<?php if($page == 'manage_employee_list.php' || $page=='edit_profile.php'){ echo "active" ; } ?>">
                        <a href="manage_employee_list.php"><i class="fa fa-circle-o"></i>ลบ/แก้ไขข้อมูลพนักงาน</a>
                    </li>
					 <li class="<?php if($page == 'jobs_table.php'){ echo "active" ; } ?>">
                        <a href="jobs_table.php"><i class="fa fa-circle-o"></i>ข้อมูลตำแหน่งงาน</a>
                    </li>
					<li class="<?php if($page == 'departments_table.php'){ echo "active" ; } ?>">
                        <a href="departments_table.php"><i class="fa fa-circle-o"></i>ข้อมูลแผนก/ฝ่าย</a>
                    </li>
                </ul>
            </li>
            <li class="<?php if($page == 'hr_report_page.php' || $page == 'hr_report_grade.php'){ echo "active" ; } ?>">
                <a href="hr_report_page.php" >
                    <i class="glyphicon glyphicon-book"></i> <span>ออกรายงาน</span>

                </a>
            </li>
            <li class="<?php if($page == 'hr_assign_kpi.php' || $page == 'hr_manage_kpi.php'){ echo "active" ; } ?>">
                <a href="hr_assign_kpi.php">
                    <i class="glyphicon glyphicon-check"></i> <span>การกำหนดKPIs</span>

                </a>
            </li>
            <li class="<?php if($page == 'threshold.php'){ echo "active" ; } ?>">
                <a href="threshold.php">
                    <i class="glyphicon glyphicon-sort-by-attributes-alt"></i> <span>การจัดการการวัดระดับ</span>

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