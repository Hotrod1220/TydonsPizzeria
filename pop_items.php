<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tydon's Pizzeria - Update Employee</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Acme&family=Montserrat&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
  <header class="wrapper">
            <div class="container orange-text">
                <h1><a href="index.php">Tydon's Pizzeria<a></h1>
            </div>
        </header>
  <div class="container">
    <h1 class="text-wrapper"> The Most Popular Menu Items of the Month!</h1>

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
        echo '<td>' . $row['num_ordered'] . '</td>';
        echo '</tr>';
    }
}
echo '</table>';
?>