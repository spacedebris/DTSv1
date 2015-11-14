<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Drawing Tasks System</title>
    <meta name="Marek Kozłowski">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script type="text/javascript">
        $function(){
            $("btn-show-modal").click(function(e){
                e.preventDefault();
                $("$#dialog-example").modal.Show();
            });
        }
    </script>
    <style type="text/css">
        body { background: url(assets/bglight.png);}
        .hero-unit { background-color: #fff; }
        .center { display: block; margin: 0 auto; }
        .navbar-fixed-bottom {background-color: #f5f5f5; }
    </style>
</head>

    <body>
        <!--navbottom UNLOGGED-->
        
        <!--/navbottom-->

        <div class="container hero-unit">
            <h1>Witaj w systemie DTS.</h1>
            <h2>nothing comes for free. knowledge, money, love or anything else. so if you want to become better you need to invest time and interest</h2>
        </div>

        <div class="navbar navbar-default navbar-fixed-bottom">
            <div class="container">
                <p>Site built by Marek Kozłowski 2015</p>
                <p><a href="#" id="btn-show-modal">Show</a></p>
                <div class="modal hide" id="dialog-example">
                    <div class="modal-header">
                        <h1>My modal Dialog</h1>
                    </div>

                    <div class="modal-body">
                        <p>body</p>
                    </div>

                    <div class="modal-footer">
                        <a href="#" class="btn">Close</a>
                        <a href="#" class="btn brn-primary">Save</a>
                    </div>
                </div>
            </div>
        </div>
        <!--footer-->
        
    </body>
</html>