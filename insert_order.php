<?php
    require_once '/home/hipt3660/config/mysql_config.php';
    session_start(); 
    $sql = "SELECT * FROM MENU";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $field1name = $row["itemID"];
            $field2name = $row["itemName"];
            $field3name = $row["itemPrice"];
            $field4name = $row["isVegan"];
            $field5name = $row["stock"];
            echo '<tr> 
                      <td>'. $field1name.'</td> 
                      <td>'. $field2name.'</td> 
                      <td>'. $field3name.'</td> 
                      <td>'. $field4name.'</td> 
                      <td>'. $field5name.'</td> 
                  </tr>';
        }
        echo "<h3>Order up!</h3>";
    }
    else {
        $err = $conn->errno; 
        echo "<p>MySQL error code $err </p>";
    }
    echo "<a href=\"index.php\">Return</a> to Home Page.";
    exit();

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Tydon's Pizzeria - Place an Order</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <h2>OOGA</h2>  
    </body>
</html>