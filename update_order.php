<?php
if (isset($_POST['orderID'])) {
  // posted a change, update table
  require_once '/home/hipt3660/config/mysql_config.php';
  date_default_timezone_set('America/Edmonton');
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  $clockedIn = 0;
  if (isset($_POST['clockedIn'])) {
    $clockedIn = 1;
  }
  $oop = $_POST['oldOrderPrice'];

  if(isset($_POST['add'])) { // checking if new quant is set
    $quanty = $_POST['add'];
    // get price for order
    
    foreach($quanty as $itemy => $quantidy) {
      // itemPrice for each item
      $iip = $_POST['itemPrice'][$itemy];
    if (isset($_POST['oldQuant'])) {
      if ($quantidy != $_POST['oldQuant'][$itemy]) {
        if($quantidy == 0) {
          $deleteQuery = "DELETE from CONTAINS where orderID = $_POST[orderID] and itemID = $itemy";
          echo $deleteQuery;
          try {
            $conn->query($deleteQuery);
            $oop -= $iip * $_POST['oldQuant'][$itemy]; // oop = old order price, iip = individual item price
          } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
          }
          } else {
            $updateQuery = "UPDATE CONTAINS set quantity = $quantidy where orderID = $_POST[orderID] and itemID = $itemy";
            echo $updateQuery;
            try {
              $conn->query($updateQuery);
              $oop -= $iip * $_POST['oldQuant'][$itemy];
              $oop += $iip * $quantidy;
            } catch (Exception $e) {
              echo "Error: " . $e->getMessage();
            }
          }
        }
      } else if ($quantidy) { // needs a new condition to actually work
        // insert new contains row using orderID
        $insertQuery = "INSERT INTO CONTAINS (orderID, itemID, quantity) VALUES ($_POST[orderID], $itemy, $quantidy)";
        echo $insertQuery;
        try {
          $conn->query($insertQuery);
          $oop += $iip * $quantidy;
        } catch (Exception $e) {
          echo "Error: " . $e->getMessage();
        }
      }
    }
  } 
  if(isset($_POST['isComplete'])) {
    $updateOrderQuery = "UPDATE ORDERS set price = $oop, status = $_POST[status], empID = $_POST[empID], isComplete = $_POST[isComplete] where orderID = $_POST[orderID]";
    echo $updateOrderQuery;
  } else {
    $updateOrderQuery = "UPDATE ORDERS set price = $oop, status = $_POST[status], empID = $_POST[empID] where orderID = $_POST[orderID]";
    echo $updateOrderQuery;
  }
  try {
    $conn->query($updateOrderQuery);
    echo "Information for {$_POST['orderID']} updated successfully.<br><br>";
    echo "<a href=\"manage_orders.php\">Return</a> to Order Management.";
  } catch (Exception $e) {
    echo $e->getMessage();
  }
} else if (!isset($_GET['orderID'])) {
  // No orderID in URL parameters, redirect back to employee management.
  header('Location: manage_orders.php');
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
  <div class="container">
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
            echo "<h2>Update Information for Order {$order['orderID']}</h2>";
        echo "<form action='' method='post'>";
        echo "Status: <input type=text name='status' value='{$order['status']}' size=20><br><br>";
        echo "Employee ID: <input type=text name='empID' value={$order['empID']} size=6><br><br>";
        echo '<table> <tr>
    <td> Name </td> 
    <td> Price </td> 
    <td> Vegan </td> 
    <td> Stock </td> 
    <td> Quantity </td>
    </tr>';
        $sql = "SELECT * FROM MENU";
        $result = $conn->query($sql);
      if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $field2name = $row["itemName"];
            $field3name = $row["itemPrice"];
            $field4name = $row["isVegan"];
            $field5name = $row["stock"];

            $vegan = ($field4name == 0 ? 'No' : 'Yes');

            // display quantity for item in that row where itemID = itemID
            $sqlq = "SELECT quantity FROM CONTAINS WHERE itemID = {$row['itemID']} AND orderID = {$_GET['orderID']}";
            $resultq = $conn->query($sqlq);
            $rowq = $resultq->fetch_assoc();

            echo '<tr> 
                      <td>'. $field2name.'</td> 
                      <td>'. $field3name.'</td> 
                      <td>'. $vegan. '</td> 
                      <td>'. $field5name."</td> 
                      <td><input type='number' name='add[$row[itemID]]' min='0' max='$field5name' value='$rowq[quantity]'></td>
                      <input type='hidden' name='oldQuant[$row[itemID]]' value='$rowq[quantity]'>
                  </tr>";
        }}
        echo "Order Completed?: ";
        if ($order['isComplete']) {
          echo "<input type=checkbox name='isComplete' checked><br><br>";
        } else {
          echo "<input type=checkbox name='isComplete'><br><br>";
        }
        echo "<input type=hidden name='orderID' value='{$_GET['orderID']}'>";
        echo "<input type=hidden name='oldOrderPrice' value='{$order['price']}'>";
        echo "<td class='no-border'><input type='submit' class='small-button' value='Confirm changes to Order {$_GET['orderID']}' action=''> </table> </form>";
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