<?php
/*

SQL injection (CWE-89) - Vulnerability Example

*/

if(!isset($_GET['name'])){
	echo "Submit your name via the GET parameter name";
	exit();
}

$conn = mysqli_connect('localhost', 'readuser', 'password', 'sqlitest');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT sno, name FROM people WHERE name = '" . $_GET['name'] . "'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
       echo "sno: " . $row["sno"]. " - Name: " . $row["name"]. "<br>";
    }
} else {
    echo "0 results";
}

mysqli_close($conn);

?>
