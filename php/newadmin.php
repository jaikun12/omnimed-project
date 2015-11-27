<?php

	include("../../files/config.php");
	include("DbConnection.php");
	$dbconnect -> connect($DBuser, $DBpass, $DBurl );
    $dbconnect -> useDb($Database);
	
	
	$admin_id = $_POST['admin_id'];
	$username = $_POST['username'];
	$name = $_POST['name'];
	$pass = $_POST['password'];
	$location = $_POST['location'];
	$shipping_address = $_POST['shipping_address'];
	$tel_number = $_POST['tel_number'];
	

	
	if ($admin_id == "" || $admin_id == " " || $admin_id == NULL ||
		$username == "" || $username == " " || $username == NULL ||
		$name == "" || $name == " " || $name == NULL ||
		$pass == "" || $pass == " " || $pass == NULL ||
		$location == "" || $location == " " || $location == NULL ||
		$shipping_address== "" || $shipping_address == " " || $shipping_address == NULL ||
		$tel_number == "" || $tel_number == " " || $tel_number == NULL
		){
			header("Location: ../accounts.php?error=2");
		}else{
	
				$query = mysql_query("SELECT * FROM users_table WHERE username = '$username';");
				$results = mysql_fetch_array($query);
	
					if($results['username']==$username){
						header("Location: ../accounts.php?error=3");
					}else{
						$query = mysql_query("CALL add_admin_info( $admin_id , '$username' , '$name' , '$pass' , '$location', '$shipping_address', '$tel_number')");
						$query = mysql_query("CALL add_users('$username', '$pass', 'admin')");
						header("Location: ../accounts.php?success=1");
						}
						
		}
?>