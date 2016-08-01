<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php 
        include ('./classes/connection_mysqli.php');
        $status='';
        $empid='';
        $msg='';
        
        /*if(isset($_GET["status"])){
            $status = $_GET["status"];
            
        }*/
        if (isset($_GET["emp_id"])) {
                $get_emp_id = $_GET["emp_id"];
        }

        if($get_emp_id!=''){       

            $add_query="DELETE FROM employees WHERE employee_id=$get_emp_id ";
            
            $a_query =  mysqli_query($conn,$add_query);
            
            if($a_query)
               echo "Record delete successfully";
            else {
                $msg='Error :'.mysql_error();
                echo "Error Save [" . $add_query . "]";
                
            }
        }
        
        header("Location: manage_employee_list.php");
?>
