<?php 
	session_start();
	include_once("Classes/PHPExcel/IOFactory.php");
	include("../../files/config.php");
	include("DbConnection.php");
	$dbconnect -> connect($DBuser, $DBpass, $DBurl );
	$dbconnect -> useDb($Database);
	
//Rule
	$filetypes= array("xml","xls","xlsx","pdf");
	
	
	
	

	if(isset($_FILES['upload'])){
		$file = $_FILES['upload'];
		$filename=$file['name'];
		$file_ext=explode(".",$filename);
		$file_ext=strtolower(end($file_ext));
		$inputFileName = $file['tmp_name'];
		
		if(in_array($file_ext,$filetypes)){
			try {
				$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
				$objReader = PHPExcel_IOFactory::createReader($inputFileType);
				$objPHPExcel = $objReader->load($inputFileName);
			} catch(Exception $e) {
				die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
			}
			$ActiveSheet = $objPHPExcel->getSheet(0); 
			$highestRow = $ActiveSheet->getHighestRow(); 
			$highestColumn = $ActiveSheet->getHighestColumn();
			
			//Order INFO///
			$POnumber = explode(" ",$ActiveSheet -> getCell('A1')-> getValue());
			$client = $_SESSION['name'];
			echo $client;
			$query = mysql_query("Select * from client_info_table where company_name = '$client'");
			$results = mysql_fetch_array($query);
			$shipToLocation=$results['location'];
			$shippingAddress=$results['shipping_address'];
			////////
			
			
			
			for($row = 3; $row<=$highestRow; $row++){	
				$rowData = $ActiveSheet->rangeToArray("A".$row.":".$highestColumn.$row,NULL,TRUE,FALSE);
				$quantity = $rowData[0][4];
				
				if(is_numeric($quantity) && $quantity>0){
					$article = $rowData[0][0];
					$articleNo = $rowData[0][1];
					$description = $rowData[0][2];
					$location =  $rowData[0][3];
					$code = $rowData[0][5];
					
					$query2 = mysql_query("SELECT * FROM order_table where purchase_order = $POnumber[0] AND client_name = '$client' AND article_no='$articleNo'");
					$rows = mysql_num_rows($query2);
					$result = mysql_fetch_array($query2);
					if($rows == 1){
						$addedamount = $result['quantity'] + $quantity;
						$query3 = mysql_query("CALL add_amount($addedamount, $POnumber[0], '$client', '$articleNo')");
					}else{
						$query = mysql_query("CALL add_order($POnumber[0],'$client',' ','$articleNo','$description','$location',$quantity,'$code')");
						echo $rows;
					}
				}else{
					echo "Some orders have been removed because quantity is negative or not a number ";
				}
			}
			
			$query = mysql_query("Select * from order_info_table where purchase_order = $POnumber[0] AND client_name = '$client'");
			if(mysql_num_rows($query)==0){
				$query = mysql_query("CALL add_order_info($POnumber[0],'$client','$shippingAddress','$shipToLocation',NULL,NULL,NULL,'Pending')");
			}
			
			echo "redirect to success page";
			
		}else{
			echo"filetype invalid";
		}
		
		
		
	}else{
	
		echo"weee";
	}
	
	
?>