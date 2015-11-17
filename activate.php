<?php
require('dbconfig.php');

$email = trim($_GET['x']);
$verification = trim($_GET['y']);

if(!empty($verification)){

	$stmt = $db->prepare("UPDATE users SET verification = 'Yes' WHERE email = :email AND verification = :verification");
	$stmt->execute(array(
		':email' => $email,
		':verification' => $verification
	));

	if($stmt->rowCount() == 1){

		header('Location: login.php?action=verificated');
		exit;

	} else {
		echo "Twoje konto nie jest aktywne."; 
	}
}
?>