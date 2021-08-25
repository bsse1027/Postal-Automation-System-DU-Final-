<?php 


include $_SERVER['DOCUMENT_ROOT'].'/spl/base_url.php';
include BASE_URL."dbconnect.php"; 

$str = "";

$result = $_POST["tid"];

$result_explode = explode('|', $result);


$query ="SELECT * FROM teacher WHERE id = '" . $result_explode[0] . "'";
//echo'<pre>';print_r($query);exit;
$result=mysqli_query($link,$query);

while($row=mysqli_fetch_array($result)) {

	$str = $row["designation"];
	$str1 = $row["email"];
	$str2 = $row["mobile_no"];
	
}
echo ($str."###".$str1."###".$str2);
?>
