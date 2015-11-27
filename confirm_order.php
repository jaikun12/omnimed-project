<?php
	include("../files/config.php");
	include("php/DbConnection.php");
	$dbconnect -> connect($DBuser, $DBpass, $DBurl );
	$dbconnect -> useDb($Database);
	session_start();




	$client_name = $_POST["confirm_src"];
	$order_num = $_POST["order_src"];
	$status = "On Production";
	$query = mysql_query("UPDATE order_info_table SET status = '$status' WHERE purchase_order = '$order_num' AND client_name = '$client_name';");
	
	$_SESSION['client'] =  $client_name;
	header('location: pendingorders.php');

	?>
