<?php
require_once("../../scripts/pdocon.php");
if (isset($_POST['id']) && is_numeric($_POST['id'])) { // Handle the form.
	$affected_rows = 0;
	if (!empty($_POST['space']) && !empty($_POST['size']) && !empty($_POST['price'])) {
		try {
			$stmt = $db->prepare("UPDATE tbl_units SET unit_name=:unit , size=:size , price=:price WHERE unit_id=:unit_id ");
			$stmt->execute(array( ':unit' => $_POST['space'], ':size' => $_POST['size'], ':price' => $_POST['price'], ':unit_id' => $_POST['id']   ));
			$insertId = $db->lastInsertId();
			$affected_rows = $stmt->rowCount();
		}
		catch(PDOException $ex) {
			echo "An Error occured!"; //user friendly message

			print_r($ex->getMessage());
		}
	}
	
	//check if any records have been affected
	if ($affected_rows>=1){						
		//redirect back and display a success message at top
		header("Location: ../view_units.php?id=".$_POST['building_id']."&action=edit&success=1");			
	} else {
		//redirect back to the units page and display error at top. 
		header("Location: ../view_units.php?id=".$_POST['building_id']."&action=edit&success=0");
	}	
}
?>