<?php 

include $_SERVER['DOCUMENT_ROOT'].'/spl/base_url.php';
include BASE_URL."dbconnect.php"; 

?>




<!doctype html>
<html lang="en">
  <head>
   
    <?php include BASE_URL."include/head.php"; ?> 


    <style>

        body{

            background:none;
        }
     


    </style>
  </head>
  <body>

         

                <?php include BASE_URL."include/header.php"; ?> 


           
  
            <div class="container">

                    <div class="card text-center mx-auto" style="margin-top:30%; height:20em; background:none; border:none;">
                
                    <div class="card-body" style="color:white; display:inline-block;">
                        
                       <div class="display-2"> Postal Automation System <div>
                           <div class="text-muted"style="font-size: 25px; margin-top:15px;">
                                Room No:306,Registrar Building,University of Dhaka.
                           </div>
                        
                        

                    </div>
                    </div>

            </div>

            <?php include BASE_URL."include/footer.php"; ?> 

    <!-- JS -->
    <?php include BASE_URL."include/script.php"; ?> 
  </body>
</html>