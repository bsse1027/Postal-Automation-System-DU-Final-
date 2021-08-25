<?php

    $serverName="localhost";
    $userName="root";
    $password="";
    $dbname="dupas";

    $link= mysqli_connect($serverName,$userName,$password,$dbname);
    mysqli_set_charset($link,'utf8');
   if( mysqli_connect_error() )
   {
       
        die("Error");

   }



?>


