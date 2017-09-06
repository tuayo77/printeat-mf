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
		$id_cmd=$request->id_cmd;  
		$id_prod=$request->id_prod; 		
		$qte_prod=$request->qte_prod; 

	// To protect MySQL injection for Security purpose
		$id_cmd = stripslashes($id_cmd);
		$id_prod = stripslashes($id_prod);
		$qte_prod = stripslashes($qte_prod);
		
	
        



        $sql="INSERT INTO `ls_prod_cmd` (`id_cmd`, `id_prod`, `qte_prod`) VALUES ('".$id_cmd."', '".$id_prod."','".$qte_prod."')";
		if ($conn->query($sql) === TRUE) {
			$ins_id = $conn->insert_id;
				$outp='{"result":{"created": "1", "id_prod": "'.$id_prod.'" } }';
			} 
       
			echo $outp;
		
			$conn->close();			

		
       
			
		
			//	$conn->close();	



}
 ?>