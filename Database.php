<?php
$con=mysqli_connect('localhost', 'root','','my_pol');
   if(mysqli_connect_error($con))
	 {
		 echo "Failed to conect".mysqli_connect_error();
	 }
$db="create table voting
(
ANSWERS char(30),
IP INT(30),
PRIMARY KEY(IP)
)";
if(mysqli_query($con,$db))
	 {
	 //echo "Table  Created";
     }
else
     {
		 //echo "Error creating table " . mysqli_connect_error();
	 }
?>
