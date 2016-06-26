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
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#login-form').validate({
                rules: {
                    email: {required: true, email: true},
                    password: {required: true}
                },
                messages: {
                    email: { required: 'Musisz podać adres email', email: 'Musisz podać poprawny adres email' },
                    password: {required: 'Musisz podać hasło'}
                },
                errorElement: 'div',
                errorLabelContainer: '.errorTxt'
            });
        });
    </script>
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
        <div class="container hero-unit">
            <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
                <h2>Zaloguj się</h2>
                <hr>
                <?php
                if(isset($_GET['action'])){
                    switch ($_GET['action']) {
                        case 'verificated':            
                            echo "<div class='alert alert-success' role='alert' style='text-align:center'><strong>Konto jest już aktywne, możesz się zalogować.</strong><br/></div>";
                            break;
                        case 'sthgoesbad':
                            echo "<div class='alert alert-success' role='alert' style='text-align:center'><strong>Coś poszło nie tak.</strong><br/></div>";
                            break;
                    }
                } 
                if(!isset($_POST['loginUser'])){
                ?>
                <form id="login-form" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" name="email" class="form-control focusedInput" placeholder="Email"> 
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Hasło">
                        </div>
                    </div>
                    <button type="submit" name="loginUser" class="btn btn-default">Zaloguj</button> <a href="index.php" class="btn btn-default"> Zarejestruj się </a>   <a href="forgotten_password.php" class="btn btn-default"> Odzyskaj hasło </a>
                    <br><br>
                    <div class="errorTxt"></div>
                </form>
                <?php 
                } 
                else 
                {
                    $dbfun->login($_POST['email'], $_POST['password']);
                    $dbfun = null;
                }
                ?>
            </div>
        </div>
        <?php include("ui/footer.htm"); ?><!--footer-->
    </body>
</html>