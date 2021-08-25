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
     UPDATE `teacher`
     SET t_name='".$_POST['t_name']."',
     email='".$_POST['email']."',
     designation='".$_POST['designation']."',
     mobile_no='".$_POST['mobile_no']."'
     WHERE id=".$_POST['tid']."";
    //echo'<pre>';print_r($query);exit;
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

  <script type="text/javascript">
    function department() {
      var val = $("#dept").val();
      $.ajax({
      type: "POST",
      url: "<?php echo SERVER_URL?>staffLogin/letters/book_teacher_ajax.php",
      
      data:'tid='+val,
      success: function(data){
        //alert(data);
          $("#teacher_name").html(data);
      }
      });
  }

  function teacher_change(){
    var val = $("#teacher_name").val();
      $.ajax({
      type: "POST",
      url: "<?php echo SERVER_URL?>staffLogin/letters/get_book_teacher_info_ajax.php",
      
      data:'tid='+val,
      success: function(data){
        //alert(data);
          var data_split = data.split("###");
          $("#tid").val(data_split[0]);
          $("#t_name").val(data_split[1]);
          $("#designation").val(data_split[2]);
          $("#email").val(data_split[3]);
          $("#mobile_no").val(data_split[4]);
      }
      });
  }


  </script>

</head>

<body id="page-top">
  <div id="wrapper">
    <?php include BASE_URL."adminLogin/include/sidebar.php"; ?> 

    <div id="content-wrapper" class="d-flex flex-column">

      <div id="content">
          <?php include BASE_URL."adminLogin/include/header.php"; ?> 
      </div>
      <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800 text-center">Teachers Lists</h1>
          <p class="mb-4 text-center">Update teacher informations.</p>

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
              <h6 class="m-0 font-weight-bold text-primary text-center">Teachers</h6>
            </div>
            <form method='post' action='update_book_teacher.php'>
                <div class="card-body">
                <select name="dept" id="dept" onchange="department()" class='form-control bg-white' style='font-size:13px;'>
                  <option value="">Select Department</option>
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
                <br>
                <select id="teacher_name" name="teacher_name" class='form-control bg-white' onchange="teacher_change()">
                    <option value="">Select Teacher's name</option>
                </select>
                
                <input type="hidden" name="tid" id="tid" class='form-control bg-white'>
                <br>
                <label>Teacher Name</label>
                <input type="text" name="t_name" id="t_name" class='form-control bg-white'>
                <br>
                <label>Teacher Designation</label>
                <input type="text" name="designation" id="designation" class='form-control bg-white'>
                <br>
                <label>Teacher Email</label>
                <input type="text" name="email" id="email" class='form-control bg-white'>
                <br>
                <label>Teacher Phone</label>
                <input type="text" name="mobile_no" id="mobile_no" class='form-control bg-white'>
                </div>
                
                <div align="center">
                  <button type='submit' name='update' class='btn btn-primary text-center' style='font-size:13px;'>Update</button>
                </div>
                <br>
            </form>
          </div>

        </div>

    <?php include BASE_URL."adminLogin/include/footer.php"; ?> 

  </div>

</div>
  
<?php include BASE_URL."adminLogin/include/script.php"; ?> 

</body>

</html>


