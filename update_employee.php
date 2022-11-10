<!DOCTYPE html>
<html>
    <head>
        <title>Tydon's Pizzeria - Update Employee</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <h2>Update Employee Information</h2>
        <?php
            require_once '/home/hipt3660/config/mysql_config.php';

            echo "<form action=\"updateemployee.php\" method=post>";

            $sql = "select empID from EMPLOYEE"; 
            $result = $conn->query($sql);
            if($result->num_rows != 0)
            {
                echo "Employee ID: <select name=\"empID\">";
                    
                while($val = $result->fetch_assoc())
                {
                echo "<option value='$val[empID]'>$val[empID]</option>"; 

                }
                echo "</select>"; 
                echo "<input type=submit name=\"submit\" value=\"View\">"; 
            }
            else
            {
                echo "<p>No data entered</p>"; 
            }

            echo "</form>";
        ?>
    </body>
</html>