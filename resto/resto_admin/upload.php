<?php
  $imageData=$_POST['fichier'];
  $ext=$_POST['ext'];
  $name=explode('.',$_POST['name']);
  $nameFinal=$name[0].'.'.$ext;
  $filteredData=substr($imageData, strpos($imageData, ",")+1);
  $unencodedData=base64_decode($filteredData);
  $fp = fopen('../photos/'.$nameFinal, 'wb' );
  fwrite( $fp, $unencodedData);
  fclose( $fp );
?>