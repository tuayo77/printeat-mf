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
		$id_prod=$request->id_prod; 		
		$id_clt=$request->id_clt; 

		
		// To protect MySQL injection for Security purpose
		$id_prod = stripslashes($id_prod);
		$id_clt = stripslashes($id_clt);
		

		//check if exist
		$check='SELECT count(*) FROM favoris WHERE id_prod = "'.$id_prod.'" and id_clt = "'.$id_clt.'" ';
		$rs = mysqli_query($conn,$check);
		$data = mysqli_fetch_array($rs, MYSQLI_NUM);
		//print_r($data);
		$nu=$data[0];
		$outp = "";	
		if($nu != 0) {
			$pdo_statement=$pdo_conn->prepare('delete FROM favoris WHERE id_prod = "'.$id_prod.'" and id_clt = "'.$id_clt.'" ');
$pdo_statement->execute();
			$outp='{"result":{"created": "0" , "exists": "1" } }';
		}
		else{
	
        $sql="INSERT INTO `favoris` (`id_prod`, `id_clt`) VALUES ('".$id_prod."', '".$id_clt."')";
		if ($conn->query($sql) === TRUE) {
			
				$outp='{"result":{"created": "1", "exists": "0" } }';
			} 

		}
			echo $outp;
		
			$conn->close();	



}
 ?>