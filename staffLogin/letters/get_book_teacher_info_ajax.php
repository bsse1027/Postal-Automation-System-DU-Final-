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

	$tid = $row["id"];
	$t_name = $row["t_name"];
	$designation = $row["designation"];
	$email = $row["email"];
	$mobile_no = $row["mobile_no"];
	
}

$str =$tid."###".$t_name."###".$designation."###".$email."###".$mobile_no;
echo ($str);
?>
