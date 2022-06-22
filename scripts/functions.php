<?php
require_once 'pdocon.php';
//create a function to get all the images for building Id

// Fatal error: Uncaught PDOException: SQLSTATE[42S22]: Column not found: 1054 Unknown column '$id' in 'where clause' in C:\xampp\htdocs\listing-app\Industrial-listing-app\scripts\functions.php:6 Stack trace: #0 C:\xampp\htdocs\listing-app\Industrial-listing-app\scripts\functions.php(6): PDO->query('SELECT * FROM t...') #1 C:\xampp\htdocs\listing-app\Industrial-listing-app\admin\user_dash_add_building.php(170): getAllBuildingsByUserId('13') #2 {main} thrown in C:\xampp\htdocs\listing-app\Industrial-listing-app\scripts\functions.php on line 6
function getAllBuildingsByUserId($id)
{
    global $db;
    $stmt = $db->query('SELECT * FROM tbl_buildings WHERE user_id=' . $id);
    $row_count = $stmt->rowCount();
    // echo 'the row count is: '.$row_count;
    if($row_count>0){
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $results=0;
    }
    return $results;
}

function getAllBuildings()
{
    global $db;

    $stmt = $db->query('SELECT * FROM tbl_buildings');
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $results;
}

//get building images
function getImages($building_id)
{
    global $db;
    $stmt = $db->prepare('SELECT photos FROM tbl_photos WHERE building_id=:building_id');
    $stmt->execute(array(':building_id' => $building_id));
    $row_count = $stmt->rowCount();
    if ($row_count > 0) {

        //if there is a photo for this building display if not
        $photos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //echo 'the row count is greater than zero'.'</br>';
        //print_r($photos);
        //echo 'end print $photos'.'</br>';
        //now it is only returning the first row
        $picArray = $photos;
    } else {
        /*
        $picArray[] = array(array('photos' => '63720.svg'));
        $picArray[]= $photos['63720.svg'];
         */
        $picArray[] = array('photos' => '63720.svg');
    }
    return $picArray;
}

/* create a function that gets the featured image using the building id as an argument */
function getFeaturedImage($building_id)
{
    global $db;
    $stmt = $db->prepare("SELECT photos FROM tbl_photos WHERE isFeatured='on' AND building_id=:building_id");
    $stmt->execute(array(':building_id' => $building_id));
    $row_count = $stmt->rowCount();
    if ($row_count > 0) {
        $photos = $stmt->fetch(PDO::FETCH_ASSOC);
        $photos = $photos['photos'];
    } else {
        $photos = '63720.svg';
    }
    return $photos;
}

function getFeaturedImageUnit($unit_id)
{
    global $db;
    $stmt = $db->prepare("SELECT image_name FROM tbl_spaceplans WHERE isFeatured='on' AND unit_id=:unit_id");
    $stmt->execute(array(':unit_id' => $unit_id));
    $row_count = $stmt->rowCount();
    if ($row_count > 0) {
        $image_name = $stmt->fetch(PDO::FETCH_ASSOC);
        $image_name = $image_name['image_name'];
    } else {
        $image_name = 'floorplan.jpg';
    }
    return $image_name;
}

// function checkCookie(){
//     if(!isset($_COOKIE["PHPSESSID"]) || empty($_COOKIE["PHPSESSID"])){
//         return false;
//     } else {
//         return true;
//     }
// }

function checkSession(){
    if (basename($_SERVER['PHP_SELF']) !== 'login.php') {
        if (!isset($_SESSION["user_id"]) || empty($_SESSION["user_id"])) {
    
            // $host = $_SERVER['HTTP_HOST'];
            // $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            // $extra = 'login.php';
            // echo $host;
            // echo '</br>';
            // echo $uri;
            // echo '</br>';
            // $exploded = explode("/", $uri);
            // print_r($exploded);
            // echo '</br>';
            // echo $exploded[1];
            header("Location: login.php");
        }
    }
}

function checkUrlIs($url){
    if(basename($_SERVER['PHP_SELF']) === $url){
        return true;
    } 
    false;
}