<?php
/*

Open Redirect (CWE-601) - Vulnerability Example

*/

if(isset($_GET['url'])){
	header('Location: ' . $_GET['url']);
}
else{
	echo "Provide URL to be redirected to in the GET url parameter";
}

?>
