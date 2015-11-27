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
					<li><a href='#'>Hi, <b><?php    session_start();
										
                                       if(!isset($_SESSION["name"])){
                                       
                                       	 header("Location: login.php");
                                       	 die();
                                       }else{
						
						echo $_SESSION["name"]; 
					}
						?></b></a></li>
					<li><a href="admin-dash.php">Clients Overview</a></li>
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
					<li><a href="#">Orders</a></li>
					<li><a href="php/logout.php">Logout</a></li>
				</ul>
			</div>
		</nav>

		<div class="container z-depth-2">
				<center><span style="margin-top:10px;"><h5>Orders</h5></span></center>
				<ul class="collapsible">
					<?php

							$client = $_SESSION["name"];
							$query=mysql_query("SELECT * FROM order_info_table");


							while($result = mysql_fetch_array($query)){
								$client_name= $result['client_name'];
								$order_num = $result['purchase_order'];
								$issue_date = $result['issue_date'];
								$status = $result['status'];
								
								echo "<li>
									  <div class='collapsible-header'>
													<p>			<b>Client: </b> $client_name 		
									  				<span style='margin-left:3em;'><b>P.O. Number:</b> $order_num </span>
									  				 <span style='margin-left:3em;'><b>Issue Date:</b> $issue_date</span>
									  				 <span style='margin-left:1em;'><b>Status:</b> $status</span>
													 </p>
													 <div class='row'>
														<div class='col s9'>
															<form action='php/invoicereader.php' method='POST' enctype='multipart/form-data'>					
																<input type='text' style='display:none;' name='client' value='$client_name'>
																<input type='text' style='display:none;' name='purchase_order' value='$order_num'>
																<div class='file-field input-field col s10'>
																	<div class='btn'>
																		<span>Invoice File</span>
																		<input type='file' name='upload'>
																	</div>
																	<div class='file-path-wrapper'>
																	<input class='file-path validate' type='text' placeholder='Upload Invoice file here'>
																	</div>
																</div>
																<div class='col s2'>
																	<button class='waves-effect waves-ligt btn tooltipped' data-delay='50' data-position='bottom' data-tooltip='Clicking ship would confirm that the order is now shipped with Invoice number.'>SHIP</button>
																</div>
																</form>
														</div>
													 
													 <div class='col s3'>
															<form action='shipment-form.php' method='POST'>
																<input type='text' style='display:none;' name='client' value='$client_name'>
																<input type='text' style='display:none;' name='purchase_order' value='$order_num'>
																<button type='submit' class='waves-effect waves-ligt btn tooltipped' data-delay='50' data-position='bottom' data-tooltip='Clicking to fill up form to print invoice.'>Print Invoice</button>
															</form>
														</div>
													</div>
									  </div>
									  <div class='collapsible-body'>
									  		<table class='highlight'>
									  			<thead>
									  				<th>Article No.</th>
									  				<th>Description</th>
									  				<th>Location Code</th>
									  				<th>Quantity</th>
									  				<th>Code</th>
									  			</thead>
									  			<tbody>
									  	
									  ";
									  $get_order = mysql_query("SELECT * FROM order_table WHERE purchase_order = '$order_num';");
									  while($orders = mysql_fetch_array($get_order)){
									  	$article_num = $orders['article_no'];
									  	$order_desc = $orders['description'];
									  	$loc_code = $orders['location'];
									  	$quantity = $orders['quantity'];
									  	$code = $orders['code'];
									  	echo "
									  		
									  				<tr>
									  			 	<td>$article_num</td>
									  			  	<td>$order_desc</td>
									  			  	<td>$loc_code</td>
									  			  	<td>$quantity</td>
									  			  	<td>$code</td>
									  			  	</tr>
									  		  ";
									  }
									  echo "
									  		</tbody>
									  		</table>
									  		</div>
									  		</li>";

									}
					












					?>
						</ul></div>








		<script src="js/jquery-2.1.4.min.js"></script>
		<script src="js/materialize.min.js"></script>
	</body>
	</html>