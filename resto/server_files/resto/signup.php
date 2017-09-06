<?php

require_once("config.php");
	if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
 
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
        exit(0);
    }

 
   $postdata = file_get_contents("php://input");


  if (isset($postdata)) {
		$request = json_decode($postdata);
		
		$name=$request->n;  		
		$password=$request->ps; 
		$password=md5($password);
		$phone=$request->ph; 
		$address=$request->add; 
		
		// To protect MySQL injection for Security purpose
		$name = stripslashes($name);
		$password = stripslashes($password);
		$phone = stripslashes($phone);
		$address = stripslashes($address);
		
		$name = $conn->real_escape_string($name);
		$password = $conn->real_escape_string($password);
		$phone = $conn->real_escape_string($phone);
		$address = $conn->real_escape_string($address);
		$timestamp = time();
		//check if exist
		$check='SELECT count(*) FROM clients WHERE telephone_clt = "'.$phone.'"';
		$rs = mysqli_query($conn,$check);
		$data = mysqli_fetch_array($rs, MYSQLI_NUM);
		//print_r($data);
		$nu=$data[0];
		$outp = "";	
		if($nu != 0) {
			$outp='{"result":{"created": "0" , "exists": "'.$nu.'" } }';
		}
		else{	

//xmlmckksdljfksld
/*
$sql = "INSERT INTO clients ( nom_clt, telephone_clt, passe_clt, created) VALUES ( :nom_clt, :telephone_clt, :passe_clt, :created )";
	$pdo_statement = $pdo_conn->prepare($sql);
		
	$result = $pdo_statement->execute(array( ':nom_clt'=>$name, ':telephone_clt'=>$phone, ':passe_clt'=>$password, ':created'=>$timestamp ) );
	if (!empty($result) ){
	$outp='{"result":{"created": "1", "exists": "0" } }';
	}
*/
			//vjkjfk
	
			$sql = "INSERT INTO `clients` (`id_clt`, `nom_clt`, `email_clt`, `telephone_clt`, `passe_clt`, `created`) VALUES (NULL, '".$name."', '', '".$phone."', '".$password."', '".$timestamp."')";		
			if ($conn->query($sql) === TRUE) {
				$outp='{"result":{"created": "1", "exists": "0" } }';
			} else {
				$outp='{"result":{"created": "erreurr", "exists": "insert error" } }';
			}
		}
		
		echo $outp;
		
		$conn->close();	
	
}

?> 