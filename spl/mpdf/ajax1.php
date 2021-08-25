<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<script type="text/javascript">//alert("sdfsd");</script>
<body>


<?php 


include("dbconnect.php");





//$db_handle = new DBController();
        $result = $_POST["tid"];
        
		$result_explode = explode('|', $result);






	$query ="SELECT * FROM teacher WHERE tid = '" . $result_explode[0] . "'";
    $result=mysqli_query($link,$query);
?>
	<option id="courses" value="">Select teacher's name</option>
<?php
	 while($row=mysqli_fetch_array($result)) {
?>
	<option value="<?php echo $row["t_name"]; ?>"><?php echo $row["t_name"]; ?></option>
	
<?php

}
?>
</body>
</html>