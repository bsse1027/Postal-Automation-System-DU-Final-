<html>
  <head>
  
  </head>

  <body>

  <form action="course.php" method="post">

  <p id="demo"></p>

 

  <?php
  include("dbconnect.php");
 


  
  $sql="SELECT DISTINCT Subject_name FROM course_code";
  $result=mysqli_query($link,$sql);

  




echo"<left>";
echo"<select name='hj' id='opt1'>";
echo"<option> Select Course name</option>";

while($row=mysqli_fetch_array($result))
{
    echo "<option>$row[Subject_name]</option>";
}
echo "</select>";
echo "</left>";
?>


<script>
function displayVals() {
  var singleValues = $( "#opt1" ).val();
  var multipleValues = $( "#multiple" ).val() || [];
  // When using jQuery 3:
  // var multipleValues = $( "#multiple" ).val();
  $( "p" ).html( "<b>Single:</b> " + singleValues +
    " <b>Multiple:</b> " + multipleValues.join( ", " ) );
}
 
$( "select" ).change( displayVals );
displayVals();
</script>
 

<?php

$sql1=" SELECT  Course_name FROM course_code where Subject_name='English'";

  $result1=mysqli_query($link,$sql1);

 



echo"<left>";
echo"<select name='hj1'>";
echo"<option> Select Course name</option>";

while($row=mysqli_fetch_array($result1))
{
    echo "<option>$row[Course_name]</option>";
}
echo "</select>";
echo "</left>";








?>


</form>




  </body>
</html>


<html>
  <head>
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
  <script>
    $(document).ready(function(){
        $("select.country").change(function(){
            var selectedCountry = $(this).children("option:selected").val();
            alert("You have selected the country - " + selectedCountry);
            document.write(selectedCountry);
        });
    });
</script>
  </head>

  <body>
  


  <?php 

   
     
 $sql="SELECT DISTINCT Subject_name FROM course_code";
 $result=mysqli_query($link,$sql);



echo"<select name='hj' id='opt1' class='country'>";
echo"<option> Select Course name</option>";

    if($result->num_rows > 0){ 
        while($row=mysqli_fetch_array($result))
        {
            echo "<option>$row[Subject_name]</option>";
        }
    }



    
    

   

echo "</select>";

?>






  </body>
  </html>



  //index


  <html>
  <head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  
  <script>
$(document).ready(function(){
    $('#country').on('change', function(){
        var countryID = $(this).val();
        if(countryID){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'country_id='+countryID,
                success:function(html){
                    $('#state').html(html);
                    $('#city').html('<option value="">Select state first</option>'); 
                }
            }); 
        }else{
            $('#state').html('<option value="">Select country first</option>');
            $('#city').html('<option value="">Select state first</option>'); 
        }
    });
    
    $('#state').on('change', function(){
        var stateID = $(this).val();
        if(stateID){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'state_id='+stateID,
                success:function(html){
                    $('#city').html(html);
                }
            }); 
        }else{
            $('#city').html('<option value="">Select state first</option>'); 
        }
    });
});
</script>



  </head>

  <body>




<?php 
    // Include the database config file 

    
  $sql="SELECT DISTINCT Subject_name FROM course_code";
  $result=mysqli_query($link,$sql);
  ?>

<select id="country">
    <option value="">Select Country</option>
    <?php 
    if($result->num_rows > 0){ 
        while($row = $result->fetch_assoc()){  
            echo '<option value="'.$row['Subject_name'].'"</option>'; 
        } 
    }else{ 
        echo '<option value="">Country not available</option>'; 
    } 
    ?>
</select>

<!-- State dropdown -->
<select id="state">
    <option value="">Select country first</option>
</select>
  












</body>
</html>