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
					<li><a href="#">Report Printing</a></li>
					<li><a href="orders-overview.php">Orders</a></li>
					<li><a href="php/logout.php">Logout</a></li>
				</ul>
			</div>
		</nav>
		
		<?php
			//POST//
			$client = $_POST['client'];
			$purchase_order = $_POST['purchase_order']
		?>
		
		<div class="main container z-depth-2">
			<form action="php/print.php" method="POST">
			<div class="row">
				<div class="col s12">
					<center><p class="center-align"><b>Confirm Shipment details</b></p></center>
					<p><b>Purchase Order</b>   :    <?php echo $purchase_order;?></p>
					<p><b>Invoiced to</b>   :    <?php echo $client;?></p>
				</div>
			</div>
			<input type='text' style='display:none;' name='client' value="<?php echo $client ?>">
			<input type='text' style='display:none;' name='purchase_order' value="<?php echo $purchase_order ?>">
		
			<div class="row">
				<div class="input-field col s12">
					<input type="text" class="validate" name="invoice_no">
					<label for="invoice_no">Invoice Number</label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s12">
					<input type="text" class="validate" name="shipment_address">
					<label for="shipment_address">Shipment Address(Sent To)</label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s12">
					<p>Shipment Date</p>
					<input type="date" class="datepicker" name="shipment_date">
					
				</div>
			</div>

			<div class="row">
				<div class="input-field col s12">
					<input type="text" class="validate" name="box_mark">
					<label for="box_mark">Mark on Box</label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s12">
					<input type="text" class="validate" name="box_volume">
					<label for="box_volume">Volume</label>
				</div>
			</div>
			
			<center><p><b>Consignee details</b></p></center>
			<div class="row">
				<div class="input-field col s12">
					<input type="text" class="validate" name="consignee_company">
					<label for="consignee_company">Company name</label>
				</div>
			</div>
			
			<div class="row">
				<div class="input-field col s12">
					<input type="text" class="validate" name="consignee_address">
					<label for="consignee_address">Address</label>
				</div>
			</div>
			
			
			<div class="row">
				<div class="input-field col s12">
					<input type="text" class="validate" name="contact">
					<label for="contact">Contact</label>
				</div>
			</div>
			
			<div class="row">
				<div class="input-field col s12">
					<input type="text" class="validate" name="phone">
					<label for="phone">Phone</label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s12">
					<input type="text" class="validate" name="fax">
					<label for="fax">Fax</label>
				</div>
			</div>
			
			<div class="row">
				<div class="input-field col s12">
					<button type='submit' class='waves-effect waves-ligt btn tooltipped' data-delay='50' data-position='bottom' data-tooltip='Downloads an Invoice'>Print Invoice</button>
				</div>
			</div>
				
			</form>
		</div>



		<script src="js/jquery-2.1.4.min.js"></script>
		<script src="js/materialize.min.js"></script>
		<script>
		$('.datepicker').pickadate({
   			 selectMonths: true, // Creates a dropdown to control month
    		 selectYears: 15 // Creates a dropdown of 15 years to control year
  		});
  		</script>
	</body>
	</html>