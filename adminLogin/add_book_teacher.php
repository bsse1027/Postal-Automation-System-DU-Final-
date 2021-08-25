<?php 

include $_SERVER['DOCUMENT_ROOT'].'/spl/base_url.php';
include BASE_URL."dbconnect.php"; 

?>
<?php
  $error="";
  $errorFlag=0;

  if(isset($_POST['add']))
  {
    $dept_id = "";
    $department = "";
    if($_POST['dept']!=""){
      $dept_explode =explode("|", $_POST['dept']);
      $dept_id =$dept_explode[0];
      $department =$dept_explode[1];
    }
    

    $t_name=$_POST['t_name'];
    $email=$_POST['email'];
    $designation=$_POST['designation'];
    $phone=$_POST['mobile_no'];

    if($t_name == "")
    
    {

        $errorFlag++;
        $error=$error."You need to provide Name.";

    }



    else if($dept_id == "")
    
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

    if($errorFlag==0)
    {
      $anotherQuery="
      INSERT INTO `teacher`(`t_name`, `email`, `mobile_no`, `department`, `designation`,`tid`) VALUES ('$t_name','$email','$phone','$department','$designation','$dept_id')
      ";
      //echo'<pre>';print_r($anotherQuery);exit;
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
              <h6 class="m-0 font-weight-bold text-primary text-center">Add new teacher</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0" style="font-size: 13px;">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Department/Institute</th>
                      <th>Designation</th>
                      <th>Email address</th>
                      <th>Phone Number</th>
                      <th></th>
                      
                    </tr>
                  </thead>

                  <tbody>
                    <tr>
                      <form method='post' action='add_book_teacher.php'>
                      <td><input name='t_name' type='text'></td>
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
                      <td><input name='mobile_no' type='text'></td>
                    

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
                      <th>Name</th>
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
  <script type="text/javascript">
    $('#dataTable').dataTable({searching: false, paging: false, info: false});
  </script>

</body>

</html>
