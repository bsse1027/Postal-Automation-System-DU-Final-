<?php 

include $_SERVER['DOCUMENT_ROOT'].'/spl/base_url.php';
include BASE_URL."dbconnect.php"; 

?>
<?php

  
  if(isset($_GET['rid']))
  {
      $rid=$_GET['rid'];
      $tempQuery2="
      
      UPDATE `emails`
      SET reply='1'
      WHERE ref_number='$rid'
      LIMIT 1;
      
      ";

      

      mysqli_query($link,$tempQuery2);
      header('location:tables.php');
      
      
      
      

  }

  if(isset($_GET['uid']))
  {
      
      $uid=$_GET['uid'];

      $tempQuery2="
      
      UPDATE `emails`
      SET reply='0'
      WHERE ref_number='$uid'
      LIMIT 1;
      
      ";

      

      mysqli_query($link,$tempQuery2);
      header('location:tables.php');
      
      
      
      

  }






?>









<!DOCTYPE html>
<html lang="en">

<head>

  <?php include BASE_URL."facultyLogin/include/head.php"; ?> 

  

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php include BASE_URL."facultyLogin/include/sidebar.php"; ?> 
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php include BASE_URL."facultyLogin/include/header.php"; ?> 
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800 text-center">Letters</h1>
          <p class="mb-4 text-center">See all the letters that have been sent.</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary text-center">Letters</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0" style="font-size: 12px;">
                  <thead>
                    <tr>
                      <th>Reference number</th>
                      <th>Recipient</th>
                      <th>Sending Date</th>
                      <th>Subject</th>
                      <th>Body</th>
                      <th>Deadline</th>
                      <th>Status</th>
                      <th>Undo</th>
                    </tr>
                  </thead
                  
                  <tbody>
                      
                      <?php
                      
                      

                      $tempQuery1="
                      
                      SELECT * FROM `emails`
                      WHERE email = '$email'
                      
                      
                      ";

                      $result=mysqli_query($link,$tempQuery1);
                      while($row=mysqli_fetch_array($result))

                      {

                        
                        echo "<tr>
                        
                        <td>".$row['ref_number']."</td>
                        <td>".$row['recipient']."</td>
                        <td>".$row['send_date']."</td>
                        <td>".$row['subject']."</td>
                        <td> <a href='".$row['body']."'>Pdf</a></td>
                        <td>".$row['deadline']."</td>
                       
                        
                        ";

                        if($row['reply'] ==0)
                        {
                          
                          $ref_id=$row['ref_number'];
                          
                          $tempQuery111="
  
                              SELECT deadline FROM `emails`
                              WHERE ref_number='$ref_id' 
                              AND deadline<CURRENT_DATE();
                              
                              
                              ";
                      
                        $result111=mysqli_query($link,$tempQuery111);
                        $reachedDeadline=mysqli_num_rows($result111);

                        if($reachedDeadline>0)
                        {

                          echo "
                            
                          <td class='text-center text-danger'>

                              <strong>Deadline Reached!</strong>
                          
                          </td>
                          <td></td>
                          
                          ";
                          
                        }

                          else {

                            echo "<td class='x'>

                            
                            
                            
                            <a href='tables.php?rid=$ref_id' class='btn btn-danger text-center' style='font-size:13px;'>Confirm</a>
                            
                           

                            </td>
                            <td></td>";

                          }




                            
                          
                        
                          
                            
                            

                            

                           


                        }
                        else if($row['reply']==1)
                        {
                          $ref_id=$row['ref_number'];
                            echo "
                            
                            <td class='text-center text-success'>

                                <strong>Confirmed</strong>
                            
                            </td>

                            <td class='x'>

                            
                            
                            
                            <a href='tables.php?uid=$ref_id' class='btn btn-success text-center' style='font-size:13px;'>Undo</a>
                            
                           

                            </td>
                            
                            ";
                        }

                        else if($row['reply']==2)
                        {
                            echo "
                            
                            <td class='text-center text-success'>

                                <strong>Letter Sent</strong>
                            
                            </td>
                            <td></td>
                            
                            ";
                        }

                        

                        

                      }
                      
                      
                      
                      ?>
                      </tr>
                      
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Reference number</th>
                      <th>Recipient</th>
                      <th>Sending Date</th>
                      <th>Subject</th>
                      <th>Body</th>
                      <th>Deadline</th>
                      <th>Status</th>
                      <th>Undo</th>
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

      <!-- Footer -->
      <?php include BASE_URL."facultyLogin/include/footer.php"; ?> 
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  

  <?php include BASE_URL."facultyLogin/include/script.php"; ?> 

</body>

</html>
