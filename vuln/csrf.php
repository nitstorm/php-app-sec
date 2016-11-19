<?php
/*

Cross-site Request Forgery (CWE-352) - Vulnerability Example

*/
session_start();

function newform(){

	$html=<<<HTML
<form action="csrf.php" method="post">
Account Number: <input type="text" name="account" /> <br />
Transfer Amount: <input type="text" name="amount" /> <br />
<input type="submit" />
</form>
HTML;

    $cookie_val = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
    $_SESSION['myapp'] = $cookie_val;
    setcookie('myapp', $cookie_val, time()+300);
    echo $html;
    exit();
}

if(!isset($_COOKIE['myapp']) || !isset($_SESSION['myapp']) || !isset($_POST['account']) || !isset($_POST['amount'])){
	newform();
}

if($_SESSION['myapp'] == $_COOKIE['myapp']){
	echo "Transfer successful";
}
else{
	newform();
}

?>
