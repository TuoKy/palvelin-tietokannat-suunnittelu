<?php
require_once ("Tietokanta.class.php");
session_start();
$dbTouch = new Tietokanta();

if (isset($_POST['signIn']) AND isset($_POST['username']) AND isset($_POST['password'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];	

	if ($dbTouch->kirjaudu_sisaan($username,$password)) {	
		$_SESSION['app2_islogged'] = true;
		$_SESSION['username'] = $_POST['username'];
	}
	else
		echo 'wrong username/password !';       
}
else if (isset($_POST['register']))
	header("Location:register.php"); 
?>

<div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Sitename</a>
        </div>
        <center>
            <div class="navbar-collapse collapse" id="navbar-main">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Stuff <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="newPost.php">Write new post</a>
                            </li>
                            <li><a href="#">Another action</a>
                            </li>
                            <li><a href="#">Something else here</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="#">One more separated link</a>
                            </li>
                        </ul>
                    </li>
                </ul>
				<ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Categories <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Action</a>
                            </li>
                            <li><a href="#">Another action</a>
                            </li>
                            <li><a href="#">Something else here</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="#">One more separated link</a>
                            </li>
                        </ul>
                    </li>
                </ul>
				<ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin stuff <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="ShowUsers.php">Show users</a>
                            </li>
                            <li><a href="#">Another action</a>
                            </li>
                            <li><a href="#">Something else here</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="#">One more separated link</a>
                            </li>
                        </ul>
                    </li>
                </ul>
				<?php               
				$form = <<<FORM
				<form class="navbar-form navbar-right" role="search" method="post" action="{$_SERVER['PHP_SELF']}">
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="password" placeholder="Password">
                    </div>
                    <button type="submit" name ="signIn" class="btn btn-default">Sign In</button>
					<button type="submit" name ="register" style="margin-left:50px" class="btn btn-default">Register</button>
                </form>
FORM;
if (@$_SESSION['app2_islogged'] == FALSE)
			echo $form;
		else
			echo ("<span class='right'> <a href ='logout.php'> Logout ({$_SESSION['username']})</a> </span>");				
				?>
            </div>
        </center>
    </div>
	</div>