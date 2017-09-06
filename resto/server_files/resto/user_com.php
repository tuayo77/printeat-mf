<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once("config.php");
	$till=10;
	$id_clt = $_GET["id_clt"];
	
	$query="SELECT * FROM commande as cmd LEFT JOIN livreurs as l ON  cmd.id_liv = l.id_liv where cmd.id_clt='".$id_clt."' order by cmd.etat_cmd";


$result = $conn->query($query);
$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"prix_cmd":"'  . $rs["prix_cmd"] . '",';
    $outp .= '"nbre_cmd":"'   . $rs["nbre_cmd"]        . '",';
	$outp .= '"date_cmd":"'   . $rs["date_cmd"]        . '",';
	$outp .= '"etat_cmd":"'   . $rs["etat_cmd"]        . '",';
	$outp .= '"nom_liv":"'. $rs["nom_liv"]     . '"}';
}


// Adding has more
$result=$conn->query("SELECT count(*) as total from produits");
$data=$result->fetch_array(MYSQLI_ASSOC);
$total = $data['total'];

				
	$outp ='{"total":'.$total.',"records":['.$outp.']}';

	
$conn->close();

echo($outp);
?> 