<?php
/*
OS Command Injection (CWE-78) - Vulnerability Example

Evil usage:
code_exec.php?dir=/etc;touch%20/tmp/testingtouch;
*/

if(!$_GET['dir']){
	echo "Submit a directory name via the GET parameter dir. It will be passed to the <code>ls</code> command";
	exit();
}

echo '<pre>';
system('ls '.$_GET['dir']);
echo '</pre>';

?>