<?php
//this is where we check whetere the passwords are the same
//and no form then, now update the password field in the mysql with the confirmed password and also need to delete the value in conf_code
//and change is_confirmed to 1 

session_start();
require_once("../../scripts/pdocon.php");

if(isset($_POST["id"])){
            $id= $_POST['id'];
            $stmt = $db->prepare('UPDATE tbl_users SET password=:password, is_confirmed=1 WHERE token= :id');
            $stmt->execute(array(':id' => $id, ':password'=>$_POST["password"]));
            $count=$stmt->rowCount();
            if($count!='0'){
                $package=['status'=> true ,'password'=> $_POST["password"],'confirm_password'=>$_POST["password_confirm"]];
                echo json_encode($package);
            } else {
                $package=['status'=> false];
                echo json_encode($package);
            }

} else {
    header("Location: Login.php");

}

?>


<!-- 
if (isset($_POST['submit']) && !empty($_POST['submit'])) { // Handle the form.
        if (!empty($_POST['new_password'])) {
            // search id in database

            //$id= $_GET['id'];//building_id
			// $stmt = $db->prepare('SELECT building_id , name FROM tbl_buildings WHERE building_id= :building_id');
			// $stmt->execute(array(':building_id' => $id));


            $id= $_GET['id'];//user token from email in link	
            $stmt = $db->prepare('SELECT token , FROM tbl_users WHERE token= :token');
            $stmt->execute(array(':id' => $id));
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            $row_count = $stmt->rowCount();


            if ($row_count>=1){
                echo 'hi it is';
                // echo '<h5>Add units to '.$results['name']."</h5>";
                // echo '<input type="hidden" name="building_id" value="'.$results['building_id'].'">';
            } else {
                echo 'hi';
            }





            // Check that their new_password is the same as new_password_confirm (in case they made a typo)
            // Set the password for the user pulled from database with this id token to new_password
            // change is_confirmed to 1
    } else {
    header("Location: Login.php");
} -->