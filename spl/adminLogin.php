<?php 

include $_SERVER['DOCUMENT_ROOT'].'/spl/base_url.php';
include BASE_URL."dbconnect.php"; 

?>
<?php
    
    session_start();

    if(isset($_SESSION['admin_id']) || isset($_COOKIE['admin_id']))
    
    {

        header("Location: ".SERVER_URL."adminLogin.php");


    }



    
    $sucess="";
    $error="";
    $errorFlag=0;

    if (isset($_POST['log_in'])) {
        
        
        $id=mysqli_real_escape_string($link,$_POST['admin_id']);
        $logPassword=md5(mysqli_real_escape_string($link,$_POST['password']));

        $idQuery="
        
            SELECT * FROM `admin`
            WHERE admin_id='$id';
        
        
        ";

        $passQuery="
        
            SELECT * FROM `admin`
            WHERE password='$logPassword'
            AND admin_id='$id'
            ;
        
        
        ";

        $idAunthenticate=mysqli_query($link,$idQuery);
        $passwordAunthenticate=mysqli_query($link,$passQuery);

        $result1 = mysqli_num_rows($idAunthenticate);
        $result2=mysqli_num_rows($passwordAunthenticate);



        if($result1 == 1 && $result2 == 1)
        {

            
            if($_POST['check'])
            {

                setcookie("admin_id","$id",time()+86400*30,"/");
                setcookie("password","$logPassword",time()+ 86400*30,"/");

            }
            
            while($row=mysqli_fetch_array($passwordAunthenticate)) {

                 $_SESSION['name'] = "Admin";
    
            }
            
            
            $_SESSION['admin_id']=$id;
            $_SESSION['password']=$logPassword;
            header("Location: ".SERVER_URL."adminLogin");

        }

        else if( $result1 == 0){

            $error=$error. "The ID doesn't exist.<br>";

        }

        else if( $result2 == 0){

            $error=$error. "The password is wrong.Please try again.<br>";

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
        
        <div class="col-md-5 pr-lg-5" style="margin-bottom: 1rem;">
            <img src="logo.png" alt="" class="img-fluid mb-3 d-none d-md-block" style="margin-left:6rem;">
            <div class="display-4 text-white text-center mb-3 mr-5 text-center" style="font-size:50px; margin-left:0.7em;">Login</div>
            <p class="white text-muted mb-0 mr-5 text-center" style="margin-left: 2.1em;">Only For Admin</p>
        </div>

        <!-- Registration Form -->
        <div class="col-md-7 col-lg-6 ml-auto">
            <form action="#" method="POST">
                <div class="row">


                    <!-- Admin ID -->
                    
                    <div class="input-group col-lg-8 mx-auto mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                    <i class="fas fa-id-badge text-muted"></i>
                            </span>
                        </div>
                        <input id="adminId" type="text" name="admin_id" placeholder="Admin ID" class="form-control bg-white border-left-0 border-md">
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