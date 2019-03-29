<?php 
if (isset($_POST['log_button'])) {
	$email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL); //sanitize email
	$_SESSION['log_email'] = $email ;
	$password = sha1(md5($_POST['log_password'])); // Encrypt password
	$_SESSION['log_password'] = $password ;
	
	//Debugging Tool
	//var_dump($email,$password);die();

	$query = "SELECT * FROM Users WHERE email='$email' AND password='$password'";
	$checkDatabaseQuery = mysqli_query($con,$query);
	$checkLoginQuery = mysqli_num_rows($checkDatabaseQuery);
	
	if ($checkLoginQuery == 1) {
		$row = mysqli_fetch_array($checkDatabaseQuery);
		$username = $row['username'];

		$user_closed = "SELECT * FROM Users WHERE email='$email' AND user_closed = 'yes'";
		$user_closed_query = mysqli_query($con,$user_closed);

		if (mysqli_num_rows($user_closed_query) == 1 ) {
			$reopne_account = "UPDATE Users SET user_closed='no' WHERE email='email'";
			$reopne_account_query = mysqli_query($con,$reopne_account);
			
		}
		$_SESSION['username'] = $username;
		header("Location: index.php");
		exit();

	}else{
		array_push($error_array, "Email or password is incorrect<br>");
	}
}

?>
