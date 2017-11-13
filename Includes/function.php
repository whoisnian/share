<?php
function allow_file_type($filetype){
    $right = 1; 
    if($filetype == "text/html")
        $right = 0;
    if($filetype == "application/x-php")
        $right = 0;
    return $right;
}
?>
