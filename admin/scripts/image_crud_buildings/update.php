<?php
//this is an update functionality
//update.php

include('../../../scripts/pdocon.php');


/* check if isFeatured exists if it does upddate the value in the database if it does not then set it to null*/
/*print($_POST["image_id"]);*/
print_r($_POST);
/*
if(isset($_POST["isFeatured"]) && isset($_POST["image_id"]))
{
  $query = "
  UPDATE tbl_photos
  SET image_description = '".$_POST["image_description"]."' , isFeatured='".$_POST["isFeatured"]."'
  WHERE photo_id = '".$_POST["image_id"]."'
  ";
 
 $statement = $db->prepare($query);
 $statement->execute();

} elseif(isset($_POST["image_id"])){
  $query = "
   UPDATE tbl_photos
   SET isFeatured=''
   WHERE building_id = '".$_POST["building_id"]."'
   ";

 $statement = $db->prepare($query);
 $statement->execute();


$query = "
  UPDATE tbl_photos
  SET image_description = '".$_POST["image_description"]."'
  WHERE photo_id = '".$_POST["image_id"]."'
  ";
 
 $statement = $db->prepare($query);
 $statement->execute();


}*/

if(isset($_POST["image_id"]))
{
  /* update the row in tbl_photos set isfeatured to null where building id is the id you got from the link,
  this means that all of the photos have THAT building id it can be more than one photo everything that is displayed in the 
  table isFeatured set to null
  */
  


  /* Update the row in tbl_photos set isfeatured to the value in the form field 'on' iof switched on and empty if
  not switched.  and the update the database image description that was edited in the form field. only where photo_id is the 
  photo NOT related to building id, only from $_POST["image_id"]
  the if statement comes after first sql query */
    $x='';
  
  // if(isset($_POST['isFeatured'])){
  //   $x= $_POST['isFeatured'];   
  // }
  //the above does not work use does key exist php function
  // $search_array = array('first' => null, 'second' => 4);

  // // returns false
  // isset($search_array['first']);

  // // returns true
  // array_key_exists('first', $search_array);

  if(array_key_exists('isFeatured', $_POST)){
    $x= $_POST['isFeatured'];
    $query = "
    UPDATE tbl_photos
    SET isFeatured=''
    WHERE building_id = '".$_POST["building_id"]."'
    ";
  
    $statement = $db->prepare($query);
    $statement->execute();

    $query = "
    UPDATE tbl_photos
    SET image_description = '".$_POST["image_description"]."' , isFeatured='".$x."'
    WHERE photo_id = '".$_POST["image_id"]."'
    ";
    $statement = $db->prepare($query);
    $statement->execute();

  } else {
    $query = "
    UPDATE tbl_photos
    SET image_description = '".$_POST["image_description"]."' WHERE photo_id = '".$_POST["image_id"]."'
    ";
    $statement = $db->prepare($query);
    $statement->execute();
  }
} 
?>