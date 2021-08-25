<?php


  session_start();
  

  if(empty($_SESSION['email']) && empty($_COOKIE['email']))
  {

    header("Location: ".SERVER_URL."facultyLogin.php");

  }
  
  
  
  
  if(isset($_POST['log_out']))
  {

    setcookie("email","",time()-86400,'/');
    setcookie("password","",time()- 86400,'/');
    session_unset();
    session_destroy();
    $_SESSION = array();
    header("Location: ".SERVER_URL."facultyLogin.php");


  }

  if(!empty($_SESSION['email']))
  {

    $email=$_SESSION['email'];
    $password=$_SESSION['password'];


  }

  if(!empty($_COOKIE['email']))
  {

    $email=$_COOKIE['email'];
    $password=$_COOKIE['password'];


  }


?>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<link rel="icon" href="<?php echo SERVER_URL?>resources/img/favicon.ico" type="image/x-icon">

	<title>Faculty Dashboard</title>

	<!-- Custom fonts for this template -->
	<link href="<?php echo SERVER_URL?>resources/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="<?php echo SERVER_URL?>resources/css/sb-admin-2.min.css" rel="stylesheet">

	<!-- Custom styles for this page -->
	<link href="<?php echo SERVER_URL?>resources/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>


	