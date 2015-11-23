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
    <script src="js/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#changePassword-form').validate({
                rules: {
                    oldpassword: {required:true},
                    newpassword: {required:true, minlength: 5},
                    confirmpassword: {required:true, minlength: 5, equalTo: '#newpassword'}
                },
                messages: {
                    oldpassword: {required: 'Musisz podać dotychczasowe hasło'},
                    newpassword: {required: 'Musisz podać nowe hasło', minlength: 'Hasło musi zawierać min 5 znaków'},
                    confirmpassword: {required: 'Musisz powtórzyć nowe hasło', minlength: 'Hasło musi zawierać min 5 znaków', equalTo: 'Hasła nie są identyczne'}

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
                <form id="changePassword-form" role="form" method="post" data-toggle="validator" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon glyphicon glyphicon-lock"></span>
                            <input type="password" name="oldpassword" id="oldpassword" class="form-control" placeholder="Stare hasło">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon glyphicon glyphicon-lock"></span>
                            <input type="password" name="newpassword" id="newpassword" class="form-control" placeholder="Nowe hasło">
                            <input type="password" name="confirmpassword" id="confirmpassword" class="form-control" placeholder="Potwierdź hasło">
                        </div>
                    </div>
                    <button type="submit" name="changePassword" class="btn btn-default">Zmień hasło</button>
                    <br><br>
                    <div class="errorTxt"></div>
                </form>
                <?php
                } else {  
                    $dbfun->changePassword($_SESSION['key'], $_POST['oldpassword'], password_hash($_POST['confirmpassword'], PASSWORD_DEFAULT)); 
                }
                ?>


            </div>

        <?php include("ui/footer.htm"); ?>
    </body>
</html>