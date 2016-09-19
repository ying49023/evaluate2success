<?php $page = basename($_SERVER['SCRIPT_NAME']); ?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel" style="white-space:normal;max-width: 230px;">
            <div class="pull-left image">
                <img style="height: 45px;max-width: 45px;" src="upload_images/<?php echo $my_picture; ?>" class="img-circle img-center " alt="<?php echo $my_name; ?>">
            </div>
            <div class="pull-left info" >
                <p><?php echo $my_name; ?></p>
                <p>ตำแหน่ง: <?php echo $my_job; ?></p>
                <!--
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
            </div>
        </div>   

        <!-- sidebar menu: : style can be found in sidebar.less -->
        
        <ul class="sidebar-menu">
            <li class="header" style="color:white;font-size: 14px;" >เมนูสำหรับระดับ<?php echo $my_position; ?></li>
            <!-- Dashboard -->
            <li class=" <?php if($page == 'index.php' || $page == 'total_personal_dashboard.php' || $page == 'myindex.php'){ echo "active" ; } ?> " >
                <a href="">
                    <i class="glyphicon glyphicon-dashboard"></i> <span>แดชบอร์ด</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php if($my_position_level >1 ){ ?>
                    <li class="<?php if($page == 'index.php'){ echo "active" ; } ?>">
                        <a href="index.php"><i class="fa fa-circle-o"></i> ภาพรวม</a>
                    </li>
                    <li class="<?php if($page == 'total_personal_dashboard.php'){ echo "active" ; } ?>">
                        <a  href="total_personal_dashboard.php"><i class="fa fa-circle-o"></i> รายบุคคล</a>
                    </li>
                    <?php } ?>
                    <li class="<?php if($page == 'myindex.php'){ echo "active" ; } ?>">
                        <a href="myindex.php"><i class="fa fa-circle-o"></i>ของตนเอง</a>
                    </li>
                </ul>
            </li>
            <!--/Dashboard -->
            <!--Evaluation -->
            <li class=" <?php if($page == 'explan_evaluation.php'  || $page == 'evaluation_section_1.php'  || $page == 'evaluation_section_2.php'  || $page == 'evaluation_section_3.php'   || $page == 'evaluation_section_4.php'  || $page == 'evaluate_sub_list.php' || $page == 'search_summaryeval.php' || $page == 'my_summaryevaluation.php'){ echo "active" ; } ?>" >
                <a href="#">
                    <i class="glyphicon glyphicon-file"></i>
                    <span>การประเมิน</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php if($my_position_level >1 ){ ?>
                    <li class="<?php if($page == 'evaluate_sub_list.php' || $page == 'explan_evaluation.php'  || $page == 'evaluation_section_1.php'  || $page == 'evaluation_section_2.php'  || $page == 'evaluation_section_3.php'   || $page == 'evaluation_section_4.php' || $page == 'evaluation_summary.php'){ echo "active" ; } ?>">
                        <a href="evaluate_sub_list.php"><i class="fa fa-circle-o"></i>ประเมินสมรรถนะ</a>
                    </li>
                    
                    <li class="<?php if($page == 'search_summaryeval.php'){ echo "active" ; } ?>">
                        <a href="search_summaryeval.php"><i class="fa fa-circle-o"></i>ดูผลการประเมิน</a>
                    </li>
                    <?php } ?>
                    <li class="<?php if($page == 'my_summaryevaluation.php'){ echo "active" ; } ?>">
                        <a href="my_summaryevaluation.php"><i class="fa fa-circle-o"></i>ดูผลการประเมินของตนเอง</a>
                    </li>
                </ul>
            </li>
            <!--/Evaluation-->
            
            <!--Tracking -->
            <?php if($my_position_level >1 ){ ?>
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
            <?php } ?>
            <!--/Tracking -->
            
            <!--  Update -->
            <li class="<?php if($page == 'update_kpi.php'){ echo "active" ; } ?>" >
                <a href="">
                    <i class="glyphicon glyphicon-level-up"></i>
                        <span>อัพเดทสถานะการทำงาน</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">

                    <li class="<?php if($page == 'update_kpi.php'){ echo "active" ; } ?>">
                        <a href="update_kpi.php"><i class="fa fa-circle-o"></i>อัพเดทKPIs</a>
                    </li>
                    <!--<li ><a href="#"><i class="fa fa-circle-o"></i>ตืดตามสถานรายแผนก</a></li>-->
                </ul>
            </li>
            <!-- /Update -->
             
             <!-- <li class="<?php if($page == 'assignkpi.php'){ echo "active" ; } ?>">
                <a href="assignkpi.php">
                    <i class="glyphicon glyphicon-check"></i> <span>การกำหนดKPIs</span>

                </a>
            </li>
            <li class="<?php if($page == 'report.php'){ echo "active" ; } ?>">
                <a href="report.php">
                    <i class="glyphicon glyphicon-envelope"></i> <span>แจ้งปัญหา/รายงานข้อผิดพลาด</span>

                </a>
            </li>-->
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>