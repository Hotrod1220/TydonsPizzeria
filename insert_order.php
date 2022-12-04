
<!DOCTYPE html>
<html>
    <head>
        <title>Tydon's Pizzeria - Place an Order</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        
        <form action="" method=post>
        <?php
    require_once '/home/hipt3660/config/mysql_config.php';
    date_default_timezone_set('America/Edmonton');
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    $getEmp = "SELECT * FROM EMPLOYEE WHERE clockedIn = 1";
    $res = $conn->query($getEmp);
    while($clockedEmp = $res->fetch_assoc()) {
        $clockd = $clockedEmp['empID'];
    }
    $now = time();
    if (isset($_POST['add'])) {
        $price = 0;
        foreach ($_POST['add'] as $add => $quantity) {
            $priceQuery = "SELECT itemPrice FROM MENU WHERE itemID = '$add'";
            $priceRes = $conn->query($priceQuery);
            while($priceFetch = $priceRes->fetch_assoc()) {
                $price += $priceFetch['itemPrice'] * $quantity;
            }
        }
        $addQuery = "INSERT into ORDERS (status, price, orderTime, isComplete, empID, custID) values ('Received', $price, $now, 0, $clockd, $_POST[cust])";
        $conn->query($addQuery);
        $idQuery = "SELECT LAST_INSERT_ID() as `orderID`";
        $idResult = $conn->query($idQuery);
        if ($idResult->num_rows > 0) {
            $orderID = $idResult->fetch_assoc()["orderID"];
            foreach ($_POST['add'] as $add) {
                $containsQuery = "INSERT into CONTAINS values (1, $add, $orderID)";
                $conn->query($containsQuery);
            }
        }

      }
    echo '<table> <tr>
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
            $field2name = $row["itemName"];
            $field3name = $row["itemPrice"];
            $field4name = $row["isVegan"];
            $field5name = $row["stock"];

            $vegan = ($field4name == 0 ? 'No' : 'Yes');

            echo '<tr> 
                      <td>'. $field2name.'</td> 
                      <td>'. $field3name.'</td> 
                      <td>'. $vegan. '</td> 
                      <td>'. $field5name."</td> 
                      <td><input type='number' name='add[$row[itemID]]' min='0'></td>
                  </tr> <br>";
        }
        echo "<h3>Order up!</h3>";
        // this button does work!
        echo '<tr><td><input type="submit" value="Add selected to Order" action=""></td></tr></table>';
    }
    else {
        $err = $conn->errno; 
        echo "<p>MySQL error code $err </p>";
    }
    echo "<br> <br> <a href=\"index.php\">Return</a> to Home Page.";
?>
<h2>Select your name: </h2>
            <select name="cust">
                <?php
                    $sql = "SELECT * FROM CUSTOMER";
                    $result = $conn->query($sql);
                    if($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $custID = $row["custID"];
                            $field2 = $row["name"];
                            echo "<option value='$custID'>$field2</option>";
                        }
                    }
                    else {
                        $err = $conn->errno; 
                        echo "<p>MySQL error code $err </p>";
                    }
                ?>
        </form>
    </body>
</html>

    

         