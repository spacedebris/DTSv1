<?php 
require('dbconfig.php');
if(!$dbfun->is_logged_in()){ header('Location: login.php'); } 
if(isset($_POST['btn-update'])){
    $id = $_GET['edit_id'];
    $name = $_POST['name'];
    
    
    if($dbfun->updateGroup($id,$name))
    {
        $msg = "<div class='alert alert-info'>
                Grupa została uaktualniona <strong><a href='groups.php'>Wróć</a></strong>
                </div>";
    }
    else
    {
        $msg = "<div class='alert alert-warning'>
                <strong>SORRY!</strong> ERROR
                </div>";
    }
}

if(isset($_GET['edit_id'])){
    $id = $_GET['edit_id'];
    extract($dbfun->getGroupDetailsbyID($id)); 
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
    <script src="js/jquery.validate.min.js"></script>
    <script>
    $(document).ready(function(){
        $('#edit_group-form').validate({
            rules: {
                name: {required: true}
            },
            messages: {
                name: {required: 'Musisz podać nazwę grupy'}
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
        <form id="edit_group-form" role="form" method='post'>
            <table class='table table-bordered'>
                <tr>
                    <td>Imię</td>
                    <td><input type='text' name='name' class='form-control' value="<?php echo $name; ?>"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit" class="btn btn-primary" name="btn-update">
                        <span class="glyphicon glyphicon-edit"></span>  Aktualizuj
                        </button>
                        <a href="groups.php" class="btn btn-success"><i class="glyphicon glyphicon-backward"></i>Innym razem</a>
                    </td>
                </tr>
            </table>
            <div class="errorTxt"></div>
        </form>
    </div>
        <?php include("ui/footer.htm"); ?>
    </body>
</html>