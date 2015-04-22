
<div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Fabulous Blog</a>
        </div>
        <center>
            <div class="navbar-collapse collapse" id="navbar-main">
				<ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Categories <b class="caret"></b></a>
                        <ul class="dropdown-menu">
						<li><a href="index.php">Kaikki / All</a>
						<li class="divider"></li>
                            <?php
							$tagit = $dbTouch->canHasTags();
							foreach($tagit as $plaa)
							{
							echo "
							<li>
							<a href='index.php?tagi={$plaa['tagiNimi']}'>{$plaa['tagiNimi']}</a>
                            </li>";									
							}						
							?>
							
                        </ul>
                    </li>
                </ul>

				<?php
				if(!empty($yourPrivileges)){ ?>
					<ul class="nav navbar-nav">
						<li><a href="index.php?page=editMyInfo">My Account</a></li>
					</ul>
					<?php
					foreach($yourPrivileges as $key => $value) {
						$navFile = 'nav'.$key.'.php';
						if(file_exists($navFile)) {
							include($navFile);
						}
					}
				}
				
				$form = <<<FORM
				<form class="navbar-form navbar-right" role="search" method="post" action="{$_SERVER['PHP_SELF']}">
                    <div class="form-group">
                        <input type="text" autocomplete="off" class="form-control" name="username" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password">
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