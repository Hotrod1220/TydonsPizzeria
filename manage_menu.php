<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tydon's Pizzeria - Manage Menu Items</title>
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
              <h1>Menu Management</h1>
            </div>
            <a href="index.php" class="button">Return Home.</a>
            <form action='' method='post'>
            <table class="text-wrapper">
              <tr>
                <th>Name</th>
                <th>Item Price</th>
                <th>Is it Vegan?</th>
                <th>Stock</th>
                <th>Edit Menu Item?</th>
                <th>Delete Menu Item?</th>
              </tr>
            </table>  
        </main>
    </body>
</html>

<?php
  require_once '/home/hipt3660/config/mysql_config.php';
  if (isset($_POST['fire'])) {
    foreach ($_POST['fire'] as $fire) {
      $fireQuery = "delete from MENU where itemID = $fire";
      $conn->query($fireQuery);
    }
  }

  $menuQuery = "select * from MENU";
  $menus = $conn->query($menuQuery);

  if ($menus->num_rows != 0) {
    while ($row = $menus->fetch_assoc()) {
      $vegan = ($row['isVegan'] == 0 ? 'No' : 'Yes');
      echo 
        "<tr>
          <td>{$row['itemName']}</td>
          <td>\${$row['itemPrice']}</td>
          <td>$vegan</td>
          <td>{$row['stock']}</td>
          <td>
            <button type='button' class=\"small-button\" onclick=\"window.location.href = 'update_menu.php?itemID={$row['itemID']}'\">Edit</button>
          </td>
          <td><input type='checkbox' name='fire[]' value={$row['itemID']}></td>
        </tr>"
      ;
    }
    echo '<tr><td/><td/><td/><td/><td/><td><input type="submit" class=\"small-button\" value="Delete selected"></td></tr></table></form>';
  } else {
    echo 'No menu :(';
  }
?>