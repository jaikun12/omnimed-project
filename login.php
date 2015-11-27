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

	<center><img id="logo" src="omnimedlogo.png"></center>

	<div class="container">
	<form action='php/authentication.php' method='POST'>
		<div class="row">
			<div class="input-field col s5">
				<input type="text" name="username"><span class="highlight"></span>
				<label>Username</label>
			</div>
			
			<div class="input-field col s5">
				<input type="password" name="password"><span class="highlight"></span>
				<label>Password</label>
			</div>
			<div class="input-field col s2">
				<button type="submit" class="btn waves-effect waves-light" >Login
				</button>
			</div>
		</div>

		<?php 	
			if(isset($_GET["error"])){
				$errorHandler->getE($_GET["error"]);
			}?>
	</form>
	</div>


		<script src="js/jquery-2.1.4.min.js"></script>
		<script src="js/materialize.min.js"></script>

	</body>
</html>