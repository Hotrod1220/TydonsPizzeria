<?php
if (isset($_POST['name'])) {

    require_once '/home/hipt3660/config/mysql_config.php';
        
    $sql = "insert into CUSTOMER (name, address, email, phoneNum) values ('$_POST[name]','$_POST[address]','$_POST[email]','$_POST[phoneNum]')";
    if($conn->query($sql)) {
        echo "<h3>Customer has been added.</h3>";
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
        <meta charset="UTF-8">
        <title>Tydon's Pizzeria - Add a New Customer</title>
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
        <main class="container wrapper">
            <h2 class="orange-text">Add a New Customer</h2>
            <form action="" method=post>
                Name: <input type=text name="name" size=20><br><br>
                Address: <input type=text name="address" size=20><br><br>
                Email: <input type=text name="email" size=20><br><br>
                Phone Number: <input type=text name="phoneNum" size=20><br><br>
                <input type=submit name="submit" value="Insert" class="button">
            </form>  
        </main>
    </body>
</html>