<?php 

	include $_SERVER['DOCUMENT_ROOT'].'/base_url.php';
	include BASE_URL."dbconnect.php"; 


	$result = $_POST["id"];

	$result_explode = explode('|', $result);

	$query ="SELECT d.* FROM dept_table d
		

	WHERE d.id = '" . $result_explode[0] . "'

		";
	$result=mysqli_query($link,$query);

	while($row=mysqli_fetch_array($result)) {

		$str = $row["dept_name"];
		$str1 = $row["faculty_id"];
		$str2 = $row["email"];
		//$str3 = $row["faculty_name"];
		$str3 = $row["chairman_id"];
		
	}
	echo ($str."###".$str1."###".$str2."###".$str3);
?>
