
<?php
require_once("pdocon.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Handle the form.

	if (!empty($_POST['unit']) && !empty($_POST['size']) && !empty($_POST['price']) && isset($_POST['building_id'])) { //$results['building_id']    
        
        try {
            $stmt = $db->prepare("INSERT INTO tbl_units( unit_name, size, price, building_id ) VALUES( :unit, :size, :price, :building_id )");
            
            $stmt->execute(array(
                ':unit' => $_POST['unit'],
                ':size' => $_POST['size'],
                ':price' => $_POST['price'],
                ':building_id' => $_POST['building_id']
            ));
            
            $insertId = $db->lastInsertId();
            //echo $insertId;
        }
        catch (PDOException $ex) {
            echo "An Error occured!"; //user friendly message
            
            print_r($ex->getMessage());
        }
        //the below code will only run if no error has been caught
        $affected_rows = $stmt->rowCount();
        if ($affected_rows >= 1) {
            //echo true;
            
            // header("Location: ../add_units.php?id=".$_POST['building_id']."&action=success");
            
            
        } else {
            //if the form fields were filled out but we lost internet connection
            // header("Location: ../add_units.php?id=".$_POST['building_id']."&action=fail");                    
        }
        
	}
	 
    if (file_exists($_FILES['image']['tmp_name'][0]) || is_uploaded_file($_FILES['image']['tmp_name'][0])) {
        echo 'you added an image file';
        
        
        for ($i = 0; $i < count($_FILES['image']['name']); $i++) {
            $image           = $_FILES['image']['name'][$i];
            $tmpname         = $_FILES['image']['tmp_name'][$i];
            $type_array      = $_FILES['image']['type'][$i];
            $img_size_array  = $_FILES['image']['size'][$i];
            $img_error_array = $_FILES['image']['error'][$i];
            
            
            //get the image extension
            $extension = explode(".", $_FILES["image"]["type"][$i]);
            $extension = explode("/", $extension[0]);
            $extension = "." . $extension[1];
            
            //get the file name without the extension                    
            $fileName = basename($image, $extension);
            
            //rename the image by adding a random number
            $image = $fileName . mt_rand() . $extension;
            
            
            if (!file_exists('../spaceplans/')) {
                mkdir('../spaceplans/', 0777, true);
            }
            
            
            $target = "../spaceplans/" . $image;
            if (move_uploaded_file($tmpname, $target)) {
                $stmt     = $db->prepare("INSERT INTO tbl_spaceplans(photos, unit_id) VALUES(:photos, :unit_id)");
                $stmt->execute(array(
                    ':photos' => $image,
                    ':unit_id' => $insertId
                ));
            }
        }              
    } else {
        // header("Location: ../add_units.php?id=".$_POST['building_id']."&action=emptyfields");
    }
       
}
?>