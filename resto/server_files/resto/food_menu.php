<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once("config.php");
	$till=10;
	
	if(isset($_GET["till"]) && !empty($_GET["till"]) ){
		$till = $_GET["till"];
		$till = $conn->real_escape_string($till);
	}

	$query="SELECT * FROM produits where id_prod<=".$till." and dispo_prod=1 ";


	if(isset($_GET["category"]) && !empty($_GET["category"]) ){
		
		$cat = $_GET["category"];
		$cat = stripslashes($cat);
		$cat = $conn->real_escape_string($cat);
		$query=$query."and categorie_prod like ".$cat." ";
		
	}
	
	if( isset($_GET["sort"]) && !empty($_GET["sort"]) ){
		
		$s = $_GET["sort"];
		if($s=="n"){	$query.="order by nom_prod";}
		else if($s=="plh"){	$query.="order by prix_prod";}
		else if($s=="phl"){	$query.="order by prix_prod desc";}
	}

	
	

$result = $conn->query($query);
$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"id_prod":"'  . $rs["id_prod"] . '",';
    $outp .= '"nom_prod":"'   . $rs["nom_prod"]        . '",';
	$outp .= '"description_prod":"'   . $rs["description_prod"]        . '",';
	$outp .= '"photo_prod":"'   . $rs["photo_prod"]        . '",';
	$outp .= '"prix_prod":"'. $rs["prix_prod"]     . '"}';
}


// Adding has more
$result=$conn->query("SELECT count(*) as total from produits");
$data=$result->fetch_array(MYSQLI_ASSOC);
$total = $data['total'];

if(($total-$till)>0){$has_more=$total-$till;}
			    else{$has_more=0;}
			
				
	$outp ='{"has_more":'.$has_more.',"records":['.$outp.']}';

	
$conn->close();

echo($outp);
?> 