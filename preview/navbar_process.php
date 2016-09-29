<?php
if(isset($_GET["eval_code"])){
    $eval_code = $_GET["eval_code"];
}
if(isset($_GET["emp_id"])){
    $emp_id = $_GET["emp_id"];
}
if(isset($_GET["position_level_id"])){
    $position_level = $_GET["position_level_id"];
}
if(isset($_GET["eval_emp_id"])){
    $eval_emp_id = $_GET["eval_emp_id"];
}
?>

<div class="navbar-process">
    <?php // $page = basename($_SERVER['SCRIPT_NAME']); ?>
    <ul id="tabs" class="nav nav-pills nav-justified" data-tabs="tabs">
        <li class="<?php if ($page == 'explan_evaluation.php') { echo "active complete"; } ?>">
            <a class="not-active" href="explan_evaluation.php"  aria-expanded="false">คำชี้แจง</a>
        </li>
        <li class="<?php if ($page == 'evaluation_section_1.php') { echo "active"; } ?>">
            <a class="not-active" href="evaluation_section_1.php"  aria-expanded="true">ส่วนที่ 1 : KPIs</a>
        </li>        
        <li class="<?php if ($page == 'evaluation_section_2.php') { echo "active"; } ?>">
            <a class="not-active" href="evaluation_section_2.php"  aria-expanded="false">ส่วนที่ 2 : Competency</a>
        </li>        
        <li class="<?php if ($page == 'evaluation_section_3.php') { echo "active"; } ?>">
            <a class="not-active" href="evaluation_section_3.php"  aria-expanded="false">ส่วนที่ 3 : กฎระเบียบข้อบังคับ</a>
        </li>        
        <li class="<?php if ($page == 'evaluation_section_4.php') { echo "active"; } ?>">
            <a  class="not-active" href="evaluation_section_4.php"  aria-expanded="false">ส่วนที่ 4 : ควมคิดเห็นเพิ่มเติม</a>
        </li>        
        <li class="<?php if ($page == 'evaluation_summary.php') { echo "active"; } ?>">
            <a  class="not-active" href="evaluation_summary.php"  aria-expanded="false">สรุปการประเมิน</a>
        </li>        
    </ul>
</div>
<!--<div class="">
            <div class="row bs-wizard" style="border-bottom:0;">
                
                <div class="col-xs-2 bs-wizard-step <?php if ($page != 'explan_evaluation.php') { echo "disabled"; } ?> ">
                  <div class="text-center bs-wizard-stepnum">คำชี้แจง</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center"></div>
                </div>
                
                <div class="col-xs-2 bs-wizard-step <?php if ($page != 'evaluation_section_1.php') { echo "disabled "; } ?>">
                  <div class="text-center bs-wizard-stepnum">ส่วนที่ 1</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center">การประเมินด้านผลงาน (KPIs)</div>
                </div>
                
                <div class="col-xs-2 bs-wizard-step <?php if ($page != 'evaluation_section_2.php') { echo "disabled"; } ?>"> complete 
                  <div class="text-center bs-wizard-stepnum">ส่วนที่ 2 </div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center">พฤติกรรมในการทำงานของพนักงาน (Competency)</div>
                </div>
                
                <div class="col-xs-2 bs-wizard-step <?php if ($page != 'evaluation_section_3.php') { echo "disabled"; } ?>"> complete 
                  <div class="text-center bs-wizard-stepnum">ส่วนที่ 3 </div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center">การปฏิบัติตามกฎระเบียบ และข้อบังคับของบริษัท </div>
                </div>
                
                <div class="col-xs-2 bs-wizard-step <?php if ($page != 'evaluation_section_4.php') { echo ""; } ?> complete "> active 
                  <div class="text-center bs-wizard-stepnum">ส่วนที่ 4 </div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center">ความคิดเห็นเพิ่มเติม และการประเมินผลโดยรวม (Overall Rating) </div>
                </div>
                <div class="col-xs-2 bs-wizard-step <?php if ($page != 'evaluation_summary.php') { echo "disabled"; } ?> active"> active 
                  <div class="text-center bs-wizard-stepnum">สรุปผลการประเมิน </div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center"> สรุปคะแนนที่ได้รับจากแต่ละส่วน เพื่อประเมินผลโดยรวม ของทั่ง 2 เทอม</div>
                </div>
            </div>
	</div>-->