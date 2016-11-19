<?php
/*

Cross-site Request Forgery (CWE-352) - Prevention Example

Mitigation:

- Anti-CSRF token usage

Reference Links:

- OWASP CSRF Prevention Cheat Sheet - https://www.owasp.org/index.php/Cross-Site_Request_Forgery_(CSRF)_Prevention_Cheat_Sheet
- bin2hex - https://secure.php.net/manual/en/function.bin2hex.php
- mycrypt_create_iv - https://secure.php.net/manual/en/function.mcrypt-create-iv.php

*/

session_start();

function newform(){

$csrf = bin2hex(mcrypt_create_iv(64, MCRYPT_DEV_URANDOM));

$html=<<<HTML
<form action="csrf.php" method="post">
Account Number: <input type="text" name="account" /> <br />
Transfer Amount: <input type="text" name="amount" /> <br />
<input type="hidden" name="csrf" value="$csrf" />
<input type="submit" />
</form>
HTML;

        $cookie_val = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
        $_SESSION['myapp'] = $cookie_val;
        $_SESSION['csrf'] = $csrf;
        setcookie('myapp', $cookie_val, time()+300);
        echo $html;
        exit();
}

if(!isset($_COOKIE['myapp']) || !isset($_SESSION['myapp']) || !isset($_POST['account']) || !isset($_POST['amount']) || !isset($_POST['csrf'])){
        newform();
}

if($_SESSION['myapp'] === $_COOKIE['myapp'] && $_SESSION['csrf'] === $_POST['csrf']){
        echo "Transfer successful";
        unset($_SESSION['csrf']);
}
else{
        echo "Transfer failed. Please re-submit the form. <br />";
        newform();
}

?>