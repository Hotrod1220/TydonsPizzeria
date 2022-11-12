<?php
require_once '/home/hipt3660/config/mysql_config.php';
    
$sql = "insert into EMPLOYEE (name, wage, position, clockedIn) values ('$_POST[name]','$_POST[wage]','$_POST[position]','$_POST[clockedIn]')";
if($conn->query($sql)) {
    echo "<h3>Employee has been hired.</h3>";
}
else {
    $err = $conn->errno; 
    echo "<p>MySQL error code $err </p>";
}
echo "<a href=\"main.php\">Return</a> to Home Page.";
?>