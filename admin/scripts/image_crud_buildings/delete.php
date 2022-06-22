<?php
//delete.php
include('../../../scripts/pdocon.php');
//include('database_connection.php');

if(isset($_POST["image_id"]))
{
 $file_path = '../../photos/' . $_POST["photos"];
 if(unlink($file_path))
 {
  $query = "DELETE FROM tbl_photos WHERE photo_id = '".$_POST["image_id"]."'";
  $statement = $db->prepare($query);
  $statement->execute();
 }
}

?>