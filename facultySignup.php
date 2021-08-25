<?php 

include $_SERVER['DOCUMENT_ROOT'].'/spl/base_url.php';
include BASE_URL."dbconnect.php"; 

?>
<?php

class BanglaConverter {
    public static $bn = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
    public static $en = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
    
    
    public static function bn2en($number) {
        return str_replace(self::$bn, self::$en, $number);
    }
    
    public static function en2bn($number) {
        return str_replace(self::$en, self::$bn, $number);
    }


 }
    


    
    $sucess="";
    $error="";
    $errorFlag=0;
    $pattern="/.du.ac.bd/i";
    $num=mt_rand(10000000,99999999);
    $intro_msg=0;

    if(isset($_POST['create']))
    {
        $intro_msg=1;
        if($_POST['firstname_english'] == "")
        
        {

            $errorFlag++;
            $error=$error."You need to provide your name in English.<br>";

        }
    
        else if($_POST['firstname_bangla'] == "")
        
        {
            $errorFlag++;
            $error=$error."You need to provide your name in Bangla.<br>";

        }
        // else if($_POST['teacher_id'] == ""  || !is_numeric( $_POST['teacher_id']) )
        
        // {
        //     $errorFlag++;
        //     $error=$error."You need to provide your valid teacher ID.<br>";

        // }


        else if($_POST['dept_name'] == "")
        
        {
            $errorFlag++;
            $error=$error."You need to provide your insitution/department name.<br>";

        }

        else if($_POST['designation'] == "")
        
        {
            $errorFlag++;
            $error=$error."You need to provide your Designation.<br>";

        }
        else if($_POST['email'] == "")
        
        {
            $errorFlag++;
            $error=$error."You need to provide your valid email address.<br>";

        }

        else if($_POST['phone'] == "")
        
        {
            $errorFlag++;
            $error=$error."You need to provide your active phone number.<br>";

        }

        else if($_POST['password'] == "")
        
        {
            $errorFlag++;
            $error=$error."You need to provide a password.<br>";

        }

        else if($_POST['passwordConfirmation'] == "")
        
        {
            $errorFlag++;
            $error=$error."You need to confirm your password.<br>";

        }

        else if($_POST['password'] != $_POST['passwordConfirmation'])
        {
            $errorFlag++;
            $error=$error."Your confirmed password didn't match.<br>";
        }

        else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errorFlag++;
            $error=$error."Invalid email address.<br>";
         }

         else if(preg_match($pattern,$_POST['email'])==0)
         {
             $errorFlag++;
             $error=$error."du.ac.bd email is needed";
         }

         $dept_id=mysqli_real_escape_string($link,$_POST['dept_name']);
         $tempQuery='SELECT * 
         FROM `dept_table`
         WHERE dept_id="'.$dept_id.'"
         
         
         ';
         $temp=mysqli_query($link,$tempQuery);
         $angry=mysqli_fetch_array($temp);
         $deptErNam=$angry['dept_name'];
         //$dept_id= $angry['dept_id'];

        

        $email=mysqli_real_escape_string($link,$_POST['email']);
        $firstname=mysqli_real_escape_string($link,$_POST['firstname_english']);
        $lastname=mysqli_real_escape_string($link,$_POST['firstname_bangla']);
        $id=$num;
        $dept=$deptErNam;
        $phone=mysqli_real_escape_string($link,$_POST['phone']);
        $banglaPhone = BanglaConverter::en2bn($phone);
        $password=md5(mysqli_real_escape_string($link,$_POST['password'])) ;
        $designation=mysqli_real_escape_string($link,$_POST['designation']);


        $tempQuery='SELECT * FROM `signed_teacher` WHERE email="'.$email.'"';
      
        $temp=mysqli_query($link,$tempQuery);
        
        if(mysqli_num_rows($temp) > 0)
        {
              $errorFlag++;
              $error=$error."You are already registered. <br>";
        }

        $tempQuery='SELECT * FROM `signed_teacher` WHERE teacher_id="'.$id.'"';
      
        $temp=mysqli_query($link,$tempQuery);
        
         if(mysqli_num_rows($temp) > 0)
         {
               $errorFlag++;
               $error=$error."Some Error occurred. Please Try Again.<br>";
         }

        
         $tempQuery='SELECT * FROM `teacher` WHERE email="'.$email.'"';
         $temp=mysqli_query($link,$tempQuery);
         $shouldAddAsNew=mysqli_num_rows($temp);





        if($errorFlag == 0)

        {
            $query="

            INSERT INTO `signed_teacher` (`teacher_id`,`nameEng`, `nameBang`, `dept`, `dept_id`,`designation`, `email`, `phone`, `password`) VALUES ('$id','$firstname', '$lastname', '$dept','$dept_id','$designation', '$email', '$phone', '$password')
            LIMIT 1
            
            ";

            if($shouldAddAsNew == 0)
            {
                $anotherQuery="
                INSERT INTO `teacher`(`t_name`, `email`, `mobile_no`, `department`, `designation`,`tid`) VALUES ('$lastname','$email','$banglaPhone','$deptErNam','$designation','$dept_id')
                ";
                $anotherResult=mysqli_query($link,$anotherQuery);
            }

            $result=mysqli_query($link,$query);
            

            

            if($result)
            {
                $sucess=$sucess."Thanks!Your account has been successfully created.<br> Please wait for 1-2 days to get your account verified by an Official Admin. You will be contacted through mobile soon.";
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


            if($intro_msg == 0)
            {
                echo '
            
            <div class="alert alert-success"><strong> Please use your valid **@du.ac.bd Email ID For Registration. <br> If you do not have an official **@du.ac.bd email ID, Please contact with ICT Cell Director for a new email ID.</strong></div>
            
            ';

            }
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
            <div class="display-4 text-white text-center" style="font-size:50px;">Create an Account</div>
            <p class="white text-muted mb-0 mr-5 text-center" style="margin-left: 2.1em;">Only For Teachers</p>
        </div>

        <!-- Registration Form -->
        <div class="col-md-7 col-lg-6 ml-auto">
            <form action="#" method="POST">
                <div class="row">

                    <!-- First Name -->
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-user text-muted"></i>
                            </span>
                        </div>
                        <input required id="firstName" type="text" name="firstname_english" placeholder="Name (English)" class="form-control bg-white border-left-0 border-md">
                    </div>

                    <!-- First Name(in Bangla) -->
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-user text-muted"></i>
                            </span>
                        </div>
                        <input required id="firstName" type="text" name="firstname_bangla" placeholder="নাম (বাংলা) " class="form-control bg-white border-left-0 border-md">
                    </div>

                    <!-- Teacher ID -->
                    
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                    <i class="fas fa-id-badge text-muted"></i>
                            </span>
                        </div>
                        <input id="teacherId" type="text" name="teacher_id" placeholder="<?php echo $num ?>" class="form-control bg-white border-left-0 border-md" disabled>
                    </div>


                    <!-- Designation -->
                    
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                    <i class="fas fa-user-tie text-muted"></i>
                            </span>
                        </div>
                        <select required id="desig" name="designation" class="custom-select form-control bg-white border-left-0 border-md h-100 font-weight-bold text-muted">
                            <option value="" hidden selected>Designation</option>
                            <option value="প্রভাষক">Lecturer</option>
                            <option value="সহকারী অধ্যাপক">Assistant Professor</option>
                            <option value="সহযোগী অধ্যাপক">Associate Professor</option>
                            <option value="অধ্যাপক">Professor</option>
                        </select>
                    </div>

                    <!-- Institue/Dept -->
                    
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                    <i class="fas fa-university text-muted"></i>
                            </span>
                        </div>
                        <select required name="dept_name" id="dept" onchange="department()" class='form-control bg-white' style='font-size:13px;'>
                          <option value="">Select Department</option>
                          <?php
                            $sql="SELECT DISTINCT dept_name,dept_id FROM dept_table";
                            $result=mysqli_query($link,$sql);
                            while($row=mysqli_fetch_array($result)) { 
                          ?>
                            <option value="<?php echo $row["dept_id"]?>"><?php echo $row["dept_name"]; ?>
                            </option>
                          <?php
                            }
                          ?>
                        </select>
                        
                    </div>

                    <!-- Email Address -->
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-envelope text-muted"></i>
                            </span>
                        </div>
                        <input required id="email" type="email" name="email" placeholder="Email Address" class="form-control bg-white border-left-0 border-md">
                    </div>

                    <!-- Phone Number -->
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-phone-square text-muted"></i>
                            </span>
                        </div>
                        <select id="countryCode" name="countryCode" style="max-width: 80px" class="custom-select form-control bg-white border-left-0 border-md h-100 font-weight-bold text-muted">
                            <option value="">+880</option>
                        </select>
                        <input required id="phoneNumber" type="tel" name="phone" maxlength="10" placeholder="Phone Number" class="form-control bg-white border-md border-left-0 pl-3">
                    </div>

                    

                    

                    <!-- Password -->
                    <div class="input-group col-lg-6 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-lock text-muted"></i>
                            </span>
                        </div>
                        <input required id="password" type="password" name="password" placeholder="Password" class="form-control bg-white border-left-0 border-md">
                    </div>



                    <!-- Password Confirmation -->
                    <div class="input-group col-lg-6 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-lock text-muted"></i>
                            </span>
                        </div>
                        <input required id="passwordConfirmation" type="password" name="passwordConfirmation" placeholder="Confirm Password" class="form-control bg-white border-left-0 border-md">
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group col-lg-12 mx-auto mb-0">
                        <button type="submit" class="btn btn-primary btn-block py-2" name="create">
                            <span class="font-weight-bold">Create your account</span>
                        </button>
                    </div>

                    <!-- Divider Text -->
                    <div class="form-group col-lg-12 mx-auto d-flex align-items-center my-4">
                        <div class="border-bottom w-100 ml-5"></div>
                        <span class="px-2 small text-muted font-weight-bold text-muted">OR</span>
                        <div class="border-bottom w-100 mr-5"></div>
                    </div>

                    <!-- Already Registered -->
                    <div class="text-center w-100">
                        <p class="text-muted font-weight-bold">Already Registered? <a href="facultyLogin.php" class="text-primary ml-2">Login</a></p>
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