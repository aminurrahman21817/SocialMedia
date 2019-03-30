<?php 
include 'DB/database.php';
include 'includes/form_handlers/register_handler.php';
include 'includes/form_handlers/login_handler.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome to socialMediaProject</title>
	<link rel="stylesheet" type="text/css" href="assets/css/register_style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/register.js"></script>
</head>
<body>

	<?php 

	if (isset($_POST['reg_button'])) {
		echo '<script>

		$(document).ready(function(){
  		$("#first").hide();
  		$("#second").show();
    
});







		</script>';
	}













	 ?>







	<div class="wrapper">

			<div class="wrapper-main">
				<div class="wrapper-header">
					<h1>Conntouch</h1>
					Login or sign up below
				</div>

					<div id="first">
						<form action="register.php" method="POST">
							<?php if (in_array("Email or password is incorrect<br>", $error_array)) {echo "Email or password is incorrect<br>";} ?>
							<input type="email" name="log_email" placeholder="Email address" value="<?php if (isset($_SESSION['log_email'])){echo $_SESSION['log_email'];}?>">
							<br>
							<input type="password" name="log_password" placeholder="Password">
							<br>
							<input type="submit" name="log_button" value="Login">
							<br>
							<a href="#" id="signup" class="signup">Need an account? Register here!</a>


						</form>
					
					</div>
			
					<div id="second">
						<form action="register.php" method="post">
						
							<input type="text" name="reg_fname" placeholder="First Name" value="<?php if (isset($_SESSION['reg_fname'])){echo $_SESSION['reg_fname'];}?>" required>
							<br>

							<?php if (in_array("your first name must be between 2 and 25 character<br>", $error_array)) {echo "your first name must be between 2 and 25 character<br>";} ?>
							
							<input type="text" name="reg_lname" placeholder="Last Name" value="<?php if (isset($_SESSION['reg_lname'])){echo $_SESSION['reg_lname'];}?>" required>
							<br>
								<?php if (in_array("your last name must be between 2 and 25 character<br>", $error_array)) {echo "your last name must be between 2 and 25 character<br>";} ?>

							<input type="email" name="reg_email" placeholder="Email" value="<?php if (isset($_SESSION['reg_email'])){echo $_SESSION['reg_email'];}?>" required>
							<br>
							<?php if (in_array("This email is already exist<br>", $error_array)) {echo "This email is already exist<br>";} ?>
							<?php if (in_array("Invalid email format<br>", $error_array)) {echo "Invalid email format<br>";} ?>
							<?php if (in_array( "Emails don't match<br>", $error_array)) {echo  "Emails don't match<br>";} ?>

							<input type="email" name="reg_email2" placeholder="Confirm your Email" value="
							<?php 
								if (isset($_SESSION['reg_email2'])){
								echo $_SESSION['reg_email2'];
							}?>

							" required>
							<br>
							
							<input type="password" name="reg_password" placeholder="password" required>
							<br>
							<?php if (in_array("your password don't match<br>", $error_array)) {echo "your password don't match<br>";} ?>
							<?php if (in_array("your password only english character or numbers<br>", $error_array)) {echo "your password only english character or numbers<br>";} ?>
							<?php if (in_array("your password must be between 5 and 30 character<br>", $error_array)) {echo "your password must be between 5 and 30 character<br>";} ?>
							<input type="password" name="reg_password2" placeholder="Confirm your password" required>
							<br>
							<input type="submit" name="reg_button" value="Register">
							<br>
							<?php if (in_array("<span style='color:green'>Registration Successfull !!! </span>", $error_array)) {echo "<span style='color:green'>Registration Successfull !!! </span>";} ?>
							<a href="#" id="signin" class="signin">Already have an account?Sign in here</a>

						</form>
						
					</div>
			
		</div>
</div>
</body>
</html>
