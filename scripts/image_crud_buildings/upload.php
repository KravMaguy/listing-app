<?php
//upload.php
require_once('../pdocon.php');
if(count($_FILES["file"]["name"]) > 0)
{
 //$output = '';
 sleep(3);
 for($count=0; $count<count($_FILES["file"]["name"]); $count++)
 {
  $file_name = $_FILES["file"]["name"][$count];
  $tmp_name = $_FILES["file"]['tmp_name'][$count];
  $file_array = explode(".", $file_name);

  

  $file_extension = end($file_array);
  if(file_already_uploaded($file_name, $db))
  {
   $file_name = $file_array[0] . '-'. rand() . '.' . $file_extension;
  }

  $location = '../../images/' . $file_name;
  if(move_uploaded_file($tmp_name, $location))
  {
   $query = "
   INSERT INTO tbl_photos (photos, image_description, building_id) 
   VALUES ('".$file_name."', '','".$_POST["building_id"]."' )
   ";
   $statement = $db->prepare($query);
   $statement->execute();
  }
 }
}

function file_already_uploaded($file_name, $db)
{
 
 $query = "SELECT * FROM tbl_photos WHERE photos = '".$file_name."'";
 $statement = $db->prepare($query);
 $statement->execute();
 $number_of_rows = $statement->rowCount();
 if($number_of_rows > 0)
 {
  return true;
 }
 else
 {
  return false;
 }
}

?>
