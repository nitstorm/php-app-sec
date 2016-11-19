<?php

/*

Cross-site Scripting (XSS) (CWE-79) - Vulnerablity Example

*/

if(!isset($_GET['search_term'])){
	echo "Submit a search term via the GET parameter search_term";
	exit();
}

?>

<h1>Search results for <?= $_GET['search_term'] ?> </h1>

<a href="<?= $_GET['search_term']; ?>">Link</a>
