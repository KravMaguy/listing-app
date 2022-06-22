
//this is where we check whetere the passwords are the same
//and no form then, now update the password field in the mysql with the confirmed password and also need to delete the value in conf_code
//and change isconfirmed to 1 

<?php
session_start();
require_once("../../../scripts/pdocon.php");

//check that he is trying to reset his own password and not someone elses
if(isset($_POST["email"])){

    if (isset($_POST['submit']) && !empty($_POST['submit'])) { // Handle the form.
        if (!empty($_POST['new_password'])) {
            // Make reset_password_handler only handle existing users who want to reset their password
    	
            // Check that their new_password is the same as new_password_confirm (in case they made a typo)
            // Set the password for the signed in user to new_password
                // Get the user's email from the $_SESSION, and use it to make the sql

            // For every page that requires sign-in, check and show an error message if they're not signed in
            // Question: does the header get shown on pages that don't require login (homepage, about, etc)

            // Connect users to buildings
            // When a user tries to add/delete a building, check it's their own building
            
            // Make a column in the database that says if a user is an admin
            // Require that users be admins to access admin pages (incl their handlers)
    }
    
    
    
    
    
   




} else {
    header("Location: Login.php");
}

?>