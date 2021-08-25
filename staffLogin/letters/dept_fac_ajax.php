<?php 

	include $_SERVER['DOCUMENT_ROOT'].'/spl/base_url.php';
	include BASE_URL."dbconnect.php"; 


	$result = $_POST["tid"];

	$result_explode = explode('|', $result);

	$query ="SELECT f.* FROM dept_table d
			join faculty_table f on (f.id=d.faculty_id)
	WHERE d.id = '" . $result_explode[0] . "'";
	$result=mysqli_query($link,$query);

?>
	<option value="">Select Faculty Name</option>

<?php 
	while($row=mysqli_fetch_array($result)) {?>
	
		<option value="<?php echo $row["id"] ."|". $row["name"]; ?>"><?php echo $row["name"]; ?>
		</option>
	
<?php } ?>
