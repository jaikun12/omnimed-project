<!DOCTYPE html>
<html>
	<head>
		<?php	//Connecting---
			include("../files/config.php");
			include("php/DbConnection.php");
			$dbconnect -> connect($DBuser, $DBpass, $DBurl );
			$dbconnect -> useDb($Database);
			//----?>
		<link rel="stylesheet" type="text/css" href="css/materialize.min.css" media="screen,projection"/>
		<link rel="stylesheet" type="text/css" href="css/admin-dash.css"/>
		<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<title>Omnimed PH Ordering System</title>
	</head>
	<body>
		<nav class="white">
			<div class="nav-wrapper">
				<a href="#" class="brand-logo"><img id="logo" src="omnimedlogo.png"></a>
				<ul id="nav-mobile" class="right hide-on-med-and-down">
					<li><a href="#">Hi, <b><?php    session_start();
                                       if(!isset($_SESSION["name"])){
                                       
                                       	 header("Location: login.php");
                                       	 die();
                                       }else{
						
						echo $_SESSION["name"]; 
					}
						?></b></a></li>
					<li><a href="#">Clients Overview</a></li>
					<li><a href="notif_page.php">Notifications <?php 
					$query = mysql_query("SELECT * FROM notifications_table WHERE user_read = 0;");
					if(mysql_num_rows($query)!=0){
						$numrows = mysql_num_rows($query);
						echo "<span class='new badge'>$numrows</span>";

					}
					else{

					}
					?>
					</a></li>
					<li><a href="#">Report Printing</a></li>
					<li><a href="orders-overview.php">Orders</a></li>
					<li><a href="php/logout.php">Logout</a></li>
				</ul>
			</div>
		</nav>

		<div class="container z-depth-2" id="clients">
			<center><h5>Client List</h5><br></center>
			<ul class="collapsible" data-collapsible="accordion">
				<?php
					$query = mysql_query("SELECT * FROM client_info_table;");
					while($result = mysql_fetch_array($query)){
						$companyName = $result['company_name'];

						echo "<li>
								<div class='collapsible-header'><p>$companyName<img src='omnimedlogo.png' class='circle collection-logo'></p></div>
								<div class='collapsible-body'>
									<div class='container'>
										<ul class='collection'>
										<!-- So basically I used invisible form fields for easier backend stuff. lol -->
											<form action='pendingorders.php' method='POST'>
												<input type='text' name='client_name' value='$companyName' style='display:none'>
												<li class='collection-item'>Pending Orders<button type='submit' class='secondary-content icon-btn waves-effect waves-light'><i class='material-icons'>send</i></button></li>
											</form>
											<form action='orderhistory.php' method='POST'>
												<input type='text' name='client_name' value='$companyName' style='display:none'>
												<li class='collection-item'>Order History and Status<button type='submit' class='secondary-content icon-btn waves-effect waves-light'><i class='material-icons'>send</i></button></li>
											</form>
										</ul>
									</div>
								</div>
							  </li>";
					}
					?>
				

				<li>
					<div class="collapsible-header"><p>Salzmann Group<img src="omnimedlogo.png" class="circle collection-logo"></p></div>
					<div class="collapsible-body">
						<div class="container">
							<ul class="collection">
							<!-- So basically I used invisible form fields for easier backend stuff. lol -->
							<form action="pendingorders.php" method="POST">
								<input type="text" name="client_name" value="Yung company name dito!" style="display:none">
								<li class="collection-item">Pending Orders<button type="submit" class="secondary-content icon-btn waves-effect waves-light"><i class="material-icons">send</i></button></li>
							</form>
							<form action="orderhistory.php" method="POST">
							<input type="text" name="client_name" value="Yung company name dito!" style="display:none">
								<li class="collection-item">Order History<button type="submit" class="secondary-content icon-btn waves-effect waves-light"><i class="material-icons">send</i></button></li>
							</form>
							</ul>
						</div>
					</div>
				</li>

				<li>
					<div class="collapsible-header"><p>Salzmann Group<img src="omnimedlogo.png" class="circle collection-logo"></p></div>
					<div class="collapsible-body">
						<div class="container">
							<ul class="collection">
							<!-- So basically I used invisible form fields for easier backend stuff. lol -->
							<form action="pendingorders.php" method="POST">
								<input type="text" name="client_name" value="Yung company name dito!" style="display:none">
								<li class="collection-item">Pending Orders<button type="submit" class="secondary-content icon-btn waves-effect waves-light"><i class="material-icons">send</i></button></li>
							</form>
							<form action="orderhistory.php" method="POST">
							<input type="text" name="client_name" value="Yung company name dito!" style="display:none">
								<li class="collection-item">Order History<button type="submit" class="secondary-content icon-btn waves-effect waves-light"><i class="material-icons">send</i></button></li>
							</form>
							</ul>
						</div>
					</div>
				</li>
			</ul>
		</div>








		<script src="js/jquery-2.1.4.min.js"></script>
		<script src="js/materialize.min.js"></script>
	</body>
	</html>
