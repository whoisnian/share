<?php
include 'Includes/header.php';

$fileErr = "";
if(isset($_POST["submit"])){
	if(allow_file_type($_FILES["file"]["type"])){
		if ($_FILES["file"]["error"] > 0){
			$fileErr = 'Return Code: '.$_FILES["file"]["error"];
		}
		else{
			if(file_exists('upload/'.$_FILES["file"]["name"])){
				$fileErr = $_FILES["file"]["name"].' already exists. ';
			}
			else{
				$Name = $_FILES["file"]["name"];
				$Type = $_FILES["file"]["type"];
				$Size = $_FILES["file"]["size"];
				date_default_timezone_set("Asia/Shanghai");
				$Time = date("Y-m-d H:i:s");
				mysql_query("insert into files (name,type,size,time) values ('$Name','$Type','$Size','$Time')");
				move_uploaded_file($_FILES["file"]["tmp_name"],'upload/'.$_FILES["file"]["name"]);
			}
		}
	}
	else{
		$fileErr =  'Invalid file type. ';
	}
}

echo '
<br/>
<br/>
	<div class="form">
		<form action="index.php" method="post" enctype="multipart/form-data">
			<input type="file" name="file" id="file" /> 
<br/>
<br/>
			<input type="submit" name="submit" value="上传">
			<span class="error">'.$fileErr.'</span>
		</form></div>';

$fileResult = mysql_query("select * from files order by id desc");
if(mysql_num_rows($fileResult)){
	echo '
<br>
<br>	
	<table class="table">
	<thead>
		<tr>
			<td class="table-a">Name</td>
			<td class="table-a">Type</td>
			<td class="table-a">Size</td>
			<td class="table-a">Date</td>
			<td class="table-a">Time</td>
			<td class="table-a">Link</td>
			<td class="table-a">Delete</td>
		</tr>
	</thead>
	<tbody>';

	while($row = mysql_fetch_array($fileResult)){
		$ID = $row['id'];
		$Name = $row['name'];
		$Type = $row['type'];
		$SizeKiB = round($row['size'] / 1024, 2);
		$SizeMiB = round($row['size'] / 1024 / 1024, 2);
		if($SizeMiB > 1)
			$Size = $SizeMiB.' MB';
		else
			$Size = $SizeKiB.' KB';
		sscanf($row['time'], "%s %s", $Date, $Time);
		$Link = '<a href="upload/'.$row["name"].'" download="'.$row["name"].'">Download</a>';
		$Delete = '
					<form action="deletecheck.php" method="post" class="form-left">
						<input type="hidden" name="name" value="'.$Name.'">
						<input type="hidden" name="id" value="'.$ID.'">
						<input type="submit" name="submit" value="删除">
					</form>';

		echo '	
		<tr>
			<td class="table-a">'.$Name.'</td>
			<td class="table-a">'.$Type.'</td>
			<td class="table-a">'.$Size.'</td>
			<td class="table-a">'.$Date.'</td>
			<td class="table-a">'.$Time.'</td>
			<td class="table-a">'.$Link.'</td>
			<td class="table-a">'.$Delete.'</td>
		</tr>';
	}

	echo'
	</tbody>
	</table>
<br/>';
}

include 'Includes/footer.php';
?>
