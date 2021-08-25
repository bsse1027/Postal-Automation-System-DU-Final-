<?php 

include $_SERVER['DOCUMENT_ROOT'].'/spl/base_url.php';
include BASE_URL."dbconnect.php"; 

?>
<?php

  $sucess="";
  $error="";
  $errorFlag=0;

  if(isset($_POST['update']))
  {
    $query="
     UPDATE `staff`
     SET staffName='".$_POST['staffName']."',
     StaffPhone='".$_POST['StaffPhone']."'
     WHERE staff_id='".$_POST['staff_id']."';
    
    ";
    //echo '<pre>';print_r($query);exit;
    $result = mysqli_query($link,$query);

    if($result)
    {
        $sucess=$sucess."Updated.<br>";
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
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <?php include BASE_URL."adminLogin/include/header.php"; ?> 

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800 text-center">Staff Lists</h1>
          <p class="mb-4 text-center">See staff lists to know which staff is needed to be verified.</p>

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

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary text-center">Stuff</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0" style="font-size: 13px;">
                  <thead>
                    <tr>
                      <th>SL</th>
                      <th>Name</th>
                      <th>Phone Number</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                
                  <tbody>
                      <?php
                      
                      

                      $tempQuery="
                      
                      SELECT * FROM `staff` ORDER BY staff_id ASC
                      
                      
                      ";
                      $i=1;
                      $result=mysqli_query($link,$tempQuery);
                      while($row=mysqli_fetch_array($result))

                      {
                        
                        ?>

                        <tr>
                          <form method='post' action='updateStaffAccount.php'>
                            <input name='staff_id' type='hidden' value="<?php echo $row['staff_id']?>">
                          <td><?php echo $i ?></td>
                          <td><input name='staffName' type='text' value="<?php echo $row['staffName']?>"></td>
                          <td><input name='StaffPhone' type='text' value="<?php echo $row['StaffPhone']?>"></td>
                          <td><button type='submit' name='update' class='btn btn-primary text-center' style='font-size:13px;'>Update</button></td>
                          </form>
                        </tr>

                        <?php
                        $i++;

                      }
                      
                      ?>
                     
                      
                  </tbody>
                
                  <tfoot>
                    <tr>
                      <th>Sl</th>
                      <th>Name</th>
                      <th>Phone Number</th>
                      <th>Action</th>
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
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <?php include BASE_URL."adminLogin/include/script.php"; ?> 

  <script type="text/javascript">
    $('#dataTable').dataTable( {
        "order": [],
        // Your other options here...
    } );
  </script>

</body>

</html>
