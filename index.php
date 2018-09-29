
<?php 
$con = mysqli_connect("localhost", "root", "", "snake");
if(mysqli_connect_errno()){
	echo "Failed to connect: " .mysqli_connect_errno();
} 

$query = mysqli_query($con, "INSERT INTO accounts VALUES('1', 'Gilberto')");


 ?>
<html>
	<head>
	
	<title>Snake Network</title>
	
	</head>

	<body>
	
	TEST










	</body>
</html>