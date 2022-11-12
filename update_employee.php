<?php
if (isset($_POST['empID'])) {
  require_once '/home/hipt3660/config/mysql_config.php';

  $sql = "update EMPLOYEE set name = '{$_POST['name']}',
    wage = {$_POST['wage']},
    position = '{$_POST['position']}',
    clockedIn = '{$_POST['clockedIn']}',
    where empID = {$_POST['empID']};";
  try {
    $conn->query($sql);
    echo "Information for {$_POST['name']} updated successfully.<br><br>";
    echo "<a href=\"main.php\">Return</a> to Home Page.";
    exit();
  } catch (Exception $e) {
    echo $e->getMessage();
  }
} else if (!isset($_GET['empID'])) {
  // No empID in URL parameters, redirect back to employee management.
  header('Location: manage_employee.php');
  exit();
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Tydon's Pizzeria - Update Employee</title>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <?php
      require_once '/home/hipt3660/config/mysql_config.php';
      $sql = "select * from EMPLOYEE where empID = {$_GET['empID']}";
      $result = $conn->query($sql);

      if ($result->num_rows != 0) {
        echo "<h2>Update Information for {$result['name']}</h2>;";
        echo "<form action='', method='post'>";
        echo "Name: <input type=text name='name' value='{$result['name']}' size=20><br><br>";
        echo "Wage: <input type=text name='wage' value={$result['wage']} size=6><br><br>";
        echo "Position: <input type=text name='position' value='{$result['position']}' size=15><br><br>";
        echo "On Shift?: <input type=checkbox name='clockedIn' value={$result['clockedIn']}><br><br>";
        echo "<input type=hidden name='empID' value='{$_GET['empID']}'>";
        echo "<input type=submit name='submit' value='Update'>";
        echo "</form>";
      } else {
        echo "no employee with ID {$_GET['empID']} :(";
      }
    ?>
  </body>
</html>