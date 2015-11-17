<?php
require('dbconfig.php');

$email = trim($_GET['x']);
$verification = trim($_GET['y']);

if(is_numeric($email) && !empty($verification)){

	$stmt = $db->prepare("UPDATE users SET verification = 'Yes' WHERE email = :email AND verification = :verification");
	$stmt->execute(array(
		':email' => $email,
		':verification' => $verification
	));

	if($stmt->rowCount() == 1){

		//redirect to login page
		header('Location: login.php?action=verification');
		exit;

	} else {
		echo "Your account could not be activated."; 
	}
	
}
?>