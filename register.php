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

	if($em == $em2){
		//Check if the email have valid format
		if(filter_var($em, FILTER_VALIDATE_EMAIL)){
			$em = filter_var($em, FILTER_VALIDATE_EMAIL);

			//Check if email already exist
			$e_check = mysqli_query($con, "SELECT email FROM users WHERE email= '$em'");

			//Count the number of rows returned
			$num_rows = mysqli_num_rows($e_check);

			if($num_rows > 0){
				echo "Email already used";
			}

		}
		else{
			echo "Invalid format";
		}

	}
	else{
		echo "Emails don't match";
	}

	if(srtlen($fname) > 25 || strlen($fname) <2){

		echo "Your first name must be between 2 and 25 characters";
	}

	if(strlen($lname) > 25 || strlen($lname) <2){
		echo "Your first name must be between 2 and 25 characters";
	}

	if($password != $password2){
		echo "Your passwords do not match";
	}
	else{
		if(preg_match('/[^A-Za-z0-9]/', $password)){
			echo "Your password can only contain english characters or numbers";
		}
	}

	if(strlen($password > 30 || strlen($password) <5)){
		echo "Your password must be between 5 and 30 characters";
	}
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
		<input type= "text" name="reg_email2" placeholder="Confirm Email" required>
		<br>
		<input type= "text" name="reg_password" placeholder="Password" required>
		<br>
		<input type= "text" name="reg_password2" placeholder="Confirm Password" required>
		<br>
		<input type="submit" name="register_button" value = "Register">


	</form>


</body>
</html>