<?php

  include("../dbconnect.php");

  session_start();
  

  if(empty($_SESSION['admin_id']) && empty($_COOKIE['admin_id']))
  {

    header("Location: /spl/adminLogin.php");


  }
  
  
  
  
  if(isset($_POST['log_out']))
  {

    setcookie("admin_id","",time()-86400,'/');
    setcookie("password","",time()- 86400,'/');
    session_unset();
    session_destroy();
    $_SESSION = array();
    header("Location: /spl/adminLogin.php");


  }

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

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <link rel="icon" href=" ../favicon.ico" type="image/x-icon">

  <title>Admin Dashboard</title>

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>

 

  

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
          <i class="fas fa-user-shield"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="tables.php">
          <i class="fas fa-fw fa-envelope"></i>
          <span>Letters</span></a>
      </li>

      <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-user-tie"></i>
          <span>Manage Faculties</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">You can:</h6>
            <a class="collapse-item active" href="verify.php"><i class="fas fa-user-check"></i>
          <span> Verify Faculties</span></a>
          <a class="collapse-item" href="updateFaculty.php"><i class="fas fa-user-edit"></i>
          <span> Update Faculties</span></a>
          <a class="collapse-item" href="enrollFaculty.php"><i class="fas fa-user-edit"></i>
          <span> Add New Faculties</span></a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
          <i class="fas fa-user-tie"></i>
          <span>Manage Staff</span>
        </a>
        <div id="collapse3" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">You can:</h6>
            <a class="collapse-item" href="createStaff.php"><i class="fas fa-user-check"></i>
          <span> Create Staff Account</span></a>
          <a class="collapse-item" href="updateStaff.php"><i class="fas fa-user-edit"></i>
          <span> Update Staff Account</span></a>
          </div>
        </div>
      </li>

      

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

         

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                <img class="img-profile rounded-circle" src="admin.png">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <a id="logoutAdmin" class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800 text-center">Faculty Lists</h1>
          <p class="mb-4 text-center">See faculty lists to know which faculty is needed to be verified.</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary text-center">Faculties</h6>
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
                      <th>Status</th>
                    </tr>
                  </thead>

                  <tbody>
                      <?php
                      
                      

                      $tempQuery="
                      
                      SELECT * FROM `signed_teacher`
                      
                      
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

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
          <span>© 2020 Copyright:
                <a href="https://du.ac.bd"> University of Dhaka</a></span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <form method="POST"> 
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <button class="btn btn-primary" type="submit" name="log_out">Logout</button>
          </form>
          
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
