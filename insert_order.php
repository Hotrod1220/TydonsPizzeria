<html>
<head><title>Tydon's Pizzeria</title></head>
<body>

<?php
if(isset($_COOKIE["username"])){
   
   echo "<form action=\"insertorder.php\" method=post>";
   
   $username = $_COOKIE["username"];
   $password = $_COOKIE["password"];	

   $conn = new mysqli("vconroy.cs.uleth.ca",$username,$password,$username);
   
	
   $sql1 = "select empID from EMPLOYEE"; 
   $sql2 = "select  custID from CUSTOMER"; 
   $result1 = $conn->query($sql1);
   $result2 = $conn->query($sql2);
   if($result1->num_rows != 0 && $result2->num_rows != 0)
   {
      echo "Order ID: <input type=text name=\"orderID\" size=8> <br><br>";
      echo "Contents: <input type=text name=\"contents\" size=40> <br><br>";
      echo "Status: <input type=text name=\"status\" size=1> <br><br>";
      echo "Price: <input type=text name=\"price\" size=5> <br><br>";
      echo "Order Time: <input type=text name=\"orderTime\" size=5> <br><br>";
      echo "Is it Complete: <input type=checkbox name=\"isComplete\" size=1> <br><br>";
      echo "Employee ID: <select name=\"empID\"><br><br>";
      echo "Customer ID: <select name=\"cusID\">";

      
      while($val = $result1->fetch_assoc() && $val2 = $result2->fetch_assoc())
      {
	   echo "<option value='$val[empID]'>$val[empID]</option>"; 
      echo "<option value='$val2[cusID]'>$val2[cusID]</option>"; 
      }
      echo "</select>"; 
      echo "<input type=submit name=\"submit\" value=\"Add Order\">"; 
   }
   else
   {
      echo "<H3>There are no customers or employees in the system! </H3>"; 
   }
   
   echo "</form>";
} else {
   echo "<h3>You are not logged in!</h3><p> <a href=\"index.php\">Login First</a></p>"; 
   
}
?>