<?php 

include $_SERVER['DOCUMENT_ROOT'].'/spl/base_url.php';
include BASE_URL."dbconnect.php"; 

?>
<?php
  $error="";
  $errorFlag=0;
  $num=mt_rand(10000000,99999999);

  if(isset($_POST['add']))
  {
    $dept_id=mysqli_real_escape_string($link,$_POST['dept']);
         $tempQuery='SELECT * 
         FROM `dept_table`
         WHERE dept_id="'.$dept_id.'"
         
         
         ';
         $temp=mysqli_query($link,$tempQuery);
         $angry=mysqli_fetch_array($temp);
         $deptErNam=$angry['dept_name'];
    //$tid=$num;
    $nameEng=$_POST['name_eng'];
    $nameBang=$_POST['name_bang'];
    $email=$_POST['email'];
    $dept=$deptErNam;
    $designation=$_POST['designation'];
    $phone=$_POST['phone'];

    if($nameEng == "")
        
        {

            $errorFlag++;
            $error=$error."You need to provide name in English.";

        }
    
        else if($nameBang == "")
        
        {
            $errorFlag++;
            $error=$error."You need to provide name in Bangla.";

        }
        // else if($tid == ""  || !is_numeric( $tid) )
        
        // {
        //     $errorFlag++;
        //     $error=$error."You need to provide a valid teacher ID.";

        // }


        else if($dept == "")
        
        {
            $errorFlag++;
            $error=$error."You need to provide insitution/department name.";

        }

        else if($designation== "")
        
        {
            $errorFlag++;
            $error=$error."You need to provide valid Designation.";

        }
        else if($email == "")
        
        {
            $errorFlag++;
            $error=$error."You need to provide a valid email address.";

        }

        else if($phone == "")
        
        {
            $errorFlag++;
            $error=$error."You need to provide an active phone number.";

        }

        

        else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorFlag++;
            $error=$error."Invalid email address.\n";
         }


        $tempQuery='SELECT * FROM `teacher` WHERE email="'.$email.'"';
      
        $temp=mysqli_query($link,$tempQuery);
        
        if(mysqli_num_rows($temp) > 0)
        {
              $errorFlag++;
              $error=$error."This email is already taken.";
        }

        // $tempQuery='SELECT * FROM `allfaculty` WHERE teacher_id="'.$tid.'"';
      
        // $temp=mysqli_query($link,$tempQuery);
        
        // if(mysqli_num_rows($temp) > 0)
        // {
        //       $errorFlag++;
        //       $error=$error."This teacher already exists.";
        // }

        if($errorFlag==0)
        {
          $anotherQuery="
          INSERT INTO `teacher`(`t_name`, `email`, `mobile_no`, `department`, `designation`,`tid`) VALUES ('$nameBang','$email','$phone','$dept','$designation','$dept_id')
          ";
          $anotherResult=mysqli_query($link,$anotherQuery);

        }

    
    
  }






?>

<!DOCTYPE html>
<html lang="en">

<head>

  <?php include BASE_URL."adminLogin/include/head.php"; ?> 

 <?php
 
 if(!empty($error))
 {
    echo '
 
    <script>
    
    alert("'.$error.'")
    
    
    </script>';

 }
 
 
 
 ?>
            
      
  

</head>

<body id="page-top">
  <div id="wrapper">
     <?php include BASE_URL."adminLogin/include/sidebar.php"; ?> 

    <div id="content-wrapper" class="d-flex flex-column">

      <div id="content">

        <?php include BASE_URL."adminLogin/include/header.php"; ?> 


        <!-- Begin Page Content -->
        <div class="container-fluid">


        

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800 text-center">Add a new Teacher</h1>
          <p class="mb-4 text-center">Add a newly enorolled teachers information to our existing database.</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary text-center">Add new Teacher</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0" style="font-size: 13px;">
                  <thead>
                    <tr>
                      <th>Name(English)</th>
                      <th>Name(Bangla)</th>
                      <th>Department/Institute</th>
                      <th>Designation</th>
                      <th>Email address</th>
                      <th>Phone Number</th>
                      <th></th>
                      
                    </tr>
                  </thead>

                  <tbody>
                    <tr>
                      <td><input name='name_eng' type='text'></td>
                      <td><input name='name_bang' type='text'></td>
                      <td>
                        <select name="dept" id="dept" class='form-control bg-white' style='font-size:13px;'>
                          <option value="">Select department</option>
                          <?php
                            $sql="SELECT DISTINCT dept_name,dept_id FROM dept_table";
                            $result=mysqli_query($link,$sql);
                            while($row=mysqli_fetch_array($result)) { 
                          ?>
                            <option value="<?php echo $row["dept_id"]."|".$row["dept_name"]; ?>"><?php echo $row["dept_name"]; ?>
                            </option>
                          <?php
                            }
                          ?>
                        </select>
                      </td>
                      <td>
                        <select id='desig' name='designation' class='form-control bg-white' style='font-size:13px;'>
                          <option value='' hidden selected></option>
                          <option value='প্রভাষক'>প্রভাষক </option>
                          <option value='সহকারী অধ্যাপক'>সহকারী অধ্যাপক</option>
                          <option value='সহযোগী অধ্যাপক'>সহযোগী অধ্যাপক</option>
                          <option value='অধ্যাপক'>অধ্যাপক</option>
                        </select> 
                      </td>
                      <td><input name='email' type='email'></td>
                      <td><input name='phone' type='text'></td>
                    

                      <?php                       

                        echo "
                        
                        <td>

                        <button type='submit' name='add' class='btn btn-primary text-center' style='font-size:13px;'>Add</button>

                        
                        
                        </td>
                        </form>
                        
                        
                        ";
                        ?>
                      </tr>
                      
                  </tbody>

                  <tfoot>
                    <tr>
                      <th>Name(English)</th>
                      <th>Name(Bangla)</th>
                      <th>Department/Institute</th>
                      <th>Designation</th>
                      <th>Email address</th>
                      <th>Phone Number</th>
                      <th></th>
                    </tr>
                  </tfoot>
                </table>
              </div>
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
