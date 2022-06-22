<?php
session_start();
require_once("../../scripts/pdocon.php");

if (isset($_POST['submit']) && !empty($_POST['submit'])) { // Handle the form.
	//check if one or more form fiels are empty. If Empty redirect to signup page with error; otherwise continue
	if (!empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['email']) && !empty($_POST['companyname'])) {
		
		//check if user with the same email address is already registered. If registered return to signup page with error
		$stmt = $db->prepare("SELECT email FROM tbl_users WHERE email=:email");
		$stmt->execute(array("email"=>$_POST["email"]));
		echo $stmt->rowCount();
		if ($stmt->rowCount()>=1) {
			header("Location: ../add_users.php?error=user_exists");
		}
		else{		
            //if no more errors continue to process the form and add user to DB table tbl_users
            //generate a password
			//generate an alphanumic characters as confirmation codes send the code inside the link as a parameter, and then when the user goes to the link the application will use the conf code to check 
			//if the user is confirmed or not
			
			$linkId= md5(uniqid($_POST["email"], true));
			$link="https://greatofficespaces.net/industrial-listing-app/users/".$linkId;
			//when you insert the user details include the link ids
			
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $password = substr( str_shuffle( $chars ), 0, 8 );
			$stmt = $db->prepare("INSERT INTO tbl_users (companyname, fname, lname, email, password) VALUES(:companyname, :fname, :lname, :email, :password)");
			$stmt->execute(array("fname"=>$_POST["fname"], "lname"=>$_POST["lname"], "email"=>$_POST["email"], "password"=>$password ));
			
			//if record was inserted redirect user to add_building.php page (we can redirect to home page depending on our flow of the app)
			if ($stmt->rowCount()>=1) {
				
				//set the session and login the new user
				$_SESSION["email"] = $_POST['email'];
				
				///send the email
				$to       = $_POST['email'];
				$subject  = 'Welcome!';
				$message  = 'Hi, your account has just been created!';
				$headers  = 'From: ouremail@domain.com' . "\r\n" .
							'MIME-Version: 1.0' . "\r\n" .
							'Content-type: text/html; charset=utf-8';
				if(mail($to, $subject, $message, $headers))
					echo "Email sent";
				else
					echo "Email sending failed";
				
				
				header("Location: ../add_building.php?success=1");
			}
			else{
				header("Location: ../signup.php?error=1");
			}
		}
	}
	else{
		header("Location: ../signup.php?error=2");
	}
}
?>