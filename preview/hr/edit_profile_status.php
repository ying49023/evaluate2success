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
            
           
            $prefix =$_POST['prefix'];
            $first_name=$_POST['first_name'];
            $last_name=$_POST['last_name'];
            $department_id=$_POST['department'];
            $job_id=$_POST['job_id'];
            $position_level_id=$_POST['position_level_id'];
            $manager=$_POST['manager'];
            $telephone=$_POST['telephone'];
            $address=$_POST['address'];
            $email=$_POST['email'];
            //$hiredate =$_POST['startdate'];
            $mng =''; 
            $sql = "SELECT employee_id,concat(first_name,' ',last_name) as name from employees where concat(first_name,' ',last_name) like '%$manager%'  ";
            $query= mysqli_query($conn, $sql);
             while($mresult = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
             $mng =$mresult['employee_id'];                                           
             $name =$mresult['name'];
             
             }   
            //$add_query="UPDATE employees(prefix,first_name,last_name,department_id,job_id,position_level_id,manager_id,telephone_no,address,email,company_id) VALUES ('$prefix','$first_name','$last_name',$department_id,$job_id,$position_level_id,$mng,'$telephone','$address','$email',1) where employee_id=$id";            
            
            $add_query="UPDATE employees SET prefix ='$prefix',first_name='$first_name',last_name='$last_name',department_id=$department_id,job_id=$job_id,manager_id=$mng,position_level_id=$position_level_id,telephone_no='$telephone',email='$email',company_id=1 WHERE employee_id=$get_emp_id ";
            
            $a_query =  mysqli_query($conn,$add_query);
            
            if($a_query)
               echo "Record update successfully";
            else {
                $msg='Error :'.mysql_error();
                echo "Error Save [" . $add_query . "]";
                
                
                
                
            }
        }
        ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php echo $msg ?>
        <br>
        <a href="edit_profile.php?emp_id=<?php echo $get_emp_id ?>">ย้อนกลับ</a>
        
    </body>
</html>
