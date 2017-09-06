<?php 
if(!empty($_POST['del_c'])) {
	$del_c = $_POST['del_c'];
	require_once("class/session.php");
    require_once("class/crud.class.php");
    $crud = new crud();
if ($crud->del_cmd($del_c)) {
	echo "true";
}
else{
	echo "false";
}

}



 ?>