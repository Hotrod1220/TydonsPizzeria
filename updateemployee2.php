<?php
require_once '/home/hipt3660/config/mysql_config.php';

$sql = "update EMPLOYEE set empID='$_POST[empID]',name='$_POST[name]',wage='$_POST[wage]', position='$_POST[position]', clockedIn='$_POST[clockedIn]' where empID='$_POST[oldempID]'"; 
if($conn->query($sql)) 
{ 
	echo "<h3> Employee information updated.</h3>";

} else {
   $err = $conn->errno(); 
   if($err == 1062)
   {
      echo "<p>Employee name $_POST[empID] already exists!</p>"; 
   } else {
      echo "error code $err";
   }
}
?>