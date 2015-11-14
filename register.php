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
    <script src="js/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#registration-form').validate({
                rules: {
                    firstname: {required: true},
                    lastname: {required: true},
                    email: {required: true, email: true},
                    password1: {required: true, minlength: 5},
                    password2: {required: true, minlength: 5, equalTo: '#password1'}
                },
                messages: {
                    firstname: {required: 'Musisz podać imię'},
                    lastname: {required: 'Musisz podać nazwisko'},
                    email: {required: 'Musisz podać adres', email: 'Musisz podać poprawny adres'},
                    password1: {required: 'Musisz podać hasło', minlength: 'Hasło musi zawierać min 5 znaków'},
                    password2: {required: 'Musisz powtórzyć hasło', minlength: 'Hasło musi zawierać min 5 znaków', equalTo: 'Hasła muszą być identyczne'}
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
    <div class="container hero-unit" id='container' class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading" style="text-align:center"><h2>Rejestracja</h2></div>
                <div class="panel-body" style="text-align:left">
                    <?php if(!isset($_POST['registerUser'])){ ?>
                    <form id="registration-form" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" name="firstname" class="form-control" placeholder="Imię">
                                <input type="text" name="lastname" class="form-control" placeholder="Nazwisko">

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" name="email" class="form-control" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                              <input type="password" name="password1" id="password1" class="form-control" placeholder="Hasło">
                              <input type="password" name="password2" id="password2" class="form-control" placeholder="Powtórz hasło">
                            </div>
                        </div>
                        <button type="submit" name="registerUser" class="btn btn-default">Zarejestruj</button> <a href="login.php" class="btn btn-default"> Zaloguj </a>  <a href="forgotten_password.php" class="btn btn-default"> Zapomniałeś hasło ?</a>
                        <br><br>
                        <div class="errorTxt"></div>
                    </form>
                    <?php 
                    } else {
                        $dbfun->register($_POST['email']);
                        $dbfun = null;
                    }?>
                </div>
        </div>
    </div>
        <?php include_once("ui/footer.htm"); ?> <!--footer-->
    </body>
</html>