<?php 
require('dbconfig.php');
if(!$dbfun->is_logged_in()){ header('Location: login.php'); } 
if(isset($_POST['btn-update'])){
    $id_task = $_GET['edit_id'];
    $title = $_POST['title'];
    $editor_data = $_POST['editorl'];
    $tags = "temporary no tags";

    
    
    if($dbfun->updateTask($id_task, $title, $editor_data, $tags))
    {
        $msg = "<div class='alert alert-info'>
                Zadanie zostało uaktualnione <strong><a href='tasks.php'>Wróć</a></strong>
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
    $id_task = $_GET['edit_id'];
    extract($dbfun->getTaskDetailsbyID($id_task)); 
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Drawing Tasks System</title>
    <meta name="Marek Kozłowski">
    
    <script src="assets/ckeditor/ckeditor.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script>
    $(document).ready(function(){
        $('#edit_task-form').validate({
            rules: {
                title: {required: true},
                editor_data: {required: true}
            },
            messages: {
                tasks: {required: 'Musisz podać nazwę zadania'},
                editor_data: {required: 'Zadanie musi mieć treść'}
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
        <form id="edit_task-form" role="form" method='post'>
            <table class='table table-bordered'>
                <tr>
                    <td>Nazwa</td>
                    <td><input type='text' name='title' class='form-control' value="<?php echo $title; ?>"></td>
                </tr>
                <tr>
                    <td>Treść</td>
                    <td>
                        <textarea name='editorl' id='editorl' rows='10' cols='80' class='form-control' value="<?php echo $content; ?>">
                        </textarea>
                        <script>
                            CKEDITOR.replace('editorl');
                            CKEDITOR.instances['editorl'].setData($content);
                        </script>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit" class="btn btn-primary" name="btn-update">
                        <span class="glyphicon glyphicon-edit"></span>  Aktualizuj
                        </button>
                        <a href="tasks.php" class="btn btn-success"><i class="glyphicon glyphicon-backward"></i>Innym razem</a>
                    </td>
                </tr>
            </table>
            <div class="errorTxt"></div>
        </form>
    </div>
        <?php include("ui/footer.htm"); ?>
    </body>
</html>