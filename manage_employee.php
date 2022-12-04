<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tydon's Pizzeria - Manage Employees</title>
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
              <h1>Employee Management</h1>
            </div>
            <a href="index.php" class="button">Return Home.</a>
            <form action='' method='post'>
            <table class="text-wrapper">
              <tr>
                <th>Name</th>
                <th>Wage</th>
                <th>Position</th>
                <th>On shift?</th>
                <th>Edit Employee?</th>
                <th>Fire Employee?</th>
              </tr>

<?php
  require_once '/home/hipt3660/config/mysql_config.php';
  if (isset($_POST['fire'])) {
    foreach ($_POST['fire'] as $fire) {
      $fireQuery = "delete from EMPLOYEE where empID = $fire";
      $conn->query($fireQuery);
    }
  }

  $employeeQuery = "select * from EMPLOYEE";
  $employees = $conn->query($employeeQuery);

  if ($employees->num_rows != 0) {
    while ($row = $employees->fetch_assoc()) {
      $clocked = ($row['clockedIn'] == 0 ? 'No' : 'Yes');
      echo 
        "<tr>
          <td>{$row['name']}</td>
          <td>\${$row['wage']}/hr</td>
          <td>{$row['position']}</td>
          <td>$clocked</td>
          <td>
            <button type='button' class=\"small-button\" onclick=\"window.location.href = 'update_employee.php?empID={$row['empID']}'\">Edit</button>
          </td>
          <td><input type='checkbox' name='fire[]' value={$row['empID']}></td>
        </tr>"
      ;
    }
    echo '<tr><td/ class="no-border"><td/ class="no-border"><td/ class="no-border"><td/ class="no-border"><td/ class="no-border">
    <td class="no-border"><input type="submit" class="small-button" value="Fire selected"></td></tr></table></form>';
  } else {
    echo 'No employees :(';
  }
?>