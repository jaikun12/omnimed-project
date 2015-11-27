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
									   if(isset($_POST["client_name"])){
										$client = $_POST["client_name"];
										}
										else{
											$client = $_SESSION['client'];
										}
										
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
					<li><a href="orders-overview.php">Orders</a></li>
					<li><a href="php/logout.php">Logout</a></li>
				</ul>
			</div>
		</nav>

			<div class="container z-depth-2">
				<center><span style="margin-top:10px;"><h5><?php echo "$client"; ?> Pending Orders</h5></span></center>
				<ul class="collapsible">
					<?php

							
							$query=mysql_query("SELECT * FROM order_info_table WHERE client_name = '$client' AND status = 'Pending'; ");
							
							if(mysql_num_rows($query)!=0){
								
							
							

							while($result = mysql_fetch_array($query)){
								$client_name= $result['client_name'];
								$order_num = $result['purchase_order'];
								$issue_date = $result['issue_date'];
								$status = $result['status'];
								
								echo "<li>
									  <div class='collapsible-header'>
									  	<form action='confirm_order.php' method='POST'><p>Purchase Order: $order_num
									  				 <span style='margin-left:7em;'>Issue Date: $issue_date</span>
									  				 
									  				 <span style='margin-left:5em;'>$status</span>
									  				 
									  				 	<input type='text' name='order_src' value='$order_num' style='display:none;'>
									  				 <span style='margin-left:5em;'>	<button class='waves-effect waves-ligt btn tooltipped' data-delay='50' data-position='bottom' data-tooltip='Clicking confirm will mean that the order is now in production.' type='submit' name='confirm_src' value='$client_name'>Confirm</button></span>
									  				 </p></form>
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

									}}
									else{
										echo "<center><p>No pending orders.</p>
												<a href='admin-dash.php' class='btn btn-flat'>Return</a></center>";
									}
						?>
						</ul></div>








		<script src="js/jquery-2.1.4.min.js"></script>
		<script src="js/materialize.min.js"></script>
	</body>
	</html>