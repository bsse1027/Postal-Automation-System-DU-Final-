<?php

	include $_SERVER['DOCUMENT_ROOT'].'/spl/base_url.php';
	include BASE_URL."dbconnect.php"; 

?>

<?php 

	$path1=SERVER_URL.'Files/'.$memo.'_'.$teacher_id_1.'_committee.pdf';

?>
<iframe src="<?php echo $path1?>" height=800 width=100% title="Iframe Example"></iframe>