<?php
include 'connectdb.php';

function test_input($data){
	$data = str_replace("'","\"","$data");
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

function allow_file_type($filetype){
	$right = 1;
	
	if($filetype == "text/html")
		$right = 0;
	if($filetype == "application/x-php")
		$right = 0;
	
	return $right;
}

echo '
<!DOCTYPE html>
<html>
<head>	
	<title>
        Share
    </title>
	<link rel="stylesheet" type="text/css" href="Styles/mystyle.css">
</head>
<body>
	<div class="wrapper">
		<br/>
	    <a href="index.php" class="home">Share</a>
		<div class="menu">
			IP : '.$_SERVER['REMOTE_ADDR'].'
		</div>
		<br/>
<!------------header ending------------->';
?>
