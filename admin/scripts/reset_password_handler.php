

<?php
session_start();
require_once("../../../scripts/pdocon.php");

//check that he is trying to reset his own password and not someone elses
if(isset($_SESSION["email"])){
    if (isset($_POST['submit']) && !empty($_POST['submit'])) { // Handle the form.
        if (!empty($_POST['new_password'])) {
            // Make reset_password_handler only handle existing users who want to reset their password

            **this is already covered as two scripts are directing to this action. they are both found in the admin directory
            **i believe (not 100% that is using same header for both admin route and unrestricted route, check this), therefore in the header I will put a check  
            **for the session with key email

            // Check that their new_password is the same as new_password_confirm (in case they made a typo)
            // Set the password for the signed in user to new_password
            

                // Get the user's email from the $_SESSION, and use it to make the sql

            // For every page that requires sign-in, check and show an error message if they're not signed in
            **will just redirect

            // Question: does the header get shown on pages that don't require login (homepage, about, etc)
            ** i believe negative

            // Connect users to buildings
            // When a user tries to add/delete a building, check it's their own building
            
            // Make a column in the database that says if a user is an admin
            // Require that users be admins to access admin pages (incl their handlers)
            **this logic is incorrect

            //on login check that the user isConfirmed and if not 
            //

    }




} else {
    header("Location: Login.php");
}

?>