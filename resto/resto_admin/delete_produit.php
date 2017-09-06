<?php
if(!empty($_POST['del'])) {
$del = $_POST['del'];
    require_once("class/session.php");
    require_once("class/crud.class.php");
    $crud = new crud();
    if ($crud->dell_prod($del)) {
    	 echo "true";
    }
    else{
    	echo "false";
    }
   
  
	/*include_once 'config.php';
	
	 $query = mysql_query("DELETE FROM `produits` WHERE `id_prod` = $del ") or die(mysql_error());
	
	 */
	 } ?>