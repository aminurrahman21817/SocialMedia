<?php 
$fname = "" ;
$lname = "" ;
$email = "";
$email2 = "";
$password ="" ;
$password2 ="" ;
$date = "";
$error_array =array() ;


if (isset($_POST['reg_button'])) {
	//first name
	$fname = strip_tags($_POST['reg_fname']); //remove html tags
	$fname = str_replace(' ', '', $fname); //remove spaces
	$fname = ucfirst(strtolower($fname)); //Uppercase first letter
	$_SESSION['reg_fname'] = $fname; //stores first name into a session


	//last name
	$lname = strip_tags($_POST['reg_lname']); //remove html tags
	$lname = str_replace(' ', '', $lname); //remove spaces
	$lname = ucfirst(strtolower($lname)); //Uppercase first letter
	$_SESSION['reg_lname'] = $lname; //stores last name into a session

	//email
	$email = strip_tags($_POST['reg_email']); //remove html tags
	$email = str_replace(' ', '', $email); //remove spaces
	$email = ucfirst(strtolower($email)); //Uppercase first letter
	$_SESSION['reg_email'] = $email; //stores email into a session

	//email2
	$email2 = strip_tags($_POST['reg_email2']); //remove html tags
	$email2 = str_replace(' ', '', $email2); //remove spaces
	$email2 = ucfirst(strtolower($email2)); //Uppercase first letter
	$_SESSION['reg_email2'] = $email2; //stores email into a session



	//password
	$password = strip_tags($_POST['reg_password']); //remove html 
	$password2 = strip_tags($_POST['reg_password2']); //remove html 

	//date
	$date = date("Y-m-d"); //current date

	
	//Email validation
	if ($email==$email2) {
		
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$email = filter_var($email, FILTER_VALIDATE_EMAIL);

			//debugger Tools
			//var_dump($fname,$lname,$email,$email2,$password,$password2,$date);
			
			//check email if already exitst
			$queryMessage = "SELECT * FROM Users where email ='$email' ";

			$checkEmail = mysqli_query($con,$queryMessage);
			
			//count the number of rows
			$num_rows = mysqli_num_rows($checkEmail);
			
			if ($num_rows>0) {
				array_push($error_array, "This email is already exist<br>") ;
			}
			
		}else{
			array_push($error_array, "Invalid email format<br>");
		}
	}else{
		array_push($error_array, "Emails don't match<br>");
	}

	//name validation



	if (strlen($fname) > 25 || strlen($fname) < 2 ) {

		array_push($error_array, "your first name must be between 2 and 25 character<br>");
		
	}

	if (strlen($lname) > 25 || strlen($lname) < 2 ) {
		array_push($error_array, "your last name must be between 2 and 25 character<br>");
	}

	//password validation
	if ($password != $password2) {
		array_push($error_array, "your password don't match<br>");
		
	}else{
		if (preg_match('/[^A-Za-z0-9]/', $password)) {
			array_push($error_array, "your password only english character or numbers<br>");
			
		}
	}

	if (strlen($password) > 30 || strlen($password)< 5 ){
		array_push($error_array, "your password must be between 5 and 30 character<br>");
	
	}







if (empty($error_array)) {
	$password = sha1(md5($password)); // Encrypt password

	//Generate username
	$username = strtolower($fname . "_" . $lname);

	$queryMessage2 = "SELECT * FROM Users where username ='$username' ";
	$checkUsername = mysqli_query($con,$queryMessage2);
	$i = 0;
	while(mysqli_num_rows($checkUsername)>0){
		$i++ ;
		$username = $username ."_" . $i;
		$checkUsername = mysqli_query($con,$queryMessage2);
		
	}

	//profile pic assignment
	$rand = rand(1,2);//random number 1 and 2 

	if ($rand == 1) {
		$profile_pic = "assets/images/profilePics/default/pic1.png";
	}elseif ($rand == 2) {
		$profile_pic = "assets/images/profilePics/default/pic2.png";
	}
	
	$queryMessage3 = "INSERT INTO Users VALUES ('','$fname','$lname','$username','$email','$password','$date','$profile_pic','0','0','no',',') ";
	$queryMessage3 = mysqli_query($con,$queryMessage3);

	array_push($error_array, "<span style='color:green'>Registration Successfull !!! </span>");

	//clear session variable
	$_SESSION['reg_fname'] = "";
	$_SESSION['reg_lname'] = "";
	$_SESSION['reg_email'] = "";
	$_SESSION['reg_email2'] = "";
}



}


 ?>