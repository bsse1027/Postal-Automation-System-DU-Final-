<?php 
include $_SERVER['DOCUMENT_ROOT'].'/spl/base_url.php';
include BASE_URL."dbconnect.php"; 

$str = "";

$result = $_POST["tid"];

$result_explode = explode('|', $result);


$query ="SELECT * FROM signed_teacher WHERE id = '" . $result_explode[0] . "'";
//echo'<pre>';print_r($query);exit;
$result=mysqli_query($link,$query);

while($row=mysqli_fetch_array($result)) {

	$tid = $row["id"];
	$nameBang = $row["nameBang"];
	$nameEng = $row["nameEng"];
	$designation = $row["designation"];
	$email = $row["email"];
	$phone = $row["phone"];
	
}

$str =$tid."###".$nameBang."###". $nameEng."###".$designation."###".$email."###".$phone;
echo ($str);
?>
