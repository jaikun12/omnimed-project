<!DOCTYPE html>
<html>
		<link rel="stylesheet" type="text/css" href="css/materialize.min.css" media="screen,projection"/>
		<link rel="stylesheet" type="text/css" href="css/admin-dash.css"/>
		<link rel="stylesheet" type="text/css" href="css/user-dash.css"/>
		<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<title>Omnimed PH Ordering System</title>
	</head>
		
	
		<?php	//Connecting---
			include("success.php");
			include("../../files/config.php");
			include("DbConnection.php");
			$dbconnect -> connect($DBuser, $DBpass, $DBurl );
			$dbconnect -> useDb($Database);
			//----?>
	
	
	<body>
	<body>
	
		<?php
			session_start();
			
			$username = $_POST['username'];			
			

			
			$checkID = mysql_query("SELECT * FROM users_table WHERE username = '$username';");
			$result = mysql_fetch_array($checkID);
			$role = $result['role'];
			
			$query = mysql_query("CALL delete_users('$username')");
			$query = mysql_query("CALL delete_".$role."_info('$username')");
			
			header("Location: ../accounts.php?success=4");
			//success-account deleted
		?>
		
	</body>
</html>