<?php 
require('dbconfig.php');
if(!$dbfun->is_logged_in()){ header('Location: login.php'); } 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="pl">
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
        <?php 
            include_once("ui/logged_navtop.htm"); 
            $result = $dbfun->getUserDetails($_SESSION['key']);
        ?>
            <div class="container hero-unit">
                <h3><?php echo ($result['firstname'].' '.$result['lastname']); ?></h3>
                <hr>      
                <h6><?php echo $_SESSION['key'];?></h6>
                <button class="btn btn-default">Zmień email</button>
                <hr>
                <h4>Zmień hasło</h4>
                <?php if(!isset($_POST['changePassword'])){ ?>
                <form role="form" method="post" data-toggle="validator" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon glyphicon glyphicon-lock"></span>
                            <input type="password" name="oldpassword" id="oldpassword" class="form-control" placeholder="Stare hasło" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon glyphicon glyphicon-lock"></span>
                            <input type="password" name="newpassword" id="newpassword" class="form-control" placeholder="Nowe hasło" required="required">
                            <input type="password" data-match="#newpassword" data-match-error="Hasła nie są identyczne" name="confirmpassword" id="confirmpassword" class="form-control" placeholder="Potwierdź hasło" required="required">
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                    <button type="submit" name="changePassword" class="btn btn-default">Zmień hasło</button>
                </form>
                <?php
                } else {  
                    $dbfun->changePassword($_SESSION['key'], md5($_POST['oldpassword'])); 
                }
                ?>


            </div>

        <?php include("ui/footer.htm"); ?>
    </body>
</html>