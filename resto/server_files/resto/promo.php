<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once("config.php");
	
	$query="SELECT * FROM produits where promo_prod=1 and dispo_prod=1 ";
	

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

	$outp ='{"has_more":['.$outp.'],"records":['.$outp.']}';

	
$conn->close();

echo($outp);
?> 