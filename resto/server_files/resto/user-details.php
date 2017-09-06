<?php
require_once("config.php");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

if( isset($_GET["ph"]) && isset($_GET["p"]) ){	
		if( !empty($_GET["ph"])  && !empty($_GET["p"])  ){	
								
			$phone=$_GET["ph"];		$password=$_GET["p"];				
			
			// To protect MySQL injection for Security purpose		
			$phone = stripslashes($phone);		
			$password = stripslashes($password);		
			$phone = $conn->real_escape_string($phone);		
			$password = $conn->real_escape_string($password);		
			$password = md5($password);		
			
			$query="SELECT * FROM clients 
					where telephone_clt like '".$phone."' and passe_clt like '".$password."'";	
					
			$result = $conn->query($query);		$outp = "";				
		
			if( $rs=$result->fetch_array(MYSQLI_ASSOC)) {			
				
				if ($outp != "") {$outp .= ",";}
				
				$outp .= '{"nom_clt":"'  . $rs["nom_clt"] . '",';			
				$outp .= '"id_clt":"'   . $rs["id_clt"]        . '",';						
				$outp .= '"telephone_clt":"'   . $rs["telephone_clt"]        . '",';			
				$outp .= '"created":"'. $rs["created"]     . '"}';		
			}	
			
			$outp ='{"records":'.$outp.'}';		
			$conn->close();		
			echo($outp);	
		}
	}
	

	
?> 