<?php
session_start();
require_once("../../scripts/pdocon.php");
// echo 'reached here';



if (isset($_POST['submit']) && !empty($_POST['submit'])) { // Handle the form.
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $stmt = $db->prepare("SELECT user_id, email, is_confirmed, fname, lname ,user_level FROM tbl_users WHERE email=:email AND password=:password");
        $stmt->execute(array("email" => $_POST["email"], "password" => $_POST["password"]));
        if ($stmt->rowCount() >= 1) {
            //this means user with a matching password
            $_SESSION["email"] = $_POST['email'];
            $row = $stmt->fetch();
            $_SESSION["user_id"] = $row["user_id"];
            $_SESSION["fname"] = $row["fname"];
            $_SESSION["lname"] = $row["lname"];
            $_SESSION["user_level"] = $row["user_level"];

            // $host = $_SERVER['HTTP_HOST'];
            // $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            // $extra = 'admin/index.php';
            // echo $host;
            // echo '</br>';
            // echo $uri;
            // echo '</br>';
            // $exploded = explode("/", $uri);
            // print_r($exploded);
            // echo '</br>';
            // echo $exploded[1];
            header("Location: /../admin/index.php");

        } else {
            header("Location:https://listing-app.com/admin/login.php?error=1");
        }
    } else {
        header("Location:https://listing-app.com/admin/login.php?error=2");
    }
}