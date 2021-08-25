<?php 

include $_SERVER['DOCUMENT_ROOT'].'/spl/base_url.php';
include BASE_URL."dbconnect.php"; 

?>
<?php


    $sucess="";
    $error="";
    $errorFlag=0;

    if(isset($_POST['reset']))
    {
        
    
        
        if($_POST['staff_id'] == ""  || !is_numeric( $_POST['staff_id']) )
        
        {
            $errorFlag++;
            $error=$error."You need to provide a valid staff ID.<br>";

        }


        else if($_POST['password'] == "")
        
        {
            $errorFlag++;
            $error=$error."You need to provide a new password.<br>";

        }

        else if($_POST['password_conf'] == "")
        
        {
            $errorFlag++;
            $error=$error."You need to confirm the new password.<br>";

        }

        else if($_POST['password'] != $_POST['password_conf'])
        {
            $errorFlag++;
            $error=$error."Your confirmed password didn't match.<br>";
        }

       
        $id=mysqli_real_escape_string($link,$_POST['staff_id']);
        $password=md5(mysqli_real_escape_string($link,$_POST['password'])) ;
        
        $tempQuery='SELECT * FROM `staff` WHERE staff_id="'.$id.'"';
      
        $temp=mysqli_query($link,$tempQuery);
        
        if(mysqli_num_rows($temp) == 0)
        {
              $errorFlag++;
              $error=$error."This Staff ID is invalid / This Staff ID is not registered";
        }




        if($errorFlag == 0)

        {
            $query="

            UPDATE `staff`
            SET password='$password'
            WHERE staff_id=$id;
            
            ";

            $result=mysqli_query($link,$query);

            if($result)
            {
                $sucess=$sucess."The password reset has been successful.<br>";
            }
            
            



        }




    }





?>









<!DOCTYPE html>
<html lang="en">

<head>

  <?php include BASE_URL."adminLogin/include/head.php"; ?>  

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <?php include BASE_URL."adminLogin/include/sidebar.php"; ?> 

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <?php include BASE_URL."adminLogin/include/header.php"; ?> 

        <!-- Begin Page Content -->
        <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800 text-center">Reset Password</h1>
          <p class="mb-4 text-center">Reset password of a staff account if forgotten. </p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary text-center">Staff Account</h6>
            </div>

        <div class="container card-body" style="background-color:none ;">


    <div class="col-md-7 col-lg-6 ml-auto text-center">

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
            <img src="../logo.png" alt="" class="img-fluid mb-3 d-none d-md-block" style="margin-left:6rem;">
            <div class="display-4 text-center mb-3 mr-5 text-center" style="font-size:35px; margin-left:0.7em;">Reset Password</div>
            <p class="text-muted mb-0 mr-5 text-center" style="margin-left: 2.1em;">Only For General Staff</p>
        </div>

        <!-- Registration Form -->
        <div class="col-md-7 col-lg-6 ml-auto">
            <form action="#" method="POST">
                <div class="row">


                    <!-- Staff ID -->
                    
                    <div class="input-group col-lg-8 mx-auto mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                    <i class="fas fa-id-badge"></i>
                            </span>
                        </div>
                        <input id="staffId" type="text" name="staff_id" placeholder="Staff ID" class="form-control bg-white border-left-0 border-md">
                    </div>

                    

                    

                    <!-- Password -->
                    <div class="input-group col-lg-8 mx-auto mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-lock"></i>
                            </span>
                        </div>
                        <input id="password" type="password" name="password" placeholder="New Password" class="form-control bg-white border-left-0 border-md">
                    </div>
                    <!--Confirm Password -->
                    <div class="input-group col-lg-8 mx-auto mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-lock"></i>
                            </span>
                        </div>
                        <input id="passwordconf" type="password" name="password_conf" placeholder="Confirm New Password" class="form-control bg-white border-left-0 border-md">
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group col-lg-5 mx-auto mb-0" style="margin-top: 5px;">
                        <button type="submit" class="btn btn-primary btn-block py-2" name="reset">
                            <span class="font-weight-bold">Reset</span>
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

    <?php include BASE_URL."adminLogin/include/footer.php"; ?> 

    </div>

  </div>
 

  <?php include BASE_URL."adminLogin/include/script.php"; ?> 

</body>

</html>
