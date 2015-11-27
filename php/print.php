<?php
	include("../../files/config.php");
	include("DbConnection.php");
	include_once("Classes/PHPExcel.php");
	$dbconnect -> connect($DBuser, $DBpass, $DBurl );
	$dbconnect -> useDb($Database);		
	$sheet = new PHPExcel();
	$activeSheet = $sheet->getActiveSheet();
	session_start();
	
	//POST//
	$username = $_SESSION['username'];
	$purchase_order = $_POST['purchase_order'];
	$client = $_POST['client'];
	$invoice_no = $_POST['invoice_no'];
	$shipment_address = $_POST['shipment_address'];
	$shipment_date = $_POST['shipment_date'];
	$box_mark = $_POST['box_mark'];
	$box_volume = $_POST['box_volume'];
	$contact = $_POST['contact'];
	$phone = $_POST['phone'];
	$fax = $_POST['fax'];
	$consignee_name = $_POST['consignee_company'];
	$consignee_address = $_POST['consignee_address'];
	
	
	
	$filename="INV ".$invoice_no."_". $client ."PO ". $purchase_order;
	////SHIPPER Variables////
	
	$query = mysql_query("SELECT * FROM admin_info_table where username = '$username' "); 
	$result = mysql_fetch_array($query);
	$AdminAddress = $result['shipping_address'];
	$AdminLocation = $result['location'];
	$AdminTel = $result['tel_number'];
	
	/////////////////
	
	
	//// BUYER Variables//////
	
	$query = mysql_query("SELECT * FROM client_info_table where company_name = '$client' ");
	$result = mysql_fetch_array($query);
	$ClientLocation = $result['location'];
	$ClientTel = $result['tel_num'];
	$ClientFax = $result['fax_num'];
	
	
	//Formatting
	$activeSheet -> mergeCells('A1:E1');
	$activeSheet -> mergeCells('F1:J1');
	$activeSheet -> mergeCells('A2:D3');
	$activeSheet -> mergeCells('A4:D4');
	$activeSheet -> mergeCells('G13:I15');
	$activeSheet -> mergeCells('G6:H7');
	$activeSheet -> getColumnDimension('A')->setAutoSize(false);
	$activeSheet -> getColumnDimension('B')->setAutoSize(false);
	$activeSheet -> getColumnDimension('C')->setAutoSize(false);
	$activeSheet -> getColumnDimension('A')->setWidth("5.20");
	$activeSheet -> getColumnDimension('B')->setWidth("2.5");
	$activeSheet -> getColumnDimension('C')->setWidth("5.5");
	$activeSheet -> getColumnDimension('D')->setWidth("13.70");
	$activeSheet -> getColumnDimension('E')->setWidth("51");
	$activeSheet -> getColumnDimension('F')->setWidth("11.5");
	
	$header1 = array(
		'font'  => array(
			'name' => 'Arial',
			'bold'  => true,
			'size'  => 13.5,
		)
	);
	$header2 = array(
		'font'  => array(
			'name' => 'Arial',
			'bold'  => false,
			'size'  => 10,
		),
		'alignment' => array(
			'vertical'=>PHPExcel_Style_Alignment::VERTICAL_TOP,
			'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
		)
	);
	$header3 = array(
		'font'  => array(
			'name' => 'Arial',
			'bold'  => true,
			'size'  => 10,
		)
	);
	$header4 = array(
		'font'  => array(
			'name' => 'Arial',
			'bold'  => false,
			'size'  => 10,
		),
		'borders' => array(
          'outline' => array(
              'style' => PHPExcel_Style_Border::BORDER_MEDIUM
			)
		 )
		
	);
	$header5 = array(
		'font'  => array(
			'name' => 'Arial',
			'bold'  => false,
			'size'  => 10,
		),
		
	);
	
	$borderstyle = array(
		'font'  => array(
			'name' => 'Arial',
			'bold'  => false,
			'size'  => 10,
		),
		'borders' => array(
			'allborders' => array(
				'style'=> PHPExcel_Style_Border::BORDER_THIN
			)
		)
	);
	
	
	
	$activeSheet -> getStyle('A1:N1') -> applyFromArray($header1);
	$activeSheet ->getStyle('A2:D4')->applyFromArray($header2);
	$activeSheet ->getStyle('G13')->applyFromArray($header2);
	$activeSheet ->getStyle('G6')->applyFromArray($header2);
	$activeSheet ->getStyle('A7:A12')->applyFromArray($header3);
	$activeSheet ->getStyle('F2:F12')->applyFromArray($header3);
	$activeSheet ->getStyle('A19:C20')->applyFromArray($header4);
	$activeSheet ->getStyle('D19:D20')->applyFromArray($header4);
	$activeSheet ->getStyle('E19:E20')->applyFromArray($header4);
	$activeSheet ->getStyle('F19:F20')->applyFromArray($header4);
	$activeSheet ->getStyle('G19:G20')->applyFromArray($header4);
	$activeSheet ->getStyle('H19:H20')->applyFromArray($header4);
	$activeSheet ->getStyle('I19:I20')->applyFromArray($header4);
	$activeSheet ->getStyle('J19:J20')->applyFromArray($header4);
	$activeSheet ->getStyle('K19:K20')->applyFromArray($header4);
	$activeSheet ->getStyle('L19:L20')->applyFromArray($header4);
	$activeSheet ->getStyle('M19:M20')->applyFromArray($header4);
	$activeSheet ->getStyle('N19:N20')->applyFromArray($header4);
	$activeSheet ->getStyle('D7:E12')->applyFromArray($header5);
	$activeSheet ->getStyle('G2:G12')->applyFromArray($header5);
	$activeSheet ->getStyle('G5')->applyFromArray($header5);
	$activeSheet -> getStyle('A2')->getAlignment()-> setWrapText(true);
	$activeSheet -> getStyle('G13')->getAlignment()-> setWrapText(true); 	
	$activeSheet -> getStyle('G6')->getAlignment()-> setWrapText(true); 	
	
	
	
	
	//Headers//
	
	$activeSheet -> getCell('A1') -> setValue("OMNIMEDPHILS INC.");
	$activeSheet -> getCell('F1') -> setValue("PACKING LIST/INVOICE");
	
	$activeSheet -> getCell('A2') -> setValue($AdminAddress);
	$activeSheet -> getCell('A4') -> setValue('Tel '.$AdminTel);
	
	$activeSheet -> getCell('A7') -> setValue("SHIPPER");
	$activeSheet -> getCell('D7') -> setValue("OMNIMEDPHILS INC.");
	$activeSheet -> getCell('A8') -> setValue("FROM");
	$activeSheet -> getCell('D8') -> setValue($AdminLocation);
	$activeSheet -> getCell('A9') -> setValue("TO");
	$activeSheet -> getCell('D9') -> setValue($ClientLocation);
	$activeSheet -> getCell('A10') -> setValue("SHIP DATE/VIA");
	$activeSheet -> getCell('D10') -> setValue($shipment_date);
	$activeSheet -> getCell('A11') -> setValue("MARK ON BOX");
	$activeSheet -> getCell('D11') -> setValue($box_mark);
	$activeSheet -> getCell('A12') -> setValue("VOLUME");
	$activeSheet -> getCell('D12') -> setValue($box_volume);
	$activeSheet -> getCell('E12') -> setValue("Cubic Meters");
	$activeSheet -> getCell('F2') -> setValue("INVOICE NO");
	$activeSheet -> getCell('G2') -> setValue($invoice_no);
	$activeSheet -> getCell('F3') -> setValue("DATE");
	$activeSheet -> getCell('G3') -> setValue($shipment_date);
	$activeSheet -> getCell('F4') -> setValue("CONSIGNEE");
	$activeSheet -> getCell('G8') -> setValue($contact);
	$activeSheet -> getCell('G9') -> setValue($phone);
	$activeSheet -> getCell('G10') -> setValue($fax);
	$activeSheet -> getCell('G5') -> setValue($consignee_name);
	$activeSheet -> getCell('G6') -> setValue($consignee_address);
	
	
	$activeSheet -> getCell('F11') -> setValue("BUYER/DELIVERY ADDRESS");
	$activeSheet -> getCell('G12') -> setValue($client);
	$activeSheet -> getCell('G13') -> setValue($shipment_address);
	$activeSheet -> getCell('G16') -> setValue("T ".$ClientTel);
	$activeSheet -> getCell('G17') -> setValue("F ". $ClientFax);
	
	$activeSheet -> getCell('A19') -> setValue("BOX NO.");
	$activeSheet -> getCell('D19') -> setValue("PO. /LOT");
	$activeSheet -> getCell('D20') -> setValue("NO");
	$activeSheet -> getCell('E19') -> setValue("DESCRIPTION");
	$activeSheet -> getCell('F19') -> setValue("Ref/ Bar");
	$activeSheet -> getCell('F20') -> setValue("Code No.");
	$activeSheet -> getCell('G19') -> setValue("Qty");
	$activeSheet -> getCell('G20') -> setValue("Final");
	$activeSheet -> getCell('H19') -> setValue("Box");
	$activeSheet -> getCell('H20') -> setValue("size");
	
	$activeSheet -> getCell('I19') -> setValue("Qty");
	$activeSheet -> getCell('I20') -> setValue("boxes");
	$activeSheet -> getCell('J19') -> setValue("CBM");
	$activeSheet -> getCell('K19') -> setValue("GROSS");
	$activeSheet -> getCell('K20') -> setValue("Kg.");
	$activeSheet -> getCell('L19') -> setValue("NET");
	$activeSheet -> getCell('L20') -> setValue("Kg.");
	$activeSheet -> getCell('M19') -> setValue("Price/pc");
	$activeSheet -> getCell('N19') -> setValue("Total");
	$activeSheet -> getCell('N20') -> setValue("Amount");
	
	$query = mysql_query("SELECT * FROM order_table where client_name = '$client' AND purchase_order = $purchase_order "); //put POST of client name and PO
	$totalrows = mysql_num_rows($query);
	$totalrows = $totalrows + 20;
	$activeSheet -> getStyle('D21:D'.$totalrows) -> applyFromArray(array('alignment' => array(
			'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		)));
	$activeSheet -> getStyle('A21:N'.$totalrows) -> applyFromArray($borderstyle);
	$startrow = 21;
	
	while($result = mysql_fetch_array($query)){
		
		$PO = $result['purchase_order'];
		$desc = $result['description'];
		$barcode = $result['article_no'];
		$quantity = $result['quantity'];
		
		
		$activeSheet -> getCell('D'.$startrow) -> setValue($PO);
		$activeSheet -> getCell('E'.$startrow) -> setValue($desc);
		$activeSheet -> getCell('F'.$startrow) -> setValue($barcode);
		$activeSheet -> getCell('G'.$startrow) -> setValue($quantity);
		$startrow ++;
		
	};
	
	
	
	$objWriter = PHPExcel_IOFactory::createWriter($sheet, 'Excel2007');
	header('Content-Type: application/vnd.ms-excel');
	header("Content-Disposition: attachment;filename='$filename.xlsx'");
	header('Cache-Control: max-age=0');
	ob_end_clean();
	$objWriter->save('php://output');
	
?>