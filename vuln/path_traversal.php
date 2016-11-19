<?php
/*

Arbitrary Path Traversal (CWE-22) - Vulnerability Example

Payload examples:

../../../../../etc/passwd
/etc/hosts
http://localhost/evil.php
file:///etc/resolv.conf

*/

if(!$_GET['file']){
	echo "Usage: read.php?file=shakespeare.txt";
	exit();
}

echo "File param: " . dirname(__FILE__) . $_GET['file'] . "<br />";

// reading a file based on user input
$file_content = file_get_contents($_GET['file']);

// displaying file contents if it exists
if($file_content){
	echo "<pre>" . $file_content . "</pre>";	
}
else{
	echo "Try adding a correct filename to the GET parameter 'file'";
	echo "Example: read.php?file=shakespeare.txt";
}

?>