<?php

if (isset($_post["term"]) && isset($_post["year"])) {
    $term = $_post["term"];
    $year = $_post["year"];
    
    $sql_evaluation = "insert into evaluation(company_id,term_id,year,open_system_date,close_system_date,current_eval) values(1,$term,$year,'0000-00-00','0000-00-00',1)";
    $query_evaluation = mysqli_query($conn, $sql_evaluation);
    
    
    $eval_code = '';
    $sql_eval_id = "select max(e.evaluation_code) as code from evaluation e  join term t on e.term_id=t.term_name";
    $query_eval_id = mysqli_query($conn, $sql_eval_id);
    while ($result_eval_id = mysqli_fetch_array($query_eval_id, MYSQLI_ASSOC)) {

        $eval_code = $result_eval_id['code'];
        {
            $msg = 'Error :' . mysql_error();
            echo "Error Save [" . $sql_evaluation . "]";
            echo "Error Save [" . $sql_eval_id . "]";
        }
    }
    header("location:explaned_evaluation.php?eval_id=$eval_code");

}
?>
