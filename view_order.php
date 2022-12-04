<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tydon\'s Pizzeria</title>
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
    require_once '/home/hipt3660/config/mysql_config.php';
    date_default_timezone_set('America/Edmonton');
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    echo '<br><table> <tr> 
    <td> Order ID </td> 
    <td> Status </td> 
    <td> Price </td> 
    <td> Order Time </td> 
    <td> Order Complete </td>
    <td> Assigned Employee </td>
    <td> Customer </td>
    </tr>';

    $sql = "SELECT * FROM ORDERS";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $field1name = $row["orderID"];
            switch ($row["status"]) {
                case 0:
                    $field3name = "Received";
                    break;
                case 1:
                    $field3name = "Preparing";
                    break;
                case 2:
                    $field3name = "Baking";
                    break;
                case 3:
                    $field3name = "Quality Check";
                    break;
                case 4:
                    $field3name = "Ready for Pickup";
                    break;
                default:
                    $field3name = "Invalid Order Status";
                    break;
            }
            $field4name = $row["price"];
            $field5name = date('Y-m-d H:i', $row["orderTime"]);
            $field6name = ($row["isComplete"] == 0 ? 'No' : 'Yes');
            $empResult = $conn->query("SELECT name from EMPLOYEE where empID = $row[empID]");
            if ($empResult && $empResult->num_rows > 0) {
                $field7name = $empResult->fetch_assoc()["name"];
            } else {
                $field7name = "Employee Not Found";
            }
            $custResult = $conn->query("SELECT name from CUSTOMER where custID = $row[custID]");
            if ($custResult && $custResult->num_rows > 0) {
                $field8name = $custResult->fetch_assoc()["name"];
            } else {
                $field8name = "Customer Not Found";
            }
            
            echo '<tr> 
                    <td>'. $field1name.'</td> 
                    <td>'. $field3name.'</td> 
                    <td>'. $field4name. '</td> 
                    <td>'. $field5name.'</td>
                    <td>'. $field6name.'</td> 
                    <td>'. $field7name.'</td>
                    <td>'. $field8name.'</td>
                </tr>';
        }
        echo "<h3>Order up!</h3>";
        echo '</table>';
    }
    else {
        $err = $conn->errno; 
        echo "<p>MySQL error code $err </p>";
    }
    echo "<br> <br> <a href=\"index.php\" class=\"button\">Return to Home</a>";
    exit();
?>
    </main>
</body>
</html>
