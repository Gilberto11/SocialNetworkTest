<?php

if(isset($_POST['login_button'])){
	
	$email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL); //sanitize email

	$_SESSION['log_email'] = $email; // Store email into session variable
	$password = md5($_POST['log_password']); //compare md5 and get password

	$check_database_query = msqli_query($con, "SELECT * FROM users WHERE email = '$email' AND password = '$password'");
	$check_login_query = msqli_num_rows($check_database_query);

	if($check_login_query == 1){
		$row = msqli_fetch_array($check_database_query); //fetch the results of the query above and store in the array
		$username = $row['username'];

		$_SESSION['username'] = $username;
		header("Location: index.php");
		exit();
	}
}


?>