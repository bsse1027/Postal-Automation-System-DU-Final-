<?php 

	include $_SERVER['DOCUMENT_ROOT'].'/spl/base_url.php';
	include BASE_URL."dbconnect.php"; 


	$result = $_POST["fid"];

	$result_explode = explode('|', $result);

	$query ="SELECT * FROM dept_table WHERE faculty_id = '" . $result_explode[0] . "'";
	$result=mysqli_query($link,$query);

?>
	<option value="">Select Department</option>

<?php 
	while($row=mysqli_fetch_array($result)) {?>
	
		<option value="<?php echo $row["dept_id"] ."|". $row["dept_name"]; ?>"><?php echo $row["dept_name"]; ?>
		</option>
	
<?php } ?>
