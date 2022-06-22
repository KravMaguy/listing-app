<?php
session_start();
require_once("../../scripts/pdocon.php");

if (isset($_POST['submit']) && !empty($_POST['submit'])) { // Handle the form.
	//check if one or more form fiels are empty. If Empty redirect to signup page with error; otherwise continue
	if (!empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['email']) && !empty($_POST['companyname'])) {
		
		//check if user with the same email address is already registered. If registered return to signup page with error
		$stmt = $db->prepare("SELECT email FROM tbl_users WHERE email=:email");
		$stmt->execute(array("email"=>$_POST["email"]));
		//echo $stmt->rowCount();
		if ($stmt->rowCount()>=1) {
			header("Location: ../add_users.php?error=user_exists");
		}
		else {	

		
			$linkId= md5(uniqid($_POST["email"], true));

			$link="http://localhost/listings-master/admin/confirm_user.php?id=".$linkId;

			//when you insert the user details include the link ids
             $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
			 $password = substr( str_shuffle( $chars ), 0, 8 );
			 
			 $stmt = $db->prepare("INSERT INTO tbl_users (company_name, fname, lname, email, password, token) VALUES(:companyname, :fname, :lname, :email, :password, :token)");
			 //pointing the paramater to the value you want to push into the database
			 $stmt->execute(array("fname"=>$_POST["fname"], "lname"=>$_POST["lname"], "email"=>$_POST["email"], "password"=>$password, "companyname"=>$_POST["companyname"], "token"=>$linkId));


			//if record was inserted redirect user to add_building.php page (we can redirect to home page depending on our flow of the app)
			if ($stmt->rowCount()>=1) {
				
				
				///send the email
				$to       = $_POST['email'];
				$subject  = 'Welcome to industrial-listing-app!';
				$message  = 'Hi,'.$_POST["fname"].' '.$_POST["lname"].' your account has just been created!
				 follow the temporary link in order to set and confirm your password <a href="'.$link.'" target="_new">temp password reset</a>';
				$headers  = 'From: ouremail@domain.com' . "\r\n" .
							'MIME-Version: 1.0' . "\r\n" .
							'Content-type: text/html; charset=utf-8';
				if(mail($to, $subject, $message, $headers)){
					header("Location: ../add_users.php?success=1");
				}else{
					header("Location: ../add_users.php?error=1");
				}
			}
		}
	} else {
		header("Location: ../add_users.php?error=1");		
	}
}
?>