<?php
include 'Includes/function.php';
include 'Includes/header.php';

$fileErr = '文件大小限制：'.min(ini_get('upload_max_filesize'), ini_get('post_max_size'));
if(isset($_POST["submit"])){
    if($_POST["submit"] == "upload"){
        for($i = 0;$i < count($_FILES["file"]["name"]);$i++){
            if(allow_file_type($_FILES["file"]["type"][$i])){
                if($_FILES["file"]["error"][$i] > 0){
                    $fileErr = 'Error Code: '.$_FILES["file"]["error"][$i];
                }
                else{
                    if(file_exists('upload/'.$_FILES["file"]["name"][$i])){
                        $fileErr = $_FILES["file"]["name"][$i].' already exists.';
                    }
                    else{
                        $Name = $_FILES["file"]["name"][$i];
                        $Type = $_FILES["file"]["type"][$i];
                        $Size = $_FILES["file"]["size"][$i];
                        date_default_timezone_set("Asia/Shanghai");
                        $Time = date("Y-m-d H:i:s");
                        move_uploaded_file($_FILES["file"]["tmp_name"][$i], 'upload/'.$_FILES["file"]["name"][$i]);
                    }
                }
            }
            else{
                $fileErr =  'Invalid file type.';
            }
        }
    }
    else if($_POST["submit"] == "delete"){
        $Name = 'upload/'.$_POST['name'];
        unlink($Name);
        echo '<meta http-equiv="refresh" content="0;url=index.php">';
    }
    else{
        echo '<meta http-equiv="refresh" content="0;url=denied.html">';
    }
}

echo '
        <br/><br/>
        <form class="form-card" action="index.php" method="post" enctype="multipart/form-data">
            <span class="error">'.$fileErr.'</span>
            <br/><br/>
            <label class="button">点击选择文件<input class="file" id="file" type="file" name="file[]" multiple></label>
            <label class="button">上传<input style="display:none" type="submit" name="submit" value="upload"></label>
        </form>';

$dir = 'upload';
if(is_dir($dir)){
    if($dh = opendir($dir)){
        while(($file = readdir($dh))){
            if($file == "."||$file == ".."||$file == "index.html")continue;
            $key = filemtime("upload/$file");
            $files[$file] = $key; 
        }
        if(!empty($files)){
            echo '  
            <br/>
            <div>
                <table class="table">';
            arsort($files);
            foreach($files as $file => $key){
                $Link = '<a class="maxlen" href="upload/'.$file.'">'.$file.'</a>';
                $Size = filesize("upload/$file");
                $SizeKiB = round($Size / 1024, 2);
                $SizeMiB = round($Size / 1024 / 1024, 2);
                if($SizeMiB > 1)
                    $Size = $SizeMiB.' M';
                else
                    $Size = $SizeKiB.' K';
                $Time = date("Y-m-d H:i", filemtime("upload/$file"));
                $Download = '<a href="upload/'.$file.'" download="'.$file.'">下载</a>';
                $Delete = '
                    <form action="index.php" method="post">
                        <input type="hidden" name="name" value="'.$file.'">
                        <label><a>删除</a><input style="display:none" type="submit" name="submit" value="delete"></label>
                    </form>';
                echo'
                    <tr>
                        <td>'.$Link.'</td>
                        <td class="table-center">'.$Size.'<br/>'.$Time.'</td>
                        <td class="table-center">'.$Download.'</td>
                        <td class="table-center">'.$Delete.'</td>
                    </tr>';
            }
            echo '
                </table>
            </div>';
        }
        closedir($dh);
    }
}

include 'Includes/footer.php';
?>
