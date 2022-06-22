<?
session_start();
//end the session
unset($_SESSION["email"]);
unset($_SESSION["user_id"]);
session_destroy();

// setcookie('PHPSESSID', '', time() + (86400 * -30), "/"); // 86400 = 1 day

header("Location: ../login.php");
