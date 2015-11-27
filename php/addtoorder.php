<?php
	session_start();
	include("../../files/config.php");
	include("DbConnection.php");
	$dbconnect -> connect($DBuser, $DBpass, $DBurl );
	$dbconnect -> useDb($Database);
	
	$purchaseOrder = $_POST['purchaseorder_number'];
	$articleId = $_POST['article_id'];
	$description = $_POST['description'];
	$location = $_POST['location_code'];
	$quantity = $_POST['quantity'];
	$code = $_POST['code'];
	$client = $_SESSION['name'];
	$query = mysql_query("Select * from client_info_table where company_name = '$client'");
	$results = mysql_fetch_array($query);
	$shipToLocation=$results['location'];
	$shippingAddress=$results['shipping_address'];
	
	
	if($purchaseOrder==null || $articleId==null || $description==null || $quantity==null || $code==null){
		header("Location: ../user-dash.php?error=3");  ///ERROR add some fields are missing error 
	}else{
		$purchaseOrder = preg_replace('/\s+/', '', $purchaseOrder);
		$quantity = preg_replace('/\s+/', '', $quantity);
		if(is_numeric($purchaseOrder)&&is_numeric($quantity) && $quantity>=0){
			
			$query = mysql_query("Select * from order_info_table where purchase_order = $purchaseOrder");
			if(mysql_num_rows($query)==0){
				$query = mysql_query("CALL add_order_info($purchaseOrder,'$client','$shippingAddress','$shipToLocation',NULL,NULL,NULL,'Pending')");
				$query = mysql_query("CALL add_order($purchaseOrder,'$client',' ','$articleId','$description','$location',$quantity,'$code')");
				header("Location: ../user-dash.php?success=5");  //sucess made new invoice for new order
			}else{
				$query2 = mysql_query("SELECT * FROM order_table where purchase_order = $purchaseOrder AND client_name = '$client' AND article_no='$articleId'");
				$rows = mysql_num_rows($query2);
				$result = mysql_fetch_array($query2);
				if($rows == 1){
		
					$addedamount = $result['quantity'] + $quantity;
					$query3 = mysql_query("CALL add_amount($addedamount, $purchaseOrder, '$client', '$articleId')");
				}else{
					$query = mysql_query("CALL add_order($purchaseOrder,'$client',' ','$articleId','$description','$location',$quantity,'$code')");
				}
				header("Location: ../user-dash.php?success=4");  // success adding to an existing order
				echo $rows;
				echo $purchaseOrder;
				echo $client;
				echo $articleId;
			}
			
			
		}else{
			header("Location: ../user-dash.php?error=6");  //ERROR add quantity or purchase number must be numbers and not negative
		}
	}
	
	

?>