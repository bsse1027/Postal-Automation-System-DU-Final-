<?php 

include $_SERVER['DOCUMENT_ROOT'].'/spl/base_url.php';
include BASE_URL."dbconnect.php"; 

?>
<?php
    
   
    session_start();

    
    $sucess="";
    $error="";
    $errorFlag=0;

    if (isset($_GET['email']) && isset($_GET['token']))
    
    {
        
        $email=$_GET['email'];
        $nowtime=time();
        $token=$_GET['token'];
        $tempQuery="

        SELECT tokenExpire 
        FROM `signed_teacher`
        WHERE token='$token'
        
        
        
        
        
        ";

        $expireCheck=mysqli_query($link,$tempQuery);
        $tempResult=mysqli_fetch_array($expireCheck);
        $expireTime=$tempResult['tokenExpire'];
        
        
        if($expireTime>$nowtime)
        
        {

            if(isset($_POST['reset_new']))
            {

                $email=mysqli_real_escape_string($link,$email);
            $newPass=mysqli_real_escape_string($link,$_POST['new_password']);
            $confirmPass=mysqli_real_escape_string($link,$_POST['confirm_password']);
            $finalpass=md5($newPass);

            if($newPass=="" || $confirmPass=="")
            {
                $errorFlag++;
                $error=$error."You cannot leave a field blank<br>";
            }

            else if($newPass != $confirmPass)

            {
                $errorFlag++;
                $error=$error."Your confirmed password didn't match<br>";

            }


            else if($errorFlag==0){

                $query="
                
                UPDATE `signed_teacher`
                SET password='$finalpass'
                WHERE email='$email'
                
                
                
                ";

                $result=mysqli_query($link,$query);

                if($result)
                
                {
                    $sucess=$sucess."Your Password has been reset<br>";
                    session_unset();
                    session_destroy();
                    $_SESSION = array();
                    header("Location:resetSuccessful.php");
                    exit();

                }




                }






            }

            





        }

        else{

            $error=$error."Your session has expired.<br>";
            header("Location:facultyLogin.php?expire=1");
            exit();



        }

        



    }

    else{

        header("Location:facultyLogin.php");
        exit();
    }





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


    <div class="error col-md-7 col-lg-6 ml-auto text-center">

    <?php


            if(!empty($error))
            {

                echo '
            
            <div class="alert alert-danger"><strong>'.$error.'</strong></div>
            
            ';

            }

            else if(!empty($sucess))
            {

                echo '
            
            <div class="alert alert-success"><strong>'.$sucess.'</strong></div>
            
            ';

            }


    ?>


    </div>
    <div class="row py-5 mt-4 align-items-center">
        
        <div class="col-md-5 pr-lg-5" style="margin-bottom: 6rem;">
            <img src="logo.png" alt="" class="img-fluid mb-3 d-none d-md-block" style="margin-left:6rem;">
            <div class="display-4 text-white text-center mx-4 mb-3 mr-5 text-center" style="font-size:30px;">Recover Password</div>
            <p class="white text-muted mx-3 mb-0 mr-5 text-center">Only For Teachers</p>
        </div>

        <!-- Registration Form -->
        <div class="col-md-7 col-lg-6 ml-auto">
            <form action="#" method="POST">
                <div class="row">


                    <!-- Password -->
                    <div class="input-group col-lg-8 mx-auto mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-lock text-muted"></i>
                            </span>
                        </div>
                        <input id="n_password" type="password" name="new_password" placeholder="New Password" class="form-control bg-white border-left-0 border-md">
                    </div>

                    <!-- Password -->
                    <div class="input-group col-lg-8 mx-auto mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-lock text-muted"></i>
                            </span>
                        </div>
                        <input id="c_password" type="password" name="confirm_password" placeholder="Confirm Password" class="form-control bg-white border-left-0 border-md">
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group col-lg-5 mx-auto mb-0" style="margin-top: 5px;">
                        <button type="submit" class="btn btn-primary btn-block py-2" name="reset_new">
                            <span class="font-weight-bold">Submit New Password</span>
                        </button>
                    </div>

                 

                   
                    

                </div>
            </form>
        </div>
    </div>
</div>
                


            </div>

                

<?php include BASE_URL."include/footer.php"; ?> 

<?php include BASE_URL."include/script.php"; ?> 
  
</body>

</html>