<?php
require_once("pdocon.php");
    if (isset($_POST['id']) && is_numeric($_POST['id'])){
        echo $_POST['id'];
        $affected_rows= 0;
        if(!empty($_POST['bldname']) && !empty($_POST['blddesc'])){
            try {
                echo $_POST['bldname'];
                echo $_POST['blddesc'];

                $stmt = $db->prepare("UPDATE tbl_buildings SET name=:name , short_description=:short_description WHERE building_id=:building_id ");
                $stmt->execute(array(':name' => $_POST['bldname'], ":short_description" => $_POST['blddesc'], ':building_id' => $_POST['id']));
                $insertId = $db->lastInsertId();
                $affected_rows = $stmt->rowCount();
            }
            catch (PDOException $ex){
                echo "An Error occured!"; //user friendly message

			    print_r($ex->getMessage());
            }

        }

        	//check if any records have been affected
	if ($affected_rows>=1){
        echo 'affected';					
		//redirect back and display a success message at top
		// header("Location: ../view_units.php?id=".$_POST['building_id']."&action=edit&success=1");			
	} else {
        // echo 'not affected';	
		//redirect back to the units page and display error at top. 
		// header("Location: ../view_units.php?id=".$_POST['building_id']."&action=edit&success=0");
	}	
}
?>