<?php

    $serverName="localhost";
    $userName="root";
    $password="";
    $dbname="dupas";

    $link= mysqli_connect($serverName,$userName,$password,$dbname);

   if( mysqli_connect_error() )
   {
       
        die("Error");

   }



?>


