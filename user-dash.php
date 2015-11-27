<!DOCTYPE html>
<html>
		<?php	//Connecting---
			include("../files/config.php");
			include("php/DbConnection.php");
			$dbconnect -> connect($DBuser, $DBpass, $DBurl );
			$dbconnect -> useDb($Database);
			//----?>
	<head>
		<link rel="stylesheet" type="text/css" href="css/materialize.min.css" media="screen,projection"/>
		<link rel="stylesheet" type="text/css" href="css/user-dash.css"/>
		<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<title>Omnimed PH Ordering System</title>
	</head>
	<body>

		<div class="row">
			<div id="nav" class="col hide-on-small-only m1.5 12 z-depth-1">				
				<ul class="section table-of-contents pinned">
					<li><img id="logo" src="omnimedlogo.png"></li>
					<li><a href="#new-order" class="waves-effect waves-teal">New Order</a></li>
					<li><a href="#my-orders" class="waves-effect waves-teal">My Orders</a></li>
					<li><a href="php/logout.php" class="waves-effect waves-teal">Logout</a></li>
				</ul>
			</div>
		</div>

		
		<div id="welcome-div" class="card large"   style="z-index:2;">
			<center>
				<img id="logo-lg" src="omnimedlogo.png">
				<h1>Welcome  <?php    session_start();
                                       if(!isset($_SESSION["name"])){
                                       
                                       	 header("Location: login.php");
                                       	 die();
                                       }else{
						
						echo $_SESSION["name"]; 
					}
						?></h1><center>
				<div class="card-content">
					<div class="row">
						<div class="col m6">
							<img id="logo" src="omnimedlogo.png">
							<h5>Send a New Order</h5>
							<p>Send an Order via an Excel File or Individual Submission.</p>
							<br><br>
 								<a href="#new-order" class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">add</i></a>
        
						</div>

						<div class="col m6">
							<img id="logo" src="omnimedlogo.png">
							<h5>My Orders</h5>
							<p>See all of your current and past orders.</p>
							<br><br>
								<a href="#my-orders" class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">toc</i></a>	
						</div>
					</div>
				</div>
		</div>


		<br><br><br><br><br><br><br><br><br><br><br><br><br><br>
		
		
		<div id="new-order" class="valign-wrapper section scrollspy">
			
				<div id="order" class="container z-depth-2">
					<h1 class="center-align">New Order</h1>
					<p class="center-align">Have a new order for us?</p><br><br>
						<form action="php/reader.php" method="POST" enctype="multipart/form-data">
						<div class="file-field input-field">
							<div id="file-submit" class="waves-effect waves-light btn">
								<span>Browse</span>
								<input type="file" name="upload">
							</div>
							<button type="submit" class="waves-effect waves-light btn" id="file-submit-btn">Send <i class="tiny material-icons">input</i></button>
						</div>
						</form>

					<br><br>
					<p class="center-align">Upload your order file here or fill up an order form to add items to your order.</p><br><br>
					<form action="php/addtoorder.php" method="POST">
					<h5 class="center-align">Order Form</h5>
						<div class="row">
							<div class="input-field col s6 tooltipped" data-delay="50" data-position="top" data-tooltip="Please input the Purchase Order Number of the order you wish this item to be included." >
								<input type="text" class="validate" name="purchaseorder_number">
								<label for="purhaseorder_number">Purhase Order Number</label>
							</div>	

							<div class="input-field col s6">
								<input type="text" class="validate" name="article_id">
								<label for="article_id">Article ID</label>
							</div>
						</div>
						
						<div class="row">
							<div class="input-field col s12">
								<input type="text" class="validate" name="description">
								<label for="description">Description</label>
							</div>
						</div>

						<div class="row">
							<div class="input-field col s12">
								<input type="text" class="validate" name="location_code">
								<label for="location_code">Location Code</label>
							</div>
						</div>

						<div class="row">
							<div class="input-field col s12">
								<input type="text" class="validate" name="quantity">
								<label for="quantity">Quantity</label>
							</div>
						</div>

						<div class="row">
							<div class="input-field col s12">
								<input type="text" class="validate" name="code">
								<label for="code">Code</label>
							</div>
						</div>

						<div class="row">
							<div class="input-field col s6 tooltipped" data-delay="50" data-position="right" data-tooltip="Please double check your order form to avoid mistakes." >
								<button type="submit" class="btn" name="">Submit</button>
							</div>
						</div>

				</div>
			</form>
		</div>
		

		<div id="my-orders" class="valign-wrapper section scrollspy">

				<div id="orderlist" class="container z-depth-2">
					<h1 class="center-align">My Orders</h1>
					<p class="center-align">View your order history and pending orders.</p>

					<table class="highlight">
						<thead>
							<th>P.O. Number</th>
							<th>Issue Date</th>
							<th>Status</th>
						</thead>
					</table>
						<ul class="collapsible" data-collapsible="accordion">
						<?php
							$client = $_SESSION["name"];
							$query=mysql_query("SELECT * FROM order_info_table WHERE client_name = '$client';");


							while($result = mysql_fetch_array($query)){
								$client_name= $result['client_name'];
								$order_num = $result['purchase_order'];
								$issue_date = $result['issue_date'];
								$status = $result['status'];
								
								echo "<li>
									  <div class='collapsible-header'>
									  	<p>$order_num
									  				 <span style='margin-left:15.7em;'>$issue_date</span>
									  				 
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
									  				<th></th>
									  				<th></th>
									  			</thead>
									  			<tbody>
									  	
									  ";
									 if($status=="Shipped" || $status=="Canceled"){
									 	$get_order = mysql_query("SELECT * FROM order_table WHERE purchase_order = '$order_num' AND client_name = '$client_name';");
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
									  			  	</tr>";

									 }
									}
									 else{
									  $get_order = mysql_query("SELECT * FROM order_table WHERE purchase_order = '$order_num' AND client_name = '$client_name';");
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
									  			  	<form action='change-form.php' method='POST'>
									  			  		<input type='text' name='client' value='$client_name' style='display:none;'>
									  			  		<input type='text' name='purchase_num' value='$order_num' style='display:none;'>
									  			  		<input type='text' name='art_num' value = '$article_num' style='display:none;'>
									  			  		<input type='text' name='current_qty' value = '$quantity'style='display:none;'>
									  			  	<td><button type='submit' class='waves-effect waves-teal btn-flat tooltipped' data-delay='50' data-position='top' data-tooltip='Change Quantity'><span style='font-size:8px;'>Change</span></button></td>
									  			  	</form>
									  			  	<form action='php/remove-item.php' method='POST'>
									  			  		<input type='text' name='client' value='$client_name' style='display:none;'>
									  			  		<input type='text' name='purchase_num' value='$order_num' style='display:none;'>
									  			  		<input type='text' name='art_num' value = '$article_num' style='display:none;'>
									  			  	<td><button type='submit' class='waves-effect waves-teal btn-flat tooltipped' data-delay='50' data-position='top' data-tooltip='Remove Item'><span style='font-size:8px;'>Remove</span></button></td> 
									  			  	</form> 
									  			  	</tr>
									  		  ";
									  }
									  

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

		<script>

  		$(document).ready(function(){
   		 $('.scrollspy').scrollSpy();
  		});
        </script>

	</body>
</html>