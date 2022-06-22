<?php
require_once('pdocon.php');
$term = $_GET['term'];
$stmt = $db->query('SELECT * FROM tbl_buildings WHERE (name LIKE "%'.$term.'%") OR (address LIKE "%'.$term.'%")');
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);


$buildings = array();
foreach($results as $row) {
	 $data['id'] = $row['building_id'];
     $data['value'] = $row['name'];
	 array_push($buildings, $data);
}

// Return results as json encoded array
echo json_encode($buildings);

?>