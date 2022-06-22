<?
require_once("../../scripts/pdocon.php");


function CallJson($ajaxerror,$message)
{
	$callback= json_encode(array('ajaxerror' => $ajaxerror, 'message' => $message));
    return $callback;
}


//check that there are form values if the values are empty its an error so do an if else
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	$problem = false;
	
	//Check whethere building exists
	$stmt = $db->prepare('SELECT building_id FROM tbl_buildings WHERE lat= :lat AND lng= :lng');
	$stmt->execute(array(':lat' => $_POST['bldLat'], ':lng' => $_POST['bldLng']));
	$row_count = $stmt->rowCount();

	if ($row_count>=1){
		
		$problem = true;
		
		$ajaxerror = false; //callback error
		$message[] = "<p class='text--error'>You already entered this building into the database!</p>";
		
	} 
		
	if (empty($_POST['bldname'])) {
		$problem = true;
		
		$ajaxerror = false; //callback error
		$message[] = "<p class='text--error'>Please enter a building name!</p>";
	}
	
	if (empty($_POST['bldaddress'])) {
		$problem = true;
		
		$ajaxerror = false; //callback error
		$message[] = "<p class='text--error'>Please enter a building adress!</p>";
	}
	if (empty($_POST['blddesc'])) {
		$problem = true;
		
		$ajaxerror = false; //callback error
		$message[] = "<p class='text--error'>Please enter a building description!</p>";
	}
	
		 
	if (!$problem) {	
		try {
			$stmt = $db->prepare("INSERT INTO tbl_buildings(name, address, short_description, lat, lng, user_id) VALUES(:name, :address, :short_description, :lat, :lng, :user_id)");

			// 1/30/202 edit w chris
			$isExecuted=$stmt->execute(array(':name' => $_POST['bldname'], ':address' => $_POST['bldaddress'], ':short_description' => $_POST['blddesc'], ':lat' => $_POST['bldLat'], ':lng' => $_POST['bldLng'], 'user_id'=> $_POST['user_id'] ));
			
			//above is the same as
			// $stmt = $db->prepare("INSERT INTO tbl_buildings(name, address, short_description, latlong) VALUES(?, ?, ?, ?)");
			// $stmt->execute(array($_POST['bldname'],$_POST['bldaddress'], $_POST['blddesc'], $_POST['bldLatLng']));
			$insertId = $db->lastInsertId();
		} 
		catch(PDOException $ex) {
			echo "An Error occured!"; //user friendly message
			// some_logging_function($ex->getMessage());
			print_r($ex->getMessage());
			$message[] = "<p class='text--error'>Error! Something went wrong. Please try again<br> Database Error:". $ex->getMessage()."</p>";
		}
			//the below code will only run if no error has been caught
		$affected_rows = $stmt->rowCount();
		if($affected_rows >= 1){
			//echo true;
			 
			$ajaxerror = true; //callback success
			$message[] = "<p class='text--success'>Building added successfully! id:</p>".$insertId;
		} 
		else {
			//echo false;
			$ajaxerror = false; //callback error
			
		} 
		
		
		
		
		
		
		
		//process photos if any
	
		if (file_exists($_FILES['image']['tmp_name'][0]) || is_uploaded_file($_FILES['image']['tmp_name'][0])){
			//these are now arrays

		
			for ($i=0; $i<count($_FILES['image']['name']);$i++){
			  $image = $_FILES['image']['name'][$i];
			  $tmpname=$_FILES['image']['tmp_name'][$i];
			  $type_array=$_FILES['image']['type'][$i];
			  $img_size_array=$_FILES['image']['size'][$i];
			  $img_error_array=$_FILES['image']['error'][$i];
			  
			  
			 //get the image extension
			 $extension = explode(".", $_FILES["image"]["type"][$i]);
			 $extension = explode("/", $extension[0]);
			 $extension = ".".$extension[1];
					
			 //get the file name without the extension					
			 $fileName = basename($image, $extension); 
				
			 //rename the image by adding a random number
			 $image = $fileName.mt_rand().$extension;
			
			
			 $target = "../images/".$image;
			 if (move_uploaded_file($tmpname, $target)) {
			 //push the filenames into the array, 
			 $photoArray[] = $image;					
			 }			
		}
		
		//convert the photo array into a comma seperated list
		// then insert the comma seperated list into tbl_photo under photos and also insert the building id that you have already
		
		$photoArray= implode(",",$photoArray);
		//insert the photos into the DB. Remeber to change the default vvalue of space_plan to NULL inn the tbl_photos table
		$stmt = $db->prepare("INSERT INTO tbl_photos(photos, building_id, image_description) VALUES(:photos, :building_id, 'this is a description')");
		$stmt->execute(array(':photos' => $photoArray, ':building_id' => $insertId));
		
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

	
	
	
	
	if(count($_FILES["image"]["name"]) > 0)
{
 //$output = '';
 sleep(3);
 for($count=0; $count<count($_FILES["image"]["name"]); $count++)
 {
  $file_name = $_FILES["image"]["name"][$count];
  $tmp_name = $_FILES["image"]['tmp_name'][$count];
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
   VALUES ('".$file_name."', '','".$insertId."' )
   ";
   $statement = $db->prepare($query);
   $statement->execute();
  }
 }
}
	
	
	
	
	
	
	
	
	
	
	
	
	
	else{
		$message[]= "no images";
	}
	print CallJson($ajaxerror,$message);		
    }	
	else{
		print CallJson($ajaxerror,$message);
	}
}	
	
?>