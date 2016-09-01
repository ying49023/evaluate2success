<?php include '../classes/connection_mysqli.php'; ?>

<div class="header">
    <?php  
        $sql = "SELECT
                        *
                FROM
                        employees e
                JOIN departments d ON e.department_id = d.department_id
                JOIN position_level p ON p.position_level_id = e.position_level_id
                JOIN company c ON c.company_id = e.company_id
                JOIN jobs j ON j.job_id = e.job_id
                WHERE username = '".$_SESSION["username"]."' 
                LIMIT 1" ;
        $query = mysqli_query($conn, $sql);
        while($result = mysqli_fetch_array($query)){
            
        $name = $result["prefix"].$result["first_name"]." ".$result["last_name"];
        $email = $result["email"];
        $tel = $result["telephone_no"];
        $job = $result["job_name"];
        $department = $result["department_name"];
        $company = $result["company_name"];
        $position = $result["position_description"];
    ?>
    <span class="pull-left">Header</span>
    <span class="pull-right">Name : <?php echo $name; ?></span>
    <?php } ?>    
</div>
    