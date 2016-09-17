<?php include ('./classes/connection_mysqli.php'); ?>
<?php

$sql_eval_id ="SELECT e.evaluate_employee_id,em.position_level_id
                from evaluation_employee e
                JOIN employees em
                ON e.employee_id=em.employee_id
                JOIN evaluation ev
                ON e.evaluation_code=ev.evaluation_code
                WHERE ev.evaluation_code=3
                ORDER BY em.position_level_id";
    $query_eval_id = mysqli_query($conn, $sql_eval_id);
    while ($result_eval_id= mysqli_fetch_array($query_eval_id, MYSQLI_ASSOC))  {
        $eval_emp = $result_eval_id['evaluate_employee_id'];
        $position = $result_eval_id['position_level_id'];
        
        $sql_comp_id ="SELECT m.manage_comp_id,m.position_level_id
                        FROM manage_competency m
                        JOIN evaluation e
                        WHERE e.evaluation_code=3
                        ORDER BY m.position_level_id";
        $query_comp_id = mysqli_query($conn, $sql_comp_id);
        while ($result_comp_id= mysqli_fetch_array($query_comp_id, MYSQLI_ASSOC))  {
            $manage_comp_id=$result_comp_id['manage_comp_id'];
            $level_id=$result_comp_id['position_level_id'];
            
            if($position==$level_id){
               $sql_upd=  "INSERT INTO evaluation_competency VALUES (DEFAULT,$eval_emp,0,0,'',$manage_comp_id)";
               $query_upd = mysqli_query($conn, $sql_upd);
               if ($query_upd)
                            echo "Record update successfully";
                        else {
                            $msg = 'Error :' . mysql_error();
                            echo "Error Save [" . $sql_upd. "]";
                        }
            }
            
        }
        
    }
    
?>
