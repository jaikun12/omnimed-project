<?php
	   
	   //Connecting---
			include("../../files/config.php");
			include("DbConnection.php");
			$dbconnect -> connect($DBuser, $DBpass, $DBurl );
			$dbconnect -> useDb($Database);
			//----

		
		$client = $_POST['client'];
		$po_num = $_POST['purchase_num'];
		$art_num = $_POST['art_num'];

		#$query = mysql_query("DELETE FROM order_table WHERE client_name = '$client' AND purchase_order = '$po_num' AND article_no = '$art_num';");
		$query_notif = mysql_query("CALL add_notif_rmv('$client', $po_num, '$art_num', 'Removed')");
		header("Location: ../user-dash.php");

		?>