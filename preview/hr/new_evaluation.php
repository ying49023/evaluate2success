<?php
    session_start();
    include './classes/connection_mysqli.php';
    if (isset($_POST["term"]) && isset($_POST["year"])) {
        $term = $_POST["term"];
        $year = $_POST["year"];

        $sql_evaluation = "insert into evaluation(company_id,term_id,year,open_system_date,close_system_date,current_eval) values(1,$term,$year,'0000-00-00','0000-00-00',0)";
        $query_evaluation = mysqli_query($conn, $sql_evaluation);


        $eval_code = '';
        $sql_eval_id = "select max(e.evaluation_code) as code from evaluation e  join term t on e.term_id=t.term_name";
        $query_eval_id = mysqli_query($conn, $sql_eval_id);
        
        $result_eval_id = mysqli_fetch_array($query_eval_id, MYSQLI_ASSOC);
        $eval_code = $result_eval_id['code'];
        
//        $insert_emp_to_eval = "update evaluate_employee set evaluation_code = '$eval_code' ";
//        $query_emp_to_eval = mysqli_query($conn, $insert_emp_to_eval);
        //gen_header_comp(eval_code) Gen_Point_Competency(eval_code)
        $sql_gen_title_comp = "";

        if ($eval_code != '') {
            $sql_gen_title_comp = "call gen_header_comp($eval_code)";
            $query_gen_title_comp = mysqli_query($conn, $sql_gen_title_comp);
            $sql_Gen_Point_Competency = "call Gen_Point_Competency($eval_code)";
            $query_Gen_Point_Competency = mysqli_query($conn, $sql_Gen_Point_Competency);
            $insertEvalEmp= "CALL insertEvalEmp($eval_code)";
            $query_insertEvalEmp=  mysqli_query($conn,$insertEvalEmp);
            //echo $eval_code;
            header("location:create_evaluation.php");
//            header("location:explan_evaluation.php?eval_code=$eval_code");
        }
    }

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

