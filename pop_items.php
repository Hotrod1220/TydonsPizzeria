<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once '/home/hipt3660/config/mysql_config.php';
date_default_timezone_set('America/Edmonton');

$sql = "SELECT * FROM POPULAR_MONTH_ITEMS";
$result = $conn->query($sql);
echo '<table> <tr> <th> Item Name </th> <th> Quantity Sold </th> </tr>';
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['itemName'] . '</td>';
        echo '<td>' . $row['quantitySold'] . '</td>';
        echo '</tr>';
    }
}
echo '</table>';
?>
<html>
    <h1> Heli's Bakery Coming Soon!</h1>
</html>