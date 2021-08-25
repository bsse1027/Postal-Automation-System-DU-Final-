<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<script type="text/javascript">//alert("sdfsd");</script>
<body>
<?php

include $_SERVER['DOCUMENT_ROOT'].'/spl/base_url.php';
include BASE_URL."dbconnect.php"; 


//$db_handle = new DBController();
		$result = $_POST["ID"];
		$result_explode = explode('|', $result);

	$query ="SELECT * FROM course WHERE SID = '" . $result_explode[0] . "'";
	$results=mysqli_query($link,$query);
?>
	<option id="courses" value="">Select Course</option>
<?php
	while($rs=$results->fetch_assoc()) {
?>
	<option value="<?php echo $rs["CID"]; ?>"><?php echo $rs["CID"]; ?></option>
	
<?php

}
?>
</body>
</html>