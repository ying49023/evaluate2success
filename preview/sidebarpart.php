<?php $page = basename($_SERVER['SCRIPT_NAME']); ?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
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
            <?php  ?>
            <li class="header">เมนูหลัก</li>
            <li class="<?php if($page == 'index.php' || $page == 'total_personal_dashboard.php' || $page == 'myindex.php'){ echo "active" ; } ?> treeview">
                <a href="index.php">
                    <i class="glyphicon glyphicon-dashboard"></i> <span>แดชบอร์ด</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php if($page == 'index.php'){ echo "active" ; } ?>">
                        <a href="index.php"><i class="fa fa-circle-o"></i> ภาพรวม</a>
                    </li>
                    <li class="<?php if($page == 'total_personal_dashboard.php'){ echo "active" ; } ?>">
                        <a  href="total_personal_dashboard.php"><i class="fa fa-circle-o"></i> รายบุคคล</a>
                    </li>
                    <li class="<?php if($page == 'myindex.php'){ echo "active" ; } ?>">
                        <a href="myindex.php"><i class="fa fa-circle-o"></i>ของตนเอง</a>
                    </li>
                </ul>
            </li>
            <li class="treeview <?php if($page == 'evaluate_sub_list.php' || $page == 'search_summaryeval.php' || $page == 'my_summaryevaluation.php'){ echo "active" ; } ?>" >
                <a href="#">
                    <i class="glyphicon glyphicon-file"></i>
                    <span>การประเมิน</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php if($page == 'evaluate_sub_list.php'){ echo "active" ; } ?>">
                        <a href="evaluate_sub_list.php"><i class="fa fa-circle-o"></i>ประเมินสมรรถนะ</a>
                    </li>
                    <li class="<?php if($page == 'search_summaryeval.php'){ echo "active" ; } ?>">
                        <a href="search_summaryeval.php"><i class="fa fa-circle-o"></i>ดูผลการประเมิน</a>
                    </li>
                    <li class="<?php if($page == 'my_summaryevaluation.php'){ echo "active" ; } ?>">
                        <a href="my_summaryevaluation.php"><i class="fa fa-circle-o"></i>ดูผลการประเมินของตนเอง</a>
                    </li>
                </ul>
            </li>
            <li class="<?php if($page == 'tracking_sub_list.php'){ echo "active" ; } ?> ">
                <a href="">
                    <i class="glyphicon glyphicon-screenshot"></i>
                        <span>ติดตามสถานะการทำงาน</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php if($page == 'tracking_sub_list.php'){ echo "active" ; } ?>"><a href="tracking_sub_list.php"><i class="fa fa-circle-o"></i>ติดตามสถานะรายบุคคล</a></li>
                    <!--<li ><a href="#"><i class="fa fa-circle-o"></i>ตืดตามสถานรายแผนก</a></li>-->
                </ul>
            </li>
            <!-- เมนูsubordinate-->
            <li class="<?php if($page == 'update_kpi.php'){ echo "active" ; } ?>">
                <a href="">
                    <i class="glyphicon glyphicon-level-up"></i>
                        <span>อัพเดทสถานะการทำงาน</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php if($page == 'update_kpi.php'){ echo "active" ; } ?>">
                        <a href="update_kpi.php"><i class="fa fa-circle-o"></i>อัพเดทKPIs</a>
                    </li>
                </ul>
            </li>
            <!-- เมนู HR-->
            <li class="<?php if($page == 'hr_kpi_individual.php' || $page =='hr_all_kpi_detail.php' || $page =='hr_approve_kpi.php' || $page =='hr_report_page.php' ){ echo "active" ; } ?>">
                <a href="">
                    <i class="glyphicon glyphicon-user"></i>
                        <span>เมนูสำหรับฝ่ายบุคคล</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="">
                        <a href="#"><i class="fa fa-circle-o"></i>จัดการระบบประเมิน</a>
                    </li>
                    <li class="">
                        <a href="#"><i class="fa fa-circle-o"></i>แก้ไขแบบประเมิน</a>
                    </li>
                    <li class="">
                        <a href="#"><i class="fa fa-circle-o"></i>จัดการข้อมูลพนักงาน</a>
                    </li>
                    <li class="<?php if($page == 'hr_kpi_individual.php'){ echo "active" ; } ?>">
                        <a href="hr_kpi_individual.php"><i class="fa fa-circle-o"></i>ข้อมูลKPIsรายบุคคล</a>
                    </li>
                    <li class="<?php if($page == 'hr_all_kpi_detail.php'){ echo "active" ; } ?>">
                        <a href="hr_all_kpi_detail.php"><i class="fa fa-circle-o"></i>ข้อมูลKPIsทั้งหมด</a>
                    </li>
                    <li class="<?php if($page == 'hr_approve_kpi.php'){ echo "active" ; } ?>">
                        <a href="hr_approve_kpi.php"><i class="fa fa-circle-o"></i>อนุมัติKPIsครั้งถัดไป</a>
                    </li>
                    <li class="<?php if($page == 'hr_report_page.php'){ echo "active" ; } ?>">
                        <a href="hr_report_page.php"><i class="fa fa-circle-o"></i>ออกรายงาน</a>
                    </li>
                    
                </ul>
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