<?php

/*

Arbitrary Path Traversal (CWE-22) - Prevention Example

Mitigations:

1. By defining the directory from where the files are expected to be read from.
2. By normalizing the user-provided input.

Reference Links:

- OWASP Path Traversal - https://www.owasp.org/index.php/Path_Traversal
- realpath - https://secure.php.net/manual/en/function.realpath.php
- basename - https://secure.php.net/manual/en/function.basename.php
- file_exists - https://secure.php.net/manual/en/function.file-exists.php
- file_get_contents - https://secure.php.net/manual/en/function.file-get-contents.php

*/

if(!isset($_GET['file'])){
	echo "Usage: readsafe.php?file=shakespeare.txt";
	exit();
}

// Setting the directory from where the file is expected to read from
$cur_dir = dirname(__FILE__);

// Normalizing data to be read
$user_file = realpath($_GET['file']);

$file_to_be_read = $cur_dir . DIRECTORY_SEPARATOR . basename($user_file);

// If file exists, read it and display its contents
if(file_exists($file_to_be_read) && $user_file){
	$file_content = file_get_contents($file_to_be_read);
	if($file_content){
		echo "<pre>" . $file_content . "</pre>";
	}	
}
else{
	echo "Try adding a correct filename to the GET parameter 'file' <br />";
	echo "Example: readsafe.php?file=shakespeare.txt";
}

?>