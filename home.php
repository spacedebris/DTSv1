<?php
session_start();
if (!isset($_SESSION['key'])) {
header('Location: logout.php');
}?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Drawing Tasks System</title>
    <meta name="Marek Kozłowski">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <style type="text/css">
        body { background: url(assets/bglight.png);}
        .hero-unit { background-color: #fff; }
        .center { display: block; margin: 0 auto; }
        .navbar-fixed-bottom {background-color: #f5f5f5; }
    </style>
</head>

    <body>
        <?php include_once("ui/logged_navtop.htm"); ?> <!--navtop-->

        <div class="container hero-unit">
            <h1>Witaj w systemie DTS.</h1>
        </div>
        
        <!--footer-->
        <?php include("ui/footer.htm"); ?>

    </body>
</html>