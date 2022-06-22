<?php
//edit.php

//edit this file to get the image details using the photo_id
include('../../../scripts/pdocon.php');

$query = "
SELECT * FROM tbl_photos 
WHERE photo_id = '".$_POST["image_id"]."'
";
$statement = $db->prepare($query);
$statement->execute();
$result = $statement->fetchAll();

foreach($result as $row)
{

 $output['image_id'] = $row["photo_id"];
 $output['image_name'] = $row["photos"];
 $output['image_description'] = $row["image_description"];
 $output["isFeatured"] = $row["isFeatured"];
}

echo json_encode($output);

?>