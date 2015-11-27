<?php
	 class Error{
		public function getE($errornumber){
			if($errornumber == 1){
				echo "<h6>Ohh noo. Wrong username or password<h6>";
			} else if($errornumber == 2){
			   echo "<h6>Uhh ohh. Please fill up the fields<h6>";
			}
					
		}	
	}
	
	
	$errorHandler = new Error;
	 
	 

?>