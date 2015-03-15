<?php 

require_once ("../palvelin/myslijuttu/hurhur.php"); // kytän tietokanta avaus juttu
// mikko pistä oma tietokannan avaus taikasi tähän ja pistä mun oma kommentteihin
?>
<!DOCTYPE html>
<html>
<head>
	<title>Testiblogi</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="style.css"/>
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.js"></script>
</head>

<body>
	<!--BootstrapNavbar-->
	<div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Sitename</a>
        </div>
        <center>
            <div class="navbar-collapse collapse" id="navbar-main">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Link</a>
                    </li>
                    <li><a href="#">Link</a>
                    </li>
                    <li><a href="#">Link</a>
                    </li>
                    <li><a href="#">Link</a>
                    </li>
                    <li><a href="#">Link</a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
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
                <form class="navbar-form navbar-right" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="password" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-default">Sign In</button>
                </form>
            </div>
        </center>
    </div>
	</div>
	<div class="container">
		<h3>dogemeister</h3>
	</div>
	<div class="container">
		<div class="content">
				<h1>Posti 1</h1>
				<p>Lorem ipsum dolor sit amet, porta magna lectus suspendisse adipiscing arcu, vero sollicitudin semper mauris magna, non dictumst nam, non massa sed. Pede amet pede. Ipsum in a vitae. Elit nunc fusce per etiam quisque, integer aliquam pede eu. Pede tristique quam justo conubia, imperdiet pulvinar mauris ultricies dolor neque, odio ac pede ante proin nulla fermentum, aliquam ultricies dolor sodales.
Mauris mauris enim blandit nam interdum. Ut eget nec sociis dolor quaerat vel. Vel nibh integer fringilla lorem, turpis maecenas, nonummy cursus purus, facilisi quis vestibulum sit cursus. Tellus nullam vel eu, pede suspendisse turpis, donec auctor vel nec, qui sed proin at, a qui. Fringilla non iaculis, nostra class pede natoque sit lorem. Viverra sit tincidunt tempus nullam. Ipsum non vitae in eros nec, justo massa lectus, nullam metus sit, eleifend dolor condimentum non varius, nam et non volutpat. Id quis fermentum magna eu nunc, elit dignissim arcu sed aenean orci, tempor vivamus et hac tincidunt, litora etiam diam, eget id sem nonummy. Vehicula duis quis amet, quis fermentum sollicitudin sed mauris morbi, dignissim auctor in lobortis, vel pede, nulla tincidunt.
In nulla ut laoreet libero. Bibendum cum phasellus quam maecenas. Odio scelerisque nec, suscipit feugiat praesent placeat montes aenean sem, a lectus, eget facilisis. Neque urna viverra mauris, nulla mi amet convallis, lacus pharetra, velit elementum. A eros pellentesque wisi pede in, rutrum amet, risus fermentum proin dis turpis donec nam, aliquam ac aliquet eget wisi aenean, amet risus est neque nulla proin nisl. Sagittis quam in pellentesque sit, pellentesque odio turpis magna mattis. Quam quis minus non amet placerat. Enim penatibus commodo non porta gravida felis, justo massa, et suspendisse justo nunc. Accumsan ultrices ac aliquam praesent ut, sed vel ornare eros lacus, nibh eget, nullam praesent, diam donec tortor vitae litora ipsam nam. Et consectetuer vitae. Duis hendrerit consectetuer erat quam quisque, massa eu magna iaculis nisl.
Dignissim lorem dui augue. Luctus magnis, lacinia suspendisse blandit duis excepteur lectus, bibendum augue, in magna pede nunc luctus nullam neque, gravida parturient ac semper morbi. Bibendum vitae ac, ipsum urna natoque vestibulum tortor nibh vestibulum, ac in, ultrices gravida erat. A tortor lacus ac tincidunt, id elementum dictum rhoncus mauris in. Viverra sollicitudin tincidunt sem aenean leo, vestibulum varius felis vel nulla, fusce urna amet sed.</p>
		</div>
	<br>
		<div class="content">
				<h1>Posti 2</h1>
				<p>Lorem ipsum dolor sit amet, porta magna lectus suspendisse adipiscing arcu, vero sollicitudin semper mauris magna, non dictumst nam, non massa sed. Pede amet pede. Ipsum in a vitae. Elit nunc fusce per etiam quisque, integer aliquam pede eu. Pede tristique quam justo conubia, imperdiet pulvinar mauris ultricies dolor neque, odio ac pede ante proin nulla fermentum, aliquam ultricies dolor sodales.
Mauris mauris enim blandit nam interdum. Ut eget nec sociis dolor quaerat vel. Vel nibh integer fringilla lorem, turpis maecenas, nonummy cursus purus, facilisi quis vestibulum sit cursus. Tellus nullam vel eu, pede suspendisse turpis, donec auctor vel nec, qui sed proin at, a qui. Fringilla non iaculis, nostra class pede natoque sit lorem. Viverra sit tincidunt tempus nullam. Ipsum non vitae in eros nec, justo massa lectus, nullam metus sit, eleifend dolor condimentum non varius, nam et non volutpat. Id quis fermentum magna eu nunc, elit dignissim arcu sed aenean orci, tempor vivamus et hac tincidunt, litora etiam diam, eget id sem nonummy. Vehicula duis quis amet, quis fermentum sollicitudin sed mauris morbi, dignissim auctor in lobortis, vel pede, nulla tincidunt.
In nulla ut laoreet libero. Bibendum cum phasellus quam maecenas. Odio scelerisque nec, suscipit feugiat praesent placeat montes aenean sem, a lectus, eget facilisis. Neque urna viverra mauris, nulla mi amet convallis, lacus pharetra, velit elementum. A eros pellentesque wisi pede in, rutrum amet, risus fermentum proin dis turpis donec nam, aliquam ac aliquet eget wisi aenean, amet risus est neque nulla proin nisl. Sagittis quam in pellentesque sit, pellentesque odio turpis magna mattis. Quam quis minus non amet placerat. Enim penatibus commodo non porta gravida felis, justo massa, et suspendisse justo nunc. Accumsan ultrices ac aliquam praesent ut, sed vel ornare eros lacus, nibh eget, nullam praesent, diam donec tortor vitae litora ipsam nam. Et consectetuer vitae. Duis hendrerit consectetuer erat quam quisque, massa eu magna iaculis nisl.
Dignissim lorem dui augue. Luctus magnis, lacinia suspendisse blandit duis excepteur lectus, bibendum augue, in magna pede nunc luctus nullam neque, gravida parturient ac semper morbi. Bibendum vitae ac, ipsum urna natoque vestibulum tortor nibh vestibulum, ac in, ultrices gravida erat. A tortor lacus ac tincidunt, id elementum dictum rhoncus mauris in. Viverra sollicitudin tincidunt sem aenean leo, vestibulum varius felis vel nulla, fusce urna amet sed.</p>
		</div>
	</div>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>
</html>