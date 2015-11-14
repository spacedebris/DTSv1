<?php
	function draw_menu_index(){
		echo '
			<div class="navbar navbar-fixed-top navbar-inverse">
			  <div class="navbar-inner">
			    <div class="container">
			      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </a>
			      <a class="brand">Drawing Tasks System</a>
			      <div class="nav-collapse collapse">
			        <ul class="nav pull-right">
			          <li><a href="register.php">Zarejestruj się</a></li>
			          <li class="divider-vertical"></li>
			          <li class="dropdown">
			            <a class="dropdown-toggle" href="#" data-toggle="dropdown">Zaloguj <strong class="caret"></strong></a>
			            <div class="dropdown-menu" style="padding: 15px; padding-bottom: 0px;">
			                <form action="index.php" method="post"> 
			                    Nazwa użytkownika:<br /> 
			                    <input type="text" name="username" value="" /> 
			                    <br /><br /> 
			                    Hasło:<br /> 
			                    <input type="password" name="password" value="" /> 
			                    <br /><br /> 
			                    <input type="submit" class="btn btn-info" value="Zaloguj się" /> 
			                </form> 
			            </div>
			          </li>
			        </ul>
			      </div>
			    </div>
			  </div>
			</div> ';
	}
###############################################################################
	function draw_menu_logged(){
		echo '
			<div class="navbar navbar-fixed-top navbar-inverse">
			  <div class="navbar-inner">
			    <div class="container">
			      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </a>
			      <a class="brand">Drawing Tasks System</a>
			      <div class="nav-collapse">
			        <ul class="nav pull-right">
			          <li class="divider-vertical"></li>
			          <li><a href="logout.php">Wyloguj</a></li>			          
			        </ul>
			      </div>
			    </div>
			  </div>
			</div> ';
	}
###############################################################################
	function draw_menu_register(){
		echo '
			<div class="navbar navbar-fixed-top navbar-inverse">
			  <div class="navbar-inner">
			    <div class="container">
			      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </a>
			      <a class="brand">Drawing Tasks System</a>
			      <div class="nav-collapse">
			        <ul class="nav pull-right">
			          <li><a href="index.php">Strona domowa</a></li>
			        </ul>
			      </div>
			    </div>
			  </div>
			</div> ';
	}
?>