<?php
if(!empty($_POST['modif'])) {
$modif = $_POST['modif'];
    require_once("class/session.php");
    require_once("class/crud.class.php");
    $crud = new crud();
    $prod = $crud->get_prod($modif);
if ($prod['dispo_prod'] == 0) {
	if ( $crud->active_prod($modif)) {
    	 echo "true";
    }
    else{
    	echo "false";
    }
} elseif ($prod['dispo_prod'] == 1) {
	if ( $crud->desactive_prod($modif)) {
    	 echo "true";
    }
    else{
    	echo "false";
    }
} else{
	echo "false";
}

    
   
/*	include_once 'config.php';
	
$req1 = mysql_query("SELECT * 
FROM  `produits` where id_prod='".$modif."' ");
while ($req2 = mysql_fetch_array($req1)) {
if ($req2['dispo_prod'] == 1 ) {
	$query = mysql_query("UPDATE  `produits` SET  `dispo_prod` =  '0' WHERE  `id_prod` =  '".$modif."'") or die(mysql_error());
	 echo "true";
}
else if ($req2['dispo_prod'] == 0) {
	 $query1 = mysql_query("UPDATE  `produits` SET  `dispo_prod` =  '1' WHERE  `id_prod` =  '".$modif."'") or die(mysql_error());
	 echo "true";
}

}
*/
	
} ?>