<?php 

include $_SERVER['DOCUMENT_ROOT'].'/spl/base_url.php';
include BASE_URL."dbconnect.php"; 

?>

<!DOCTYPE html>
<html>
<head>
	<title>Envelope</title>
	<link rel="stylesheet" href="<?php echo SERVER_URL?>resources/css/committee.css">
  	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

  	<script type="text/javascript">
  			
  		function department() {
            var val = $("#dept").val();
            $.ajax({
            type: "POST",
            url: "ajax4.php",
            
            data:'tid='+val,
            success: function(data){
                $("#teacher_name").html(data);
            }
            });
        }

        function designation(){
          var val = $("#teacher_name").val();
          $.ajax({
          type: "POST",
          url: "ajax3.php",
          
          data:'tid='+val,
          success: function(data){

              data = data.split("###");
              $("#teacher_des_"+i).val(data[0]);
              //$("#teacher_email_"+i).val(data[1]);
          }
          });

        }

  	</script>
</head>
<body>
	<form action="envelope_pdf.php" method="post">
		<input type="text" name="memo" id="memo" placeholder="memo">
		<select name="dept" id="dept" onChange="department();">
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

        <select id="teacher_name" name="teacher_name" onchange="designation()">
            <option value="">Select teacher's name</option>
        </select>

        <input type="text" name="teacher_des" id="teacher_des">

      <div class="submit">
	      <input type="submit"  value="Done">
	  </div>
		
	</form>
  
</body>
</html>