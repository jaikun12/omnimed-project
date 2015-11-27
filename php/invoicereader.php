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
			
			$client = $_POST['client'];
			echo $client;
			$purchase_order = $_POST['purhcase_order'];
			echo $purchase_order;
			$shipped_date = $ActiveSheet ->getCell('D10') -> getValue();
			echo $shipped_date;
			$box_mark = $ActiveSheet ->getCell('D11') -> getValue();
			echo $box_mark;
			$volume = $ActiveSheet ->getCell('D12') -> getValue();
			echo $volume;
			$invoice = $ActiveSheet ->getCell('G2') -> getValue();
			echo $invoice;
			//POST
			
			////////
			
			
			
		
					
			
			echo "redirect to success page";
			
		}else{
			echo"filetype invalid";
		}
		
		
		
	}else{
	
		echo"weee";
	}
	
	
?>