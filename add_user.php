<?php 
require('dbconfig.php');
if(!$dbfun->is_logged_in()){ header('Location: login.php'); } 
if(isset($_POST['btn-addUser'])){
    $firstname = $_POST['first_name'];
    $lastname = $_POST['last_name'];
    $email = $_POST['email_id'];
    $password = $_POST['repassword'];
    $isadmin = $_POST['isadmin'];

    $stmt= $db->prepare("SELECT email FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    if($stmt->rowCount() > 0)
    {
         $msg = "<div class='alert alert-info'>
                Użytkownik o podanym adresie już istnieje!
                </div>";
    }
    else
    {    
        if($dbfun->addUser($firstname, $lastname, $email, $password, $isadmin))
        {
            $msg = "<div class='alert alert-info'>
                    Użytkownik został dodany <strong><a href='users.php'>Wróć</a></strong>
                    </div>";
        }
        else
        {
            $msg = "<div class='alert alert-warning'>
                    <strong>SORRY!</strong> ERROR
                    </div>";
        }
    } 
    
}
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
        if($dbfun->isadmin($_SESSION['key']) == 1){
            include_once("ui/logged_navtop_admin.htm");
        }else {
            include_once("ui/logged_navtop.htm");    
        } 
        ?>

        <div class="container hero-unit">
        <?php 
        if(isset($msg))
        {
            echo $msg;
        }
        ?>
        <form id="edit_user-form" role="form" method="post"> 
            <table class='table table-bordered'>
                <tr>
                    <td>Imię</td>
                    <td><input type='text' name='first_name' class='form-control'></td>
                </tr>
                <tr>
                    <td>Nazwisko</td>
                    <td><input type='text' name='last_name' class='form-control'></td>
                </tr>
                <tr>
                    <td>E-mail ID</td>
                    <td><input type='text' name='email_id' class='form-control'></td>
                </tr>
                <tr>
                    <td>Hasło</td>
                    <td><input type='password' name='password' class='form-control'><td>
                </tr>
                <tr>
                    <td>Powtórz hasło</td>
                    <td><input type='password' name='repassword' class='form-control'><td>
                </tr>
                <tr>
                    <td>Isadmin</td>
                    <td><input type='text' name='isadmin' class='form-control' ></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit" class="btn btn-primary" name="btn-addUser">
                        <span class="glyphicon glyphicon-edit"></span>  Dodaj
                        </button>
                        <a href="users.php" class="btn btn-success"><i class="glyphicon glyphicon-backward"></i>Innym razem</a>
                    </td>
                </tr>
            </table>
            <div class="errorTxt"></div>
        </form>
        </div>
        <?php include("ui/footer.htm"); ?>
    </body>
</html>