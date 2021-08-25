<?php 

include $_SERVER['DOCUMENT_ROOT'].'/spl/base_url.php';
include BASE_URL."dbconnect.php"; 

?>
<?php
    

    
    $sucess="";
    $error="";
    $errorFlag=0;


    if(isset($_GET['expire']) && $_GET['expire']==1){

        $error=$error."Your session has been expired";

    }

    if (isset($_POST['log_in'])) {

        $email=mysqli_real_escape_string($link,$_POST['email']);
        $logPassword=md5(mysqli_real_escape_string($link,$_POST['password']));

        

        $emailQuery="
        
            SELECT * FROM `signed_teacher`
            WHERE email='$email';
        
        
        ";

        $passQuery="
        
            SELECT * FROM `signed_teacher`
            WHERE password='$logPassword'
            AND email='$email'
            ;
        
        
        ";

        $emailAunthenticate=mysqli_query($link,$emailQuery);
        $passwordAunthenticate=mysqli_query($link,$passQuery);

        $result1 = mysqli_num_rows($emailAunthenticate);
        $result2=mysqli_num_rows($passwordAunthenticate);

        if( $result1 == 0){

            
                $error=$error. "The ID doesn't exist.<br>";
            

        }

        else if( $result2 == 0){

            
                $error=$error. "The password is wrong.Please try again.<br>";
            

        }



        else if($result1 == 1 && $result2 == 1)
        {

            $statusQuery="
    
                SELECT status FROM `signed_teacher`
                WHERE email='$email';
                
                ";
            
                $resultStat=mysqli_query($link,$statusQuery);
                $row=mysqli_fetch_array($resultStat);
            
                if($row['status'] == 0)
                {
            
                    $error=$error."You are not verified yet.<br>";
                    $errorFlag++;
            
            
                } 


                if($errorFlag==0)
                {
                    session_start();
                    if($_POST['check'])
                    {

                        setcookie("email","$email",time()+86400*30,"/");
                        setcookie("password","$logPassword",time()+ 86400*30,"/");

                    }

                    while($row=mysqli_fetch_array($passwordAunthenticate)) {

                         $_SESSION['name'] = $row["nameBang"];
            
                    }
                    
                    
                    
                    $_SESSION['email']=$email;
                    $_SESSION['password']=$logPassword;
                    header("Location:facultyLogin");

                }
            

        }

        



    }





?>






<!DOCTYPE html>
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

    <?php include BASE_URL."include/header.php"; ?> 

            
            
            
            
            
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
            <div class="display-4 text-white text-center mb-3 mr-5 text-center" style="font-size:50px; margin-left:0.7em;">Login</div>
            <p class="white text-muted mb-0 mr-5 text-center" style="margin-left: 2.1em;">Only For Teachers</p>
        </div>

        <!-- Registration Form -->
        <div class="col-md-7 col-lg-6 ml-auto">
            <form action="#" method="POST">
                <div class="row">


                    <!-- Email -->
                    
                    <div class="input-group col-lg-8 mx-auto mb-4">
                        <div class="input-group-prepend">
                                <span class="input-group-text bg-white px-4 border-md border-right-0">
                                    <i class="fa fa-envelope text-muted"></i>
                                </span>
                            </div>
                            <input id="email" type="email" name="email" placeholder="Email Address" class="form-control bg-white border-left-0 border-md">
                    </div>

                    

                    

                    <!-- Password -->
                    <div class="input-group col-lg-8 mx-auto mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-lock text-muted"></i>
                            </span>
                        </div>
                        <input id="password" type="password" name="password" placeholder="Password" class="form-control bg-white border-left-0 border-md">
                    </div>

                    <div class="form-group text-center col-lg-8 mx-auto mb-4">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="check">
                        <label class="form-check-label text-white" for="exampleCheck1">Keep me logged in</label>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group col-lg-5 mx-auto mb-0" style="margin-top: 5px;">
                        <button type="submit" class="btn btn-primary btn-block py-2" name="log_in">
                            <span class="font-weight-bold">Login</span>
                        </button>
                    </div>

                    <!-- Divider Text -->
                    <div class="form-group col-lg-12 mx-auto d-flex align-items-center my-4">
                        <div class="border-bottom w-100 ml-5"></div>
                        <span class="px-2 small text-muted font-weight-bold text-muted">OR</span>
                        <div class="border-bottom w-100 mr-5"></div>
                    </div>

                    <!-- Not Registered -->
                    <div class="text-center w-100">
                        <p class="text-muted font-weight-bold">Not Registered? <a href="facultySignup.php" class="text-primary ml-2">Sign up</a></p>
                    </div>

                    <!-- Forgot Password -->

                    <div class="text-center w-100">
                        <p class="text-muted font-weight-bold">Forgot Password? <a href="forgotPassword.php" class="text-primary ml-2">Click here</a></p>
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