<?php 
require_once('scripts/pdocon.php');
?>

<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="assets/css/jquery-ui.css">
		<link rel="stylesheet" href="assets/css/style.css">
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/bootstrap-tour-standalone.min.css">

		<!-- <link rel="stylesheet" href="assets/css/bootstrap-tour.min.css"> -->

		<title>Sign up</title>

	</head>
  
	<body>
		<div class= "container">
			<div class="row h-100 justify-content-center align-items-center">
				<div class="col-md-5 col-sm-9 col-xs-9">
					<?
					if(isset( $_GET['error']) &&  $_GET['error']!=''){
						 if($_GET['error']==1){
							echo "<div class='alert alert-danger' > 
							An error has occured while trying to create your account. Please try again
							</div>";
						 }
						 if($_GET['error']==2){
							echo "<div class='alert alert-danger' > 
							Some fields are empty. Please try again!!!
							</div>";
						 }
						 if($_GET['error']=="password_missmatch"){
							echo "<div class='alert alert-danger' > 
							Password missmatch. Please try again!!!
							</div>";
						 }
						 if($_GET['error']=="user_exists"){
							echo "<div class='alert alert-danger' > 
							A user with that email address is already register!!!
							<br><br>
							Already have an account? <a href='login.php'>Click here to login</a>
							</div>";
						 }
					}				
					?>
					<h1 class='title'>Sign up</h1>
					<form action="scripts/signup_handler.php" method="post">
						<div class="form-group">
							<label for="fname">First Name:</label>
							<input type="text" class="form-control" id="fname" name="fname">
						</div>
						
						<div class="form-group">
							<label for="lname">Last Name:</label>
							<input type="text" class="form-control" id="lname" name="lname">
						</div>
						
						<div class="form-group">
							<label for="email">Email:</label>
							<input type="text" class="form-control" id="email" name="email">
						</div>
						
						<div class="form-group">
							<label for="password">Password:</label>
							<input type="password" class="form-control" id="password" name="password">
						</div>
						
						<div class="form-group">
							<label for="confirm_password">Confirm Password:</label>
							<input type="password" class="form-control" id="confirm_password" name="confirm_password">
						</div>
						
						<button type="submit" class="btn btn-primary" name="submit" value="signup" id="submit">Sign Up!</button>
					</form>
				</div><!--./col-md-5 col-sm-9 col-xs-9-->
			</div><!--./row h-100 justify-content-center align-items-center-->
		</div><!--./container-->
		
	
	<script src="assets/js/jquery.min.js"></script>

	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/bootstrap-tour-standalone.min.js"></script>
	
	<script>
	$( document ).ready(function() {
		var tour = new Tour({
			storage: false,
			steps: [
				{
					element: "#email",
					title: "Title of my step",
					content: "Content of my step"
				},
				{
					element: "#submit",
					title: "Title of my step",
					content: "Content of my step"
				}
			]
		});

		// Initialize the tour
		tour.init();

		// Start the tour
		tour.start();

	});

	</script>