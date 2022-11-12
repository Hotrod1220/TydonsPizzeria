<html>
  <head>
    <title>Tydon\'s Pizzeria Employee Management</title>
    <link rel="stylesheet" href="css/style.css">
  </head>
   <body>
    <h1>Employee Management</h1>
    <a href="index.php">Return</a> Home.
    <form action='' method='post'>
    <table>
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
            <button type='button' onclick=\"window.location.href = 'update_employee.php?empID={$row['empID']}'\">Edit</button>
          </td>
          <td><input type='checkbox' name='fire[]' value={$row['empID']}></td>
        </tr>"
      ;
    }
    echo '<tr><td/><td/><td/><td/><td/><td><input type="submit" value="Fire selected"></td></tr></table></form>';
  } else {
    echo 'No employees :(';
  }
?>