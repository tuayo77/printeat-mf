<?php
if(!empty($_POST['del'])) {
	include_once 'config.php';
	$del = $_POST['del'];
	 $query = mysql_query("DELETE FROM `livreurs` WHERE `id_liv` = '".$del."' ") or die(mysql_error());
	 echo "true";
	 //$query2 = mysql_query("DELETE FROM `comments` WHERE id_post = $pid ") or die(mysql_error());
} ?>