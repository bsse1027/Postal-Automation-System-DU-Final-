<?php 

	include $_SERVER['DOCUMENT_ROOT'].'/spl/base_url.php';
	include BASE_URL."dbconnect.php"; 


	$result = $_POST["id"];

	$result_explode = explode('|', $result);

	$query ="SELECT d.*, t.id , t.t_name FROM dept_table d 
		LEFT join teacher t on (t.id=d.chairman_id)
		WHERE d.dept_id = '" . $result_explode[0] . "'

		";
	$result=mysqli_query($link,$query);

	while($row=mysqli_fetch_array($result)) {

		$str = $row["dept_name"];
		$str1 = $row["faculty_id"];
		$str2 = $row["email"];
		$str3 = $row["chairman_id"];
		$str4 = $row["id"];
		$str5 = $row["t_name"];
		
	}
	echo ($str."###".$str1."###".$str2."###".$str3."###".$str4."|".$str5);
?>
