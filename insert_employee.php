<?php
if (isset($_POST['name'])) {

    require_once '/home/hipt3660/config/mysql_config.php';
        
    $sql = "insert into EMPLOYEE (name, wage, position, clockedIn) values ('$_POST[name]','$_POST[wage]','$_POST[position]','$_POST[clockedIn]')";
    if($conn->query($sql)) {
        echo "<h3>Employee has been hired.</h3>";
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
        <main class="container wrapper">
            <h2 class="orange-text">Hire a New Employee</h2>
            <form action="" method=post>
            Name: <input type=text name="name" size=20><br><br>
            Wage: $<input type=text name="wage" size=6>/hr<br><br>
            Position: <input type=text name="position" size=15><br><br>
            On Shift?: <input type=checkbox name="clockedIn" value=1><br><br>
            <input type=submit name="submit" value="Insert" class="button">
        </form>   
        </main>
    </body>
</html>