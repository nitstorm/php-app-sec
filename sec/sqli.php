<?php
/*

SQL injection (CWE-89) - Vulnerability Example

Mitigation:

- Input validation
- Parameterized Statements
- Database user with limited permissions to access the database

Reference Links:

- OWASP SQL Injection Prevention Cheat Sheet - https://www.owasp.org/index.php/SQL_Injection_Prevention_Cheat_Sheet
- OWASP PHP Filters - https://www.owasp.org/index.php/OWASP_PHP_Filters
- htmlspecialchars - https://secure.php.net/manual/en/function.htmlspecialchars.php
- mysqli_set_charset - 
- mysqli_real_escape_string - 

*/

if(!isset($_GET['name'])){
	echo "Submit your name via the GET parameter name";
	exit();
}

$conn = mysqli_connect('localhost', 'root', 'toor', 'sqlitest');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

mysqli_set_charset( $conn, 'utf8');

$sql = "SELECT sno, name FROM people WHERE name = '" . mysqli_real_escape_string($conn, $_GET['name']) . "'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
    	// htmlspecialchars below to prevent XSS payloads that might be stored as data
       	echo "sno: " . htmlspecialchars($row["sno"], ENT_QUOTES) . " - Name: " . htmlspecialchars($row["name"], ENT_QUOTES) . "<br>";
    }
} else {
    echo "0 results";
}

mysqli_close($conn);

?>
