<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tydon's Pizzeria - Manage Orders</title>
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
        <main class="container">
            <div class="text-wrapper">
              <h1>Order Management</h1>
            </div>
            <a href="index.php" class="button">Return Home.</a>
            <form action='' method='post'>
            <table class="text-wrapper">
              <tr>
                <th>Status</th>
                <th>Price</th>
                <th>Order Time</th>
                <th>Employee Assigned</th>
                <th>Customer Name</th>
              </tr>

<?php
  require_once '/home/hipt3660/config/mysql_config.php';
  if (isset($_POST['fire'])) {
    foreach ($_POST['fire'] as $fire) {
      $fireQuery = "delete from ORDERS where orderID = $fire";
      $conn->query($fireQuery);
    }
  }

  $employeeQuery = "select * from ORDERS";
  $employees = $conn->query($employeeQuery);
  

  if ($employees->num_rows != 0) {
    while ($row = $employees->fetch_assoc()) {
      $clocked = ($row['isComplete'] == 0 ? 'No' : 'Yes');
      switch ($row["status"]) {
        case 0:
            $field3name = "Received";
            break;
        case 1:
            $field3name = "Preparing";
            break;
        case 2:
            $field3name = "Baking";
            break;
        case 3:
            $field3name = "Quality Check";
            break;
        case 4:
            $field3name = "Ready for Pickup";
            break;
        default:
            $field3name = "Invalid Order Status";
            break;
    }
    if ($empResult && $empResult->num_rows > 0) {
        $field7name = $empResult->fetch_assoc()["name"];
    } else {
        $field7name = "Employee Not Found";
    }
    $custResult = $conn->query("SELECT name from CUSTOMER where custID = $row[custID]");
    if ($custResult && $custResult->num_rows > 0) {
        $field8name = $custResult->fetch_assoc()["name"];
    } else {
        $field8name = "Customer Not Found";
    }
    $field5name = date('Y-m-d H:i', $row["orderTime"]);
      echo 
        "<tr>
          <td>{$field3name}</td>
          <td>\${$row['price']}/hr</td>
          <td>{$field5name}</td>
          <td>$clocked</td>
          <td>{$field7name}</td>
          <td>{$field8name}</td>
          <td>
            <button type='button' class=\"small-button\" onclick=\"window.location.href = 'update_order.php?empID={$row['orderID']}'\">Edit</button>
          </td>
          <td><input type='checkbox' name='fire[]' value={$row['orderID']}></td>
        </tr>"
      ;
    }
    echo '<tr><td/><td/><td/><td/><td/><td><input type="submit" class="small-button" value="Fire selected"></td></tr></table></form>';
  } else {
    echo 'No orders :(';
  }
?>