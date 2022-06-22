<?
require_once("../../scripts/pdocon.php");
if(isset($_POST["user_id"]))
 {
 $idFromForm=$_POST["user_id"];
  $query = "DELETE FROM tbl_users WHERE user_id = '.$idFromForm.'";
  $statement = $db->prepare($query);
  $statement->execute();
  $arr= array('ajaxStatus'=>'statement excecuted @ delete_user_and_all_buildings', 'ajaxError'=> false, 'sqlError'=> $statement->errorInfo());
  echo json_encode($arr);
 }



//  $ar = array('apple', 'orange', 'banana', 'strawberry');
// echo json_encode($ar); // ["apple","orange","banana","strawberry"]

?>