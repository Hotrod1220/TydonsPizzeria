<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once '/home/hipt3660/config/mysql_config.php';
date_default_timezone_set('America/Edmonton');

$sql = "SELECT * FROM POPULAR_MONTH_ITEMS";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["itemName"] . "</td><td>" . $row["itemCount"] . "</td></tr>";
    }
} else {
    echo "0 results";
}
?>
<html>
    <h1> Heli's Bakery </h1>
</html>