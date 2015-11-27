<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/materialize.min.css" media="screen,projection"/>
		<link rel="stylesheet" type="text/css" href="css/index.css"/>
		<link rel="stylesheet" type="text/css" href="css/login.css"/>
		<script type='text/javascript' src='js/login.js'></script>
		<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
			<?php
		include("php/errors.php");
		?>
	</head>


	<body>
		<nav class="white">
			<div class="nav-wrappper z-depth-1">
				<a href="#" class="brand-logo"><img id="logo" src="omnimedlogo.png"></a>
				
				<ul id="nav-mobile" class="right hide-on-med-and-down">
					<li><a href="#">Ordering Details</a></li>
					<li><a href="#">Login</a></li>
				</ul>
			</div>
		</nav>

	<form action='php/authentication.php' method='POST'>
		<div class="input-field">
			<input type="text" name="username"><span class="highlight"></span>
			<label>Username</label>
		</div>
		<br>
		<div class="input-field">
			<input type="password" name="password"><span class="highlight"></span>
			<label>Password</label>
		</div>
		<button type="submit" class="btn waves-effect waves-light" >Login
		</button>
		<?php 	
			if(isset($_GET["error"])){
				$errorHandler->getE($_GET["error"]);
			}?>
	</form>


		<script src="js/jquery-2.1.4.min.js"></script>
		<script src="js/materialize.min.js"></script>

	</body>
</html>