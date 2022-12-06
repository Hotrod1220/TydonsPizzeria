<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tydon's Pizzeria - Hire a New Employee</title>
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
    echo "<a href=\"index.php\" class=\"button\">Return to Home.</a>";
    exit();
}
?>

            <h2 class="orange-text">Add a New Menu Item</h2>
            <form action="" method=post>
                Name: <input type=text name="itemName" size=20><br><br>
                Item Price: $<input type=text name="itemPrice" size=6><br><br>
                Is it Vegan?: <input type=checkbox name="isVegan" value=1><br><br>
                Stock: <input type=text name="stock" size=15><br><br>
                <input type=submit name="submit" value="Insert" class="button">
            </form> 
        </main>
    </body>
</html>