<?php

$html = <<<HTML
<form action="upload.php" method="post" enctype="multipart/form-data">
<input type="file" name="file" />
<input type="submit" />
</form>
HTML;


if(!$_FILES){
    echo $html;
    exit();
}

$destination = dirname(__FILE__) . DIRECTORY_SEPARATOR . $_FILES["file"]["name"];
if(move_uploaded_file($_FILES["file"]["tmp_name"], $destination)){
    echo "Upload Successful";
}
else{
    echo "Upload failed!";
}

?>