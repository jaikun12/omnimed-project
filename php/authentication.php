<html>
<head><title>Logging in</title></head>
<body>
	<?php
		session_start();
		
		$username= $_POST["username"];
		$password= $_POST["password"];
		
		if($username == null || $password == null){
			header("Location: ../login.php?error=2");
		}else{
		
			//Connecting---
			include("../../files/config.php");
			include("DbConnection.php");
			$dbconnect -> connect($DBuser, $DBpass, $DBurl );
			$dbconnect -> useDb($Database);
			//----
			
			
			$check = mysql_query("SELECT * FROM users_table WHERE username = '$username';");   
			
			if(mysql_num_rows($check)!=0){
				while($results = mysql_fetch_array($check)){
					if($results['password']==$password&&$results['username']==$username){	 
						if($results['role']=="admin"){
							$query = mysql_query("SELECT * FROM admin_info_table WHERE username='$username';");
							$result = mysql_fetch_array($query);
							$_SESSION['name']=$result['name'];
							$_SESSION['username']=$result['username'];
							header("Location: ../admin-dash.php");
							$dbconnect -> closeConnection();
							break;
						}else if($results['role']=="client"){
							$query = mysql_query("SELECT * FROM client_info_table WHERE username='$username';");
							$result = mysql_fetch_array($query);
							$_SESSION['name']=$result['company_name'];
							$_SESSION['username']=$result['username'];
							header("Location: ../user-dash.php");
							$dbconnect -> closeConnection();
							break;
						}
					}else{
						header("Location: ../login.php?error=2");
					}
				}
			}else{
				header("Location: ../login.php?error=3");
			}
		}
		
		
		
		
		
	?>
</body>
</html>