<?php
ob_start();
session_start();

date_default_timezone_set('Europe/Warsaw');

define('DBHOST','localhost');
define('DBUSER','root');
define('DBPASS','root');
define('DBNAME','dtsv1');

define('DIR','http://localhost/dtsv1/');
define('SITEEMAIL','kozlowskimarekamil@gmail.com');

try {

	$db = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPASS);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
    exit;
}

include('class.dbfun.php');
$dbfun = new dbfun($db); 
?>
