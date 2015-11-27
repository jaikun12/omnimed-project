<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/materialize.min.css" media="screen,projection"/>
		<link rel="stylesheet" type="text/css" href="css/admin-dash.css"/>
		<link rel="stylesheet" type="text/css" href="css/user-dash.css"/>
		<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<title>Omnimed PH Ordering System</title>
	</head>
		
	
		<?php	//Connecting---
			include("php/errors.php");
			include("php/success.php");
			include("../files/config.php");
			include("php/DbConnection.php");
			$dbconnect -> connect($DBuser, $DBpass, $DBurl );
			$dbconnect -> useDb($Database);
				$client = $_POST['client_name'];
			//----?>
	
	
	<body>
		<nav class="white">
			<div class="nav-wrapper">
				<a href="#" class="brand-logo"><img id="logo" src="omnimedlogo.png"></a>
				<div id="name">Hi, <b><?php    session_start();
                                       if(!isset($_SESSION["name"])){
                                       
                                       	 header("Location: login.php");
                                       	 die();
                                       }else{
						
						echo $_SESSION["name"]; 
					}
						?></b></div>
				<ul id="nav-mobile" class="right hide-on-med-and-down">
					<li ></li>
					<li><a href="#">Clients Overview</a></li>
					<li><a href="#">Report Printing</a></li>
					<li><a href="#">Orders Overview</a></li>
					<li><a href="php/logout.php">Logout</a></li>
				</ul>
			</div>
		</nav>
			<div id="my-orders" class="valign-wrapper section scrollspy">

				<div id="orderlist" class="container z-depth-2">
					<h4 class="center-align">Accounts Table</h4>

				<div class="row">
					<div class="col s12">
						<ul class="tabs">
							<li class="tab col s3"><a href="#test1">Admin Table</a></li>
							<li class="tab col s3"><a href="#test2">Client Table</a></li>
						</ul>
						</div>
						<div id="test1" class="col s12">
						<div id="demo">
						<div class="table-responsive-vertical shadow-z-1">
							<table id="table" class="highlight">
							<thead>
								<tr>
									<th>Admin ID</th>
									<th>Username</th>
									<th>Name</th>
									<th>Password</th>
									<th>Address</th>
									<th>Shipping Address</th>
									<th>Telephone Number</th>
								</tr>
							</thead>
							<tbody>
<?php

								$query = mysql_query("SELECT * FROM admin_info_table;");
								$index = 0;
								while($result = mysql_fetch_array($query)){
									$index= $index+1;
									$a = $result['admin_id'];
									$u = $result['username'];
									$n = $result['name'];
									$p = $result['password'];
									$ad = $result['location'];
									$sa = $result['shipping_address'];
									$t = $result['tel_number'];
					
					
								echo"<tr>
									<td>$a</td>
									<td>$u</td>
									<td>$n</td>
									<td>$p</td>
									<td>$ad</td>
									<td>$sa</td>
									<td>$t</td>
									</tr>";					
								}


?>
			
							</tbody>
							</table>
							</div>
							</div>
					</div>
						<div id="test2" class="col s12">
						<div id="demo">
						<div class="table-responsive-vertical shadow-z-1">
							<table id="table" class="highlight">
							<thead>
								<tr>
									<th>Client ID</th>
									<th>Username</th>
									<th>Company Name</th>
									<th>Password</th>
									<th>Location</th>
									<th>Shipping Address</th>
									<th>Telephone Number</th>
									<th>Fax Number</th>
								</tr>
							</thead>
							<tbody>
<?php

							$query = mysql_query("SELECT * FROM client_info_table;");
							$index = 0;
							while($result = mysql_fetch_array($query)){
								$index= $index+1;
								$c = $result['client_id'];
								$u = $result['username'];
								$ca = $result['company_name'];
								$p = $result['password'];
								$l = $result['location'];
								$sa = $result['shipping_address'];
								$t = $result['tel_num'];
								$f = $result['fax_num'];
					
					
							echo"<tr>
								<td>$c</td>
								<td>$u</td>
								<td>$ca</td>
								<td>$p</td>
								<td>$l</td>
								<td>$sa</td>
								<td>$t</td>
								<td>$f</td>
								</tr>";					
							}


?>
							</tbody>
							</table>
							</div>
							</div>
						</div>
				</div>	

		<?php 	
			if(isset($_GET["error"])){
				$errorHandler->getE($_GET["error"]);
			}
			
			if(isset($_GET["success"])){
				$successHandler->getSuccess($_GET["success"]);
			}
			
		?>
							<button data-target="add_admin" class="waves-effect waves-light btn modal-trigger">Add  Admin Account</button>
							<button data-target="add_client" class="waves-effect waves-light btn modal-trigger">Add  Client Account</button>
							<button data-target="delete_account" class="waves-effect waves-light btn modal-trigger red">Delete Account </button>
							
							
			
							<div id="add_admin" class="modal modal-fixed-footer">
								<div class="modal-content">
									<h9>New Admin Account</h9>
									
									<form action ="php/newadmin.php" method="POST" class="col s12">
									
										<div class="row">
											<div class="input-field col s6">
												<input name="admin_id" id="admin_id" type="text" class="validate">
												<label for="admin_id">Admin ID</label>
											</div>

											<div class="input-field col s6">
												<input name="username" id="username" type="text" class="validate">
												<label for="username">Username</label>
											</div>
										</div>
										
										<div class="row">
											<div class="input-field col s6">
												<input name="name" id="'name'" type="text" class="validate">
												<label for="'name'">Name</label>
											</div>

											<div class="input-field col s6">
												<input name="password" id="password" type="text" class="validate">
												<label for="password">Password</label>
											</div>
										</div>
										
										<div class="row">
											<div class="input-field col s6">
												<input name="location" id="location" type="text" class="validate">
												<label for="location">Location</label>
											</div>

											<div class="input-field col s6">
												<textarea name="shipping_address" id="shipping_address" class="materialize-textarea validate"></textarea>
												<label for="shipping_address">Shipping Address</label>
											</div>
										</div>
										
										<div class="row">
											<div class="input-field col s6">
												<input name="tel_number" id="tel_number" type="text" class="validate">
												<label for="tel_number">Telephone Number</label>
											</div>
										</div>								
									
									
								</div>
								<div class="modal-footer">
									     <button class="btn waves-effect waves-light" type="submit" name="action" action ="php/newadmin.php">Submit
											<i class="material-icons right">send</i>
										</button>
								</div>
								</form>
								
							</div>
							
							<div id="add_client" class="modal modal-fixed-footer">
								<div class="modal-content">
									<h9>New Client Account</h9>
									
									<form action ="php/newclient.php"  method="POST" class="col s12">
									
										<div class="row">
											<div class="input-field col s6">
												<input name="client_id" id="client_id" type="text" class="validate">
												<label for="client_id">Client ID</label>
											</div>

											<div class="input-field col s6">
												<input name="username" id="username" type="text" class="validate">
												<label for="username">Username</label>
											</div>
										</div>
										
										<div class="row">
											<div class="input-field col s6">
												<input name="company_name" id="company_name" type="text" class="validate">
												<label for="company_name">Company Name</label>
											</div>

											<div class="input-field col s6">
												<input name="password" id="password" type="text" class="validate">
												<label for="password">Password</label>
											</div>
										</div>
										
										<div class="row">
											<div class="input-field col s6">
												<input name="location" id="location" type="text" class="validate">
												<label for="location">Location</label>
											</div>

											<div class="input-field col s6">
												<textarea name="shipping_address" id="shipping" class="materialize-textarea validate"></textarea>
												<label for="shipping">Shipping Address</label>
											</div>
										</div>
										
										<div class="row">
											<div class="input-field col s6">
												<input name="tel_num" id="telephone" type="text" class="validate">
												<label for="telephone">Telephone Number</label>
											</div>
											
											<div class="input-field col s6">
												<input name="fax_num" id="fax" type="text" class="validate">
												<label for="fax">Fax Number</label>
											</div>
										</div>
										
									
								</div>
								<div class="modal-footer">
									    <button class="btn waves-effect waves-light" type="submit" name="action" action ="php/newclient.php">Submit
											<i class="material-icons right">send</i>
										</button>
								</div>
								</form>
							</div>
							
							
							<div id="delete_account" class="modal modal-fixed-footer">
								<div class="modal-content">
									<h4>Delete Account</h4>
										<form action="php/delete-account.php" method="POST">
											  
											  <div class="input-field col s12">
													<select name="username">
														<option value="" disabled selected>Choose your option</option>
														<?php 
																$query = mysql_query("SELECT * FROM users_table;");
																while($result = mysql_fetch_array($query)){
																echo "<option value=". $result['username'].">".$result['username']."</option>";
																}
														?>
													</select>
													
											</div>
											
									<div class="modal-footer">
									    <button class="btn waves-effect waves-light red" type="submit" name="action">Delete</button>
									</div>
								</div>
									</form>
							</div>
				</div>

		</div>
				

		





		<script src="js/jquery-2.1.4.min.js"></script>
		<script src="js/materialize.min.js"></script>
		<script>$(document).ready(function(){
			$('.modal-trigger').leanModal();
			$('select').material_select();
			}); 
		</script>
	</body>
	</html>
