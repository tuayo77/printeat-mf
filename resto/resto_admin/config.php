<?php 
session_start();
mysql_connect("localhost","root","");
mysql_select_db("resto_app");
//controle sur la session


function php_time_ago($provided_time){
  $time_difference = time() - $provided_time ;
  $seconds = $time_difference ;
  $minutes = round($time_difference / 60 );
  $hours = round($time_difference / 3600 );
  $days = round($time_difference / 86400 );
  $weeks = round($time_difference / 604800 );
  $months = round($time_difference / 2419200 );
  $years = round($time_difference / 29030400 );
  if($seconds <= 60){
     echo "il ya $seconds secondes ";
  }else if($minutes <=60){
     if($minutes==1){
        echo "il ya une minute";
     }else{
        echo "il ya $minutes minutes ";
     }
  }else if($hours <=24){
     if($hours==1){
        echo "il ya une heure";
     }else{
        echo "il ya $hours heure";
     }
  }else if($days <= 7){
     if($days==1){
        echo "il ya un jour";
     }else{
        echo "il ya $days jours";
     }
  }else if($weeks <= 4){
     if($weeks==1){
        echo "il ya une semaine";
     }
     else{
        echo "il ya $weeks semaines";
     }
  }else if($months <=12){
      if($months==1){
        echo "il ya un moi";
      }else{
        echo "il ya $months mois";
      }
   }else{
      if($years==1){
         echo "il ya un an";
      }else{
         echo "il ya $years ans";
      }
   }
}

 ?>