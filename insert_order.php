<?php
    require_once '/home/hipt3660/config/mysql_config.php';
    session_start(); 
    $sql = "SELECT * FROM MENU";
    echo '<table border="0" cellspacing="2" cellpadding="2"> 
      <tr> 
          <td> <font face="Arial">Value1</font> </td> 
          <td> <font face="Arial">Value2</font> </td> 
          <td> <font face="Arial">Value3</font> </td> 
          <td> <font face="Arial">Value4</font> </td> 
          <td> <font face="Arial">Value5</font> </td> 
      </tr>';
    if($conn->query($sql)) {
        while($row = $conn->fetch_assoc()) {
            $field1name = $row["itemID"];
            $field2name = $row["itemName"];
            $field3name = $row["itemPrice"];
            $field4name = $row["isVegan"];
            $field5name = $row["stock"];
            echo '<tr> 
                      <td>'.$field1name.'</td> 
                      <td>'.$field2name.'</td> 
                      <td>'.$field3name.'</td> 
                      <td>'.$field4name.'</td> 
                      <td>'.$field5name.'</td> 
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