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
      //This is where I stopped, after this is her copy and pasted cody ahaha
      echo "Order ID: <input type=text name=\"orderID\" size=8> <br><br>";
      echo "Contents: <input type=text name=\"contents\" size=20> <br><br>";
      echo "Status: <input type=text name=\"contents\" size=20> <br><br>";
      echo "Employee ID: <select name=\"dname\">";
      echo "Customer ID: <select name=\"dname\">";

      
      while($val = $result->fetch_assoc())
      {
	 echo "<option value='$val[dname]'>$val[dname]</option>"; 
	 
      }
      echo "</select>"; 
      echo "<input type=submit name=\"submit\" value=\"Add Course\">"; 
   }
   else
   {
      echo "<H3>There are no departments in the system! </H3>"; 
   }
   
   echo "</form>";
} else {
   echo "<h3>You are not logged in!</h3><p> <a href=\"index.php\">Login First</a></p>"; 
   
}
?>