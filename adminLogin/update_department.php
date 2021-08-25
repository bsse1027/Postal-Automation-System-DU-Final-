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
     UPDATE `dept_table`
     SET dept_name='".$_POST['dept_name']."',
     faculty_id=".$_POST['faculty'].",
     email='".$_POST['email']."',
     chairman_id=".$_POST['tid']."
     WHERE dept_id=".$_POST['id']."";
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
      var dept_split = $("#dept").val().split("|");
      $("#id").val(dept_split[0]);
      $.ajax({
      type: "POST",
      url: "<?php echo SERVER_URL?>staffLogin/letters/book_teacher_ajax.php",
      
      data:'tid='+val,
      success: function(data){
        //alert(data);
          $("#teacher_name").html(data);

          department_details(val);
          //department_fac(val);
      }
      });
  }

  function department_details(val){
    $.ajax({
      type: "POST",
      url: "<?php echo SERVER_URL?>staffLogin/letters/department_ajax.php",
      
      data:'id='+val,
      success: function(data){
          //alert(data);
          var data_explode = data.split("###");
          $("#dept_name").val(data_explode[0]);
          $("#faculty").val(data_explode[1]);
          $("#email").val(data_explode[2]);
          if(data_explode[3]!=0){
            $("#teacher_name").val(data_explode[4]);
          }

          $("#tid").val(data_explode[3]);
          

          
      }
      });
  }

  function department_fac(val) {
      $.ajax({
      type: "POST",
      url: "<?php echo SERVER_URL?>staffLogin/letters/dep_fac_ajax.php",
      
      data:'id='+val,
      success: function(data){
        //alert(data);
          $("#teacher_name").html(data);

          department_details(val);
          department_fac(val);
      }
      });
  }

  function teacher_change(){
    var val = $("#teacher_name").val().split("|");
    $("#tid").val(val[0]);
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
          <h1 class="h3 mb-2 text-gray-800 text-center">Department Lists</h1>
          <p class="mb-4 text-center">Update Department.</p>

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
              <h6 class="m-0 font-weight-bold text-primary text-center">Departments</h6>
            </div>
            <form method='post' action='update_department.php'>
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
                <input type="text" name="dept_name" id="dept_name" class='form-control bg-white'>
                <br>

                <select name="faculty" id="faculty" class='form-control bg-white' style='font-size:13px;'>
                  <option value="">Select Faculty</option>
                  <?php
                    $sql="SELECT * FROM faculty_table";
                    $result=mysqli_query($link,$sql);
                    while($row=mysqli_fetch_array($result)) { 
                  ?>
                    <option value="<?php echo $row["id"]?>"><?php echo $row["name"]; ?>
                    </option>
                  <?php
                    }
                  ?>
                </select>
                <br>

                <select id="teacher_name" name="teacher_name" class='form-control bg-white' onchange="teacher_change()">
                    <option value="">Select Chairman Name</option>
                </select>
                
                <input type="hidden" name="tid" id="tid" class='form-control bg-white'>
                <input type="hidden" name="id" id="id" class='form-control bg-white'>
                <br>
                <input type="text" name="email" id="email" class='form-control bg-white'>
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


