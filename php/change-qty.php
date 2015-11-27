<?php
	   
	   //Connecting---
			include("../../files/config.php");
			include("DbConnection.php");
			$dbconnect -> connect($DBuser, $DBpass, $DBurl );
			$dbconnect -> useDb($Database);
			//----

		$old_quantity = $_POST["old_qty"];
		$new_quantity = $_POST['new_qty'];
		$client = $_POST['client'];
		$po_num = $_POST['po_num'];
		$art_num = $_POST['art_num'];

		

		$query = mysql_query("UPDATE order_table SET quantity = $new_quantity WHERE client_name = '$client' AND purchase_order = $po_num AND article_no = '$art_num';");
		$query_notif = mysql_query("CALL add_notif_qty('$client', $po_num, '$art_num', 'Changed Quantity', $old_quantity, $new_quantity)");
		header("Location: ../user-dash.php");







						?>