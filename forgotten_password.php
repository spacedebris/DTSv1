<?php 
require('dbconfig.php');
if( $dbfun->is_logged_in() ){ header('Location: home.php'); } 
?>
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
        <?php include_once("ui/unlogged_navtop.htm"); ?> <!--navtop-->

        <div class="container hero-unit" id='container' class="col-md-4">
            <div class="panel panel-default">
              <div class="panel-heading" style="text-align:center"><h2>Odzyskiwanie hasła</h2></div>
                <div class="panel-body">
                    <?php if(!isset($_POST['forgottenUser'])){ ?>
                    <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-addon glyphicon glyphicon-envelope "></span>
                              <input type="text" name="email" class="form-control" placeholder="Podaj swój adres email" required="required">
                            </div>
                        </div>
                        <button type="submit" name="forgottenUser" class="btn btn-default">Nowe hasło</button> <a href="login.php" class="btn btn-default">Zaloguj</a>  <a href="register.php" class="btn btn-default">Zarejestruj</a>
                    </form>
                    <?php 
                    } else {                     
                        $dbfun->forgotten_password($_POST['email']);
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php include("ui/footer.htm"); ?><!--footer-->
    </body>
</html>