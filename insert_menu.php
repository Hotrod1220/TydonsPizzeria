<?php
if (isset($_POST['itemName'])) {

    require_once '/home/hipt3660/config/mysql_config.php';
        
    $sql = "insert into MENU (itemName, itemPrice, isVegan, stock) values ('$_POST[itemName]','$_POST[itemPrice]','$_POST[isVegan]','$_POST[stock]')";
    if($conn->query($sql)) {
        echo "<h3>Menu item has been added.</h3>";
    }
    else {
        $err = $conn->errno; 
        echo "<p>MySQL error code $err </p>";
    }
    echo "<a href=\"index.php\">Return</a> to Home Page.";
    exit();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Tydon's Pizzeria - Add a New Menu Item</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <h2>Add a New Menu Item</h2>
        <form action="" method=post>
            Name: <input type=text name="name" size=20><br><br>
            Item Price: $<input type=text name="itemPrice" size=6><br><br>
            Is it Vegan?: <input type=checkbox name="isVegan" value=1><br><br>
            Stock: <input type=text name="stock" size=15><br><br>
            <input type=submit name="submit" value="Insert">
        </form>     
    </body>
</html>