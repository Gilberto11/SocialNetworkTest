<?php

$con = mysqli_connect("localhost", "root", "", "snake");
if(mysqli_connect_errno()){
	echo "Failed to connect: " .mysqli_connect_errno();
} 

//Declaring Variables to prevent errors

$fname = ""; // First Name
$lname = ""; // Last Name
$em = ""; // Email
$em2 = ""; // Confirm Email
$password = ""; // Password
$password2 = ""; // Confirm Password
$date = ""; //Sign up Date
$error_array = ""; //Hold error messages

if(isset($_POST['register_button'])){

	//Registration Values

	//First Name
	$fname = strip_tags($_POST['reg_fname']); //Remove html tags
	$fname = str_replace(' ', '', $fname); //remove spaces
	$fname = ucfirst(strtolower($fname)); //Uppercase first letter

	//Last Name
	$lname = strip_tags($_POST['reg_lname']); //Remove html tags
	$lname = str_replace(' ', '', $lname); //remove spaces
	$lname = ucfirst(strtolower($lname)); //Uppercase first letter

	//Email
	$em = strip_tags($_POST['reg_email']); //Remove html tags
	$em = str_replace(' ', '', $em); //remove spaces
	$em = ucfirst(strtolower($em)); //Uppercase first letter

	//Email2
	$em2 = strip_tags($_POST['reg_email2']); //Remove html tags
	$em2 = str_replace(' ', '', $em2); //remove spaces
	$em2 = ucfirst(strtolower($em2)); //Uppercase first letter

	//Password
	$password = strip_tags($_POST['reg_password']); //Remove html tags
	$password2 = strip_tags($_POST['reg_password2']); //Remove html tags

	$date = date("Y-m-d");
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome to Snake Social Media</title>
</head>
<body>

	<form action = "register.php" method="POST">
		<input type= "text" name="reg_fname" placeholder="First Name" required>
		<br>
		<input type= "text" name="reg_lname" placeholder="Last Name" required>
		<br>
		<input type= "text" name="reg_email" placeholder="Email" required>
		<br>
		<input type= "text" name="reg_email2" placeholder="Confir Email" required>
		<br>
		<input type= "text" name="reg_password" placeholder="Password" required>
		<br>
		<input type= "text" name="reg_password2" placeholder="Confir Password" required>
		<br>
		<input type="submit" name="register_button" value = "Register">


	</form>


</body>
</html>