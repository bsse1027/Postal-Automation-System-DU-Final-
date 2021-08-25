<?php  
include("dbconnect.php");

 if(isset($_POST["query"]))  
 {  
      $output = '';  
      $query = "SELECT * FROM info WHERE t_name LIKE '%".$_POST["query"]."%'";  
      $result = mysqli_query($link, $query);  
      $output = '<ul class="list-unstyled">';  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '<li>'.$row["t_name"].'</li>';  
           }  
      }  
      else  
      {  
           $output .= '<li>Name Not Found</li>';  
      }  
      $output .= '</ul>';  
      echo $output;  
 }  

 


 ?>  