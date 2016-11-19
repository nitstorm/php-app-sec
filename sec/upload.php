<?php
/*

Arbitrary File Upload (CWE-434) - Prevention Example

Mitigation:
- Rename the file with a random name and force it to have a safe extension of your choice.
- If possible, avoid uploading files to a directory outside of the webroot
- Else, enforce Web Server configuration to make sure MOME type of files being downloaded from the designated download directory are safe.
- Usage of X-Content-Type-Options HTTP header

Relevant Links:

- OWASP Unrestricted File Upload - https://www.owasp.org/index.php/Unrestricted_File_Upload
- preg_match - https://secure.php.net/manual/en/function.preg-match.php
- hash - https://secure.php.net/manual/en/function.hash.php
- mt_rand - https://secure.php.net/manual/en/function.mt-rand.php
- uniqid - https://secure.php.net/manual/en/function.uniqid.php
- move_uploaded_file - https://secure.php.net/manual/en/function.move-uploaded-file.php

*/
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

if(!preg_match("/(jpe?g|png)/i", $_FILES["file"]["type"], $ext)){
    echo "Only JPEG and PNG files allowed";
    exit();
}

$destination = 'uploads' . DIRECTORY_SEPARATOR . hash('sha256', mt_rand() . uniqid('', true)) . '.' . $ext[1];

if(move_uploaded_file($_FILES["file"]["tmp_name"], $destination)){
    echo "Upload Successful at $destination";
}
else{
    echo "Upload failed!";
}

?>
