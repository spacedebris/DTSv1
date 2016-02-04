<?php 
require('dbconfig.php');
if(!$dbfun->is_logged_in()){ header('Location: login.php'); } 
if(isset($_POST['btn-del']))
{
    $id = $_GET['delete_id'];
    $dbfun->deleteUser($id);
    header("Location: delete_user.php?deleted"); 
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
     if(isset($_GET['deleted']))
    {
        ?>
        <div class="alert alert-success">
        <strong>Tak!</strong> Użytkownik jest usunięty. <a href="users.php">Wróć</a> 
        </div>
        <?php
    }
    else
    {
        ?>
        <div class="alert alert-danger">
        <strong>Jesteś pewien</strong>, że chcesz usunąć? 
        </div>
        <?php
    }

     if(isset($_GET['delete_id']))
     {
         ?>
         <table class='table table-bordered'>
         <tr>
         <th>#</th>
         <th>Imię</th>
         <th>Nazwisko</th>
         <th>E - mail</th>
         </tr>
         <?php
         $stmt = $db->prepare("SELECT * FROM users WHERE id=:id");
         $stmt->execute(array(":id"=>$_GET['delete_id']));
         while($row=$stmt->fetch(PDO::FETCH_BOTH))
         {
             ?>
             <tr>
             <td><?php print($row['id']); ?></td>
             <td><?php print($row['firstname']); ?></td>
             <td><?php print($row['lastname']); ?></td>
             <td><?php print($row['email']); ?></td>
             </tr>
             <?php
         }
         ?>  
         <?php
     }
     ?>
<p>
<?php
if(isset($_GET['delete_id']))
{
    ?>
    </table>  
    <tr>
    <form method="post">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
    <button class="btn btn-primary" type="submit" name="btn-del"><i class="glyphicon glyphicon-trash"></i> &nbsp; Tak</button>
    <a href="users.php" class="btn btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Innym razem</a>
    </form>
    </tr>

    <?php
}
?>
</p>
</div>  
        <?php include("ui/footer.htm"); ?>
    </body>
</html>