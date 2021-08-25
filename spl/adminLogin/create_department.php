<?php 

include $_SERVER['DOCUMENT_ROOT'].'/spl/base_url.php';
include BASE_URL."dbconnect.php"; 

?>
<?php
  $error="";
  $errorFlag=0;

  if(isset($_POST['add']))
  {
    $name=$_POST['name'];

    if($name == "")
    
    {

        $errorFlag++;
        $error=$error."You need to provide Name.";

    }
   


   

    if($errorFlag==0)
    {
      $anotherQuery="
      INSERT INTO `dept_table`(`name`) VALUES ('$name')
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
          <h1 class="h3 mb-2 text-gray-800 text-center">Add a new Department</h1>
          <p class="mb-4 text-center">Add a Department.</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary text-center">Add new Department</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0" style="font-size: 13px;">
                  <thead>
                    <tr>
                      <th>Department/Institute Name</th>
                      <th></th>
                      
                    </tr>
                  </thead>

                  <tbody>
                    <tr>
                      <form method='post' action='create_department.php'>
                      <td><input class="form-control" name='name' type='text'></td>
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
                      <th>Department/Institute Name</th>
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
