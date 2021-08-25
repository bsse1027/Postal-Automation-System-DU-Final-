<?php 

include $_SERVER['DOCUMENT_ROOT'].'/spl/base_url.php';
include BASE_URL."dbconnect.php"; 

?>
<?php

  if(isset($_GET['tid']))
  {
    $tid=$_GET['tid'];
    $tempQuery2="

    UPDATE `signed_teacher`
    SET status=1
    WHERE teacher_id=$tid
    LIMIT 1;

    ";



    mysqli_query($link,$tempQuery2);
    header('location:verify.php');

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
          <h1 class="h3 mb-2 text-gray-800 text-center">Teachers Lists</h1>
          <p class="mb-4 text-center">See teacher lists to know which teacher is needed to be verified.</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary text-center">Teachers</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0" style="font-size: 13px;">
                  <thead>
                    <tr>
                      <th>Teacher ID</th>
                      <th>Name(English)</th>
                      <th>Name(Bangla)</th>
                      <th>Department/Institute</th>
                      <th>Designation</th>
                      <th>Email address</th>
                      <th>Phone Number</th>
                      <th class="sorting_asc">Status</th>
                    </tr>
                  </thead>

                  <tbody>
                      <?php
                      
                      

                      $tempQuery="
                      
                      SELECT * FROM `signed_teacher` ORDER BY STATUS ASC
                      
                      
                      ";

                      $result=mysqli_query($link,$tempQuery);
                      while($row=mysqli_fetch_array($result))

                      {

                        
                        echo "<tr>
                        
                        <td>".$row['teacher_id']."</td>
                        <td>".$row['nameEng']."</td>
                        <td>".$row['nameBang']."</td>
                        <td>".$row['dept']."</td>
                        <td>".$row['designation']."</td>
                        <td>".$row['email']."</td>
                        <td>".$row['phone']."</td>
                       
                        
                        ";

                        if($row['status'] ==0)
                        {
                            
                            
                          $tid=$row['teacher_id'];
                        
                          echo "<td class='x'>

                            
                            
                            
                            <a href='verify.php?tid=$tid' class='btn btn-danger text-center' style='font-size:13px;'>Verify</a>
                            
                           

                            </td>";
                            
                            

                            

                           


                        }
                        else if($row['status']==1)
                        {
                            echo "
                            
                            <td class='text-center text-success'>

                                <strong>Verified</strong>
                            
                            </td>
                            
                            ";
                        }

                        $tid='';

                      }
                      
                      
                      
                      ?>
                      </tr>
                      
                  </tbody>

                  <tfoot>
                    <tr>
                    <th>Teacher ID</th>
                      <th>Name(English)</th>
                      <th>Name(Bangla)</th>
                      <th>Department/Institute</th>
                      <th>Designation</th>
                      <th>Email address</th>
                      <th>Phone Number</th>
                      <th>Status</th>
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
