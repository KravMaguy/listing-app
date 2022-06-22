<?php
include '../../../scripts/pdocon.php';

//print_r($_GET);

$stmt = $db->prepare('SELECT * FROM tbl_photos WHERE building_id=:x ORDER BY photo_id DESC');
$stmt->execute(array(':x' => $_GET['id']));

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
//print_r($results);
$number_of_rows = $stmt->rowCount();
$output = '';
$output .= '
 <table class="table table-bordered table-dark table-striped">
  <tr>
   <th>Sr. No</th>
   <th>Image</th>

   <th>Description</th>
   <th>Edit</th>
   <th>Delete</th>
  </tr>
';
if ($number_of_rows > 0) {

    $str = $results;
    //$picArray= explode(",",$str);
    $count = 0;
    //$row["column_name"]
    foreach ($results as $row)
    //foreach($picArray as $row=> $value)
    {
        $count++;
        $output .= '
  <tr>
   <td>' . $count . '</td>
   <td><img src="images/' . $row["photos"] . '" class="img-thumbnail" width="100" height="100" /></td>

   <td>' . $row["image_description"] . '</td>
   <td><button type="button" class="btn btn-warning btn-xs edit" id="' . $row["photo_id"] . '">Edit</button></td>
   <td><button type="button" class="btn btn-danger btn-xs delete" id="' . $row["photo_id"] . '" data-image_name="' . $row["photos"] . '">Delete</button></td>
  </tr>
  ';
    }
} else {
    $output .= '
  <tr>
   <td colspan="6" align="center">No Data Found</td>
  </tr>
 ';
}
$output .= '</table>';
echo $output;
