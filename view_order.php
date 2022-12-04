<?php
    require_once '/home/hipt3660/config/mysql_config.php';
    date_default_timezone_set('America/Edmonton');
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    echo '<br><table> <tr> 
    <td> Order ID </td> 
    <td> Content </td> 
    <td> Status </td> 
    <td> Price </td> 
    <td> Order Time </td> 
    <td> Order Complete </td>
    <td> Assigned Employee </td>
    <td> Customer </td>
    </tr>';

    $sql = "SELECT * FROM ORDERS";
    $result = $conn->query($sql);
    print_r($result);
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $field1name = $row["orderID"];
            $field3name = $row["status"];
            $field4name = $row["price"];
            $field5name = $row["orderTime"];
            $field6name = ($row["isComplete"] == 0 ? 'No' : 'Yes');
            $field7name = $row["empID"];
            $field8name = $row["custID"];

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
