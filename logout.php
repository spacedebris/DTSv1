<?php require('dbconfig.php');

$dbfun->logout(); 

header('Location: index.php');
exit;
?>