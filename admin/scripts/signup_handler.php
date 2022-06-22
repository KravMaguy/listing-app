<?php
session_start();
require_once("pdocon.php");

if (isset($_POST['submit']) && !empty($_POST['submit'])) { // Handle the form.
	//check if one or more form fiels are empty. If Empty redirect to signup page with error; otherwise continue
	if (!empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])) {
		
		//if the password and confirm_password do not match redirect back to signup with error 
		if ($_POST['password'] != $_POST['confirm_password']) {			
			header("Location: ../signup.php?error=password_missmatch");
		}		
		
		//check if user with the same email address is already registered. If registered return to signup page with error
		$stmt = $db->prepare("SELECT email FROM tbl_users WHERE email=:email");
		$stmt->execute(array("email"=>$_POST["email"]));
		echo $stmt->rowCount();
		if ($stmt->rowCount()>=1) {
			header("Location: ../signup.php?error=user_exists");
		}
		else{		
			//if no more errors continue to process the form and add user to DB table tbl_users
			$stmt = $db->prepare("INSERT INTO tbl_users (fname, lname, email, password) VALUES(:fname, :lname, :email, :password)");
			$stmt->execute(array("fname"=>$_POST["fname"], "lname"=>$_POST["lname"], "email"=>$_POST["email"], "password"=>$_POST["password"] ));
			
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