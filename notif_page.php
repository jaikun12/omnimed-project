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

						$read = mysql_query("UPDATE notifications_table SET user_read = 1;");
					}
						?></b></a></li>
					<li><a href="admin-dash.php">Clients Overview</a></li>
					<li><a href="#">Report Printing</a></li>
					<li><a href="orders-overview.php">Orders</a></li>
					<li><a href="php/logout.php">Logout</a></li>
				</ul>
			</div>
		</nav>

		<div class="container">
			<h1>Order Notifications</h1>
			<p>View the changes made by your clients to their orders.</p>
		</div>

		<div class="container">
			<h5>Order Changes</h5>
			
				<?php
					$query = mysql_query("SELECT * FROM  client_info_table");
					while($result = mysql_fetch_array($query)){
							$client = $result['company_name'];

							echo "	<h5>$client</h5>
									<ul class='collapsible' data-collapsible='accordion'>
									";

								$query2 = mysql_query("SELECT * FROM order_info_table WHERE client_name = '$client';");
										while($result2 = mysql_fetch_array($query2)){

											$purchase_order = $result2['purchase_order'];
											$issue_date = $result2['issue_date'];
											$status = $result2['status'];

											echo "<li>
													<div class='collapsible-header'>
													<p>Purchase Order: $purchase_order <span style='margin-left:3em;'><b>Issue Date:</b> $issue_date</span> <span style='margin-left:3em;'><b>Status:</b> $status</span></p>
													</div>
													<div class='collapsible-body'>
														<table class='highlight'>
															<thead>
																<th>Article Number</th>
																<th>Changes</th>
																<th>Previous Quantity</th>
																<th>Changed To</th>
																<th>Time Changed</th>
															</thead>
															<tbody>";

												$query3 = mysql_query("SELECT * FROM notifications_table WHERE client_name = '$client' AND purchase_order = '$purchase_order';");
												while($result3 = mysql_fetch_assoc($query3)){
													$article_num = $result3['article_no'];
													$changes = $result3['changes'];
													$prev_qty = $result3['prev_qty'];
													$new_qty = $result3['new_qty'];
													$time = $result3['time'];
													echo "
															<tr>
																<td>$article_num</td>
																<td>$changes</td>
																<td>$prev_qty</td>
																<td>$new_qty</td>
																<td>$time</td>
															</tr>

															";
												}
												echo "</tbody>
														</table>
															</li>";

										}
										
									echo "</ul>";

					}

					?>

	<script src="js/jquery-2.1.4.min.js"></script>
	<script src="js/materialize.min.js"></script>
</body>
</html>