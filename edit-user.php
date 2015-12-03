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
        if($dbfun->isadmin($_SESSION['key']) == 1){
            include_once("ui/logged_navtop_admin.htm");
        }else {
            include_once("ui/logged_navtop.htm");    
        } 
        ?>
        <div class="container hero-unit">
        	<?php 
                if(isset($_GET['edit_id'])){
                    $id = $_GET['edit_id'];
                    extract($dbfun->getUserDetailsbyID($id));
                }
                
        		if(!isset($_POST['editUser'])){
        	?>  
                <table class="table table-bordered">
            		<form id="edituser-form" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            			<tr>
                            <td>Imię</td>
                            <td><input type="text" name="firstname" class="form-control" value="<?php echo $firstname; ?>"></td>
                        </tr>
                        <tr>
                            <td>Nazwisko</td>
                            <td><input type="text" name="lastname" class="form-control" value="<?php echo $lastname; ?>"></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><input type="text" name="email" class="form-control" value="<?php echo $email; ?>"></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <button type="submit" class="btn btn-primary" name="editUser">
                                    <span class="glyphicon glyphicon-edit"></span> Aktualizuj
                                </button>
                                <a href="settings.php" class="btn  btn-success"><i class="glyphicon glyphicon-backward"></i>Anuluj</a>
                            </td>
                        </tr>
    				</form>
                </table>
        	<?php 
        		}else{
        			$firstname = $_POST['firstname'];
        			$lastname = $_POST['lastname'];
        			$email = $_POST['email'];
                    $id = $dbfun->get_id($email);
        			if($dbfun->updateUser($id, $firstname, $lastname, $email)){
        				echo "<div class='alert alert-info'>
                                <strong>Rekord został uaktualniony / <a href='users.php'>Wróć</a></div>";
        			}
                    else{
                        echo "div class='alert alert-warning'><strong>ERROR</strong></div>";
                    }
        		} 
        	?>
        </div>
        <?php include("ui/footer.htm"); ?>
    </body>
</html>