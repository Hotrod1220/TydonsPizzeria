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
            $field5name = date('Y-m-d H:i:s', $row["orderTime"]);
            $field6name = ($row["isComplete"] == 0 ? 'No' : 'Yes');
            $field7name = $conn->query("SELECT name from EMPLOYEE where empID = $row[empID]")->fetch_assoc()["name"];
            $field8name = $conn->query("SELECT name from CUSTOMER where custID = $row[custID]")->fetch_assoc()["name"];

            echo '<tr> 
                    <td>'. $field1name.'</td> 
                    <td>'. $field3name.'</td> 
                    <td>'. $field4name. '</td> 
                    <td>'. $field5name.'</td>
                    <td>'. $field6name.'</td> 
                    <td>'. $field7name.'</td>
                    <td>'. $field8name.'</td>
                </tr> <br>';
        }
        echo "<h3>Order up!</h3>";
        echo '</table>';
    }
    else {
        $err = $conn->errno; 
        echo "<p>MySQL error code $err </p>";
    }
    echo "<br> <br> <a href=\"index.php\">Return</a> to Home Page.";
    exit();
