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
- mysqli_set_charset - https://secure.php.net/manual/en/mysqli.set-charset.php
- mysqli_prepare - https://secure.php.net/manual/en/mysqli.prepare.php
- mysqli_stmt_bind_param - https://secure.php.net/manual/en/mysqli-stmt.bind-param.php
- mysqli_stmt_execute - https://secure.php.net/manual/en/mysqli-stmt.execute.php
- mysqli_stmt_bind_result - https://secure.php.net/manual/en/mysqli-stmt.bind-result.php
- mysqli_stmt_fetch - https://secure.php.net/manual/en/mysqli-stmt.fetch.php

*/

if(!isset($_GET['name'])){
        echo "Submit your name via the GET parameter name";
        exit();
}

$conn = mysqli_connect('localhost', 'readuser', 'password', 'sqlitest');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

mysqli_set_charset( $conn, 'utf8mb4');

$sql = mysqli_prepare($conn, "SELECT sno, name FROM people WHERE name=?") ;
mysqli_stmt_bind_param($sql, 's', $_GET['name']);
mysqli_stmt_execute($sql);
mysqli_stmt_bind_result($sql, $sno, $name);

while (mysqli_stmt_fetch($sql)) {
	// htmlspecialchars below to prevent XSS payloads that might be stored as data
    echo "sno: " . htmlspecialchars($sno, ENT_QUOTES) . " - Name: " . htmlspecialchars($name, ENT_QUOTES) . "<br>";
}

mysqli_close($conn);

?>

