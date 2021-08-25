<?php 

	include $_SERVER['DOCUMENT_ROOT'].'/spl/base_url.php';
	include BASE_URL."dbconnect.php"; 


	$result = $_POST["tid"];

	$result_explode = explode('|', $result);

	$query ="SELECT * FROM teacher WHERE tid = '" . $result_explode[0] . "'";
	$result=mysqli_query($link,$query);

?>
	<option id="courses" value="">Select teacher's name</option>

<?php 
	while($row=mysqli_fetch_array($result)) {?>
	
		<option value="<?php echo $row["id"] ."|". $row["t_name"]; ?>"><?php echo $row["t_name"]; ?>
		</option>
	
<?php } ?>
