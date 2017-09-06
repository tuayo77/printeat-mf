<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once("config.php");
	$till=10;
	$id_clt = $_GET["id_clt"];
	
	$query="SELECT * FROM produits as p, favoris as f where p.id_prod=f.id_prod and f.id_clt = '".$id_clt."' and p.dispo_prod=1";


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
$result=$conn->query("SELECT count(*) as total from favoris where id_clt ='".$id_clt."'");
$data=$result->fetch_array(MYSQLI_ASSOC);
$total = $data['total'];

			
				
	$outp ='{"total":'.$total.',"records":['.$outp.']}';

	
$conn->close();

echo($outp);
?> 