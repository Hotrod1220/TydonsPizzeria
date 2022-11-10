<?php
require_once '/home/hipt3660/config/mysql_config.php';
    
$sql = "insert into EMPLOYEE (empID, name, wage, position, clockedIn) values ('$_POST[empID]','$_POST[name]','$_POST[wage]','$_POST[position]','$_POST[clockedIn]')";
if($conn->query($sql)) {
    echo "<h3>Employee has been hired.</h3>";
}
else {
    $err = $conn->errno; 
    if($err == 1062)
    {
       echo "<p>Employee ID $_POST[empID] already exists.</p>"; 
    } else {
       echo "<p>MySQL error code $err </p>";
    }
}
echo "<a href=\"main.php\">Return</a> to Home Page.";
?>