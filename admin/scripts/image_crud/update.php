<?php
include('../../../scripts/pdocon.php');
print_r($_POST);

if(isset($_POST["image_id"]))
{
    $x='';

  if(array_key_exists('isFeatured', $_POST)){
    $x= $_POST['isFeatured'];
    $query = "
    UPDATE tbl_spaceplans
    SET isFeatured=''
    WHERE unit_id = '".$_POST["unit_id"]."'
    ";
  
    $statement = $db->prepare($query);
    $statement->execute();

    $query = "
    UPDATE tbl_spaceplans
    SET image_description = '".$_POST["image_description"]."' , isFeatured='".$x."'
    WHERE photo_id = '".$_POST["image_id"]."'
    ";
    $statement = $db->prepare($query);
    $statement->execute();

  } else {
    $query = "
    UPDATE tbl_spaceplans
    SET image_description = '".$_POST["image_description"]."' WHERE photo_id = '".$_POST["image_id"]."'
    ";
    $statement = $db->prepare($query);
    $statement->execute();
  }
} 
?>