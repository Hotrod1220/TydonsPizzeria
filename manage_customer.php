<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tydon's Pizzeria - Manage Customer Accounts</title>
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
                <h1>Customer Management</h1>
            </div>
            <a href="index.php" class="button">Return Home.</a>
            <form action='' method='post'>
            <table class="text-wrapper">
              <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Edit Customer?</th>
                <th>Delete Customer?</th>
              </tr>

<?php
  require_once '/home/hipt3660/config/mysql_config.php';
  if (isset($_POST['fire'])) {
    foreach ($_POST['fire'] as $fire) {
      $fireQuery = "delete from CUSTOMER where custID = $fire";
      $conn->query($fireQuery);
    }
  }

  $customerQuery = "select * from CUSTOMER";
  $customers = $conn->query($customerQuery);

  if ($customers->num_rows != 0) {
    while ($row = $customers->fetch_assoc()) {
      echo 
        "<tr>
          <td>{$row['name']}</td>
          <td>{$row['address']}</td>
          <td>{$row['email']}</td>
          <td>{$row['phoneNum']}</td>
          <td>
            <button type='button' class=\"small-button\" onclick=\"window.location.href = 'update_customer.php?custID={$row['custID']}'\">Edit</button>
          </td>
          <td><input type='checkbox' name='fire[]' value={$row['custID']}></td>
        </tr>"
      ;
    }
    echo '<tr><td/><td/><td/><td/><td/><td><input type="submit" class="small-button" value="Delete selected"></td></tr></table></form>';
  } else {
    echo 'No customers :(';
  }
?>