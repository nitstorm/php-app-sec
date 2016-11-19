<?php
/*

OS Command Execution (CWE-78) - Prevention Example

Mitigation:

- Canonicalization of options, make users select from pre-defined options instead of relying on user options.
  Eg:
  	Option 1 -> ls /tmp/apptempdata
  	Option 2 -> rm /tmp/apptempdata/*
  	Option 3 -> du -h /tmp/apptempdata/*

- If you absolutely have to include user input:
	- Restrict usage to high-privilege users
	- Employ multiple checks, sanitizers

Note: Following example only looks for preventing OS command Injection vulnerabilities and is susceptible to other vulnerabilities suchs as XSS, CSRF.

Reference Links:

- OWASP PHP Filters - https://www.owasp.org/index.php/OWASP_PHP_Filters
- escapeshellarg - https://secure.php.net/manual/en/function.escapeshellarg.php

*/

require_once('../lib/sanitize.inc.php');

if(!isset($_GET['dir'])){
	echo "Submit a directory name via the GET parameter dir. It will be passed to the <code>ls</code> command";
	exit();
}

// Following code is vulerable to file/directory names containing XSS payloads

echo '<pre>';
system('ls '. escapeshellarg($_GET['dir']));
echo '</pre>';

echo "Output delivered after sanitization with OWASP PHP Filter:";

echo '<pre>';
system('ls ' . sanitize_system_string($_GET['dir']));
echo '</pre>';

?>