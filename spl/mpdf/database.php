<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<?php 
define("HOSTNAME","localhost");
define("USERNAME","root");
define("PASSWORD","");
define("DATABASE","course_db");

$msg=" ";

$dbhandle =new mysqli(HOSTNAME,USERNAME,PASSWORD,DATABASE) or die("Unable to connect to MySQL");
if ($dbhandle->connect_error) {
    die("Connection failed: " . $dbhandle->connect_error);
} 

?>
<body>
</body>
</html>