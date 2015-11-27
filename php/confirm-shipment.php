<?php
	<?php	//Connecting---
			include("../../files/config.php");
			include("DbConnection.php");
			$dbconnect -> connect($DBuser, $DBpass, $DBurl );
			$dbconnect -> useDb($Database);
			//----?>
			
			
		$purchase_order = $_POST['purchase_order'];
		$client = $_POST['client'];
		$invoice_no = $_POST['invoice_no'];
?>