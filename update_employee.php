<?php
  require_once '/home/hipt3660/config/mysql_config.php';
  echo '<html>
        <head>
          <title>Tydon\'s Pizzeria Employee Management</title>
        </head>
        <body>
          <h1>Employee Management</h1>
          <form action=\'\' method=\'post\'>
          <table>
            <tr>
              <th>Name</th>
              <th>Wage</th>
              <th>Position</th>
              <th>On shift?</th>
              <th>Edit Employee?</th>
              <th>Fire Employee?</th>
            </tr>
  ';

  if (isset($_POST['fire'])) {
    foreach ($_POST['fire'] as $fire) {
      $fireQuery = "DELETE from 'EMPLOYEE' where empID = $fire;";
      $conn->query($fireQuery);
    }
  }

  $employeeQuery = "select * from EMPLOYEE;";
  $employees = $conn->query($employeeQuery);

  if ($employees->num_rows != 0) {
    while ($row = $employees->fetch_assoc()) {
      echo "<tr>
              <td>{$row['name']}</td>
              <td>${$row['wage']}/hr</td>
              <td>{$row['position']}</td>
              <td>{$row['clockedIn']}</td>
              <td>
                <button onclick=\"window.location.href = 'insert_employe.php?empID={$row['empID']}'\">Edit</button>
              </td>
              <td><input type='checkbox' name='fire[{$row['empID']}]'></td>
            </tr>
      ";
    }
    echo '<input type="submit"></form>';
  } else {
    echo 'No employees :(';
  }
?>