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
        .pagination{display:inline-block;padding-left:0;margin:20px 0;border-radius:4px}
        .pagination>li{display:inline}
        .pagination>li>a,
        .pagination>li>span{position:relative;float:left;padding:6px 12px;margin-left:-1px;line-height:1.42857143;color:#337ab7;text-decoration:none;background-color:#fff;border:1px solid #ddd}
        .pagination>li:first-child>a,.pagination>li:first-child>span{margin-left:0;border-top-left-radius:4px;border-bottom-left-radius:4px}
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
            <div class="btn-default" align="right">
                <a href="add_task.php" class="btn btn-info">Dodaj zadanie</a>
                <br/><br/>
            </div>
            <table class='table table-bordered table-responsive'>
                <tr>
                    <th>#</th>
                    <th>Nazwa</th>
                    <th>Treść</th>
                    <th>Tagi</th>
                    <th>Utworzono</th>
                    <th>Przez</th>
                    <th colspan="2" align="center">Akcja</th> 
                </tr>
                <?php
                    $query = "SELECT * FROM tasks";       
                    $records_per_page=10;
                    $newquery = $dbfun->paging($query,$records_per_page);
                    $dbfun->tasksview($newquery);
                ?>
                <tr>
                    <td colspan="7" align="center">
                        <div class="pagination-wrap">
                        <?php 
                            $dbfun->paginglink($query,$records_per_page); 
                        ?>
                        </div>
                    </td>
                    
                </tr>

            </table>
        </div>
        <?php include("ui/footer.htm"); ?>
    </body>
</html>