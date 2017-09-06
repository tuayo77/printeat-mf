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
		$phone=$request->ph; 
		$id=$request->id; 
		
		// To protect MySQL injection for Security purpose
		$name = stripslashes($name);
		$phone = stripslashes($phone);
		$id = stripslashes($id);
		
		$name = $conn->real_escape_string($name);
		$phone = $conn->real_escape_string($phone);
		$id = $conn->real_escape_string($id);
		$timestamp = time();
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
//UPDATE `resto_app`.`clients` SET `nom_clt` = 'borell', `email_clt` = 'ddc', `created` = '149839023' WHERE `clients`.`id_clt` = 1;
$pdo_statement=$pdo_conn->prepare("update clients set nom_clt='" . $name . "', telephone_clt='" . $phone. "' where id_clt=" . $id);
	$result = $pdo_statement->execute();
	if($result) {
		$outp='{"result":{"created": "1", "exists": "0" } }';
	}
}

			//vjkjfk
	/*
			$sql = "INSERT INTO `clients` (`id_clt`, `nom_clt`, `email_clt`, `telephone_clt`, `passe_clt`, `created`) VALUES (NULL, '".$name."', '', '".$phone."', '".$password."', '".$timestamp."')";		
			if ($conn->query($sql) === TRUE) {
				$outp='{"result":{"created": "1", "exists": "0" } }';
			} */
		
		
		echo $outp;
		
		$conn->close();	
	
}

?> 