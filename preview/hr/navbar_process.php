<?php
if(isset($_GET["eval_code"])){
    $eval_code = $_GET["eval_code"];
}
?>
<div class="navbar-process">
    <?php // $page = basename($_SERVER['SCRIPT_NAME']); ?>
    <ul id="tabs" class="nav nav-pills nav-justified" data-tabs="tabs">
        <li class="<?php if ($page == 'explan_evaluation.php') {
        echo "active";
    } ?>">
            <a href="explan_evaluation.php?eval_code=<?php echo $eval_code; ?>"  aria-expanded="false">คำชี้แจง</a>
        </li>
        <li class="<?php if ($page == 'evaluation_section_1.php') {
        echo "active";
    } ?>">
            <a href="evaluation_section_1.php?eval_code=<?php echo $eval_code; ?>"  aria-expanded="true">ส่วนที่ 1 : KPIs</a>
        </li>        
        <li class="<?php if ($page == 'evaluation_section_2.php') {
        echo "active";
    } ?>">
            <a href="evaluation_section_2.php?position_level_id=&eval_code=<?php echo $eval_code; ?>"  aria-expanded="false">ส่วนที่ 2 : Competency</a>
        </li>        
        <li class="<?php if ($page == 'evaluation_section_3.php') {
        echo "active";
    } ?>">
            <a href="evaluation_section_3.php?eval_code=<?php echo $eval_code; ?>"  aria-expanded="false">ส่วนที่ 3 : กฎระเบียบข้อบังคับ</a>
        </li>        
        <li class="<?php if ($page == 'evaluation_section_4.php') {
        echo "active";
    } ?>">
            <a href="evaluation_section_4.php?eval_code=<?php echo $eval_code; ?>"  aria-expanded="false">ส่วนที่ 4 : ควมคิดเห็นเพิ่มเติม</a>
        </li>        
    </ul>
</div>