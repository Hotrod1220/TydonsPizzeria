<?php
    require_once '/home/hipt3660/config/mysql_config.php';
    session_start(); 
    if (isset($_POST['add'])) {
        foreach ($_POST['add'] as $add) {
          $addQuery = "INSERT into ORDER (content) values ($add)";
          $conn->query($addQuery);
        }
      }
    echo '<table> <tr> 
    <td> ID </td> 
    <td> Name </td> 
    <td> Price </td> 
    <td> Vegan </td> 
    <td> Stock </td> 
    <td> Add to Order </td>
</tr>';
    $sql = "SELECT * FROM MENU";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $field1name = $row["itemID"];
            $field2name = $row["itemName"];
            $field3name = $row["itemPrice"];
            $field4name = $row["isVegan"];
            $field5name = $row["stock"];

            $vegan = ($field4name == 0 ? 'No' : 'Yes');

            echo '<tr> 
                      <td>'. $field1name.'</td> 
                      <td>'. $field2name.'</td> 
                      <td>'. $field3name.'</td> 
                      <td>'. $vegan. '</td> 
                      <td>'. $field5name.'</td> 
                      <td><input type="checkbox" name="add[]" value={$row["itemID"]}></td>
                  </tr> <br>';
        }
        echo "<h3>Order up!</h3>";
        echo '<td><input type="submit" value="Add selected to Order"></td></table>';
    }
    else {
        $err = $conn->errno; 
        echo "<p>MySQL error code $err </p>";
    }
    echo "<br> <br> <a href=\"index.php\">Return</a> to Home Page.";
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