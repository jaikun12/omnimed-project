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

		<?php    session_start();
                                       if(!isset($_SESSION["name"])){
                                       
                                       	 header("Location: login.php");
                                       	 die();
                                       }else{
						
						echo $_SESSION["name"]; 
					}
						?>
	</head>
	<body>
		<div id="main" class="container z-depth-2">
		<center><h5>Change Article Quantity</h5></center>
		<p><b>Item Information:</b></p>
		<?php 
			$client = $_POST["client"];
			$purchase_order = $_POST["purchase_num"];
			$article_num = $_POST["art_num"];
			$quantity = $_POST["current_qty"];
			$query = mysql_query("SELECT * FROM order_table WHERE article_no = '$article_num';");
			$result = mysql_fetch_array($query);
			$description = $result['description'];

			echo "<p>Purchase Order Number: $purchase_order</p>
				  <p>Article ID: $article_num</p>
				  <p>Current Quantity: $quantity</p>
				  <p>Item Description: $description</p>";

			?>

			<div class='row'>
				<form action='php/change-qty.php' method='POST'>
				<center><div class='input-field col s8'>
					<input type='text' name='client' value=<?php echo "'$client'";?> style='display:none;'>
					<input type='text' name='po_num' value=<?php echo "'$purchase_order'";?> style='display:none;'>
					<input type='text' name='art_num' value=<?php echo "'$article_num'";?> style='display:none;'>
					<input type='text' name='old_qty' value=<?php echo "'$quantity'";?> style='display:none;'>
					<input type='text' name='new_qty'>
					<label for='new_qty'>Change Quantity To</label>
					<button type='submit' class='waves-effect waves-teal btn-flat'>Submit</button>
				</div></center>
				</form>
			</div>



			</div>






	<script src="js/jquery-2.1.4.min.js"></script>
	<script src="js/materialize.min.js"></script>

	</body>
</html>