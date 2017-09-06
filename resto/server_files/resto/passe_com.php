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
		$prix_cmd=$request->prix_cmd;  
		$nbre_cmd=$request->nbre_cmd; 		
		$id_clt=$request->id_clt; 

		
		// To protect MySQL injection for Security purpose
		$prix_cmd = stripslashes($prix_cmd);
		$nbre_cmd = stripslashes($nbre_cmd);
		$id_clt = stripslashes($id_clt);
		$date_cmd = time();
		
		//kkkldff
		/*$sql = "INSERT INTO commande ( prix_cmd, nbre_cmd, date_cmd, id_clt) VALUES ( :prix_cmd, :nbre_cmd, :date_cmd, :id_clt)";
	$pdo_statement = $pdo_conn->prepare( $sql );
		
	$result = $pdo_statement->execute( array( ':prix_cmd'=>$prix_cmd, ':nbre_cmd'=>$nbre_cmd, ':date_cmd'=>$date_cmd, ':id_clt'=>$id_clt) );
	if (!empty($result) ){
	
	 $ins_id = $pdo_conn->lastInsertId();
				$outp='{"result":{"created": "1", "com_id": "'.$ins_id.'" } }';
	}*/
	//kkkldff
	
        $sql="INSERT INTO `commande` (`id_cmd`, `prix_cmd`, `coupon_cmd`, `nbre_cmd`, `etat_cmd`, `date_cmd`, `id_clt`, `id_admin`, `id_liv`) VALUES (NULL, '".$prix_cmd."', '', '".$nbre_cmd."', '0', '".$date_cmd."', '".$id_clt."', '0', '0')";
		if ($conn->query($sql) === TRUE) {
			$ins_id = $conn->insert_id;
				$outp='{"result":{"created": "1", "com_id": "'.$ins_id.'" } }';
			} else {
				$outp='{"result":{"created": "erruer", "exits": "eereirrr" } }';
			}
       
			echo $outp;
		
			$conn->close();	



}
 ?>