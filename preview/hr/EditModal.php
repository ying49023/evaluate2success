<html>

    <head>
        <?php include('./classes/connection_mysqli.php') ?>
        
        <title>ThaiCreate.Com PHP & MySQL Tutorial</title>

    </head>

    <body>

        <?php
        //$open=$_POST["textopen"];
        //$close=$_POST["textclose"];
        $strSQL = "UPDATE evaluation SET ";
        $strSQL .="open_system_date= '" . $_POST["textopen"] . "' ";
        $strSQL .=",close_system_date = '" . $_POST["textclose"] . "' ";
        $strSQL .="WHERE company_id = 1 and term= '".$_POST["textterm"]."' and year='".$_POST["textyear"]."'";
        $objQuery = mysqli_query($conn,$strSQL);
        if ($objQuery) {

            echo "Record update successfully";
            
            
        } else {

            echo "Error Save [" . $strSQL . "]";
        }
        
        ?>
        
    </body>
</html>