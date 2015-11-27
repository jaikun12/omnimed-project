<?php

	include("../../files/config.php");
	include("DbConnection.php");
	$dbconnect -> connect($DBuser, $DBpass, $DBurl );
    $dbconnect -> useDb($Database);
	
	
	$client_id = $_POST['client_id'];
	$username = $_POST['username'];
	$company_name = $_POST['company_name'];
	$pass = $_POST['password'];
	$location = $_POST['location'];
	$shipping_address = $_POST['shipping_address'];
	$tel_num = $_POST['tel_num'];
	$fax_num= $_POST['fax_num'];
	

	
	if ($client_id == "" || $client_id == " " || $client_id == NULL ||
		$username == "" || $username == " " || $username == NULL ||
		$company_name == "" || $company_name == " " || $company_name == NULL ||
		$pass == "" || $pass == " " || $pass == NULL ||
		$location == "" || $location == " " || $location == NULL ||
		$shipping_address== "" || $shipping_address == " " || $shipping_address == NULL ||
		$tel_num == "" || $tel_num == " " || $tel_num == NULL ||
		$fax_num == "" || $fax_num == " " || $fax_num == NULL
		){
			//header("Location: ../accounts.php?error=2");
			echo mysql_error($query);
		}else{
	
				$query = mysql_query("SELECT * FROM users_table WHERE username = '$username';");
				$results = mysql_fetch_array($query);
	
					if($results['username']==$username){
						header("Location: ../accounts.php?error=3");
					}else{
						$query = mysql_query("CALL add_client_info( $client_id , '$username' , '$company_name' , '$pass' , '$location', '$shipping_address', '$tel_num', '$fax_num')");
						$query = mysql_query("CALL add_users('$username', '$pass', 'client')");
						header("Location: ../accounts.php?success=1");
						}
						
		}
?>