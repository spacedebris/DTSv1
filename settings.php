<?php
session_start();
if (!isset($_SESSION['key'])) {
header('Location: logout.php');
include_once 'dbconfig.php';
}?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
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
        <?php include_once("ui/logged_navtop.htm"); ?> <!--navtop-->
        <div class="container hero-unit">
            <h3>Zmiana hasła:</h3>
            <div class="panel-body">
                <?php if(!isset($_POST['changePassword'])){ ?>
                <form role="form" method="post" data-toggle="validator" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon glyphicon glyphicon-lock"></span>
                            <input type="password" name="oldpassword" id="oldpassword" class="form-control" placeholder="Stare hasło" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon glyphicon glyphicon-lock"></span>
                            <input type="password" name="newpassword" id="newpassword" class="form-control" placeholder="Nowe hasło" required="required">
                            <input type="password" data-match="#newpassword" data-match-error="Hasła nie są identyczne" name="confirmpassword" id="confirmpassword" class="form-control" placeholder="Potwierdź hasło" required="required">
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                    <button type="submit" name="changePassword" class="btn btn-default">Zmień hasło</button>
                </form>
                <?php
                } else {
                    require_once 'dbconfig.php';   
                    $dbfun->changePassword($_SESSION['key'], md5($_POST['oldpassword'])); 
                    
                }
                require_once 'dbconfig.php';  
                    if ($dbfun->isadmin($_SESSION['key']) == 1){ ?>
                        <h3>Użytkownicy:</h3>
                        <div class="contener">  
                        <div class="row">
                            <table class="table table-striped table-bordered table-hover" data-toggle="table" data-search="true" data-show-refresh="true">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Imię i Nazwisko</th>
                                        <th>Email</th>
                                        <th>Admin</th>
                                        <th>Akcja<th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php require_once 'dbconfig.php'; $dbfun->showTableUsers(); }?>
                                </tbody>
                            </table>
                            </div>
                        </div>

                <!-- Modals%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->
                    <!-- Delete User -->
                    <div id="delete_user" class="modal hide fade" tabindex="-1" role="dialog">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                                <h3>Usuń użytkownika</h3>
                        </div>
                        <div class="modal-body">
                            <form class="delete_user_form" name="delete_user_form">
                                <p>Na pewno chcesz usunąć użytkownika ?</p>
                                <form id="delete_user_id" method="post">
                                <input type="text" name="id" id="id" value=""/>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal">Anuluj</button>
                            <button class="btn btn-danger" type="submit" id="delete_user_btn">Usuń</button>
                        </div>
                    </div>
                    <!-- Edit User -->
                    <div id="edit_user" class="modal hide fade" style="display: none;">
                        <div class="modal-header">
                            <a class="close" data-dismiss="modal">×</a>
                            <h3>Edytuj użytkownika</h3>
                        </div>
                        <div class="modal-body">
                            <form>
                            <input type="text" name="id" id="id" value=""/> <!-- WYSZARZYC -->
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" name="e_firstname" class="form-control" placeholder="Imię">
                                        <input type="text" name="e_lastname" class="form-control" placeholder="Nazwisko">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" name="email" class="form-control" placeholder="Email">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal">Anuluj</button>
                            <button class="edit_user btn btn-xs btn-success" type="submit" id="edit_user_btn">Edytuj</button>
                            <!--<input class="btn btn-success" type="submit" value="Send!" id="submit">-->
                        </div>
                    </div>
                    <!--Add User -->
                    <div id="add_user" class="modal hide fade" style="display: none">
                        <div class="modal-header">
                            <a class="close" data-dismiss="modal">×</a>
                            <h3>Dodaj użytkownika</h3>
                        </div>
                        <div class="modal-body">
                            <form>
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
                                <button type="submit" name="addUser" class="btn btn-default">Dodaj</button> 
                            </form>
                        </div>
                    </div>

                
                
                <script type="text/javascript">

                    //@ DELETE USER
                    $(document).on("click", ".delete_user", function () {
                        var id = $(this).data('id');
                        $(".modal-body #id").val(id);
                        $("button#delete_user_btn").click(function(){

                        })
                    });

                    //@ EDIT USER:
                    $(document).on("click", ".edit_user", function(){
                        var id = $(this).data('id');
                        $(".modal-body #id").val(id);
                        $("input#edit_user_btn").click(function(){
                            $.ajax({
                                type: "POST",
                                url: "php/crud/edit_user.php", // 
                                data: $('form.contact').serialize(),
                                success: function(msg){
                                    $("#edit_user").modal('hide');   
                                     
                                },
                                error: function(){
                                    alert("failure");
                                }
                            });
                        });
                    });
                    //@ ADD USER
                    $(document.on("click", ".add_user", function(){

                    }))



                </script>
            </div>
            </div>
        </div>
        <!--footer-->
        <?php include("ui/footer.htm"); ?>
    </body>
</html>