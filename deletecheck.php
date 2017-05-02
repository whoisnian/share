<?php
include 'Includes/header.php';

if(!isset($_POST["submit"])){
	echo '<meta http-equiv="refresh" content="0;url=denied.html">';
}
else{
	$ID = $_POST['id'];
	$Name = 'upload/'.$_POST['name'];
	mysql_query("delete from files where id='$ID'");
	unlink($Name);
	echo '<meta http-equiv="refresh" content="0;url=index.php">';
}

include 'Includes/footer.php'; ?>
