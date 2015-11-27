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
				<div id="name"><a href="#">Hi, <b><?php    session_start();
                                       if(!isset($_SESSION["name"])){
                                       
                                       	 header("Location: login.php");
                                       	 die();
                                       }else{
						
						echo $_SESSION["name"]; 
					}
						?></b></a></div>
				<ul id="nav-mobile" class="right hide-on-med-and-down">
					<li ></li>
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
					<li><a href="#">Orders</a></li>
					<li><a href="php/logout.php">Logout</a></li>
				</ul>
			</div>
		</nav>

		
			<div id="my-orders" class="valign-wrapper section scrollspy">

				<div id="orderlist" class="container z-depth-2">
					<h1 class="center-align"><?php echo $client;?></h1>
					<p class="center-align">View order history of <?php echo $client;?>.</p>

					<table class="highlight">
						<thead>
							<th>P.O. Number</th>
							<th>Issue Date</th>
							<th>Date Shipped</th>
							<th>Status</th>
						</thead>
					</table>
						<ul class="collapsible" data-collapsible="accordion">
						<?php
							
							$query=mysql_query("SELECT * FROM order_info_table WHERE client_name = '$client';");


							while($result = mysql_fetch_array($query)){
								$client_name= $result['client_name'];
								$order_num = $result['purchase_order'];
								$issue_date = $result['issue_date'];
								$status = $result['status'];
								$shipped_date = $result['shipped_date'];
								if($shipped_date == NULL && $status != "Shipped"){
									$shipped_date = "Not yet Shipped";
								}
								
								echo "<li>
									  <div class='collapsible-header'>
									  	<p>$order_num
									  				 <span style='margin-left:8em;'>$issue_date</span>
													 <span style='margin-left:8em;'>$shipped_date</span>
									  				 <span style='margin-left:8em;'>$status</span></p>
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
							</ul>

							
							

				</div>

		</div>
				

		








		<script src="js/jquery-2.1.4.min.js"></script>
		<script src="js/materialize.min.js"></script>
	</body>
	</html>
