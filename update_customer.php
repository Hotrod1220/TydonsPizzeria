<?php
if (isset($_POST['custID'])) {
  // posted a change, update table
  require_once '/home/hipt3660/config/mysql_config.php';

  $sql = "update CUSTOMER set name = '{$_POST['name']}',
    address = {$_POST['address']},
    email = '{$_POST['email']}',
    phoneNum = '{$_POST['phoneNum']}',
    where custID = {$_POST['custID']};"
  ;
  try {
    $conn->query($sql);
    echo $sql
    echo "Information for {$_POST['name']} updated successfully.<br><br>";
    echo "<a href=\"manage_customer.php\">Return</a> to Customer Management.";
    exit();
  } catch (Exception $e) {
    echo $e->getMessage();
  }
} else if (!isset($_GET['custID'])) {
  // No custID in URL parameters, redirect back to customer management.
  header('Location: manage_customer.php');
  exit();
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Tydon's Pizzeria - Update Customer</title>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <?php
      require_once '/home/hipt3660/config/mysql_config.php';
      $sql = "select * from CUSTOMER where custID = {$_GET['custID']}";
      
      try {
        $result = $conn->query($sql);
      } catch (Exception $e) {
        echo $e->getMessage();
      }

      if ($result->num_rows != 0) {
        $customer = $result->fetch_assoc();
        echo "<h2>Update Information for {$customer['name']}</h2>";
        echo "<form action='' method='post'>";
        echo "Name: <input type=text name='name' value='{$customer['name']}' size=20><br><br>";
        echo "Address: <input type=text name='address' value={$customer['address']} size=20><br><br>";
        echo "Email: <input type=text name='email' value='{$customer['email']}' size=20><br><br>";
        echo "Phone Number: <input type=text name='phoneNum' value='{$customer['phoneNum']}' size=20><br><br>";
        echo "<input type=hidden name='custID' value='{$_GET['custID']}'>";
        echo "<input type=submit name='submit' value='Update'>";
        echo "</form>";
      } else {
        echo "no customer with ID {$_GET['custID']} :(";
      }
    ?>
  </body>
</html>