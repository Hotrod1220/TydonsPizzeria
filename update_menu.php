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
if (isset($_POST['itemID'])) {
  // posted a change, update table
  require_once '/home/hipt3660/config/mysql_config.php';
  $vegan = 0;
  if (isset($_POST['isVegan'])) {
    $vegan = 1;
  }

  $sql = "update MENU set itemName = '{$_POST['itemName']}',
    itemPrice = {$_POST['itemPrice']},
    isVegan = $vegan,
    stock = {$_POST['stock']}
    where itemID = {$_POST['itemID']};"
  ;
  try {
    $conn->query($sql);
    echo "<h1 class=\"text-wrapper\">Information for {$_POST['itemName']} updated successfully.</h1><br><br>";
    echo "<a href=\"manage_menu.php\" class=\"button\">Return to Menu Management.</a>";
    exit();
  } catch (Exception $e) {
    echo $e->getMessage();
  }
} else if (!isset($_GET['itemID'])) {
  // No itemID in URL parameters, redirect back to menu management.
  header('Location: manage_menu.php');
  exit();
}
?>

            <div class="container orange-text">
                <h1><a href="index.php">Tydon's Pizzeria<a></h1>
            </div>
        </header>
    <div class="container wrapper">
    <?php
      require_once '/home/hipt3660/config/mysql_config.php';
      $sql = "select * from MENU where itemID = {$_GET['itemID']}";
      
      try {
        $result = $conn->query($sql);
      } catch (Exception $e) {
        echo $e->getMessage();
      }

      if ($result->num_rows != 0) {
        $menu = $result->fetch_assoc();
        echo "<h2>Update Information for {$menu['itemName']}</h2>";
        echo "<form action='' method='post'>";
        echo "Name: <input type=text name='itemName' value='{$menu['itemName']}' size=20><br><br>";
        echo "Item Price: <input type=text name='itemPrice' value={$menu['itemPrice']} size=6><br><br>";
        echo "Is it Vegan?:";
        if ($menu['isVegan']) {
          echo "<input type=checkbox name='isVegan' checked><br><br>";
        } else {
          echo "<input type=checkbox name='isVegan'><br><br>";
        }
        echo "Stock: <input type=text name='stock' value={$menu['stock']} size=4><br><br>";
        echo "<input type=hidden name='itemID' value='{$_GET['itemID']}'>";
        echo "<input type=submit class='small-button' name='submit' value='Update'>";
        echo "</form>";
      } else {
        echo "no menu with ID {$_GET['itemID']} :(";
      }
    ?>
    </div>
  </body>
</html>