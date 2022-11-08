<?php

if(isset($_COOKIE["username"])) {
    $username = $_COOKIE["username"];
    $password = $_COOKIE["password"];

    $conn = new mysqli("vconroy.cs.uleth.ca",$username,$password,$username); 

    $sql = "insert into ORDER values ('$_POST[orderID]','$_POST[contents]', 
    '$_POST[status]', '$_POST[price]', '$_POST[orderTime]', '$_POST[isComplete]', 
    '$_POST[empID]', '$_POST[custID]')";
    if($conn->query($sql)) {
        //$sql = "insert into "
        //I dont know what to put here, in insertcourse.php,
        //i think she did this part because section is weak and depends on course
        //order isnt a weak entity so I dont know if we need this?
        $conn->query($sql);
        echo "<h3> Order submitted!</h3>";
    }
    else {
        $err = $conn->errno;
        if($err == 1062)
        {
            echo "<p>Order $_POST[orderID] already exists!</p>"; 
        }
        else {
            echo "error number $err"; 
        }
    }
}
else {
    echo "<h3>You are not logged in.</h3>
    <p><a href=\"index.php\">Login here</a></p>";
}



?>