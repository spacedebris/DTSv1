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
    <script src="js/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#forgotten_user-form').validate({
                rules: {
                    email: {required: true, email: true}
                },
                messages: {
                    email: { required: 'Musisz podać adres email', email: 'Musisz podać poprawny adres email' }
                },
                errorElement: 'div',
                errorLabelContainer: '.errorTxt'
            });
        });
    </script>
    <style type="text/css">
        body { background: url(assets/bglight.png);}
        .hero-unit { background-color: #fff; }
        .center { display: block; margin: 0 auto; }
        .navbar-fixed-bottom {background-color: #f5f5f5; }
    </style>
</head>

    <body>
        <?php include_once("ui/unlogged_navtop.htm"); ?> <!--navtop-->

        <div class="container hero-unit">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
                    <h2>Odzyskiwanie hasła</h2>
                    <hr>
                    <?php if(!isset($_POST['forgottenUser'])){ ?>
                    <form id="forgotten_user-form" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                        <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-addon glyphicon glyphicon-envelope "></span>
                              <input type="text" name="email" class="form-control" placeholder="Podaj swój adres email">
                            </div>
                        </div>
                        <button type="submit" name="forgottenUser" class="btn btn-default">Nowe hasło</button> <a href="login.php" class="btn btn-default">Zaloguj</a>  <a href="register.php" class="btn btn-default">Zarejestruj</a>
                        <br><br>
                        <div class="errorTxt"></div>
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