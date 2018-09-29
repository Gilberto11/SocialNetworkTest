<?php
session_start();
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
$error_array = array(); //Hold error messages

if(isset($_POST['register_button'])){

	//Registration Values

	//First Name
	$fname = strip_tags($_POST['reg_fname']); //Remove html tags
	$fname = str_replace(' ', '', $fname); //remove spaces
	$fname = ucfirst(strtolower($fname)); //Uppercase first letter
	$_SESSION['reg_fname'] = $fname; //Stores first name into session variable

	//Last Name
	$lname = strip_tags($_POST['reg_lname']); //Remove html tags
	$lname = str_replace(' ', '', $lname); //remove spaces
	$lname = ucfirst(strtolower($lname)); //Uppercase first letter
	$_SESSION['reg_lname'] = $lname; //Stores last name into session variable

	//Email
	$em = strip_tags($_POST['reg_email']); //Remove html tags
	$em = str_replace(' ', '', $em); //remove spaces
	$em = ucfirst(strtolower($em)); //Uppercase first letter
	$_SESSION['reg_email'] = $em; //Stores emai into session variable

	//Email2
	$em2 = strip_tags($_POST['reg_email2']); //Remove html tags
	$em2 = str_replace(' ', '', $em2); //remove spaces
	$em2 = ucfirst(strtolower($em2)); //Uppercase first letter
	$_SESSION['reg_email2'] = $em2; //Stores email2 into session variable

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
				array_push($error_array, "Email already in use <br>");
			}

		}
		else{
			array_push($error_array,"Invalid format<br>");
		}

	}
	else{
		array_push($error_array, "Emails don't match<br>");
	}

	if(strlen($fname) > 25 || strlen($fname) <2){

		array_push($error_array, "Your first name must be between 2 and 25 characters<br>");
	}

	if(strlen($lname) > 25 || strlen($lname) <2){
		array_push($error_array, "Your first name must be between 2 and 25 characters<br>");
	}

	if($password != $password2){
		array_push($error_array, "Your passwords do not match<br>");
	}
	else{
		if(preg_match('/[^A-Za-z0-9]/', $password)){
			array_push($error_array, "Your password can only contain english characters or numbers<br>");
		}
	}

	if(strlen($password > 30 || strlen($password) <5)){
		array_push($error_array, "Your password must be between 5 and 30 characters<br>");
	}

	if(empty($error_array)){
		$password = md5($password); //encrypt password in the db

		//generate a username by concatenating first name and last name
		$username = strtolower($fname . "_" . $lname);

		$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username= '$username'");
		$i = 0;
		//if username exists add number to user name

		while (mysqli_num_rows($check_username_query) != 0){
			$i++; //Add 1 to i
			$username = $username . "_" . $i;
			$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username= '$username'");
		}
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
		<input type= "text" name="reg_fname" placeholder="First Name" value= "<?php 
		if(isset($_SESSION['reg_fname'])){
			echo $_SESSION['reg_fname'];
			//keeps first name in the session 

		}
		?>" required>
		<br>
		<?php if(in_array("Your first name must be between 2 and 25 characters<br>", $error_array)) echo "Your first name must be between 2 and 25 characters<br>" ?>

		
		<input type= "text" name="reg_lname" placeholder="Last Name" value= "<?php 
		if(isset($_SESSION['reg_lname'])){
			echo $_SESSION['reg_lname'];

			//keeps second name in the session

		}
		?>" required>
		<br>
		<?php if(in_array("Your Last Name must be between 2 and 25 characters<br>", $error_array)) echo "Your Last Name must be between 2 and 25 characters<br>" ?>

		<input type= "text" name="reg_email" placeholder="Email" value= "<?php 
		if(isset($_SESSION['reg_email'])){
			echo $_SESSION['reg_email'];

		}
		?>" required>
		<br>
		<?php if(in_array("Your Last Name must be between 2 and 25 characters<br>", $error_array)) echo "Your Last Name must be between 2 and 25 characters<br>"; ?>

		<input type= "text" name="reg_email2" placeholder="Confirm Email" value= "<?php 
		if(isset($_SESSION['reg_email2'])){
			echo $_SESSION['reg_email2'];

		}
		?>" required>
		<br>
		<?php if(in_array("Email already in use <br>", $error_array)) echo "Email already in use <br>";
		else if(in_array("Invalid format<br>", $error_array)) echo "Invalid format<br>"; 
		else if(in_array("Emails don't match<br>", $error_array)) echo "Emails don't match<br>"; ?>
		<input type= "text" name="reg_password" placeholder="Password" required>
		<br>

		<input type= "text" name="reg_password2" placeholder="Confirm Password" required>
		<br>
		<?php if(in_array("Your passwords do not match<br>", $error_array)) echo "Your passwords do not match<br>"; 
		 else if(in_array("Your password can only contain english characters or numbers<br>", $error_array)) echo "Your password can only contain english characters or numbers<br>"; 
		 else if(in_array("Your password must be between 5 and 30 characters<br>", $error_array)) echo "Your password must be between 5 and 30 characters<br>"; ?>
		<input type="submit" name="register_button" value = "Register">


	</form>


</body>
</html>