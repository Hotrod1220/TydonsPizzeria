<?php
if (isset($_POST['empID'])) {
  // posted a change, update table
  require_once '/home/hipt3660/config/mysql_config.php';
  date_default_timezone_set('America/Edmonton');
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  $clockedIn = 0;
  if (isset($_POST['clockedIn'])) {
    $clockedIn = 1;
  }

  $sql = "update ORDERS set status = '{$_POST['status']}',
    position = '{$_POST['position']}',
    empID = $employeeID,
    where orderID = {$_POST['orderID']};"
  ;
  try {
    $conn->query($sql);
    echo "Information for {$_POST['name']} updated successfully.<br><br>";
    echo "<a href=\"manage_employee.php\">Return</a> to Employee Management.";
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
  <div class="container wrapper">
    <?php
      require_once '/home/hipt3660/config/mysql_config.php';
      $sql = "select * from ORDERS where orderID = {$_GET['orderID']}";
      $sqlc = "select * from CONTAINS where orderID = {$_GET['orderID']}";
      
      try {
        $result = $conn->query($sql);
      } catch (Exception $e) {
        echo $e->getMessage();
      }

      try {
        $resultc = $conn->query($sqlc);
      } catch (Exception $e) {
        echo $e->getMessage();
      }

      if ($result->num_rows != 0) {
        if ($resultc->num_rows != 0) {
        $order = $result->fetch_assoc();
        $contains = $resultc->fetch_assoc();
        $sqliname = "SELECT itemName FROM MENU WHERE itemID = {$contains['itemID']}";
        try {
            $resiname = $conn->query($sqliname);
          } catch (Exception $e) {
            echo $e->getMessage();
          }
        $itemname = $resiname->fetch_assoc();
        echo "<h2>Update Information for {$order['orderID']}</h2>";
        echo "<form action='' method='post'>";
        echo "Status: <input type=text name='status' value='{$order['status']}' size=20><br><br>";
        echo "Employee ID: <input type=text name='wage' value={$order['empID']} size=6><br><br>";
        echo "Item: <input type=text name='position' value='{$itemname}' size=15><br><br>";
        echo "On Shift?:";
        if ($order['clockedIn']) {
          echo "<input type=checkbox name='clockedIn' checked><br><br>";
        } else {
          echo "<input type=checkbox name='clockedIn'><br><br>";
        }
        echo "<input type=hidden name='empID' value='{$_GET['empID']}'>";
        echo "<input type=submit class='small-button' name='submit' value='Update'>";
        echo "</form>";
      } else {
        echo "No order with ID of {$_GET['orderID']} exists.";
      }
    } else {
        echo "No order with ID of {$_GET['orderID']} exists. :(";
      }
    ?>
    </div>
  </body>
</html>