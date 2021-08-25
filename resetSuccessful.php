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

            background: none;

        } 


    </style>
  </head>
  
  <body>

       
            
            
            
            
<div class="container">




    <div class="container" style="margin-top:10rem;">


    
    <div class="row py-5 mt-4 align-items-center">
        
        <div class="col-md-5 pr-lg-5" style="margin-bottom: 6rem;">
            <img src="logo.png" alt="" class="img-fluid mb-3 d-none d-md-block" style="margin-left:6rem;">
            <div class="display-4 text-white text-center mx-4 mb-3 mr-5 text-center" style="font-size:30px;">Recover Password</div>
            <p class="white text-muted mx-3 mb-0 mr-5 text-center">Only For Teachers</p>
        </div>

        <div class="col-md-5 pr-lg-5" style="margin-bottom: 20rem; margin-left:40px;">
            
            <div class="error">

                        <div class="alert alert-success text-center">


                                <Strong>
                                    
                                    Your password has been reset successfully.<br>
                                    Click <a href="facultyLogin.php">here</a> to Login.
                            
                                </Strong>


                        </div>


            </div>
        </div>
    </div>
</div>
                


            </div>

                


 <?php include BASE_URL."include/footer.php"; ?> 

<?php include BASE_URL."include/script.php"; ?> 
  
</body>

</html>