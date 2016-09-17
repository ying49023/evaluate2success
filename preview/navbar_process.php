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
        <li class="<?php if ($page == 'explan_evaluation.php') {
        echo "active";
    } ?>">
            <a href="explan_evaluation.php"  aria-expanded="false">คำชี้แจง</a>
        </li>
        <li class="<?php if ($page == 'evaluation_section_1.php') {
        echo "active";
    } ?>">
            <a href="evaluation_section_1.php"  aria-expanded="true">ส่วนที่ 1 : KPIs</a>
        </li>        
        <li class="<?php if ($page == 'evaluation_section_2.php') {
        echo "active";
    } ?>">
            <a href="evaluation_section_2.php"  aria-expanded="false">ส่วนที่ 2 : Competency</a>
        </li>        
        <li class="<?php if ($page == 'evaluation_section_3.php') {
        echo "active";
    } ?>">
            <a href="evaluation_section_3.php"  aria-expanded="false">ส่วนที่ 3 : กฎระเบียบข้อบังคับ</a>
        </li>        
        <li class="<?php if ($page == 'evaluation_section_4.php') {
        echo "active";
    } ?>">
            <a  href="evaluation_section_4.php"  aria-expanded="false">ส่วนที่ 4 : ควมคิดเห็นเพิ่มเติม</a>
        </li>        
    </ul>
</div>