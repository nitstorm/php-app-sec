<?php
/*

Open Redirect (CWE-601) - Prevention Example

Mitigation:

- Use direct HTML links instead of a redirection script
- If you have to use redirection,
    - A popup message or interstitial page informing users of the redirect
    - A verification method to make sure redirection originates from the application and is not being abused
    
Reference Links:

- OWASP Unvalidated Redirects and Forwards - https://www.owasp.org/index.php/Unvalidated_Redirects_and_Forwards_Cheat_Sheet
- urlencode - https://secure.php.net/manual/en/function.urlencode.php
- htmlspecialchars - https://secure.php.net/manual/en/function.htmlspecialchars.php
- header - https://secure.php.net/manual/en/function.header.php

*/
session_start();
if(isset($_GET['url'])){
    if(!isset($_GET['confirm']) || $_SESSION['confirm'] !== $_GET['confirm']){
        // Using anti-CSRF token to verify authentic redirect request
        $confirm = bin2hex(mcrypt_create_iv(64, MCRYPT_DEV_URANDOM));
        $_SESSION['confirm'] = $confirm;
        echo "A request was made to be redirected to the following URL, please confirm you really intend to do so by clicking the following link. <br />";
        // Preventing XSS in provided url parameter
        echo '<a href="redirect.php?url=' . urlencode($_GET['url']) . '&confirm=' . $confirm . '">' . htmlspecialchars($_GET['url']) . "</a>";
    }
    else{
            unset($_SESSION['confirm']);
            // header() takes care of HTTP Response Splitting, so no worries
            // Do NOT urlencode() the url parameter, it'll mess things up.
            header('Location: ' . $_GET['url']);
    }
}
else{
    echo "Provide URL to be redirected to in the GET url parameter";
}

?>