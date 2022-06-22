<?php
require_once 'pdocon.php';

function CallJson($ajaxerror,$message,$mailError)
{
	$callback= json_encode(array('ajaxerror' => $ajaxerror, 'message' => $message, 'mail_error'=> $mailError));
    return $callback;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$mailError = null;
	$problem = false;
	$ajaxerror = false; //callback error

	$id = $_POST['contact_user_id'];
	$tenantName = $_POST['tenantname'];
	$tenantemail = $_POST['tenantemail'];
	if(!empty($_POST['tenantextension'])){
		$tenantextension=$_POST['tenantextension'];
	} else {
		$tenantextension='no telephone extension specified';
	}
	$tenantphone = $_POST['tenantphone'];
	$additionalinfo = $_POST['additionalinfo'];

    $stmt = $db->query('SELECT email, fname FROM tbl_users WHERE user_id=' . $id);
    $row_count = $stmt->rowCount();
    if($row_count>0){
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
		$problem = true;	
        $results=0;
    }
    $message[] = $results;
		
	// if (empty($_POST['bldname'])) {
	// 	$problem = true;
		
	// 	$ajaxerror = false; //callback error
	// 	$message[] = "<p class='text--error'>Please enter a building name!</p>";
	// }
	
	// if (empty($_POST['bldaddress'])) {
	// 	$problem = true;
		
	// 	$ajaxerror = false; //callback error
	// 	$message[] = "<p class='text--error'>Please enter a building adress!</p>";
	// }
	// if (empty($_POST['blddesc'])) {
	// 	$problem = true;
		
	// 	$ajaxerror = false; //callback error
	// 	$message[] = "<p class='text--error'>Please enter a building description!</p>";
	// }
	
		 
	if (!$problem) {	
		try {
			$to      = $results['email'];
			$subject = 'a potential tenant on listing-app requested you to be in touch';
			$message = $tenantName.' has requested more info <br/> message: '.$additionalinfo .'<br/>tenant email: '.$tenantemail.'<br/>tenant phone number: '.$tenantphone.'<br/>phone extension: '.$tenantextension;
			$headers = 'From: greatofficespaces@gmail.com' . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-type: text/html; charset=utf-8';
			if (mail($to, $subject, $message, $headers))
			$mailError=false;
			else
			$mailError=true;

		} 
		catch(PDOException $ex) {
		
			$message[] = "<p class='text--error'>Error! Something went wrong. Please try again<br> Database Error:". $ex->getMessage()."</p>";
		}
    }	

	print CallJson($ajaxerror,$message, $mailError);		
    }		
	
?>