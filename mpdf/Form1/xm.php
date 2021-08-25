<html>
  <head>
  
  </head>

  <body>

  <form action="xm1.php" method="post">

  

 

  <?php
include("dbconnect.php");
  $sql="SELECT *  FROM examlist";
  $result=mysqli_query($link,$sql);

  





echo"<select name='hj' id='opt1'>";
echo"<option> Select exam name</option>";

while($row=mysqli_fetch_array($result))
{
    echo "<option>$row[E_name]</option>";
}
echo "</select>";

?>

<input type ="submit">
</form>

</body>
</html>