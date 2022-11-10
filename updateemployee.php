<?php
require_once '/home/hipt3660/config/mysql_config.php';

echo "<form action=\"updateemployee2.php\" method=post>";
    $sql = "select * from EMPLOYEE where empID='$_POST[empID]'";

    $result = $conn->query($sql);
    if(!$result) {
        echo "Problem executing select!";
        exit; 
    }
    if($result->num_rows!= 0) {
        $rec=$result->fetch_assoc(); 
        echo "Employee ID: <input type=text name=\"empID\" size=8><br><br>";
        echo "Name: <input type=text name=\"name\" size=20><br><br>";
        echo "Wage: <input type=text name=\"wage\" size=6><br><br>";
        echo "Position: <input type=text name=\"position\" size=15><br><br>";
        echo "On Shift?: <input type=checkbox name=\"clockedIn\" size=15><br><br>";
        echo "<input type=hidden name=\"oldempID\" value=\"$_POST[empID]\">";
        echo "<input type=submit name=\"submit\" value=\"Update\">"; 
    }
    else
    {
        echo "<p>No data entered</p>"; 
    }

echo "</form>";

?>