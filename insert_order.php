<?php
    require_once '/home/hipt3660/config/mysql_config.php';
    $getEmp = "SELECT * FROM EMPLOYEE WHERE clockedIn = 1";
    $res = $conn->query($getEmp);
    while($clockedEmp = $res->fetch_assoc()) {
        $clockd = $clockedEmp['empID'];
    }
    session_start(); 
    if (isset($_POST['add'])) {
        foreach ($_POST['add'] as $add) {
          $addQuery = "INSERT into ORDER (content, status, price, orderTime, isComplete, empID, custID) values ($add, received, $field3name, now(), 0, $clockd, $custID)";
          $conn->query($addQuery);
        }
      }
    ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Tydon's Pizzeria - Place an Order</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <h2>OOGA</h2>
        <form action="view_order.php" method=post>
            <select name="custName">
                <?php
                    $sql = "SELECT * FROM CUSTOMER";
                    $result = $conn->query($sql);
                    if($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $custID = $row["custID"];
                            $field2name = $row["name"];
                            echo "<option value='$custID'>$field2name</option>";
                        }
                    }
                    else {
                        $err = $conn->errno; 
                        echo "<p>MySQL error code $err </p>";
                    }
                ?>
            Name: <input type=text name="itemName" size=20><br><br>
            Item Price: $<input type=text name="itemPrice" size=6><br><br>
            Is it Vegan?: <input type=checkbox name="isVegan" value=1><br><br>
            Stock: <input type=text name="stock" size=15><br><br>
            <input type=submit name="submit" value="Insert">
        </form>    
    </body>
</html>

<?php
    echo '<table> <tr> 
    <td> Item ID </td> 
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
                      <td>'. $field5name."</td> 
                      <td><input type='checkbox' name='add[]' value={$row['itemName']}></td>
                  </tr> <br>";
        }
        echo "<h3>Order up!</h3>";
        echo '<tr><td><input type="submit" value="Add selected to Order" action="view_order.php"></td></tr></table>';
    }
    else {
        $err = $conn->errno; 
        echo "<p>MySQL error code $err </p>";
    }
    echo "<br> <br> <a href=\"index.php\">Return</a> to Home Page.";
    exit();

?>
