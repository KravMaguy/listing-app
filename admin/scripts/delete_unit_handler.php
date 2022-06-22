<?php
require_once('pdocon.php');

if (isset($_GET['id']) && is_numeric($_GET['id'])){
	$id= $_GET['id'];
	//delete unit
	
	echo 'there is a unit id of '.$id.' and a building id of ';
	
	$stmt = $db->prepare('SELECT building_id FROM tbl_units WHERE unit_id= :unit_id');
	$stmt->execute(array(':unit_id' => $id));
	$building = $stmt->fetch(PDO::FETCH_ASSOC);

	
	//if you used fetchALll above you would do the following:
	//$building[0]['building_id'];
	//since we only use fetch we do:
	$building= $building['building_id'];
	echo $building;
	
	$stmt = $db->prepare('DELETE FROM tbl_units  WHERE unit_id= :unit_id');
	$stmt->execute(array(':unit_id' => $id));
	$row_count = $stmt->rowCount();
	
	

	
	if ($row_count>=1){
	//redirect back and display a success message at top
			header("Location: ../view_units.php?id=".$building."&action=delete&success=1");			
	
	} else {
	//redirect back to the units page and display error at top. 
			header("Location: ../view_units.php?id=".$building."&action=delete&success=0");
	}
	
	
}

?>