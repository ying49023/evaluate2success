<?php $page = basename($_SERVER['SCRIPT_NAME']); ?>

<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->

    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel" style="white-space:normal;max-width: 230px;">
            <div class="pull-left image">
                <img style="height: 45px;max-width: 45px;" src="../upload_images/<?php echo $my_picture; ?>" class="img-circle img-center " alt="<?php echo $my_name; ?>">
            </div>
            <div class="pull-left info" >
                <p><?php echo $my_name; ?></p>
                <p>ตำแหน่ง: <?php echo $my_job; ?></p>
                <!--
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
            </div>
        </div>     
        <ul class="sidebar-menu">
            <li class="header" style="color:white;font-size: 14px;" >เมนูสำหรับระดับ<?php echo $my_position; ?></li>
            <!-- เมนูsubordinate-->

            <!-- Dashboard menu -->
            <li class="<?php if($page == '' || $page == 'index.php'){ echo "active" ; } ?>">
                <a href="index.php">
                    <i class="glyphicon glyphicon-user"></i> <span>Dashboard</span>

                </a>
            </li>
            <!-- / Dashboard menu -->

            <!-- Evaluation menu -->
            <li class="<?php if($page == 'create_evaluation.php' || $page == 'manage_evaluate_sub_list.php' || $page == 'manage_grade.php' || $page == 'edit_weight_eval.php'  || $page == 'competency.php'|| $page == 'manage_evaluate.php' || $page == 'grade_management.php'|| $page == 'manage_competency.php' || $page == 'explan_evaluation.php' || $page == 'evaluation_section_1.php' || $page == 'evaluation_section_2.php' || $page == 'evaluation_section_3.php' || $page == 'evaluation_section_4.php' ){ echo "active" ; } ?>" >
                <a href="">
                    <i class="glyphicon glyphicon-list-alt"></i>
                        <span>แบบประเมิน</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php if($page == 'manage_evaluate.php' || $page == 'manage_evaluate_sub_list.php' ){ echo "active" ; } ?>">
                        <a href="manage_evaluate.php"><i class="fa fa-circle-o"></i>จัดการระบบประเมิน</a>
                    </li>
                    <li class="<?php if($page == 'create_evaluation.php' || $page == 'explan_evaluation.php' || $page == 'evaluation_section_1.php' || $page == 'evaluation_section_2.php' || $page == 'evaluation_section_3.php' || $page == 'evaluation_section_4.php'){ echo "active" ; } ?>">
                        <a href="create_evaluation.php"><i class="fa fa-circle-o"></i>สร้าง / แก้ไขแบบประเมิน</a>
                    </li>
                    <li class="<?php if($page == 'manage_grade.php'){ echo "active" ; } ?>">
                        <a href="manage_grade.php"><i class="fa fa-circle-o"></i>เกณฑ์การตัดเกรด</a>
                    </li>
                </ul>
            </li>
            <!-- /Evaluation menu -->

            <!-- base data of employee menu -->
            <li class="<?php if($page == 'company_table.php'||$page == 'position_level.php'||$page == 'departments_table.php' || $page == 'jobs_table.php'){ echo "active" ; } ?>" >
                <a href="">
                    <i class="glyphicon glyphicon-list"></i>
                        <span>ข้อมูลพื้นฐานของบริษัท</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php if($page == 'company_table.php'){ echo "active" ; } ?>">
                        <a href="company_table.php"><i class="fa fa-circle-o"></i>บริษัทที่ใช้แบบประเมิน</a>
                    </li>
                    <li class="<?php if($page == 'position_level.php'){ echo "active" ; } ?>">
                        <a href="position_level.php"><i class="fa fa-circle-o"></i>ระดับที่ใช้ในแบบประเมิน</a>
                    </li>
                    <li class="<?php if($page == 'jobs_table.php'){ echo "active" ; } ?>">
                        <a href="jobs_table.php"><i class="fa fa-circle-o"></i>ข้อมูลตำแหน่งงาน</a>
                    </li>
                    <li class="<?php if($page == 'departments_table.php'){ echo "active" ; } ?>">
                        <a href="departments_table.php"><i class="fa fa-circle-o"></i>ข้อมูลแผนก/ฝ่าย</a>
                    </li>
                </ul>
            </li>
            <!-- /base data of employee menu -->

            <!--Competency-->
            <li class="<?php if($page == 'competency_title.php' || $page == 'added_competency.php'   ){ echo "active" ; } ?>">
                <a href="">
                    <i class="glyphicon glyphicon-copyright-mark"></i>
                        <span>Competency</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                     <li class="<?php if($page == 'competency_title.php'){ echo "active" ; } ?>">
                        <a href="competency_title.php"><i class="fa fa-circle-o"></i>เพิ่ม/แก้ไขหัวข้อCompetency</a>
                    </li>
                    <li class="<?php if($page == 'added_competency.php'){ echo "active" ; } ?>">
                        <a href="added_competency.php"><i class="fa fa-circle-o"></i>เพิ่ม/แก้ไขข้อมูลCompetency</a>
                    </li>
                    

                </ul>
            </li>
            <!--/Competency-->
            
            <!-- KPI --> 
            <li class="<?php if($page == 'hr_kpi_group.php' || $page == 'all_kpi.php' || $page == 'hr_all_kpi_detail.php' || $page == 'hr_kpi_individual.php' || $page == 'hr_kpi_individual_resp.php' ){ echo "active" ; } ?>">
                <a href="">
                    <i class="glyphicon glyphicon-level-up"></i>
                        <span>KPIs</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php if($page == 'all_kpi.php'){ echo "active" ; } ?>">
                        <a href="all_kpi.php"><i class="fa fa-circle-o"></i>ข้อมูล KPIs ทั้งหมด</a>
                    </li>
                    <li class="<?php if($page == 'hr_kpi_group.php'){ echo "active" ; } ?>">
                        <a href="hr_kpi_group.php"><i class="fa fa-circle-o"></i>ข้อมูลกลุ่ม KPIs</a>
                    </li>
                    <li class="<?php if($page == 'hr_all_kpi_detail.php'){ echo "active" ; } ?>">
                        <a href="hr_all_kpi_detail.php"><i class="fa fa-circle-o"></i>ข้อมูล KPIs ตามแผนก / ตำแหน่ง</a>
                    </li>
                    <li class="<?php if($page == 'hr_kpi_individual.php' || $page == 'hr_kpi_individual_resp.php'){ echo "active" ; } ?>">
                        <a href="hr_kpi_individual.php"><i class="fa fa-circle-o"></i>ดูข้อมูลKPIsรายบุคคล</a>
                    </li>
                    
                </ul>
            </li>
            <!--/KPI-->
            
            <!-- Manage Leave date -->
            <li class="<?php if ($page == 'leave_form.php' || $page == 'leave_form2.php' || $page == 'manage_leave_type.php') {
                    echo "active";
                } ?>">
                <a href="">
                    <i class="glyphicon glyphicon-calendar"></i>
                    <span>จัดการข้อมูลวันลา</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php if ($page == 'leave_form.php' || $page == 'leave_form2.php') {
                    echo "active";
                } ?>">
                        <a href="leave_form.php"><i class="fa fa-circle-o"></i>จัดการวันลาของพนักงาน</a>
                    </li>
                    <li class="<?php if ($page == 'manage_leave_type.php') {
                    echo "active";
                } ?>">
                        <a href="manage_leave_type.php"><i class="fa fa-circle-o"></i>ประเภทข้อมูลวันลา</a>
                    </li>
                </ul>
            </li>
            <!-- /Manage Leave date -->
            
            <!-- Manage penalty reward -->
            <li class="<?php if ($page == 'manage_penalty_reward.php' || $page == 'manage_penalty_reward_detail.php' || $page == 'edit_penalty_reward.php') {
                    echo "active";
                } ?>">
                <a href="">
                    <i class="glyphicon glyphicon-tower"></i>
                    <span>จัดการข้อมูลรางวัล / โทษ</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php if ($page == 'edit_penalty_reward.php') { echo "active"; } ?>">
                        <a href="edit_penalty_reward.php"><i class="fa fa-circle-o"></i>แก้ไขข้อมูลรางวัล / โทษ</a>
                    </li>
                    <li class="<?php if ($page == 'manage_penalty_reward.php' || $page == 'manage_penalty_reward_detail.php') { echo "active"; } ?>">
                        <a href="manage_penalty_reward.php"><i class="fa fa-circle-o"></i>จัดการข้อมูลรางวัล / โทษ</a>
                    </li>
                </ul>
            </li>
            <!-- /Manage penalty reward -->
            
            <!-- Manage employee -->
            <li class="<?php if($page == 'manage_employee_insert.php'|| $page == 'manage_employee_list.php' || $page == 'edit_profile.php' ){ echo "active" ; } ?>" >    
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
					
                </ul>
            </li>
            <!-- /Manage employee -->
            
            <!-- Next KPI -->
<!--            <li class="<?php if($page == 'hr_approve_kpi.php' || $page == 'hr_approve_kpi2.php'){ echo "active" ; } ?>">
                <a href="hr_approve_kpi.php">
                    <i class="glyphicon glyphicon glyphicon-forward"></i>อนุมัติKPIsครั้งถัดไป
                </a>
            </li>-->
            <!-- /Next KPI -->
            
            <!-- Assign KPI -->
            <li class="<?php if($page == 'hr_assign_kpi.php' || $page == 'hr_manage_kpi.php'|| $page=='hr_assign_kpi_department.php'){ echo "active" ; } ?>">
                <a href="">
                    <i class="glyphicon glyphicon-check"></i> <span>การกำหนดKPIs</span>
                    <i class="fa fa-angle-left pull-right"></i>

                </a>
                <ul class="treeview-menu">
                    
                    <li class="<?php if($page == 'hr_assign_kpi.php'){ echo "active" ; } ?>">
                        <a href="hr_assign_kpi.php"><i class="fa fa-circle-o"></i>รายบุคคล</a>
                    </li>
                    <li class="<?php if($page == 'hr_assign_kpi_department.php' || $page=='hr_assign_kpi_department.php'){ echo "active" ; } ?>">
                        <a href="hr_assign_kpi_department.php"><i class="fa fa-circle-o"></i>รายแผนก/ตำแหน่ง</a>
                    </li>
					
                </ul>
            </li>
            <!-- Assign KPI -->
            
            <!-- Report Doc-->
           <li class="<?php if($page == 'hr_report_page.php' || $page == 'hr_report_grade.php'){ echo "active" ; } ?>">
                <a href="hr_report_page.php" >
                    <i class="glyphicon glyphicon-book"></i> <span>ออกรายงาน</span>

                </a>
            </li>
            <!-- /Report Doc-->
            
            
            
            <!-- Threshold -->
<!--            <li class="<?php if($page == 'threshold.php'){ echo "active" ; } ?>">
                <a href="threshold.php">
                    <i class="glyphicon glyphicon-sort-by-attributes-alt"></i> <span>การจัดการการวัดระดับ</span>

                </a>
            </li>-->
            <!-- /Threshold -->

            <!-- Problem/Report -->
<!--            <li class="<?php if($page == 'report.php'){ echo "active" ; } ?>">
                <a href="report.php">
                    <i class="glyphicon glyphicon-envelope"></i> <span>แจ้งปัญหา</span>

                </a>
            </li>-->
            <!-- /Problem/Report -->
        </ul>
    </section>

    <!-- /.sidebar -->
</aside>